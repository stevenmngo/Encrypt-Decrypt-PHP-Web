<?php
require_once 'testInput.php';
require_once 'dbLogin.php';
require_once 'userInputToDb.php';
require_once 'simpleSubstitution.php';
require_once 'doubleTransposition.php';
require_once 'rc4.php';


        if(isset($_POST["FileSubmit"])) {
                //check if there is error loading file 
               if (!($_FILES['uploadedfile']['error'] == UPLOAD_ERR_OK)               
                || !is_uploaded_file($_FILES['uploadedfile']['tmp_name'])) { 
                    header('Location: '.'errorPage.php');                    
                }
                // Check file size
                if ($_FILES['uploadedfile']['size'] > 65535) {
                    header('Location: '.'errorPage.php');
                }
                // check file type
                if ($_FILES['uploadedfile']['type'] != "text/plain") {
                    header('Location: '.'errorPage.php');
                }
                // check whether key or file is empty 
                if ( empty($_POST["key"]) || $_FILES['uploadedfile']['size'] == 0 ) { 
                    header('Location: '.'errorPage.php');
                }

                $input_text = file_get_contents($_FILES['uploadedfile']['tmp_name']);

            if ($_POST["cipher"] === "simpleSubstitution") {
                //key is number from 0-26
                if (!(Is_Numeric($_POST["key"] ) && floor($_POST["key"]) == $_POST["key"] 
                    && ($_POST["key"] <= 26 && $_POST["key"] >= 0) )){          
                    header('Location: '.'errorPage.php');
                }

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

                $cipher_key = strtolower($_POST["key"]);
                //key is alphabetical letters
                if (preg_match('/[^a-z]/', $cipher_key ) ) {
                    header('Location: '.'errorPage.php');
                }

                $input_text = strtolower($input_text);
                //input is alphabetical letters
                $input_text = preg_replace('/[^a-z]/' , "", $input_text );
                if (empty($input_text ) ){
                    header('Location: '.'errorPage.php');
                }

                //if user signed in then insert input into database
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

                //if user signed in then insert input into database                
                if ( isset($_SESSION['username'])  ){
                    if ($_SESSION['check'] == hash('ripemd128', $_SERVER['REMOTE_ADDR'] .$_SERVER['HTTP_USER_AGENT'] )){
                        $conn = new mysqli($hn, $un, $pw, $db);
                        if ($conn->connect_error) die($conn->connect_error);
                        insertTextInputToDatabase($_SESSION['username'], 'rc4', $input_text, $conn );
                    }
                }
                $result_content = rc4($input_text ,$_POST["key"]);

            }

    }
?>