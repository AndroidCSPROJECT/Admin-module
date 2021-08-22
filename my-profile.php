<?php
include('authentication.php');
include('includes/header.php');
?>
    <div class="container">
        <div class="row">
           
            <div class="col-md-12">
                 <div class="card">
                     <div class="card-header">
                         <h4>My Profile</h4>
                     </div>
                     <div class="card-body">
                         <?php

                         if(isset($_SESSION['verified_user_id'])){

                            $uid=$_SESSION['verified_user_id'];
                            $user = $auth->getUser($uid); 
                            ?>



                   
                         <form action="code.php" method="post" enctype="multipart/form-data">
                         <div class="row">
                             <div class="col-md-6">
                                 <div class="form-group mb-3">
                                     <label for="">Display Name</label>
                                     <input type="text" name="display_name" value=<?=$user->displayName;?> required class="form-control">
                                </div>
                             </div>
                           
                             <div class="col-md-6">
                             <div class="form-group mb-3">
                                     <label for="">Email Address</label>
                                     <div class="form-control">
                                     <?=$user->email?>
                                     </div>
                                </div>
                             </div>
                             <div class="col-md-6">
                             <div class="form-group mb-3">
                                     <label for="">Your role</label>
                                     <div class="form-control">
                                     <?php
                           
                           $claims=$auth->getUser($user->uid)->customClaims;
                           if(isset($claims['admin'])==true){
                              echo "Role : Admin";
                           }elseif(isset($claims['super_admin'])==true){
                               echo "Role : Super Admin";
                           }
                           elseif($claims==null){
                               echo "Role : No Role";
                           }
                          ?>
                                     </div>
                                </div>
                             </div>
                             <div class="col-md-6">
                             <div class="form-group mb-3">
                                     <label for="">Account Status (Disabled/Enabled)</label>
                                     <div class="form-control">
                                         <?php
                                     if($user->disabled){
                                   echo "Disabled";
                                  }
                                  else{
                                    echo "Enabled";
                                  }
                                  ?>
                                     </div>
                                </div>
                             </div>
                           </div>

                         <div class="col-md-4">
                             <div class="form-group border mb-3">
                                 <?php
                                 if($user->photoUrl !=NULL){
                                     ?>
                                    <img src="<?=$user->photoUrl?>" alt="User profile" class="w-50" >

                                    <?php
                                 }
                                 else{
                                     echo "Update your avatar";
                                 }
                                 ?>
                                 
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Upload Avatar</label>
                                <input type="file" name="profile" class="form-control">
                            </div>
                         </div>
                         <div class="col-md-12">
                             <hr>
                            <div class="form-group mb-3">
                                <button type="submit" name="update_user_profile" class="btn btn-primary float-end">Update Profile</button>
                            </div>

                         </div>
                        </form>
                        <?php

                         }
                    ?>
</div>
                 </div>
            </div>
        </div >
</div>
<?php
include('includes/footer.php');
?>