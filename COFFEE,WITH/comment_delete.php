<?php
$id = $_GET["id"];
$board_num = $_GET["board_num"];

$con = mysqli_connect("localhost", "user1", "12345", "sample");
$sql = "DELETE FROM comments WHERE id=$id";
mysqli_query($con, $sql);
mysqli_close($con);

// 페이지 번호를 가져오기 (GET 방식으로)
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// 리다이렉트
header("Location: board_view.php?num=$board_num&page=$page");
?>
