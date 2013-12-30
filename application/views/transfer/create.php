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

    .tabbbleContainer{
        width : 100%;
        height : 350px;
        overflow-y:scroll;
        display: block;
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
                <input type="text" class=" form-control" id="barcode" placeholder="Barcode" />
            </div>
            <a id="confirm" data-toggle="modal" href="#myModal" class="pull-right btn btn-primary disabled "> Adding Complete</a>
        </form>


        <form class="form-inline" role="form" name="barcode_form" id="purchase_id_form" action="#">
            <div class="form-group">
                <label class="sr-only" for="barcode">Barcode</label>
                <input type="text" class=" form-control" style="margin-top : 10px;" id="purchase_id_field" placeholder="Purchase id" />
            </div>            
        </form>

    </div>
</div>

<div class="row">
    <div class="col-md-11 item_table">

        <div class="row">
            <div class="col-md-5">
                <p >Items added :  <span class="added_items">000</span> </p>
            </div>
            <div class="col-md-5">
                <p class="pull-right">Total Price :  <span class="item_price">000</span> </p>
            </div>
        </div>

        <div class="tabbbleContainer">
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
            <a id="bottomOfDiv"></a>
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
                <h4 class="modal-title"> <span id="modal_head">Transfer  <span class="added_items">000</span> items</span> </h4>
            </div>
            <div class="modal-body">
                Select A Showroom Name

                <div class="form-group">
                    <select name="showroom_id" id="showroom" class="form-control" >
                        <?php foreach($showrooms as $showroom): ?>
                            <option value="<?php echo $showroom->id ?>"><?php echo $showroom->name ?></option>
                        <?php endforeach?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button  type="button" class="close_modal btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="transfer_item"> <span id="btn_label">Transfer items</span>  <span id="ajax_loader" class="invisible" ><img  src="<?php echo base_url();?>/assets/img/ajax-loader.gif" /></span> </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/transfer_items.js"></script>