<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/11/13
 * Time: 1:23 AM
 * To change this template use File | Settings | File Templates.
 */
//var_dump($group);
?>






<style type="text/css">
    .outlets tr td , .outlets tr th{
        padding-left : 50px;

    }

    .formcontainer{
        padding-left : 50px;
    }
</style>



<div class="row">
    <div class="col-md-4 formcontainer">
        <h3>Edit Group</h3>
        <br/>
        <?php echo form_open('group/update/'.$group->id, array('type' => 'post' , 'role' => 'form')); ?>

        <div class="form-group">
            <label for="name"> Group name : </label>
            <?php echo form_input(array('type' => 'text' , 'name' => 'name', 'class' => 'form-control' , 'value' => $group->name)); ?> <br/>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-default" value="submit"/>
        </div>
        <?php echo form_close();?>

        <?php echo br(2); ?>
        <?php echo validation_errors(); ?>
    </div>
</div>



