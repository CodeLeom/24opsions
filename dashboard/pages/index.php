<?php 
    include('includes/header.php');
?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


<?php
    if ($status == 'admin') {
?>

            <!-- FOR ADMIN ONLY -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $num_users; ?></div>
                                    <div> Registered Users!</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php?reg_users">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
               
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-dollar fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"> <?php echo $new_upload; ?></div>
                                    <div> New Orders!</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php?new_upload">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            
            </div>



<?php
    }

  $id = $row['id'];
  $doc_name = $doc = $postal =  ""; 
  $errdoc_name = $errdoc = $errpostal = "";
  $doc = 'null';

  $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $doc_name = $post['doc_name'];
    $postal   = $post['postal'];


  if ($_FILES['doc']['name'] != "") {
    //image info
    $target_file = "../docs/" . basename($_FILES['doc']['name']);
    $allowed = array('jpeg', 'jpg', 'png');
    $fileExt = explode(".", $_FILES['doc']['name']);
    $fileExt = strtolower(end($fileExt));

    if (!in_array($fileExt, $allowed)) {
      $errdoc = "sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    } elseif ($_FILES['doc']['size'] > 1000000) {
      $errdoc = 'sorry, your file is too large';
    } elseif ($_FILES['doc']['size'] == 0) {
      $errdoc = 'sorry, your file is not suppported';
    } else { 

        if (move_uploaded_file($_FILES['doc']['tmp_name'], $target_file)) {
            $doc = $_FILES['doc']['name'];

            if (empty($doc_name)) {
                $errdoc_name = 'this filed is required';
            } elseif (empty($postal)) {
              $errpostal = 'input your postal address';
            } else {
                $sql = "UPDATE users SET doc_name = :doc_name, doc = :doc, postal = :postal, upload = :upload WHERE id = :id";
                $conn->query($sql);
                $conn->bind(':doc_name', $doc_name);
                $conn->bind(':doc', $doc);
                $conn->bind(':postal', $postal);
                $conn->bind(':id', $id);
                $conn->bind(':upload', 'submited');
                $conn->execute();

              }
            }
        }
      
    } elseif ($_FILES['doc']['name'] == "") {
        $errdoc = 'please select an image';
    }
}


?>





            <!-- FOR USERS -->
            <div class="row">
                <div class="col-lg-8">
                    
                    <div class="panel panel-default">

                    <?php 
                        if ($upload != 'submited' && $upload != 'verified' && $status != 'admin') {
                    ?>
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Verification
                        </div>
                        
                        <div class="panel-body">
                            <p>
                                Welcome please upload your proof of id for verification purposes
                            </p>

                            <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                <div class="form-group">
                                    <label> Document Name *<?php echo $errdoc_name; ?> </label>
                                    <input type="text" name="doc_name" class="form-control" placeholder="Enter text" value="<?php echo $doc_name; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label> Document Upload *<?php echo $errdoc; ?></label>
                                    <input name="doc" type="file" required>
                                </div>

                                <div class="form-group">
                                    <label> Postal Code *<?php echo $errpostal; ?> </label>
                                    <input type="number" name="postal" class="form-control" placeholder="Enter postal code" value="<?php echo $postal; ?>" required>
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>

                                
                            </form>
                        </div>

                    <?php

                        } elseif ($upload == 'submited') {
                    ?>
                            <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Verification
                            </div>
                            
                            <div class="panel-body">
                                <h3>
                                   <b style="color: green;"> Document Successfully Uploaded. </b>
                                   Kindly note that it might take up to 3 days before you get activated.
                                </h3>

                            
                            </div>

                    <?php
                        }
                    ?>



                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
             
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->




<?php 
    include('includes/footer.php');
?>