<?php
   SESSION_START(); 

   if (isset($_SESSION['username'])) {
     header("Location: dashboard/");
   }
?>


<!DOCTYPE html>
<html>
<head>
	<title> www.24opsions.com </title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<meta name="description" content="">
  	<meta name="author" content="">
  	<link rel="icon" href="favicon.ico">


	<!-- bootstrap styles -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- custom styles -->
	<link rel="stylesheet" href="css/style.css?v=<?php echo date('H:i'); ?>">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="css/themify-icons.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
	<!-- fonts -->
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

</head>
<body data-spy="scroll" data-target="#navbar" data-offset="30">


	<nav class="navbar navbar-expand-md navbar-light fixed-top bg-white">
      <!-- <a class="navbar-brand" href="#">Carousel</a> -->
      <a class="navbar-brand" href="index.php">
             <img src="images/24.jpg" class="img-fluid" alt="logo"> 
      <!-- <font color="gold" size="10"><strong>www.24opsions.com</strong></font> -->
      </a> 

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav ml-auto">
          
          

          <li class="nav-item"> 
              <a class="nav-link" href="login.php"> Login </a> 
          </li>

        </ul>
        

      </div>
    </nav>

     <p class="space" style="margin-top: 40px"></p>

<?php 
  include('includes/conn.php');

  $email = $username = $phone = $country = $currency = "";
  $erremail = $errusername = $errphone = $errcountry = $errcurrency = $errpassword = "";
  $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = ucfirst($post['username']);
    $email    = $post['email'];  
    $phone    = $post['phone'];
    $country  = $post['country'];
    $currency = $post['currency'];
    $password = $post['password'];


    $date = date('Y-m-d H:i:s');
    $hashPass = password_hash($password, PASSWORD_DEFAULT);

    if (empty($username)) {
      $errusername = 'Please enter your Username';
    } elseif (empty($email)) {
      $erremail = 'Please enter your email addrress';
    } else {
        $query = "SELECT email FROM users WHERE email = :email";
        $conn->query($query);
        $conn->bind(':email', $email);
        $num_row = $conn->numrow();

        if ($num_row > 0) {
        $erremail = 'this email already exists';
        } elseif (empty($phone)) {
      $errphone = 'Please enter your mobile number';
    } elseif (empty($currency)) {
      $errcurrency = 'Please select desired trading currency';
    } elseif (empty($password)) {
      $errpassword = 'Please enter your password';
    } elseif (strlen($password) < 4) {
      $errpassword = 'Password must be more than 4 digits';
    } else {

      $sql = "INSERT INTO users (status, username, password, email, phone, currency, balance, country, date, upload) 
                                      VALUES(:status, :username, :password, :email, :phone, :currency, :balance, :country, :date, :upload)";
      $conn->query($sql);
      $conn->bind(':status', 'null');
      $conn->bind(':username', $username);
      $conn->bind(':password', $hashPass);
      $conn->bind(':email', $email);
      $conn->bind(':phone', $phone);
      $conn->bind(':currency', $currency);
      $conn->bind(':balance', 0.00);
      $conn->bind(':country', $country);
      $conn->bind(':date', $date);
      $conn->bind(':upload', 'null');

      $conn->execute();

      header("Location: login.php");
    }
  }
}
?>



