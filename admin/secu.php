<?php

session_start();

$login = $_POST['log'];
$pass = $_POST['pass'];
include("connection.php");
//Préparation de la requête
$query = "SELECT * FROM zzprofile WHERE log = '$login' AND pass = '$pass' AND iduser not in (SELECT iduser from aeroport_administratifs_exclus)";

//exécution de la requête et récupération du nombre de résultats
$statement=$db->prepare($query);
$statement->execute();
$result=$statement->fetchAll();
$affected_rows=$statement->rowCount();



//S'il y a exactement un résultat, l'utilisateur est authentifié, sinon, on l'empêche d'entrer

if($affected_rows == 1) 
{
	$r = $statement->fetch(PDO::FETCH_ASSOC);
	$id = $r['iduser'];
	
	
	//On ajoute l'utilisateur aux variables de session
	
	$_SESSION['user'] = $login;
	$_SESSION['user_id'] = $id;
    $_SESSION['user_type'] = "a";
	?>
	<script type="text/javascript">
	<!--
	window.location.replace("index.php?p=1&action=1");
	-->
	</script>
	<?php
}

else {
	//Préparation de la requête pour connecter un conducteur
	$query = "SELECT * FROM chauffeur WHERE prenom = '$login' AND mdp = '$pass' AND idchauffeur not in (select id_chauffeur from aeroport_conducteurs_exclus)";
	
	//exécution de la requête et récupération du nombre de résultats
	$statement=$db->prepare($query);
	$statement->execute();
	$result=$statement->fetchAll();
	$affected_rows=$statement->rowCount();

	
	//S'il y a exactement un résultat, l'utilisateur est authentifié, sinon, on l'empêche d'entrer
	
	if($affected_rows == 1) 
	{
		$r = $statement->fetch(PDO::FETCH_ASSOC);
		$id = $r['idchauffeur'];
		
		
		//On ajoute l'utilisateur aux variables de session
		
		$_SESSION['user'] = $login;
		$_SESSION['user_id'] = $id;
		$_SESSION['user_type'] = "c";
		?>
		<script type="text/javascript">
		<!--
		window.location.replace("index2.php?p=1");
		-->
		</script>
		<?php
	}
	else{
            //Préparation de la requête pour connecter un conducteur
        $query = "SELECT * FROM aeroport_stagiaire WHERE login = '$login' AND mdp = '$pass'";

        //exécution de la requête et récupération du nombre de résultats
        $statement=$db->prepare($query);
		$statement->execute();
		$result=$statement->fetchAll();
		$affected_rows=$statement->rowCount();


        //S'il y a exactement un résultat, l'utilisateur est authentifié, sinon, on l'empêche d'entrer

        if($affected_rows == 1)
        {
            $r =$statement->fetch(PDO::FETCH_ASSOC);
            $id = $r['id_stagiaire'];


            //On ajoute l'utilisateur aux variables de session

			$_SESSION['user'] = $login;
            $_SESSION['user_id'] = $id;
            $_SESSION['user_type'] = "s";
            ?>
            <script type="text/javascript">
            <!--
            window.location.replace("index3.php?p=1");
            -->
            </script>
            <?php
        }
        else{
            $msg=$query;
            

            header("Location: index.php?msg_error=".$msg);
           
            
        }
	}
}
?>
