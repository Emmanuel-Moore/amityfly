<?php 
include_once("php_includes/check_login_status.php"); 
include_once("php_includes/addons/emoji.php"); 
include_once("php_includes/addons/hashtag.php"); 
include_once("php_includes/addons/amphora.php");
include_once("php_includes/addons/url.php"); 

	$sql = "SELECT * FROM users WHERE username='$log_username'";
	$query = mysqli_query($db_conx, $sql);
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $appSex = $row["gender"]; 
    if($appSex == "f"){
    $nusex = "her";
    } else if($appSex == "m"){
    $nusex = "his";
    }
    $userPic = $row["userPic"];
    $nupic = '<img src="../user/'.$log_username.'/'.$userPic.'" alt="'.$log_username.'">';
    if($userPic == NULL){
    $nupic = '<img src="../img/temp/user-pic_1.0.png" alt="'.$log_username.'">';
    }   
	}
    if($user_ok == false){
    $nupic = '<img src="../img/temp/user-pic_1.0.png" alt="'.$log_username.'">';
    }

	$type = preg_replace('#[^a-z]#', '', $_POST['type']);
	$type = mysqli_real_escape_string($db_conx, $type);
	$data_1 = htmlentities($_POST['pcira']);
	$data_1 = mysqli_real_escape_string($db_conx, $data_1);
	$account_name = preg_replace('#[^a-z0-9]#i', '', $_POST['user']);
	$account_name = mysqli_real_escape_string($db_conx, $account_name);

	$sql = "SELECT COUNT(id) FROM users WHERE username='$log_username' LIMIT 1";
	$query = mysqli_query($db_conx, $sql);
	$row = mysqli_fetch_row($query);
	if($row[0] < 1){
	mysqli_close($db_conx);
	echo "$account_no_exist";
	exit();
	}

	$fileName  = $_FILES['pcir']["name"];
	$fileTmpLoc = $_FILES['pcir']['tmp_name'];
	$fileType = $_FILES['pcir']["type"];
	$fileSize = $_FILES['pcir']["size"];

	$fileName = preg_replace('#[^a-z.0-9]#i', '', $fileName); 
	$kaboom = explode(".", $fileName);
	$fileExt = end($kaboom);
	$db_file_name = rand(100000000000,999999999999).".".$fileExt;


	if (preg_match("/\.(gif|psd|tif|jpg|jpeg|png)$/i", $fileName) ) {
		$sqla = "INSERT INTO photos(user, gallery, filename, title, uploaddate) 
				VALUES ('$log_username','Arena Photos','$db_file_name','Uploads',now())";
		$querya = mysqli_query($db_conx, $sqla);
		$data_2 = ''.$data_1.' <img src="../user/'.$log_username.'/'.$db_file_name.'"/>';

	}

	else if (preg_match("/\.(flv|m4v|mov|mpeg|avi|mp4|wmv|mpg)$/i", $fileName) ) {
		$sqlb = "INSERT INTO videos(user, filename, title, uploaddate) 
				VALUES ('$log_username','$db_file_name','Uploads',now())";
		$queryb = mysqli_query($db_conx, $sqlb);
		$data_2 = ''.$data_1.' 
		<video class="" controls preload="none" width="100%" height="auto" data-setup="{}">
			<source src="../user/'.$log_username.'/'.$db_file_name.'" type="video/mp4">
		</video>';
	}

	else if (preg_match("/\.(m4a|mp3|mpa|wav|wma)$/i", $fileName) ) {
		$sqlc = "INSERT INTO audio(user, filename, title, uploaddate) 
				VALUES ('$log_username','$db_file_name','Uploads',now())";
		$queryc = mysqli_query($db_conx, $sqlc);
		$data_2 = ''.$data_1.' 
		<audio controls>
			<source src="../user/'.$log_username.'/'.$db_file_name.'" type="audio/mpeg">
		</audio> ';
	}

	else if (preg_match("/\.(doc|docx|rtf|txt)$/i", $fileName) ) {
		$sqld = "INSERT INTO textf(user, filename, title, uploaddate) 
				VALUES ('$log_username','$db_file_name','Uploads',now())";
		$queryd = mysqli_query($db_conx, $sqld);
		$data_2 = ''.$data_1.' <img src="../user/'.$log_username.'/'.$db_file_name.'"/>';
	}

	$sql = "INSERT INTO status(account_name, author, type, data, postdate) 
	VALUES('$log_username','$log_username','$type','$data_2',now())";
	$query = mysqli_query($db_conx, $sql);
	$id = mysqli_insert_id($db_conx);

	mysqli_query($db_conx, "UPDATE status SET osid='$id' WHERE id='$id' LIMIT 1");

	$sql = "SELECT COUNT(id) FROM status WHERE author='$log_username' AND type='$type'";
	    $query = mysqli_query($db_conx, $sql); 
	$row = mysqli_fetch_row($query);
	if ($row[0] > 9) { 
	$sql = "SELECT id FROM status WHERE author='$log_username' AND type='$type' ORDER BY id ASC LIMIT 1";
	    $query = mysqli_query($db_conx, $sql); 
	$row = mysqli_fetch_row($query);
	$oldest = $row[0];
	mysqli_query($db_conx, "DELETE FROM status WHERE osid='$oldest'");
	}
	$friends = array();
	$query = mysqli_query($db_conx, "SELECT user1 FROM friends WHERE user2='$log_username' AND accepted='1'");
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) { array_push($friends, $row["user1"]); }
	$query = mysqli_query($db_conx, "SELECT user2 FROM friends WHERE user1='$log_username' AND accepted='1'");
	while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) { array_push($friends, $row["user2"]); }
	for($i = 0; $i < count($friends); $i++){
	$friend = $friends[$i];
	$app = "Status Post";
	$note = '
	<div class="noteApp">
	  <a href="user.php?u='.$account_name.'#status_'.$id.'">'.$nupic.'</a>
	  <span class="noteTxt">
	    <a href="user.php?u='.$account_name.'#status_'.$id.'">'.$log_username.'</a> 
	    posted on 
	    <a href="user.php?u='.$account_name.'#status_'.$id.'">'.$account_name.'&#39;s page</a> '.$nudate.'.
	  </span>
	</div>
	';

	mysqli_query($db_conx, "INSERT INTO notifications(username, initiator, app, note, date_time) VALUES('$friend','$log_username','$app','$note',now())");	
	}

	$moveResult = move_uploaded_file($fileTmpLoc, "user/$log_username/$db_file_name");
	if ($moveResult != true) {
	echo "error!";
	exit();
	}

