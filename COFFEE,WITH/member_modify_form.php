<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>COFFEE, WITH</title>
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/member.css">
	<script type="text/javascript" src="./js/member_modify.js"></script>
</head>

<body>
	<header>
		<?php include "header.php"; ?>
	</header>
	<?php
	$con = mysqli_connect("localhost", "user1", "12345", "sample");
	$sql = "select * from members where id='$userid'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);

	$pass = $row["pass"];
	$name = $row["name"];

	$email = explode("@", $row["email"]);
	$email1 = $email[0];
	$email2 = $email[1];

	mysqli_close($con);
	?>
	<section class="login_form">
		<div id="main_content">
			<div id="join_box">
				<div id="join_title">정보 수정</div>
				<div id="join_form">
					<form name="member_form" method="post" action="member_modify.php?id=<?= $userid ?>">
						<div class="form id">
							<div class="col1">아이디</div>
							<div class="col2">
								<?= $userid ?>
							</div>
						</div>
						<div class="clear"></div>

						<div class="form">
							<div class="col1">비밀번호</div>
							<div class="col2">
								<input class="input" type="password" name="pass" value="<?= $pass ?>">
							</div>
						</div>
						<div class="clear"></div>
						<div class="form">
							<div class="col1">비밀번호 확인</div>
							<div class="col2">
								<input class="input" class="input" type="password" name="pass_confirm" value="<?= $pass ?>">
							</div>
						</div>
						<div class="clear"></div>
						<div class="form">
							<div class="col1">이름</div>
							<div class="col2">
								<input class="input" type="text" name="name" value="<?= $name ?>">
							</div>
						</div>
						<div class="clear"></div>
						<div class="form email">
							<div class="col1">이메일</div>
							<div class="col2">
								<input class="input" type="text" name="email1" value="<?= $email1 ?>">&nbsp;@&nbsp;<input class="input" type="text" name="email2"
									value="<?= $email2 ?>">
							</div>
						</div>
						<div class="clear"></div>
						<div class="bottom_line"> </div>
						<div class="buttons">
                                <div class="join_btn" onclick="check_input()">저장하기</div>
                                <div class="join_btn" onclick="reset_form()">취소하기</div>
                            </div>
					</form>
				</div>
			</div> <!-- join_box -->
		</div> <!-- main_content -->
	</section>
	<footer>
		<?php include "footer.php"; ?>
	</footer>
	<script src="./js/dropdown.js"></script>
</body>

</html>