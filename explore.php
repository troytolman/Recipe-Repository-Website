<?php
  $page = 'exp';
  require("nav.php"); 
?>

<div id="explore"> 
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
</div>

</div>



<div id="table"> 
  <div id="row1">
    <img src="junk.svg" alt="Image 1" width="200" height="200">
    <h3 id="title1">Recipe 1</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
  </div>

  <div id="row2">
    <img src="junk.svg" alt="Image 1" width="200" height="200">
    <h3 id="title2">Recipe 2</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
  </div>

  <div id="row3">
    <img src="junk.svg" alt="Image 1" width="200" height="200">
    <h3 id="title3">Recipe 3</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
  </div>

  <div id="row4">
    <img src="junk.svg" alt="Image 1" width="200" height="200">
    <h3 id="title4">Recipe 4</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
  </div>
</div>




<?php include_once("footer.html"); ?>
