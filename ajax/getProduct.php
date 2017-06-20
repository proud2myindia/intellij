<?php
/**
 * Created by PhpStorm.
 * User: Anandam
 * Date: 4/19/2017
 * Time: 10:26 AM
 */
include ('../config/connect.php');
include ('../classes/product.php');
include ('../classes/purchase.php');
include ('../classes/tax.php');
$prod_id = $_GET['q'];

$con = new connect_pdo();
$dbh = $con->getDb();
$prod = new Product($dbh);
$purchase = new Purchase($dbh);
$allprod = $prod->getProductById($prod_id);
$tax = new Tax($dbh);
$data = array(
        'product_id'=>$prod_id
);
$ret = $purchase->addTempPurchase($data);

$dis = $purchase->getAllTempPurchase();
$i = 1;

$s = 0;
$tot_tax = 0;

$cnt_temp_purchase = $purchase->getNoTempPurchase();
//echo $cnt_temp_purchase;

foreach ($dis as $d) {

    $single_prod = $prod->getProductById($d['product_id']);
    $single_tax = $tax->getTaxById($single_prod['product_tax_id']);
    $total_tax = $single_tax['product_tax_value'];

    $tax_amt = ($single_prod['product_price']*$total_tax)/100;
    $sub_tot = $tax_amt+ $single_prod['product_price'];

    $s = $s+$sub_tot;
    $tot_tax = $tot_tax+$tax_amt;
    ?>

    <tr style="background-color: #a2afc8">
        <td><?php echo $i; ?></td>
        <td><?php echo $single_prod['product_name']; ?>(<?php  echo  $single_prod['product_code']; ?>)</td>
        <td><?php echo $single_prod['product_price']; ?></td>
        <td><input type="text" id="qty<?php echo $i;   ?>" name="product_qty[]" value="1" onkeyup="javascript: getTotal(this.value,document.getElementById('price_id'+<?php echo $i;   ?>).value,document.getElementById('tax_id'+<?php echo $i;   ?>).value,<?php echo $i;  ?>,<?php echo $cnt_temp_purchase;   ?>);"></td>

        <td><?php echo $single_tax['product_tax'];  ?></td>
        <td id="show_tot<?php echo $i ; ?>"><?php echo $sub_tot; ?></td>

        <!--tax id--><input type="hidden" name="product_tax_id[]" id="tax_id<?php echo $i;   ?>" value="<?php echo $single_tax['product_tax_value']; ?>">
        <!--price id--><input type="hidden" name="product_price[]" id="price_id<?php echo $i;   ?>" value="<?php echo $single_prod['product_price']; ?>">
        <!--product id--><input type="hidden" name="product_id[]" value="<?php echo $single_prod['product_id']; ?>">
        <!--product tax--><input type="hidden" id="prod_tax<?php echo $i ; ?>" name="product_tax[]" value="<?php echo $tax_amt;   ?>">
        <!--sub total price--><input type="hidden" id="sub_tot_price<?php echo $i ; ?>" name="sub_total_price[]" value="<?php echo $sub_tot;   ?>">

    </tr>
    <?php
    $i++;
}
    ?>

<tr>

    <td colspan="5">Total Tax :<span id="tot_tax"><?php echo $tot_tax;   ?></span></td>
    <td colspan="6">Grand Total:<span id="grand_tot"><?php echo $s;   ?></span></td>

</tr>



