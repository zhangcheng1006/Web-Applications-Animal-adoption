<?php
//ce fichier php contient la contenue de la page informations

$form_valid = false;
$error = "";

//Si on a requis tous les champs de la fenetre 'publier' et il n'y a pas de erreur, on insere cette information dans la base de donnees.
if (isset($_POST["titre"]) && $_POST["titre"] != "" && isset($_POST["type"]) && $_POST["type"] != "" && isset($_POST["genre"]) && $_POST["genre"] != "" && isset($_POST["age"]) && $_POST["age"] != "" && isset($_POST["race"]) && $_POST["race"] != "" && isset($_POST["taille"]) && $_POST["taille"] != "" && isset($_POST["adresse"]) && $_POST["adresse"] != ""
) {
    $form_values_valid = TRUE;
    $id = 1 + Information::getMaxId($dbh);
    $login = $_SESSION['name'];
    $titre = $_POST["titre"];
    $type = $_POST["type"];
    $genre = $_POST["genre"];
    $age = $_POST["age"];
    $race = $_POST["race"];
    $taille = $_POST["taille"];
    $adresse = $_POST["adresse"];
    if (!empty($_FILES['photo']['tmp_name']) && is_uploaded_file($_FILES['photo']['tmp_name'])) {
        list($larg, $haut, $ty, $attr) = getimagesize($_FILES['photo']['tmp_name']);
        //on accepte que les images de type 'jpg'
        if ($ty == 2) {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], 'images/upload/' . $id . '.jpg')) {
                //on insere le path d'un image
                $photo = 'images/upload/' . $id . '.jpg';
                Information::insererInformation($dbh, $login, $titre, $type, $genre, $age, $race, $taille, $adresse, $photo);
                $form_valid = true;
            } else {
                //si on n'a pas reussi a inserer une information, on met a jour le "error"
                $error = "copier";
            }
        } else
            $error = "fichier";
    }
} else {
    $form_valid = false;
}
?>

<div class="col-md-8 content_right_column">
    <div class="content_right_top">
        <h1><img src="images/chien-chat.png" width="105"/>  Informations</h1>
    </div>
    <div class="content_right_mid">

        <?php
        //si on n'a pas requis les demande de 'todo', 'search', etc. on affiche toutes les informations
        if (!isset($_GET['todo']) && !isset($_GET['search']) && !isset($_GET['searchdate'])) {
            $all = Information::getAllInformations($dbh);
            Information::afficheInformations($dbh, $all);
        }
        //si on demande de publier une information, alors si on n'a pas reussi, on ejecte une fenetre selon l'erreur
        //si on reussit, alors on affiche toutes les informations qui contiennent cette nouvelle information
        if (isset($_GET['todo']) && $_GET['todo'] == "publier") {
            if (!$form_valid) {
                if ($error == "copier") {
                    rater("copier");
                    echo "<script>document.getElementById('ratercopier').style.display = 'block'</script>";
                }
                if ($error == "fichier") {
                    rater("fichier");
                    echo "<script>document.getElementById('raterfichier').style.display = 'block'</script>";
                }
                if ($error == "") {
                    rater("publier");
                    echo "<script>document.getElementById('raterpublier').style.display = 'block'</script>";
                }
            }
            $all = Information::getAllInformations($dbh);
            Information::afficheInformations($dbh, $all);
        }

        //si on demande de login, si on rate, ejecte une fenetre, si on reussit, affiche toutes les informations
        if (isset($_GET['todo']) && $_GET['todo'] == "login") {
            if (!logIn($dbh)) {
                rater("login");
                echo "<script>document.getElementById('raterlogin').style.display = 'block'</script>";
            }
            $all = Information::getAllInformations($dbh);
            Information::afficheInformations($dbh, $all);
        }

        //si on demande de search ou searchdate (dans le sidemenu), on affiche les informations correspondantes selon la recherche
        if (isset($_GET['search']) && $_GET['search'] == "chat") {
            $contrainte = array("type" => "chat", "genre" => null, "age" => null, "race" => null, "taille" => null, "adresse" => null);
            $all = Information::getInformationsAvecContrainte($dbh, $contrainte);
            Information::afficheInformations($dbh, $all);
        }
        if (isset($_GET['search']) && $_GET['search'] == "chien") {
            $contrainte = array("type" => "chien", "genre" => null, "age" => null, "race" => null, "taille" => null, "adresse" => null);
            $all = Information::getInformationsAvecContrainte($dbh, $contrainte);
            Information::afficheInformations($dbh, $all);
        }
        if (isset($_GET['search']) && $_GET['search'] == "autres") {
            $all = Information::getInformationsAutre($dbh);
            Information::afficheInformations($dbh, $all);
        }
        if (isset($_GET['searchdate'])) {
            $all = Information::getInformationsAvecDate($dbh, $_GET['searchdate']);
            Information::afficheInformations($dbh, $all);
        }

        //si on demande d'adopter, on affiche les informations correspondantes selon les contraintes
        if (isset($_GET['todo']) && $_GET['todo'] == "adopter") {
            if (!isset($_POST['type']) && !isset($_POST['genre']) && !isset($_POST['age']) && !isset($_POST['race']) && !isset($_POST['taille']) && !isset($_POST['adresse'])) {
                $contrainte = $_SESSION['contrainte'];
            } else {
                $_SESSION['contrainte'] = array("type" => null, "genre" => null, "age" => null, "race" => null, "taille" => null, "adresse" => null);
                if (isset($_POST['type']))
                    $_SESSION['contrainte']['type'] = $_POST['type'];
                if (isset($_POST['genre']))
                    $_SESSION['contrainte']['genre'] = $_POST['genre'];
                if (isset($_POST['age']))
                    $_SESSION['contrainte']['age'] = $_POST['age'];
                if (isset($_POST['race']))
                    $_SESSION['contrainte']['race'] = $_POST['race'];
                if (isset($_POST['taille']))
                    $_SESSION['contrainte']['taille'] = $_POST['taille'];
                if (isset($_POST['adresse']))
                    $_SESSION['contrainte']['adresse'] = $_POST['adresse'];
                $contrainte = $_SESSION['contrainte'];
            }
            if ($contrainte['type'] == null && $contrainte['genre'] == null && $contrainte['age'] == null && $contrainte['race'] == null && $contrainte['taille'] == null && $contrainte['adresse'] == null) {
                $all = Information::getAllInformations($dbh);
            } else {
                $all = Information::getInformationsAvecContrainte($dbh, $contrainte);
            }
            Information::afficheInformations($dbh, $all);
        }
        ?>
    </div>
</div>

