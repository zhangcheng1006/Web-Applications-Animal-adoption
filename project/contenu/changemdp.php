<!--ce ficher contient la fenetre de "changer mot de passe"-->

<div id="changemdp" class="modal">

    <form class="modal-content animate" action="index.php?todo=changemdp&page=compte" method="post">

        <div class="container-top">Changer mot de passe<button type="button" onclick="document.getElementById('changemdp').style.display = 'none'" class="close">✖</button></div>
        <div>
            <ul>
                <li><label>Ancien mot de passe</label></li>
                <li><input id="logininput" type="password" placeholder="Enter Password" name="anpsw" required></li>
                
                <li><label>Nouveau mot de passe</label></li>
                <li><input id="logininput" type="password" placeholder="Enter Password" name="psw" required></li>

                <li><label>Confirmer le nouveau mot de passe</label></li>
                <li><input id="logininput" type="password" placeholder="Confirm Password" name="conpsw" required></li>
                
                <li>
                    <button type="submit" class="loginbutton">Je confirme</button>
                </li>
            </ul>
        </div>
    </form>
</div>


