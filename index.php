<?php
session_start();
require_once "inc/functions.php";
$info='';
$task= $_GET['task'] ?? 'report';
if($task=='delete'){
  $id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
  if($id>0){
      deleteStudent($id);
      header('location: /CRUD/index.php?task=report');
  }
}
if($task=='seed'){
  seed();
  $info="Seeding is Complete";
}
if(isset($_POST['submit'])){
  $fname=filter_input(INPUT_POST,'fname',FILTER_SANITIZE_STRING);
  $lname=filter_input(INPUT_POST,'lname',FILTER_SANITIZE_STRING);
  $idNo=filter_input(INPUT_POST,'idNo',FILTER_SANITIZE_STRING);
  $age=filter_input(INPUT_POST,'age',FILTER_SANITIZE_STRING);
  $id=filter_input(INPUT_POST,'id',FILTER_SANITIZE_STRING);
  if($id){
    if($fname!= '' && $lname!='' && $age!= ''){
      updateStudent($id,$fname,$lname,$idNo ,$age);
      header('location: /CRUD/index.php?task=report');
    }

  }
  else {
  if($fname!= '' && $lname!='' && $idNo!='' && $age!= ''){
    addStudent($fname,$lname,$idNo,$age);
    header('location: /CRUD/index.php?task=report');
  }
}
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
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
          <h2>Welcome to CRUD Project</h2>
<p>A Simple project to perform CRUD operations Using Plain files and PHP</p>
<?php include_once ('inc/templates/nav.php'); ?>
<hr/>
<?php
if($info!=''){
  echo "<p>{$info}</p>";
}
 ?>
        </div>
      </div>
<?php if('report'==$task): ?>
      <div class="row">
        <div class="column column-60 column-offset-20">
        <?php generateReport(); ?>
      </div>
</div>
<?php endif; ?>

<?php if('add'==$task): ?>
      <div class="row">
        <div class="column column-60 column-offset-20">
        <form  action="/CRUD/index.php?report" method="POST">
          <label for="fname">First Name</label>
          <input type="text" name="fname" id="fname">
          <label for="lname">Last Name</label>
          <input type="text" name="lname" id="lname">
          <label for="idNo">ID Number</label>
          <input type="number" name="idNo" id="idNo">
          <label for="age">Age</label>
          <input type="number" name="age" id="age">
          <button type="submit" class="button-primary" name="submit">Save</button>
        </form>
      </div>
</div>
<?php endif; ?>
<?php if('edit'==$task):
$id=filter_input(INPUT_GET,'id',FILTER_SANITIZE_STRING);
$student=getStudent($id);
if($student):
   ?>
      <div class="row">
        <div class="column column-60 column-offset-20">
        <form  action="/CRUD/index.php?task=edit" method="POST">
          <input type="hidden" name="id" value="<?php echo $id ?>">
          <label for="fname">First Name</label>
          <input type="text" name="fname" id="fname" value="<?php echo $student['fname']; ?>">
          <label for="lname">Last Name</label>
          <input type="text" name="lname" id="lname" value="<?php echo $student['lname']; ?>">
          <label for="idNo">ID Number</label>
          <input type="number" name="idNo" id="idNo" value="<?php echo $student['idNo']; ?>">
          <label for="age">Age</label>
          <input type="number" name="age" id="age" value="<?php echo $student['age']; ?>">
          <button type="submit" class="button-primary" name="submit">Update</button>
        </form>
      </div>
</div>
<?php
 endif;
 endif;
?>

    </div>
  </body>
</html>
