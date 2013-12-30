<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/12/13
 * Time: 10:32 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<style type="text/css">
    .outlets tr td , .outlets tr th{
        padding-left : 50px;

    }

    .store_form{
        padding : 50px;
    }
</style>

    <div class="row">
        <div class="col-md-4 store_form">
            <?php echo form_open('showroom' , array('method' => 'post' , 'role' => 'form')); ?>

                <div class="form-group">
                    <label for="name"> Store Name : </label>
                    <input type="text" 
                    name="name" class="form-control" value="<?php if(isset($_POST['name'])) print $_POST['name']; ?>" />
                </div>

                <div class="form-group">
                    <label for="location"> Store Location : </label>
                    <input type="text" class="form-control" 
                    name="location" value="<?php if(isset($_POST['location'])) print  $_POST['location']; ?>" />
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-default" value="submit"/>
               </div>

            <?php echo form_close(); ?>

            <?php print validation_errors(); ?>
        </div>


        <div class="col-md-8">
            <div class="table table-responsive">
                <table class="table-bordered table table-bordered">
                    <tr>
                        <th>Id  </th>
                        <th>Name  </th>
                        <th>Location</th>
                        <th>CASH AVAILABLE</th>
                        <th colspan="2"> ACTION</th>
                    <tr/>
                    <?php foreach($showrooms as $showroom): ?>
                        <tr>
                            <td> <?php print $showroom->id; ?></td>
                            <td> <?php print $showroom->name; ?></td>
                            <td> <?php print $showroom->location; ?></td>
                            <td> <?php print "cash will be added later"; ?></td>
                            <td> <?php echo anchor('showroom/delete/'.$showroom->id , "DELETE"); ?> </td>
                            <td> <?php echo anchor('showroom/edit/'.$showroom->id , "Edit"); ?> </td>
                        </tr>
                    <?php endforeach ?>
                </table>

            </div>
        </div>

    </div>