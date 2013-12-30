<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/10/13
 * Time: 11:25 PM
 * To change this template use File | Settings | File Templates.
 */
?>



<div class="row">
    <div class="col-md-10">
        <div class="table table-responsive tableContainer">
            <table class="table-bordered table table-bordered">
                <tr>
                    <th>#  </th>
                    <th>Reason  </th>
                    <th>Showroom name</th>
                    <th>Amount</th>
                    <th>DateTime </th>
                    <th>Explanation </th>
                <tr/>
                <?php if(isset($expenses)): ?>
                    <?php foreach($expenses as $expense): ?>
                        <tr>
                            <td><?php print $expense->id ?></td>
                            <td><?php print $expense->reason ?></td>
                            <td><?php print $expense->showroom_name ?></td>
                            <td><?php print $expense->amount ?></td>
                            <td> 
                                <?php //$dtime = new DateTime($expense->date); print $dtime->format("g:ia \\ l jS F Y"); ?>
                                <?php print date("g:ia \\ l jS F Y" , strtotime($expense->date)); ?>
                            </td>
                            
                            <td><?php print $expense->explanation ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </table>
        </div>
    </div>
</div>