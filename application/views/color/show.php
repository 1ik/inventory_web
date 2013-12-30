<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/10/13
 * Time: 11:25 PM
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
    <div class="col-md-4 formcontainer">
        <?php echo form_open('color', array('type' => 'post' , 'role' => 'form')); ?>

            <div class="form-group">
                <label for="color_code"> Color Code : </label>
                <?php echo form_input(array('type' => 'text' , 'name' => 'color_code', 'class' => 'form-control' , 'autocomplete' => 'off')); ?>
            </div>
            <div class="form-group">
                <label for="color_code"> Color Description : </label>
                <?php echo form_input(array('type' => 'text' , 'name' => 'description', 'class' => 'form-control' , 'autocomplete' => 'off')); ?>
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
            <p>Colors : </p>
            <table class="table-bordered table table-bordered">
                <tr>
                    <th>color code  </th>
                    <th>Description  </th>
                    <th colspan="2"> ACTION</th>
                <tr/>
                <?php foreach($colors as $color): ?>
                    <tr>
                        <td> <?php print $color->color_code; ?></td>
                        <td> <?php print $color->description; ?></td>
                        <td> <?php echo anchor('color/delete/'.$color->id , "DELETE"); ?> </td>
                        <td> <?php echo anchor('color/update/'.$color->id , "Update"); ?> </td>
                    </tr>
                <?php endforeach ?>
            </table>

        </div>
    </div>



</div>