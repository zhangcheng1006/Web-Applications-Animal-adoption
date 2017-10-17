<?php

/* Dans ce fichier de php, on definie des outils qui sont utiles dans differents cas */

//la liste des pages de ce site
$page_list = array(
    array(
        "name" => "welcome",
        "title" => "Accueil de notre site",
        "menutitle" => "Accueil"
    ),
    array(
        "name" => "informations",
        "title" => "Les informtions pratiques",
        "menutitle" => "Informations pratiques"
    ),
    array(
        "name" => "compte",
        "title" => "Mon compte",
        "menutitle" => "Mon compte"
    ),
    array(
        "name" => "register",
        "title" => "Créer un compte",
        "menutitle" => "register"
    ),
    array(
        "name" => "contact",
        "title" => "Qui sommes-nous?",
        "menutitle" => "Contact"
    )
);

//fonction pour verifier si un page est autorized
function checkPage($askedPage) {
    global $page_list;
    foreach ($page_list as $page) {
        if ($page["name"] == $askedPage) {
            return true;
        }
    }
    return false;
}

//fonction pour obtenir le titre d'un page
function getPageTitle($askedPage) {
    global $page_list;
    foreach ($page_list as $page) {
        if ($page["name"] == $askedPage) {
            return $page["title"];
        }
    }
    return null;
}

