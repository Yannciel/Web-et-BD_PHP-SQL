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

$id=$_GET["add_id"];
$url = $_GET["add_url"];
$commentaires = $_GET["add_commentaires"];
if (isset($_GET["url_photo"])){
	$req = $sql->prepare('UPDATE `TABLE2` SET `Photo`=:url WHERE `Id`=:id');
	try {
    $req->bindParam(':id',$id);
    $req->bindParam(':url',$url);
    // Exécution de la requête
    $resultat = $req->execute();
    if($resultat) {
    	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
    	echo "
        <head>
        <link href=\"fonc2.css\" type=\"text/css\" rel=\"stylesheet\"/>
        <title>Projet Plurital -- Fontaines à Paris </title>
        </head>
        ";
    	echo "<body>
            <header>
            <h1>
            <center>
            Fontaines à Paris
            <br/>
            Mise à jour de données
            <br/>
            </center>
            </h1>
            </header>
            ";
        echo "<center>";

    	echo "<div id=\"Photo1\">";
        echo "<img src=\"$url\" width=300px height= 300px/>";
        echo "<h4>photo de la fontaine $id</h4>";

        echo "<h4>Vous avez réussi à faire la mise à jour de photo. Vous pouvez trouvez les descriptions ou commentraies de cette fontaine dans la <a href=\"fonc3.html\" target=\"fonc2\">fonctionnalité 3</a></h4>";
        echo "</div>";

    	  echo "</center>";

        echo"</body>
            <footer align=\"center\"> © Mingqiang Wang </footer>
        </html>";
    }
}
 catch( Exception $e ){
    echo 'Erreur de requète : ', $e->getMessage();
}
}

elseif (isset($_GET["commentaires"])){
    $req =$sql->prepare('INSERT INTO `TABLE3`(`FontaineId`, `Commentaires`) VALUES (:id,:add_commentaires)');
	try {
    $req->bindParam(':id',$id);
    $req->bindParam(':add_commentaires',$commentaires);
    // Exécution de la requête
    $resultat = $req->execute();
    if($resultat) {

    	echo "<html xmlns=\"http://www.w3.org/1999/xhtml\">";
    	echo "
        <head>
        <link href=\"fonc2.css\" type=\"text/css\" rel=\"stylesheet\"/>
        <title>Projet Plurital -- Fontaines à Paris </title>
        </head>
        ";
    	echo "<body>
            <header>
            <h1>
            <center>
            Fontaines à Paris
            <br/>
            Mise à jour de données
            <br/>
            </center>
            </h1>
            </header>
            ";
        echo "<center>";

    	echo "<div id=\"Photo1\">";
        echo "<img src=\"".$url."\" width=300px height= 300px/>";
        echo "<h4>photo de la fontaine $id</h4>";
        echo "<h4>Votre commentaire</h4>";
        echo "<p>$commentaires</p>";
        echo "<h4>vous pouvez trouvez les descriptions ou commentraies de cette fontaine dans la <a href=\"fonc3.html\" target=\"fonc2\">fonctionnalité 3</a></h4>";
        echo "</div>";
    	echo "</center>";

        echo"</body>
        </html>";
    }
}
 catch( Exception $e ){
    echo 'Erreur de requète : ', $e->getMessage();
}
}