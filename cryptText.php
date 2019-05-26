<?php
require_once 'testInput.php';
require_once 'dbLogin.php';
require_once 'userInputToDb.php';
require_once 'simpleSubstitution.php';
require_once 'doubleTransposition.php';
require_once 'rc4.php';





    $result_content = ""; 

        if(isset($_POST["textSubmit"])) {
            //check if key or text input is empty 
            if (empty($_POST["textInput"]) || empty($_POST["key"]) ){
                header('Location: '.'errorPage.php');
            }

            if ($_POST["cipher"] == "simpleSubstitution") {
                //key is number 0-26
                if (!(Is_Numeric($_POST["key"] ) && floor($_POST["key"]) == $_POST["key"] 
                    && ($_POST["key"] <= 26 && $_POST["key"] >= 0) )){            
                    header('Location: '.'errorPage.php');
                }

                $input_text = $_POST["textInput"];

                //if user signed in then insert input into database                
                if ( isset($_SESSION['username'])  ){

                    if ($_SESSION['check'] == hash('ripemd128', $_SERVER['REMOTE_ADDR'] .$_SERVER['HTTP_USER_AGENT'] )){
                        $conn = new mysqli($hn, $un, $pw, $db);
                        if ($conn->connect_error) die($conn->connect_error);

                        insertTextInputToDatabase($_SESSION['username'], 'simSub', $input_text,$conn );
                    }
                }
                if ($_POST["type"] == "encrypt"){
                    $result_content = simpleSubstitution($input_text,$_POST["key"]);

                }else {
                    $temp_key = 26 - $_POST["key"];
                    $result_content = simpleSubstitution($input_text,$temp_key);
                    
                }
            } elseif ($_POST["cipher"] == "doubleTransposition" ) {

                //key is alphabetical letters
                $cipher_key = strtolower($_POST["key"]);
                if (preg_match('/[^a-z]/', $cipher_key ) ) {
                    header('Location: '.'errorPage.php');
                }
                
                //input is alphabetical letters
                $input_text = strtolower($_POST["textInput"]);
                $input_text = preg_replace('/[^a-z]/' , "", $input_text );
                if (empty($input_text ) ){
                    header('Location: '.'errorPage.php');
                }

                if ( isset($_SESSION['username'])  ){
                    if ($_SESSION['check'] == hash('ripemd128', $_SERVER['REMOTE_ADDR'] .$_SERVER['HTTP_USER_AGENT'] )){
                        $conn = new mysqli($hn, $un, $pw, $db);
                        if ($conn->connect_error) die($conn->connect_error);

                        insertTextInputToDatabase($_SESSION['username'], '2trans', $input_text, $conn );

                    }
                }
                if ($_POST["type"] == "encrypt"){
                    $result_content = doubleTransposition_encrypt($input_text, $cipher_key);

                }else {
                    $result_content = doubleTransposition_decrypt($input_text,$cipher_key);
                    
                }
            }elseif ($_POST["cipher"] == "rc4" ){

                if ( isset($_SESSION['username'])  ){
                    if ($_SESSION['check'] == hash('ripemd128', $_SERVER['REMOTE_ADDR'] .$_SERVER['HTTP_USER_AGENT'] )){
                        $conn = new mysqli($hn, $un, $pw, $db);
                        if ($conn->connect_error) die($conn->connect_error);
                        insertTextInputToDatabase($_SESSION['username'], 'rc4', $_POST["textInput"], $conn );
                    }
                }
                $input_text = $_POST["textInput"];
                $cipher_key = $_POST["key"];

                $result_content = rc4($input_text ,$cipher_key );

            }

    }
?>


