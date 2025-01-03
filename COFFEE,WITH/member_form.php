<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>COFFEE, WITH</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/member.css">
    <script src="./js/member_form.js"></script>
</head>
<body>
    <header>
        <?php include "header.php"; ?>
    </header>
    <section class='login_form'>
        <div id="main_content">
            <div id="join_box">
                <div id="join_title">회원가입</div>
                <div id="join_form">
                    <!-- 회원가입 폼 -->
                    <form name="member_form" method="post" action="member_insert.php"  enctype="multipart/form-data">
                        <div class="form id">
                            <div class="col1">아이디</div>
                            <div class="col2">
                                <input type="text" name="id" class="input">
                            </div>
                            <div class="col3">
                                <div class="join_btn" onclick="check_id()">중복 확인</div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">비밀번호</div>
                            <div class="col2">
                                <input type="password" name="pass" class="input">
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">비밀번호 확인</div>
                            <div class="col2">
                                <input type="password" name="pass_confirm" class="input">
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form">
                            <div class="col1">이름</div>
                            <div class="col2">
                                <input type="text" name="name" class="input">
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div class="form email">
                            <div class="col1">이메일</div>
                            <div class="col2">
                                <input type="text" name="email1" class="input">&nbsp;@&nbsp;<input type="text" name="email2" class="input">
                            </div>
                        </div>
                        <div class="clear"></div>
                        <!-- 이미지 업로드 추가 -->
                        <div class="form">
                            <div class="col1">프로필 이미지</div>
                            <input type="file" name="profile_image" id="profile_image" accept="image/*">
                        </div>
                        <div class="clear"></div>
                        <div class="bottom_line"> </div>
                        <div class="buttons">
                            <div class="join_btn" onclick="check_input()">저장하기</div>
                            <div class="join_btn" onclick="reset_form()">취소하기</div>
                        </div>
                    </form>
                </div>
            </div> <!-- join_box -->
        </div> <!-- main_content -->
    </section>
    <footer>
        <?php include "footer.php"; ?>
    </footer>
    <script src="./js/dropdown.js"></script>
</body>

</html>