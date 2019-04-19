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

    //print json encoded results
    echo json_encode( $resultArray );
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The request is using the POST method

    //session validation
    $succsess = false;
    $mysqli = mysqli_connect("localhost", "root", "", "timje_se");
    if (mysqli_connect_errno($mysqli)) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }


    
    /* create a prepared statement */
    if ($stmt = $mysqli->prepare("INSERT INTO `max_projects` (`name`, `image`, `description`, `short_description`, `link`, `github_link`) VALUES (?,?,?,?,?,? )")) {
        
        /* bind parameters for markers */
        $project_name = $_POST['name'];
        //$imageurl = $_FILES['image']; //relative link 
        $description = $_POST['description'] ;
        $shortdescription = $_POST['shortdescription'];
        $project_link = $_POST['url'];
        $github_link = $_POST['github'];

        $imageurl = uploadImage ($imageurl);
        
        $stmt->bind_param("ssssss", $project_name, $imageurl, $description, $shortdescription, $project_link, $github_link);

        /* execute query */
        $stmt->execute();

        $succsess = true;   
        $id = $mysqli->insert_id;
        echo $id;
        
        /* close statement */
        $stmt->close();
    }

    /* close connection */
    $mysqli->close();
    if($succsess){
        //print succsess statement and values inserted
        echo "<br>succsess";
    }
}


function uploadImage ($projectname) {
    
    $targetDir = 'images/uploads/';
    $targetFile = $targetDir . $projectname . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        return false;// "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        return false;// "File is not an image.";
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($targetFile)) {
        return false;// "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        return false;// "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        return false;// "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        return false;// "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            return false;// "Sorry, there was an error uploading your file.";
        }
    }
}

?>