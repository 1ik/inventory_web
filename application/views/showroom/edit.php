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

    .formcontainer{
        padding-left : 50px;
    }
</style>



<div class="row">
    <div class="col-md-4 formcontainer">
        <h3>Edit Showroom</h3>
        <br/>
        <?php echo form_open('showroom/edit/'.$showroom->id, array('type' => 'post' , 'role' => 'form')); ?>

        <div class="form-group">
            <label for="name"> Store Name : </label>
            <input type="text" name="name" class="form-control" value="<?php print $showroom->name; ?>" /> &nbsp
        </div>

        <div class="form-group">
            <label for="email"> Store Location : </label>
            <input type="text" class="form-control" name="location" value="<?php print $showroom->location; ?>" />&nbsp
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-default" value="submit"/>
        </div>
        <?php echo form_close();?>

        <?php echo br(2); ?>
        <?php echo validation_errors(); ?>
    </div>
</div>



