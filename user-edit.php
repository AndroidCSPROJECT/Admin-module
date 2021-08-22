<?php
include('authentication.php');
include('includes/header.php');
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
            <?php
            if(isset($_SESSION['status'])){
                echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                unset($_SESSION['status']);
            }
            ?>
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Update Authenticated user
                           
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                            <?php
                            include('dbcon.php');

                            if(isset($_GET['id'])){
                                $uid=$_GET['id'];
                                try {
                                    $user = $auth->getUser($uid);
                                    ?>
                                    <input type="hidden" name="user_id" value="<?=$uid?>">
                                       <div class="form-group mb-3">
                             <label for="fullname">Display Name</label>
                             <input type="text" name="display_name" value=<?=$user->displayName;?> class="form-control">
                           </div>
                           <div class="form-group mb-3">
                             <label for="">Email</label>
                             <input type="text" name="email" value=<?=$user->email;?> class="form-control">
                           </div>
                          
                           <div class="form-group mb-3">
                               <button type="submit" name="update_user_btn" class="btn btn-primary">Update User</button>
                           </div>

                                    <?php
                                   
                                } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
                                    echo $e->getMessage();
                                }
                            }
                          
                           
                            ?>
                        
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Enable or Disable User Account</h4>
                    </div>
                    <div class="card-body">
                    <form action="code.php" method="POST">
                        <?php
                        if(isset($_GET['id'])){
                         $uid=$_GET['id'];
                         try {
                            $user = $auth->getUser($uid);
                           ?>

                      <input type="hidden" name="ena_dis" value="<?=$uid;?>">
                      <div class="input-group mb-3">
                          <select name="select_enable_disable" class="form-control" required>
                              <option value="" >Select</option>
                              <option value="enable" >Enable</option>
                              <option value="disable" >Disable</option>
                          </select>
                          <Button type="submit" name="enable_disable_btn" class="input-group-text btn btn-primary">Submit</Button>
                       </div>
                       
                       <?php  
                        } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
                            echo $e->getMessage();
                        }
                        }
                        else{
                            echo "No user found!";
                        }
                        ?>
                        </form>
                    </div>
                </div>
            </div>
           
           
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Custom User Claims</h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                            <?php
                             if(isset($_GET['id'])){
                                 $uid=$_GET['id'];
                                 ?>

                              
                            <input type="hidden" name="user_claims_id" value="<?=$uid;?>">
                            <div class="form-group mb-3">
                                <select name="role_as" class="form-control"required>
                                 <option value="">Select Role</option>
                                 <option value="admin">Admin</option>
                                 <option value="super_admin">Super Admin</option>
                                 <option value="norole">Remove Role</option>
                                </select>
                           </div>
                           <label for="">Currently: User role is :</label>
                           <h4 class="border bg-warning p-2">
                           <?php
                           
                            $claims=$auth->getUser($uid)->customClaims;
                            if(isset($claims['admin'])==true){
                               echo "Role : Admin";
                            }elseif(isset($claims['super_admin'])==true){
                                echo "Role : Super Admin";
                            }
                            elseif($claims==null){
                                echo "Role : No Role";
                            }
                           ?>
                           </h4>
                           <div class="form-group mb-3">
                             <button type="submit" name="user_claims_button" class="btn btn-primary">Submit</button>
                           </div>
                           <?php
                             }
                            ?>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php
include('includes/footer.php');
?>

   