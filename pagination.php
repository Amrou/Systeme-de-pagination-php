<html>
	<head></head>
	<body>
		
		<?php
			mysql_connect('localhost', 'root', '');
			mysql_select_db('DataBase');
			try{
				$bd = new PDO('mysql:host=localhost; dbname=ehei', 'root', '');
			}
			catch(Exception $e){
				die('Error: '.$e->getMessage());
			}
			
			
			$nb = "SELECT count(id) as nbr FROM table"; //Select the number of lines in the table
			$queryNb = mysql_query($nb);
			$data = mysql_fetch_array($queryNb);
			
			$nbPost = $data['nbr']; //will store the result of query in the variable nbPost
			$perPage = 3; //This line means that we will display 3 news per page
			$currPage = 1; //The default page will be the 1st 
			$nbPage = ceil($nbPost/$perPage); // To know how much pages we need, we must divide the number of posts (or news) we have by the number of news that we want to display per page
			
			/* Don't read it. To understand this you have to scroll down for few momentes*/
			//We are almost there :-)
			
			if(isset($_GET['p'])){//We test if the variable p (p for page) has already been set.
				$currPage = $_GET['p'];//Here we update the current page by the variable we get from the URL
			}
			else{// If p has not been set, the default page will be the 1st
				$currPage = 1;
			}
			
			//The variable $currPage after updating it, will be used in the SQL script below
			
			$sql = "SELECT * from table LIMIT ".($currPage-1)*$perPage.",".$perPage."";//In SQL, LIMIT n,m means that we want to show to the user from the line x to the next m lines: (Example: Limit 0,3 means we want to desplay from the 1st line to the next 3 lines which means the line 0, 1 and 2). The variable $perPage means that (in my case) I always want to show just 3 news per page. This is hard to explain, but trust me, if you think a little bit and practice it you will understand it.
			$query = mysql_query($sql);// This is clear I guess, we just want to execute the sql script above.
			
			while($line = mysql_fetch_array($query)){
				echo "<center><h3 style='background-color:black;color:white;font-size:0.9em;margin-bottom:0px;'>".$line['Title']."! <i>Le".$line['DateCreation']."</i></h3></center>";
				echo "<center><p style='background-color:#CCCCCC;margin-top:0px;'>".$line['Context']."</p></center>";
			echo "<br>";
			echo "Page: ";//We use the for loop, we start looping from 1 to the number of pages we have that we calculated before
			for($i=1; $i<=$nbPage; $i++){
				echo "<a href='MiniChat.php?p=$i'>$i</a>  ";//Exapmle: let's assume that we have 3 pages, so we will echo 1, 2 and 3. And pass each one to the URL, and we will get it by $_GET['ID']. Now you can go to the part of code I told you not to read
			}
			
			
		?>
	</body>
</html>
