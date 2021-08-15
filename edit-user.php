<?php
include('includes/header.php');
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Edit & Update User
                            <a href="index.php" class="btn btn-danger float-end">
                                Back
                            </a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                         include('dbcon.php');

                         if(isset($_GET['id'])){
                         $key_child=$_GET['id'];
                         $ref_table="Users";
                         $getdata = $database->getReference($ref_table)->getChild($key_child)->getValue();

                         if($getdata>0){
                             ?>
                           <form action="code.php" method="POST">
                            <input type="hidden" name="key" value="<?=$key_child;?>">
                           <div class="form-group mb-3">
                             <label for="firstname">First Name</label>
                             <input type="text" name="first_name" class="form-control" value="<?=$getdata['firstName']?>">
                           </div>
                           <div class="form-group mb-3">
                             <label for="">Surname</label>
                             <input type="text" name="surname" class="form-control"  value="<?=$getdata['surName']?>" >
                           </div>
                           <div class="form-group mb-3">
                             <label for="">Email</label>
                             <input type="email" name="email" class="form-control" value="<?=$getdata['email']?>" >
                           </div>
                           <div class="form-group mb-3">
                               <button type="submit" name="update_user" class="btn btn-primary">Update User</button>
                           </div>
                           </form>
                         <?php
                         }
                         else{
                             $_SESSION['status']="Invalid Id";
                             header('Location:index.php');
                             exit();
                         }
                         }
                         else{
                            $_SESSION['status']="Not Found";
                            header('Location:index.php');
                            exit();
                        }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
include('includes/footer.php');
?>

   