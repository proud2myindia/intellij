<?php
session_start();
include ('config/connect.php');
include ('classes/admin.php');
include ('classes/user.php');

$con = new connect_pdo();
$dbh = $con->getDb();


$admin = new Admin($dbh);
$user = new User($dbh);


if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == 'admin')
    {
        $ret = $admin->adminLogin($username,$password);
        if($ret == true)
        {
            $_SESSION['username'] = 'admin';

            $_SESSION['user_id'] = '0';
            header('location: dashboard');
        }
        else
        {
            $error_msg = "Sorry You are not Authenticate";
        }
    }
    else
    {
        if($ret = $admin->userLogin($username,$password))
        {
            $_SESSION['username'] = $ret['user_name'];

            $_SESSION['user_id'] = $ret['user_id'];
            if($ret['user_status'] == '1')
            {
                header('location: dashboard');
            }
            else
            {
                $error_msg = "Sorry You are not Blocked Please contact Admin";
            }

        }
        else
        {
            $error_msg = "Sorry You are not Authenticate";
        }
    }
}
?>
<?php  include('include/header.php');   ?>


    <body id="minovate" class="appWrapper">






        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->












        <!-- ====================================================
        ================= Application Content ===================
        ===================================================== -->
        <div id="wrap" class="animsition">




            <div class="page page-core page-login">

                <div class="text-center"><h3 class="text-light text-white"><span class="text-lightred">Inte</span>llij</h3></div>

                <div class="container w-420 p-15 bg-white mt-40 text-center">

                    <?php if(!empty($error_msg)){  ?><div class="alert-danger" style="height: 43px; padding-top: 11px;"><?php echo $error_msg;  ?></div><?php  }  ?>
                    <h2 class="text-light text-greensea">Log In</h2>

                    <form name="form" class="form-validation mt-20" novalidate="" method="post">

                        <div class="form-group">
                            <input type="text" class="form-control underline-input" placeholder="Username" name="username">
                        </div>

                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control underline-input" name="password">
                        </div>

                        <div class="form-group text-left mt-20">
                            <button class="btn btn-greensea b-0 br-2 mr-5" type="submit" name="login">Login</button>


                        </div>

                    </form>

                    <hr class="b-3x">

                    <div class="social-login text-left">

                        <ul class="pull-right list-unstyled list-inline">

                        </ul>

                        <!--<h5>Or login with</h5>-->

                    </div>

                    <div class="bg-slategray lt wrap-reset mt-40">
                        <p class="m-0">

                        </p>
                    </div>

                </div>

            </div>



        </div>
        <!--/ Application Content -->
<?php include('include/footer.php');   ?>