<?php

if (isset($_SESSION["userid"])) {
    $userId = $_SESSION["userid"];
} else {
    echo json_encode(['status' => 'error', 'message' => '로그인이 필요합니다.']);
    exit;
}

// 데이터베이스 연결
$con = mysqli_connect("localhost", "user1", "12345", "sample");

// 사용자 데이터 조회
$sql = "SELECT stamps, last_checked_date FROM user_stamps WHERE user_id = '$userId'";
$result = mysqli_query($con, $sql);
$userData = mysqli_fetch_assoc($result);

if (!$userData) {
    // 사용자 데이터가 없으면 초기화
    $sql = "INSERT INTO user_stamps (user_id, stamps, last_checked_date) VALUES ('$userId', 0, NULL)";
    mysqli_query($con, $sql);
    $userData = ['stamps' => 0, 'last_checked_date' => null];
}

// 출석체크 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_stamp'])) {
    $today = date('Y-m-d');
    $userId = $_SESSION["userid"]; // Ensure this is set and valid

    if ($userData['last_checked_date'] === $today) {
        echo json_encode(['status' => 'already_checked', 'stamps' => $userData['stamps']]);
        exit;
    } else {
        $stamps = $userData['stamps'] + 1;
        $sql = "UPDATE user_stamps SET stamps = $stamps, last_checked_date = '$today' WHERE user_id = '$userId'";
        mysqli_query($con, $sql);

        // Debugging output
        if (mysqli_affected_rows($con) > 0) {
            echo json_encode(['status' => 'checked', 'stamps' => $stamps]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Database update failed']);
        }
        exit;
    }
}


mysqli_close($con);
?>
