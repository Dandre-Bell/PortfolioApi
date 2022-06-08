<?php
    include_once 'dbh.inc.php';
    include_once 'cors.php'
?>

<?php
    cors();
    //sql statement will be set to production on host
    $sql = "select bioText from bio where deploymentStatus = 'test';";
    //send query to database
    $result = mysqli_query($conn, $sql);
    //store response in $row
    $row = mysqli_fetch_assoc($result);
    //return element
    echo $row['bioText']
?>