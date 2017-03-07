<?php
session_start();
include("dbconnection.php");

if($_GET['logout']==1){
  session_destroy();
$_SESSION = array(); // Clears the $_SESSION variable
}

// statement to get the photography packages, prices and descriptions from the database
$stmt = $databaseConnection->prepare("SELECT * FROM tbl_services");
// initialise an array for the results
$products = array();
if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $products[] = $row;
    }
}
//------------------------------------------------------------------------
//clearing the connection and the return
$databaseConnection=null;
$stmt=null;
//------------------------------------------------------------------------
$databaseConnection2 = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
$stmt = $databaseConnection2->prepare("SELECT id, firstname, lastname FROM tbl_photographers");
$photographers = array();
if ($stmt->execute()) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $photographers[] = $row;
    }
}
// <div class="form-group">
//   <label for="photographerRequested">Photographer Requested</label>
//     <select class="form-control" name="photographerRequested" id="photographerRequested">
//       <option></option>
//       // Use simple foreach to generate the photographers
//       foreach($photographers as $row => $value) {
//         echo "<option value=". $value['id']."> ".$value['firstname']." ".$value['lastname']." </option>";
//        }
//     </select>
// </div>

//------------------------------------------------------------------------
$databaseConnection = null;
$stmt = null;
 // var_dump($products);
 //
 // exit;

if(isset($_POST['submit'])){

  //username and password sent from the form on this page
  $email = trim($_POST['inputEmail']);
  $password = trim($_POST['inputPassword']);

  $databaseConnection = null;
  $stmt = null;
  $records = null;
  $databaseConnection3 = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
  $records = $databaseConnection3->prepare("SELECT * FROM tbl_users WHERE email=?");
  $records->execute([$email]);

  $results = $records->fetch(PDO::FETCH_ASSOC);
  //Any results indicate that the email address is in the database
  if($results){

    if(password_verify($password, $results['password'])){
      $id = $results['userid'];
      $_SESSION['email'] = $results['email'];
      $_SESSION['name'] = $results['name'];
      $_SESSION['accesslevel'] = $results['accesslevel'];
      $_SESSION['userid']=$id;

          try {
            $databaseConnection4 = new PDO('mysql:host='._HOST_NAME_.';dbname='._DATABASE_NAME_, _USER_NAME_, _DB_PASSWORD);
            $sql = "UPDATE tbl_users SET lastaccess=CURRENT_TIMESTAMP WHERE userid=?";
            //Update the timestamp for this user's last access to the system
            $stmt = $databaseConnection4->prepare($sql);
            //$statement->bindParam (":date", strtotime (date ("Y-m-d H:i:s")), PDO::PARAM_STR);
            $stmt->execute([$id]);

          }
            catch(PDOException $errMsg) {
              echo 'ERROR: ' . $errMsg->getMessage();
            }
            include('addorder.php');
          }
          else{
                $errMsg .= 'Password does not match this email address, please verify your entry<br>';
              }
//We're going to clear out the previous db connection, results and sql statement

}else{
  //lets add the user to the database
  header('location:createuser.php');
  }
}//end of isset check

