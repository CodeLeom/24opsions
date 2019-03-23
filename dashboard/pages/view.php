<?php 
    include('includes/header.php');

    if (isset($_GET['id'])) {
    	$id = $_GET['id'];
    } elseif(!isset($_GET['id'])) {
    	$id = "";
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $balance = $_POST['balance'];

        $sql = "UPDATE users SET balance = :balance WHERE id = :id";
        $conn->query($sql);
        $conn->bind(':balance', $balance);
        $conn->bind(':id', $id);
        $conn->execute();

    }



	$sql = "SELECT username, email, phone, currency, balance, upload, status, doc, doc_name FROM users WHERE id = :id";
    $conn->query($sql);
    $conn->bind(':id', $id);
    $users = $conn->fetch_one();
    $balance = $users['balance'];

?>

	<div id="page-wrapper">
		<div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tables</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
        	<div class="col-lg-12">
                <div class="panel panel-default">
        		<?php if ($row['doc'] != 'null') {
        		?>
        		<img src="../docs/<?php echo $users['doc']; ?>" width="500px" height="200px">
        		<p style="display: block; height: 30px;"></p>
        		<?php }
        		?>
        		
        		<table class="table table-bordered">
        			<thead>
                        <tr>
                            <th> Doc Name </th>
                            <th> Email </th>
                            <th> phone </th>
                            <th> Currency </th>
                            <th> Balance </th>
                        </tr>
                    </thead>
        			<tbody>
        				<tr>
        					<td> <?php echo $users['doc_name']; ?> </td>
        					<td> <?php echo $users['email']; ?></td>
        					<td> <?php echo $users['phone']; ?> </td>
        					<td> <?php echo $users['currency']; ?> </td>
                            <td> <?php echo $users['balance']; ?></td>
        				</tr>
        			</tbody>
        		</table>


                <p style="height: 40px;"></p>
        		<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='. $id; ?>">
        			<div class="form-group">
                        <label> Change User Balance </label>
                        <input type="text" name="balance" value="<?php echo $balance; ?>" class="form-control">
                    </div>
			          <button type="submit" class="btn btn-default"> Update balance </button>
        		</form>
                <p style="height: 20px;"></p>

        		<?php
        			if (isset($_GET['verify'])) {
    					$sql = "UPDATE users SET upload = :upload WHERE id = :id";
 						$conn->query($sql);
 						$conn->bind(':upload', 'verified');
 						$conn->bind(':id', $id);
 						$conn->execute();
    				}
    			
        			if ($users['upload'] == 'submited') {
        		?>

        				<a class="btn btn-default" href="?verify&id=<?php echo $id; ?>"> Verify this user </a>
                        <p style="height: 10px;"></p>

        		<?php
        				
        			}
        		?>
        			
        		
        	</div>
        </div>
        </div>
    </div>


<?php 
    include('includes/footer.php');
?>