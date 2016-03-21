<?php
include_once("php_includes/check_login_status.php");
// If the page requestor is not logged in, usher them away
if($user_ok != true || $log_username == ""){
header("location: http://www.greanheartpt.co.nf/");
    exit();
}
$notification_list = "";
$sql = "SELECT * FROM notifications WHERE username LIKE BINARY '$log_username' ORDER BY date_time DESC";
$query = mysqli_query($db_conx, $sql);
$numrows = mysqli_num_rows($query);
if($numrows < 1){
$notification_list = "You do not have any notifications";
} else {
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
$noteid = $row["id"];
$initiator = $row["initiator"];
$app = $row["app"];
$note = $row["note"];
$date_time = $row["date_time"];
$date_time = strftime("%b %d, %Y", strtotime($date_time));
$notification_list .= "<p><a href='user.php?u=$initiator'>$initiator</a> | $app<br />$note</p>";
}
}
mysqli_query($db_conx, "UPDATE users SET notescheck=now() WHERE username='$log_username' LIMIT 1");
?><?php
$friend_requests = "";
$sql = "SELECT * FROM friends WHERE user2='$log_username' AND accepted='0' ORDER BY datemade ASC";
$query = mysqli_query($db_conx, $sql);
$numrows = mysqli_num_rows($query);
if($numrows < 1){
$friend_requests = 'No friend requests';
} else {
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
$reqID = $row["id"];
$user1 = $row["user1"];
$datemade = $row["datemade"];
$datemade = strftime("%B %d", strtotime($datemade));
$thumbquery = mysqli_query($db_conx, "SELECT avatar FROM users WHERE username='$user1' LIMIT 1");
$thumbrow = mysqli_fetch_row($thumbquery);
$user1avatar = $thumbrow[0];
$user1pic = '<img src="user/'.$user1.'/'.$user1avatar.'" alt="'.$user1.'" class="user_pic">';
if($user1avatar == NULL){
$user1pic = '<img src="images/avatardefault.jpg" alt="'.$user1.'" class="user_pic">';
}
$friend_requests .= '<div id="friendreq_'.$reqID.'" class="friendrequests">';
$friend_requests .= '<a href="user.php?u='.$user1.'">'.$user1pic.'</a>';
$friend_requests .= '<div class="user_info" id="user_info_'.$reqID.'">'.$datemade.' <a href="user.php?u='.$user1.'">'.$user1.'</a> requests friendship<br /><br />';
$friend_requests .= '<button onclick="friendReqHandler(\'accept\',\''.$reqID.'\',\''.$user1.'\',\'user_info_'.$reqID.'\')">accept</button> or ';
$friend_requests .= '<button onclick="friendReqHandler(\'reject\',\''.$reqID.'\',\''.$user1.'\',\'user_info_'.$reqID.'\')">reject</button>';
$friend_requests .= '</div>';
$friend_requests .= '</div>';
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Notifications</title>
<?php include_once("php_includes/meta_tags.php"); ?>
<script type="text/javascript">
<!--
document.write('<script type=\"text/javascript" src=\"js\/master_javascript_header.js"><\/script>');
//-->
</script>
<link href="css/master_stylesheet.css" rel="stylesheet">
<link href="css/master_stylesheet_user.css" rel="stylesheet">
</head>
<body>
<?php include_once("php_includes/header.php"); ?>
<div class="main_wrapper-s">
  <div class="main_LFT-a"> 
    <!-- user pic and banner display -->
		<!-- user pic display -->
		<span class="user_pic-m_s">
			<?php echo $profile_pic; ?>
		</span>
		<span class="user_name-1b_s">
			<?php echo $u; ?>
		</span>
		<!-- banner image -->
		<div class="top_panel_s"></div>
	    <!-- nav start -->
	    <div class="nav-sb">
		    <ul id="nav">
		      <li><a href="#" class="active">notifications</a></li>
		      <li><a href="#">friend request</a></li>
		      <li><a href="#">followers</a></li>
		      <li><a href="#">likes</a></li>
		    </ul>
	    </div>
    <!-- footer -->
    <?php include_once("php_includes/footer.php"); ?>
  </div><!-- main left -->
</div><!-- main wrappper -->
  <div class="main_CNTR-a">
    <!-- user settings display-->    
    <div id="tab-content"  class="set_view">
      <div id="tab1 notesBox">
      	<label>notifications</label>
        <?php echo $notification_list; ?>
      </div>
      
      <div id="tab2 riendReqBox">
      	<label>friends</label>
      	<?php echo $friend_requests; ?>
      </div>
      
      <div id="tab3">
      	<label>followers</label>
      </div>
      
      <div id="tab4">
        <label>likes</label>
      </div>
      
    </div><!-- tab end -->
  </div> 
  </div>


  </div>
</div>
</aside>
<!-- end all that matters -->

<script>
$('#tab-content div').hide();
$('#tab-content div:first').show();

$('#nav li').click(function() {
    $('#nav li a').removeClass("active");
    $(this).find('a').addClass("active");
    $('#tab-content div').hide();

    var indexer = $(this).index(); //gets the current index of (this) which is #nav li
    $('#tab-content div:eq(' + indexer + ')').fadeIn(); //uses whatever index the link has to open the corresponding box 
});
</script>
<!-- Master javascript footer -->
<script type="text/javascript">
<!--
document.write('<script type=\"text/javascript" src=\"js\/master_javascript_footer.js?t=<?php echo time(); ?>\">"><\/script>');
// -->
</script>
<script type="text/javascript">
function friendReqHandler(action,reqid,user1,elem){
var conf = confirm("Press OK to '"+action+"' this friend request.");
if(conf != true){
return false;
}
_(elem).innerHTML = "processing ...";
var ajax = ajaxObj("POST", "php_parsers/friend_system.php");
ajax.onreadystatechange = function() {
if(ajaxReturn(ajax) == true) {
if(ajax.responseText == "accept_ok"){
_(elem).innerHTML = "<b>Request Accepted!</b><br />Your are now friends";
} else if(ajax.responseText == "reject_ok"){
_(elem).innerHTML = "<b>Request Rejected</b><br />You chose to reject friendship with this user";
} else {
_(elem).innerHTML = ajax.responseText;
}
}
}
ajax.send("action="+action+"&reqid="+reqid+"&user1="+user1);
}
</script>
</body>
</html>