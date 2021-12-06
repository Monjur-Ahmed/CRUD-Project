<?php
session_start();
if(isset($_POST['password']) && isset($_POST['username'])){
  if($_POST['username']=='admin' && $_POST['password']=='pass'){
     $_SESSION['loggedin']==true;
  }
  else {
    $_SESSION['loggedin']==false;
  }
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <title>Home</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.css">

  </head>
  <style media="screen">
    body{
      margin-top: 30px;
    }
  </style>

  <body>
    <div class="container">
      <div class="row">
        <div class="column column-60 column-offset-20">
            <h2>Welcome to CRUD Project Hello</h2>
</div>
</div>
<div class="row">
  <div class="column column-60 column-offset-20">
  <form  method="POST">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <button type="submit" class="button-primary" name="submit">Login</button>
  </form>
</div>
</div>
</div>
  </body>
</html>
