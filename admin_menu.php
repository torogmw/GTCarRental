<?php
  session_start();
  #$UserName = $_SESSION['UserName'];

?>


<html>
  <body>
    
    <p>
      <?php
	echo "User: ".$_SESSION['UserName'];
      ?>
    </p>

    <p>
      <?php
	echo "Type: ".$_SESSION['UserType'];
      ?>
    </p>

  </body>
</html>

