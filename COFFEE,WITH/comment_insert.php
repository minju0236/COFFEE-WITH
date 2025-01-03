<?php
// POST 값 가져오기
$board_num = isset($_POST['board_num']) ? $_POST['board_num'] : '';
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';

if (!$board_num || !$user_id || !$user_name || !$content) {
    echo "Error: Missing required fields.";
    exit();
}

// DB 연결
$con = mysqli_connect("localhost", "user1", "12345", "sample");

// board_num 값 확인
$check_sql = "SELECT * FROM board WHERE num = '$board_num'";
$check_result = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_result) === 0) {
    echo "Error: Invalid board_num.";
    exit();
}

// 댓글 삽입
$sql = "INSERT INTO comments (board_num, user_id, user_name, content) 
        VALUES ('$board_num', '$user_id', '$user_name', '$content')";
if (!mysqli_query($con, $sql)) {
    echo "Error: " . mysqli_error($con);
    exit();
}

// DB 연결 종료
mysqli_close($con);

// 페이지 번호를 가져오기 (GET 방식으로)
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// 리다이렉트
header("Location: board_view.php?num=$board_num&page=$page");
?>
