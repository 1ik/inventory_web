<?php $this->load->view('includes/header');?>






<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand"><a href="#">Store Administratoin</a></li>
            <li><a href="">Dashboard</a></li>
            <li class="<?php if( isset($active) && $active == 'showroom') print 'active' ?>"> <?php echo anchor('showroom' , 'Showrooms');?> </li>

            <li class="<?php if( isset($active) && $active == 'supplier') print 'active' ?>"> 
                <?php echo anchor('supplier' , 'Suppliers');?> 
            </li>
            

            <li class="<?php if( isset($active) && $active == 'group') print 'active' ?>"> <?php echo anchor('group' , 'Groups');?> 
            </li>

            <li class="<?php if( isset($active) && $active == 'sub_group') print 'active' ?>"> <?php echo anchor('subgroup' , 'Sub Groups');?> </li>

            <li class="<?php if( isset($active) && $active == 'item_type') print 'active' ?>"> 
                <?php echo anchor('item_type' , 'Item Types');?> 
            </li>
            
            <li class="<?php if( isset($active) && $active == 'size') print 'active' ?>"> <?php echo anchor('size' , 'Sizes');?> </li>
            <!-- <li class="<?php //if( isset($active) && $active == 'color') print 'active' ?>"> <?php //echo anchor('color' , 'Colors');?> </li> -->
            <li class="<?php if( isset($active) && $active == 'purchase') print 'active' ?>"> <?php echo anchor('purchase' , 'Purchases');?> </li>
            <li class="<?php if( isset($active) && $active == 'transfer') print 'active' ?>"> <?php echo anchor('transfer' , 'Transfers');?> </li>
            <li class="<?php if( isset($active) && $active == 'sales') print 'active' ?>"> <?php echo anchor('sales' , 'Sales');?> </li>
            <li class="<?php if( isset($active) && $active == 'expense') print 'active' ?>"> <?php echo anchor('expense' , 'Expenses');?> </li>

            <li class="<?php if( isset($active) && $active == 'staff') print 'active' ?>"> <?php echo anchor('staff' , 'Staffs');?> </li>

            <li><a href="#">Items</a></li>

        </ul>
    </div>

    <!-- Page content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-default" role="navigation">
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <a class="navbar-brand" href="#"><?php print $page_name; ?></a>
                <?php if(isset($links)): ?>
                    <ul class="nav navbar-nav">
                        <?php foreach($links as $link):?>
                            <li><?php print $link; ?> </li>
                        <?php endforeach?>
                    </ul>
                <?php endif ?>


                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Log out</a></li>
                </ul>
            </div>
        </nav>


        <?php if($this->session->flashdata('message') != ''): ?>
            <div class="row">
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('message');?>
                </div>
            </div>
        <?php endif ?>
        <?php  $this->load->view($main_content , $vars);?>
    </div>


</div>

<?php $this->load->view('includes/footer');?>