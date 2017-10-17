<?php

//la class Information pour correspondre au tableau 'informations' de la base de donnees.

class Information {

    public $login;
    public $titre;
    public $type;
    public $genre;
    public $age;
    public $race;
    public $taille;
    public $adresse;
    public $date;
    public $photo;

    //fonction __toString() qui affiche certaines informations pour debugger
    public function __toString() {
        return "Cette information est publie par [" . $this->login . "]. Le titre est: " . $this->titre;
    }

    //fonction getMaxId() qui obtient le plus grand id dans le tableau pour que l'insert suivant ne couvre les informations deja existees.
    public static function getMaxId($dbh) {
        $query = "SELECT * FROM informations ORDER BY number DESC LIMIT 0, 1";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $row = $sth->fetch();
        return $row['number'];
    }

    //fonction getAllInformations() obtient toutes les informations dans le tableau
    public static function getAllInformations($dbh) {
        $query = "SELECT * FROM informations WHERE 1 ORDER BY number desc";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Information');
        $sth->execute();
        return $sth->fetchAll();
    }

    //fonction getInformationParUser() obtient toutes les informations qu'un utilisateur publie
    public static function getInformationsParUser($dbh, $login) {
        $query = "SELECT * FROM informations WHERE login = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Information');
        $sth->execute(array($login));
        return $sth->fetchAll();
    }

    //fonction insererInformation() insere une information dans la base de donnees.
    public static function insererInformation($dbh, $login, $titre, $type, $genre, $age, $race, $taille, $adresse, $photo) {
        $date = date("Y-m-d");
        $query = "INSERT INTO `informations` (`login`, `titre`, `type`, `genre`, `age`, `race`, `taille`, `adresse`, `date`, `photo`) VALUES(?,?,?,?,?,?,?,?,?,?)";
        $sth = $dbh->prepare($query);
        $sth->execute(array($login, htmlspecialchars($titre), htmlspecialchars($type), $genre, htmlspecialchars($age), htmlspecialchars($race), $taille, htmlspecialchars($adresse), $date, $photo));
    }

    //fonction getInformationAvecContrainte() obtient toutes les informations adaptees a certaines contraintes
    //pour adopter selon certaines contraintes
    public static function getInformationsAvecContrainte($dbh, $contrainte) {
        $hasvalue = array();
        $query = "SELECT * FROM informations WHERE ";
        if ($contrainte['type'] != null) {
            $type = $contrainte['type'];
            $query = $query . "type = ?";
            array_push($hasvalue, $type);
        } else {
            $query = $query . "type = type";
        }
        if ($contrainte['genre'] != null) {
            $genre = $contrainte['genre'];
            $query = $query . " AND genre = ?";
            array_push($hasvalue, $genre);
        } else {
            $query = $query . " AND genre = genre";
        }
        if ($contrainte['age'] != null) {
            $age = $contrainte['age'];
            $query = $query . " AND age = ?";
            array_push($hasvalue, $age);
        } else {
            $query = $query . " AND age = age";
        }
        if ($contrainte['race'] != null) {
            $race = $contrainte['race'];
            $query = $query . " AND race = ?";
            array_push($hasvalue, $race);
        } else {
            $query = $query . " AND race = race";
        }
        if ($contrainte['taille'] != null) {
            $taille = $contrainte['taille'];
            $query = $query . " AND taille = ?";
            array_push($hasvalue, $taille);
        } else {
            $query = $query . " AND taille = taille";
        }
        if ($contrainte['adresse'] != null) {
            $adresse = $contrainte['adresse'];
            $query = $query . " AND adresse = ?";
            array_push($hasvalue, $adresse);
        } else {
            $query = $query . " AND adresse = adresse";
        }
        $query = $query . " ORDER BY number desc";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Information');
        $sth->execute($hasvalue);
        return $sth->fetchAll();
    }

    //fonction getInformationsAutre() obtient les informations qui ne sont pas de type 'chat' ni de 'chien'
    public static function getInformationsAutre($dbh) {
        $query = "SELECT * FROM informations WHERE type != 'chien' AND type != 'chat' ORDER BY number desc";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Information');
        $sth->execute(array());
        return $sth->fetchAll();
    }