include("header.php");
if(isset($errMsg)){
  echo "  <div id='message1' class=' alert alert-warning alert-dismissable' style='  margin-top:-1000px;overflow: hidden;position: fixed;
   width: 50%;margin-left:25%;opacity: 0.9;z-index: 1050;transition: all 1s ease;margin-top: 1px;'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
    <strong>Warning!</strong> ".$errMsg."
  </div>";
}
?>


  <!-- Navigation -->
  <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
  <nav id="sidebar-wrapper">
    <ul class="sidebar-nav">
      <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
      <li class="sidebar-brand">
        <a href="#top"  onclick = $("#menu-close").click(); >What we do</a>
      </li>
      <li>
        <a href="login.php" class="bg-default btn-dark" onclick = $("#menu-close").click(); >LOGIN</a>
      </li>
      <li>
        <a href="#top" onclick = $("#menu-close").click(); >Home</a>
      </li>
      <li>
        <a href="#about" onclick = $("#menu-close").click(); >About</a>
      </li>
      <li>
        <a href="#services" onclick = $("#menu-close").click(); >Services</a>
      </li>
      <li>
        <a href="#portfolio" onclick = $("#menu-close").click(); >Portfolio</a>
      </li>
      <li>
        <a href="#order" onclick = $("#menu-close").click(); >Place an order!</a>
      </li>
      <li>
        <a href="#contact" onclick = $("#menu-close").click(); >Contact</a>
      </li>
    </ul>
  </nav>

  <!-- Header -->
  <header id="top" class="header">
    <div class="text-vertical-center" style="color: #fff;text-shadow: 2px 2px #0f0f00;">
      <h1>What we do</h1>
      <h3>See how our photos will make your memories more memorable</h3>
      <br>
      <a href="#about" class="btn btn-dark btn-lg">Find Out More</a>
    </div>
  </header>

  <!-- About -->
  <section id="about" class="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2>We make memories</h2>
          <p class="lead">This page features some of our amazing photography.</p>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>

  <!-- Services -->
  <!-- The circle icons use Font Awesome's stacked icon classes. For more information, visit http://fontawesome.io/examples/ -->
  <section id="services" class="services bg-primary">
    <div class="container">
      <div class="row text-center">
        <div class="col-lg-10 col-lg-offset-1">
          <h2>Our Services</h2>
          <hr class="small">
          <div class="row">
            <div class="col-md-3 col-sm-6">
              <div class="service-item">
                <span class="fa-stack fa-4x">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-angle-double-down fa-stack-1x text-primary"></i>
                </span>
                <h4>
                  <strong>Manage your Account</strong>
                </h4>
                <p>Access the backend here.</p>
                <a href="login.php" class="btn btn-light">Dig deeper.</a>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="service-item">
                <span class="fa-stack fa-4x">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-camera fa-stack-1x text-primary"></i>
                </span>
                <h4>
                  <strong>Picture Taking</strong>
                </h4>
                <p>Native americans used to think pictures stole souls.</p>
                <a href="#" class="btn btn-light">Ours do</a>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="service-item">
                <span class="fa-stack fa-4x">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-compass fa-stack-1x text-primary"></i>
                </span>
                <h4>
                  <strong>The right place</strong>
                </h4>
                <p>We will find you, and when we do.... Take your picture.</p>
                <a href="#" class="btn btn-light">Learn More</a>
              </div>
            </div>
            <div class="col-md-3 col-sm-6">
              <div class="service-item">
                <span class="fa-stack fa-4x">
                  <i class="fa fa-circle fa-stack-2x"></i>
                  <i class="fa fa-eyedropper fa-stack-1x text-primary"></i>
                </span>
                <h4>
                  <strong>Eyedrops</strong>
                </h4>
                <p>We will put in eyedrops if you need us to, because we like eyes... give us your eyes.</p>
                <a href="#" class="btn btn-light">Learn More</a>
              </div>
            </div>
          </div>
          <!-- /.row (nested) -->
        </div>
        <!-- /.col-lg-10 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>

  <!-- Callout -->
  <aside class="callout">
    <div class="text-vertical-center" style="color: #fff;text-shadow: 2px 2px #0f0f00;">
      <h1>Apparently this is something we take photos of</h1>
    </div>
  </aside>

  <!-- Portfolio -->
  <section id="portfolio" class="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 col-lg-offset-1 text-center">
          <h2>Our Work</h2>
          <hr class="small">
          <div class="row">
            <div class="col-md-6">
              <div class="portfolio-item">
                <a href="#">
                  <img class="img-portfolio img-responsive" src="img/portfolio-1.jpg">
                </a>
              </div>
            </div>
            <div class="col-md-6">
              <div class="portfolio-item">
                <a href="#">
                  <img class="img-portfolio img-responsive" src="img/portfolio-2.jpg">
                </a>
              </div>
            </div>
            <div class="col-md-6">
              <div class="portfolio-item">
                <a href="#">
                  <img class="img-portfolio img-responsive" src="img/portfolio-3.jpg">
                </a>
              </div>
            </div>
            <div class="col-md-6">
              <div class="portfolio-item">
                <a href="#">
                  <img class="img-portfolio img-responsive" src="img/portfolio-4.jpg">
                </a>
              </div>
            </div>
          </div>
          <!-- /.row (nested) -->
          <a href="#" class="btn btn-dark">View More Items</a>
        </div>
        <!-- /.col-lg-10 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
  </section>

  <!-- Call to Action -->
