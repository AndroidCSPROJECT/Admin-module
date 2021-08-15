<?php
session_start();
include('dbcon.php');
if(isset($_POST['save_contact'])){
    $first_name=$_POST['first_name'];
    $surname=$_POST['surname'];
    $email=$_POST['email'];
  

    $postData = [
        'fname'=>$first_name,
        'surname'=>$surname,
        'email'=>$email,
    
    ];
$ref_table="Users";
$postRef_result = $database->getReference($ref_table)->push($postData);

if($postRef_result){
    $_SESSION['status']="User added successfully!";
    header('Location:index.php');
}else{
    $_SESSION['status']="User not added!";
    header('Location:index.php');
}
}
?>