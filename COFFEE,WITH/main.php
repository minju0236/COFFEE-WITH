<div id="main_img_bar">
    <img class="img" src="./img/coffeeBanner.png">
    <section class="banner1">
        <img class="img1" src="./img/img1.png">
        <img class="img2" src="./img/img2.png">
    </section>
    <section class="banner2">
        <img class="img3" src="./img/img3.png">
    </section>
</div>
<div id="main_content">
    <div id="latest">
        <div id="table">
            <h4>최근 게시글</h4>
            <div id="latest-title">
                <div id="latest-title-1">제목</div>
                <div id="latest-title-2">작성자</div>
                <div id="latest-title-3">작성일시</div>
            </div>
            <ul>
                <!-- 최근 게시 글 DB에서 불러오기 -->
                <?php
                $con = mysqli_connect("localhost", "user1", "12345", "sample");
                $sql = "select * from board order by num desc limit 5";
                $result = mysqli_query($con, $sql);

                if (!$result)
                    echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
                else {
                    while ($row = mysqli_fetch_array($result)) {
                        $regist_day = substr($row["regist_day"], 0, 10);
                        ?>
                        <li>
                            <span><?= $row["subject"] ?></span>
                            <span><?= $row["name"] ?></span>
                            <span><?= $regist_day ?></span>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <div id="latest_2">
        <a id="latest_2_btn" href="board_list.php">게시글 보러가기</a>
    </div>
    <div id="point_rank">
        <div id="table2">
            <h4>포인트 랭킹</h4>
            <ul>
                <!-- 포인트 랭킹 표시하기 -->
                <?php
                $rank = 1;
                $sql = "select * from members order by point desc limit 5";
                $result = mysqli_query($con, $sql);

                if (!$result)
                    echo "회원 DB 테이블(members)이 생성 전이거나 아직 가입된 회원이 없습니다!";
                else {
                    while ($row = mysqli_fetch_array($result)) {
                        $name = $row["name"];
                        $id = $row["id"];
                        $point = $row["point"];
                        $name = mb_substr($name, 0, 1) . " * " . mb_substr($name, 2, 1);
                        // 포인트에 따른 등급 처리
                        if ($point >= 300) {
                            $point_label = "VIP";
                        } elseif ($point >= 200) {
                            $point_label = "골드";
                        } elseif ($point >= 100) {
                            $point_label = "실버";
                        } else {
                            $point_label = "일반";
                        }
                        // 포인트에 등급을 추가하여 표시
                        $point_display = $point . " (" . $point_label . ")";

                        ?>
                        <li>
                            <span><?= $rank ?></span>
                            <span><?= $name ?></span>
                            <span><?= $id ?></span>
                            <span><?= $point_display ?></span>
                        </li>
                        <?php
                        $rank++;
                    }
                }

                mysqli_close($con);
                ?>
            </ul>
        </div>
    </div>
</div>