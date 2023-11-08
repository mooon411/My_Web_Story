<?php
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";
    
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
                <h2>게시글 수정하기</h2>
                <p>
                    웹디자이너, 웹 퍼블리셔, 프론트앤드 개발자를 위한 게시판입니다.<br>
                    게시글 작성은 여기서 해주세요.
                </p>
            </div>
        </div>
        <section class="board__inner container">
            <div class="board__wirte">
                <form action="boardModifySave.php" name="boardModifySave" method="post">
                    <fieldset>
                        <legend class="blind">게시글 수정하기</legend>
                        <?php
                            $boardID = $_GET['boardID'];

                            $sql = "SELECT * FROM board WHERE boardID = {$boardID}";
                            $result = $connect -> query($sql);

                            if($result){
                                $info = $result -> fetch_array(MYSQLI_ASSOC);

                                echo "<div style='display:none'><label for='boardID'>번호</label><input type='text' id='boardID' name='boardID' class='input__style' value='".$info['boardID']."'></div>";
                                echo "<div><label for='boardTitle'>제목</label><input type='text' id='boardTitle' name='boardTitle' class='input__style' value='" . $info['boardTitle'] . "'></div>";
                                echo "<div><label for='boardContents'>내용</label><textarea id='boardContents' name='boardContents' rows='20' class='input__style'>" . $info['boardContents'] . "</textarea></div>";
                                echo "<div class='mt50'><label for='boardPass'>비밀번호</label><input type='password' name='boardPass' id='boardPass' class='input__style mb0' autocomplete='off' placeholder='글을 수정하려면 로그인 비밀번호를 입력하셔야합니다.' required></div>";
                            }
                        ?>
                        <!-- <div>
                            <label for="boardTitle">제목</label>
                            <input type="text" name="boardTitle" id="boardTitle" class="input__style">
                        </div>
                        <div>
                            <label for="boardContents">내용</label>
                            <textarea id="boardContents" name="boardContents" rows="20" class="input__style"></textarea>
                        </div> -->

                        <!-- 비밀번호 기능 숙제 : 멤버 아이디 비번  가져오기 -->
                        <!-- <div class="mt50">
                            <label for="boardPass">비밀번호</label>
                            <input type="password" name="boardPass" id="boardPass" class="input__style" autocomplete="off" placeholder="글을 수정하려면 로그인 비밀번호를 입력하셔야합니다." required>
                        </div> -->
                        <div class="board__btns">
                            <button type="submit" class="btn__style3">수정하기</button>
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