<?php 
    include('includes/header.php');
?>


<?php
	$sql = "SELECT id, username, email, phone, currency, upload, status FROM users";
    $conn->query($sql);
    $users = $conn->fetch_all();

?>
		<div id="page-wrapper">
			<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tables</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

			<div class="row">
                <?php 
                    if (isset($_GET['reg_users'])) {
                ?>

				<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All Registerd Users
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th> Username </th>
                                            <th> Email </th>
                                            <th> phone </th>
                                            <th> Currency </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                    		foreach ($users as $user) {
                                                if ($user['status'] != 'admin') {
                                                    $id = $user['id'];
                                                    
                            			?>
                                        
										<tr class="<?php if($user['upload'] == 'submited'): echo 'success'; elseif($user['upload'] == null): echo 'danger'; endif; ?>" onclick="window.location='view.php?id=<?php echo $id; ?>';"> 
                                            <td> <?php echo $user['username']; ?> </td>
                                            <td> <?php echo $user['email']; ?> </td>
                                            <td> <?php echo $user['phone']; ?> </td>
                                            <td> <?php echo $user['currency']; ?> </td>
                                        </tr>

                                        <?php
										    }
                                          }
                                    	?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>


                <?php 
                    } elseif (isset($_GET['new_upload'])) {
                ?>

                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Submitted Users
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> Username </th>
                                        <th> Email </th>
                                        <th> phone </th>
                                        <th> Currency </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                        foreach ($users as $user) {
                                            if ($user['upload'] == 'submited') {
                                                $id = $user['id'];
                                                
                                    ?>

                                    <tr onclick="window.location='view.php?id=<?php echo $id; ?>';">
                                        <td> <?php echo $user['username']; ?> </td>
                                        <td> <?php echo $user['email']; ?> </td>
                                        <td> <?php echo $user['phone']; ?> </td>
                                        <td> <?php echo $user['currency']; ?> </td>
                                    </tr>

                                    <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                      
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                <?php } ?>
		                <!-- /.col-lg-12 -->

            </div>
       	</div>

<?php 
    include('includes/footer.php');
?>