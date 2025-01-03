<?php
// 댓글 수정 처리 (comment_update.php)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $comment_id = $_POST["comment_id"];
    $board_num = $_POST["board_num"];
    $content = $_POST["content"];

    // DB 연결
    $con = mysqli_connect("localhost", "user1", "12345", "sample");

    // 댓글 내용 업데이트
    $sql = "UPDATE comments SET content = '$content' WHERE id = '$comment_id' AND board_num = '$board_num'";
    if (mysqli_query($con, $sql)) {
        // 수정 완료 후, 원래 게시물로 돌아가기
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        header("Location: board_view.php?num=$board_num&page=$page");
        exit();
    } else {
        echo "댓글 수정에 실패했습니다.";
    }

    // DB 연결 종료
    mysqli_close($con);
}
?>
