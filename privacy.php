<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['user_id'])==0)
    {   
header('location:userindex.php');
}
else{
// Code for change password 
if(isset($_POST['change']))
    {
$password=md5($_POST['password']);
$newpassword=md5($_POST['newpassword']);
$email=$_SESSION['user_mail'];
    $sql ="SELECT password from user WHERE email=:email and password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
$con="update user set password=:newpassword where email=:email";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();
$msg="Your Password succesfully changed";
}
else {
$error="Your current password is wrong";    
}
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
               
        <!-- Styles -->
       <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	   <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
	   <link rel="stylesheet" href="fluid-gallery.css">
	   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    </head>
  <div>
                
                    <div class="col s12">
                        <div class="page-title">
						<h2> Change Password </h2>
						
						</div>
                 
                    <div class="col s12 m12 l6">
                        <div class="card">
                            <div class="card-content">
                              
                                
                                    <form class="col s12" name="chngpwd" method="post">
                                          <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                                       
                                            <div class="input-field col s12">
											<label for="password">Current Password     </label>
<input id="password" type="password"  class="validate" autocomplete="off" name="password"  required>
                                                
                                            </div>

  <div class="input-field col s12">
  <label for="password">New Password      </label>
 <input id="password" type="password" name="newpassword" class="validate" autocomplete="off" required>
                                                
                                            </div>

<div class="input-field col s12">
 <label for="password">Confirm Password    </label>
<input id="password" type="password" name="confirmpassword" class="validate" autocomplete="off" required>

</div>


<div class="input-field col s12">
<button type="submit" name="change" class="waves-effect waves-light btn indigo m-b-xs" onclick="return valid();">Change</button>

</div>




                                       
                                       
                                    </form>
                                
                            </div>
                        </div>
                     
             
                   
                    </div>
                
                
            

                  </div>
	
		</div>
       
        
        <!-- Javascripts -->
        <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
        <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
        <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
        <script src="../assets/js/alpha.min.js"></script>
        <script src="../assets/js/pages/form_elements.js"></script>
        
</html>
<?php } ?> 