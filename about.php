<?php include_once("php_includes/check_login_status.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $tle = 'About'; ?></title>
    <?php include_once("php_includes/header/meta_tags.php"); ?>
    <script type="text/javascript">
    <!--
    document.write('<script type=\"text/javascript" src=\"js\/master_javascript_header.js"><\/script>');
    // -->
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
      <nav id="nav-sb" class="primary clearfix">
        <ul id="nav">
          <a href="#about"><li>About</li></a>
          <a href="#Security"><li>Security</li></a>

          <li><a href="#">Profile <span class="nav-drop flashit">&#8269;</span></a>
            <ul>
              <li><a href="#">connections</a></li>
              <li><a href="#">notifications</a></li>
              <li><a href="#">profile photo</a></li>
              <li><a href="#">photos</a></li>
              <li><a href="#">Messages</a></li>
              <li><a href="#">username</a></li>
              <li><a href="#">verified</a></li>
              <li><a href="#">tagline</a></li>
              <li><a href="#">feedback</a></li>
              <li><a href="#">alerts</a></li>
              <li><a href="#">views</a></li>
              <li><a href="#">block</a></li>
              <li><a href="#">delete</a></li>
            </ul>
          </li>

          <li><a href="#emoticons">Emoticons</a></li>

          <a href="#search"><li>Search</li></a>

          <li><a href="#">Arena <span class="nav-drop flashit">&#8269;</span></a>
            <ul>
              <li><a href="#">profile photo</a></li>
              <li><a href="#">private post</a></li>
              <li><a href="#">hide/unhided</a></li>
              <li><a href="#">(URL)'s / links</a></li>
              <li><a href="#">upload photos</a></li>
              <li><a href="#">text</a></li>
              <li><a href="#">hashtags</a></li>
              <li><a href="#">commenting</a></li>
              <li><a href="#">like</a></li>
            </ul>
          </li>


          <a href="#trends"><li>Trends</li></a>
          <a href="#news"><li>News</li></a>
        </ul>
      </nav>
    <script type="text/javascript">
    $(document).ready(function () {

    var $dropDown = $('nav#nav-sb ul li ul');
        $dropDown.addClass("drop");

    var $trig = $('nav#nav-sb ul');
        $trigger = $trig.find('a'),
        $trigger.click(function () {

          $(this).next('ul').slideToggle();


          });

    });
    </script>
    <?php include_once("php_includes/footer.php"); ?>
  </div>
</div>
  <div class="main_CNTR-a">
    <div class="set_view">
      <?php include_once("php_includes/content/abtCnt.php"); ?>
    </div><!-- tab end -->
  </div>
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

