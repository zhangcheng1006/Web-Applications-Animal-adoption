<!--ce fichier php contient la fenntre de "publier"-->

<div id="publier" class="modal">

    <form class="modal-content-adopter animate" action="index.php?todo=publier&page=informations" method="post" enctype="multipart/form-data">

        <div class="container-top">Je veux publier une information<button type="button" onclick="document.getElementById('publier').style.display = 'none'" class="close">✖</button></div>
        <div>
            <ul>
                <li><span class="psw">* Tous les champs sont obligatoires</span></li>
                <li><label>Titre</label></li>
                <li><input id="logininput" type="text" placeholder="Titre de cet information" name="titre" required></li>
                
                <li><label>Type d'animal</label></li>
                <li><input id="logininput" type="text" placeholder="Type d'animal" name="type" required></li>

                <li>
                    <p>
                        <label>Genre</label>
                        <input type="radio" name="genre" value="Male" checked>
                        <label>Male</label>
                        <input type="radio" name="genre" value="Female">
                        <label>Female</label>
                    </p>
                </li>

                <li><label>Age(Demand d'un entier)</label></li>
                <li><input id="logininput" type="text" placeholder="Age" name="age" required></li>

                <li><label>Race</label></li>
                <li><input id="logininput" type="text" placeholder="Race" name="race" required></li>

                <li>
                    <p>
                        <label>Taille</label>
                        <input type="radio" name="taille" value="petit" checked>
                        <label>Petit</label>
                        <input type="radio" name="taille" value="moyen">
                        <label>Moyen</label>
                        <input type="radio" name="taille" value="grand">
                        <label>Grand</label>
                    </p>
                </li>
                <li><label>Location(Ville/Region)</label></li>
                <li><input id="logininput" type="text" placeholder="Location(ville/region)" name="adresse" required></li>

                <li>
                    <p>
                    <label>Photo</label>
                    <input type="file" name="photo" required>
                    </p>
                </li>
                <li>
                    <button type="submit" class="loginbutton">Je confirme</button>
                </li>
            </ul>
        </div>
    </form>
</div>


