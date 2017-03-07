<?php
session_start();
//THIS IS THE PAGE A USER CAN GO TO VIEW ANY ORDER THEY'RE ASSOCIATED WITH
include('header.php');
echo "<div class='jumbotron'><h2><i class='fa fa-shopping-bag fa-fw fa-2x'></i>Orders</h2></div>";

include('buttons.php');
echo "<div>&nbsp;</div>";
include('ordertable.php');
include('footer.php');
 ?>
