<?php

echo <<<EOD
<!DOCTYPE html>

<html class="no-js"> 
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Error</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script>
            function backToHomePage(){
                document.location.href="/";
            }
        </script>
    </head>
    <body>
        <div style = "text-align: center; color: blue;">
            <h1>There are some Errors</h1><br>
            <button style ="background-color: #4CAF50;
                            color: white;
                            padding: 14px 20px;
                            margin: 8px 3px;
                            border: none;
                            cursor: pointer;"
                    onclick ="backToHomePage()"  >
                    Back to the Home Page
            </button>

        </div>
    </body>
</html>
EOD

?>
