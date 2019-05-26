<?php
 function doubleTransposition_encrypt($plainText, $key){

	while(strlen($plainText) % strlen($key) != 0) {
        $plainText .= 'x';
    }
    $numRow =  strlen($plainText) / strlen($key);
    $letters = "abcdefghijklmnopqrstuvwxyz";
    $cipherText = "";
    $letter_counter = 0;

    for($i=0; $i < strlen($key); $i++){
        while ($letter_counter  <26){
            $letter_position = strpos($key,$letters[$letter_counter] ) ;
            if (!empty($letter_position ) || $letter_position  === 0){
                $key[$letter_position] = "-";            
                break;
            }else {
                 $letter_counter++;
            }
        }
        for($j=0; $j < $numRow; $j++){
            $cipherText .= $plainText[$j * strlen($key) + $letter_position ];
        }
    }
    return $cipherText ;
}
function doubleTransposition_decrypt($cipherText, $key){
    $colsArr = array_fill(0, strlen($key) , "");
    $rowsNum = strlen($cipherText) / strlen($key);

    for($i=0; $i < strlen($key); $i++){
        $colsArr[$i] = substr($cipherText, $i * $rowsNum, $rowsNum );
    }
    $arrangedColsArr = array_fill(0, strlen($key) , "");
    $letters ="abcdefghijklmnopqrstuvwxyz";      
    $letter_counter = $i = 0;
    while ($i < strlen($key)){

        $letter_position = strpos($key, $letters[$letter_counter]) ;
        if (!empty($letter_position ) || $letter_position  === 0){    
            if($letter_counter == 25){
            }
            $arrangedColsArr[$letter_position] = $colsArr[$i++];
            $key[$letter_position] = "-"; 
            if($letter_counter == 25){
            }
        }else {
                $letter_counter++;
        }   
    }
    $plainText = "";
	    for($i=0; $i < $rowsNum; $i++){
	        for($j=0; $j < strlen($key); $j++) {
                $plainText .= $arrangedColsArr[$j][$i];
            }
        }
    return $plainText;      

}

?>