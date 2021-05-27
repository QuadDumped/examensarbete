
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

//kvar att göra: snyggare layout och bättre formatering så att artikelelementen går jämnt ut.


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
  
  $flexType = rand(1, 2);

  if(strlen($text[$i]) > 600){
    $flexType = 1;
  }
  else {
    $flexType = 2;
  }

  
  $shortedText = (strlen($textArr[$i]) > 500) ? substr($textArr[$i],0,500).'...' : $textArr[$i];


  if($flexType == 1){
    $largeColumn = ("
    <article class=\"article\">
    <div class=\"article-body\">
    <figure class=\"article-image\">
    <img src=\"". $imageArr[$i] . "\" height=\"50%\">
    </figure>
    <h2 class=\"article-title\"> " . $headerArr[$i]. " </h2>
    <p class=\"article-content\">" . $shortedText . "</p>
    </div>
    </article>
    ");

    echo $largeColumn;
  }

  
  if($flexType == 2){
    $sexyColumns1 = ("
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

    $sexyColumns2 = ("
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

    $sexyColumns = $sexyColumns1 . $sexyColumns2;

    echo $sexyColumns;
  }

  $i++;
};



/*
echo $largeColumn;
echo $largeColumn;
echo $sexyColumns;
echo $largeColumn;
*/

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



/*
echo $sideColumn;
echo $sideColumn;
echo $sideColumn;
*/
?>
</section>












































<!--
<section class="column main-column">
<article class="article">
<div class="article-body">
<figure class="article-image">
<img src="https://www.thebalancecareers.com/thmb/PsG0_bvGnJ-npJiq8RYiEO6WTT4=/3435x2576/smart/filters:no_upscale()/high-angle-view-of-lower-east-side-manhattan-downtown--new-york-city--usa-640006562-5ae52a273de423003776ae2e.jpg" height="50%">
</figure>
<h2 class="article-title">
Header
</h2>
<p class="article-content">
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
xcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>
</div>
</article>

<article class="article">
<div class="article-body">
<figure class="article-image">
<img src="https://www.thebalancecareers.com/thmb/PsG0_bvGnJ-npJiq8RYiEO6WTT4=/3435x2576/smart/filters:no_upscale()/high-angle-view-of-lower-east-side-manhattan-downtown--new-york-city--usa-640006562-5ae52a273de423003776ae2e.jpg" height="50%">
</figure>
<h2 class="article-title">
Header
</h2>
<p class="article-content">
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
xcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>
</div>
</article>



<div class="columns">

<div class="column nested-column">
<article class="article">
<div class="article-body">
<figure class="article-image2">
<img src="https://www.thebalancecareers.com/thmb/PsG0_bvGnJ-npJiq8RYiEO6WTT4=/3435x2576/smart/filters:no_upscale()/high-angle-view-of-lower-east-side-manhattan-downtown--new-york-city--usa-640006562-5ae52a273de423003776ae2e.jpg" height="50%">
</figure>
<h2 class="article-title">
Header
</h2>
<p class="article-content">
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
xcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>
</div>
</article>
</div>
<div class="column">
<article class="article">
<div class="article-body">
<h2 class="article-title">
Header
</h2>
<p class="article-content">
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
xcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>
</div>
</article>
</div>

</div>
</section>







<section class="column">
<article class="article">
<div class="article-body">
<figure class="article-image2">
<img src="https://www.thebalancecareers.com/thmb/PsG0_bvGnJ-npJiq8RYiEO6WTT4=/3435x2576/smart/filters:no_upscale()/high-angle-view-of-lower-east-side-manhattan-downtown--new-york-city--usa-640006562-5ae52a273de423003776ae2e.jpg" height="50%">
</figure>
<h2 class="article-title">
Header
</h2>
<p class="article-content">
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
xcepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>
</div>
</article>

<article class="article">
Header
</article>

<article class="article">
Header
</article>


<article class="article">
Header
</article>

</section>-->












</div>




</body>

</html>