<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/11/13
 * Time: 1:23 AM
 * To change this template use File | Settings | File Templates.
 */
//var_dump($color);
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
        <h3>Edit color</h3>
        <br/>
        <?php echo form_open('color/update/'.$color->id, array('type' => 'post' , 'role' => 'form')); ?>

        <div class="form-color">
            <label for="name"> Color Code : </label>
            <?php echo form_input(array('type' => 'text' , 'name' => 'color_code', 'class' => 'form-control' , 'value' => $color->color_code)); ?> <br/>
        </div>
        <div class="form-color">
            <label for="name"> Color Description : </label>
            <?php echo form_input(array('type' => 'text' , 'name' => 'description', 'class' => 'form-control' , 'value' => $color->description)); ?> <br/>
        </div>

        <div class="form-color">
            <input type="submit" class="btn btn-default" value="submit"/>
        </div>
        <?php echo form_close();?>

        <?php echo br(2); ?>
        <?php echo validation_errors(); ?>
    </div>
</div>



