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
        <div class="members_inner container">
            <h3>회원 목록</h3>
            <table>
                <colgroup>
                    <col>
                </colgroup>
                <thead>
                    <tr>
                        <th>memberID</th>
                        <th>youEmail</th>
                        <th>youName</th>
                        <th>youPass</th>
                        <th>youPhone</th>
                        <th>regTime</th>
                    </tr>
                </thead>
                <tbody>
<?php
    include "../connect/connect.php";
    
    $sql = "SELECT * FROM members";
    $result = $connect -> query($sql);

    if($result){
        $count = $result -> num_rows;

        if($count > 0){
            for($i=0; $i<$count; $i++){
                $info = $result -> fetch_array(MYSQLI_ASSOC);

                echo "<tr>";
                echo "<td>".$info['memberID']."</td>";
                echo "<td>".$info['youEmail']."</td>";
                echo "<td>".$info['youName']."</td>";
                echo "<td>".$info['youPass']."</td>";
                echo "<td>".$info['youPhone']."</td>";
                echo "<td>".date('y-m-d', $info['regTime'])."</td>";
                echo "</tr>";
            }
        }
    }

?>

                </tbody>
            </table>
        </div>
    </main>
    <!-- main -->
    <?php include "../include/footer.php" ?>
    <!-- footer -->
</body>
</html>