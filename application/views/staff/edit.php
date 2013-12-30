
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
        


        <?php echo form_open('staff/edit/'.$staff->id, array('type' => 'post' , 'role' => 'form')); ?>

        <div class="form-group">
            <label for="name"> Staff name : </label>
            <?php echo form_input(array('type' => 'text' , 'name' => 'name', 'class' => 'form-control' , 'value' => $staff->name)); ?>
        </div>

        <div class="form-group">
            <label for="phone"> Phone : </label>
            <?php echo form_input(array('type' => 'text' , 'name' => 'phone' , 'class' => 'form-control' , 'value' => $staff->phone)); ?> <br/>
        </div>


        <div class="form-group">
            <label for="email">email address : </label>
            <?php echo form_input(array('type' => 'text' , 'name' => 'email' , 'class' => 'form-control' , 'value' => $staff->email)); ?>
        </div>


        <div class="form-group">
            <label for="address">address : </label>
            <textarea name="address" class="form-control"> <?php  echo $staff->address ?> </textarea>
        </div>


        <div class="form-group">
            <label for="showroom_id"> select showroom name :    </label><br/>
            <select name="showroom_id" id="showroom" class="form-control" >
                <?php foreach($showrooms as $showroom): ?>
                    <option value="<?php echo $showroom->id ?>"><?php echo $showroom->name ?></option>
                <?php endforeach?>
            </select>
        </div>


        <div class="form-group">
            <input type="submit" class="btn btn-default" value="submit"/>
        </div>
        <?php echo form_close();?>

        <?php echo br(2); ?>
        <?php echo validation_errors(); ?>
    </div>


</div>
