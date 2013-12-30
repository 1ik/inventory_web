<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/10/13
 * Time: 11:25 PM
 * To change this template use File | Settings | File Templates.
 */
?>

<div class="row">
    <div class="col-md-4 formcontainer">
        <?php echo form_open('expense_type', array('type' => 'post' , 'role' => 'form')); ?>

        <div class="form-group">
            <label for="reason"> expense Type name : </label>
            <?php echo form_input(array('type' => 'text' , 'name' => 'reason', 'class' => 'form-control')); ?>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-default" value="submit"/>
        </div>
        <?php echo form_close();?>

        <?php echo br(2); ?>
        <?php echo validation_errors(); ?>
    </div>

    <div class="col-md-8">
        <div class="table table-responsive">
            <table class="table-bordered table table-bordered">
                <tr>
                    <th>Id  </th>
                    <th>expense type  </th>
                <tr/>
                <?php foreach($expense_types as $expense_type): ?>
                    <tr>
                        <td> <?php print $expense_type->id; ?></td>
                        <td> <?php print $expense_type->reason; ?></td>
                        <td> <?php echo anchor('expense_type/delete/'.$expense_type->id , "DELETE"); ?> </td>
                        <td> <?php echo anchor('expense_type/edit/'.$expense_type->id , "Edit"); ?> </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>




</div>