/* echo output for ajax */
$data_2 = formatUrlsInText($data_2);
$data_2 = convertHashtags($data_2);
$data_2 = emoticons($data_2);
$data_2 = nl2br($data_2);
$data_2 = str_replace("&amp;","&",$data_2);
$data_2 = stripslashes($data_2);

$sql = "SELECT *, userPic
		FROM users WHERE username = '$log_username'";

$query = mysqli_query($db_conx, $sql);
$statusnumrows = mysqli_num_rows($query);
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
$userPic = $row["userPic"];
$user_image = '<img src="../user/'.$log_username.'/'.$userPic.'" alt="'.$log_username.'">';
if($userPic == NULL){
$user_image = '<img src="../img/temp/user-pic_1.0.png" alt="'.$log_username.'">';
}
}
$shBtn = ""; 
$lkBtn = "";
$vwBtn = "";
$lkBtn = '<span class="lKs"> Like 0 </span>'; 
$shBtn = '<span class="sHs"> Share 0 </span>'; 
$vwBtn = '<span class="vWs">views 0 </span>'; 
$sdBtn = '<div class="pmu"><span class="post_set">&#8226; &#8226; &#8226;</span></div>';

echo '
<div id="status_'.$spid.'" class="post_content">
  '.$sdBtn.'
  <div class="post_content-header">
    <span class="post_pic">
      <a href="user.php?u='.$log_username.'">'.$user_image.'</a>
    </span>
    <span class="post_name mf_2">
      <a href="user.php?u='.$log_username.'">'.$log_username.'</a> '.$v.'
    </span>
    <span class="post_date">just now</span>
      <p class="post_content-inner-txt">
      '.$data_2.'
      </p>
  </div>
  <div class="post_content-inner">
    '.$lkBtn.' 
    '.$shBtn.'
    '.$vwBtn.'
        <div class="cmnts-wrap">
          <span class="cnt_display-c">0</span>
          <span class="cmnt-btn" note2="view comments"></span>
        </div>
    </div>
  <div id="statusui" class="reply_wrapper">
    <div class="reply_cnt-inner">
        <textarea id="replytext_'.$spid.'" class="reply-content comment-insert-text" onkeyup="statusMax(this,250)" placeholder="Want to comment '.$log_username.'?"></textarea>
        <div class="post_btn_wrp bmf_1">
            <span id="replyBtn_'.$spid.'" class="post-btn" onclick="replyToStatus('.$spid.',\''.$u.'\',\'replytext_'.$spid.'\',this)">post</span>
        </div>
    </div>
  </div>
</div>
';
mysqli_close($db_conx);
exit();
?>