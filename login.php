<?php
   SESSION_START(); 

   if (isset($_SESSION['id'])) {
     header("Location: dashboard/");
   }
?>

<!DOCTYPE html>
<html>
<head>
	<title> www.24opsions.com </title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<meta name="description" content="">
  	<meta name="author" content="">
  	<link rel="icon" href="favicon.ico">


	<!-- bootstrap styles -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- custom styles -->
	<link rel="stylesheet" href="css/style.css?v=<?php echo date('H:i'); ?>">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
	<!-- fonts -->
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

</head>
<body data-spy="scroll" data-target="#navbar" data-offset="30">


	<nav class="navbar navbar-expand-md navbar-light fixed-top bg-white">
      <!-- <a class="navbar-brand" href="#">Carousel</a> -->
      <a class="navbar-brand" href="index.php">
             <img src="images/24.jpg" class="img-fluid" alt="logo"> 
      <!-- <font color="gold" size="10"><strong>www.24opsions.com</strong></font> -->
      </a> 

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
          
          

          <li class="nav-item"> 
              <a class="nav-link" href="signup.php"> Register </a> 
          </li>

        </ul>
        

      </div>
    </nav>

     <p class="space" style="margin-top: 90px"></p>
<?php
  include('includes/conn.php');


  $email = $password = "";
  $erremail = $errpass = "";
  $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $post['email'];
    $pass  = $post['pass'];

    if (empty($email)) {
      $erremail = 'Please enter your Email address';
    } elseif (empty($pass)) {
      $errpass = 'Please enter your password';
    } else {
      $sql = "SELECT email FROM users WHERE email = :email";
      $conn->query($sql);
      $conn->bind(':email', $email);
      $num_row = $conn->numrow();

      if ($num_row < 1) {
        $erremail = 'the email does not exist';
      } else {
        $sql = "SELECT password FROM users WHERE email = :email";
        $conn->query($sql);
        $conn->bind(':email', $email);
        $row = $conn->fetch_one(); 
        $hashpass = PASSWORD_VERIFY($pass, $row['password']);

        if ($hashpass == false) {
          $errpass = 'Password is incorrect';
        } elseif ($hashpass == true) {
          $sql = "SELECT id FROM users WHERE email = :email";
          $conn->query($sql);
          $conn->bind(':email', $email);
          $row = $conn->fetch_one(); 
         

         $_SESSION['id']    = $row['id'];
          
          header("Location: dashboard/");


        }
    }
  }
}

?>



	<div class="container" align="center">

      <form class="form-signin" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
	      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

	      <div class="form-group">
	      	<label for="inputEmail">Email address <?php echo ' *'.$erremail; ?> </label>
	      	<input value="<?php echo $email; ?>" type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required>
	      </div>

	      <div class="form-group">
	      	<label for="inputPassword">Password <?php echo ' *'.$errpass; ?></label>
	      	<input type="password" name="pass" id="inputPassword" class="form-control" placeholder="Password" required>
	      </div>
	      
	      
	      <div class="checkbox mb-3">
	        <label>
	          <input type="checkbox" value="remember-me"> Remember me
	        </label>
	      </div>
	      <button class="btn btn-lg btn-primary btn-block"> Sign in </button>
	      <p class="mt-5 mb-3 text-muted">&copy; 24Opsions All rights Reserve 2017-2018 </p>
	    </form>
    </div>
 <hr>
 <div class="row">
            <div class="col-sm-12" align="center">
                <img src="images/deutsche.png" class="footerimg" width="120" height="40">
                <img src="images/ssl.png" class="footerimg" width="120" height="40">
                <img src="images/reuters.png" class="footerimg" width="120" height="40">
                <img src="images/dowjones.png" class="footerimg" width="120" height="40">
                <img src="images/18.png" class="footerimg" width="40" height="40">
                <img src="images/nasdaq.png" class="footerimg" width="120" height="40">
                <img src="images/london.png" class="footerimg" width="120" height="40"> 
                <img src="images/visa.png" class="footerimg" width="120" height="40">
                <img src="images/banking_01.png" class="footerimg" width="120" height="40">
            </div>
        </div>
        <hr>
  <div class="social-links" align="center">
          <a href="https://www.twitter.com/24opsions"> <i class="fa fa-twitter"></i> </a>
          <a href="https://www.facebook.com/24opsions"> <i class="fa fa-facebook"></i> </a>
          <a href="https://api.whatsapp.com/send?phone=+2347038844650"> <i class="fa fa-whatsapp"></i> </a>
        </div>
        ?>
    <!-- javascript -->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <!-- Plugins JS -->
    <script src="js/owl.carousel.min.js"></script>
  <!-- Custom JS -->
  <script src="js/script.js"></script>
</body>
</html>