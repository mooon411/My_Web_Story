<?php
include "../connect/connect.php";
include "../connect/session.php";

// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";

$blogSql = "SELECT * FROM blog WHERE blogDelete = 1 ORDER BY blogId DESC";
$blogInfo = $connect->query($blogSql);

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP 블로그 만들기</title>

    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body class="gray">

    <?php include "../include/skip.php" ?>
    <!-- skip -->

    <?php include "../include/header.php" ?>
    <!-- header -->

    <main id="main" role="main">
        <div class="intro__inner blogStyle bmStyle container">
            <div class="intro__img main">
                <img srcset="../assets/images/intro_02.jpg" alt="intro">
            </div>
            <div class="intro__text">
                <h3>최신정보</h3>
                <p>민담에 관한 여러가지 정보를 볼 수 있습니다.</p>
            </div>
        </div>

        <div class="blog__layout container">
            <div class="blog__contents">
                <div class="blog__card card__wrap">
                    <div class="card__inner column3">

                        <?php foreach ($blogInfo as $blog) { ?>
                            <div class="card">
                                <figure clas="card__img">
                                    <a href="blogView.php?blogId=<?= $blog['blogId'] ?>">
                                        <img src="../assets/blog/<?= $blog['blogImgFile'] ?>" alt="<?= $blog['blogId'] ?>">
                                    </a>
                                </figure>
                                <div class="card__text">
                                    <h3>
                                        <a href="blogView.php?blogId=<?= $blog['blogId'] ?>">
                                            <?= $blog['blogTitle'] ?>
                                        </a>
                                    </h3>
                                    <p>
                                        <?= substr($blog['blogContents'], 0, 100) ?>
                                    </p>
                                </div>
                                <div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                </div>
                <div class="blog__pages">blog__pages</div>
                <div class="blog__index">blog__index</div>
                <div class="blog__relate">blog__relate</div>
                <div class="blog__view">blog__view</div>
                <div class="blog__write">blog__write</div>
            </div>
            <div class="blog__aside">
                <?php include "blogAd.php" ?>
                <!-- //blog__ad -->

                <?php include "blogIntro.php" ?>
                <!-- //blogIntro -->

                <?php include "blogCategory.php" ?>
                <!-- //blogCategory -->

                <?php include "blogPopular.php" ?>
                <!-- //blogPopular -->

                <?php include "blogComment.php" ?>
                <!-- //blogComment -->
            </div>
        </div>
    </main>
    <!-- main -->

    <?php include "../include/footer.php" ?>
    <!-- footer -->
</body>

</html>