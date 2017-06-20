<?php
session_start();

include ('config/connect.php');
include ('classes/user.php');
include ('classes/task.php');
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
$task = new Task($dbh);
$conglobal = new Configglobal();
$myfunc = new Myfunction();


if(isset($_POST['add_task']))
{

    $name = addslashes($_POST['name']);
    $description = addslashes($_POST['description']);


    if($_SESSION['user_id'] == 0)
    {
        $task_create_user_id = $_POST['task_create_user_id'];
    }
    else
    {
        $task_create_user_id = $_SESSION['user_id'];
    }




    $dateCreated = $conglobal->crntdatetime;


    if($myfunc->check_only_char($name))
    {
          $flag = 1;
    }
    else
    {
        $flag = 0;
        $error_tname = "Task Name Must Not be Empty and all will be character";
    }
    if($myfunc->fldempty($description))
    {
        $flag = $flag*1;
    }
    else
    {
        $flag = 0;
        $error_desc = "Task Must Not Empty";
    }

    if($myfunc->fldempty($task_create_user_id))
    {
        $flag = $flag*1;

    }
    else
    {
        $flag = 0;
        $error_user_id = "User Name not empty";
    }


    if($flag == 1)
    {
        $task_details_data = array
        (

            'name' => $name,
            'description' => $description,
            'task_create_user_id' => $task_create_user_id,

            'dateCreated' => $dateCreated


        );
        //print_r($task_details_data);

        if($ret = $task->addTask($task_details_data))
        {
            $succ_msg = "Congratulations Task Generated Successfully";
        }

    }
    else
    {
        $error_msg = "Please fill the Postiion";
    }



}

$dis_user = $user->getAllUser();
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

                <h2>Task <span>// Manage Your Task</span></h2>

                <div class="page-bar">

                    <ul class="page-breadcrumb">
                        <li>
                            <a href="task_listing"><i class="fa fa-home"></i> Task</a>
                        </li>
                        <li>
                            <a href="add_task">Add Task</a>
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
                            <h1 class="custom-font"><strong>Add </strong>Task</h1>
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
                                <a class="nav-link active" data-toggle="tab" href="#personal_details" role="tab">Task Details</a>
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
                               <META http-equiv="refresh" content="2; URL=task_listing"></div><?php }  ?>
                            <form class="form-horizontal" role="form" method="post">
                            <div class="tab-content">

                                    <div class="tab-pane active" id="personal_details" role="tabpanel">
                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Task Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="inputEmail3" placeholder="Task Name" name="name" value="<?php if(!empty($_POST['name'])){echo $_POST['name'];}  ?>">
                                                <?php  if(!empty($error_tname)){  ?><p class="help-block mb-0" style="color: red"><?php echo $error_tname;  ?></p><?php }  ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="inputEmail3" class="col-sm-4 control-label">Task Description</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control" id="inputEmail3" placeholder="Description" name="description" ><?php if(!empty($_POST['description'])){echo $_POST['description'];}  ?></textarea>
                                                <?php  if(!empty($error_desc)){  ?><p class="help-block mb-0" style="color: red"><?php echo $error_desc;  ?></p><?php }  ?>
                                            </div>
                                        </div>
                                        <?php
                                        if($_SESSION['user_id'] == 0)
                                        {
                                            ?>
                                            <div class="form-group">
                                                <label for="inputEmail3" class="col-sm-4 control-label">Task Create By</label>
                                                <div class="col-sm-8">
                                                    <select name="task_create_user_id" class="form-control">
                                                        <option value="">Select User</option>
                                                        <?php
                                                        foreach ($dis_user as $du)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $du['user_id']; ?>"><?php echo $du['user_fname'].''.$du['user_lname'];   ?></option>
                                                            <?php
                                                        }

                                                        ?>

                                                    </select>
                                                    <?php  if(!empty($error_user_id)){  ?><p class="help-block mb-0" style="color: red"><?php echo $error_user_id;  ?></p><?php }  ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>



                                        <div class="form-group">

                                            <div class="col-sm-8">
                                                <input type="submit" class="btn btn-info"  name="add_task" value="Add Task">

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