<?php
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}
session_start();
if (isset($_SESSION['username'])) {
    header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="../css/main.css" rel="stylesheet" media="screen">
    <!-- keyboard widget css & script -->
    <link href="/css/keyboard.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <?php
//Detect special conditions devices
$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");

//do something with this information
if( $iPod || $iPhone || $iPad){
    ?>
<script src="/js/jquery.keyboard.js"></script>
<!-- css for the preview keyset extension -->
<link href="/css/keyboard-previewkeyset.css" rel="stylesheet">

<!-- keyboard optional extensions - include ALL (includes mousewheel) -->
<script src="/js/jquery.keyboard.extension-all.js"></script>
<script src="/js/hex.js"></script>
    <?php
}
?>


      <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111454242-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-111454242-1');
</script>

  </head>

  <body>
    <div class="container">
      <div class="row">
      <div class="col-sm-7">
  <div style="display: block;
    margin-left: auto;
    margin-right: auto;
    width: 70%;">
	  <img src="/images/penmenpridelogo.png" alt="Penmen Pride Logo" style="width: 100%">
  </div>
    <div style="display: block;
      margin-left: auto;
      margin-right: auto;
      width: 85%;
      text-align:center;
      border: 2px solid red;
      background-color: rgba(201, 76, 76, 0.2);
   border-radius: 8px;
   margin-top: 10px;">
    <h3 style="margin-top: 10px;">Notice:</h3>
<p>You have reached the restricted area for approved users of the SNHU Student Government Penmen Pride Committee. All activity on this site is logged and is limited to specific current employees of SNHU and specific students of SNHU. Inappropriate use, including but not limited to access by unauthorized individuals will be pursued to the fullest extent of the law. If you require access to this site, please contact <a href="mailto:sga@snhu.edu">SGA</a>.</p>
	  </div>
  </div>
	  <div class="col-sm-5">


      <form class="form-signin" name="form1" method="post" action="checklogin.php">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input name="myusername" id="myusername" type="text" class="form-control" placeholder="Username" autofocus>
<?php if( $iPod || $iPhone || $iPad){ ?>
  <br> <br> <br> <br> <br> <br> <br> <br>
<?php } ?>
        <input name="mypassword" id="mypassword" type="password" class="form-control" placeholder="Password">
        <?php if( $iPod || $iPhone || $iPad){ ?>
          <br> <br> <br> <br> <br> <br> <br> <br>
        <?php } ?>
        <!-- The checkbox remember me is not implemented yet...
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        -->
        <button name="Submit" id="submit" class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	    <a href="signup.php" name="Sign Up" id="signup" class="btn btn-lg btn-primary btn-block" type="submit">Create new account</a>

        <div id="message"></div>
      </form>

    </div> <!-- /container -->
</div>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-2.2.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- The AJAX login script -->
    <script src="js/login.js"></script>

  </body>
</html>
