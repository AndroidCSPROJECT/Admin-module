<?php
session_start();
include('dbcon.php');


if(isset($_POST['update_user'])){
    $key=$_POST['key'];
    $first_name=$_POST['first_name'];
    $surname=$_POST['surname'];
    $email=$_POST['email'];
  
  

    $updateData = [
        
        'firstName'=>$first_name,
        'surName'=>$surname,
        'email'=>$email,
    
    ];
    $ref_table='Users/'.$key;
    $updatequery_result=$database->getReference($ref_table)->update($updateData);
    if($updatequery_result){
        $_SESSION['status']="User updated successfully!";
        header('Location:index.php');
    }else{
        $_SESSION['status']="User not updated!";
        header('Location:index.php');
    }

}



if(isset($_POST['save_contact'])){
    $first_name=$_POST['first_name'];
    $surname=$_POST['surname'];
    $email=$_POST['email'];
  

    $postData = [
        'firstName'=>$first_name,
        'surName'=>$surname,
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