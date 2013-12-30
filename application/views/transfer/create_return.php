<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/11/13
 * Time: 2:18 PM
 * To change this template use File | Settings | File Templates.
 */
?>
<style type="text/css">
    .item_table{
        margin-left: 5%;
        margin-top : 5%;
    }
    .item_table p{
        font-weight: 600;
        font-size: 20px;
    }
    .formcontainer{
        margin-left: 2%;
    }
    .remove{
        cursor: pointer;
    }

    .invisible{
        display : none;
    }

    .page_title{
        text-align: center;
    }

    .page_title p{
        font-weight: 600;
        font-size: 20px;
        margin-top : 20px;
    }
    #showroom_name{
        color : red;
    }


    .visible{
        display : block;
        display : inline;
    }
    
    .loader_visible{
        background-image:url('<?php echo base_url(); ?>assets/img/transparent-ajax-loader.gif');
        background-position: 95%;
        background-repeat: no-repeat;
    }

</style>


<div class="row">
    <div class="col-md-11 formcontainer">

        <form class="form-inline" role="form" name="barcode_form" id="barcode_form" action="#">
            <div class="form-group">
                <label class="sr-only" for="barcode">Barcode</label>
                <input type="text" class=" form-control" id="barcode" placeholder="Barcode">
            </div>

            <a id="confirm" data-toggle="modal" href="#notify" class="pull-right btn btn-primary disabled "> Adding Complete</a>

        </form>
    </div>
</div>

<div class="row">
    <div class="page_title">
        <p>Transfer Items from <span id = "showroom_name"> Mirpur Office </span> to Headoffice </p>
    </div>
</div>

<div class="row">
    <div class="col-md-11 item_table">

        <p>Items added :  <span class="added_items">000</span> </p>


        <div class="">
            <table class="table table-striped" id="transfer_table">
                <tr>
                    <th># </th>
                    <th>Type </th>
                    <th>Size </th>
                    <th>Supplier </th>
                    <th>Designer Style </th>
                    <th>Sell Price </th>
                    <th>Purchase ID </th>
                    <th>Current Location </th>
                    <th>Action </th>
                </tr>

            </table>
        </div>

    </div>
</div>



<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_modal" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> <span id="modal_head">Transfer items to HeadOffice</span> </h4>
            </div>
            <div class="modal-body">
                Select Showroom Name To Transfer item to Headoffice.

                <div class="form-group">
                    <select name="showroom_id" id="showroom" class="form-control" >

                        <?php foreach($showrooms as $showroom): ?>
                            <?php if($showroom->id != 1): ?>
                                <option value="<?php echo $showroom->id ?>"><?php echo $showroom->name ?></option>
                            <?php endif ?>
                        <?php endforeach?>
                    </select>
                </div>
            </div>

            <div class="modal-footer">

                <button type="button" id="showroom_choice" class="btn btn-primary" data-dismiss="modal">Ok</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->






<!-- Modal -->
<div class="modal fade" id="notify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close_modal" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> <span id="modal_head">Transfer items to HeadOffice</span> </h4>
            </div>
            <div class="modal-body">
                <div class = "page_title">
                    <p><img src="<?php echo base_url();?>assets/img/arrow-loader.gif">
                        Returning <span class="added_items">000</span> items to Headoffice </p>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/return_items.js"></script>