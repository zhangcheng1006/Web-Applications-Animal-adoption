<!--ce fichier php contient le contenu de la page 'contact'-->

<div class="col-md-8 content_right_column">
    <div class="content_right_top">
        <h1><img src="images/chien-chat.png" width="105"/>  A propos de nous</h1>
    </div>
    <div class="content_right_mid">
        <h3 style="text-align: center">Remplace achat par adoption !</h3>
        <p><span>Maison des petits </span>est une plate-forme qui consiste à favoriser l'adoption des animaux.</p>
        <p>Vous voulez adopter un animal, ou vous voulez trouver un nouveau propriétaire pour ton petit, nous sommes toujours là pour vous aider.</p>
        <p>Nous sommes une jeune association qui contient centaine membres. Si vous aimez les animaux et vous ne voulez pas qu'ils soient errants dans la rue, nous sommes ravis de vous accueillir!</p>
        <p>Chez nous, vous pouvez voir toutes les informations d'adoption et faire des recherches selon vos besoins. Vous pouvez aussi publier vos propres informations pour chercher des nouveaux propriétaires.</p>
        <p>Vous pouvez nous contacter </p>
        <p style="color: #67b168">par mail: MaisondesPetits@gmail.com</p>
        <p style="color: #67b168">à l'adresse: Boulevard des Marechaux, 91120 Palaiseau</p>
    </div>
</div>
<?php
//si on demande de login et on n'a pas reussi, on ejecte une fenetre
if (isset($_GET['todo']) && $_GET['todo'] == "login") {
    if (!logIn($dbh)) {
        rater("login");
        echo "<script>document.getElementById('raterlogin').style.display = 'block'</script>";
    }
}
?>



