<?php
define ('DB_NAME','E:\\xampp\\htdocs\\CRUD\\data\\db.txt');
 function seed(){
$data = array(
array(
       'id' => 1,
      'fname' => 'Monjur',
      'lname' => 'Ahmed',
      'idNo' => 1834902019,
      'age' => 20
 ),
 array(
       'id'=> 2,
       'fname' => 'Sia',
       'lname' => 'Tasnim',
       'idNo' => 1834902020,
       'age' => 21
  ),
  array(  'id'=> 3,
    'fname' => 'Riya',
        'lname' => 'Islam',
        'idNo' => 1834902021,
        'age' => 20
   ),
   array(  'id'=> 4,
     'fname' => 'Alex',
         'lname' => 'Rahat',
         'idNo' => 1834902022,
         'age' => 24
    ),
    array( 'id'=> 5,
      'fname' => 'Sifat',
          'lname' => 'Khan',
          'idNo' => 1834902023,
          'age' => 26
     ),
     array( 'id'=> 6,
       'fname' => 'Sadia',
           'lname' => 'Khan',
           'idNo' => 1834902024,
           'age' => 28
      ),
      array(  'id'=> 7,
        'fname' => 'Orin',
            'lname' => 'Ahmed',
            'idNo' => 1834902025,
            'age' => 30
       )

);
$serializedData= serialize($data);
file_put_contents(DB_NAME,$serializedData,LOCK_EX);

 }
 function generateReport(){
 $serializedData=file_get_contents(DB_NAME);
 $students= unserialize($serializedData);
?>
<table>
  <tr>
    <th>Name</th>
    <th>ID Number</th>
    <th>Age</th>
    <th>Action</th>
  </tr>

<?php foreach ($students as $student): ?>
<tr>
  <td><?php printf('%s %s',$student['fname'],$student['lname']); ?></td>
<td><?php printf('%s',$student['idNo']); ?></td>
<td><?php printf('%s',$student['age']); ?></td>
<td><?php printf('<a href="/CRUD/index.php?task=edit&id=%s">Edit</a> | <a href="/CRUD/index.php?task=delete&id=%s">Delete</a>',$student['id'],$student['id']); ?></td>
</tr>
<?php endforeach; ?>


</table>

<?php
}

function addStudent($fname,$lname,$idNo,$age){
  $serializedData=file_get_contents(DB_NAME);
  $students= unserialize($serializedData);
  $newID=getNewID($students);
  $student = array(
                   'id' =>$newID ,
                    'fname'=>$fname,
                     'lname'=>$lname,
                     'idNo' =>$idNo,
                      'age'=>$age
                     );
array_push($students,$student);
$serializedData= serialize($students);
file_put_contents(DB_NAME,$serializedData,LOCK_EX);
}

function getStudent($id){
  $serializedData=file_get_contents(DB_NAME);
  $students= unserialize($serializedData);
  foreach ($students as $student) {
    if($student['id']==$id){
      return $student;
    }
  }
  return false;
}

function updateStudent($id,$fname,$lname,$idNo,$age){
  $serializedData=file_get_contents(DB_NAME);
  $students= unserialize($serializedData);
  $students[$id-1]['fname']=$fname;
    $students[$id-1]['lname']=$lname;
      $students[$id-1]['idNo']=$idNo;
      $students[$id-1]['age']=$age;
      $serializedData= serialize($students);
      file_put_contents(DB_NAME,$serializedData,LOCK_EX);
}

function   deleteStudent($id){
  $serializedData=file_get_contents(DB_NAME);
  $students= unserialize($serializedData);
  unset($students[$id-1]);
  $serializedData= serialize($students);
  file_put_contents(DB_NAME,$serializedData,LOCK_EX);
}

function getNewID($students){
  $maxID=max(array_column($students,'id'));
  return $maxID+1;
}