    //fonction getInformationsAvecDate() obtient toutes les informations adaptees a certaines contraintes de date
    public static function getInformationsAvecDate($dbh, $date) {
        if ($date == "semaine") {
            $query = "select * from informations where date between date_sub(now(), INTERVAL 7 DAY) and now() ORDER BY number desc";
        }
        if ($date == "mois") {
            $query = "select * from informations where date between date_sub(now(), INTERVAL 30 DAY) and now() ORDER BY number desc";
        }
        if ($date == "ancien") {
            $query = "select * from informations where date between date_sub(now(), INTERVAL 100 YEAR) and date_sub(now(), INTERVAL 30 DAY) ORDER BY number desc";
        }
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Information');
        $sth->execute(array());
        return $sth->fetchAll();
    }

    //fonction afficheInformations() affiche les informations dans la page informations selon differentes conditions
    //chaque page contient 5 informations.
    public static function afficheInformations($dbh, $all) {
        $pagesize = 5;
        if ($all == null) {
            echo "<h4>Il n'y a pas d'information correspondante selon votre recherche!</h4>";
        }
        echo <<<CHAINE_DE_FIN
            <div class="row">
            <div class="col-md-6 mybutton"><a onclick="document.getElementById('adopter').style.display = 'block'" style="width: auto">Adopter</a></div>
CHAINE_DE_FIN;
        if ($_SESSION['loggedIn']) {
            echo <<<CHAINE_DE_FIN
            <div class="col-md-6 mybutton"><a onclick="document.getElementById('publier').style.display = 'block'" style="width: auto">Publier</a></div>
CHAINE_DE_FIN;
        } else {
            echo <<<CHAINE_DE_FIN
            <div class="col-md-6 mybutton"><a onclick="document.getElementById('login').style.display = 'block'" style="width: auto">Publier</a></div>
CHAINE_DE_FIN;
        }
        echo <<<CHAINE_DE_FIN
            </div>
CHAINE_DE_FIN;

        $numrows = sizeof($all);
        $pages = intval($numrows / $pagesize);
        if ($numrows % $pagesize != 0) {
            $pages++;
        }
        $page = 1;
        if (isset($_POST['pagenumber']) && $_POST['pagenumber'] != "") {
            $page = intval($_POST['pagenumber']);
        }
        $offset = $pagesize * ($page - 1);

        for ($i = 0; $i < 5 && ($offset + $i) < $numrows; $i++) {
            $number = $offset + $i;
            $info = $all[$number];
            echo <<<CHAINE_DE_FIN
                <h2></h2>
                <div class="row info">
                    <div class="col-md-4">
            <img id='infoimage' class='adopter' src='$info->photo' width=180 />
CHAINE_DE_FIN;
            echo <<<CHAINE_DE_FIN
                </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-7">
                        <p>
                            <label id="icon" for="name" style='margin-right: 10px'><i class="icon-user"></i></label>
CHAINE_DE_FIN;
            echo $info->login;
            echo <<<CHAINE_DE_FIN
                </p>
                    </div>
                    <div class="col-md-5">
CHAINE_DE_FIN;
            echo "<p style='margin-top: 12px'>Date: $info->date</p>";
            echo <<<CHAINE_DE_FIN
                </div>
                </div>
CHAINE_DE_FIN;
            echo "<h3 style='color: #008800; margin: 0 15px; font-size: 20px'>Titre: $info->titre</h3>";
            $element = "detail" . $info->number;
            echo <<<CHAINE_DE_FIN
                <div class="infobutton"><a onclick = "document.getElementById('$element').style.display = 'block'">Details</a></div>
            </div>
        </div>
CHAINE_DE_FIN;
            details($dbh, $info->number, $info->type, $info->genre, $info->age, $info->race, $info->taille, $info->adresse, $info->login);
        }
        $first = 1;
        $prev = $page - 1;
        $next = $page + 1;
        $last = $pages;

        echo <<<CHAINE_DE_FIN
        <div align='center'>
CHAINE_DE_FIN;
        if ((!isset($_GET['search']) && !isset($_GET['searchdate']) && !isset($_GET['todo'])) || (isset($_GET['todo']) && $_GET['todo'] != "adopter")) {
            echo <<<CHAINE_DE_FIN
        <form action="index.php?page=informations" method="post">
CHAINE_DE_FIN;
        }
        if (isset($_GET['search']) && $_GET['search'] == "chat") {
            echo <<<CHAINE_DE_FIN
        <form action="index.php?search=chat&page=informations" method="post">
CHAINE_DE_FIN;
        }
        if (isset($_GET['search']) && $_GET['search'] == "chien") {
            echo <<<CHAINE_DE_FIN
        <form action="index.php?search=chien&page=informations" method="post">
CHAINE_DE_FIN;
        }
        if (isset($_GET['search']) && $_GET['search'] == "autres") {
            echo <<<CHAINE_DE_FIN
        <form action="index.php?search=autres&page=informations" method="post">
CHAINE_DE_FIN;
        }
        if (isset($_GET['searchdate'])) {
            if ($_GET['searchdate'] == "semaine") {
                echo <<<CHAINE_DE_FIN
        <form action="index.php?searchdate=semaine&page=informations" method="post">
CHAINE_DE_FIN;
            }
            if ($_GET['searchdate'] == "mois") {
                echo <<<CHAINE_DE_FIN
        <form action="index.php?searchdate=mois&page=informations" method="post">
CHAINE_DE_FIN;
            }
            if ($_GET['searchdate'] == "ancien") {
                echo <<<CHAINE_DE_FIN
        <form action="index.php?searchdate=ancien&page=informations" method="post">
CHAINE_DE_FIN;
            }
        }
        if (isset($_GET['todo']) && $_GET['todo'] == "adopter") {
            echo <<<CHAINE_DE_FIN
        <form action="index.php?todo=adopter&page=informations" method="post">
CHAINE_DE_FIN;
        }

        if ($page > 1) {
            echo <<<CHAINE_DE_FIN
            <button class="pagebutton" name="pagenumber" value=$first>Premier page</button>
            <button class="pagebutton" name="pagenumber" value=$prev>Précédent</button>
CHAINE_DE_FIN;
        }

        if ($page < $pages) {
            echo <<<CHAINE_DE_FIN
            <button class="pagebutton" name="pagenumber" value=$next>Suivant</button> 
            <button class="pagebutton" name="pagenumber" value=$last>Dernier page</button>
CHAINE_DE_FIN;
        }
        echo "</form>";
        echo "</div>";
    }

