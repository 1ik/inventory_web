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
        <?php echo form_open('group', array('type' => 'post' , 'role' => 'form')); ?>

            <div class="form-group">
                <label for="name"> Group name : </label>
                <?php echo form_input(array('type' => 'text' , 'name' => 'name', 'class' => 'form-control' , 'autocomplete' => 'off')); ?>
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
            <p>Groups : </p>
            <table class="table-bordered table table-bordered">
                <tr>
                    <th>Id  </th>
                    <th>Name  </th>
                    <th colspan="2"> ACTION</th>
                <tr/>
                <?php foreach($groups as $group): ?>
                    <tr>
                        <td> <?php print $group->id; ?></td>
                        <td> <?php print $group->name; ?></td>
                        <td> <?php echo anchor('group/delete/'.$group->id , "DELETE"); ?> </td>
                        <td> <?php echo anchor('group/update/'.$group->id , "Update"); ?> </td>
                    </tr>
                <?php endforeach ?>
            </table>

        </div>
    </div>



</div>