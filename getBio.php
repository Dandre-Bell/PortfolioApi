<?php
    include_once 'dbh.inc.php';
    include_once 'cors.php'
?>

<?php
    cors();
    $sql = "select bioText from bio where deploymentStatus = 'test';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo $row['bioText']
?>