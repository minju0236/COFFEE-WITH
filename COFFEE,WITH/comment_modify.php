<?php
$id = $_POST["id"];
$board_num = $_POST["board_num"];
$content = $_POST["content"];

$con = mysqli_connect("localhost", "user1", "12345", "sample");
$sql = "UPDATE comments SET content='$content' WHERE id=$id";
mysqli_query($con, $sql);
mysqli_close($con);

header("Location: board_view.php?num=$board_num");
?>
