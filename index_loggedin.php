<?php
  session_start();

  if(!isset($_SESSION['authenticated'])) {
    header('Location: login.php');
    exit; 
  }

  if(isset($_SESSION['authenticated']) && !$_SESSION['authenticated']) {
    header('Location: login.php');
    exit; 
  }

  $page = 'index';
  require("nav_loggedin.php"); 
?>

<div id="low">
  <img src="junk.svg" alt="" width="400" height="400" id="junk">
<h1 class="lowclass">Recipe Name from Popular Recipes</h1>
<p class="lowclass">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>

</div>

</div>

<!-- <div id="explore"> 
  Explore Boise Chef Now!!!
</div>

<div id="search">
  <input type="text" placeholder="Search..">
<form id="searchform">
  <label for="breakfast"><input type="checkbox" id="breakfast" name="items" value="breakfast"> breakfast</label><br>
  <label for="lunch"><input type="checkbox" id="lunch" name="items" value="lunch"> lunch</label><br>
  <label for="dinner"><input type="checkbox" id="dinner" name="items" value="dinner"> dinner</label><br>
  <label for="dessert"><input type="checkbox" id="dessert" name="items" value="dessert"> dessert</label><br>
  <label for="beginner"><input type="checkbox" id="beginner" name="items" value="beginner"> beginner</label><br>
  <label for="intermediate"><input type="checkbox" id="intermediate" name="items" value="intermediate"> intermediate</label><br>
  <label for="expert"><input type="checkbox" id="expert" name="items" value="expert"> expert</label><br>
</form>
</div> -->


<?php include_once("footer.html"); ?>