    //fonction deleteInformation() supprime une information dans la base de donnees
    public static function deleteInformation($dbh, $info) {
        $number = $info->number;
        $query = "DELETE FROM informations WHERE number = ?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($number));
    }

    //fonction deleteUser() supprime toutes les informations publiees par un utilisateur
    //a appele apres la fonction annulerUtilisateur() dans la class Utilisateur.
    public static function deleteUser($dbh, $login) {
        $query = "DELETE FROM informations WHERE login = ?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($login));
    }

    //fonction afficheUserTable() affiche un tableau qui contient toutes les informations d'un utilisateur
    //un utilisateur peut voir ce tableau dans son compte
    public static function afficheUserTable($dbh, $login) {
        $pagesize = 5;
        $allpubs = Information::getInformationsParUser($dbh, $login);
        $numrows = sizeof($allpubs);
        $pages = intval($numrows / $pagesize);
        if ($numrows % $pagesize != 0) {
            $pages++;
        }
        $page = 1;
        if (isset($_POST['userinfopagenumber']) && $_POST['userinfopagenumber'] != "") {
            $page = intval($_POST['userinfopagenumber']);
        }
        $offset = $pagesize * ($page - 1);

        if (isset($_GET['todo']) && $_GET['todo'] == "delete" && isset($_POST['deleteinfo'])) {
            $number = $_POST['deleteinfo'];
            $pubselec = $allpubs[$offset + $number];
            Information::deleteInformation($dbh, $pubselec);
        }
        echo <<<CHAINE_DE_FIN
        <h2>Les informations que je publie</h2>
CHAINE_DE_FIN;
        $allpubs = Information::getInformationsParUser($dbh, $login);
        if ($allpubs == null) {
            echo "<p><span>Vous n'avez rien publié.</span></p>";
        } else {
            echo <<<CHAINE_DE_FIN
            <table class="table table-hover">
            <tr>
                <td>Titre</td>
                <td>Date</td>
                <td>Delete</td>
            </tr>
CHAINE_DE_FIN;
            $numrows = sizeof($allpubs);
            $pages = intval($numrows / $pagesize);
            if ($numrows % $pagesize != 0) {
                $pages++;
            }
            $page = 1;
            if (isset($_POST['userinfopagenumber']) && $_POST['userinfopagenumber'] != "") {
                $page = intval($_POST['userinfopagenumber']);
            }
            $offset = $pagesize * ($page - 1);

            $nb = 0;
            for ($i = 0; $i < 5 && ($offset + $i) < $numrows; $i++) {
                $pub = $allpubs[$offset + $i];
                $titre = $pub->titre;
                $date = $pub->date;
                echo <<<CHAINE_DE_FIN
            <tr>
                <td>$titre</td>
                <td>$date</td>
                    <td>
                    <form action="index.php?todo=delete&page=compte" method="post">
                        <button name="deleteinfo" value="$nb" type="submit" class="pagebutton">
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
            <button class="pagebutton" name="userinfopagenumber" value=$first>Premier page</button>
            <button class="pagebutton" name="userinfopagenumber" value=$prev>Précédent</button>
CHAINE_DE_FIN;
            }

            if ($page < $pages) {
                echo <<<CHAINE_DE_FIN
            <button class="pagebutton" name="userinfopagenumber" value=$next>Suivant</button> 
            <button class="pagebutton" name="userinfopagenumber" value=$last>Dernier page</button>
CHAINE_DE_FIN;
            }
            echo "</form>";
            echo "</div>";
        }
    }

