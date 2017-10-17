<!--ce fichier php contient la fenetre de "adopter"-->

<div id="adopter" class="modal">

    <form class="modal-content-adopter animate" action="index.php?todo=adopter&page=informations" method='post'>

        <div class="container-top">Je veux adopter un animal<button type="button" onclick="document.getElementById('adopter').style.display = 'none'" class="close">✖</button></div>
        <div>
            <ul>
                <li><label>Type d'animal</label></li>
                <li><input id="logininput" type="text" placeholder="Type d'animal" name="type"></li>

                <li>
                    <p>
                        <label>Genre</label>
                        <input type="radio" name="genre" value="Male">
                        <label>Male</label>
                        <input type="radio" name="genre" value="Female">
                        <label>Female</label>
                    </p>
                </li>

                <li><label>Age</label></li>
                <li><input id="logininput" type="text" placeholder="Age" name="age"></li>

                <li><label>Race</label></li>
                <li><input id="logininput"type="text" placeholder="Race" name="race"></li>

                <li>
                    <p>
                        <label>Taille</label>
                        <input type="radio" name="taille" value="petit">
                        <label>Petit</label>
                        <input type="radio" name="taille" value="moyen">
                        <label>Moyen</label>
                        <input type="radio" name="taille" value="grand">
                        <label>Grand</label>
                    </p>
                </li>
                
                <li><label>Ville/Region</label></li>
                <li><input id="logininput" type="text" placeholder="Ville/Region" name="adresse"></li>
                
                <li>
                    <button type="submit" class="loginbutton">Je confirme</button>
                </li>
            </ul>
        </div>

        <div class="container-bottom"><a href="index.php?page=informations">Je mets pas de containtes</a></div>
    </form>
</div>


