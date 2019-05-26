<?php

function insertTextInputToDatabase ($user,$cipher,$input,$conn ){
        $stmt = $conn->prepare("INSERT INTO input (username, cipher, content ) VALUES (?, ?,?)");
        $stmt->bind_param("sss", $username, $cipherType, $content);     
        
        $username = $user;
        $cipherType = $cipher;
        $input = testInput ($input);
        $content = $conn->real_escape_string($input);
        $stmt->execute();
        if($stmt->affected_rows === 0){
            header('Location: '.'errorPage.php');
        }
        
        $stmt->free_result();     
        $stmt->close();
        $conn->close();

}
?>