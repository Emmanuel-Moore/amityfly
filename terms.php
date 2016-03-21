<?php include_once("php_includes/check_login_status.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $tle = 'Terms'; ?></title>
    <?php include_once("php_includes/header/meta_tags.php"); ?>
    <script type="text/javascript">
    <!--
    document.write('<script type=\"text/javascript" src=\"js\/master_javascript_header.js"><\/script>');
    //-->
    </script>
    <link href="css/master_stylesheet.css" rel="stylesheet">
    <link href="css/master_stylesheet_user.css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
  </head>
<body onload="showContent()">
<?php include_once("php_includes/header.php"); ?>
<div class="main_wrapper">
<div class="main_wrapper-s">
  <div class="main_LFT-a">
    <a href="user.php?u=<?php echo $log_username; ?>">
      <span class="user_pic-m_s"><?php echo $hdU_P; ?></span>
      <span class="user_name-1b_s">
        <?php
        if($user_ok == false) {
          $log_username = '';
        } else {
        echo ''.$log_username.' '.$vs.' ';}?>
      </span>
    </a>
    <div class="top_panel_s"><?php echo $hdB_N; ?></div>
    <div id="nav-sb">
      <ul id="nav">
        <a href="#terms"><li>Terms</li></a>
      </ul>
    </div>
    <?php include_once("php_includes/footer.php"); ?>
  </div>
</div>
  <div class="main_CNTR-a">
    <div class="set_view">
      <?php include_once("php_includes/content/termCnt.php"); ?>
    </div><!-- tab end -->
  </div>
  <!----------------------------------------------------------- right side bar ---------------------------------------------------------------------->
  <?php
  $margin ='mc-inner_side';
  include_once("php_includes/sidebar/sd_cnt-RGT.php"); ?>
</div>
<!-- Master javascript footer -->
<script type="text/javascript">
<!--
document.write('<script type=\"text/javascript" src=\"js\/master_javascript_footer.js?t=<?php echo time(); ?>\">"><\/script>');
// -->
</script>
</body>
</html>

