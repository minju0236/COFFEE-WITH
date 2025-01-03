<?php
    // 회원가입 데이터 받기
    $id   = $_POST["id"];
    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email1  = $_POST["email1"];
    $email2  = $_POST["email2"];
    $email = $email1."@".$email2;
    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

    // 데이터베이스 연결
    $con = mysqli_connect("localhost", "user1", "12345", "sample");

    // 이미지 업로드 처리
    $profileImage = null;  // 기본값 설정
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "uploads/";  // 이미지 저장 디렉토리
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);  // 디렉토리가 없다면 생성
        }

        $fileName = basename($_FILES['profile_image']['name']);  // 파일 이름
        $filePath = $uploadDir . $fileName;  // 파일 경로
        $fileType = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));  // 파일 확장자
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];  // 허용된 파일 형식

        if (in_array($fileType, $allowedTypes)) {
            // 파일을 지정된 경로로 업로드
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $filePath)) {
                $profileImage = $fileName;  // 업로드된 파일 이름 저장
            } else {
                die("이미지 업로드 실패!");
            }
        } else {
            die("이미지 파일만 업로드할 수 있습니다.");
        }
    }

    // SQL 쿼리 작성
    $sql = "INSERT INTO members (id, pass, name, email, regist_day, level, point, profile_image) ";
    $sql .= "VALUES ('$id', '$pass', '$name', '$email', '$regist_day', 9, 0, '$profileImage')";

    // 쿼리 실행
    mysqli_query($con, $sql);  
    mysqli_close($con);     

    // 회원가입 완료 후 index 페이지로 리디렉션
    echo "
        <script>
            location.href = 'index.php';
        </script>
    ";
?>
