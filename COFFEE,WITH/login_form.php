<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>COFFEE, WITH</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/login.css">
<script type="text/javascript" src="./js/login.js"></script>
</head>
<body> 
	<header>
    	<?php include "header.php";?>
    </header>
	<section class='login_form'>
        <div id="main_content">
      		<div id="login_box">
	    		<div id="login_title">로그인</div>
	    		<div id="login_form">
					<div class="login_form_title" >Welcome! COFFEE, WITH에 오신 것을 환영합니다.</div>
					<form  name="login_form" method="post" action="login.php">		       	
						<ul>
						<li><input type="text" name="id" placeholder="아이디" ></li>
						<li><input type="password" id="pass" name="pass" placeholder="비밀번호" ></li> <!-- pass -->
						</ul>
						<div id="login_btn">
							<a href="#"><div class="login_btn" onclick="check_input()">LOG IN</div></a>
						</div>		    	
					</form>
        		</div> <!-- login_form -->
    		</div> <!-- login_box -->
        </div> <!-- main_content -->
	</section> 
	<footer>
    	<?php include "footer.php";?>
    </footer>
	<script src="./js/dropdown.js"></script>
</body>
</html>

