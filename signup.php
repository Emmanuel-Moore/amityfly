<?php
include_once("php_includes/check_login_status.php"); include_once("php_includes/sk/sk1.0.php");
if($user_ok == true){
header("location: user.php?u=".$_SESSION["username"]);
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $tle = 'Sign Up'; ?></title>
<?php include_once("php_includes/header/meta_tags.php"); ?>
<script type="text/javascript">
<!--
document.write('<script type=\"text/javascript" src=\"js\/master_javascript_header.js"><\/script>');
//-->
<!--
if (screen.width <= 750) {
document.location = "mobile/index.php";
}
//-->

</script>
 <link href="css/master_stylesheet.css" rel="stylesheet">
</head>
<body onload="showContent()">
<?php include_once("php_includes/header.php"); ?>
<div class="gate_wrapper">
 <?php include_once("php_includes/splash_info.php"); ?>
  <div class="right_wrapper">
    <span class="gate-title">
      <h3>Sign up &#12485;, it'll always be free!</h3>
    </span>
      <div class="modal-body scroll">
        <?php
          $trgt ='target="_blank"';
          $termRd = 'read-me';
          $label = 'lnk_green';
          include_once("php_parsers/sgnForm.php");
          echo $sign_join;
        ?>
      </div>
  </div>
</div>
</body>
</html>

