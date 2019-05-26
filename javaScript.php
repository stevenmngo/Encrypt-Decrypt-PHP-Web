<?php
$headJavaScript = <<<EOD
 function changeTextKeyConstrain(cipherType){
        if (cipherType == "simpleSubstitution"){
            document.getElementById("textKey").placeholder = "Number From 1-25" 
            document.getElementById("textKey").pattern = "^([1-9]|[1]\d|2[0-5])$"
        }else if (cipherType == "doubleTransposition"){
            document.getElementById("textKey").placeholder = "Alphabet Letters"  
            document.getElementById("textKey").pattern = "[A-Za-z]+"
           
        }else if (cipherType == "rc4"){
            document.getElementById("textKey").placeholder = ""
            document.getElementById("textKey").pattern = ".{1,}"
        }
    }

    function changeDocKeyConstrain(cipherType){
        if (cipherType == "simpleSubstitution"){
            document.getElementById("docKey").placeholder = "Number From 1-25" 
            document.getElementById("doctKey").pattern = "^([1-9]|[1]\d|2[0-5])$"
        }else if (cipherType == "doubleTransposition"){
            document.getElementById("docKey").placeholder = "Alphabet Letters"  
            document.getElementById("docKey").pattern = "[a-zA-Z]+"

        }else if (cipherType == "rc4"){
            document.getElementById("docKey").placeholder = ""   
            document.getElementById("docKey").pattern = ".{1,}"
                     
        }
    }
    
    function handleTextSubmit(form){
        document.getElementById("output").innerHTML = form.textInput.value
        
    }

    function  handleDocSubmit(form){

    }

    function changeText (){
        sessionStorage.setItem("binary", "0");
        document.getElementById('document').style.display = 'none';
        document.getElementById('text').style.display = 'block';
    }

    function changeDocument (){
        sessionStorage.setItem("binary", "1");
        document.getElementById('text').style.display = 'none';
        document.getElementById('document').style.display = 'block';
    }



    document.addEventListener("DOMContentLoaded",() =>{
        if (sessionStorage.getItem("binary") == 1){
            document.getElementById('document').style.display = 'block'; 
        }else {
             document.getElementById('text').style.display = 'block';

        }
            window.onload = function() {
                history.replaceState("", "", "/");
                }

    }); 
            //     history.pushState(null, null, null);
        // window.addEventListener('popstate', function () {
        //     history.pushState(null, null, null);
       // });

EOD;

$bodyJavaScript = <<<EOD
            // Get the modal
            var modal01 = document.getElementById('signUp');
            var modal02 = document.getElementById('signIn');
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal01) {
                    modal01.style.display = "none";
                }
                if (event.target == modal02) {
                    modal02.style.display = "none";
                }
            }
EOD
?>