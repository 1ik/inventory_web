
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



        <?php echo form_open('supplier', array('type' => 'post' , 'role' => 'form')); ?>

        <div class="form-group">
            <label for="supplier_name"> Supplier name : </label>
            <?php echo form_input(array('type' => 'text' , 'name' => 'supplier_name', 'class' => 'form-control')); ?>
        </div>


        <div class="form-group">
            <label for="supplier_phone"> Supplier Phone : </label>
            <?php echo form_input(array('type' => 'text' , 'name' => 'supplier_phone' , 'class' => 'form-control')); ?> <br/>
        </div>


        <div class="form-group">
            <label for="supplier_email"> Supplier email : </label>
            <?php echo form_input(array('type' => 'text' , 'name' => 'supplier_email' , 'class' => 'form-control')); ?>
        </div>




        <div class="form-group">
            <label for="supplier_address"> supplier address : </label>
            <textarea name="supplier_address" class="form-control"> <?php  if(isset($input['supplier_address'])){echo $input['supplier_address']; } ?> </textarea>
        </div>


        <div class="form-group">
            <input type="submit" class="btn btn-default" value="submit"/>
        </div>
        <?php echo form_close();?>

        <?php echo br(2); ?>
        <?php echo validation_errors(); ?>
    </div>

    <div class="col-md-8">
        <h4>List of Suppliers</h4>

        <div class="table table-responsive">
            <table class="table-bordered table table-bordered">
                <tr>
                    <th>Id  </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>addres</th>

                    <th colspan="2"> ACTION</th>
                <tr/>
                <?php foreach($suppliers as $supplier): ?>
                    <tr>
                        <td><?php echo $supplier->name; ?></td>
                        <td><?php echo $supplier->email; ?></td>
                        <td><?php echo $supplier->cell_no; ?></td>
                        <td><?php echo $supplier->address; ?></td>
                        <td><?php echo anchor('supplier/edit/'.$supplier->id , 'edit');  ?></td>
                        <td><?php echo anchor('supplier/delete/'.$supplier->id , 'DEL'); ?></td>
                    </tr>
                <?php endforeach ?>
                </tr>


            </table>

        </div>
    </div>



</div>
