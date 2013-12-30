<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/11/13
 * Time: 9:37 AM
 * To change this template use File | Settings | File Templates.
 */
?>

<style type='text/css' >
.invisible{
    display : none;
}
</style>


<div class="row">
    <div class="col-md-4 formcontainer">
    <?php echo form_open('item_type' , array('type' => 'POST' , 'role' => 'form'));?>

        <div class="form-group">
            <label for="name">Enter Item Type name to add one</label> <br/><br/>
            <input autocomplete='off' class="form-control" type="text" name="name" value="<?php if(isset($_POST['name'])) print $_POST['name']; ?>"/> <br/><br/>
        </div>

        <div class="form-group">
            <label for="group"> select a group name :    </label><br/>
            <select name="group" id="group" class="form-control" >
                <?php foreach($groups as $group): ?>
                    <option value="<?php echo $group->id ?>"><?php echo $group->name ?></option>
                <?php endforeach?>
            </select>
        </div>


        <div class="form-group">
            <label for="sub_group"> select a sub group name : 
                <span id="loader_sub_group" class ="invisible" > <img src="assets/img/transparent-ajax-loader.gif" /> </span>   </label><br/>
            <select name="sub_group" id="sub_group" class="form-control" >

            </select>
        </div>

        <div class="form-group">
            <input class="btn btn-default" type="submit" value="submit" />
        </div>
        <?php echo validation_errors();?>


    </div>

    <div class="col-md-8 pull-left">

        

        <div class="col-md-5">
            <p>subgroup list : 
                <span id="loader_item_type" class ="invisible" > <img src="assets/img/transparent-ajax-loader.gif" /> </span></p>
            <table class="table">

            </table>
        </div>


    </div>
</div>

<?php form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="assets/js/item_type.js"></script>