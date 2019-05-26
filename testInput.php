<?php
function testInput($input) {
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlentities($input);
  return $input;
  }
?>