<?php
// stamp_check.php
header('Content-Type: application/json');

// POST로 받은 데이터
$data = json_decode(file_get_contents('php://input'), true);

// user_id와 관련된 출석체크 처리
if (isset($data['user_id'])) {
    $user_id = $data['user_id'];
    
    // 데이터베이스 연결
    $conn = new mysqli('localhost', 'root', '', 'your_database_name');
    
    if ($conn->connect_error) {
        die(json_encode(['success' => false, 'message' => 'Database connection error']));
    }

    // 출석체크 로직 (예: stamps 값 증가)
    $sql = "UPDATE user_stamps SET stamps = stamps + 1 WHERE user_id = '$user_id'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => '출석체크 업데이트 실패']);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid user ID']);
}