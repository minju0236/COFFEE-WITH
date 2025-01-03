<?php
// 게시물 번호와 댓글 ID를 GET 방식으로 받아오기
$comment_id = isset($_GET['id']) ? $_GET['id'] : '';
$board_num = isset($_GET['board_num']) ? $_GET['board_num'] : '';

// DB 연결
$con = mysqli_connect("localhost", "user1", "12345", "sample");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// 댓글 정보 가져오기
$sql = "SELECT * FROM comments WHERE id = '$comment_id' AND board_num = '$board_num'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "댓글이 존재하지 않거나, 잘못된 댓글 ID입니다.";
    exit();
}

$row = mysqli_fetch_array($result);
$comment_content = $row['content'];  // 기존 댓글 내용

// DB 연결 종료
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>댓글 수정</title>
</head>

<body>
    <h3>댓글 수정</h3>
    <form action="comment_update.php" method="post">
        <input type="hidden" name="comment_id" value="<?= $comment_id ?>">
        <input type="hidden" name="board_num" value="<?= $board_num ?>">
        <textarea name="content" rows="4" cols="50"><?= htmlspecialchars($comment_content) ?></textarea><br>
        <button type="submit">수정</button>
    </form>
</body>

</html>
