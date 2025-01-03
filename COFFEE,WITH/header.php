<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
    if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $userlevel = "";
    if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
    else $userpoint = "";
?>		
<div id="top">
    <div>
        <a href="index.php">
            <img class="title" src="./img/logo.png">
        </a>
    </div>
    <div>
    <ul id="top_menu">  
<?php
    if(!$userid) {
?>                
        <li><a href="member_form.php" class="signInLogin">Sign In</a> </li>
        <li><a href="login_form.php" class="signInLogin">Login</a></li>
<?php
    } else {
        $logged = $username."(".$userid.")님 [Level:".$userlevel.", Point:".$userpoint."]";
?>
        <li><?=$logged?> </li>
        <li> | </li>
        <li><a href="logout.php">Log Out</a> </li>
        <li> | </li>
        <li><a href="member_modify_form.php">Edit Profile</a></li>
<?php
    }
?>
<?php
    if($userlevel==1) {
?>
        <li> | </li>
        <li><a href="admin.php">Admin</a></li>
<?php
    }
?>
    </ul>
    </div>
</div>
<div class='menu_bar'>
    <div id="menu_bar">
        <div class="dropdown">
            <div class="dropdown-button">ABOUT US</div>
            <div class="dropdown-content">
                <a href="aboutus.php">기업 소개</a>
            </div>
        </div>
        <div class="dropdown">
            <div class="dropdown-button">MENU</div>
            <div class="dropdown-content">
                <a>커피</a>
                <a>베이커리</a>
            </div>
        </div>
        <div class="dropdown">
            <div class="dropdown-button">BOARD</div>
            <div class="dropdown-content">
                <a href="board_list.php">목록보기</a>
                <a href="#" onclick="checkLogin1()">글 쓰기</a>
            </div>
        </div>
        <div class="dropdown">
            <div class="dropdown-button">STAMP</div>
            <div class="dropdown-content">
                <!-- JavaScript를 활용하여 로그인 여부 체크 -->
                <a href="#" onclick="checkLogin2()">STAMP</a>
            </div>
        </div>
        <div class="dropdown">
            <div class="dropdown-button">NOTICE</div>
            <div class="dropdown-content">
                <a>공지사항</a>
                <a>이벤트</a>
            </div>
        </div>
    </div>
</div>

<script>
    function checkLogin1() {
        <?php if (!$userid) { ?>
            alert("로그인 후 이용해 주세요.");
            location.href = "login_form.php";
        <?php } else { ?>
            location.href = "board_form.php";
        <?php } ?>
    }
    function checkLogin2() {
        <?php if (!$userid) { ?>
            alert("로그인 후 이용해 주세요.");
            location.href = "login_form.php";
        <?php } else { ?>
            location.href = "stamp.php";
        <?php } ?>
    }
</script>
