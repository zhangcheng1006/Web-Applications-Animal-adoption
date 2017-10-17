<!--ce fichier contient la fenetre de 'logout' qui demande si cous etes sur de logout-->

<div id="logout" class="modal">

    <form class="modal-content animate" action="index.php?todo=logout&page=welcome" method="post">

        <div class="container-top">Logout<button type="button" onclick="document.getElementById('logout').style.display = 'none'" class="close">✖</button></div>
        <div>
            <ul>
                <li><label>Vous êtes sûr(e) de vous deconnecter ?</label></li>
                <li>
                    <button type="submit" class="loginbutton">Logout</button>
                </li>
            </ul>
        </div>
    </form>
</div>


