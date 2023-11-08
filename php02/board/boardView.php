<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // 총 페이지 갯수 
    $sql = "SELECT count(boardID) From board";
    $result = $connect -> query($sql);
    
    $boardTotalCount = $result -> fetch_array(MYSQLI_ASSOC);
    $boardTotalCount = $boardTotalCount['count(boardID)'];
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
                <img srcset="../assets/images/intro_02.jpg" alt="intro">
            </div>
            <div class="intro__text">
                <h2>게시판</h2>
                <p>
                    웹디자이너, 웹퍼블리셔, 프론트엔드 개발자를 위한 게시판입니다. <br> 글을 작성 및 열람이 가능합니다.
                </p>
            </div>
        </div>
        <section class="board__inner container board__view">
            <div class="board__view">
                <table>
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: 80%;">
                    </colgroup>
                    <tbody>
<?php
    $boardID = $_GET['boardID'];

    // 보드 뷰 +1
    $sql = "UPDATE board SET boardView = boardView +1 WHERE boardID = {$boardID}";
    $connect -> query($sql);

    $sql = "SELECT b.boardTitle, m.youName, b.regTime, b.boardView, b.boardContents FROM board b JOIN members m ON(b.memberID = m.memberID) WHERE b.boardID = {$boardID}";
    $result = $connect -> query($sql);

    if($result){
        $info = $result -> fetch_array(MYSQLI_ASSOC);

        echo "<tr><th>제목</th><td>".$info['boardTitle']."</td></tr>";
        echo "<tr><th>등록자</th><td>".$info['youName']."</td></tr>";
        echo "<tr><th>등록일</th><td>".date('Y-m-d', $info['regTime'])."</td></tr>";
        echo "<tr><th>조회수</th><td>".$info['boardView']."</td></tr>";
        echo "<tr><th>내용</th><td>".$info['boardContents']."</td></tr>";
    }
?>
                        <!-- <tr>
                            <th>제목</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>등록일</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>조회수</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td></td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
                <div class="board__btns"> 
                    <a href="boardModify.php?boardID=<?=$_GET['boardID']?>" class="btn__style3 mr10">수정하기</a>
                    <a href="boardRemove.php?boardID=<?=$_GET['boardID']?>" class="btn__style3 mr10" onclick="return confirm('정말 삭제하시겠습니까?')">삭제하기</a>
                    <a href="board.php" class="btn__style3">목록보기</a>
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