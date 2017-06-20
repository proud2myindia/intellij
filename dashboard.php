<?php
session_start();
include ('config/connect.php');
include ('classes/task.php');
include ('classes/user.php');
if($_SESSION['user_id'] == '')
{
    header('location: index');
}
$error_msg = '';
$succ_msg = '';
$flag = 0;
$con = new connect_pdo();
$dbh = $con->getDb();

$task = new Task($dbh);
$tot_no_task = $task->getTotalNoTask();
$tot_no_task_user_id = $task->getTotalNoTaskByUserId($_SESSION['user_id']);

$user = new User($dbh);
$tot_no_user = $user->getTotalNoUser();


?>
<?php include('include/inner-header.php'); ?>
<?php include('include/leftmenu.php'); ?>

<?php include('include/rightmenu.php'); ?>


            <section id="content">

                <div class="page page-dashboard">

                    <div class="pageheader">

                        <h2>Dashboard <span>// You can place subtitle here</span></h2>

                        <div class="page-bar">

                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index-2.html"><i class="fa fa-home"></i> Minovate</a>
                                </li>
                                <li>
                                    <a href="index-2.html">Dashboard</a>
                                </li>
                            </ul>

                            <div class="page-toolbar">
                                <a role="button" tabindex="0" class="btn btn-lightred no-border pickDate">
                                    <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span></span>&nbsp;&nbsp;<i class="fa fa-angle-down"></i>
                                </a>
                            </div>

                        </div>

                    </div>

                    <!-- cards row -->
                    <div class="row">

                        <?php
                        if($_SESSION['user_id'] == 0)
                        {
                            ?>



                            <!-- col -->
                            <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                                <div class="card">
                                    <div class="front bg-lightred">

                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-xs-4">
                                                <i class="fa fa-shopping-cart fa-4x"></i>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-xs-8">
                                                <p class="text-elg text-strong mb-0"><?php echo $tot_no_user;   ?></p>
                                                <span>User</span>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->

                                    </div>
                                    <div class="back bg-lightred">

                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-xs-4">
                                                <a href=#><i class="fa fa-cog fa-2x"></i> Settings</a>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-xs-4">
                                                <a href=#><i class="fa fa-chain-broken fa-2x"></i> Content</a>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-xs-4">
                                                <a href=#><i class="fa fa-ellipsis-h fa-2x"></i> More</a>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->

                                    </div>
                                </div>
                            </div>
                            <!-- /col -->

                            <!-- col -->
                            <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                                <div class="card">
                                    <div class="front bg-blue">

                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-xs-4">
                                                <i class="fa fa-shopping-cart fa-4x"></i>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-xs-8">
                                                <p class="text-elg text-strong mb-0"><?php echo $tot_no_task;   ?></p>
                                                <span>Task</span>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->

                                    </div>
                                    <div class="back bg-blue">

                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-xs-4">
                                                <a href=#><i class="fa fa-cog fa-2x"></i> Settings</a>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-xs-4">
                                                <a href=#><i class="fa fa-chain-broken fa-2x"></i> Content</a>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-xs-4">
                                                <a href=#><i class="fa fa-ellipsis-h fa-2x"></i> More</a>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->

                                    </div>
                                </div>
                            </div>
                            <!-- /col -->


                            <?php
                        }
                        else
                        {
                            ?>

                            <!-- col -->
                            <div class="card-container col-lg-3 col-sm-6 col-sm-12">
                                <div class="card">
                                    <div class="front bg-blue">

                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-xs-4">
                                                <i class="fa fa-shopping-cart fa-4x"></i>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-xs-8">
                                                <p class="text-elg text-strong mb-0"><?php echo $tot_no_task_user_id;   ?></p>
                                                <span>Task</span>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->

                                    </div>
                                    <div class="back bg-blue">

                                        <!-- row -->
                                        <div class="row">
                                            <!-- col -->
                                            <div class="col-xs-4">
                                                <a href=#><i class="fa fa-cog fa-2x"></i> Settings</a>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-xs-4">
                                                <a href=#><i class="fa fa-chain-broken fa-2x"></i> Content</a>
                                            </div>
                                            <!-- /col -->
                                            <!-- col -->
                                            <div class="col-xs-4">
                                                <a href=#><i class="fa fa-ellipsis-h fa-2x"></i> More</a>
                                            </div>
                                            <!-- /col -->
                                        </div>
                                        <!-- /row -->

                                    </div>
                                </div>
                            </div>
                            <!-- /col -->

                            <?php
                        }
                        ?>


                    </div>
                    <!-- /row -->


                </div>

                
            </section>

<?php include('include/inner-footer.php'); ?>