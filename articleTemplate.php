<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<html lang="sv">

<head>
<div class="titleDiv">
<p class="title">News Bot</p>
</div>
</head>


<body>
<div class="main">
<?php

$headertext = $_GET['headertext'];
$image = $_GET['image'];
$text = $_GET['text'];
$header = "<p class=headertext>$headertext</p>";
$headerimage = "<img src=". $image . " height=300px width=600px><br>";
$textBlock = "<p class=text>". $text . "</p>";

echo $header;
echo $headerimage;
echo $textBlock;

?>


</div>
</body>




</html>