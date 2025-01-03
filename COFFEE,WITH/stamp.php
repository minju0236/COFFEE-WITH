<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>COFFEE, WITH</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/stamp.css">
</head>

<body>
    <header>
        <?php include "header.php"; ?>
    </header>
    <?php include "stamp_form.php"; ?>
    <section class='stamp_form'>
        <div id="main_content">
            <div id="stamp_box">
                <div id="stamp_content">
                    <div id="stamp_text">
                        <h1>스탬프 10장을 모으면 아메리카노 1잔 무료!</h1>
                    </div>
                    <div id="stamp_img">
                        <table>
                            <?php
                            for ($row = 0; $row < 2; $row++) {
                                echo "<tr>";
                                for ($col = 0; $col < 5; $col++) {
                                    $index = $row * 5 + $col;
                                    $stampImage = ($index < $userData['stamps']) ? './img/stamp.png' : './img/stamp_null.png';
                                    echo "<td><img src='$stampImage'></td>";
                                }
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                    <div class="buttons">
                        <button id="add_stamp_btn" class="join_btn">출석체크하기</button>
                    </div>
                    <p>출석체크는 하루에 한 번만 가능합니다.
                        <br>스탬프 10장을 모을 경우, 메일을 통해 추후에 자사 아메리카노 쿠폰이 발급됩니다.
                        <br>한번 발급된 쿠폰은 교환/환불이 어려우니, 유효기간 내에 사용해주시기 바랍니다.
                        유효기간은 발급 후로부터 한 달입니다.
                        <br>이벤트는 예고 없이 종료될 수 있습니다.
                        <br>이 외의 문의사항은 COFFEE, WITH 문의센터로 전화 부탁드립니다.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <?php include "footer.php"; ?>
    </footer>
    <script src="./js/dropdown.js"></script>
    <script src="./js/stamp.js"></script>

    <script>
        document.getElementById('add_stamp_btn').addEventListener('click', function () {
            var stamps = document.querySelectorAll('#stamp_img img');
            var currentStamps = 0;

            for (var i = 0; i < stamps.length; i++) {
                if (i < currentStamps + 1) {
                    stamps[i].src = './img/stamp.png';
                }
            }

            document.getElementById('add_stamp_btn').disabled = true;

            fetch('stamp_check.php', {
                method: 'POST',
                body: JSON.stringify({ user_id: 'minju0236' }),
                headers: {
                    'Content-Type': 'application/json',
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("출석체크 완료!");
                        location.reload();
                    } else {
                        alert('출석체크에 실패했습니다. 다시 시도해주세요.');
                    }
                })
                .catch(error => {
                    location.reload();
                    alert('출석체크 완료!');
                });
        });
    </script>
    <script src="./js/dropdown.js"></script>

</body>

</html>