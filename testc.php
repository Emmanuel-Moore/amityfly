<?php
    $db_conx = mysqli_connect('amityflycom.domaincommysql.com', 'amiy9o_s', 'AmI.284966.4478_9');
    if (!$db_conx) {
        header("location: message.php?msg=Sorry something went wrong.");
        die();
    } else {
        echo 'It works!';
    }
    #mysql_select_db(amityfly);



$sql = "SELECT * FROM users WHERE username='$u' AND activated='1' LIMIT 1";
$user_query = mysqli_query($db_conx, $sql);
$numrows = mysqli_num_rows($user_query);
while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
 $u = $row["firstname"];
}

echo $u;
?>

