<?PHP 
session_start();

require_once 'dbLogin.php';
require_once  'createDB.php';
require_once  'css.php';
require_once  'javascript.php';
require_once  'signIn.php';
require_once  'signOut.php';
require_once  'signUp.php';
require_once  'cryptText.php';
require_once  'cryptFile.php';

$auth ="";

if (isset($_SESSION['username']) ) {
    if ($_SESSION['check'] == hash('ripemd128', $_SERVER['REMOTE_ADDR'] .$_SERVER['HTTP_USER_AGENT'] )){
        $auth = <<<EOD
            <form action="" method="post">
                <button class ="navButton" type="submit" name ="SignOutSubmit" style="float:right" >Sign Out</button>
            </form>         
EOD;

    }
}else {
        $auth =  <<<EOD
                    <button class ="navButton" onclick="document.getElementById('signUp').style.display='block'" style="float:right">Sign Up</button>
                    <button class ="navButton" onclick="document.getElementById('signIn').style.display='block'" style="float:right">Sign In</button>
EOD;
}



echo <<< _END
<!DOCTYPE html>
<html>
<head>
    <style>
        $css
    </style>

    <script>
    $headJavaScript
    </script> 

</head>

<body>

<div class="header">
  <h1>Decryptoid</h1>
  <p></p>
</div>

<div class="topnav">
  <button class ="navButton" onclick="changeText()" >Text</button>
    <button class ="navButton" onclick="changeDocument()" >Document</button>
      $auth 
</div>

<div id="signUp" class="modal">

    <form class="modal-content" action="" method="post">
        <span onclick="document.getElementById('signUp').style.display='none'" style ="cursor: pointer;float:right">❌</span>
        <h2>Sign Up</h2>
        <p>Please fill in this form to create an account.</p>
        <div>
            <label><b>Username</b></label>
            <input type="text" placeholder=" at leat 5 characters" name="username" maxlength="79" required pattern="[a-zA-Z0-9_-]{5,}" ><br><br>

            <label><b>Email</b></label>   &nbsp &nbsp &nbsp &nbsp 
            <input type="text" placeholder="example@abc.abc" name="email" maxlength="79" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"><br><br>

            <label><b>Password</b></label> 
            <input type="password" placeholder="at leat 8 characters" name="psw" maxlength="40"required pattern="[a-zA-Z0-9]{8,}"><br><br>

            <div style="background-color:#f1f1f1">
                <button type="submit" name ="SignUpSubmit" style = "background-color:  #4CAF50">Sign Up</button>
            </div>    
                
        </div>

    </form>
</div>

<div id="signIn" class="modal">
    <form class="modal-content" action="" method="post">

        <span onclick="document.getElementById('signIn').style.display='none'" style ="cursor: pointer;float:right">❌</span>
            <h2>Sign In</h2>
        <p>Please Enter Your Account.</p>

        <div >
            <label ><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" maxlength="79" required pattern="[a-zA-Z0-9_-]{5,}" ><br><br>

            <label ><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" maxlength="40"required pattern="[a-zA-Z0-9]{8,}" ><br><br>                  
            <div style="background-color:#f1f1f1">
                <button type="submit" name ="SignInSubmit"  style = "background-color:  #4CAF50">Login</button>                  
            </div>                   
        </div>

    </form>
</div>

<div class="row">
  <div >

    <div id="text" class="card" >

                 <form action="" method= "post"  >

                    <input type="radio" name="cipher" value="simpleSubstitution" checked onclick = "changeTextKeyConstrain(this.value)" > Simple Substitution &nbsp &nbsp
                    <input type="radio" name="cipher" value="doubleTransposition" onclick = "changeTextKeyConstrain(this.value)" > Double Transposition &nbsp &nbsp
                    <input type="radio" name="cipher" value="rc4" onclick = "changeTextKeyConstrain(this.value)"> RC4 <br><br>

                    <input type="radio" name="type" value="encrypt" onchange = "document.getElementById('textSubmit').innerHTML = 'Encrypt'" checked> Encrypt &nbsp &nbsp
                    <input type="radio" name="type" value="decrypt" onchange = "document.getElementById('textSubmit').innerHTML = 'Decrypt'" >  Decrypt &nbsp &nbsp <br>
                    <br>Key  &nbsp &nbsp
                    <input type="text" id= "textKey" placeholder="Number From 1-25" name="key"  required pattern = "^([1-9]|[1]\d|2[0-5])$">
                    <br><br>
                    <textarea name="textInput" required  ></textarea>
                    <br><br>

                    <button type="submit" id = "textSubmit" name="textSubmit">Encrypt</button> <br>
                </form>
    </div>

    <div id ="document" class="card">
                 <form action="" method= "post" enctype="multipart/form-data" onSubmit= "return handleDocSubmit(this)" >

                    <input type="radio" name="cipher" value="simpleSubstitution" onclick = "changeDocKeyConstrain(this.value)" checked > Simple Substitution &nbsp &nbsp
                    <input type="radio" name="cipher" value="doubleTransposition" onclick = "changeDocKeyConstrain(this.value)" > Double Transposition &nbsp &nbsp
                    <input type="radio" name="cipher" value="rc4" onclick = "changeDocKeyConstrain(this.value)" > RC4 <br><br>

                    <input type="radio" name="type" value="encrypt" onchange = "document.getElementById('fileSubmit').innerHTML = 'Encrypt'" checked> Encrypt &nbsp &nbsp
                    <input type="radio" name="type" value="decrypt" onchange = "document.getElementById('fileSubmit').innerHTML = 'Decrypt'" >  Decrypt &nbsp &nbsp <br>

                    <br>Key  &nbsp &nbsp
                    <input type="text" id = "docKey"placeholder="Number From 0-26" name="key"  required pattern = "^([1-9]|[1]\d|2[0-5])$" >
                    <br><br>
                    <input type="file"  name="uploadedfile" accept=".txt" required>
                    <br><br>
                    <button type="submit" id = "fileSubmit" name="FileSubmit">Encrypt</button> <br>

                </form>
    </div>
        <div id ="output" class="card" style = "display: block" >
             <textarea id="textOutput" readonly style= "">$result_content </textarea>
        </div>
  </div>


    <script>
        $bodyJavaScript
    </script>
</body>
</html>

_END
?>