    //fonction afficheWholeTable() affiche un tableau qui contient toutes les informations dans la base de donnees
    //seul l'administrateur peut le voir dans son compte
    public static function afficheWholeTable($dbh) {
        $pagesize = 5;
        $allpubs = Information::getAllInformations($dbh);
        $numrows = sizeof($allpubs);
        $pages = intval($numrows / $pagesize);
        if ($numrows % $pagesize != 0) {
            $pages++;
        }
        if (isset($_POST['infopagenumber']) && $_POST['infopagenumber'] != "") {
            $_SESSION['infopage'] = intval($_POST['infopagenumber']);
        }
        $page = $_SESSION['infopage'];
        $offset = $pagesize * ($page - 1);

        if (isset($_GET['todo']) && $_GET['todo'] == "delete" && isset($_POST['deleteinfo'])) {
            $number = $_POST['deleteinfo'];
            $pubselec = $allpubs[$offset + $number];
            Information::deleteInformation($dbh, $pubselec);
        }
        echo <<<CHAINE_DE_FIN
        <h2>Toutes les informations</h2>
CHAINE_DE_FIN;
        $allpubs = Information::getAllInformations($dbh);
        $numrows = sizeof($allpubs);
        $pages = intval($numrows / $pagesize);
        if ($numrows % $pagesize != 0) {
            $pages++;
        }
        if (isset($_POST['infopagenumber']) && $_POST['infopagenumber'] != "") {
            $_SESSION['infopage'] = intval($_POST['infopagenumber']);
        }
        $page = $_SESSION['infopage'];
        $offset = $pagesize * ($page - 1);

        if ($allpubs == null) {
            echo "<p><span>Il n'y a pas d'information publiée.</span></p>";
        } else {
            echo <<<CHAINE_DE_FIN
            <table class="table table-hover">
            <tr>
                <td>Titre</td>
                <td>User</td>
                <td>Date</td>
                <td>Delete</td>
            </tr>
CHAINE_DE_FIN;

            $nb = 0;
            for ($i = 0; $i < 5 && ($offset + $i) < $numrows; $i++) {
                $pub = $allpubs[$offset + $i];
                $titre = $pub->titre;
                $user = $pub->login;
                $date = $pub->date;
                echo <<<CHAINE_DE_FIN
            <tr>
                <td>$titre</td>
                <td>$user</td>
                <td>$date</td>
                    <td>
                    <form action="index.php?todo=delete&page=compte" method="post">
                        <button name="deleteinfo" value="$nb" type="submit" class="pagebutton">
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
            <button class="pagebutton" name="infopagenumber" value=$first>Premier page</button>
            <button class="pagebutton" name="infopagenumber" value=$prev>Précédent</button>
CHAINE_DE_FIN;
            }

            if ($page < $pages) {
                echo <<<CHAINE_DE_FIN
            <button class="pagebutton" name="infopagenumber" value=$next>Suivant</button> 
            <button class="pagebutton" name="infopagenumber" value=$last>Dernier page</button>
CHAINE_DE_FIN;
            }
            echo "</form>";
            echo "</div>";
        }
    }

}
