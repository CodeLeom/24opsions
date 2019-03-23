<?php
   SESSION_START(); 

   if (!isset($_SESSION['id'])) {
       header('Location: ../../');
   } elseif (isset($_SESSION['id'])) {
       $id = $_SESSION['id'];
   }

   include_once 'conn.php';


    $sql = "SELECT username, status, balance FROM users WHERE id = :id";
    $conn->query($sql);
    $conn->bind(":id", $id);
    $row = $conn->fetch_one();
    $status = $row['status'];
    $balance = $row['balance'];
    $username = $row['username'];
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> www.24opsion.com </title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>



    <div id="wrapper">

        


        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"> 24opsions.com </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li>
                  <b>Hi, <?php echo $username; ?></b>
                </li>
                <li>
                    <a href="index.php"> Trade Now </a>
                </li>
              
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="profile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>

                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li  style="color: #fff; background-color: #333">
                           <a class="btn"> Euro(EUR) / Balance: <?php echo $balance; ?> </a>
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-home fa-fw"></i> Home </a>
                        </li>
                
                        <li>
                            <a href="<?php if($status == 'admin'): echo 'users.php?new_upload'; endif; ?>"><i class="fa fa-book fa-fw"></i> Verification </a>
                        </li>
                        <li>
                            <a href="blank.php"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>
                        <li>
                            <a href="blank.php"><i class="fa fa-align-justify fa-fw"></i> Withdraw </a>
                        </li>
             

                        <li>
                            <a href="#"><i class="fa fa-plus fa-fw"></i> Deposit <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="blank.php"> Credit Card </a>
                                </li>
                                <li>
                                    <a href="blank.php"> Bank Deposit </a>
                                </li>
                                <li>
                                    <a href="blank.php"> Western Union </a>
                                </li>
                                <li>
                                    <a href="blank.php"> Money Gram </a>
                                </li>
                                <li>
                                    <a href="blank.php"> Perfect Money </a>
                                </li>
                                <li>
                                    <a href="blank.php"> Bitcoin </a>
                                </li>
                            </ul>

                        </li>

                        <li>
                            <a href="blank.php"><i class="fa fa-file-text fa-fw"></i> Trade History </a>
                        </li>
                        <li>
                            <a href="Profile.php"><i class="fa fa-user fa-fw"></i> Profile </a>
                        </li>
                        <li>
                            <a href="logout.php"><i class="fa fa-power-off fa-fw"></i> Sign Out </a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>




<?php
    
    $sql = "SELECT * FROM users WHERE id = :id";
    $conn->query($sql);
    $conn->bind(":id", $id);
    $row = $conn->fetch_one();
    $all_row = $conn->fetch_all();

    $status = $row['status'];
    $upload = $row['upload'];



    $sql = "SELECT count(*) FROM users";
    $conn->query($sql);
    $num_users = $conn->numrow();

    $sql = "SELECT count(*) FROM users WHERE upload = :upload";
    $conn->query($sql);
    $conn->bind(":upload", 'submited');
    $new_upload = $conn->numrow();


    


?>

