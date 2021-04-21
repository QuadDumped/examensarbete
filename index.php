
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>



<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<html lang="sv">

<head>
<div class="header">
<p class="headertext">Das Reich Schweden Nyheter</p>
<p class="headertext"></p>
</div>
</head>


<body>
<div class="articles">
<?php
$query = "SELECT * FROM tabletest";
$result = $conn->query($query) or die("Last error: {$conn->error}\n");


while($row = $result->fetch_array()) {
$heading = $row["heading"];
$imagelink = $row["imagelink"];
echo "<a href=\"articleTemplate.php?headertext=$heading&image=$imagelink\"" . " class=\"articleLink\">" . $row["heading"] . "</a><br>";
echo "<img src=". $row["imagelink"] . " height=300px width=600px><br>";
}

?>
</div>
</body>



<style>





 .headertext {
 font-size: 35;
 margin-right: 2%;

 }

.header {
 width: 100%;
 display: flex;
 justify-content: space-between;
 background-color: #004080;
 color: white;
 padding: 10px 5px 5px 10px;
 margin-bottom: 5%;
 
 }

 
 .heading {
	font-size: 25;
	
 }
 
 
 .articleLink {
 font-size: 35;
 margin-right: 2%;
 color: black;
 }

 
img {
 margin-bottom: 5%;
}

.articles {
 margin-left: 6%;
}


</style>
</html></html>