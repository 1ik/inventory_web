
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



        <?php echo form_open('staff', array('type' => 'post' , 'role' => 'form')); ?>

        <div class="form-group">
            <label for="name"> Staff name : </label>
            <?php echo form_input(array('type' => 'text' , 'name' => 'name', 'class' => 'form-control')); ?>
        </div>


        <div class="form-group">
            <label for="phone"> Phone : </label>
            <?php echo form_input(array('type' => 'text' , 'name' => 'phone' , 'class' => 'form-control')); ?> <br/>
        </div>


        <div class="form-group">
            <label for="email">email address : </label>
            <?php echo form_input(array('type' => 'text' , 'name' => 'email' , 'class' => 'form-control')); ?>
        </div>


        <div class="form-group">
            <label for="address">address : </label>
            <textarea name="address" class="form-control"> <?php  if(isset($_POST['address'])){echo $_POST['address']; } ?> </textarea>
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

    <div class="col-md-8">
        <h4>List of Staffs</h4>

        <div class="table table-responsive">
            <table class="table-bordered table table-bordered">
                <tr>
                    <th>Id  </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>address</th>
                    <th>Showroom Assigned</th>
                    <th>Joined On</th>
                    <th colspan="2"> ACTION</th>
                <tr/>
                <?php foreach($staffs as $staff): ?>
                    <tr>
                        <td><?php echo $staff->id; ?></td>
                        <td><?php echo $staff->name; ?></td>
                        <td><?php echo $staff->email; ?></td>
                        <td><?php echo $staff->phone; ?></td>
                        <td><?php echo $staff->address; ?></td>
                        <td><?php echo $staff->showroom_name; ?></td>
                        <td> <?php print date("g:ia \\ l jS F Y" , strtotime($staff->created_at)); ?> </td>
                        <td><?php echo anchor('staff/edit/'.$staff->id , 'edit');  ?></td>
                        <td><?php echo anchor('staff/delete/'.$staff->id , 'DEL'); ?></td>
                    </tr>
                <?php endforeach ?>
                </tr>


            </table>

        </div>
    </div>

</div>
