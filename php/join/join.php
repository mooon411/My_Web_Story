<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 페이지</title>

    <?php include "../include/head.php" ?>
    <!-- head -->

</head>
<body class="gray">
    <?php include "../include/skip.php" ?>
    <!-- skip -->

    <?php include "../include/header.php" ?>
    <!-- header -->

    <main id="main" role="main">
        <div class="intro__inner bmStyle container">
            <div class="intro__img">
                <img srcset="../assets/img/Frame1-min.jpg, assets/img/Frame2-min.jpg, assets/img/Frame3-min.jpg" alt="소개 이미지">
            </div>
            <div class="intro__text">
                회원가입을 하시면 다양한 정보를 자유롭게 볼 수 있습니다.
            </div>
        </div>
        <section class="join__inner container">
            <h2>회원가입</h2>
            <div class="join_form">
                <form action="joinSave.php" name="join" method="post">
                    <fieldset>
                        <legend class="blind">회원가입 영역</legend>
                        <div>
                            <label class="required" for="youEmail">이메일</label>
                            <input type="email" id="youEmail" name="youEmail" placeholder="이메일을 적어주세요!" class="input__style" required>
                        </div>
                        <div>
                            <label class="required" for="youName">이름</label>
                            <input type="text" id="youName" name="youName" placeholder="이름을 적어주세요!" class="input__style" required>
                        </div>
                        <div>
                            <label class="required" for="youPass">비밀번호</label>
                            <input type="password" id="youPass" name="youPass" placeholder="비밀번호를 적어주세요!" class="input__style" required>
                        </div>
                        <div>
                            <label class="required" for="youPassC">비밀번호</label>
                            <input type="password" id="youPassC" name="youPassC" placeholder="다시 한 번 비밀번호를 적어주세요!" class="input__style" required>
                        </div>
                        <div>
                            <label class="required" for="youPhone">연락처</label>
                            <input type="text" id="youPhone" name="youPhone" placeholder="연락처를 적어주세요!" class="input__style" required>
                        </div>
                        <button type="submit" class="btn__style mt100">회원가입 완료</button>
                    </fieldset>
                </form>
            </div>
        </section>
    </main>
    <!-- main -->
    <?php include "../include/footer.php" ?>
    <!-- footer -->
</body>
</html>