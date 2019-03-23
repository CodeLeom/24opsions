<?php 
    include('includes/header.php');

   
?>


        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                    <?php

                        if ($upload == 'submited') {
                    ?>
                            <h4 class="page-header">
                            <i class="fa fa-clock-o fa-fw"></i> Verification
                            </h4>
                            
                            <div class="panel-body">
                                <h3>
                                   <b style="color: green;"> Document Successfully Uploaded. </b>
                                   Kindly note that it might take up to 3 days before you get activated.
                                </h3>

                            
                            </div>

                    <?php
                        } 

                        if ($status == 'admin') { ?>
                            <script type="text/javascript"> window.location = 'index.php'; </script>
                    <?php
                        }
                    ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
