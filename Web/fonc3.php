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

if (isset($_GET["Recherche1"])){
	$Recherche = $_GET["recherche"];
	$req = $sql->prepare('SELECT * FROM TABLE2 INNER JOIN TABLE3 ON TABLE2.Id=TABLE3.FontaineId INNER JOIN TABLE1 ON TABLE1.Id=TABLE2.Id WHERE TABLE2.Id =:recherche');
	try {
    $req->bindParam(':recherche',$Recherche);
    // Exécution de la requête
    $resultat = $req->execute();
    if($resultat) {

    	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
    	echo "
        <head>
        <link href=\"fonc3.css\" type=\"text/css\" rel=\"stylesheet\"/>
        <title>Projet Plurital -- Fontaines à Paris </title>
        </head>
        ";
    	echo "<body>
            <header>
            <h1>
            <center>
            Fontaines à Paris
            <br/>
            Trouver une fontaine
            <br/>
            </center>
            </h1>
            </header>
            ";
        echo "<center>";
    	while($row = $req ->fetch(PDO::FETCH_OBJ)){
    	echo "<div id=\"Photo1\">";
        echo "<img src=\"".$row->Photo."\" width=300px height= 300px/>";
        echo "<h4>Description de fontaine $row->Id</h4>";
        echo "<p>$row->Description</p>";
        echo "<h4>Adresse : $row->Adresse , $row->Arrondissement</h4>";
        echo "<h4>Potable : $row->Potable</h4>";
        echo "<h4>Ouvert_Hiver : $row->Ouvert</h4>";
        echo "<h4>Commentaires</h4>";
        echo "<p>$row->Commentaires</p>";
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

elseif (isset($_GET["Recherche2"])){
	$Arro=$_GET["Arrondissement"];
	$Potable=$_GET["Potable"];
	$Ouvert = $_GET["Ouvert"];
	$req = $sql->prepare('SELECT * FROM TABLE1 INNER JOIN TABLE3 ON TABLE1.Id=TABLE3.FontaineId INNER JOIN TABLE2 ON TABLE1.Id=TABLE2.Id WHERE Arrondissement = :Arrondissement AND Potable = :Potable AND Ouvert = :Ouvert');
	try {
    $req->bindParam(':Arrondissement',$Arro);
    $req->bindParam(':Potable',$Potable);
    $req->bindParam(':Ouvert',$Ouvert);
    // Exécution de la requête
    $resultat = $req->execute();
    if($resultat) {
    	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
    	echo "
        <head>
        <link href=\"fonc3.css\" type=\"text/css\" rel=\"stylesheet\"/>
        <title>Projet Plurital -- Fontaines à Paris </title>
        </head>
        ";
    	echo "<body>
            <header>
            <h1>
            <center>
            Fontaines à Paris
            <br/>
            Trouver une fontaine
            <br/>
            </center>
            </h1>
            </header>
            ";
        echo "<center>";

        if(!$row = $req ->fetch(PDO::FETCH_OBJ)){
        echo "<div id=\"Photo1\">";
        echo "<img src=\"../Images/image.jpg\" width=300px height= 300px/>";
        echo "<h3>Désolé pas de résultats dans l'arrondissement $Arro</h3>";
        echo "</div>";
    }
    	while($row = $req ->fetch(PDO::FETCH_OBJ)){
    	echo "<div id=\"Photo\">";
        echo "<img src=\"".$row->Photo."\" width=300px height= 300px/>";
        echo "<h4>Description de la fontaine $row->Id</h3>";
        echo "<p>$row->Description</p>";
        echo "<h4>Adresse : $row->Adresse , $row->Arrondissement</h4>";
        echo "<h4>Potable : $row->Potable</h4>";
        echo "<h4>Ouvert_Hiver : $row->Ouvert</h4>";
        echo "<h4>Commentaires</h4>";
        echo "<p>$row->Commentaires</p>";
        echo "</div>";
    	}



    	  echo "</center>";

        echo"</body>
            <footer  align=\"center\"> © Mingqiang Wang </footer>
            <footer><a href=\"#top\" target=\"_self\"><img src=\"../Images/fleche-remonte.png\" width=2% align=\"right\"></a></footer>
        </html>";
    }
    }
     catch( Exception $e ){
    echo 'Erreur de requète : ', $e->getMessage();

}
}