<!--ce fichier de php affiche la fenetre de login, apres login on reste sur le meme page.
sauf si on vient de creer un compte, alors on va a la page acceuil-->

<div id="login" class="modal">

    <?php
    //on obtient la page courrant
    $page = "";
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = "welcome";
    }
    if ($page == "register") {
        $page = "welcome";
    }
    //on reste dans la meme page
    echo <<<CHAINE_DE_FIN
    <form class="modal-content animate" action="index.php?todo=login&page=$page" method="post">
CHAINE_DE_FIN;
    ?>
    <!--la fenetre de login--> 
    <div class="container-top">Login<button type="button" onclick="document.getElementById('login').style.display = 'none'" class="close">✖</button></div>
    <div>
        <ul>
            <li><label>Nom d'Utilisateur</label></li>
            <li><input id="logininput" type="text" placeholder="Enter Username" name="uname" required></li>

            <li><label>Mot de passe</label></li>
            <li><input id="logininput" type="password" placeholder="Enter Password" name="psw" required></li>

            <li>
                <button type="submit" class="loginbutton">Login</button>
            </li>
        </ul>
    </div>
    <div class="container-bottom"><a href="index.php?page=register">J'ai pas encore un compte</a></div>
</form>
</div>


