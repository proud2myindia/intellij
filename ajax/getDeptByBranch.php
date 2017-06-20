<?php
/**
 * Created by PhpStorm.
 * User: Anandam
 * Date: 4/19/2017
 * Time: 10:26 AM
 */
include ('../config/connect.php');
include ('../classes/department.php');
include ('../classes/branch.php');

$branch_id = $_GET['branch_id'];

$con = new connect_pdo();
$dbh = $con->getDb();
$dept = new Department($dbh);
$branch = new Branch($dbh);


$dis_dept = $dept->getAllDepartmentByBranchId($branch_id);
?>
<select class="form-control"  name="branch_city_id"  id="branch_dept_id"  onchange="showRoleByDepartment(this.value)">
    <option value="">Select Department</option>
<?php

foreach ($dis_dept as $dpt) {


    ?>


    <option value="<?php echo $dpt['department_id'];  ?>"><?php echo $dpt['department_name'];  ?></option>
    <?php
}
    ?>





