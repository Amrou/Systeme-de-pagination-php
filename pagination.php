<html>
	<head></head>
	<body>
		
		<?php
			echo crypt('anass');
			mysql_connect('localhost', 'root', '');
			mysql_select_db('DataBase');
			try{
				$bd = new PDO('mysql:host=localhost; dbname=ehei', 'root', '');
			}
			catch(Exception $e){
				die('Erreur: '.$e->getMessage());
			}
			
			
			$nb = "SELECT count(id) as nbr FROM table"; //Select the number of lines in the table
			$queryNb = mysql_query($nb);
			$data = mysql_fetch_array($queryNb);
			
			$nbPost = $data['nbr']; //will store the result of query in the variable nbPost
			$parPage = 3; //This line means that we will display 3 news per page
			$currPage = 1; //The default page will be the 1st 
			$nbPage = ceil($nbPost/$parPage);
			echo $nbPage;
			
			if(isset($_GET['p'])){
				$currPage = $_GET['p'];
			}
			else{
				$currPage = 1;
			}
			
			$sql = "SELECT * from billets LIMIT ".($currPage-1)*$parPage.",".$parPage."";
			$query = mysql_query($sql);
			while($ligne = mysql_fetch_array($query)){
				echo "<center><h3 style='background-color:black;color:white;font-size:0.9em;margin-bottom:0px;'>".$ligne['Titre']."! <i>Le".$ligne['DateCreation']."</i></h3></center>";
				echo "<center><p style='background-color:#CCCCCC;margin-top:0px;'>".$ligne['Context']."</p></center>";
				echo "<a href='MiniChat_Post.php?id=".$ligne['ID']."'>Commentaires</a>";
				//echo "<a href='MiniChat_Post.php'>Commentaires</a>";
				//$_SESSION['idComm'] = $ligne['ID'];
			}
			echo "<br>";
			echo "Page: ";
			for($i=1; $i<=$nbPage; $i++){
				echo "<a href='MiniChat.php?p=$i'>$i</a>  ";
			}
			
			
		?>
	</body>
</html>