<br>

     <div class="container" align="center">

      <form class="form-signup" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
	      <h1 class="h3 mb-3 font-weight-normal"> Sign Up to 24opsions </h1>

        <div class="form-group">
          <label for="inputusername"> Username <?php echo " *".$errusername;?></label>
          <input type="text" name="username" value="<?php echo $username;?>" id="inputusername" class="form-control" placeholder="Username" required>
        </div>

	      <div class="form-group">
	      	<label for="inputEmail">Email address <?php echo " *".$erremail;?> </label>
	      	<input type="email" name="email" value="<?php echo $email;?>" id="inputEmail" class="form-control" placeholder="Email address" required>
	      </div>


	      <div class="form-group">
         <label for="inputCountry"> Country Code </label>  
          <select class="form-control" name="country">
                      <option value="1" selected="selected">US +1</option>
                      <option value="355">AL +355</option>
                      <option value="213">DZ +213</option>
                      <option value="1684">AS +1684</option>
                      <option value="376">AD +376</option>
                      <option value="244">AO +244</option>
                      <option value="1264">AI +1264</option>
                      <option value="0">AQ +0</option>
                      <option value="1268">AG +1268</option>
                      <option value="54">AR +54</option>
                      <option value="374">AM +374</option>
                      <option value="297">AW +297</option>
                      <option value="61">AU +61</option>
                      <option value="43">AT +43</option>
                      <option value="994">AZ +994</option>
                      <option value="1242">BS +1242</option>
                      <option value="973">BH +973</option>
                      <option value="880">BD +880</option><option value="1246">BB +1246</option><option value="375">BY +375</option><option value="32">BE +32</option><option value="501">BZ +501</option><option value="229">BJ +229</option><option value="1441">BM +1441</option><option value="975">BT +975</option><option value="591">BO +591</option><option value="387">BA +387</option><option value="267">BW +267</option><option value="0">BV +0</option><option value="55">BR +55</option><option value="246">IO +246</option><option value="673">BN +673</option><option value="359">BG +359</option><option value="226">BF +226</option><option value="257">BI +257</option><option value="855">KH +855</option><option value="237">CM +237</option><option value="1">CA +1</option><option value="238">CV +238</option><option value="1345">KY +1345</option><option value="236">CF +236</option><option value="235">TD +235</option><option value="56">CL +56</option><option value="86">CN +86</option><option value="61">CX +61</option><option value="672">CC +672</option><option value="57">CO +57</option><option value="269">KM +269</option><option value="242">CG +242</option><option value="242">CD +242</option><option value="682">CK +682</option><option value="506">CR +506</option><option value="225">CI +225</option><option value="385">HR +385</option><option value="53">CU +53</option><option value="357">CY +357</option><option value="420">CZ +420</option><option value="45">DK +45</option><option value="253">DJ +253</option><option value="1767">DM +1767</option><option value="1809">DO +1809</option><option value="593">EC +593</option><option value="20">EG +20</option><option value="503">SV +503</option><option value="240">GQ +240</option><option value="291">ER +291</option><option value="372">EE +372</option><option value="251">ET +251</option><option value="500">FK +500</option><option value="298">FO +298</option><option value="679">FJ +679</option><option value="358">FI +358</option><option value="33">FR +33</option><option value="594">GF +594</option><option value="689">PF +689</option><option value="0">TF +0</option><option value="241">GA +241</option><option value="220">GM +220</option><option value="995">GE +995</option><option value="49">DE +49</option><option value="233">GH +233</option><option value="350">GI +350</option><option value="30">GR +30</option><option value="299">GL +299</option><option value="1473">GD +1473</option><option value="590">GP +590</option><option value="1671">GU +1671</option><option value="502">GT +502</option><option value="224">GN +224</option><option value="245">GW +245</option><option value="592">GY +592</option><option value="509">HT +509</option><option value="0">HM +0</option><option value="39">VA +39</option><option value="504">HN +504</option><option value="852">HK +852</option><option value="36">HU +36</option><option value="354">IS +354</option><option value="91">IN +91</option><option value="62">ID +62</option><option value="98">IR +98</option><option value="964">IQ +964</option><option value="353">IE +353</option><option value="972">IL +972</option><option value="39">IT +39</option><option value="1876">JM +1876</option><option value="81">JP +81</option><option value="962">JO +962</option><option value="7">KZ +7</option><option value="254">KE +254</option><option value="686">KI +686</option><option value="850">KP +850</option><option value="82">KR +82</option><option value="965">KW +965</option><option value="996">KG +996</option><option value="856">LA +856</option><option value="371">LV +371</option><option value="961">LB +961</option><option value="266">LS +266</option><option value="231">LR +231</option><option value="218">LY +218</option><option value="423">LI +423</option><option value="370">LT +370</option><option value="352">LU +352</option><option value="853">MO +853</option><option value="389">MK +389</option><option value="261">MG +261</option><option value="265">MW +265</option><option value="60">MY +60</option><option value="960">MV +960</option><option value="223">ML +223</option><option value="356">MT +356</option><option value="692">MH +692</option><option value="596">MQ +596</option><option value="222">MR +222</option><option value="230">MU +230</option><option value="269">YT +269</option><option value="52">MX +52</option><option value="691">FM +691</option><option value="373">MD +373</option><option value="377">MC +377</option><option value="976">MN +976</option><option value="1664">MS +1664</option><option value="212">MA +212</option><option value="258">MZ +258</option><option value="95">MM +95</option><option value="264">NA +264</option><option value="674">NR +674</option><option value="977">NP +977</option><option value="31">NL +31</option><option value="599">AN +599</option><option value="687">NC +687</option><option value="64">NZ +64</option><option value="505">NI +505</option><option value="227">NE +227</option><option value="234">NG +234</option><option value="683">NU +683</option><option value="672">NF +672</option><option value="1670">MP +1670</option><option value="47">NO +47</option><option value="968">OM +968</option><option value="92">PK +92</option><option value="680">PW +680</option><option value="970">PS +970</option><option value="507">PA +507</option><option value="675">PG +675</option><option value="595">PY +595</option><option value="51">PE +51</option><option value="63">PH +63</option><option value="0">PN +0</option><option value="48">PL +48</option><option value="351">PT +351</option><option value="1787">PR +1787</option><option value="974">QA +974</option><option value="262">RE +262</option><option value="40">RO +40</option><option value="70">RU +70</option><option value="250">RW +250</option><option value="290">SH +290</option><option value="1869">KN +1869</option><option value="1758">LC +1758</option><option value="508">PM +508</option><option value="1784">VC +1784</option><option value="684">WS +684</option><option value="378">SM +378</option><option value="239">ST +239</option><option value="966">SA +966</option><option value="221">SN +221</option><option value="381">CS +381</option><option value="248">SC +248</option><option value="232">SL +232</option><option value="65">SG +65</option><option value="421">SK +421</option><option value="386">SI +386</option><option value="677">SB +677</option><option value="252">SO +252</option><option value="27">ZA +27</option><option value="0">GS +0</option><option value="34">ES +34</option><option value="94">LK +94</option><option value="249">SD +249</option><option value="597">SR +597</option><option value="47">SJ +47</option><option value="268">SZ +268</option><option value="46">SE +46</option><option value="41">CH +41</option><option value="963">SY +963</option><option value="886">TW +886</option><option value="992">TJ +992</option><option value="255">TZ +255</option><option value="66">TH +66</option><option value="670">TL +670</option><option value="228">TG +228</option><option value="690">TK +690</option><option value="676">TO +676</option><option value="1868">TT +1868</option><option value="216">TN +216</option><option value="90">TR +90</option><option value="7370">TM +7370</option><option value="1649">TC +1649</option><option value="688">TV +688</option><option value="256">UG +256</option><option value="380">UA +380</option><option value="971">AE +971</option><option value="44">GB +44</option><option value="1">US +1</option><option value="1">UM +1</option><option value="598">UY +598</option><option value="998">UZ +998</option><option value="678">VU +678</option><option value="58">VE +58</option><option value="84">VN +84</option><option value="1284">VG +1284</option><option value="1340">VI +1340</option><option value="681">WF +681</option><option value="212">EH +212</option><option value="967">YE +967</option><option value="260">ZM +260</option><option value="263">ZW +263</option>   
