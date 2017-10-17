<?php
//ce fichier php affiche le contenu de la page compte
//il doit contient la partie 'changemdp' qui sert a changer le mot de passe
require ('changemdp.php');
?>

<div class="col-md-8 content_right_column">
    <div class="content_right_top">
        <h1><img src="images/chien-chat.png" width="105"/>  Mon compte</h1>
    </div>
    <div class="content_right_mid">

        <?php
        //si on a deja login, affiche le contenu de mon compte
        if ($_SESSION["loggedIn"]) {
            $name = $_SESSION['name'];
            //si on demande de changer le mot de passe, on verifie toutes les informations sont remplies et correctes.
            //sinon, on ejecte une erreur selon les differentes situations
            if (isset($_GET['todo']) && $_GET['todo'] == "changemdp") {
                if (isset($_POST['anpsw']) && $_POST['anpsw'] != "" && isset($_POST['psw']) && $_POST['psw'] != "" && isset($_POST['conpsw']) && $_POST['conpsw'] != "") {
                    if (Utilisateur::testerMdp($dbh, $name, $_POST['anpsw'])) {
                        if ($_POST['psw'] == $_POST['conpsw']) {
                            Utilisateur::changerMDP($dbh, $name, $_POST['psw']);
                            echo "<h4>Vous avez bien changé le mot de passe!</h4>";
                            echo <<<CHAINE_DE_FIN
                <button class="loginbutton" onclick = "document.getElementById('login').style.display = 'block'" style = "margin-left: 230px;">Login</a>
CHAINE_DE_FIN;
                        } else {
                            echo <<<CHAINE_DE_FIN
                <h4>Les deux nouveaux mots de passe ne sont pas le même!</h4>
                <button class="loginbutton" onclick = "document.getElementById('changemdp').style.display = 'block'" style = "margin-left: 230px;">Reessayer</a>
CHAINE_DE_FIN;
                        }
                    } else {
                        echo <<<CHAINE_DE_FIN
                <h4>L'ancien mot de passe n'est pas correct!</h4>
                <button class="loginbutton" onclick = "document.getElementById('changemdp').style.display = 'block'" style = "margin-left: 230px;">Reessayer</a>
CHAINE_DE_FIN;
                    }
                } else {
                    echo <<<CHAINE_DE_FIN
                <h4>Les informations ne sont pas complètes!</h4>
                <button class="loginbutton" onclick = "document.getElementById('changemdp').style.display = 'block'" style = "margin-left: 230px;">Reessayer</a>
CHAINE_DE_FIN;
                }
            } else {
                //si on ne demande pas de changer le mot de passe, on affiche le contenu selon l'utilisateur
                //si l'utilisateur est 'olivier', alors il est administrateur, il peut voir toutes les utilisateurs et informations
                if ($name == "olivier") {
                    echo <<<CHAINE_DE_FIN
        <p><span>Bonjour, </span>$name! Vous êtes administrateur!<a style="float: right; color: green" onclick = "document.getElementById('changemdp').style.display = 'block'"><img src="images/dogpate.jpg" height="22" style="padding-right: 5px"/>Changer mot de passe</a></p>
CHAINE_DE_FIN;
                    Utilisateur::afficheAllUsers($dbh);
                    Information::afficheWholeTable($dbh);
                } else {
                    //s'il n'est pas administrateur, il peut voir toutes ses informations
                    echo <<<CHAINE_DE_FIN
        <p><span>Bonjour, </span>$name!<a style="float: right; color: green" onclick = "document.getElementById('changemdp').style.display = 'block'"><img src="images/dogpate.jpg" height="22" style="padding-right: 5px"/>Changer mot de passe</a></p>
CHAINE_DE_FIN;
                    Information::afficheUserTable($dbh, $name);
                    echo <<<CHAINE_DE_FIN
        <button onclick="document.getElementById('annuler').style.display = 'block'" class="annulerbutton">Annuler mon compte</button>
CHAINE_DE_FIN;
                }
            }
        } else if (!logIn($dbh)) {
            //s'il n'est pas reussi a login, on demande de reessayer
            echo <<<CHAINE_DE_FIN
        <p><span>Dommage! </span>Username ou Password n'est pas correct!</p>
        <button class="loginbutton" onclick = "document.getElementById('login').style.display = 'block'" style = "margin-left: 230px;">Reessayer</a>
CHAINE_DE_FIN;
        }
        ?>
    </div>
</div>