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

$user_id = base64_decode($_GET['user_id']);

if(isset($_POST['edit_status']))
{

    $user_status = addslashes($_POST['user_status']);


        $user_status_data = array
        (

            'user_status' => $user_status

        );


        if($ret = $user->editUserStatus($user_status_data,$user_id))
        {
            $succ_msg = "Status of User change Successfully";
        }

}

$dis_user = $user->getUserById($user_id);

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
                            <a href="edit_user">Edit User</a>
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
                            <h1 class="custom-font"><strong>Change User </strong>Status</h1>
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
                                            <label for="inputEmail3" class="col-sm-4 control-label">Change Status</label>
                                            <div class="col-sm-8">
                                                <select name="user_status" class="form-control">
                                                    <option value="1" <?php if($dis_user['user_status'] == '1'){echo "selected"; }  ?>>Active</option>
                                                    <option value="0" <?php if($dis_user['user_status'] == '0'){echo "selected"; }  ?>>De Active</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <div class="col-sm-8">
                                                <input type="submit" class="btn btn-info"  name="edit_status" value="Change User Status">

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