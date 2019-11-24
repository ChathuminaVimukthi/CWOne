<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Database Error</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          crossorigin="anonymous">
    <style type="text/css">
        body, html {
            height: 100%;
        }

        .headline-login{
            font-size: 24px;
            color: #333333;
            line-height: 1.2;
            text-align: center;

            width: 100%;
            display: block;
            padding-bottom: 54px;
        }

        .body-background{
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #9053c7;
            background: linear-gradient(-135deg, #c850c0, #4158d0);
        }

        .headline-login{

        }

        .form-wrapper{
            width: 960px;
            background: #fff;
            border-radius: 10px;
            padding: 30px 30px 30px 30px;
        }

        .logo-pic {
            width: 200px;
        }

        .logo-pic img {
            max-width: 100%;
        }

        .wrap-input {
            position: relative;
            width: 100%;
            z-index: 1;
            margin-bottom: 10px;
        }

        .input {
            font-size: 15px;
            line-height: 1.5;
            color: #666666;

            display: block;
            width: 100%;
            background: #e6e6e6;
            height: 40px;
            border-radius: 25px;
            padding: 0 30px 0 68px;
        }

        .container-login-form-btn {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding-top: 20px;
        }

        .login-form-btn {
            font-size: 15px;
            line-height: 1.5;
            color: #fff;
            text-transform: uppercase;

            width: 100%;
            height: 50px;
            border-radius: 25px;
            background: #57b846;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 25px;
            transition: all 0.4s;
        }
        .container-navigate-btn {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .navigate-btn {
            font-size: 15px;
            line-height: 1.5;
            color: #fff;
            text-transform: uppercase;

            width: 100%;
            height: 50px;
            border-radius: 25px;
            background: #565457;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 25px;
            transition: all 0.4s;
        }

        .login-form-btn:hover {
            background: #333333;
        }

        .navigate-btn:hover {
            background: #333333;
        }
    </style>
</head>
<body class="body-background">
<div class="form-wrapper" id="container">
    <h1><?php echo $heading; ?></h1>
    <?php echo $message; ?>
</div>
</body>
</html>