<?php
session_start();
include('dbcon.php');


if(isset($_POST['update_user_profile'])){

    $display_name=$_POST['display_name'];
   
    $profile=$_FILES['profile']['name'];
    $random_no=rand(1111,9999);

    $uid=$_SESSION['verified_user_id'];
    $user=$auth->getUser($uid);

    $new_image=$random_no.$profile;
    $old_image=$user->photoUrl;

    if($profile !=NULL){
           $filename="uploads/".$new_image;
    }
    else{
        $filename=$old_image;
    }

    $properties=[
        'displayName'=>$display_name,
        
        'photoUrl'  =>$filename,
    ];
    $updatedUser=$auth->updateUser($uid,$properties);
    if($updatedUser){
        if($profile !=NULL){
           move_uploaded_file($_FILES['profile']['tmp_name'],"uploads/".$new_image);
           if($old_image !=null){
               unlink($old_image);
           }
        }
        $_SESSION['status']="User profile updated successfully";
        header("Location:my-profile.php");
        exit(0);
 }
 else{
    $_SESSION['status']="User profile not updated";
    header("Location:my-profile.php");
    exit(0); 
 }
   
}



if(isset($_POST['user_claims_button'])){

    $uid=$_POST['user_claims_id'];
    $roles=$_POST['role_as'];

    if($roles=='admin'){
     $auth->setCustomUserClaims($uid,['admin'=>true]);
     $msg="User role as Admin";
    }
    else if($roles=='super_admin'){
        $auth->setCustomUserClaims($uid,['super_admin'=>true]);
        $msg="User role as Super Admin";

    }
    else if($roles=='norole') {
        $auth->setCustomUserClaims($uid,null);
        $msg="User role is removed";
    }

    
   if($msg){
    $_SESSION['status']="$msg";
    header("Location:user-edit.php?id=$uid");
   }else{
    $_SESSION['status']="User not updated!";
    header("Location:user-edit.php?id=$uid");
   }

}








if(isset($_POST['enable_disable_btn'])){

    $disable_enable=$_POST['select_enable_disable'];
    $uid =$_POST['ena_dis'];
    if($disable_enable == "disable"){
        

        $updatedUser = $auth->disableUser($uid);
        $msg="Account Disabled";

    }else{
       

        $updatedUser = $auth->enableUser($uid);
        $msg="Account Enabled";
    }
    if( $updatedUser){
        $_SESSION['status']=$msg;
        header('Location:user-list.php');
       }else{
        $_SESSION['status']="Something went wrong!";
        header('Location:user-list.php');
       }
}

if(isset($_POST['reg_user_del_btn'])){
    $uid=$_POST['reg_user_del_btn'];
   try{
    $auth->deleteUser($uid);
    $_SESSION['status']="User deleted successfully!";
    header('Location:user-list.php');
    exit();
   }
   catch(Exception $e){
    $_SESSION['status']="No id found!";
    header('Location:user-list.php');
    exit();
   }

  
}

if(isset($_POST['update_user_btn'])){
    $display_name=$_POST['display_name'];
    $email=$_POST['email'];
    $uid =$_POST['user_id'];

    $properties = [
    'displayName' => $display_name,
    'email'       => $email,
    ];

   $updatedUser = $auth->updateUser($uid, $properties);

   if( $updatedUser){
    $_SESSION['status']="User updated successfully!";
    header('Location:user-list.php');
   }else{
    $_SESSION['status']="User not updated!";
    header('Location:user-list.php');
   }

   }
if(isset($_POST['register_btn'])){
    $fullname=$_POST['full_name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    //here we verify the registration email
    $actionCodeSettings = [
       // 'continueUrl' => 'http://localhost/Parking%20Finder/Parking-Finder-Web/login.php',
        'continueUrl' => 'http://parkingfinderapp.herokuapp.com/login.php',
        'handleCodeInApp' => false,
        
    ];
    $link = $auth->getSignInWithEmailLink($email, $actionCodeSettings);
    
    //End of email verification
    $userProperties = [
        'email' => $email,
        'emailVerified' =>true,
       
        'password' => $password,
        'displayName' =>  $fullname,
       
        'disabled' => false,
    ];
    $createdUser=$auth->sendSignInWithEmailLink($email, $actionCodeSettings);  
   $createdUser = $auth->createUser($userProperties);    
    if( $createdUser){
        /*$_SESSION['status']="Registered successfully! Please Login to continue";
        header('Location:login.php');*/
        header('Location:verifyemail.html');
        exit();
    }
    else{
        $_SESSION['status']="Failed to register!";
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