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
    <?php echo form_open('subgroup' , array('type' => 'POST' , 'role' => 'form'));?>

        <div class="form-group">
            <label for="sub_group_name">Enter subgroup name to add one</label> <br/><br/>
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
            <input class="btn btn-default" type="submit" value="submit" />
        </div>
        <?php echo validation_errors();?>


    </div>

    <div class="col-md-8 pull-left">

        

        <div class="col-md-5">
            <p>subgroup list : <span id="loader" class ="invisible" > <img src="assets/img/transparent-ajax-loader.gif" /> </span></p>
            <table class="table">

            </table>
        </div>


    </div>
</div>

<?php form_close(); ?>
    </div>
</div>


<script type='text/javascript' src="http://code.jquery.com/jquery-latest.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        //take the first item from the group selected ans show its subgruop.
        var firstGroup = $("#group option:first").val();
        show_sub_groups(firstGroup);
    });

    $( "#group" ).change(function() {
        show_sub_groups($(this).val());
    });

    function show_sub_groups($group_id){
        $('#loader').removeClass('invisible');
        $.ajax({
            type: 'GET',
            url: 'subgroup/get_sub_groups_json/'+$group_id,
            success: function(data){
                $('#loader').addClass('invisible');
                var subgrps = jQuery.parseJSON(data);
                var html= '<tr><th>Subgroup name </th> <th> ACTION</th><tr>';
                for(i=0; i<subgrps.length; i++){
                    var subgrp = subgrps[i];
                    var delurl = 'subgroup/delete/'+subgrp.id;
                    var dellink = '<a class="btn btn-sm btn-danger" href="'   + delurl+'"> DELETE </a>';
                    html += '<tr class="success"><td>'+subgrp.name  + "</td><td>" +  dellink + '</td></tr>';
                }
                $('.table').html(html);
            },
            error: function(xhr, type, exception) {
                alert("ajax error response type "+type);
            }
        });
    }
</script>
