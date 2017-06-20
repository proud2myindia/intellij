<?php
/**
 * Created by PhpStorm.
 * User: Anandam
 * Date: 4/19/2017
 * Time: 10:26 AM
 */
include ('../config/connect.php');
include ('../classes/state.php');

$country_id = $_GET['country_id'];

$con = new connect_pdo();
$dbh = $con->getDb();
$state = new State($dbh);


$dis_state = $state->getStateByCountryId($country_id);
?>
<select class="form-control" name="employee_state_id" id="state_id">
    <option value="">Select State</option>
<?php

foreach ($dis_state as $ds) {


    ?>


    <option value="<?php echo $ds['state_id'];  ?>"><?php echo $ds['state_name'];  ?></option>
    <?php
}
    ?>





