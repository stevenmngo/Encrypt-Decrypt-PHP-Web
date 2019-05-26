<?php
require_once 'dbLogin.php';
require_once 'testInput.php';

 
   if(isset($_POST["SignInSubmit"])) {
        try {
            //validate username
            if (!preg_match('/^[a-zA-Z0-9_-]{5,}$/', $_POST["username"])){
                header('Location: '.'errorPage.php');
            } 
            //validate password            
            if (!preg_match('/^[a-zA-Z0-9]{8,}$/', $_POST["psw"])){
                header('Location: '.'errorPage.php');
            }

            $conn = new mysqli($hn, $un, $pw, $db);
            if ($conn->connect_error) die($conn->connect_error);

            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $username = testInput($_POST["username"]);
            $stmt->execute();
            $result = $stmt->get_result();
            
            //check if there is username in the database
            if ($result->num_rows < 1) {
                echo <<<_END
                    <script>
                    alert("Username or Password is Incorrect!");
                    </script> 
                _END;
            } else {
                $row = $result->fetch_assoc();
                $salt = $row["salt"] ;
                $temp_pass = testInput($_POST["psw"]);
                $temp_pass = hash('ripemd160', "$salt$temp_pass$salt");
                
                //compare password
                if ($temp_pass === $row["password"] ){

                    $_SESSION['username'] = $username;
                    $_SESSION['check'] = hash('ripemd128', $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);

                }else {
                 echo <<<EOD
                    <script>
                    alert("Username or Password is Incorrect!");
                    </script>
                EOD;                   
                }
            }
                $stmt->free_result();           
                $stmt->close();
                $conn->close();

        }catch (RuntimeException $e) {
              header('Location: '.'errorPage.php');

        }
    }       
?>