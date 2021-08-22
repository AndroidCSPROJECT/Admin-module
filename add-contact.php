<?php

include('admin_auth.php');
include('includes/header.php');
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Add Contacts
                            <a href="index.php" class="btn btn-danger float-end">
                                Back
                            </a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                           <div class="form-group mb-3">
                             <label for="firstname">First Name</label>
                             <input type="text" name="first_name" class="form-control">
                           </div>
                           <div class="form-group mb-3">
                             <label for="">Surname</label>
                             <input type="text" name="surname" class="form-control">
                           </div>
                           <div class="form-group mb-3">
                             <label for="">Email</label>
                             <input type="email" name="email" class="form-control">
                           </div>
                           <div class="form-group mb-3">
                               <button type="submit" name="save_contact" class="btn btn-primary">Save Contact</button>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
include('includes/footer.php');
?>

   