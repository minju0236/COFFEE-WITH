<?php
    session_start();
    if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $userlevel = "";

    if ($userlevel != 1) {
        echo("
            <script>
            alert('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!');
            history.go(-1);
            </script>
        ");
        exit;
    }

    $num = $_GET["num"];
    $level = $_POST["level"];
    $point = $_POST["point"];

    // 디버깅용으로 변수 출력
    var_dump($num, $level, $point);
    
    // DB 연결
    $con = mysqli_connect("localhost", "user1", "12345", "sample");

    // 데이터가 제대로 들어왔는지 확인하는 쿼리 로그
    $sql = "UPDATE members SET level=$level, point=$point WHERE num=$num";
    echo "쿼리: " . $sql . "<br>"; // 쿼리 확인
    $result = mysqli_query($con, $sql);

    // 결과 확인
    if ($result) {
        echo "<script>alert('회원정보가 성공적으로 수정되었습니다.'); location.href = 'admin.php';</script>";
    } else {
        echo "<script>alert('수정에 실패했습니다. 다시 시도해주세요.'); history.go(-1);</script>";
    }

    mysqli_close($con);
?>
