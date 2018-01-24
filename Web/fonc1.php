<?php
// Gestion des erreurs
try {
    // Connexion à MySQL avec affichage des résultats en UTF-8
	$user="root";
	$pass="root";
	$sql = new PDO('mysql:host=localhost;dbname=Projet', $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	
}

catch(PDOException $e) {
     echo "Erreur de connexion à la base de données " . $e->getMessage() ;
     die();
}

if (isset($_GET["Afficher"])){
$Modèle = $_GET["Modèle"];

	$req = $sql->prepare('SELECT * FROM TABLE2 INNER JOIN TABLE1 ON TABLE1.Id=TABLE2.Id WHERE Modele = :Modele');
	try {
    $req->bindParam(':Modele',$Modèle);
    // Exécution de la requête
    $resultat = $req->execute();
    if($resultat) {
    	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";

    	echo "
        <head>
        <link href=\"fonc1.css\" type=\"text/css\" rel=\"stylesheet\"/>
        <title>Projet Plurital -- Fontaines à Paris </title>
        </head>
        ";
    	echo "<body>
            <header>
            <h1>
            <center>
            Fontaines à Paris
            <br/>
            "."$Modèle"."
            <br/>
            </center>
            </h1>
            </header>
            ";
        echo "<center>";
    	while($row = $req ->fetch(PDO::FETCH_OBJ)){
        echo "<div id=\"Photo\">";
        echo "<img src=\"$row->Photo\" width=300px height= 300px/>";
        echo "<h3>Description de la fontaine $row->Id</h3>";
        echo "<p>$row->Description</p>";
        echo "<h4>Adresse : $row->Adresse , $row->Arrondissement</h4>";
        echo "<h4>Potable : $row->Potable</h4>";
        echo "<h4>Ouvert_Hiver : $row->Ouvert</h4>";
        echo "</div>";
    }
        echo "</center>";

        echo"</body>
            <footer align=\"center\"> © Mingqiang Wang </footer>
            <footer><a href=\"#top\" target=\"_self\"><img src=\"../Images/fleche-remonte.png\" width=2% align=\"right\"></a></footer>
        </html>";
}
}
catch( Exception $e ){
    echo 'Erreur de requète : ', $e->getMessage();
}
}	