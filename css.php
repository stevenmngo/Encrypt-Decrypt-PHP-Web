<?php
    $css = <<<EOD
        * {
        box-sizing: border-box;
        }

        body {
        font-family: Arial;
        padding: 10px;
        background: #f1f1f1;
        }

        /* Header/Blog Title */
        .header {
        padding: 20px;
        text-align: center;
        background: white;
        }

        .header h1 {
        font-size: 50px;
        }

        /* Style the top navigation bar */
        .topnav  {
        overflow: hidden;
        background-color: #aaa;
        }

        .navButton {
            width : auto;
            float:left;
            background-color: #aaa;
        }




        /* The Modal (background) */
        .modal {
        text-align: center;
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: #474e5d;
        padding-top: 50px;
        }

        /* Modal Content/Box */
        .modal-content {
        background-color:  #f2f2f2;
        margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 65%; /* Could be more or less, depending on screen size */
        }
        /* Set a style for all buttons */
        button {
        font-size: 14px;
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 3px;
        border: none;
        cursor: pointer;

        }



        button:hover {
        opacity: 0.8;
        background-color: #4CAF50;
        color: black;
        }



        /* Add a card effect for articles */
        .card {
        background-color: white;
        padding: 20px;
        margin-top: 20px;
        display: none;
        }

        /* Clear floats after the columns */
        .row:after {
        content: "";
        display: table;
        clear: both;
        }

        textarea {
        overflow: scroll;
        resize: none;
        box-sizing: border-box;
        height: 110px; 
        direction: ltr; 
        padding-bottom: 18px;
        width: 75%;
        }
EOD
?>