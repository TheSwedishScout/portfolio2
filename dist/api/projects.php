<?php
/*
{
    name: project-name,
    id: project-id,
    image: imageURL
    description: "project description"
    short description
    link: active url to deplyed project
    github: github url
    tech: [wordpres, html5, css3, javaScript, php]
}
*/

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // The request is using the GET method
    $mysqli = mysqli_connect("localhost", "root", "", "timje_se");
    if (mysqli_connect_errno($mysqli)) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    // $res = mysqli_query($mysqli, "select * from max_projects");
    $result = $mysqli->query("select id, name, image, description, short_description, link, github_link from max_projects");
    
    $resultArray = $result->fetch_all(MYSQLI_ASSOC);

    for ($i=0; $i < count($resultArray); $i++) { 
        
        $tools = gettools($resultArray[$i]['id'], $mysqli);
        $resultArray[$i]['tools'] = $tools;

    }
    // $tools = gettools(18, $mysqli);
    // var_dump($tools);
    //var_dump($resultArray);
    
    
    //print json encoded results
    echo json_encode( $resultArray );
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The request is using the POST method
    // var_dump($_POST);
    //session validation
    $succsess = true;
    $mysqli = mysqli_connect("localhost", "root", "", "timje_se");
    if (mysqli_connect_errno($mysqli)) {
        $succsess = false;
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }


    
    /* create a prepared statement */
    if ($stmt = $mysqli->prepare("INSERT INTO `max_projects` (`name`, `image`, `description`, `short_description`, `link`, `github_link`) VALUES (?,?,?,?,?,? )")) {
        
        /* bind parameters for markers */
        $project_name = $_POST['name'];
        //$imageurl = $_FILES['image']; //relative link 
        $description = $_POST['description'] ;
        $shortdescription = $_POST['short_description'];
        $project_link = $_POST['url'];
        $github_link = $_POST['github'];

        $tools = [];
        
        $php =          (isset($_POST['php']) && !empty($_POST['php'])) ?               $tools[]= 1 : null;
        $html5 =        (isset($_POST['html5']) && !empty($_POST['html5'])) ?           $tools[]= 2 : null;
        $css3 =         (isset($_POST['css3']) && !empty($_POST['css3'])) ?             $tools[]= 3 : null;
        $JavaScript =   (isset($_POST['JavaScript']) && !empty($_POST['JavaScript'])) ? $tools[]= 4 : null;
        $wordpress =    (isset($_POST['wordpress']) && !empty($_POST['wordpress'])) ?   $tools[]= 5 : null;
        
        $imageurl = uploadImage($project_name);
        if($imageurl === false ){
            echo "return false ".$imageurl;
            var_dump($imageurl);

            $succsess = false;   
        }
        
        $stmt->bind_param("ssssss", $project_name, $imageurl, $description, $shortdescription, $project_link, $github_link);

        /* execute query */
        if($succsess){
            $stmt->execute();

        }else{
            die("Something wrong killed action");
        }

        $succsess = true;   
        
        $id = $mysqli->insert_id; //respons med vilket id som sattes in
        echo $id;
        
        
        /* close statement */
        $stmt->close();
        
        // insert tools used
        foreach($tools as $tool){
            
            insertTool($id, $tool, $mysqli);
        }

    }

    /* close connection */
    $mysqli->close();
    if($succsess){
        //print succsess statement and values inserted
        echo "succsess";
    }
}

function insertTool($id, $tool, $mysqli)
{
    if ($stmt = $mysqli->prepare("INSERT INTO `max_projects_tech_connect` (`project_id`, `tech_id`) VALUES (?, ?);")) {
        $stmt->bind_param("ii", $id, $tool);

        /* execute query */
        
        $stmt->execute();
        $stmt->close();
        return true;
    }
}
function gettools($id, $mysqli)
{
    if ($stmt = $mysqli->prepare("select max_projects_techs.name from max_projects_techs, max_projects_tech_connect, max_projects WHERE max_projects.id = max_projects_tech_connect.project_id AND max_projects_tech_connect.tech_id = max_projects_techs.id AND max_projects.id = ?")){
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $tools = [];
        while ($row = $result->fetch_array(MYSQLI_NUM))
        {
            foreach ($row as $r)
            {
                $tools[] = $r;
            }
        }
        return $tools;
    }
    return false;
}
function uploadImage ($projectname) {
    
    $targetDir = '../images/uploades/';
    $targetFile = $targetDir . $projectname ."-". basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    var_dump($check);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        return false;// "File is not an image.";
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($targetFile)) {
        // echo "Sorry, file already exists.";
        return false;// "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        // echo "Sorry, your file is too large.";
        return false;// "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        return false;// "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        // echo "Sorry, your file was not uploaded.";
        return false;// "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        // echo $targetFile;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // echo "hej";
            return $targetFile;
        } else {
            // echo "hej";
            return false;// "Sorry, there was an error uploading your file.";
        }
    }
}

?>