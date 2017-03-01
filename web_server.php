<?php
//Login details
$servername = "sql6.freemysqlhosting.net";
$username = "sql6161476";
$password = "CPuShiiIXa";
$dbname = "sql6161476";

//Create connection
$conn = new mysqli("$servername", $username, $password, $dbname);

//Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//echo "Connected successfully";

//Create table query
//$sql = "CREATE TABLE BloodBank (UserName VARCHAR(40) NOT NULL, Password VARCHAR(40) NOT NULL, Name VARCHAR(40) NOT NULL , BloodType VARCHAR(3) NOT NULL , Location VARCHAR(40) NOT NULL, Allergies VARCHAR(40) NULL, PRIMARY KEY (UserName))";

//if ($conn->query($sql) === TRUE) {
//    echo "Table BloodBank created successfully!";} 
//else {
//    echo "Error creating table: " . $conn->error;
//}

//Inserting data
//$sql = "INSERT INTO BloodBank (UserName, Password, Name, BloodType, Location, Allergies) VALUES ('Dheeraj1998', 'Dheeraj@1998', 'Dheeraj Nair', 'B+', 'Jamnagar', 'Cold, Cough')";

//if ($conn->query($sql) === TRUE) {
//    echo "\nNew record created successfully!";
//} else {
//    echo "\nError: " . $sql . "<br>" . $conn->error;
//}

//Selecting all data
$sql = "SELECT * FROM BloodBank";
$result = mysqli_query($conn ,$sql);
	
while ($row = mysqli_fetch_assoc($result)) {
	$array[] = $row;
}

header('Content-Type:Application/json');
echo json_encode($array);
mysqli_free_result($result);

$conn->close();
?>