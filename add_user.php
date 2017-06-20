<?php
session_start();

include ('config/connect.php');
include ('classes/user.php');
include ('config/configglobal.php');
include ('lib/myfunction.php');

if($_SESSION['user_id'] == '')
{
    header('location: index');
}

$error_msg = '';
$succ_msg = '';
$flag = 0;
$con = new connect_pdo();
$dbh = $con->getDb();

$user = new User($dbh);
$conglobal = new Configglobal();
$myfunc = new Myfunction();


if(isset($_POST['add_user']))
{

    $user_fname = addslashes($_POST['user_fname']);
    $user_lname = addslashes($_POST['user_lname']);
    $user_name = addslashes($_POST['user_name']);
    $user_password = md5($_POST['user_password']);

    $user_contact = addslashes($_POST['user_contact']);
    $user_email = addslashes($_POST['user_email']);

    $user_create_date = $conglobal->crntdatetime;



    if($myfunc->check_only_char($user_fname))
    {
          $flag = 1;
    }
    else
    {
        $flag = 0;
        $error_fname = "First Name Must be all Character";
    }
    if($myfunc->check_only_char($user_lname))
    {
        $flag = $flag*1;
    }
    else
    {
        $flag = 0;
        $error_lname = "Last Name Must be all Character";
    }

    if($myfunc->fldempty($user_name))
    {
        $flag = $flag*1;

    }
    else
    {
        $flag = 0;
        $error_user_name = "User Name not empty";
    }

    if($myfunc->fldempty($_POST['user_password']))
    {
        $flag = $flag*1;

    }
    else
    {
        $flag = 0;
        $error_user_pass = "Password not empty";
    }

    if($myfunc->emailValid($user_email))
    {
        $flag = $flag*1;

    }
    else
    {
        $flag = 0;
        $error_user_email = "Email Not Valid";
    }

    if($myfunc->check_ph($user_contact))
    {
        $flag = $flag*1;

    }
    else
    {
        $flag = 0;
        $error_user_contact = "Mobile Not Valid";
    }

    if($user->checkDupUserName($user_name) == 0)
    {
        $flag = $flag*1;

    }
    else
    {
        $flag = 0;
        $error_user_name = "You Can not use this username it is already be taken";
    }

    if($flag == 1)
    {
        $user_personal_details_data = array
        (

            'user_fname' => $user_fname,
            'user_lname' => $user_lname,
            'user_name' => $user_name,
            'user_password' => $user_password,
            'user_contact' => $user_contact,
            'user_email' => $user_email,
            'user_create_date' => $user_create_date


        );

        if($ret = $user->addUser($user_personal_details_data))
        {
            $succ_msg = "Congratulations User Generated Successfully";
        }

    }
    else
    {
        $error_msg = "Please fill the Postiion";
    }



}


?>
<?php include('include/inner-header.php'); ?>
<?php include('include/leftmenu.php'); ?>

