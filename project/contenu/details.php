<?php

//ce fichier php contient la fenetre de 'details' qui affiche les details d'une information

function details($dbh, $number, $type, $genre, $age, $race, $taille, $adresse, $login) {
    $element = "detail" . $number;
    echo "<div id='$element' class='modal'>";
    echo <<<CHAINE_DE_FIN
    <form class="modal-content animate">
CHAINE_DE_FIN;


    echo <<<CHAINE_DE_FIN
        <div class="container-top">Details<button type="button" onclick="document.getElementById('$element').style.display = 'none'" class="close">✖</button></div>
                <div>
            <ul>
CHAINE_DE_FIN;
    echo "<li><label>Type: </label><label>$type</label></li>";

    echo "<li><label>Genre: </label>";
    if ($genre == "Male") {
        echo "<label><img src='images/male.png' width='20'></label></li>";
    } else {
        echo "<label><img src='images/female.png' width='20'></label></li>";
    }
    echo "<li><label>Age: </label><label>$age an(s)</label></li>";
    echo "<li><label>Race: </label><label>$race</label></li>";
    echo "<li><label>Taille: </label><label>$taille</label></li>";
    echo "<li><label>Location: </label><label>$adresse</label></li>";
    $user = Utilisateur::getUtilisateur($dbh, $login);
    echo "<li><label>Publiee par: </label><label>$login($user->type)</label></li>";
    echo "<li><label>Contacter le par: </label><label>$user->email</label></li>";
    echo <<<CHAINE_DE_FIN
    </ul>
</div>
    </form>
    </div>
CHAINE_DE_FIN;
}
