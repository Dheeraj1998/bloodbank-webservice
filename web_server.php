<?php

//Login details
$servername = "mysql4.gear.host";
$username = "bloodbank";
$password = "vd3-ch8-LtU-Jcm";
$dbname = "bloodbank";

//Create connection
$conn = new mysqli("$servername", $username, $password, $dbname);

//Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//} 

//echo "Connected successfully";

//Create table query
//$sql = "CREATE TABLE BloodBank (Username VARCHAR(40) NOT NULL, Password VARCHAR(40) NOT NULL, Name VARCHAR(40) NOT NULL , BloodType VARCHAR(3) NOT NULL , MobNumber VARCHAR(10) NOT NULL, Location VARCHAR(40) NOT NULL, Allergies VARCHAR(40) NULL, PRIMARY KEY (UserName))";

//if ($conn->query($sql) === TRUE) {
//    echo "Table BloodBank created successfully!";} 
//else {
//    echo "Error creating table: " . $conn->error;
//}

//Getting all data from server
//Sample URL call is : http://localhost/PHP_Tutorial/web_service.php?admin
if(isset($_GET['admin'])){
    $sql = "SELECT * FROM BloodBank";

    $result = mysqli_query($conn ,$sql);
    $array = [];
    
    while($row = $result->fetch_assoc()){
        $array[] = $row;
    }
    
    header('Content-Type:Application/json');
    echo json_encode($array);
    mysqli_free_result($result);
}

//Inserting data
//Sample URL call is : http://localhost/PHP_Tutorial/web_service.php?type="insert"&username="Mohan1999"&password="123"&name="Mohan Patel"&bloodtype="O%2B"&mobilenumber="1234567890"&location="Vellore"&allergies="None"
elseif(isset($_GET['type'])){
    $username = $_GET['username'];
    $password = $_GET['password'];
    $name = $_GET['name'];
    $blood = $_GET['bloodtype'];
    $mobnumber = $_GET['mobilenumber'];
    $location = $_GET['location'];
    $allergy = $_GET['allergies'];
    
    $sql = "INSERT INTO BloodBank (UserName, Password, Name, BloodType, MobNumber, Location, Allergies) VALUES ($username, $password, $name, $blood, $mobnumber, $location, $allergy)";

    if ($conn->query($sql) === TRUE) {
        echo "You have been registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

//Validating the user according to the Username
//Sample URL call is : http://localhost/PHP_Tutorial/web_service.php?username="Dheeraj1998"&password="Dheeraj%401998"
elseif(!isset($_GET['login']) && isset($_GET['username']) && isset($_GET['password'])){
    $sql = "SELECT Password FROM BloodBank WHERE UserName = " . $_GET['username'];
    
    $result = mysqli_query($conn ,$sql);
    $row = mysqli_fetch_assoc($result);
    header('Content-Type:Application/json');
    
    if($row['Password'] == str_replace("\"", "", $_GET['password'])){
        echo 'Success';
    }
    else{
        echo 'Fail';
    }
    mysqli_free_result($result);
}

//Selecting all people with a particular bloodtype
//Sample URL call is : http://localhost/PHP_Tutorial/web_service.php?bloodtype="B%2B"
elseif(isset($_GET['bloodtype'])){
    $sql = "SELECT * FROM BloodBank WHERE BloodType = " . $_GET['bloodtype'];

    $result = mysqli_query($conn ,$sql);
    $array = [];
    
    while($row = $result->fetch_assoc()){
        $array[] = $row;
    }
    
    header('Content-Type:Application/json');
    echo json_encode($array);
    mysqli_free_result($result);
}

//Getting the details of a user by validating his username and password
//Sample URL call is: http://localhost/PHP_Tutorial/web_service.php?login=''&username='Dheeraj'&password='123'
elseif(!isset($_GET['modify']) && isset($_GET['login']) && isset($_GET['username']) && isset($_GET['password'])){
    $sql = "SELECT * FROM BloodBank WHERE UserName = " . $_GET['username'] . " AND Password = " . $_GET['password'];

    $result = mysqli_query($conn ,$sql);
    $row = $result->fetch_assoc();
    
    header('Content-Type:Application/json');
    echo json_encode($row);
    mysqli_free_result($result);
}

//Modifying the details of a user by validating his username and password
//Sample URL call is: http://dheerajprojects.gear.host/web_server.php?modify=''&username='Dheeraj1998'&mpass='123'&maller='Cold'&mblood='A%2B'&mmobilenumber="1231231231"&mname="Dheeraj"&mloc="Jamnagar"
elseif(isset($_GET['modify']) && isset($_GET['username'])){
    $sql = "UPDATE BloodBank SET Password = " . $_GET['mpass'] . ", Name = " . $_GET['mname'] . ", Location = " . $_GET['mloc'] . ", Allergies = " . $_GET['maller'] . ", MobNumber = " . $_GET['mmobilenumber'] . ", BloodType = " . $_GET['mblood'] . " WHERE UserName = " . $_GET['username'];
    
    if ($conn->query($sql) === TRUE) {
        echo "Details have been modified!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

else{
    echo "Hi! No parameters have been passed :)";
}
$conn->close();
?>