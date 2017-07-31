<html>
    <head>
        <title>Dashboard</title>
    </head>

    <body>
            <center>
                <h1>Your Account Details</h1>
                <br>
                <br>
                <table border="1">
                    <thead>
                        <tr>
                            <td>Username</td>
                            <td>Password</td>
                            <td>Name</td>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                            //Login details
                            $servername = "mysql4.gear.host";
                            $username = "bloodbank";
                            $password = "vd3-ch8-LtU-Jcm";
                            $dbname = "bloodbank";

                            //Create connection
                            $conn = new mysqli("$servername", $username, $password, $dbname);
                        
                            if(isset($_GET['modify']) && isset($_GET['username'])){
                                $sql = "UPDATE BloodBank SET Password = '" . $_GET['password'] . "', Name = '" . $_GET['name'] . "' WHERE Username = '" . $_GET['username'] . "';";

                                if ($conn->query($sql) === TRUE) {
                                    echo "Details have been modified!";
                                } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            }

                        
                            $sql = "SELECT * FROM BloodBank WHERE Username = '" . $_GET['username'] . "' AND Password = '" . $_GET['password'] . "';";
                        
                            $result = mysqli_query($conn ,$sql);
                            $row = $result->fetch_assoc(); ?>
                                <tr>
                                    <td><?php echo $row['Username']?></td>
                                    <td><?php echo $row['Password']?></td>
                                    <td><?php echo $row['Name']?></td>
                                </tr>
                    </tbody>
                </table>
                
                <form action = "dashboard.php" method="get">
                    <h2>Change your details below</h2>
                    <input type="text" hidden name="modify" id="modify">
                    <input type="text" hidden name="username" id="username" value="<?php echo $row['Username']?>">
                    <table border="0">
                        <tr>
                            <td><label for="username">Username</label></td>
                            <td><input type="text" disabled name="username" id="username" value="<?php echo $row['Username']?>"></td>
                        </tr>
                        
                        <tr>
                            <td><label for="password">Password</label></td>
                            <td><input name="password" type="text" id="password" value="<?php echo $row['Password']?>"></td>
                        </tr>
                        
                        <tr>
                            <td><label for="name">Name</label></td>
                            <td><input name="name" type="text" id="name" value="<?php echo $row['Name']?>"></td>
                        </tr>
                    </table>
                    
                    <input type="submit" value="Modify"/>
                </form>
    
        </center>
    </body>
</html>