<?php

//Login details
$servername = "mysql4.gear.host";
$username = "bloodbank";
$password = "Wk602y_N66F_";
$dbname = "bloodbank";

//Create connection
$conn = new mysqli("$servername", $username, $password, $dbname);

//Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//} 

//echo "Connected successfully";

//Create table query
//$sql = "CREATE TABLE BloodBank (UserName VARCHAR(40) NOT NULL, Password VARCHAR(40) NOT NULL, Name VARCHAR(40) NOT NULL , BloodType VARCHAR(3) NOT NULL , Location VARCHAR(40) NOT NULL, Allergies VARCHAR(40) NULL, PRIMARY KEY (UserName))";

//if ($conn->query($sql) === TRUE) {
//    echo "Table BloodBank created successfully!";} 
//else {
//    echo "Error creating table: " . $conn->error;
//}

//Getting all data from server
if(isset($_GET['admin'])){
    $sql = "SELECT * FROM BloodBank";

    $result = mysqli_query($conn ,$sql);
    $array = [];
    
    while($row = $result->fetch_array()){
        $array[] = $row;
    }
    
    header('Content-Type:Application/json');
    echo json_encode($array);
    mysqli_free_result($result);
}

//Inserting data
//Sample URL call is : http://localhost/PHP_Tutorial/web_service.php?type="insert"&username="Mohan1999"&password="123"&name="Mohan Patel"&bloodtype="O%2B"&location="Vellore"&allergies="None"
elseif(isset($_GET['type'])){
    $username = $_GET['username'];
    $password = $_GET['password'];
    $name = $_GET['name'];
    $blood = $_GET['bloodtype'];
    $location = $_GET['location'];
    $allergy = $_GET['allergies'];
    
    $sql = "INSERT INTO BloodBank (UserName, Password, Name, BloodType, Location, Allergies) VALUES ($username, $password, $name, $blood, $location, $allergy)";

    if ($conn->query($sql) === TRUE) {
        echo "You have been registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

//Selecting the data according to the Username & Blood Type
//Sample URL call is : http://localhost/PHP_Tutorial/web_service.php?username="Dheeraj1998"
elseif(isset($_GET['username'])){
    $sql = "SELECT Password FROM BloodBank WHERE UserName = " . $_GET['username'];
    
    $result = mysqli_query($conn ,$sql);
    $row = mysqli_fetch_assoc($result);
    
    header('Content-Type:Application/json');
    echo json_encode($row);
    mysqli_free_result($result);
}

//Sample URL call is : http://localhost/PHP_Tutorial/web_service.php?bloodtype="B%2B"
elseif(isset($_GET['bloodtype'])){
    $sql = "SELECT * FROM BloodBank WHERE BloodType = " . $_GET['bloodtype'];

    $result = mysqli_query($conn ,$sql);
    $array = [];
    
    while($row = $result->fetch_array()){
        $array[] = $row;
    }
    
    header('Content-Type:Application/json');
    echo json_encode($array);
    mysqli_free_result($result);
}

else{
    echo "Hi! No parameters have been passed :)";
}
$conn->close();
?>