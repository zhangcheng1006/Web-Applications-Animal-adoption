<!--ce fichier php affiche le contenue de la page 'accueil'--> 

<div class="col-md-8 content_right_column">
    <div class="content_right_top">
        <h1><img src="images/chien-chat.png" width="105"/>  Bienvenue</h1>
    </div>
    <div class="content_right_mid">
        <h3 style='text-align: center'>Remplace achat par adoption !</h3>
        <p><span>Maison des petits </span>est une plate-forme qui consiste à favoriser l'adoption des animaux.</p>
        <p>Vous voulez adopter un animal, ou vous voulez trouver un nouveau propriétaire pour ton petit, nous sommes toujours là pour vous aider.</p>
        <h2>Je veux adopter un animal </h2>
        <div class="row">
            <div class="col-md-6 content_right_mid_adopter">
                <p>Vous aimez les animaux et voulez vivre avec eux?</p>
                <p>Vous voulez un animal qui peut jouer avec vos enfants?</p>
                <div class="mybutton"><a onclick="document.getElementById('adopter').style.display = 'block'" style="width: auto">J'y vais</a></div>
            </div>
            <div class="col-md-6 content_right_mid_adopter">
                <img class="adopter" src="images/dog.jpg" width=100% />
            </div>
        </div>
        <h2>Je veux publier une information</h2>
        <div class="row">
            <div class="col-md-6 content_right_mid_publier">
                <img src="images/publier.jpg" width=100% />
            </div>
            <div class="col-md-6 content_right_mid_publier">
                <p>Vous êtes une association d'animaux et vous voulez trouver des propriétaires pour les petits?</p>
                <p>Vous êtes propriétaire d'un animal mais vous ne pouvez plus vous occuper de lui?</p>
                <?php
                //il faut login pour publier une information
                //si on a deja login, quand on clique le button 'publier', on peut deja publier une information
                if ($_SESSION['loggedIn']) {
                    echo <<<CHAINE_DE_FIN
                <div class="mybutton"><a onclick="document.getElementById('publier').style.display = 'block'" style="width: auto">J'y vais</a></div>
CHAINE_DE_FIN;
                } else {
                    //sinon, il nous demande de login
                    echo <<<CHAINE_DE_FIN
                        <div class="mybutton"><a onclick="document.getElementById('login').style.display = 'block'" style="width: auto">J'y vais</a></div>
CHAINE_DE_FIN;
                }
                if (isset($_GET['todo']) && $_GET['todo'] == "login") {
                    if (!logIn($dbh)) {
                        rater("login");
                        echo "<script>document.getElementById('raterlogin').style.display = 'block'</script>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>