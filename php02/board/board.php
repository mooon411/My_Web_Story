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
                <img srcset="../assets/images/intro_02.jpg"alt="intro">
            </div>
            <div class="intro__text">
                <h2>게시판</h2>
                <p>
                    웹디자이너, 웹퍼블리셔, 프론트엔드 개발자를 위한 게시판입니다. <br> 글을 작성 및 열람이 가능합니다.
                </p>
            </div>
        </div>
        <section class="board__inner container">
        <div class="board__search">
            <div class="left">
                *총 <em><?=$boardTotalCount?></em>건의 게시물이 등록되어 있습니다.
            </div>
            <div class="right">
                <form action="boardSearch.php" name="boardSearch" method="get">
                    <fieldset>
                        <legend class="blind">게시판 검색 영역</legend>
                        <input type="search" name="searchKeyword" id="searchKeyword" placeholder="검색어를 입력하세요." required>
                        <select name="searchOption" id="searchOption">
                            <option value="title">제목</option>
                            <option value="content">내용</option>
                            <option value="name">등록자</option>
                        </select>
                        <button type="submit" class="btn__style3 white">검색</button>
                        <a href="boardWrite.php" class="btn__style3 black">글쓰기</a>
                    </fieldset>
                </form>
            </div>
        </div>

        <div class="board__table">
                <table>
                    <colgroup>
                        <col style="width: 7%;">
                        <col>
                        <col style="width: 10%;">
                        <col style="width: 15%;">
                        <col style="width: 7%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>제목</th>
                            <th>등록자</th>
                            <th>등록일</th>
                            <th>조회수</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                if(isset($_GET['page'])){
                                    $page = (int) $_GET['page'];
                                } else {
                                    $page = 1;
                                }

                                $viewNum = 10; 
                                $viewLimit = ($viewNum * $page) - $viewNum;

                                // 1~10 LIMIT 0, 10     --> page 1 ($viewNum * 1) - $viewNum
                                // 11~20 LIMIT 10, 10   --> page 2 ($viewNum * 2) - $viewNum
                                // 21~30 LIMIT 20, 10   --> page 3 ($viewNum * 3) - $viewNum
                                // 31~40 LIMIT 30, 10   --> page 4 ($viewNum * 4) - $viewNum

                                $sql = "SELECT b.boardID, b.boardTitle, m.youName, b.regTime, b.boardView FROM board b JOIN members m ON(b.memberID = m.memberID) ORDER BY boardID DESC LIMIT {$viewLimit}, {$viewNum}";
                                $result = $connect -> query($sql);

                                if($result){
                                    $count = $result -> num_rows;

                                    if($count > 0){
                                        for($i=0; $i<$count; $i++){
                                            $info = $result -> fetch_array(MYSQLI_ASSOC);
        
                                            echo "<tr>";
                                            echo "<td>".$info['boardID']."</td>";
                                            echo "<td><a href='boardView.php?boardID={$info['boardID']}'>".$info['boardTitle']."</a></td>";
                                            echo "<td>".$info['youName']."</td>";
                                            echo "<td>".date('Y-m-d', $info['regTime'])."</td>";
                                            echo "<td>".$info['boardView']."</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>게시글이 없습니다.</td></tr>";
                                    }
                                } else {
                                    echo "관리자에게 문의 바랍니다.";
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="board__pages">
                <ul>
                    <?php
                        // 총 페이지 갯수  
                        $boardTotalCount = ceil($boardTotalCount/$viewNum);
                        
                        // 1 2 3 4 5 6 7 8 9 10 11  
                        $pageView = 5; 
                        $startPage = $page - $pageView;
                        $endPage = $page + $pageView;
                        
                        
                        $Index = $page; 
                        
                        if($Index >= $boardTotalCount) $Index = $boardTotalCount;

                        
                        // 처음 페이지 초기화 / 마지막 페이지 초기화 
                        if($startPage<1) $startPage = 1; 
                        if($endPage >= $boardTotalCount) $endPage = $boardTotalCount;


                        // 페이지 뿌리기 
                        // for($i=$startPage; $i<=$endPage; $i++){
                        //     $active = "";
                        //     if($i == $page) $active = "active";
                        //     echo "<li class='{$active}><a href='#'>${i}</a></li>";
                        // }

                        // // 페이지 액티브 
                        // if($page != 1){
                        //     $prevPage = $page -1;
                        //     echo "<li><a href='board.php?page=1'>처음으로</a></li>";
                        //     echo "<li><a href='board.php?page={$prevPage}'>이전</a></li>";
                        // }
                        
                        if($page !=1){
                            $Index = $page; 
                            echo "<li class='first'><a href='board.php?page=1'>처음으로</a></li>";
                            echo "<li class='back'><a href='board.php?page=".($Index-1)."'><</a></li>";
                        };
                        
                        
                        for($i=$startPage; $i<=$endPage; $i++){
                            if ($i == $page) {
                                echo "<li class='active'><a href='board.php?page={$i}'>$i</a></li>";
                            } else {
                                echo "<li><a href='board.php?page={$i}'>$i</a></li>";
                            }
                        }

                        if($page != $boardTotalCount){
                            $Index = $page; 
                            echo "<li class='next'><a href='board.php?page=".($Index+1)."'>></a></li>";
                            echo "<li class='last'><a href='board.php?page={$boardTotalCount}'>마지막으로</a></li>";
                        };

                        // 마지막으로/다음
                        // if($page != $boardTotalCount){
                        //     $nextPage = $page + 1;
                        //     echo "<li class = 'next'><a href='board.php?page={$nextPage}'>다음</a></li>";
                        //     echo "<li><a href='board.php?page={$boardTotalCount}'>마지막으로</a></li>";
                        // }
                    ?>
                </ul>
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