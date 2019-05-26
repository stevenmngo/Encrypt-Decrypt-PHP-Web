<?php
 
    function rc4( $str, $key) {

        $s = array();
        $j = $i = 0;
        $result = '';  
            
        for ($i = 0; $i < 256; $i++) {
            $s[$i] = $i;
        }
        
        for ($i = 0; $i < 256; $i++) {
            $j = ($j + $s[$i] + ord($key[$i %  mb_strlen($key, 'UTF-8')])) % 256;
            $temp = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $temp;
        }
        
        $j = 0;
        for ($z = 0; $z < mb_strlen($str, 'UTF-8') ; $z++) {
            $i = ($i + 1) % 256;
            $j = ($j + $s[$i]) % 256;
            $temp = $s[$i];
            $s[$i] = $s[$j];
            $s[$j] = $temp;
            $result .= mb_chr_helper(mb_ord_helper(mb_substr($str, $z, 1,'UTF-8')) ^ $s[($s[$i] + $s[$j]) % 256]);
        }
        return $result;
    }

    function mb_chr_helper($character) {
        return mb_convert_encoding('&#'.intval($character).';','UTF-8', 'HTML-ENTITIES');
    }

    function mb_ord_helper($character) {
        $result = unpack( 'N', mb_convert_encoding($character, 'UCS-4BE', 'UTF-8'));
        return (is_array($result) === true) ?  $result[1] : ord($character);
    }    
  
?>