</select>
	      </div>

	      <div class="form-group">
	      	<label for="inputphone">Phone <?php echo " *".$errphone;?> </label>
	      	<input type="number" name="phone" value="<?php echo $phone;?>" id="inputCountry" class="form-control" placeholder="phone" required>
	      </div>

        <div class="form-group">
          <label> Country </label>
                      <select class="form-control" name="currency">
                            <option selected="selected">Euro (EUR)</option>
                            <option>British Pound (GBP)</option>
                            <option>Japanese yen (JPY)</option>
                            <option>Swiss franc (CHF)</option>
                            <option>Chinese yuan (CNY)</option>
                               <option>Turkish lira (TRY)</option>
                                  <option>Russian ruble (RUB)</option>
                                     <option>US Dollar (USD)</option>
                        </select>
          </div>

	      <div class="form-group">
	      	<label for="inputPassword">Password <?php echo " *".$errpassword;?></label>
	      	<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
	      </div>
	      <button class="btn btn-lg btn-primary btn-block"> Sign up </button>


	      <p class="mt-5 mb-3 text-muted">&copy; 24Opsions All rights Reserve 2017-2018 </p>
	    </form>
    </div>
 <hr>
 <div class="row">
            <div class="col-sm-12" align="center">
                <img src="images/deutsche.png" class="footerimg" width="120" height="40">
                <img src="images/ssl.png" class="footerimg" width="120" height="40">
                <img src="images/reuters.png" class="footerimg" width="120" height="40">
                <img src="images/dowjones.png" class="footerimg" width="120" height="40">
                <img src="images/18.png" class="footerimg" width="40" height="40">
                <img src="images/nasdaq.png" class="footerimg" width="120" height="40">
                <img src="images/london.png" class="footerimg" width="120" height="40"> 
                <img src="images/visa.png" class="footerimg" width="120" height="40">
                <img src="images/banking_01.png" class="footerimg" width="120" height="40">
            </div>
        </div>
        <hr>
  <div class="social-links" align="center">
          <a href="https://www.twitter.com/24opsions"> <i class="fa fa-twitter"></i> </a>
          <a href="https://www.facebook.com/24opsions"> <i class="fa fa-facebook"></i> </a>
          <a href="https://api.whatsapp.com/send?phone=+15012058076"> <i class="fa fa-whatsapp"></i> </a>
        </div>
    <!-- javascript -->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <!-- Plugins JS -->
    <script src="js/owl.carousel.min.js"></script>
  <!-- Custom JS -->
  <script src="js/script.js"></script>
</body>
</html>