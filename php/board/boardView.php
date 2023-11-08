<?php
    include "../connect/connect.php";
    include "../connect/session.php";
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
                <h2>게시판</h2>
                <p>
                    웹디자이너, 웹 퍼블리셔, 프론트앤드 개발자를 위한 게시판입니다.<br>
                    관련된 문의 사항은 여기서 확인하세요.
                </p>
            </div>
        </div>
        <section class="board__inner container">
        <div class="board__view">
                <table>
                    <colgroup>
                        <col style="width: 20%;">
                        <col style="width: 80%;">
                    </colgroup>
                    <tbody>
                        <?php
                            $boardID = $_GET['boardID'];

                            //보드 뷰 + 1
                            $sql = "UPDATE board SET boardView = boardView + 1 WHERE boardID = {$boardID}";
                            $result = $connect -> query($sql);


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
                            <th>등록자</th>
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
                            <td>
                               
                            </td>
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
    <?php include "../include/footer.php" ?>
    <!-- footer -->
</body>
</html>