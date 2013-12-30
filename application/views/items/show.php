<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/13/13
 * Time: 12:02 PM
 * To change this template use File | Settings | File Templates.
 */
?>

<style type="text/css">
    .purchases table tr th , .purchases table tr td{
        padding-left : 30px;
    }
    .createpurchase{
        margin-top: 100px;
    }

</style>

=========================================<br/>
F I L T E R C R I N G &nbsp &nbsp T E R I A<br/>

<?php echo form_open('items/show' , array('method' => 'POST'));?>
    <label>Designer style : </label><input type="text/css" name="designer_style" /><br/>
    <input type="submit" value="submit"/>
<?php echo form_close()?>
=========================================<br/>
<br/>

<?php if(isset($purchase_id)): ?>
<h2>Showing items of Purchase no : <?php print $purchase_id; ?> </h2>
<?php endif?>


<div class="purchases">
    <table>
        <tr>
            <th> id </th>
            <th> added on </th>
            <th> BARCODE </th>
            <th> Store Transferred </th>
            <th>  Transferred On</th>
            <th> Sold On </th>
        <tr>
        <?php foreach($items as $item): ?>
            <tr>
                <td> <?php print $item->id ?> </td>
                <td> <?php print $item->added_on ?> </td>
                <td> <?php print $item->barcode ?> </td>
                <td> <?php print $item->outlet_id ?> </td>
                <td> <?php print $item->assigned_on ?> </td>
                <td> <?php print $item->sold_on ?> </td>
            </tr>
        <?php endforeach?>
    </table>

</div>

<div class="createpurchase">
    <?php print anchor('purchase/create' , 'create another purchase');?>
</div>




