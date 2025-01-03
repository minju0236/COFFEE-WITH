<?php
// 데이터베이스 연결
$con = mysqli_connect("localhost", "user1", "12345", "sample");

// JSON 데이터를 수신
$input = json_decode(file_get_contents('php://input'), true);

// 관리자 권한 확인
session_start();
if (isset($_SESSION["userlevel"]) && $_SESSION["userlevel"] == 1) {
    if (isset($input['member_ids']) && is_array($input['member_ids'])) {
        $member_ids = $input['member_ids'];

        if (!empty($member_ids)) {
            // ID 배열을 쉼표로 구분된 문자열로 변환
            $ids_to_delete = implode(',', array_map('intval', $member_ids));

            // 삭제 쿼리 실행
            $query = "DELETE FROM members WHERE num IN ($ids_to_delete)";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo json_encode(["success" => true, "message" => "선택된 회원이 삭제되었습니다."]);
            } else {
                echo json_encode(["success" => false, "message" => "회원 삭제 중 오류가 발생했습니다."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "삭제할 회원이 선택되지 않았습니다."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "잘못된 요청입니다."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "관리자만 회원을 삭제할 수 있습니다."]);
}

// 데이터베이스 연결 종료
mysqli_close($con);
?>
