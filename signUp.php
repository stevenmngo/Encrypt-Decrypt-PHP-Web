<?php
require_once 'dbLogin.php';

require_once 'testInput.php';

    if(isset($_POST["SignUpSubmit"])) {
        try {
            //validate username
            if (!preg_match('/^[a-zA-Z0-9_-]{5,}$/', $_POST["username"])){
                header('Location: '.'errorPage.php');
            } 
            //validate email
            if (!preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/', $_POST["email"])){
                header('Location: '.'errorPage.php');
            }
            //validate password
            if (!preg_match('/^[a-zA-Z0-9]{8,}$/', $_POST["psw"])){
                header('Location: '.'errorPage.php');
            }
             
            $conn = new mysqli($hn, $un, $pw, $db);
            if ($conn->connect_error) die($conn->connect_error);

            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
            $stmt->bind_param("ss", $_POST['username'], $_POST['email']);
            $stmt->execute();
            $result = $stmt->get_result();

            //check if the username or email already exist 
            if ($result->num_rows > 0) {
                echo <<<EOD
                    <script>
                        alert("Username or Email Already Exist!");
                    </script>
                EOD;
            }else {
                //insert username, email, hash of password, and salt into database
                $stmt1 = $conn->prepare("INSERT INTO users (username, email, password, salt) VALUES (?, ?, ?,?)");
                $stmt1->bind_param("ssss", $username,$email, $password, $salt);

                $username = testInput($_POST['username']);
                $email = testInput($_POST["email"]);
                $salt = generateSalt();
                $temp_pass = testInput($_POST['psw']);
                $password = hash('ripemd160', "$salt$temp_pass$salt");
                $stmt1->execute();
                if($stmt1->affected_rows === 0) exit('Error may occur. No Insert');

                $stmt1->free_result();             
                $stmt1->close();
                echo <<<EOD
                    <script>
                        alert("Sign Up succeed!");
                    </script>
                EOD;              
            } 
                $stmt->free_result();           
                $stmt->close();
                $conn->close();

        }catch (RuntimeException $e) {
             header('Location: '.'errorPage.php');
        }
    }

    function generateSalt() {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $input = "";
        for ($i = 0; $i < 4; $i++) {
            $input .= $characters[mt_rand(0, (strlen($characters) - 1))];
        }
        return $input;
    }        

?>