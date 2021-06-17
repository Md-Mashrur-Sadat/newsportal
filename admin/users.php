<?php include "include/header.php"; ?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">User Management</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
   <!-- /.content-header -->

   <?php

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if($do == "Manage"){

     ?>

     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">All Users Information</h3>
              </div>
              <div class="card-body">

                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">SL.</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">User Role</th>
                        <th scope="col">Action</th>

                      </tr>
                    </thead>

                    <?php

                      $sql = "SELECT * FROM users";
                      $all_users = mysqli_query($db, $sql);

                      while($row = mysqli_fetch_assoc($all_users)){

                        $id       = $row['id'];
                        $name     = $row['name'];
                        $username = $row['username'];
                        $email    = $row['email'];
                        $phone    = $row['phone'];
                        $address  = $row['address'];
                        $role     = $row['role'];
                        $image     = $row['image'];

                        ?>

                        <tr>
                          <th scope="row"><?php echo $id; ?></th>
                          <td>
                            
                            <img src="dist/img/users/<?php echo $image; ?>" class="avater-img" alt="">
                          </td>
                          <td><?php echo $name; ?></td>
                          <td><?php echo $username; ?></td>
                          <td><?php echo $email; ?></td>
                          <td><?php echo $phone; ?></td>
                          <td><?php echo $address; ?></td>
                          <td>

                          <?php

                            if($role == 1){

                              ?>

                              <span class="badge badge-success">Super Admin</span>

                              <?php
                            }
                            else{
                              ?>
                                <span class="badge badge-danger">Editor</span>

                              <?php
                            }

                          ?>
                          </td>
                          <td>
                            
                            <div class="btn-group">
                               <a href="#">
                                 <i class="fas fa-edit"> </i>
                               </a>
                               <a href="#">
                                 <i class="fas fa-trash"> </i>
                               </a>
                             </div>
                          </td>
                      </tr>

                        <?php

                      }
                    ?>
                    <tbody>
                      
                      
                    </tbody>
                  </table>
              </div>
            </div>

            
          </div>
        </div>
      </div>
     </section>



     <?php
    }
    else if($do == "Add"){

      echo "Add users here";
    }
    else if($do == "Insert"){

      echo "Insert users here";
    }
    else if($do == "Edit"){

      echo "Edit users info will be here";
    }
    else if($do == "Update"){

      echo "Update users info will be here";
    }
    else if($do == "Delete"){

      echo "Delete users info will be here";
    }

   ?>

    <!-- Main content -->
    <!--  -->

  </div>
 
    <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<?php include "include/footer.php"; ?>