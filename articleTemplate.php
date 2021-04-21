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
<div class="main">
<?php
$headertext = $_GET['headertext'];
$image = $_GET['image'];
$header = "<p class=\"headertext\">$headertext</p>";
$headerimage = "<img src=". $image . " height=300px width=600px><br>";

echo $header;
echo $headerimage;
?>
</div>
</body>



<style>

 .main {
  margin-left: 6%;
 }

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
 
</style>



</html></html>