<?php include('include/rightmenu.php'); ?>

    <!-- ====================================================
    ================= CONTENT ===============================
    ===================================================== -->
    <section id="content">

        <div class="page page-forms-common">

            <div class="pageheader">

                <h2>User <span>// Manage Your User</span></h2>

                <div class="page-bar">

                    <ul class="page-breadcrumb">
                        <li>
                            <a href="user_listing"><i class="fa fa-home"></i> User</a>
                        </li>
                        <li>
                            <a href="add_user">Add User</a>
                        </li>

                    </ul>

                </div>

            </div>


            <!-- row -->
            <div class="row">

                <!-- col -->
                <div class="col-md-9">

                    <!-- tile -->
                    <section class="tile">

                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><strong>Add </strong>User</h1>
                            <ul class="controls">
                                <li class="dropdown">

                                    <a role="button" tabindex="0" class="dropdown-toggle settings" data-toggle="dropdown">
                                        <i class="fa fa-cog"></i>
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </a>

                                    <ul class="dropdown-menu pull-right with-arrow animated littleFadeInUp">
                                        <li>
                                            <a role="button" tabindex="0" class="tile-toggle">
                                                <span class="minimize"><i class="fa fa-angle-down"></i>&nbsp;&nbsp;&nbsp;Minimize</span>
                                                <span class="expand"><i class="fa fa-angle-up"></i>&nbsp;&nbsp;&nbsp;Expand</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a role="button" tabindex="0" class="tile-refresh">
                                                <i class="fa fa-refresh"></i> Refresh
                                            </a>
                                        </li>
                                        <li>
                                            <a role="button" tabindex="0" class="tile-fullscreen">
                                                <i class="fa fa-expand"></i> Fullscreen
                                            </a>
                                        </li>
                                    </ul>

                                </li>
                                <li class="remove"><a role="button" tabindex="0" class="tile-close"><i class="fa fa-times"></i></a></li>
                            </ul>
                        </div>
                        <!-- /tile header -->

                        <!-- tile body -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#personal_details" role="tab">Personal Details</a>
                            </li>
                           <!-- <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#bank_details" role="tab">Bank Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#role_details" role="tab">Job Role Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#salary_details" role="tab">Salary</a>
                            </li>-->
                        </ul>
                        <div class="tile-body">



                           <?php if($succ_msg){    ?><div class="alert-success mysuc"><?php echo $succ_msg;   ?>
                               <META http-equiv="refresh" content="2; URL=user_listing"></div><?php }  ?>
                            <form class="form-horizontal" role="form" method="post">
                            <div class="tab-content">

                                    <div class="tab-pane active" id="personal_details" role="tabpanel">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-4 control-label">First Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="First Name" name="user_fname" value="<?php if(!empty($_POST['user_fname'])){echo $_POST['user_fname'];}  ?>">
                                                <?php  if(!empty($error_fname)){  ?><p class="help-block mb-0" style="color: red"><?php echo $error_fname;  ?></p><?php }  ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Last Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Last Name" name="user_lname" value="<?php if(!empty($_POST['user_lname'])){echo $_POST['user_lname'];}  ?>">
                                                <?php  if(!empty($error_lname)){  ?><p class="help-block mb-0" style="color: red"><?php echo $error_lname;  ?></p><?php }  ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-4 control-label">User Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="User Name" name="user_name" value="<?php if(!empty($_POST['user_name'])){echo $_POST['user_name'];}  ?>">
                                                <?php  if(!empty($error_user_name)){  ?><p class="help-block mb-0" style="color: red"><?php echo $error_user_name;  ?></p><?php }  ?>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Contact No</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Contact No" name="user_contact" value="<?php if(!empty($_POST['user_contact'])){echo $_POST['user_contact'];}  ?>">
                                                <?php  if(!empty($error_user_contact)){  ?><p class="help-block mb-0" style="color: red"><?php echo $error_user_contact;  ?></p><?php }  ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Email" name="user_email" value="<?php if(!empty($_POST['user_email'])){echo $_POST['user_email'];}  ?>">
                                                <?php  if(!empty($error_user_email)){  ?><p class="help-block mb-0" style="color: red"><?php echo $error_user_email;  ?></p><?php }  ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Password</label>
                                            <div class="col-sm-8">
                                                <input type="password" class="form-control" id="inputEmail3" placeholder="Password" name="user_password">
                                                <?php  if(!empty($error_user_pass)){  ?><p class="help-block mb-0" style="color: red"><?php echo $error_user_pass;  ?></p><?php }  ?>
                                            </div>
                                        </div>



                                        <div class="form-group">

                                            <div class="col-sm-8">
                                                <input type="submit" class="btn btn-info"  name="add_user" value="Add User">

                                            </div>
                                        </div>

                                    </div>



                                
                            </div>
                            </form>

                        </div>
                        <!-- /tile body -->

                    </section>
                    <!-- /tile -->

                </div>
                <!-- /col -->


            </div>



        </div>

    </section>
    <!--/ CONTENT -->
<?php include('include/inner-footer.php'); ?>