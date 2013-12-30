<?php //var_dump($purchase_detail); ?>

<div class="row">


 <div class="col-md-11" style="margin-left : 30px">

        <div class="row">

            <div class="col-md-5">
                Added Items
            </div>

            <div class="col-md-3 pull-right">
            	<?php if(count($purchase_details) > 0):  ?>
            		<?php $first_purchase = $purchase_details[0]; ?>
            		<p class="mediump">Purchase Date : <?php echo date_format(new DateTime($first_purchase->created_at) , 'd/m/Y'); ?> </p>
            	<?php endif ?>
            </div>
        </div>



        <br/>

        <div class="">

            <table class="table table-striped" id="purchase_table">
                <tr>

                    <th>Type </th>

                    <th>Size </th>

                    <th>Supplier </th>

                    <th>Quantity </th>

                    <th>Designer Style </th>

                    <th>Sell Price </th>

                    <th>Cost Price </th>
                    <th>Color code </th>
                </tr>

                <tbody>
                	<?php foreach($purchase_details as $detail): ?>
                		<tr>
                			<td> <?php echo $detail->type; ?> </td>
                			<td> <?php echo $detail->size_name; ?> </td>
                			<td> <?php echo $detail->supplier_name; ?> </td>
                			<td> <?php echo $detail->quantity; ?> </td>
                			<td> <?php echo $detail->designer_style; ?> </td>
                			<td> <?php echo $detail->sell_price; ?> </td>
                			<td> <?php echo $detail->cost_price; ?> </td>
                            <td> <?php echo $detail->color_code; ?> </td>
                		</tr>
                	<?php endforeach?>
                </tbody>

            </table>

        </div>





    </div>

</div>
</div>