//fontion pour afficher le menu
//si on a deja login, le menu doit etre "mon compte|logout"
//sinon, le menu va etre "enregistrer|login"
function generateMenu($askedPage) {
    echo <<<CHAINE_DE_FIN
            <div class="navbar">
                <div class="navbar-left">
                    <p>Maison <span>des petits</span></p>
                </div>
                <div class="navbar-right">
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul>
CHAINE_DE_FIN;
    if ($askedPage == "welcome") {
        echo <<<CHAINE_DE_FIN
                            <li class="normal"><a class="current" href="index.php?page=welcome">Accueil</a></li>
                            <li class="normal"><a href="index.php?page=informations">Informations</a></li>
CHAINE_DE_FIN;
        if ($_SESSION["loggedIn"]) {
            echo <<<CHAINE_DE_FIN
            <li class = "double"><a href = "index.php?page=compte">Mon compte</a></li>
            
            <li class = "double">|<a onclick = "document.getElementById('logout').style.display = 'block'" style = "width: auto">Logout</a></li>
CHAINE_DE_FIN;
        } else {
            echo <<<CHAINE_DE_FIN
            <li class = "double"><a href = "index.php?page=register">Enregistrer</a></li>
            <li class = "double">|<a onclick = "document.getElementById('login').style.display = 'block'" style = "width: auto">Login</a></li>
CHAINE_DE_FIN;
        }
        echo <<<CHAINE_DE_FIN
        <li class = "normal"><a href = "index.php?page=contact">Contact</a></li >
CHAINE_DE_FIN;
    }
    if ($askedPage == "informations") {
        echo <<<CHAINE_DE_FIN
                            <li class="normal"><a href="index.php?page=welcome">Accueil</a></li>
                            <li class="normal"><a class="current" href="index.php?page=informations">Informations</a></li>
CHAINE_DE_FIN;
        if ($_SESSION["loggedIn"]) {
            echo <<<CHAINE_DE_FIN
            <li class = "double"><a href = "index.php?page=compte">Mon compte</a></li>

            <li class = "double">|<a onclick = "document.getElementById('logout').style.display = 'block'" style = "width: auto">Logout</a></li>

CHAINE_DE_FIN;
        } else {
            echo <<<CHAINE_DE_FIN
            <li class = "double"><a href = "index.php?page=register">Enregistrer</a></li>
            <li class = "double">|<a onclick = "document.getElementById('login').style.display = 'block'" style = "width: auto">Login</a></li>
CHAINE_DE_FIN;
        }
        echo <<<CHAINE_DE_FIN
        <li class = "normal"><a href = "index.php?page=contact">Contact</a></li >
CHAINE_DE_FIN;
    }
    if ($askedPage == "compte") {
        echo <<<CHAINE_DE_FIN
                            <li class="normal"><a href="index.php?page=welcome">Accueil</a></li>
                            <li class="normal"><a href="index.php?page=informations">Informations</a></li>
CHAINE_DE_FIN;
        if ($_SESSION["loggedIn"]) {
            echo <<<CHAINE_DE_FIN
            <li class = "double"><a class="current" href = "index.php?page=compte">Mon compte</a></li>

            <li class = "double">|<a onclick = "document.getElementById('logout').style.display = 'block'" style = "width: auto">Logout</a></li>

CHAINE_DE_FIN;
        } else {
            echo <<<CHAINE_DE_FIN
            <li class = "double"><a href = "index.php?page=register">Enregistrer</a></li>
            <li class = "double">|<a class="current" onclick = "document.getElementById('login').style.display = 'block'" style = "width: auto">Login</a></li>
CHAINE_DE_FIN;
        }
        echo <<<CHAINE_DE_FIN
        <li class = "normal"><a href = "index.php?page=contact">Contact</a></li >
CHAINE_DE_FIN;
    }
    if ($askedPage == "register") {
        echo <<<CHAINE_DE_FIN
                            <li class="normal"><a href="index.php?page=welcome">Accueil</a></li>
                            <li class="normal"><a href="index.php?page=informations">Informations</a></li>
CHAINE_DE_FIN;
        if ($_SESSION["loggedIn"]) {
            echo <<<CHAINE_DE_FIN
            <li class = "double"><a class="current" href = "index.php?page=compte">Mon compte</a></li>

            <li class = "double">|<a onclick = "document.getElementById('logout').style.display = 'block'" style = "width: auto">Logout</a></li>

CHAINE_DE_FIN;
        } else {
            echo <<<CHAINE_DE_FIN
            <li class = "double"><a class="current" href = "index.php?page=register">Enregistrer</a></li>
            <li class = "double">|<a onclick = "document.getElementById('login').style.display = 'block'" style = "width: auto">Login</a></li>
CHAINE_DE_FIN;
        }
        echo <<<CHAINE_DE_FIN
        <li class = "normal"><a href = "index.php?page=contact">Contact</a></li >                            
CHAINE_DE_FIN;
    }
    if ($askedPage == "contact") {
        echo <<<CHAINE_DE_FIN
                            <li class="normal"><a href="index.php?page=welcome">Accueil</a></li>
                            <li class="normal"><a href="index.php?page=informations">Informations</a></li>
CHAINE_DE_FIN;
        if ($_SESSION["loggedIn"]) {
            echo <<<CHAINE_DE_FIN
            <li class = "double"><a href = "index.php?page=compte">Mon compte</a></li>
   
            <li class = "double">|<a onclick = "document.getElementById('logout').style.display = 'block'" style = "width: auto">Logout</a></li>
   
CHAINE_DE_FIN;
        } else {
            echo <<<CHAINE_DE_FIN
            <li class = "double"><a href = "index.php?page=register">Enregistrer</a></li>
            <li class = "double">|<a onclick = "document.getElementById('login').style.display = 'block'" style = "width: auto">Login</a></li>
CHAINE_DE_FIN;
        }
        echo <<<CHAINE_DE_FIN
        <li class = "normal"><a class="current" href = "index.php?page=contact">Contact</a></li >
CHAINE_DE_FIN;
    }
    echo <<<CHAINE_DE_FIN
                        </ul>
                    </div>
                </div>
            </div>
        <div class="banner"></div>
CHAINE_DE_FIN;
}

//fonction pour generate le htmlheader
function generateHTMLHeader($title) {
    echo <<<CHAINE_DE_FIN
        <!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="" />
        <title>$title</title>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        <link href="http://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700italic,700,400italic,300italic,300' rel='stylesheet' type='text/css'>
        <script src="js/jquery.js"></script>
    </head>
    <body>
CHAINE_DE_FIN;
}

