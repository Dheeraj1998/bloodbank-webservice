<?php

//Login details
$servername = "mysql4.gear.host";
$username = "bloodbank";
$password = "vd3-ch8-LtU-Jcm";
$dbname = "bloodbank";

//Create connection
$conn = new mysqli("$servername", $username, $password, $dbname);

//Validating the user according to the Username
//Sample URL call is : http://localhost/PHP_Tutorial/web_service.php?username="Dheeraj1998"&password="Dheeraj%401998"
if(!isset($_GET['login']) && isset($_GET['username']) && isset($_GET['password'])){
    $sql = "SELECT Password FROM BloodBank WHERE Username = '" . $_GET['username'] . "'";
    
    $result = mysqli_query($conn ,$sql);
    $row = mysqli_fetch_assoc($result);
    header('Content-Type:Application/json');
    
    if($row['Password'] == $_GET['password']){
        echo 'Success';
        header('Location: http://localhost/Dheeraj_Files/bloodbank-webservice/dashboard.php?username=' . $_GET['username'] . "&password=" . $_GET['password']);
    }
    else{
        echo 'Fail';
    }
    mysqli_free_result($result);
}

//Getting the details of a user by validating his username and password
//Sample URL call is: http://localhost/PHP_Tutorial/web_service.php?login=''&username='Dheeraj'&password='123'
elseif(!isset($_GET['modify']) && isset($_GET['login']) && isset($_GET['username']) && isset($_GET['password'])){
    $sql = "SELECT * FROM BloodBank WHERE Username = " . $_GET['username'] . " AND Password = " . $_GET['password'];

    $result = mysqli_query($conn ,$sql);
    $row = $result->fetch_assoc();
    
    header('Content-Type:Application/json');
    echo json_encode($row);
    mysqli_free_result($result);
}

//Modifying the details of a user by validating his username and password
//Sample URL call is: http://dheerajprojects.gear.host/web_server.php?modify=''&username='Dheeraj1998'&mpass='123'&maller='Cold'&mblood='A%2B'&mmobilenumber="1231231231"&mname="Dheeraj"&mloc="Jamnagar"
elseif(isset($_GET['modify']) && isset($_GET['username'])){
    $sql = "UPDATE BloodBank SET Password = " . $_GET['mpass'] . ", Name = " . $_GET['mname'] . ", Location = " . $_GET['mloc'] . ", Allergies = " . $_GET['maller'] . ", MobNumber = " . $_GET['mmobilenumber'] . ", BloodType = " . $_GET['mblood'] . " WHERE Username = " . $_GET['username'];
    
    if ($conn->query($sql) === TRUE) {
        echo "Details have been modified!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>