<?php
    include "../connect/connect.php";
    include "../connect/session.php";
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>

    <!-- CSS  -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="gray">
    <div id="skip">
        <a href="#haeder">헤더 영역 바로가기</a>
        <a href="#main">콘첸츠 영역 바로가기</a>
        <a href="#footer">푸터 영역 바로가기</a>
    </div>

    <?php include "../include/header.php" ?>
    <!-- header -->

    <main id="main" role="main">
        <div class="intro__inner bmStyle container">
            <div class="intro__img small">
                <img srcset="../assets/img/intro-3-min.jpg 1x,
            ../assets/img/intro-3-@2x-min.jpg 2x,
            ../assets/img/intro-3-@3x-min.jpg 3x" alt="">
            </div>
            <div class="intro__text">
                <h2>게시판</h2>
                <p>
                    웹디자이너, 웹퍼블리셔, 프론트엔드 개발자를 위한 게시판입니다. <br> 글을 작성 및 열람이 가능합니다.
                </p>
            </div>
        </div>
        <section class="board__inner container">
            <div class="board__write">
                <form action="boardWriteSave.php" name="boardWriteSave" method="post">
                    <fieldset>
                        <legend class="blind">게시글 작성하기</legend>
                        <div>
                            <label for="boardTitle">제목</label>
                            <input type="text" id="boardTitle" name="boardTitle" class="input__style">
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

    <footer id="footer" role="contentinfo">
        <div class="footer__inner container btStyle">
            <div>Copyright 2023 jeongsaeyeong</div>
            <div>blog by jeong</div>
        </div>
    </footer>
    <!-- footer -->

</body>

</html>