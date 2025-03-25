<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['atsmsaid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {
    $adminid=$_SESSION['atsmsaid'];
    $AName=$_POST['adminname'];
  $mobno=$_POST['mobilenumber'];
  $email=$_POST['email'];
  
     $query=mysqli_query($con, "update tbladmin set AdminName='$AName', MobileNumber ='$mobno', Email= '$email' where ID='$adminid'");
    if ($query) {
    echo "<script>alert('Admin profile has been updated.');</script>";
    echo "<script>window.location.href='admin-profile.php'</script>";
  }else {
          echo "<script>alert('Something Went Wrong. Please try again.');</script>";
    }
  }
  ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🚖Ride Hub | Admin Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container-fluid vh-100 d-flex flex-column p-0">
        <?php
        include_once 'includes/header.php'
            ?>
        <!-- Main Content -->
        <div class="d-flex flex-grow-1 overflow-hidden">
            <?php include_once 'includes/sidebar.php'; ?>
            <div class="flex-grow-1 overflow-auto p-4 main-content">
                <h4 class="mb-4">Admin Profile</h4>

                <div class="row row-cols-1 row-cols-md-3 g-4">
                          
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Update</strong> Admin Profile
                                    </div>
                                    <div class="card-body card-block">
                                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                           

   <?php
$adminid=$_SESSION['atsmsaid'];
$ret=mysqli_query($con,"select * from tbladmin where ID='$adminid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="text-input" class=" form-control-label">Admin Name</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="adminname" name="adminname" value="<?php  echo $row['AdminName'];?>" class="form-control" required="">
                                                    
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="email-input" class=" form-control-label">Email Input</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="email" id="email" name="email" value="<?php  echo $row['Email'];?>" class="form-control" required="">
                                                    
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="password-input" class=" form-control-label">Phone Number</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="mobilenumber" name="mobilenumber" class="form-control" maxlength="10" value="<?php  echo $row['MobileNumber'];?>" required="">
                                                    
                                                </div>
                                            </div>
                                          
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="textarea-input" class=" form-control-label">User Name</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input name="username" id="username" rows="9" class="form-control" required="" readonly="" value="<?php  echo $row['UserName'];?>">

                                                </div>
                                            </div>
                                             <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="password-input" class=" form-control-label">Admin Registration date</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="text" id="adminregdate" name="adminregdate"  value="<?php  echo $row['AdminRegdate'];?>" class="form-control" required="" readonly="">
                                                    
                                                </div>
                                            </div>
                                                                                        
                                            <?php } ?>
                                          <div class="card-footer">
                                        <p style="text-align: center;"><button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm">Update
                                        </button></p>
                                        
                                    </div>
                                        </form>
                                    </div>
                                   
                                </div>
                       
                     
                        
      
</div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<!-- end document-->
<?php }  ?>