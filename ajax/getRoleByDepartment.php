<?php
/**
 * Created by PhpStorm.
 * User: Anandam
 * Date: 4/19/2017
 * Time: 10:26 AM
 */
include ('../config/connect.php');
include ('../classes/department.php');
include ('../classes/role.php');

$dept_id = $_GET['dept_id'];

$con = new connect_pdo();
$dbh = $con->getDb();
$dept = new Department($dbh);
$role = new Role($dbh);


$dis_role = $role->getAllRoleByDeptId($dept_id);
?>
<select class="form-control"  name="branch_city_id"  id="branch_dept_id">
    <option value="">Select Role</option>
<?php

foreach ($dis_role as $drl) {


    ?>


    <option value="<?php echo $drl['role_id'];  ?>"><?php echo $drl['role_name'];  ?></option>
    <?php
}
    ?>





