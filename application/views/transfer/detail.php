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
		<p class="mediump">List of items in this transfer </p>
	</div>
</div>

<div class="row">
    <div class="col-md-11 item_table">
    	
        <div class="tabbbleContainer">
            <table class="table table-striped" id="transfer_table">
            	<thead>
	                <tr>
	                    <th>Item Id</th>
						<th>Item Type</th>
						<th>size</th>
						<th>item price</th>
						<th>designer style</th>
						<th>supplier name</th>
						<th>purchase ID</th>
	                </tr>
                </thead>

                <tbody>
						<?php foreach($items as $item): ?>
						<tr>
							<td><?php echo $item->item_id; ?></td>
							<td><?php echo $item->item_type; ?></td>
							<td><?php echo $item->size; ?></td>
							<td><?php echo $item->item_price; ?></td>
							<td><?php echo $item->designer_style; ?></td>
							<td><?php echo $item->supplier_name; ?></td>
							<td><?php echo $item->purchase_id; ?></td>

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

