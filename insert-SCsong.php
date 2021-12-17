<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Insert Song</title>
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
	<h1>Song Insert</h1>
<?php
    
    
    
    $name=$_POST['name'];
    $album=$_POST['album'];
    $artist=$_POST['artist'];
    $genre=$_POST['genre'];
    $album_title=$_POST['album_title'];
  

   /*
   $name=$_POST["name"];
    $artist_name=$_POST["artist_name"];
    $Genre=$_POST["Genre"];
    $Release_Date =$_POST["Release_Date"];
    $length=$_POST["length"];
    */

    if (!$name ||!$album || !$artist || !$genre || !$album_title) {
        echo "You have not entered all required details.  Please go back and try again.";
        exit;
    }

    //format input
    $name = addslashes($name);
   // echo "name: " . $name;
    $album = addslashes($album);
    $artist = addslashes($artist);
   // echo "Artist Name: " . $artist_name;
    $genre = addslashes($genre);
    $album_title = addslashes($album_title);
    

    //connect to the database
    @$db = new mysqli('soundclouddb.c6b8iw5lsmud.us-east-2.rds.amazonaws.com', 'mbriseno', 'hummerh33##', 'soundcloudDB');


    if ($db->connect_error) {
        die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
    } else {
        //echo "we in";
    }

    $sql = "INSERT INTO songs(name, album, artist, genre, album_title)
        VALUES ( ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init ($db);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "SQL error";
    } else {
        mysqli_stmt_bind_param($stmt, "sisss", $name, $album,$artist, $genre, $album_title);
        mysqli_stmt_execute($stmt);
        echo $stmt->affected_rows." album successfully inserted into database";
    }

    $db->close();
?>
    <br/>
    ><a href="show-SCsongs.php">Back to Song Catalog</a>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>