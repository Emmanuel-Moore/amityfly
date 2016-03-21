<?php include_once("php_includes/check_login_status.php"); ?>

<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $tle = 'Search'; ?></title>
    <?php include_once("php_includes/meta_tags.php"); ?>
    <script type="text/javascript">
    <!--
    document.write('<script type=\"text/javascript" src=\"js\/master_javascript_header.js"><\/script>');
    //-->
    </script>
      <script src="code.jquery.com/jquery-1.10.2.js"></script>
  <script src="code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
    <script type="text/javascript">
 	 function s1(){
       $('#sc_1').show(400);
       $('#sc_2').show(400);
       $('#sc_3').show(400);
	}
	function s2(){
       $('#sc_1').show(400);
       $('#sc_2').hide(400);
       $('#sc_3').hide(400);
	}
	function s3(){
       $('#sc_1').hide(400);
       $('#sc_2').show(400);
       $('#sc_3').hide(400);
	}
	function s4(){
       $('#sc_1').hide(400);
       $('#sc_2').hide(400);
       $('#sc_3').show(400);
	}
	</script>
    <link href="css/master_stylesheet.css" rel="stylesheet">
    <link href="css/master_stylesheet_user.css" rel="stylesheet">
  </head>
<body onload="showContent()">
<?php
include_once("php_includes/header.php");
include_once("php_includes/addons/nuMc.php");
include_once("php_includes/addons/emoji.php");
include_once("php_includes/addons/hashtag.php");
include_once("php_includes/addons/url.php");
$dlgBox = '
<div id="dialogbox">
	<div id="dialogboxhead"></div>
	<div id="dialogboxbody"></div>
	<div id="dialogboxfoot"></div>
</div>';
echo ''.$dlgBox.''.$promote_form.''.$rf.'';
?>
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
	      <nav id="nav-sb" class="primary clearfix">
	        <ul id="nav">
				<li><a onclick="s1()">everything</a></li>
				<li><a onclick="s2()">people</a></li>
				<li><a onclick="s3()">post</a></li>
				<li><a onclick="s4()">photos</a></li>
	        </ul>
	      </nav>
	    <?php include_once("php_includes/footer.php"); ?>
	  </div>
	</div>
<div class="main_CNTR-a">
	<div id='sc_1'>
		<?php include_once("search/logic/user_sc.php"); ?>
	</div>
	<div id='sc_2'>
		<?php include_once("search/logic/post_sc.php"); ?>
	</div>
	<div id='sc_3'>
		<?php include_once("search/logic/photo_sc.php"); ?>
	</div>
</div>
  <?php
  $margin ='mc-inner_side';
  include_once("php_includes/sidebar/sd_cnt-RGT.php"); ?>
 </div>
<script type="text/javascript">
<!--
document.write('<script type=\"text/javascript" src=\"js\/master_javascript_footer.js?t=<?php echo time(); ?>\">"><\/script>');
// -->
</script>
</body>
</html>

