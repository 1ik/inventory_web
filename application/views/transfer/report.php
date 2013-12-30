<?php 
	 //var_dump($items);
	$from = "";
	$to = "";
	if(count($items) > 0) {
		$from = $items[0]['source'];
		$to = $items[0]['destination'];
	}
 ?>


 <html>
 <head>
 	<title></title>
 	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,600,800,700,300' rel='stylesheet' type='text/css'>

 	<style type="text/css" media="all">
 		.heading{
 			text-align: center;
 			width: 100%;
 			margin : 0 auto;
 		}
 		h1,h2,h3,h4,p,h5,h6{
 			font-family: 'Open Sans', sans-serif;
 		}

 		.heading h1{
 			font-size: 45px;
 		}

 		table th, td{
 			font-family: 'Open Sans', sans-serif;
 			margin : 5px;
 			padding : 5px 30px 5px 30px;
 			margin-left : 20px;
 		}
 		table tr, th , td{
 			border : 2px solid black;
 		}

 		table{
 			width : 100%;
 			margin : 0 auto;
 			margin-top : 50px;
 			text-align: center;
 		}

 		.signature{
 			margin-top : 800px;
 		}

 		.mainContent{
 			height: 1370px;
 		}

 		.debug{
 			border  :2px dotted green;
 		}
 		

 	</style>
 	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/blueprint/grid.css" media="all" />
 </head>
 <body>

 	<div class="container mainContent">
 		<div class="heading">
 			<h1>Jhinuk Fashion</h1>
 			<h3>Items Transfer Report</h3>
 			<h4><?php echo $from; ?> To  <?php echo $to; ?></h4>
 			<?php $date = new DateTime();?>
 			<h5><?php echo $date->format('Y-m-d H:i:s'); ?></h5>
 		</div>

 		<div class="container">
 			<table>
 				<tr>
 					<th>Type</th><th>Size</th><th>Designer style number</th> <th>Color </th> <th>Quantity</th> <th>Price</th><th>Total Price</th>
 				</tr>
 				<?php $total_price = 00; ?>
 				<?php $total_quantity = 0; ?>
 				<?php foreach ($items as $item): ?>
 				<tr>
 					<td><?php echo $item['item_type']?></td>
 					<td><?php echo $item['size']?></td>
 					<td><?php echo $item['designer_style']?></td>
 					<td><?php echo $item['color']?></td>
 					<td><?php echo $item['quantity']?></td>
 					<td><?php echo $item['item_price']?></td>
 					<td><?php echo $item['amount']?></td>
 					<?php $total_price += $item['amount']; ?>
 					<?php $total_quantity += $item['quantity']; ?>
 				</tr>

 				<?php endforeach; ?>
 				<tr>
 					<td></td>
 					<td></td>
 					<td></td>
 					<td></td>
 					<td><?php echo $total_quantity; ?></td>
 					<td></td>
 					<td><?php echo $total_price; ?></td>
 				</tr>

 			</table>
 		</div>
 		<div class="signature">

 				<h3>Authorized Signature</h3>
 				<p>Cell : 01922334455</p>
 			</div>
 	</div>


 
 </body>
 </html>
