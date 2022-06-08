<?php
    include_once 'dbh.inc.php';
    include_once 'cors.php';
    include 'models\projectModel.php';
?>

<?php
    /* JSON format
        {
            "projects":[
                {
                    "projectName" : "$projectTitle",
                    "projectDescription" : "$row["projectDescription"]",
                    "projectLink" : "$row["projectLink"]",
                    "technologies" : ["$techRow["technology"]", "$techRow["technology"]", "$techRow["technology"]"]
                },
                {
                    "projectName" : "$projectTitle",
                    "projectDescription" : "$row["projectDescription"]",
                    "projectLink" : "$row["projectLink"]",
                    "technologies" : ["$techRow["technology"]", "$techRow["technology"]", "$techRow["technology"]"]
                },
                {
                    "projectName" : "$projectTitle",
                    "projectDescription" : "$row["projectDescription"]",
                    "projectLink" : "$row["projectLink"]",
                    "technologies" : ["$techRow["technology"]", "$techRow["technology"]", "$techRow["technology"]"]
                }
            ]
        }
        */
    cors();
    //sql statement will be set to production on host
    $sql = "SELECT projectName, projectDescription, projectLink FROM projects";
    //send query to database
    $result = mysqli_query($conn, $sql);
    //Build response list
    $output = array_fill(0, $result->num_rows, 0);
    for($i = 0; $i< $result->num_rows; $i++){
        //get project entry
        //store response in $row
        $row = mysqli_fetch_assoc($result);
        $projectTitle = $row["projectName"];
        $sql = "SELECT technologies.technology FROM projects
        JOIN technologies ON technologies.project = projects.projectName WHERE projectName = '{$projectTitle}';";
        $techResult = mysqli_query($conn, $sql);
        //get list of technolgies used for the project
        $carrier = array_fill(0,$techResult->num_rows, "");
        for($j = 0; $j < $techResult->num_rows; $j++){
            $techRow = mysqli_fetch_assoc($techResult);
            $carrier[$j] =  $techRow["technology"];
        }
        
        $output[$i] = new Project($projectTitle, $row["projectDescription"], $row["projectLink"], $carrier);
    }
    //Encode and return list of projects
    echo json_encode($output);

    
?>