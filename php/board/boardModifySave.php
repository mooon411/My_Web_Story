<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include "../connect/connect.php";
        include "../connect/session.php";

        $boardID = $_POST['boardID'];
        $boardTitle = $_POST['boardTitle'];
        $boardContents = $_POST['boardContents'];
        $boardPass = $_POST['boardPass'];
        $memberID = $_SESSION['memberID'];

        echo $boardID, $boardTitle, $boardContents, $boardPass,$memberID;

        // 특수문자 못쓰게
        $boardTitle = $connect -> real_escape_string($boardTitle);
        $boardContents = $connect -> real_escape_string($boardContents);
        $boardPass = $connect -> real_escape_string($boardPass);
        
        $sql = "SELECT * FROM members WHERE memberID = {$memberID}";
        $result = $connect -> query($sql);

        if($result){
            $info = $result -> fetch_array(MYSQLI_ASSOC);
        
            if($info['memberID'] === $memberID && $info['youPass'] === $boardPass){
                // 수정
                $sql = "UPDATE board SET boardTitle = '{$boardTitle}', boardContents = '{$boardContents}' WHERE boardID = '{$boardID}'";
                $connect->query($sql);
        
                echo "<script>alert('게시글이 성공적으로 수정되었습니다.')</script>";
                echo '<script>window.location.href = "board.php";</script>';
            } else {
                echo "<script>alert('비밀번호가 틀렸습니다. 다시 한번 확인해주세요!')</script>";
                echo "<script>window.history.back();</script>";
            }
        } else {
            echo "<script>alert('관리자에게 문의하세요!')</script>";
        }


    // 데이터 입력 여부 확인
        // if (empty($boardTitle) || empty($boardContents)) {
        //     echo "<script>alert('내용을 먼저 입력해주세요.');</script>";
        //     echo "<script>window.history.back()</script>";
        // } else {
        //     // // 게시글 수정 쿼리
        //     // $sql = "UPDATE board SET boardTitle = '$boardTitle', boardContents = '$boardContents' WHERE boardID = '$boardID' AND memberID = '$memberID'";

        //     // if ($connect->query($sql)) {
        //     //     echo "<script>alert('게시글이 성공적으로 수정되었습니다.');</script>";
        //     //     echo '<script>window.location.href = "board.php";</script>';
        //     // } else {
        //     //     echo "<script>alert('게시글 수정에 실패했습니다.');</script>";
        //     //     echo "<script>window.history.back()</script>";
        //     // }
            
        // }

        // $sql = "UPDATE board SET boardTitle = '$boardTitle', boardContents = '$boardContents' WHERE boardID = '$boardID' AND memberID = '$memberID'";
        // if ($connect->query($sql)) {
        //     // 성공적으로 실행됐을 때의 코드
        //     echo "성공";
        // } else {
        //     echo "쿼리 실행 에러: " . $connect->error;
        // }
    ?>
</body>
</html>