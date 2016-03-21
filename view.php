<?php
include_once("php_includes/check_login_status.php");
include_once("php_parsers/time_system.php");
include_once("php_includes/addons/nuMc.php");
include_once("php_includes/addons/emoji.php");
include_once("php_includes/addons/hashtag.php");
include_once("php_includes/addons/amphora.php");
include_once("php_includes/addons/url.php");
if(isset($_GET ['pid'])){
  if(!isset($_GET ['pid'])){exit();}
  $_GET ['pid'] = preg_replace('#[^0-9]#i', '', $_GET ['pid']);
  $_GET ['pid'] = mysqli_real_escape_string($db_conx, $_GET ['pid']);
  include_once("php_includes/content/u/vaCnt.php");
} else if(isset($_GET ['vpa'])){
  if(!isset($_GET ['vpa'])){exit();}
  $_GET ['vpa'] = preg_replace('#[^0-9]#i', '', $_GET ['vpa']);
  $_GET ['vpa'] = mysqli_real_escape_string($db_conx, $_GET ['vpa']);
  include_once("php_includes/content/u/vbCnt.php");
} else if(isset($_GET ['via'])){
  if(!isset($_GET ['via'])){exit();}
  $_GET ['via'] = preg_replace('#[^0-9]#i', '', $_GET ['via']);
  $_GET ['via'] = mysqli_real_escape_string($db_conx, $_GET ['via']);
  include_once("php_includes/content/u/vcCnt.php");
} else if(isset($_GET ['fla'])){
  if(!isset($_GET ['fla'])){exit();}
  $_GET ['fla'] = preg_replace('#[^0-9]#i', '', $_GET ['fla']);
  $_GET ['fla'] = mysqli_real_escape_string($db_conx, $_GET ['fla']);
  include_once("php_includes/content/u/vdCnt.php");
} else {
  $aP = 'Something went wrong :(';
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>View</title>
    <?php include_once("php_includes/meta_tags.php"); ?>
    <script type="text/javascript">
    <!--
    document.write('<script type=\"text/javascript" src=\"js\/master_javascript_header.js"><\/script>');
    //-->
    </script>
    <link href="css/master_stylesheet.css" rel="stylesheet">
    <link href="css/master_stylesheet_user.css" rel="stylesheet">
    <link href="css/va.css" rel="stylesheet">
  </head>
<body onload="showContent()">
<?php
include_once("php_includes/header.php");
$dBox = '
<div id="dialogbox">
  <div id="dialogboxhead"></div>
  <div id="dialogboxbody"></div>
  <div id="dialogboxfoot"></div>
</div>';
echo ''.$dBox.''.$rf.''.$pFrm.''; ?>
?>
<div class="vFup">
<div class="vFup">
	<div class="main_LFT-a">
	    <a href="user.php?u=<?php echo $log_username; ?>">
	      <span class="user_pic-m_s"><?php echo $hdU_P; ?></span>
	      <span class="user_name-1b_s"><?php echo $log_username; echo $vs; ?></span>
	    </a>
	    <div class="top_panel_s"><?php echo $hdB_N; ?></div>
        <?php echo $fulltag; echo $search; ?>
		<?php include_once("php_includes/footer.php"); ?>
	</div>
</div>
<div class="main_CNTR-a">
	<div class="set_view">
    <?php echo ''.$aP.''.$statuslist.''; ?>
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
<?php mysqli_close($db_conx); exit(); ?>
</body>
</html>

