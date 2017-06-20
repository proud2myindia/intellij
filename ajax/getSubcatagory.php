<?php
/**
 * Created by PhpStorm.
 * User: Anandam
 * Date: 4/19/2017
 * Time: 10:26 AM
 */
include ('../config/connect.php');
include ('../classes/subcatagory.php');
$cat_id = $_GET['q'];

$con = new connect_pdo();
$dbh = $con->getDb();
$subcat = new Subcatagory($dbh);

$allsubcat = $subcat->getSubCatagoryByCatagoryId($cat_id);


?>
<select name="product_subcat_id" class="form-control">

    <option value="">Select Subcatagory</option>
    <?php
    foreach($allsubcat as $a)
    {
        ?>
        <option value="<?php echo $a['subcatagory_id'];   ?>"><?php echo $a['subcatagory_name'];   ?></option>
    <?php
    }

    ?>

</select>

