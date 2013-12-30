<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/14/13
 * Time: 11:12 AM
 * To change this template use File | Settings | File Templates.
 */
?>

<div class="row">
    <div class="col-md-4 formcontainer">
        <?php echo form_open('expanse_type/edit/'.$expanse_type->id, array('type' => 'post' , 'role' => 'form')); ?>

        <div class="form-group">
            <p>Editing Expanse Type : <b> <?php echo $expanse_type->reason; ?> </b> </p>

            <label for="reason"> Expanse Type name : </label>
            <?php echo form_input(array( 'value'=> $expanse_type->reason, 'type' => 'text' , 'name' => 'reason', 'class' => 'form-control')); ?>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-default" value="submit"/>
        </div>
        <?php echo form_close();?>

        <?php echo br(2); ?>
        <?php echo validation_errors(); ?>
    </div>
</div>