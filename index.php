
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
<link rel="stylesheet" type="text/css" href="styles.css?ver=<?php echo rand(111,999)?>">
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


$headerArr = [];
$imageArr = [];
$textArr = [];

$query = "SELECT * FROM tabletest";
$result = $conn->query($query) or die("Last error: {$conn->error}\n");
while($row = $result->fetch_array()) {
$heading = $row["heading"];
$imagelink = $row["imagelink"];
$text = $row["text"];

array_push($headerArr, $heading);
array_push($imageArr, $imagelink);
array_push($textArr, $text);


}

?>
</div>



<div class="columns all-columns">


<section class="column main-column">

<?php

$i = 0;
$length = count($headerArr) * 0.75;

while($i < $length){
  
  $shortedText = (strlen($textArr[$i]) > 500) ? substr($textArr[$i],0,500).'...' : $textArr[$i];

  $columns1 = ("
  <div class=\"columns\">
  <div class=\"column nested-column reset-padding\">
  <article class=\"article\">
  <a href=\"articleTemplate.php?headertext=". $headerArr[$i] . "&image=" . $imageArr[$i] . "&text=" . $textArr[$i] . "\">
  <div class=\"article-body\">
  <figure class=\"article-image2\">
  <img src=\"". $imageArr[$i] ."\" height=\"50%\">
  </figure>
  <h2 class=\"article-title\">". $headerArr[$i] .  "</h2>
  <p class=\"article-content\">". $shortedText ." </p>
  </div> 
  </a>
  </article>
  </div>
  ");

  $i++;

  $columns2 = ("
  <div class=\"column reset-padding\">
  <article class=\"article\">
  <a href=\"articleTemplate.php?headertext=". $headerArr[$i] . "&image=" . $imageArr[$i] . "&text=" .  $textArr[$i] . "\">
  <div class=\"article-body\">
  <h2 class=\"article-title\"> ". $headerArr[$i] . "</h2>
  <p class=\"article-content\">" . $shortedText. " </p>
  </div>
  </a>
  </article>
  </div>
  </div> 
  ");

  $columns = $columns1 . $columns2;

  echo $columns;
  
  $i++;
};


?>

</section>






<section class="column">
<?php

while($i < count($headerArr)){

  $shortedText2 = (strlen($textArr[$i]) > 1300) ? substr($textArr[$i],0,1300).'...' : $textArr[$i];
  
  $sideColumn = ("
  <article class=\"article\">
  <a href=\"articleTemplate.php?headertext=". $headerArr[$i] . "&image=" . $imageArr[$i] . "&text=" . $textArr[$i] . "\">
  <div class=\"article-body\">
  <figure class=\"article-image2\">
  <img src=\"". $imageArr[$i]    ."\" height=\"50%\">
  </figure>
  <h2 class=\"article-title\">" . $headerArr[$i] . "</h2>
  <p class=\"article-content\">". $shortedText2 .  "</p>
  </div>
  </a>
  </article>
  ");

  echo $sideColumn;

  $i++;
};


?>
</section>




</div>
</body>
</html>