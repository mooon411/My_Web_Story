
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인 페이지</title>

    <!-- CSS  -->
    <?php include "../include/head.php" ?>
    <!-- skip -->

</head>

<body class="gray">
    
    <?php include "../include/skip.php" ?>
    <!-- skip -->

    <?php include "../include/header.php" ?>
    <!-- header -->

    <main id="main" role="main">
        <div class="intro__inner container">
                <div class="intro__img">
                    <img srcset="../assets/img/intro-1-min.jpg 1x,
                    ../assets/img/intro-1@2-min.jpg 2x,
                    ../assets/img/intro-1@3-min.jpg 3x" alt="">
                </div>
                <div class="intro__text">
            <?php
                include "../connect/connect.php";
                include "../connect/session.php";

                $youEmail = $_POST['youEmail'];
                $youPass = $_POST['youPass'];

                // echo $youEmail, $youPass

                function msg($alert){
                    echo "<p>$alert</p>";
                }

                // 데이터 조회 
               $sql = "SELECT memberID, youEmail, youName, youPass FROM members WHERE youEmail = '$youEmail' AND youPass = '$youPass'";
               $result = $connect -> query($sql);

                if($result){
                    $count = $result -> num_rows;

                    if($count == 0){
                        msg("이메일 또는 비밀번호가 틀렸습니다. 다시 한 번 확인해주세요.");
                    } else {
                        $memberInfo = $result -> fetch_array(MYSQLI_ASSOC);
                        // echo "<pre>";
                        // var_dump($memberInfo);
                        // echo "</pre>";

                        // 로그인 성공 ---> 세션 생성
                        $_SESSION['memberID'] = $memberInfo['memberID'];
                        $_SESSION['youEmail'] = $memberInfo['youEmail'];
                        $_SESSION['youName'] = $memberInfo['youName'];

                        Header("Location: ../main/main.php");
                    }
                }

            ?>
        </div>
    </main>
    <!-- //main -->

    <footer id="footer" role="contentinfo">
        <div class="footer__inner container btStyle">
            <div>Copyright 2023 webstoryboy</div>
            <div>blog by webs</div>
        </div>
    </footer>
    <!-- //foter -->
</body>
</html>