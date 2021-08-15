<?php
session_start();
include('includes/header.php');
?>
    <div class="container">
        <div class="row">
           
            <div class="col-md-12">
            <?php
            if(isset($_SESSION['status'])){
                echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
                unset($_SESSION['status']);
            }
            ?>
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Registered Users
                            <a href="add-contact.php" class="btn btn-primary float-end">
                                Add User
                            </a>
                        </h4>
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>Serial Number</th>
                                  <th>First Name</th>
                                  <th>Surname</th>
                                  <th>Email</th>
                                  <th>Edit</th>
                                  <th>Delete</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                               include('dbcon.php');
                               $ref_table="Users";
                               $fetchData = $database->getReference($ref_table)->getValue();
                               if($fetchData>0){
                                   $i=0;
                                   foreach($fetchData as $key => $row){
                                       ?>
                                   <tr>
                                       <td><?=$i++;?></td>
                                       <td><?=$row['firstName'];?></td>
                                       <td><?=$row['surName'];?></td>
                                       <td><?=$row['email'];?></td>
                                       <td><a href="edit-user.php?id=<?= $key ?>" class="btn btn-primary btn-sm ">Edit</a></td>
                                       <td><a href="delete-user.php" class="btn btn-danger btn-sm ">Delete</a></td>
                                   </tr>

                                  <?php
                                   }

                               }else{
                                   ?>
                                   <tr>
                                       <td colspan="6">No Record Found</td>
                                   </tr>
                                   <?php
                               }
                              ?>
                              <tr>
                                  <td></td>
                              </tr>
                          </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
include('includes/footer.php');
?>

   