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
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
   <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Category</h3>
              </div>
              <div class="card-body">

                <form action="" method="POST">
                  <div class="form-group">
                    <label for="">Category name</label>
                    <input type="text" class="form-control" autocomplete="off" required="required" name="name">
                  </div>
                  <div class="form-group">
                    <label for="">Category Description</label>
                    <textarea class="form-control" cols="10" rows="3" name="desc"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="">Status [Active/Inactive]</label>
                    <select class="form-control" name="status">
                      <option value="0">Inactive</option>
                      <option value="1">Active</option>

                    </select>
                  </div>
                  <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-sm" value="Add New Category" name="submit">
                  </div>
                  
                </form>

                <?php

                  if(isset($_POST['submit'])){

                    $name = $_POST['name'];
                    $desc = $_POST['desc'];
                    $status = $_POST['status'];

                    $sql = "INSERT INTO categories (cat_name, cat_desc, cat_status) VALUES ('$name', '$desc', '$status')";

                    $add_cat = mysqli_query($db, $sql);

                    if($add_cat){

                      header("Location: category.php");
                    }
                    else{
                      die("Query Failed" . mysqli_error($db));
                    }


                  }


                ?>


              </div>
              <!-- /.card-body -->


            </div>

            <!-- Edit category php card start -->

            <?php

              if(isset($_GET['edit'])){

                $the_cat_id = $_GET['edit'];
                $sql = "SELECT * FROM categories WHERE cat_id ='$the_cat_id' ";

                $selected_cat = mysqli_query($db, $sql);

                while( $row = mysqli_fetch_assoc($selected_cat)){

                  $cat_id = $row['cat_id'];
                  $cat_name = $row['cat_name'];
                  $cat_desc = $row['cat_desc'];
                  $cat_status = $row['cat_status'];

                  ?>

                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Edit Category</h3>
                  </div>
                  <div class="card-body">

                    <form action="" method="POST">
                      <div class="form-group">
                        <label for="">Category name</label>
                        <input type="text" class="form-control" autocomplete="off" required="required" name="name" value="<?php echo $cat_name; ?>">
                      </div>
                      <div class="form-group">
                        <label for="">Category Description</label>
                        <textarea class="form-control" cols="10" rows="3" name="desc"><?php echo $cat_desc; ?></textarea>
                      </div>
                      <div class="form-group">
                        <label for="">Status [Active/Inactive]</label>
                        <select class="form-control" name="status">
                          <option value="0" <?php if($cat_status==0){
                            echo "selected";
                          }?>>Inactive</option>
                          <option value="1" <?php if($cat_status==1){
                            echo "selected";
                          }?>>Active</option>

                        </select>
                      </div>
                      <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-sm" value="Update Category" name="updateCategory">
                      </div>
                      
                    </form>

                    <?php

                     if(isset($_POST['updateCategory'])){

                      $name   = $_POST['name'];
                      $desc   = $_POST['desc'];
                      $status = $_POST['status'];

                      $sql = "UPDATE categories SET cat_name = '$name', cat_desc= '$desc', cat_status = '$status' WHERE cat_id = '$the_cat_id' ";

                      $update_cat = mysqli_query($db, $sql);

                      if($update_cat){

                        header("Location: category.php");
                      }
                      else{
                        die("Query failed" . mysqli_error($db));
                      }

                     }


                    ?>


                  </div>
                  <!-- /.card-body -->


                </div>

                  <?php

                }
              }
            ?>
            <!-- Edit category php card end -->

          </div>

          <div class="col-12 col-sm-6 col-md-6">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">All Category</h3>
              </div>
              <div class="card-body">

                <table class="table table-dark">
                  <thead>
                    <tr>
                      <th scope="col">SL.</th>
                      <th scope="col">Category</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      $sql = "SELECT * FROM categories";

                      $all_cat = mysqli_query($db, $sql);
                      $i=0;

                      while($row = mysqli_fetch_assoc($all_cat)){

                        $cat_id = $row['cat_id'];
                        $cat_name = $row['cat_name'];
                        $cat_desc = $row['cat_desc'];
                        $cat_status = $row['cat_status'];
                        $i++;
                        ?>

                        <tr>
                          <th scope="row"><?php echo $i; ?></th>
                          <td><?php echo $cat_name; ?></td>
                          <td>
                            <?php

                            if( $cat_status == 1){

                              echo '<div class="badge badge-success">Active</div>';
                            }
                            else{
                              echo '<div class="badge badge-danger">Inactive</div>';
                            }


                          ?>


                          </td>
                          <td>
                            <div class="btn-group">
                              <a href="category.php?edit=<?php echo $cat_id; ?>" title="Edit Category">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a href="" data-toggle="modal" data-target="#delete<?php echo $cat_id; ?>" title="Delete Category">
                                <i class="fas fa-trash"></i>
                              </a>

                              <!-- Delete modal code starts here -->

                              <!-- Modal -->
                              <div class="modal fade" id="delete<?php echo $cat_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this category?</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <a href="category.php?delete=<?php echo $cat_id; ?>" class="btn btn-danger">Yes</a>
                                      <a href="" class="btn btn-success" data-dismiss="modal">No</a>
                                      
                                    </div>
                                    
                                  </div>
                                </div>
                              </div>
                              <!-- Delete modal code ends here -->

                            </div>

                          </td>
                        </tr>

                        <?php
                      }
                    ?>
                    
                    
                  </tbody>
                </table>


              </div>
              <!-- /.card-body -->
              <!-- Delete code starts here -->

              <?php

                if(isset($_GET['delete'])){

                  $the_id = $_GET['delete'];
                  $sql = "DELETE FROM categories WHERE cat_id = '$the_id' ";

                  $del_cat = mysqli_query($db, $sql);

                  if($del_cat){

                    header("Location: category.php");
                  }
                  else{
                    die("Query Failed" . mysqli_error($db));
                  }
                }
              ?>
              <!-- Delete code ends here -->

            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
 
    <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

<?php include "include/footer.php"; ?>