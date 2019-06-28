
<?php   // PHP code for submission of appointment
session_start();
error_reporting(0);
include('sign/includes/config.php');
if(strlen($_SESSION['user_id'])==0)
    {   
header('location:userindex.php');
}
else{

if(isset($_POST['apply']))
{
$user_id=$_SESSION['user_id'];
$service_type=$_POST['service_type'];
$_date=$_POST['_date'];  
$_time=$_POST['_time'];
$people = $_POST['people'];
$description=$_POST['description'];  
$status=0;
$isRead=0;						
//if($fromdate > $todate){
//              $error=" ToDate should be greater than FromDate ";
//           }
$sql="INSERT INTO job_assignment(service_type,_date,_time,people,description,status,isRead,user_id) VALUES(:service_type,:_date,:_time,:people,:description,:status,:isRead,:user_id)";
$query = $dbh->prepare($sql);
$query->bindParam(':service_type',$service_type,PDO::PARAM_STR);
$query->bindParam(':_date',$_date,PDO::PARAM_STR);
$query->bindParam(':_time',$_time,PDO::PARAM_STR);
$query->bindParam(':people',$people,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':isRead',$isRead,PDO::PARAM_STR);
$query->bindParam(':user_id',$user_id,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Appointment requested successfully";
}
else 
{
$error="Something went wrong. Please try again";
}


}

?>



<!DOCTYPE html>
<html>
<title>Clientpage</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
<link rel="stylesheet" href="fluid-gallery.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<head>
<style>
body,h1,h5 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
    background-image: url("images/saloon.png");
    min-height: 100%;
    background-position: center;
    background-size: cover;
}
</style>
</head>
<body>
 <?php if($error){?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<div class="bgimg w3-display-container w3-text-black">
  <div class="w3-display-middle w3-jumbo">
    <p>Welcome <?php echo $_SESSION['first_name'] ?></p>
  </div>
  <div class="w3-display-topleft w3-container w3-xlarge">
    
	<p><button onclick="document.getElementById('Inbox').style.display='block'" class="w3-button w3-red" >Inbox</button></p>
	<p><button onclick="document.getElementById('Barbers').style.display='block'" class="w3-button w3-green">Available Barbers</button></p>
	<p><button onclick="document.getElementById('haircut').style.display='block'" class="w3-button w3-black">Haircuts</button></p>
    <p><button onclick="document.getElementById('appoint').style.display='block'" class="w3-button w3-black">Appointment</button></p>
	<p><button onclick="document.getElementById('facial').style.display='block'" class="w3-button w3-black">Facial</button></p>
	<p><button onclick="document.getElementById('history').style.display='block'" class="w3-button w3-black">History</button></p>
	<p><button onclick="document.getElementById('Privacy').style.display='block'" class="w3-button w3-black">Privacy</button></p>
  </div>
   <div class="w3-display-topright w3-container w3-xlarge">

   <form action="sign/userlogout.php">
   <p><button class="w3-button w3-black">Sign Out</button></p>
   </form>
   </div>
  <div class="w3-display-bottomleft w3-container">
    <p class="w3-xlarge" style = "font-size:160%;">Working Hours : Monday - Friday 11am - 7pm | Saturday-Sunday 2pm-9pm</p>
	
    <p class="w3-large">Anna Nagar, Chennai</p>
    <p>powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </div>
</div>


<div id="Inbox" class="w3-modal">
	<div class="w3-modal-content w3-animate-zoom">
     <div class="w3-container w3-black w3-display-container">
	 <span onclick="document.getElementById('Inbox').style.display='none'" class="w3-button w3-display-topright w3-large">x</span>
	 <h1> Received Messages </h2>
	 <div>
	 <?php include('sign/inbox.php');?>
	 </div>
	 </div>
	</div> 
</div>

<div id="Barbers" class="w3-modal">
	<div class="w3-modal-content w3-animate-zoom">
     <div class="w3-container w3-black w3-display-container">
	 <span onclick="document.getElementById('Barbers').style.display='none'" class="w3-button w3-display-topright w3-large">x</span>
	 <h1> Available Barbers </h1>
	 </div>
	 
	</div> 
</div>


<!-- Haircut Menu Modal -->
<div id="haircut" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-black w3-display-container">
      <span onclick="document.getElementById('haircut').style.display='none'" class="w3-button w3-display-topright w3-large">x</span>
      <h1>Standard</h1>
    </div>
    <div class="w3-container">
      <h5>Summer Cut<b> ₹100.00</b></h5>
      <h5>Medium Cut <b> ₹90.00</b></h5>
      <h5>Trendy <b> ₹110.00</b></h5>
    </div>
    <div class="w3-container w3-black">
      <h1>Shave</h1>
    </div>
    <div class="w3-container">
      <h5>Clean Shave <b> ₹60.00</b></h5>
      <h5>Medium Trim <b> ₹40.50</b></h5>
      <h5>Customised Shave <b> ₹60.00</b></h5>
    </div>
    
  </div>
</div>

<!-- Appointment Modal -->
<div id="appoint" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-black">
      <span onclick="document.getElementById('appoint').style.display='none'" class="w3-button w3-display-topright w3-large">x</span>
      <h1>Appointment</h1>
    </div>
    <div class="w3-container">
      <h3>Create an Appointment, just send us a message:</h3>
    <form name="apply" method="post">
	
	 <?php if($error){?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
	  
		<p>	<select class="w3-input w3-padding-16 w3-border" name="service_type" autocomplete="off"> </p>
            <option  value="">Select Service type...</option>
			<?php $sql = "SELECT Service_Name from services";
			$query = $dbh -> prepare($sql);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			$cnt=1;
			if($query->rowCount() > 0)
				{
					foreach($results as $result)
				{   ?>                                            
					<option value="<?php echo htmlentities($result->Service_Name);?>"><?php echo htmlentities($result->Service_Name);?></option>
			<?php }} ?>
		
        <p><input class="w3-input w3-padding-16 w3-border" type="number" placeholder="How many people" required name="people"></p>
		<p><input class="w3-input w3-padding-16 w3-border" type="date" placeholder="Date and time" required name="_date"  ></p>
		<label for="_time">Choose an appointment time (opening hours 11:00 to 17:00): </label>
		<p><input class="w3-input w3-padding-16 w3-border" type="time" name="_time" min="10:00" max="20:00" placeholder="time" required ></p>
		<span class = "validity"> </span>
        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Message \ Special requirements" required name="description"></p>
		
		<input class="w3-input w3-padding-16 w3-border" placeholder="Mode of Payment" list="modes" name="payment_mode" />
		<datalist id="modes">
			<option value="Cash On Completion">
			<option value="Credit/Debit Card">
			<option value="Net Banking">
			<option value="Barb-Wallet">
		</datalist>
		
		<p><button class="w3-button" name="apply" id="apply" type="submit">CREATE APPOINTMENT</button></p>
		
     </form> 
    </div>
  </div>
</div>





<div id="facial" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom">
   <div class="w3-container w3-black">
      <span onclick="document.getElementById('facial').style.display='none'" class="w3-button w3-display-topright w3-large">x</span>
     
	 <h1>Facial Available</h1>
    <p class="page-description text-center">Barber Lancers offers a wide range of facial. Here are a few samples</p>
    
    <div class="tz-gallery">

        <div class="row">

            <div class="col-sm-3 col-md-4">
                <a class="lightbox" href="https://cdn.makeupandbeauty.com/wp-content/uploads/2012/09/Gold-Facial.jpg">
                    <img src="https://cdn.makeupandbeauty.com/wp-content/uploads/2012/09/Gold-Facial.jpg" width="200" height="150" alt="Gold Facial">
                </a>
            </div>
            <div class="col-sm-3 col-md-4">
                <a class="lightbox" href="http://www.rimmibeautysalon.com/wp-content/uploads/gallery/Platinum%20Facial.jpg">
                    <img src="http://www.rimmibeautysalon.com/wp-content/uploads/gallery/Platinum%20Facial.jpg" width="200" height="150" alt="Platinum Facial">
                </a>
            </div>
            <div class="col-sm-3 col-md-4">
                <a class="lightbox" href="https://cdn.makeupandbeauty.com/wp-content/uploads/2016/01/10-Different-Types-of-Facials-and-Their-Effects-biolift.jpg">
                    <img src="https://cdn.makeupandbeauty.com/wp-content/uploads/2016/01/10-Different-Types-of-Facials-and-Their-Effects-biolift.jpg" width="200" height="150" alt="Tunnel">
                </a>
            </div>
            <div class="col-sm-3 col-md-4">
                <a class="lightbox" href="https://2.bp.blogspot.com/-zuW5z4csqGc/V5rKZ750vsI/AAAAAAAAC-o/CC2HN1bMzPw62jLLkrCnat4VZhdGv5kcwCLcB/s400/Diamond%2BFacial.jpg">
                    <img src="https://2.bp.blogspot.com/-zuW5z4csqGc/V5rKZ750vsI/AAAAAAAAC-o/CC2HN1bMzPw62jLLkrCnat4VZhdGv5kcwCLcB/s400/Diamond%2BFacial.jpg" width="200" height="150" alt="Diamond Facial">
                </a>
            </div>
            <div class="col-sm-3 col-md-4">
                <a class="lightbox" href="https://mavcure.com/wp-content/uploads/2016/01/Fruit-Facial.jpg">
                    <img src="https://mavcure.com/wp-content/uploads/2016/01/Fruit-Facial.jpg" width="200" height="150" alt="Coast">
                </a>
            </div> 
            <div class="col-sm-3 col-md-4">
                <a class="lightbox" href="https://www.mybeautynaturally.com/publishingimages/daburbeauty/articlelarge/how-to-do-a-face-massage-at-home-14-steps.jpg">
                    <img src="https://www.mybeautynaturally.com/publishingimages/daburbeauty/articlelarge/how-to-do-a-face-massage-at-home-14-steps.jpg" width="200" height="150" alt="Face Massage">
                </a>
            </div>

        </div>

    </div>

	 
	 
    </div>
  </div>

</div>


<div id="history" class="w3-modal">
	<div class="w3-modal-content w3-animate-zoom">
     <div class="w3-container w3-black w3-display-container">
	 <span onclick="document.getElementById('history').style.display='none'" class="w3-button w3-display-topright w3-large">x</span>
	 <h1> History Of Barb Appointments </h2>
	 </div>
	 <?php include('sign/history.php');?>
	</div> 
</div>


<div id="Privacy" class="w3-modal">
	<div class="w3-modal-content w3-animate-zoom">
     <div class="w3-container w3-black w3-display-container">
	 <span onclick="document.getElementById('Privacy').style.display='none'" class="w3-button w3-display-topright w3-large">x</span>
	 <h1> Password Settings </h1>
	 </div>
	 <?php include('sign/privacy.php');?>
	</div>
	 </div>
	 


</body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script src="assets/plugins/jquery/jquery-2.2.0.min.js"></script>
        

<script>
    baguetteBox.run('.tz-gallery');
</script>






<?php } ?> 