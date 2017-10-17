<?php

//ce fichier php contient le contenu de la page "register"
//les variables pour representer les differentes situations dans le cas "creer un compte"
$register = true;
$reussi = false;
$err_mail = false;
$err_username = false;
$err_mdp = false;
$form_values_valid = false;

//si tous les champs sont bien remplis et l'adresse mail, username n'existe pas et les deux mots de passe sont le meme,
//alors on reussi a creer un compte, sinon on affiche les erreurs et on demande de reessayer.
if (isset($_POST["name"]) && $_POST["name"] != "" && isset($_POST["email"]) && $_POST["email"] != "" && isset($_POST["password1"]) && $_POST["password1"] != "" && isset($_POST["password2"]) && $_POST["password2"] != ""
) {
    $form_values_valid = TRUE;
    $login = $_POST["name"];
    $mdp1 = $_POST["password1"];
    $mdp2 = $_POST["password2"];
    $email = $_POST["email"];
    $type = "individu";
    if ($_POST["account"] == "association") {
        $type = "association";
    }
    if (Utilisateur::existEmail($dbh, $email)) {
        $register = false;
        $reussi = false;
        $err_mail = true;
    }
    if (Utilisateur::getUtilisateur($dbh, $login) != NULL) {
        $register = false;
        $reussi = false;
        $err_username = true;
    }
    if ($mdp1 != $mdp2) {
        $register = false;
        $reussi = false;
        $err_mdp = true;
    }
    if (!Utilisateur::existEmail($dbh, $email) && Utilisateur::getUtilisateur($dbh, $login) == NULL && $mdp1 == $mdp2) {
        Utilisateur::insererUtilisateur($dbh, $login, $mdp1, $email, $type);
        $register = false;
        $reussi = true;
    }
}
?>

<?php

//si on demande de creer un compte, on affiche le formulaire pour creer un compte
if ($register == true) {
    echo <<<CHAINE_DE_FIN
    <div class="col-md-8 content_right_column">
    <div class="content_right_top">
        <h1><img src="images/chien-chat.png" width="105"/>  Créer un compte</h1>
    </div>
    <div class="content_right_mid">
        <div class="testbox">
            <h1>Créer un compte</h1>

            <form action="index.php?page=register" method="post">
                <hr>
                <div class="accounttype">
                    <input type="radio" value="individu" id="radioOne" name="account" checked/>
                    <label for="radioOne" class="radio" chec>Individu</label>
                    <input type="radio" value="association" id="radioTwo" name="account" />
                    <label for="radioTwo" class="radio">Association</label>
                </div>
                <hr>
                <p>
                    <label id="icon" for="name"><i class="icon-envelope "></i></label>
                    <input type="email" name="email" id="name" placeholder="Email" required/>
                </p>
                <p>
                    <label id="icon" for="name"><i class="icon-user"></i></label>
                    <input type="text" name="name" id="name" placeholder="Username" required/>
                </p>
                <p>
                    <label id="icon" for="name"><i class="icon-shield"></i></label>
                    <input type="password" name="password1" id="name" placeholder="Password" required/>
                </p>
                <p>
                    <label id="icon" for="name"><i class="icon-shield"></i></label>
                    <input type="password" name="password2" id="name" placeholder="Confirm password" required/>
                </p>               
                <button type="submit" class="registerbutton">Je confirme</button>
            </form>
        </div>
    </div>
</div>
CHAINE_DE_FIN;
} else if ($reussi == true) {
    //si on a reussi, alors on demande de login
    echo <<<CHAINE_DE_FIN
    <div class="col-md-8 content_right_column">
    <div class="content_right_top">
        <h1><img src="images/chien-chat.png" width="105"/>  Créer un compte</h1>
    </div>
    <div class="content_right_mid">
        <div class="testbox">
            <h1>Félicitation!</h1>
            <hr>
            <p>Vous avez réussi à créer un compte!</p>
            <a onclick="document.getElementById('login').style.display = 'block'" style="width: auto"><button style="margin-left: 230px;" class="loginbutton">Login</button></a>
        </div>
    </div>
</div>
CHAINE_DE_FIN;
} else {
    //sinon, on affiche les resultats selon les erreurs
    echo <<<CHAINE_DE_FIN
    <div class="col-md-8 content_right_column">
    <div class="content_right_top">
        <h1><img src="images/chien-chat.png" width="105"/>  Créer un compte</h1>
    </div>
    <div class="content_right_mid">
        <div class="testbox">
            <h1>Dommage!</h1>
            <hr>
            <h3>Vous avez raté!</h3>
CHAINE_DE_FIN;
    if (!$form_values_valid) {
        echo "<p>Les informations ne sont pas complètes!</p>";
    }
    if ($err_mail) {
        echo "<p>Adresse mail déjà existé!</p>";
    }
    if ($err_username) {
        echo "<p>Nom d'utilisateur déjà existé!</p>";
    }
    if ($err_mdp) {
        echo "<p>Les deux mots de passe ne sont pas le même!</p>";
    }
    $register = true;
    echo <<<CHAINE_DE_FIN
        <a href="index.php?page=register"><button id="retourner" style="margin-left: 230px;" class="loginbutton">Retourner</button></a>
        </div>
    </div>
</div>
CHAINE_DE_FIN;
}



