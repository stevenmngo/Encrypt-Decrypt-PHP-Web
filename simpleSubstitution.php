<?php
function simpleSubstitution($text, $key){
    return  preg_replace_callback('/[a-zA-Z]/',
    function ($char) use ($key) {
      return  chr(($char[0] <= 'Z' ? 90 : 122) >= ($char[0] = ord($char[0]) + $key) ? $char[0] : $char[0] - 26);
    },
    $text);
}
?>