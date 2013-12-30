<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/16/13
 * Time: 6:40 PM
 * To change this template use File | Settings | File Templates.
 */

?>
<style type="text/css" media="screen">
	.container{
		margin-top: 10px;
	}
</style>


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











<div class="row container" style="">
	<div class="col-md-6">
		<p class="mediump">List of Purchase </p>
	</div>
	<div class="col-md-6">
		<div class="pull-right">
			<form class="form-inline" role="form" action="<?php echo base_url();?>purchase/" method="post" >
				<div class="form-group">
					<label class="sr-only" for="from_date">Email address</label>
					<input type="date" class="form-control date" id="to" placeholder="From" name="from_date">
				</div>

				<div class="form-group">
					<label class="sr-only" for="exampleInputEmail2">Email address</label>
					<input type="date" class="form-control date" id="from" placeholder="To" name="to_date">
				</div>
				<input type="submit" class="btn btn-primary" value ="see" />
			</form>


		</div>


	</div>
</div>





<div class="row">
    <div class="col-md-11 item_table">
    	
        <div class="tabbbleContainer">
            <table class="table table-striped" id="transfer_table">
            	<thead>
	                <tr>
	                    <th>Purchase Id</th>
						<th>Purchase Date</th>
						<th>Total Number of Items</th>
						<th>#</th>
	                </tr>
                </thead>

                <tbody>
						<?php foreach($purchases as $purchase): ?>
						<tr>
							<td><?php echo $purchase->purchase_id; ?></td>
							<td><?php echo date_format(new DateTime($purchase->purchase_date) , "d-m-Y"); ?></td>
							
							<td><?php echo $purchase->number_of_items; ?></td>
							<td><?php echo anchor('purchase/detail/'.$purchase->purchase_id, 'view detail'); ?></td>
							<td><?php echo anchor('purchase/print_barcode/'.$purchase->purchase_id, 'get barcodes' , array('target' => 'blank')); ?></td>
						</tr>
					<?php endforeach?>
				</tbody>





            </table>
            <a id="bottomOfDiv"></a>
        </div>

    </div>
</div>





	
</div>

</div>
