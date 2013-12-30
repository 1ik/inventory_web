


<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/blueprint/grid.css" media="all" />
<style type="text/css">

	.uplabel{
		font-size: 15px;
		margin-left: 10px;
	}


	.bclabel{
		margin-left: 10px;
		font-size: 12px;	
	}



	.price{
		margin-left: 10px;
		font-size: 17px;
	}

	.container{
		font-family: Arial;
	}

	.color_code {
		float: right;
		font-size: 12px;
		
	}

	.iteminfo{
		margin-left: 5px;
		font-size: 10px;
	}

	.designer_style{
		float: right;
		margin-right: 0px;
	}


</style>


<?php $number =1;?>
<?php foreach($items as $item): ?>
		<?php if($number == 1 || $number % 55 == 0 ):?>
		<div class="container">
		<?php endif ?>
			<?php if($number == 1 || $number % 5 == 0 ):?>
			<div class="coloumn">
			<?php endif?>
				<div class="span-4">

					<span class="uplabel" >JHINUK</span><br/>
					<span class="bclabel" > <?php echo $item->item_name; ?> (<?php echo $item->size_name?>) <span class="designer_style"> <?php echo $item->designer_style; ?>  </span></span>

					<?php

					 	$barcode = str_pad($item->id, 12, '0', STR_PAD_LEFT);;
					 ?>
					<img alt="<?php echo $barcode; ?>" src="http://jhinukfashion.com/bc/barcode.php?text=<?php echo $barcode; ?>&size=20" />
					<!--1311000000000005 -->


					<span class="bclabel"><?php echo $barcode ?>  </span><span class="color_code"><?php echo $item->color_code; ?></span> <br/>
					<span class="price" >  TK.<?php echo $item->sell_price." "; ?> Inc.VAT </span>
				</div>

			<?php if($number != 1 && $number % 5 == 0 ):?>
				</div> <!-- coloumn -->
			<?php endif?>
		

		<?php if($number != 1 && $number % 55 == 0 ):?>

		</div> <!-- container -->
			<div style="page-break-after:always"></div>
		<?php endif ?>

		<?php $number++; ?>

<?php endforeach?>
