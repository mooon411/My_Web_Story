<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    //총 페이지 갯수
    $sql = "SELECT count(boardID) FROM board";
    $result = $connect -> query($sql);

    $boardTotalCount = $result -> fetch_array(MYSQLI_ASSOC);
    $boardTotalCount = $boardTotalCount['count(boardID)'];
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
        <div class="board__search">
                <div class="left">
                    *총 <em><?=$boardTotalCount?></em>건의 게시물이 등록되어 있습니다.
                </div>
                <div class="right">
                    <form action="boardSearch.php" name="boardSearch" method="get">
                        <fieldset>
                            <legend class="blind">게시판 검색 영역</legend>
                            <input type="search" name="searchKeyword" id="searchKeyword" placeholder="검색어를 입력하세요!">
                            <select name="searchOption" id="searchOption">
                                <option value="title">제목</option>
                                <option value="content">내용</option>
                                <option value="name">등록자</option>
                            </select>
                            <button type="submit">검색</button>
                            <a href="boardWrite.php">글쓰기</a>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="board__table">
                <table>
                    <colgroup>
                        <col style="width: 5%;">
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
                        <!-- <tr>
                            <td>1</td>
                            <td><a href="#">게시판 제목</a></td>
                            <td>문영인</td>
                            <td>2023-04-11</td>
                            <td>100</td>
                        </tr> -->
                    
                    <?php
                        if(isset($_GET['page'])){
                            $page = (int) $_GET['page'];
                        }else {
                            $page = 1;
                        }

                        $viewNum = 10;
                        $viewLimit = ($viewNum * $page) - $viewNum;

                        //1~10  LIMIT 1, 10 -->page1 ($viewNum * 1) - $viewNum
                        //11~20 LIMIT 10 10 -->page2 ($viewNum * 2) - $viewNum 
                        //21~30 LIMIT 20 10 -->page3 ($viewNum * 3) - $viewNum
                        //31~40 LIMIT 30 10 -->page4 ($viewNum * 4) - $viewNum

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
                                    echo "<td>".date('y-m-d', $info['regTime'])."</td>";
                                    echo "<td>".$info['boardView']."</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>게시글이 없습니다.<td></tr>";
                            }
                        }else {
                            echo "관리자에게 문의해주세요.";
                        }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="board__pages">
                <ul>
                    <?php 
                        // // 총 페이지 갯수
                        // $boardTotalCount = ceil($boardTotalCount / $viewNum);

                        // // 1 2 3 4 5 6 [7] 8 9 10 11 12
                        // $pageView = 5;
                        // $startPage = $page - $pageView;
                        // $endPage = $page + $pageView;
                        

                        // // 처음 페이지 초기화 / 마지막 페이지 초기화
                        // if ($startPage < 1) $startPage = 1;
                        // if ($endPage >= $boardTotalCount) $endPage = $boardTotalCount;

                        // // 이전 페이지 버튼
                        // $prevPage = ($page > 1) ? $page - 1 : 1;

                        // // 다음 페이지 버튼
                        // $nextPage = ($page < $boardTotalCount) ? $page + 1 : $boardTotalCount;

                        // // 페이지 번호를 출력
                        // echo "<ul>";

                        // // 처음으로 가기 버튼
                        // echo "<li class='first'><a href='board.php?page=1'>처음으로</a></li>";

                        // // 이전 페이지 버튼
                        // echo "<li class='prev'><a href='board.php?page={$prevPage}'>이전</a></li>";

                        // for ($i = $startPage; $i <= $endPage; $i++) {
                        //     // 현재 페이지인 경우에 .active 클래스 추가
                        //     $class = ($i == $page) ? 'class="active"' : '';
                        //     echo "<li $class><a href='board.php?page={$i}'>$i</a></li>";
                        // }

                        // // 다음 페이지 버튼
                        // echo "<li class='next'><a href='board.php?page={$nextPage}'>다음</a></li>";

                        // // 마지막으로 가기 버튼
                        // echo "<li class='last'><a href='board.php?page={$boardTotalCount}'>마지막</a></li>";
                        // echo "</ul>";

                    // // 페이지 번호 출력
                        // // for ($i = $startPage; $i <= $endPage; $i++) {

                        //     // 현재 페이지인 경우에 .active 클래스 추가

                        //     // if ($i == $page) {
                        //     //     echo "<li class='active'><a href='#'>$i</a></li>";
                        //     // } else {
                        //     //     echo "<li><a href='#'>$i</a></li>";
                        //     // }
                            
                        //     // 쌤 코드
                        //     // $active = "";
                        //     // if($i == $page) $active = "active";
                        //     // echo "<li class='{$active}'><a href='board.php?page=${i}'>$i</a></li>";
                        
                        // // }
                    ?>
                    <?php
                        // 총 페이지 갯수
                        $boardTotalCount = ceil($boardTotalCount/$viewNum);

                        // 1 2 3 4 5 6 [7] 8 9 10 11 12 13
                        $pageView = 5;
                        $startPage = $page - $pageView;
                        $endPage = $page + $pageView;

                        // 처음 페이지 초기화 / 마지막 페이지 초기화
                        if($startPage < 1) $startPage = 1;
                        if($endPage >= $boardTotalCount) $endPage = $boardTotalCount;

                        // 처음으로/이전
                        if($page != 1){
                            $prevPage = $page -1;
                            echo "<li class='first'><a href='board.php?page=1'>처음으로</a></li>";
                            echo "<li class='prev'><a href='board.php?page={$prevPage}'>이전</a></li>";
                        }

                        // 페이지
                        for($i=$startPage; $i<=$endPage; $i++){
                            $active = "";
                            if($i == $page) $active = "active";

                            echo "<li class='{$active}'><a href='board.php?page={$i}'>${i}</a></li>";
                        }

                        // 마지막으로/다음
                        if($page != $boardTotalCount){
                            $nextPage = $page + 1;
                            echo "<li class='next'><a href='board.php?page={$nextPage}'>다음</a></li>";
                            echo "<li  class='last'><a href='board.php?page={$boardTotalCount}'>마지막으로</a></li>";
                        }
                    ?>
                </ul>
            </div>
        </section>
    </main>
    <!-- main -->
    <?php include "../include/footer.php" ?>
    <!-- footer -->
</body>
</html>