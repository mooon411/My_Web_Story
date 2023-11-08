<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $youId = mysqli_real_escape_string($connect, $_POST['youId']);
    $youName = mysqli_real_escape_string($connect, $_POST['youName']);
    $youEmail = mysqli_real_escape_string($connect, $_POST['youEmail']);
    $youPass = mysqli_real_escape_string($connect, $_POST['youPass']);
    $youPhone = mysqli_real_escape_string($connect, $_POST['youPhone']);
    $youRegTime = time();

    $sql = "INSERT INTO myMembers(youId, youName, youEmail, youPass, youPhone, youRegTime) VALUES('$youId', '$youName', '$youEmail','$youPass', '$youPhone', '$youRegTime')";
    $connect -> query($sql);

    //데이터 베이스 연결 닫기
    mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include "../include/head.php" ?>    
    <title>가입완료</title>
</head>

<body class="gray">
    <?php include "../include/skip.php" ?>    
    <?php include "../include/header.php" ?>    
    <!-- header -->
            <!-- header -->
        
            <main id="main" role="main">
                <div class="intro__inner bmStyle container">
                    <div class="intro__img">
                        <img srcset="../assets/images/intro_02.jpg"alt="intro">
                    </div>
                    <div class="intro__text">
                        회원가입을 하시면 다양한 정보를 자유롭게 볼 수 있습니다.
                    </div>
                </div>
                <section class="join__inner container">
                    <h2>회원가입 완료</h2>
                    <div class="join__index">
                        <ul>
                            <li>1</li>
                            <li>2</li>
                            <li class="active">3</li>
                        </ul>
                    </div>
                    <div class="join__result">
                        회원가입을 축하드립니다. 환영합니다.<br>
                        로그인을 해주세요
                    </div>
                    <button class="btn__style">로그인</button>
                </section>
            </main>
            <!-- main -->
        
            <?php include "../include/footer.php" ?>    
            <!-- footer -->
        
        </body>
</html>