


<div class="row">

    <div class="col-md-4 formcontainer">



 <?php echo form_open('purchase/create' , array('type' => 'POST' , 'role' => 'form'));?>

        <div class="form-group">

            <label for="supplier_id"> select a supplier name : </label>

            <select name="supplier_id" id="supplier" class="form-control" >

                <?php foreach($suppliers as $supplier): ?>

                    <option value="<?php echo $supplier->id ?>"><?php echo $supplier->name ?></option>

                <?php endforeach?>

            </select>

        </div>



        <div class="form-group">

            <label for="group"> select a Group name : </label>

            <select name="group_id" id="group" class="form-control" >

                <?php foreach($groups as $group): ?>

                    <option value="<?php echo $group->id ?>"><?php echo $group->name ?></option>

                <?php endforeach?>

            </select>

        </div>



        <div class="form-group">

            <label for="sub_group"> select Sub Group name :  <span class='invisible' id="loader_sub_group"> <img src="<?php echo base_url();?>assets/img/transparent-ajax-loader.gif" /> </span>  </label><br/>

            <select name="sub_group_id" id="sub_group" class="form-control" >



            </select>

        </div>



        <div class="form-group">

            <label for="item_type_id"> select Item Type name :  <span class='invisible' id="loader_item_type"> <img src="<?php echo base_url();?>assets/img/transparent-ajax-loader.gif" /> </span>  </label><br/>

            <select name="item_type_id" id="item_type" class="form-control" >



            </select>

        </div>



        <div class="form-group">

            <label for="size_id"> select size :  <span class='invisible' id="loader_size"> <img src="<?php echo base_url();?>assets/img/transparent-ajax-loader.gif" /> </span>  </label><br/>

            <select name="size_id" id="size" class="form-control" >



            </select>

        </div>



        <div class="form-group">

            <label for="quantity">Number of items : </label>

            <input autocomplete="off" class="form-control" type="text" name="quantity" id="quantity" value=""/>

        </div>



        <div class="form-group">

            <label for="size_name">Designer Style Number : </label>

            <input autocomplete="off" class="form-control" type="text" name="designer_style" id="designer_style" value=""/>

        </div>



        <div class="form-group">

            <label for="size_name"> Sell Price : </label>

            <input autocomplete="off" class="form-control" type="text" name="sell_price" id="sell_price" value=""/>

        </div>



        <div class="form-group">

            <label for="size_name">Cost Price : </label>

            <input autocomplete="off" class="form-control" type="text" name="cost_price" value="0" id="cost_price"/>

        </div>


        <!-- PRINTNIG COLORS -->
        <div class="form-group">

            <label for="group"> Enter a Color Code : </label>
            <input autocomplete="off" class="form-control" type="text" name="color_code" value="0" id="color_code"/>


            <!-- <select name="color_id" id="color_id" class="form-control" >

                <?php foreach($colors as $color): ?>

                    <option value="<?php //echo $color->id ?>"><?php //echo $color->color_code ?></option>

                <?php endforeach?>

            </select> -->

        </div>







        <div class="form-group">

            <input id="purchase_submit" class="btn btn-success" type="submit" value="submit" />

        </div>

    </div>



    <div class="col-md-8 ">

        <div class="row">



            <div class="col-md-5">

                Added Items

            </div>

            <div class="col-md-3 pull-right">

                <p class="text-info">Total added : 000</p>

            </div>

        </div>



        <br/>

        <div class="">

            <table class="table table-striped" id="purchase_table">

                <tr>

                    <th># </th>

                    <th>Type </th>

                    <th>Size </th>

                    <th>Supplier </th>

                    <th>Quantity </th>

                    <th>Designer Style </th>

                    <th>Sell Price </th>

                    <th>Cost Price </th>

                    <th>Color code </th>

                    <th>Action </th>

                </tr>



            </table>

            <input type="submit" value="add purchase" class="btn btn-success" id="purchase_add"/>

        </div>





    </div>

</div>



<?php form_close(); ?>

<?php if(validation_errors()): ?>

    <div class="alert alert-danger">

        <?php echo validation_errors();?>

    </div>

<?php endif?>





</div>

</div>







<!--<script type="text/javascript" src="http://localhost/jhinuk_ci/assets/js/purchase_select_scripts.js"> </script>-->

<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/purchase_select_scripts.js"> </script>



<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/purchase_script.js"></script>