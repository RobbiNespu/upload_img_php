<?php

// Create connection
$con = mysqli_connect("localhost","root","","temp_anis");
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT url,id FROM upload_img WHERE 1";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Image: " .$row["id"]. $row["url"]. "<br>";
        echo "<br/><img src=\"{$row["url"]}\"/><br/>";
    }
} else {
    echo "0 results";
}
$con->close();
?>