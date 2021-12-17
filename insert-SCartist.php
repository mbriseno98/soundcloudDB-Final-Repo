<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Artist Insert</title>
<style>
  body{
    background-color: rgb(235, 127, 38);
    font-family: Arial, Helvetica, sans-serif;
    font-size: 18px;
    color:black;
}
</style>
</head>
<body>
    <main role="main" class="container-fluid">
	<h1> Artist Insert</h1>
<?php
    

    $name=$_POST['name'];
    $age=$_POST['age'];
    $social_media=$_POST['social_media'];
    $label=$_POST['label'];
    


   /*
   $name=$_POST["name"];
    $artist_name=$_POST["artist_name"];
    $Genre=$_POST["Genre"];
    $Release_Date =$_POST["Release_Date"];
    $length=$_POST["length"];
    */

    if (!$name || !$age || !$social_media || !$label ) {
        echo "You have not entered all required details.  Please go back and try again.";
        exit;
    }

    //format input
    $name = addslashes($name);
    //echo "name: " . $name;
    $age = addslashes($age);
    //echo "Artist Name: " . $artist_name;
    $social_media = addslashes($social_media);
    $label = addslashes($label);
    

    //connect to the database
    @$db = new mysqli('soundclouddb.c6b8iw5lsmud.us-east-2.rds.amazonaws.com', 'mbriseno', 'hummerh33##', 'soundcloudDB');


    if ($db->connect_error) {
        die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
    } else {
        //echo "we in";
    }

    $sql = "INSERT INTO artists(name, age, social_media, label)
        VALUES ( ?, ?,?, ?);";

    $stmt = mysqli_stmt_init ($db);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "SQL error";
    } else {
        mysqli_stmt_bind_param($stmt, "siss", $name, $age,$social_media, $label);
        mysqli_stmt_execute($stmt);
        echo"Artist entry added";
    }
    
?>
    <br/>
    ><a href="show-SCartists.php">Back to Artist Catalog</a>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>