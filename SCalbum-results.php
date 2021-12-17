<!DOCTYPE html>
<html lang = "en">

<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Album Results</title>
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
<a href="show-SCalbums.php">Back to Album Catalog</a>
    <main role = "main" class ="container-fluid"> 
        <h1> Album Search Results </h1>
        <?php 
            $searchtype = $_POST["searchtype"];
            $searchterm = trim ($_POST ["searchterm"]);
           // echo "$searchtype $searchterm";

            if (!$searchtype || !$searchterm){
                echo "You have not entered search details. Please try again.";
                exit;
            }

            $db = new mysqli('soundclouddb.c6b8iw5lsmud.us-east-2.rds.amazonaws.com', 'mbriseno', 'hummerh33##', 'soundcloudDB');

            if ($db->connect_error){
                die("Connect error".$db->connect_errorno.":".$db->connect_error);

            }
            $query ="SELECT * FROM albums WHERE $searchtype LIKE '%$searchterm%'";
          //echo $query; 

            $result = $db->query($query);

            $num_results = $result -> num_rows;

            echo "<p>Number of albums found: $num_results</p>"; 
          

            for ($i =0; $i<$num_results; $i++){
                $row = $result->fetch_assoc();

                
                
                echo "<p><strong> Album Title: ";
                echo $row["name"]."</strong><br/>";
                echo "Artist: ".$row["artist_name"]."<br/>";
                echo "Genre: ".$row["Genre"]."<br/>";
            

            }
            $result -> free();
            $db -> close();
            


            
          
         
            

        ?>
</body>
</html> 