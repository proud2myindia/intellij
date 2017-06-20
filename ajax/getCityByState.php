<?php
/**
 * Created by PhpStorm.
 * User: Anandam
 * Date: 4/19/2017
 * Time: 10:26 AM
 */
include ('../config/connect.php');
include ('../classes/city.php');

$state_id = $_GET['state_id'];

$con = new connect_pdo();
$dbh = $con->getDb();
$city= new City($dbh);


$dis_city = $city->getCityByStateId($state_id);
?>
<select tabindex="-1" class="chosen-select" style="width: 400px;" name="branch_city_id" id="city_id">
    <option value="">Select City</option>
<?php

foreach ($dis_city as $ds) {


    ?>


    <option value="<?php echo $ds['city_id'];  ?>"><?php echo $ds['city_name'];  ?></option>
    <?php
}
    ?>


    </select>