<section id="order" class="order">
  <aside class="call-to-action bg-primary" >
    <div class="container">

      <!-- Modal -->
      <div class="modal fade" id="myModalNorm" tabindex="-1" role="dialog"
           aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" style="color: #000000 !important;">
              <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header">
                      <button type="button" class="close"
                         data-dismiss="modal" style="color: #000000 !important;">
                             <span aria-hidden="true">&times;</span>
                             <span class="sr-only">Close</span>
                      </button>
                      <h4 class="modal-title" style="color: #000000 !important;" id="myModalLabel">
                          Order Inquiry
                      </h4>
                  </div>

                  <!-- Modal Body -->
                  <div class="modal-body">
                    <h4 class="modal-title" style="color: #000000 !important;" id="myModalLabel">
                        Order Form
                    </h4>
                      <form action="" method="post">
                        <div class="form-group">
                          <label for="inputEmail" style="color: 0f0f0f;">Email address</label>
                            <input type="email" class="form-control" name="inputEmail"
                            id="inputEmail" placeholder="Enter email"/>
                        </div>
                        <div class="form-group">
                          <label for="inputPassword" style="color: 0f0f0f;">Password</label>
                            <input type="password" class="form-control" name="inputPassword"
                                id="inputPassword" placeholder="Password"/>
                        </div>

                        <div class="form-group">
                          <label for="serviceRequested" style="color: 0f0f0f;">Service Requested</label>
                            <select class="form-control" name="serviceRequested" id="serviceRequested">
                              <option></option>
                              <?php // Use simple foreach to generate the options
                              foreach($products as $row => $value) {
                                echo "<option value=". $value['id']."> ".$value['name']." </option>";
                               }?>
                              </select>
                        </div>
                        <div class="form-group">
                          <label for="quantity" >Quantity</label>
                            <input type="text" class="form-control" name="quantity"
                            id="quantity" placeholder="Enter a quantity"/>
                        </div>
                        <div class="form-group">
                          <label for="dateRequested" >Date for service requested</label>
                            <input type="date" class="form-control" name="dateRequested"
                            id="dateRequested" />
                        </div>
                        <div class="form-group">
                          <label for="comments" >Comments</label>
                            <input type="text" class="form-control" name="comments"
                            id="comments" />
                        </div>
                            <input type="hidden" name="question" value="1">
                        <div>&nbsp;
                        </div>
                        <div class="modal-footer">
                        <div class="btn-group">
                          <button type="button" class="btn btn-md btn-default"
                                  data-dismiss="modal" style="margin-right:0;">
                                      Close
                          </button>
                        <button type="submit" name="submit" id="submit" class="btn btn-success"><i class="fa fa-check-square-o"></i> Submit</button>
                      </div>
                    </form>
                  </div>


                  <!-- Modal Footer -->
                  <!-- <div class="modal-footer">
                    <div class="btn-group">
                      <button type="button" class="btn btn-md btn-default"
                              data-dismiss="modal" style="margin-right:0;">
                                  Close
                      </button>

                    </div> -->
                  </div>
              </div>
          </div>
      </div>

<div class="row">
  <div class="col-lg-12 text-center">
    <h3>Place an order from here or login!</h3>
    <!-- Button trigger modal -->
    <button class="btn btn-lg btn-gray" style="border-radius: 0 !important; text-shadow: 2px 2px #0f0f00 important!;" data-toggle="modal" data-target="#myModalNorm">
      Order Request Form</button>
    <a href="login.php" class="btn btn-lg btn-dark" style="text-shadow: 2px 2px #0f0f00;">Login!</a>
  </div>
</div>
</div>
</aside>
</section>

<!-- Map -->
<section id="contact" class="map">
  <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d60943.716933666976!2d-94.63984546156684!3d31.624535002893932!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x60920053bc6c3def!2sStephen+F.+Austin+State+University!5e0!3m2!1sen!2sus!4v1448863891364" allowfullscreen></iframe>

  <br />
  <small>
    <a href=""></a>
    <!-- https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A -->
  </small>
</iframe>
</section>

<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-lg-offset-1 text-center">
        <h4><strong>Photography Studio Project</strong>
        </h4>
        <p>1936 North St<br>Nacogdoches, TX 75962</p>
        <ul class="list-unstyled">
          <li><i class="fa fa-phone fa-fw"></i> (936) 468-3401</li>
          <li><i class="fa fa-envelope-o fa-fw"></i>  <a href="mailto:admissions@sfasu.edu" style="color:#5F259F;">admissions@sfasu.edu</a>
          </li>
        </ul>
        <br>
        <ul class="list-inline">
          <li>
            <a href="https://www.facebook.com/sfasu/"><i class="fa fa-facebook fa-fw fa-3x" style="color:#5F259F;"></i></a>
          </li>
          <li>
            <a href="https://twitter.com/sfasu"><i class="fa fa-twitter fa-fw fa-3x" style="color:#5F259F;"></i></a>
          </li>
          <li>
            <a href="https://www.instagram.com/sfa_athletics/"><i class="fa fa-dribbble fa-fw fa-3x" style="color:#5F259F;"></i></a>
          </li>
        </ul>
        <hr class="small">
        <p class="text-muted">Copyright &copy; SFASU CSC425 Project</p>
      </div>
    </div>
  </div>
</footer>

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Custom Theme JavaScript -->
<script>
// Closes the sidebar menu
$("#menu-close").click(function(e) {
  e.preventDefault();
  $("#sidebar-wrapper").toggleClass("active");
});

// Opens the sidebar menu
$("#menu-toggle").click(function(e) {
  e.preventDefault();
  $("#sidebar-wrapper").toggleClass("active");
});

// Scrolls to the selected menu item on the page
$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});
</script>

</body>

</html>
