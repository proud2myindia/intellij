<?php
session_start();

include ('config/connect.php');
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

$user = new User($dbh);

if(!empty($_REQUEST['del_id']))
{
   $del_id = base64_decode($_REQUEST['del_id']);
   if($user->deleteUser($del_id))
   {
     $succ_msg = "User Deleted Successfully";
   }
}
if(isset($_REQUEST['srch_user']))
{
    $keyword = $_REQUEST['keyword'];
    $dis_user_data = $user->searchUser($keyword);

}
else
{
    $dis_user_data = $user->getAllUser();
}


?>
<?php include('include/inner-header.php'); ?>
<?php include('include/leftmenu.php'); ?>

<?php include('include/rightmenu.php'); ?>

    <section id="content">

        <div class="page page-tables-bootstrap">

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
                <div class="col-md-12">


                    <!-- tile -->
                    <section class="tile">

                        <!-- tile header -->
                        <div class="tile-header dvd dvd-btm">
                            <h1 class="custom-font"><strong>User</strong> Management</h1>
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

                                <li><a href="add_user" role="button" tabindex="0"><i class="fa fa-plus"></i></a></li>
                            </ul>
                        </div>
                        <!-- /tile header -->

                        <!-- tile widget -->
                        <div class="tile-widget">

                            <div class="row">

                                <?php if($succ_msg){    ?><div class="alert-success mysuc"><?php echo $succ_msg;   ?>
                                    <META http-equiv="refresh" content="2; URL=user_listing"></div><?php }  ?>

                                <div class="col-sm-3"></div>
                               <form method="get">


                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" class="input-sm form-control" placeholder="Search..." name="keyword">
                                        <span class="input-group-btn">
                                                    <button class="btn btn-sm btn-default" type="submit" name="srch_user">Search!</button>
                                                  </span>
                                    </div>
                                </div>
                               </form>
                            </div>

                        </div>
                        <!-- /tile widget -->

                        <!-- tile body -->
                        <div class="tile-body p-0">

                            <div class="table-responsive">
                                <table class="table mb-0" id="usersList">
                                    <thead>
                                    <tr>
                                        <th style="width:20px;">
                                            <label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0">
                                                <input type="checkbox" id="select-all"><i></i>
                                            </label>
                                        </th>

                                        <th>User Full Name</th>
                                        <th>Username</th>
                                        <th>User Email</th>
                                        <th>User Mobile</th>
                                        <th>User Status</th>

                                        <th style="width:30px;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                     $cnt = 1;
                                     $cnt_user = count($dis_user_data);
                                     if(!empty($dis_user_data)) {

                                         foreach ($dis_user_data as $c) {

                                             ?>

                                             <tr>
                                                 <td><label class="checkbox checkbox-custom-alt checkbox-custom-sm m-0"><input
                                                                 type="checkbox" class="selectMe"><i></i></label></td>

                                                 <td><?php echo $c['user_fname'] . ' ' . $c['user_lname']; ?></td>
                                                 <td><?php echo $c['user_name']; ?></td>
                                                 <td><?php echo $c['user_email']; ?></td>
                                                 <td><?php echo $c['user_contact']; ?></td>
                                                 <td><?php if ($c['user_status'] == '1') {
                                                         echo "Active";
                                                     } else {
                                                         echo "Deactive";
                                                     } ?></td>

                                                 <td style="width: 290px;">


                                                     <div class="btn-group">
                                                         <button id="btnGroupVerticalDrop3" type="button"
                                                                 class="btn btn-info dropdown-toggle"
                                                                 data-toggle="dropdown" aria-expanded="false">
                                                             Choose Action
                                                             <span class="caret"></span>
                                                         </button>
                                                         <ul class="dropdown-menu" role="menu"
                                                             aria-labelledby="btnGroupVerticalDrop3">
                                                             <li>
                                                                 <a href="edit_user?user_id=<?php echo base64_encode($c['user_id']); ?>">Edit</a>
                                                             </li>
                                                             <li>
                                                                 <a href="change_status?user_id=<?php echo base64_encode($c['user_id']); ?>">Change
                                                                     Status</a></li>

                                                             <li>
                                                                 <a onclick="javascript: return confirm('Are you Sure you want to delete the User?')" href="user_listing?del_id=<?php echo base64_encode($c['user_id']); ?>">Delete</a>
                                                             </li>
                                                         </ul>
                                                     </div>
                                                 </td>
                                             </tr>
                                             <?php
                                             $cnt++;
                                         }
                                     }
                                     else
                                     {
                                         ?>
                                         <tr>
                                             <td colspan="5">Sorry No User Found</td>
                                         </tr>
                                         <?php

                                     }

                                    ?>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <!-- /tile body -->

                        <!-- tile footer -->
                        <div class="tile-footer dvd dvd-top">
                            <div class="row">



                                <div class="col-sm-3 text-center">
                                    <small class="text-muted">showing <?php echo $cnt_user;  ?> User</small>
                                </div>


                            </div>
                        </div>
                        <!-- /tile footer -->

                    </section>
                    <!-- /tile -->



                </div>
                <!-- /col -->
            </div>
            <!-- /row -->


        </div>

    </section>


<?php include('include/inner-footer.php'); ?>