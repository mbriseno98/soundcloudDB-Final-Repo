<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Album Insert</title>
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
	<h1> Album Insert</h1>
    
<?php
    

    $name=$_POST['name'];
    $artist=$_POST['artist'];
    $artist_name=$_POST['artist_name'];
    $Genre=$_POST['Genre'];
    $Release_Date=$_POST['Release_Date'];
    $length=$_POST['length'];


   /*
   $name=$_POST["name"];
    $artist_name=$_POST["artist_name"];
    $Genre=$_POST["Genre"];
    $Release_Date =$_POST["Release_Date"];
    $length=$_POST["length"];
    */

    if (!$name ||!$artist || !$artist_name || !$Genre || !$Release_Date || !$length) {
        echo "You have not entered all required details.  Please go back and try again.";
        exit;
    }

    //format input
    $name = addslashes($name);
   // echo "name: " . $name;
    $artist = addslashes($artist);
    $artist_name = addslashes($artist_name);
   // echo "Artist Name: " . $artist_name;
    $Genre = addslashes($Genre);
    $Release_Date = addslashes($Release_Date);
    $length = addslashes($length);

    //connect to the database
    @$db = new mysqli('soundclouddb.c6b8iw5lsmud.us-east-2.rds.amazonaws.com', 'mbriseno', 'hummerh33##', 'soundcloudDB');


    if ($db->connect_error) {
        die('Connect Error ' . $db->connect_errno . ': ' . $db->connect_error);
    } else {
        //echo "we in";
    }

    $sql = "INSERT INTO albums(name, artist, artist_name, length,Release_Date, Genre)
        VALUES ( ?, ?, ?, ?, ?, ?);";

    $stmt = mysqli_stmt_init ($db);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "SQL error";
    } else {
        mysqli_stmt_bind_param($stmt, "sissss", $name, $artist,$artist_name, $length, $Release_Date, $Genre);
        mysqli_stmt_execute($stmt);
        echo $stmt->affected_rows." album successfully inserted into database";
    }
    /*$stmt = $db->prepare("INSERT INTO albums (name, artist_name, length, Genre, Release_Date,) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $artist_name, $length,$Release_Date,$Genre);
    */ 
/*
    $sql = "insert into albums values (?, ?, ?, ?, ?, ?)";
    if($query = $db->prepare($sql)) { // assuming $mysqli is the connection
        $query->bind_param("issss", 1, $name, $artist_name, $Genre, $Release_Date, $length);
        $query->execute();
        // any additional code you need would go here.
    } else {
        $error = $db->errno . ' ' . $db->error;
        echo $error; // 1054 Unknown column 'foo' in 'field list'
    }

/*
    $query = "insert into albums values (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("sssss", $name, $artist_name, $Genre, $Release_Date, $length);
    $stmt->execute();
    echo $stmt->affected_rows."albums inserted into database";
*/
    $db->close();
?>
    <br/>
    ><a href="show-SCalbums.php">Back to Album Catalog</a>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>