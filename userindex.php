<?php
session_start();
include('includes/config.php');
if(isset($_POST['usignin']))
{
$uname=$_POST['email'];
$password=md5($_POST['password']);
$sql ="SELECT first_name,email,password,status,id FROM users WHERE email=:email and password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $uname, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
	foreach ($results as $result) {
    $status=$result->status;
    $_SESSION['user_id']=$result->id;
	$_SESSION['first_name']=$result->first_name;
  } 
  
  if($status==0)
	{
		$msg="Your account is Inactive. Please contact admin";
	} 
  else{
		$_SESSION['user_mail']=$_POST['email'];
		echo "<script type='text/javascript'> document.location = '../clientpage.php'; </script>";
	} 
} 

else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}


$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:'';
if(!empty($sessData['status']['msg'])){
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>User Login</title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">        
        <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/css/custom.css" rel="stylesheet" type="text/css"/>
    </head>
	<style>
body,h1,h5 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
    background-image: url("https://s3.envato.com/files/146119852/Preview/7.jpg");
    min-height: 100%;
    background-position: center;
    background-size: cover;
}
</style>
	
    <body class="bgimg signin-page">

        <div class="mn-content valign-wrapper">

            <main class="mn-inner container">
  <h1 align="center"><a href="../index.php">Barber Lancers | User Login</a></h1>
                <div class="valign">
                      <div class="row">

                          <div class="col s12 m6 l4 offset-l4 offset-m3">
                              <div class="card white darken-1">
                                  <div class="card-content ">
                                      <span class="card-title">Sign In</span>
                                       <div class="row">
                                           <form class="col s12" name="usignin" method="post">
                                               <div class="input-field col s12">
                                                   <input id="username" type="text" name="email" class="validate" autocomplete="off" required >
                                                   <label for="email">Email Id</label>
                                               </div>
                                               <div class="input-field col s12">
                                                   <input id="password" type="password" class="validate" name="password" autocomplete="off" required>
                                                   <label for="password">Password</label>
                                               </div>
											   <p> Don't have an account? <a href="registration.php">Register</a></p>
                                               <div class="col s12 right-align m-t-sm">
                                                
                                                   <input type="submit" name="usignin" value="Sign in" class="waves-effect waves-light btn teal">
                                               </div>
                                           </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                </div>
            </main>
        </div>
        
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        
    </body>
</html>