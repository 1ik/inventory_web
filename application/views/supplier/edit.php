<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/11/13
 * Time: 1:23 AM
 * To change this template use File | Settings | File Templates.
 */
?>


<style type="text/css">
    .outlets tr td , .outlets tr th{
        padding-left : 50px;

    }

    .formcontainer{
        padding : 50px;
    }
</style>




<div class="row">

    <div class="col-md-6 formcontainer">
        <h2>edit supplier</h2>
        <?php echo form_open('supplier/edit/'.$supplier->id, array('type' => 'post')); ?>


        <div class="form-group">
            <label for="supplier_name"> Supplier name : </label>
            <?php echo form_input(array('type' => 'text' , 'name' => 'supplier_name', 'class' => 'form-control' , 'value' => $supplier->name)); ?>
        </div>


        <div class="form-group">
            <label for="supplier_phone"> Supplier Phone : </label>
            <?php echo form_input(array('type' => 'text' , 'name' => 'supplier_phone' , 'class' => 'form-control' ,  'value' => $supplier->cell_no)); ?> <br/>
        </div>


        <div class="form-group">
            <label for="supplier_email"> Supplier email : </label>
            <?php echo form_input(array('type' => 'text' , 'name' => 'supplier_email' , 'class' => 'form-control' , 'value' => $supplier->email)); ?>
        </div>


        <div class="form-group">
            <label for="supplier_address"> supplier address : </label>
            <textarea name="supplier_address" class="form-control"> <?php echo $supplier->address; ?> </textarea>
        </div>


        <div class="form-group">
            <input type="submit" class="btn btn-default" value="submit"/>
        </div>



        <?php echo br(4); ?>
        <?php echo validation_errors(); ?>

    </div>

</div>



