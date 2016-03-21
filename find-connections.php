<?php
include_once("php_includes/check_login_status.php");
include_once("php_includes/addons/nuMc.php");
include_once("php_includes/addons/emoji.php");
include_once("php_includes/addons/hashtag.php");
include_once("php_includes/addons/url.php");
include_once("php_parsers/time_system.php");
if(isset($_SESSION['username'])){
	$u = $_SESSION['username'];
} else {
    header("location: http://www.greenheartpt.co.nf/");
    exit();
}
$moMoFriends = "";
$my_friends = array();
$their_friends = array();
$sql = "SELECT user1, user2
		FROM friends
		WHERE (user1='$u' OR user2='$u')
		AND accepted='1'";
$query = mysqli_query($db_conx, $sql);
$numrows = mysqli_num_rows($query);
if ($numrows > 0){
	while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
		array_push($my_friends, $row["user2"]);
		array_push($my_friends, $row["user1"]);
	}
	//remove your id from array
	$my_friends = array_diff($my_friends, array($u));
	//reset the key values
	$my_friends = array_values($my_friends);
	mysqli_free_result($query);
}
// Get Friends Of Friends Array
// Exclude Yourself From Query
foreach ($my_friends as $k => $v) {
	// You may want to edit limit at end of following query ....example... LIMIT 50
	$sql = "SELECT user1, user2
			FROM friends
			WHERE (user1='$v' OR user2='$v')
			AND accepted='1'
			AND user1!='$u'
			AND user2!='$u'
			LIMIT 20";
	$query = mysqli_query($db_conx, $sql);
	$numrows = mysqli_num_rows($query);
	if ($numrows > 0){
		while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			array_push($their_friends, $row["user2"]);
			array_push($their_friends, $row["user1"]);
		}
	}
	//remove any duplicates
	$their_friends = array_unique($their_friends);
	// remove common friends
	//$their_friends = array_diff($their_friends, $my_friends);
	// reset array values
	//$their_friends = array_values($their_friends);
	//mysqli_free_result($query);
}
// Build Output From Results
if (array_key_exists('0', $their_friends)){
	foreach ($their_friends as $k2 => $u2){
		$query = mysqli_query($db_conx, "SELECT * FROM users WHERE username='$u2'LIMIT 1");
		while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
			$u2 = $row ['username'];
			$fname = $row ['firstname'];
			$lname = $row ['lastname'];
			$up = $row ['userPic'];
			$v = $row["verified"];
			if($v == "y"){
			$v = '<div class="verified" title="verified">&#x2713;</div>';
			} else {
				$v = '';
			}
			$lastsession = $row ['lastlogin'];
			$lastsession = time_elapsed_string($lastsession);
			$c = $row["country"];
			$l = $row["location"];
			if($l == TRUE){
				$l = $row["location"]; $c = '';
			}
			elseif($l == NULL){
				$c = $row["country"]; $l = '';
			}
			// profile pic
			$profile_pic = '<img src="../user/'.$u2.'/'.$up.'" alt="'.$u2.'">';
			if($up == NULL){
			$profile_pic = '<img src="../img/temp/user-pic_1.0.png" alt="'.$user1.'">';
			}
			$moMoFriends .= '
			<div class="user_cont">
				<a href="user.php?u='.$u2.'">
					<span class="user_sr_pic">'.$profile_pic.'</span>
					<span class="user_sr_name">'.$fname.' '.$lname.' '.$u2.' '.$v.'<br/>
					<span class="user_sr_cntry">'.$c.' '.$l.'</span></span>
					<span class="date">'.$lastsession.'</span>
				</a>
			</div>

			';
		}
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $tle = 'Find Connections'; ?></title>
    <?php include_once("php_includes/meta_tags.php"); ?>
    <script type="text/javascript">
    <!--
    document.write('<script type=\"text/javascript" src=\"js\/master_javascript_header.js"><\/script>');
    //-->
    </script>
    <link href="css/master_stylesheet.css" rel="stylesheet">
    <link href="css/master_stylesheet_user.css" rel="stylesheet">
  </head>
<body onload="showContent()">
<?php
include_once("php_includes/header.php");
$dialogbox = '
<div id="dialogbox">
	<div id="dialogboxhead"></div>
	<div id="dialogboxbody"></div>
	<div id="dialogboxfoot"></div>
</div>';
echo ''.$dialogbox.''.$rf.'';
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

	    <?php include_once("php_includes/footer.php"); ?>
	  </div>
	</div>
<div class="main_CNTR-a">
	<div id="moMoFriends">
		<div class="hdrTitle">Connections You May Like</div></br>
		<?php echo $moMoFriends ?>
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

