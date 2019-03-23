<?php 
    include('includes/header.php');

    $id = $row['id'];
    $email    = $row['email'];
    $phone    = $row['phone'];
    $currency = $row['currency'];
    $country  = $row['country'];
    $balance  = $row['balance'];



    $errusername = $erremail = $errphone = $errpassword = "";
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $post['username'];
        $phone    = $post['phone'];
        $currency = $post['currency'];
        $password = $post['password'];

        $hashpass = password_hash($password, PASSWORD_DEFAULT);

        if (empty($username)) {
            $errusername = 'Please enter your Username';
        } elseif (empty($phone)) {
            $errphone = 'Please enter your mobile number';
        } else {
            if (empty($password)) {
                $password = $row['password'];
            }

            if (strlen($password) < 4) {
                $errpassword = 'Password must be more than 4 digits';
            } else {
                $sql = "UPDATE users SET username = :username, phone = :phone, currency = :currency, password = :password WHERE id = :id";
                $conn->query($sql);
                $conn->bind(':username', $username);
                $conn->bind(':phone', $phone);
                $conn->bind(':currency', $currency);
                $conn->bind(':password', $hashpass);
                $conn->bind(':id', $id);
                $conn->execute(); 

                $sql = "SELECT username, email, phone FROM users WHERE id = :id";
                $conn->query($sql);
                $conn->bind(":id", $id);
                $row = $conn->fetch_one();

                $_SESSION['username'] = $row['username'];
        }
    }
}
?>
      

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> Profile </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            User details
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                    <div class="form-group">
                                        <label>Username *<?php echo $errusername; ?></label>
                                        <input type="text" name="username" value="<?php echo $row['username']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label> Email </label>
                                        <p class="form-control-static"><?php echo $row['email']; ?></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone *<?php echo $errphone; ?></label>
                                        <input name="phone" type="number" value="<?php echo $row['phone']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                         <label> Country </label>
                                         <select class="form-control" name="currency">
                                         <option <?php if($currency == 'Euro (EUR)'): echo "selected"; endif; ?>>Euro (EUR)</option>
                                         <option <?php if($currency == 'British Pound (GBP)'): echo "selected"; endif; ?>>British Pound (GBP)</option>
                                         <option <?php if($currency == 'Japanese yen (JPY)'): echo "selected"; endif; ?>>Japanese yen (JPY)</option>
                                         <option <?php if($currency == 'Swiss franc (CHF)'): echo "selected"; endif; ?>>Swiss franc (CHF)</option>
                                         <option <?php if($currency == 'Chinese yuan (CNY)'): echo "selected"; endif; ?>>Chinese yuan (CNY)</option>
                                         <option <?php if($currency == 'Turkish lira (TRY)'): echo "selected"; endif; ?>>Turkish lira (TRY)</option>
                                         <option <?php if($currency == 'Russian ruble (RUB)'): echo "selected"; endif; ?>>Russian ruble (RUB)</option>                                         
                                         <option <?php if($currency == 'US Dollar (USD)'): echo "selected"; endif; ?>>US Dollar (USD)</option>
                                         </select>
                                    </div>
                                    <div class="form-group">
                                        <label> Balance </label>
                                        <p class="form-control-static"><?php echo $currency.' '.$balance; ?></p>
                                    </div>

                                    <div class="form-group">
                                        <label>Password *<?php echo $errpassword; ?> </label>
                                        <input name="password" type="text" class="form-control">
                                    </div>
                                    
                                    <button class="btn btn-default"> Update </button>
                                       
                                    </form>
                                    </div>
                            </div>
                        </div>
                    </div>

            </div>

        </div>
    </div>




<?php 
    include('includes/footer.php');
?>