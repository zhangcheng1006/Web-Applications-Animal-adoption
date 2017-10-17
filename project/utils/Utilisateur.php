<?php

//ce fichier php contient la class "Utilisateur" qui correspond au tableau 'utilisateurs' dans la base de donnees

class Utilisateur {

    public $login;
    public $mdp;
    public $email;
    public $type;

    //fonction __toString() affiche les informations d'un utilisateur pour debugger
    public function __toString() {
        if ($this->type == "individu") {
            return "[" . $this->login . "] est un individu. Contactez le/la par mail: " . $this->email;
        } else {
            return "[" . $this->login . "] est une association. Contactez la par mail: " . $this->email;
        }
    }

    //fonction getUtilisateur() obtient un utilisateur selon son username
    public static function getUtilisateur($dbh, $login) {
        $query = "SELECT * FROM utilisateurs WHERE login = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute(array($login));
        if ($sth->rowCount() != 1)
            return null;
        $user = $sth->fetch();
        return $user;
    }

    //fonction annulerUtilisateur() annule un compte selon son username, donc supprime cet utilisateur dans le tableau
    public static function annulerUtilisateur($dbh, $login) {
        $query = "DELETE FROM `utilisateurs` WHERE login = ?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($login));
    }

    //fonction insererUtilisateur() insere un utilisateur dans le tableau
    public static function insererUtilisateur($dbh, $login, $mdp, $email, $type) {
        if (Utilisateur::getUtilisateur($dbh, $login) != NULL) {
            return "login existes!";
        }
        $query = "INSERT INTO `utilisateurs` (`login`, `mdp`, `email`, `type`) VALUES(?,SHA1(?),?,?)";
        $sth = $dbh->prepare($query);
        $sth->execute(array(htmlspecialchars($login), $mdp, htmlspecialchars($email), $type));
    }

    //fonction testerMdp() consiste a tester le mot de passe pour login
    public static function testerMdp($dbh, $login, $mdp) {
        $user = Utilisateur::getUtilisateur($dbh, $login);
        if ($user == null)
            return false;
        if ($user->mdp == sha1($mdp))
            return true;
        else
            return false;
    }

    //fonction existEmail() teste si un adresse mail est deja existe
    public static function existEmail($dbh, $email) {
        $query = "SELECT * FROM utilisateurs WHERE email = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute(array($email));
        if ($sth->rowCount() > 0)
            return true;
    }

    //fonction changerMDP() change le mot de passe d'un utilisateur, donc mise a jour dans la base de donnees
    public static function changerMDP($dbh, $login, $mdp) {
        $query = "UPDATE utilisateurs SET mdp = SHA1(?) WHERE login = ?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($mdp, $login));
    }

    //fonction getAllIsers() obtient tous les utilisateurs dans la base de donnees
    public static function getAllUsers($dbh) {
        $query = "SELECT * FROM utilisateurs WHERE login != 'olivier'";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $sth->execute();
        return $sth->fetchAll();
    }

    //fonction afficheAllUsers() affiche le tableau qui contient tous les utilisateurs
    //seul l'administrateur peut le voir dans son compte
    public static function afficheAllUsers($dbh) {
        $pagesize = 5;
        $allusers = Utilisateur::getAllUsers($dbh);
        $numrows = sizeof($allusers);
        $pages = intval($numrows / $pagesize);
        if ($numrows % $pagesize != 0) {
            $pages++;
        }
        if (isset($_POST['userpagenumber']) && $_POST['userpagenumber'] != "") {
            $_SESSION['userpage'] = intval($_POST['userpagenumber']);
        }
        $page = $_SESSION['userpage'];
        $offset = $pagesize * ($page - 1);
        
        //si on demande de supprimer un utilisateur, on le supprime et on reafficher ce tableau
        if (isset($_GET['todo']) && $_GET['todo'] == "delete" && isset($_POST['deleteuser'])) {
            $number = $_POST['deleteuser'];
            $userselec = $allusers[$offset + $number];
            Utilisateur::annulerUtilisateur($dbh, $userselec->login);
            Information::deleteUser($dbh, $userselec->login);
        }
        echo <<<CHAINE_DE_FIN
        <h2>Tous les utilisateurs</h2>
CHAINE_DE_FIN;
        $allusers = Utilisateur::getAllUsers($dbh);
        $numrows = sizeof($allusers);
        $pages = intval($numrows / $pagesize);
        if ($numrows % $pagesize != 0) {
            $pages++;
        }
        if (isset($_POST['userpagenumber']) && $_POST['userpagenumber'] != "") {
            $_SESSION['userpage'] = intval($_POST['userpagenumber']);
        }
        $page = $_SESSION['userpage'];
        $offset = $pagesize * ($page - 1);

        if ($allusers == null) {
            echo "<p><span>Il n'y a pas d'utilisateur.</span></p>";
        } else {
            echo <<<CHAINE_DE_FIN
            <table class="table table-hover">
            <tr>
                <td>Login</td>
                <td>Email</td>
                <td>Type</td>
                <td>Delete</td>
            </tr>
CHAINE_DE_FIN;

            $nb = 0;
            for ($i = 0; $i < 5 && ($offset + $i) < $numrows; $i++) {
                $user = $allusers[$offset + $i];
                $login = $user->login;
                $email = $user->email;
                $type = $user->type;
                echo <<<CHAINE_DE_FIN
            <tr>
                <td>$login</td>
                <td>$email</td>
                <td>$type</td>
                    <td>
                    <form action="index.php?todo=delete&page=compte" method="post">
                        <button name="deleteuser" value="$nb" type="submit" class = "pagebutton">
                            Delete
                        </button>
                    </form>
                    </td>
            </tr>
CHAINE_DE_FIN;
                $nb = $nb + 1;
            }
            echo <<<CHAINE_DE_FIN
        </table>
CHAINE_DE_FIN;
            $first = 1;
            $prev = $page - 1;
            $next = $page + 1;
            $last = $pages;
            echo <<<CHAINE_DE_FIN
        <div align='right'>
        <form action="index.php?page=compte" method="post">
CHAINE_DE_FIN;
            if ($page > 1) {
                echo <<<CHAINE_DE_FIN
            <button class="pagebutton" name="userpagenumber" value=$first>Premier page</button>
            <button class="pagebutton" name="userpagenumber" value=$prev>Précédent</button>
CHAINE_DE_FIN;
            }

            if ($page < $pages) {
                echo <<<CHAINE_DE_FIN
            <button class="pagebutton" name="userpagenumber" value=$next>Suivant</button> 
            <button class="pagebutton" name="userpagenumber" value=$last>Dernier page</button>
CHAINE_DE_FIN;
            }
            echo "</form>";
            echo "</div>";
        }
    }

}
