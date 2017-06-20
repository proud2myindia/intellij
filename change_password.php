<?php
session_start();

include ('config/connect.php');
include ('classes/admin.php');
include ('classes/user.php');
$error_msg = '';
$succ_msg = '';
$flag = 0;
$con = new connect_pdo();
$dbh = $con->getDb();

$admin = new Admin($dbh);
$user = new User($dbh);


if(isset($_POST['change_pass']))
{

    $new_pass = $_POST['user_password'];
    $re_pass = $_POST['user_repassword'];

    if($new_pass == $re_pass && trim($_POST['user_password'])!='')
    {
          $flag = 1;
    }
    else
    {
        $flag = 0;
    }


    if($flag == 1)
    {


        if($_SESSION['user_id'] == 0)
        {
            $user_data = array
            (
                'password' => $new_pass
            );
            if($ret = $admin->changePassword($user_data))
            {
                $succ_msg = "Password Changes Successfully";
            }
        }
        else
        {
            $user_data = array
            (
                'user_password' => $new_pass
            );

            if($ret = $user->changePassword($user_data,$_SESSION['user_id']))
            {
                $succ_msg = "Password Changes Successfully";
            }

        }


    }
    else
    {
        $error_msg = "Please fill the Password Properly, It does not matched Or empty";
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

                <h2>Change Password <span>// Manage Your Password</span></h2>

                <div class="page-bar">

                    <ul class="page-breadcrumb">
                        <li>
                            <a href="#"><i class="fa fa-home"></i> User</a>
                        </li>
                        <li>
                            <a href="change_password">Change Password</a>
                        </li>

                    </ul>

                </div>

            </div>


            <!-- row -->
            <div class="row">

                <!-- col -->
                <div class="col-md-7">

                    <!-- tile -->
                    <section class="tile">

                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><strong>Change </strong>Password</h1>
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
                        <div class="tile-body">
                           <?php if($succ_msg){    ?><div class="alert-success mysuc"><?php echo $succ_msg;   ?><META http-equiv="refresh" content="2; URL=change_password"></div><?php }  ?>
                            <form class="form-horizontal" role="form" method="post">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputEmail3" placeholder="New Password" name="user_password">
                                        <?php  if($error_msg){  ?><p class="help-block mb-0" style="color: red"><?php echo $error_msg;  ?></p><?php }  ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputEmail3" placeholder="Confirm Password" name="user_repassword">
                                        <?php  if($error_msg){  ?><p class="help-block mb-0" style="color: red"><?php echo $error_msg;  ?></p><?php }  ?>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-rounded btn-primary btn-sm" name="change_pass">Change Password</button>
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