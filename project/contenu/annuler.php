<!--ce fichier contient la fenetre de 'annuler un compte' qui demande si cous etes sur d'annuler-->

<div id="annuler" class="modal">

    <form class="modal-content animate" action="index.php?todo=annuler&page=welcome" method="post">

        <div class="container-top">Annuler mon compte<button type="button" onclick="document.getElementById('annuler').style.display = 'none'" class="close">✖</button></div>
        <div>
            <ul>
                <li><label color='red'>Vous êtes sûr(e) d'annuler votre compte ?</label></li>
                <li>
                    <button type="submit" class="loginbutton">Je confirme</button>
                </li>
            </ul>
        </div>
    </form>
</div>