//fonction pour afficher le footer
function generateHTMLFooter() {
    echo <<<CHAINE_DE_FIN
                   <div class="myfooter">
            <div class="row">
                <a href="index.php"><img src="images/templatemo_logo.png" height="18" style="padding-right: 5px"/>Accueil</a>
                <a href="index.php?page=informations"><img src="images/templatemo_logo.png" height="18" style="padding-right: 5px"/>Informations</a>
CHAINE_DE_FIN;
    if ($_SESSION['loggedIn']) {
        echo <<<CHAINE_DE_FIN
                <a href="index.php?page=compte"><img src="images/templatemo_logo.png" height="18" style="padding-right: 5px"/>Mon compte</a>
CHAINE_DE_FIN;
    } else {
        echo <<<CHAINE_DE_FIN
        <a onclick = "document.getElementById('login').style.display = 'block'"><img src="images/templatemo_logo.png" height="18" style="padding-right: 5px"/>Mon compte</a>
CHAINE_DE_FIN;
    }
    echo <<<CHAINE_DE_FIN
                <a href="index.php?page=contact"><img src="images/templatemo_logo.png" height="18" style="padding-right: 5px"/>Contact</a>
            </div>
        </div>
    </body>
</html>
CHAINE_DE_FIN;
}

//fonction logIn() qui teste si username existe et si password est bien correct. Si c'est le cas, on donne les valeurs a $_SESSION.
function logIn($dbh) {
    $login = $_POST['uname'];
    $user = Utilisateur::getUtilisateur($dbh, $login);
    if ($user == NULL) {
        return FALSE;
    }
    $mdp = $_POST['psw'];
    if (!Utilisateur::testerMdp($dbh, $login, $mdp)) {
        return false;
    }
    $_SESSION["loggedIn"] = true;
    $_SESSION["name"] = $login;
    return true;
}

//fonction logOut() qui supprime les valeurs dans $_SESSION.
function logOut() {
    unset($_SESSION["loggedIn"]);
    unset($_SESSION["name"]);
}

//fonction rater() qui ejecte une fenetre selon ce que l'on a rate de faire.
function rater($param) {
    if ($param == "login") {
        echo <<<CHAINE_DE_FIN
    <div id="raterlogin" class="modal">

    <form class="modal-content animate" action="" method="">

        <div class="container-top">Login Raté<button type="button" onclick="document.getElementById('raterlogin').style.display = 'none'" class="close">✖</button></div>
        <div>
            <ul>
                <li><label>Vous n'avez pas réussi à vous connecter !</label></li>
            </ul>
        </div>
        </form>
</div>
CHAINE_DE_FIN;
    }
    if ($param == "publier") {
        echo <<<CHAINE_DE_FIN
    <div id="raterpublier" class="modal">

    <form class="modal-content animate" action="" method="">

        <div class="container-top">Publication Ratée<button type="button" onclick="document.getElementById('raterpublier').style.display = 'none'" class="close">✖</button></div>
        <div>
            <ul>
                <li><label>Vous avez raté à publier cette information !</label></li>
            </ul>
        </div>
        </form>
</div>
CHAINE_DE_FIN;
    }
    if ($param == "copier") {
        echo <<<CHAINE_DE_FIN
    <div id="ratercopier" class="modal">

    <form class="modal-content animate" action="" method="">

        <div class="container-top">Copie Ratée<button type="button" onclick="document.getElementById('ratercopier').style.display = 'none'" class="close">✖</button></div>
        <div>
            <ul>
                <li><label>Vous avez raté à copier la photo !</label></li>
            </ul>
        </div>
        </form>
</div>
CHAINE_DE_FIN;
    }
    if ($param == "fichier") {
        echo <<<CHAINE_DE_FIN
    <div id="raterfichier" class="modal">

    <form class="modal-content animate" action="" method="">

        <div class="container-top">Mauvais type de fichier<button type="button" onclick="document.getElementById('raterfichier').style.display = 'none'" class="close">✖</button></div>
        <div>
            <ul>
                <li><label>Vous avez mis un fichier de mauvais type !</label></li>
                <li><label>Demande d'un fichier de type "jpg" !</label></li>
            </ul>
        </div>
        </form>
</div>
CHAINE_DE_FIN;
    }
}


