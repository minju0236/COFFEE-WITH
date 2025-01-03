<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>COFFEE, WITH</title>
	<link rel="stylesheet" type="text/css" href="./css/board.css">
	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/comment.css">
	<script>
		function checkLogin() {
			const userId = document.getElementById("user_id").value;
			const userName = document.getElementById("user_name").value;

			console.log("userId:", userId); // 디버깅: userId 확인
			console.log("userName:", userName); // 디버깅: userName 확인

			if (!userId || !userName) {
				alert('로그인 후 이용해 주세요!');
				return false; // 폼 제출 중지
			}
			return true; // 폼 제출 진행
		}

		function showEditForm(commentId, currentContent) {
			const form = document.getElementById("edit_form_" + commentId);
			form.style.display = "block"; // 수정 폼을 보이게 함

			// 텍스트 영역에 현재 댓글 내용을 넣어줌
			const textarea = form.querySelector("textarea");
			textarea.value = currentContent;
		}

		function hideEditForm(commentId) {
			const form = document.getElementById("edit_form_" + commentId);
			form.style.display = "none"; // 수정 폼을 숨김
		}
	</script>
</head>

<body>
	<header>
		<?php include "header.php"; ?>
	</header>
	<section>
		<div id="board_box">
			<h3 class="title">
				게시판 > 내용보기
			</h3>
			<?php
			$num = $_GET["num"];
			$page = $_GET["page"];

			$con = mysqli_connect("localhost", "user1", "12345", "sample");
			$sql = "select * from board where num=$num";
			$result = mysqli_query($con, $sql);

			$row = mysqli_fetch_array($result);
			$id = $row["id"];
			$name = $row["name"];
			$regist_day = $row["regist_day"];
			$subject = $row["subject"];
			$content = $row["content"];
			$file_name = $row["file_name"];
			$file_type = $row["file_type"];
			$file_copied = $row["file_copied"];
			$hit = $row["hit"];

			$content = str_replace(" ", "&nbsp;", $content);
			$content = str_replace("\n", "<br>", $content);

			$new_hit = $hit + 1;
			$sql = "update board set hit=$new_hit where num=$num";
			mysqli_query($con, $sql);
			?>
			<ul id="view_content">
				<li>
					<span class="col1"><b>제목 :</b> <?= $subject ?></span>
					<span class="col2"><?= $name ?> | <?= $regist_day ?></span>
				</li>
				<li>
					<?php
					if ($file_name) {
						$real_name = $file_copied;
						$file_path = "./data/" . $real_name;
						$file_size = filesize($file_path);

						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
					}
					?>
					<?= $content ?>
				</li>
			</ul>
			<ul class="buttons">
				<li><button onclick="location.href='board_list.php?page=<?= $page ?>'">목록</button></li>
				<li><button
						onclick="location.href='board_modify_form.php?num=<?= $num ?>&page=<?= $page ?>'">수정</button>
				</li>
				<li><button onclick="location.href='board_delete.php?num=<?= $num ?>&page=<?= $page ?>'">삭제</button>
				</li>
				<li><button onclick="location.href='board_form.php'">글쓰기</button></li>
			</ul>
			<div id="comment_box">
				<h3>댓글</h3>
				<?php
				$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : '';
				$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
				$board_num = isset($_GET['num']) ? $_GET['num'] : '';
				?>

				<form id="comment_form" method="post" action="comment_insert.php" onsubmit="return checkLogin();">
					<input type="hidden" name="user_id" id="user_id"
						value="<?= htmlspecialchars($userid, ENT_QUOTES, 'UTF-8') ?>">
					<input type="hidden" name="user_name" id="user_name"
						value="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>">
					<input type="hidden" name="board_num" id="board_num"
						value="<?= htmlspecialchars($board_num, ENT_QUOTES, 'UTF-8') ?>">
					<textarea name="content" rows="3" placeholder="댓글을 입력하세요" required></textarea>
					<div class="box"><button class="btn1" type="submit">댓글 작성</button></div>
				</form>
				<ul id="comment_list">
					<?php
					$comment_sql = "SELECT * FROM comments WHERE board_num=$num ORDER BY created_at DESC";
					$comment_result = mysqli_query($con, $comment_sql);
					while ($comment_row = mysqli_fetch_array($comment_result)) {
						$comment_id = $comment_row["id"];
						$comment_user_name = $comment_row["user_name"];
						$comment_content = $comment_row["content"];
						$comment_created_at = $comment_row["created_at"];
						?>
						<li>
							<span class="comment_user"><?= $comment_user_name ?></span>
							<span class="comment_date"><?= $comment_created_at ?></span>
							<p class="comment_content"><?= $comment_content ?></p>
							<?php if ($userid == $comment_row['user_id']) { ?>
								<a href="comment_delete.php?id=<?= $comment_id ?>&board_num=<?= $num ?>" class="btn">삭제</a>
								<a href="#"
									onclick="showEditForm(<?= $comment_id ?>, '<?= addslashes($comment_content) ?>')" class="btn">수정</a>
							<?php } ?>
							<div id="edit_form_<?= $comment_id ?>" style="display: none;">
								<form method="post" action="comment_update.php" onsubmit="return checkLogin();">
									<input type="hidden" name="comment_id" value="<?= $comment_id ?>">
									<input type="hidden" name="board_num" value="<?= $num ?>">
									<textarea name="content" rows="3" required><?= $comment_content ?></textarea>
									<button type="submit">수정</button>
									<button type="button" onclick="hideEditForm(<?= $comment_id ?>)">취소</button>
								</form>
							</div>
						</li>
					<?php } ?>
				</ul>

			</div>
		</div> <!-- board_box -->
	</section>
	<footer>
		<?php include "footer.php"; ?>
	</footer>
	<script src="./js/dropdown.js"></script>
</body>

</html>