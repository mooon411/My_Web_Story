<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";
?>

<!DOCTYPE html>
<html lang="ko">
    
<?php include "../include/head.php" ?>
<!-- head -->

<body class="gray">

    <?php include "../include/skip.php" ?>
    <!-- skip -->

    <?php include "../include/header.php" ?>
    <!-- header -->

    <main id="main" role="main">
        <div class="intro__inner bmStyle container">
            <div class="intro__img small">
                <img srcset="../assets/img/m5.jpg" alt="소개 이미지">
            </div>
            <div class="intro__text">
                <h2>게시글</h2>
                <p>
                    웹디자이너, 웹 퍼블리셔, 프론트앤드 개발자를 위한 게시판입니다.<br>
                    게시글 작성은 여기서 해주세요.
                </p>
            </div>
        </div>
        <section class="board__inner container">
            <div class="board__wirte">
                <form action="boardWriteSave.php" name="boardWriteSave" method="post">
                    <fieldset>
                        <legend class="blind">게시글 작성하기</legend>
                        <div>
                            <label for="boardTitle">제목</label>
                            <input type="text" name="boardTitle" id="boardTitle" class="input__style">
                        </div>
                        <div>
                            <label for="boardContents">내용</label>
                            <textarea id="boardContents" name="boardContents" rows="20" class="input__style"></textarea>
                        </div>
                        <div class="board__btns">
                            <button type="submit" class="btn__style3">저장하기</button>
                        </div>
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