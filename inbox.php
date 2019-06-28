

<!DOCTYPE html> 
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
<link rel="stylesheet" href="fluid-gallery.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
 <style>
body,h1,h5 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
    background-image: url("https://cdn.chrisogrady.com/wp-content/uploads/interior-photography-tanglin-club-singapore-hair-salon.jpg");
    min-height: 100%;
    background-position: center;
    background-size: cover;
}
</style>
 
 <div class="col s12">
                        <div class="page-title">
						
						<h2> Inbox</h2>
						
						</div>
						
                   
                    <div class="col s12 m12 l12">
                        <div class="card">
                            <div class="card-content">
                                <table id="ex" class="display responsive-table ">
                                    <thead>
                                        <tr>
                                            <th width="60">#</th>
                                            <th width="180">From</th>
                                            <th width="300">Remark</th>
                                            <th width="180">Time of Remark</th>
                                             <th width="180">Special Request</th>
                                            <th width="120">Status</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php 
$user=$_SESSION['user_id'];
$sql = "SELECT professional.first_name,professional.last_name,job_assignment.id as lid,job_assignment.prof_remark,job_assignment.prof_remark_date,job_assignment.service_type,job_assignment._date,job_assignment._time,job_assignment.people,job_assignment.status from job_assignment,professional where prof_remark!= NULL and job_assignment.user_id=:user and job_assignment.prof_id=professional.id";
$query = $dbh -> prepare($sql);
$query->bindParam(':user',$user,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                        <tr>
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities(($result->first_name." ".$result->last_name));?></td>
                                            <td><?php echo htmlentities($result->prof_remark);?></td>
                                            <td><?php echo htmlentities($result->prof_remark_date);?></td>
                                           <td><?php echo htmlentities($result->description);?></td>
                                            <td><?php if($result->prof_remark=="")
                                            {
echo htmlentities('waiting for response');
                                            } else
{

 echo htmlentities(($result->prof_remark)." "."at"." ".$result->prof_remark_date);
}

                                            ?></td>
                                                                                 <td><?php $stats=$result->Status;
if($stats==1){
                                             ?>
                                                 <span style="color: green">Approved</span>
                                                 <?php } if($stats==2)  { ?>
                                                <span style="color: red">Not Approved</span>
                                                 <?php } if($stats==0)  { ?>
 <span style="color: blue">waiting for approval</span>
 <?php } ?>

                                             </td>
          
                                        </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
 </div>