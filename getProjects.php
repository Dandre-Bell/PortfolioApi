<?php
    include_once 'dbh.inc.php';
    include_once 'cors.php'
?>

<?php
    cors();
    //sql statement will be set to production on host
    $sql = "SELECT projectName, projectDescription, projectLink FROM projects";
    //send query to database
    $result = mysqli_query($conn, $sql);
    for($i = 0; $i< $result->num_rows; $i++){
        //get project entry
        //store response in $row
        $row = mysqli_fetch_assoc($result);
        $projectTitle = $row["projectName"];
        //return elements

        echo $projectTitle;
        echo "<br>";
        echo $row["projectDescription"];
        echo "<br>";
        echo $row["projectLink"];
        echo "<br>";

        $sql = "SELECT technologies.technology FROM projects
        JOIN technologies ON technologies.project = projects.projectName WHERE projectName = '{$projectTitle}';";
        $techResult = mysqli_query($conn, $sql);
        //get list of technolgies used for the project
        for($j = 0; $j < $techResult->num_rows; $j++){
            $techRow = mysqli_fetch_assoc($techResult);
            echo $techRow["technology"];
            echo "<br>";
        }
        echo "<br>";
    }
?>