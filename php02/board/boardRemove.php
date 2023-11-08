<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 삭제</title>
</head>
<body>
    <?php
        include "../connect/connect.php";
        include "../connect/session.php";

        // 로그인 한 사람만 지우기 

        // $memberID = $_SESSION['memberID'];
        // $boardID = $_GET['boardID'];

        // if(isset($_SESSION['memberID'])){
        //     $sql = "DELETE FROM board WHERE boardID = {$boardID}";
        //     $connect -> query($sql);
        // } else {
        //     echo "<script>alert('로그인 후 삭제 가능합니다.');</script>";;
        // }

        $memberID = $_SESSION['memberID'];
        $boardID = $_GET['boardID'];

        if (isset($_SESSION['memberID'])) { //로그인 확인 
            // 게시글 소유자 확인
            $Owner = "SELECT memberID FROM board WHERE boardID = {$boardID}";
            $result = $connect -> query($Owner);
        
            if ($result) {
                $info = $result -> fetch_array(MYSQLI_ASSOC);
                $boardOwnerID = $info['memberID'];

                echo $boardOwnerID;

                if ($memberID == $boardOwnerID) {
                    $sql = "DELETE FROM board WHERE boardID = {$boardID}";
                    $connect->query($sql);
                    echo "<script>alert('게시글이 삭제되었습니다.');</script>";
                } else {
                    echo "<script>alert('게시글 소유자만 삭제할 수 있습니다.');</script>";
                }
            } else {
                echo "<script>alert('관리자에게 문의 바랍니다.');</script>";
            }
        } else {
            echo "<script>alert('로그인 후 삭제 가능합니다.');</script>";
        }
    ?>
<script>
    location.href = "board.php";
</script>
</body>
</html>