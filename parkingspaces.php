<?php
include('admin_auth.php');
include('includes/header.php');
?>
    <div class="container">
        <div class="row">
           <div class="col-md-3">
               <div class="card">
                   <div class="card-body">
                       <h4>Total Number of Records:
                         <?php
                         $ref_table='ParkingLocation';
                         $total_count = $database->getReference($ref_table)->getSnapshot()->numChildren();
                         echo $total_count;
                         ?>
                       </h4>
                       
                   </div>
               </div>
               <br>
           </div>
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
                            Saved Parking Spaces
                           
                        </h4>
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered table-striped">
                          <thead>
                              <tr>
                                  <th>Serial Number</th>
                                  <th>Address</th>
                                  <th>Parking Space Name</th>
                                  <th>longitude</th>
                                  <th>latitude</th>
                                   
                                  <th>Rating</th>
                                  <th>Total Ratings</th>

                                  
                                  
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                               include('dbcon.php');
                               $ref_table="ParkingLocation";
                               $fetchData = $database->getReference($ref_table)->getValue();
                               if($fetchData>0){
                                   $i=0;
                                   foreach($fetchData as $key => $row){
                                       ?>
                                   <tr>
                                       <td><?=$i++;?></td>
                                       <td><?=$row['address'];?></td>
                                       <td><?=$row['name'];?></td>
                                       <td><?=$row['lng'];?></td>
                                       <td><?=$row['lat'];?></td>
                                       <td><?=$row['rating'];?></td>
                                       <td><?=$row['totalRating'];?></td>
                                     

                                      
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

   