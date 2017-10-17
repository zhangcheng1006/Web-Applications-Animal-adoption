<?php
session_name("mysession");
// ne pas mettre d'espace dans le nom de session !
session_start();
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
    $_SESSION["loggedIn"] = false; //noter si un utilisateur est deja login.
    $_SESSION["name"] = "";        //noter le nom d'un utilisateur.
    $_SESSION['userpage'] = 1;     //pour administrateur, noter le page qu'il visite dans le tableau d'utilisateurs.
    $_SESSION['infopage'] = 1;     //pour administrateur, noter le page qu'il visite dans le tableau d'informations.
    $_SESSION['contrainte'] = array("type" => null, "genre" => null, "age" => null, "race" => null, "taille" => null, "adresse" => null);  //pour chercher des informations, noter les contraintes.
}

// les php(s) complementaires a utiliser.
require ('utils/utils.php');
require ('utils/Database.php');
require ('utils/Utilisateur.php');
require ('utils/Information.php');
require ('contenu/details.php');
require ('contenu/annuler.php');

$dbh = Database::connect();   //connecter a la base de donnees.
//verifier si le page demandee est autorized.
$authorized = true;
if (array_key_exists("page", $_GET)) {
    $askedPage = $_GET["page"];
    if (!checkPage($askedPage)) {
        $authorized = FALSE;
    }
} else {
    $askedPage = "welcome";
}
//si ce n'est pas autorized, il set le page erreur.
$pageTitle;
if ($authorized) {
    $pageTitle = getPageTitle($askedPage);
} else {
    $pageTitle = "Erreur";
}

//la partie htmlheader
echo generateHTMLHeader($pageTitle);
?>

<div class="mycontainer">

    <?php
    //si un utilisateur demande de login, on appele la fonction logIn()
    if (isset($_GET['todo']) && $_GET['todo'] == 'login') {
        logIn($dbh);
    }
    //si un utilisateur demande de login, on appele la fonction logOut() et on supprime ce qui est dans $_SESSION.
    if (isset($_GET['todo']) && $_GET['todo'] == 'logout') {
        logOut();
        $_SESSION["loggedIn"] = FALSE;
        $_SESSION["name"] = "";
    }
    //si un utilisateur demande d'annuler son compte, on appele annulerUtilisateur() et on supprime toutes les informations qu'il publie et on supprime ce qui est dans $_SESSION.
    if (isset($_GET['todo']) && $_GET['todo'] == "annuler") {
        $login = $_SESSION['name'];
        Utilisateur::annulerUtilisateur($dbh, $login);
        Information::deleteUser($dbh, $login);
        $_SESSION['loggedIn'] = false;
        $_SESSION['name'] = "";
    }
    //affiche la partie menu selon le page
    echo generateMenu($askedPage);
    ?>

    <div class="row">

        <?php
        require ('contenu/sidemenu.php');  //affiche le sidemenu
        ?>

        <?php
        //les fenetre qui vont appraitre selon les buttons que l'on a clique.
        require ('contenu/login.php');
        require ('contenu/logout.php');
        require ('contenu/adopter.php');
        require ('contenu/publier.php');
        ?>

        <?php
        //affiche les contenus selon le page
        if ($authorized) {
            if ($pageTitle == "Accueil de notre site") {
                require ('contenu/content_welcome.php');
            }
            if ($pageTitle == "Les informtions pratiques") {
                require ('contenu/content_informations.php');
            }
            if ($pageTitle == "Mon compte") {
                require ('contenu/content_compte.php');
            }
            if ($pageTitle == "Créer un compte") {
                require ('contenu/content_register.php');
            }
            if ($pageTitle == "Qui sommes-nous?") {
                require ('contenu/content_contact.php');
            }
        } else {
            echo "<h4>Désolé, la page demandée n'existe pas ou n'est accessible qu'aux gentlemen.</h4>";
        }
        ?>

    </div>
</div>
<?php
//affiche le footer
generateHTMLFooter();
?>

