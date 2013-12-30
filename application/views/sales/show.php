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
    <div class="col-md-11">
        <div class="pull-right">
            <form class="form-inline" role="form" action="<?php echo base_url();?>sales/index/" method="get" >

                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail2">Email address</label>
                    <input type="date" class="form-control date" id="from" placeholder="To" name="date" />
                </div>

                <div class="form-group">
                    <label for="showroom_id"> select showroom name :    </label><br/>
                    <select name="showroom_id" id="showroom" class="form-control" >
                        <?php foreach ($showrooms as $showroom): ?>
                        <option value="<?php echo $showroom->id ?>"><?php echo $showroom->name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>


                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value ="see" />
                </div>
            </form>
        </div>
    </div>


<div class="row">
	<?php if(isset($items[0])) : ?>
	
	<div class="col-md-11 item_table">
		<h3>Date : <?php echo date_format(new DateTime($items[0]->sold_on) , "d-m-Y");?></h3>
	</div>

    <div class="col-md-11 item_table">
        <div class="tabbbleContainer">
            <table class="table table-striped" id="transfer_table">
            	<thead>
	                <tr>
	                    	<th>Item name</th>
							<th>size</th>
							<th>price</th>
							<th>sold on</th>
	                </tr>
                </thead>

                <tbody>
					<?php foreach($items as $item): ?>
						<tr>
							<td><?php echo $item->item_name; ?></td>
							<td><?php echo $item->item_size; ?></td>
							<td><?php echo $item->item_price; ?></td>
							<td><?php echo date_format(new DateTime($item->sold_on) , "h:i:s"); ?></td>
						</tr>
					<?php endforeach?>
				</tbody>
            </table>
            <a id="bottomOfDiv"></a>
        </div>

    </div>

	<?php endif ?>
</div>


</div>


