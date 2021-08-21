<?php
session_start();
include('dbcon.php');

if(isset($_POST['register_btn'])){
    $fullname=$_POST['full_name'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $userProperties = [
        'email' => $email,
        'emailVerified' => false,
        'phoneNumber' => '+15555550100',
        'password' => $password,
        'displayName' =>  $fullname,
        'photoUrl' => 'http://www.example.com/12345678/photo.png',
        'disabled' => false,
    ];
    $createdUser = $auth->createUser($userProperties);    
    if( $createdUser){
        $_SESSION['status']="Registered successfully!";
        header('Location:register.php');
        exit();
    }
    else{
        $_SESSION['status']="Failed to registered!";
        header('Location:register.php');
        exit();
    }
}

if(isset($_POST['delete_btn'])){
    $del_id=$_POST['delete_btn'];
    $ref_table='Users/'.$del_id;
    $deletequery_result=$database->getReference($ref_table)->remove();
    if($deletequery_result){
        $_SESSION['status']="User deleted successfully!";
        header('Location:index.php');
    }else{
        $_SESSION['status']="User not deleted!";
        header('Location:index.php');
    }

}
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