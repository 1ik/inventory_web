<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Anik
 * Date: 10/12/13
 * Time: 4:11 PM
 * To change this template use File | Settings | File Templates.
 */

class Migration extends CI_Controller {
    function __construct(){
        parent::__construct();
        logged_in();
    }

    public function seed_all(){
        $this->seed_group();
        $this->seed_subgroups();
        $this->seed_item_type();
        $this->seed_size();
        // $this->seed_color();
        $this->seed_suppliers();
        $this->seed_showrooms();
        $this->seed_purchase();
        $this->seed_expense_type();
        $this->seed_expense();
        $this->seed_staff();
        $this->seed_salary();
    }


    public function seed_showrooms(){
        $showrooms =
            array(
                array('name' => 'Headoffice' , 'location' => 'Location of headoffice'),
                array('name' => 'orkid plaza' , 'location' => 'some address 1'),
                array('name' => 'bashundhora city' , 'location' => 'some address 2' ),
                array('name' => 'mirpur store'  , 'location' => 'some address 3' ),
                array('name' => 'jhinuk star dhamrai' , 'location' => 'some address 4' ),
                array('name' => 'rapa plaza' , 'location' => 'some address 5')
            );
        $this->db->insert_batch('showroom' , $showrooms);
        print 'showroom table seeded';
        print br(2);
    }


    public function seed_group(){
        $groups = array(array('name' => 'men') , array('name' => 'women') , array('name' => 'kid') , array('name' => 'girl'));
        $this->db->insert_batch('group', $groups);
        print 'group table seeded';
        print br(2);
    }


    

    public function seed_subgroups(){
        $sub_groups =
            array(
                array('group_id' => 1 , 'name' => 'panjabi'),
                array('group_id' => 1 , 'name' => 'pant'),
                array('group_id' => 2 , 'name' => 'cap'),
                array('group_id' => 2 , 'name' => 'shari'),
                array('group_id' => 3 , 'name' => 'nima'),
                array('group_id' => 3 , 'name' => 'beef'),
                array('group_id' => 4 , 'name' => 'skirt'),
                array('group_id' => 4 , 'name' => 'jama')
            );
        $this->db->insert_batch('sub_group' , $sub_groups);
        print 'sub_group table seeded';
        print br(2);
    }


    public function seed_item_type(){
        $product_types =
            array(
                array('sub_group_id' => 1 , 'name' => 'red panjabi'),
                array('sub_group_id' => 1 , 'name' => 'blue panjabi'),
                array('sub_group_id' => 2 , 'name' => 'red pant'),
                array('sub_group_id' => 2 , 'name' => 'blue pant'),
                array('sub_group_id' => 3 , 'name' => 'red cap'),
                array('sub_group_id' => 3 , 'name' => 'blue cap'),
                array('sub_group_id' => 4 , 'name' => 'red shari'),
                array('sub_group_id' => 4 , 'name' => 'blue shari'),
                array('sub_group_id' => 5 , 'name' => 'red nima'),
                array('sub_group_id' => 5 , 'name' => 'blue nima'),
                array('sub_group_id' => 6 , 'name' => 'red beef'),
                array('sub_group_id' => 6 , 'name' => 'blue beef'),
                array('sub_group_id' => 7 , 'name' => 'red skirt'),
                array('sub_group_id' => 7 , 'name' => 'blue skirt'),
                array('sub_group_id' => 8 , 'name' => 'red jama'),
                array('sub_group_id' => 8 , 'name' => 'blue jama')
            );
        $this->db->insert_batch('item_type' , $product_types);
        print 'item_type table seeded';
        print br(2);
    }

    public function seed_size(){
        $sizes =
            array(
                array('name' => 'xl' , 'item_type_id' => 1 ),
                array('name' => 'xxl' , 'item_type_id' => 1 ),

                array('name' => 'xdl' , 'item_type_id' => 2 ),
                array('name' => 'x2l' , 'item_type_id' => 2 ),

                array('name' => 'bax' , 'item_type_id' => 3 ),
                array('name' => '33' , 'item_type_id' => 3 ),

                array('name' => 'cdx' , 'item_type_id' => 4 ),
                array('name' => 'vv' , 'item_type_id' =>4 ),

                array('name' => 'exx' , 'item_type_id' => 5 ),
                array('name' => '33' , 'item_type_id' =>5 ),

                array('name' => 'vv' , 'item_type_id' => 6 ),
                array('name' => '33' , 'item_type_id' =>6 ),

                array('name' => 'mki' , 'item_type_id' =>7 ),
                array('name' => '33' , 'item_type_id' =>7 ),

                array('name' => '33' , 'item_type_id' =>8 ),
                array('name' => 'aab' , 'item_type_id' =>8 ),

                array('name' => 'xl' , 'item_type_id' => 9 ),
                array('name' => 'xxl' , 'item_type_id' => 9 ),

                array('name' => 'xdl' , 'item_type_id' => 10 ),
                array('name' => 'x2l' , 'item_type_id' => 10 ),

                array('name' => 'bax' , 'item_type_id' => 11 ),
                array('name' => '33' , 'item_type_id' => 11 ),

                array('name' => 'cdx' , 'item_type_id' => 12 ),
                array('name' => 'vv' , 'item_type_id' =>12 ),

                array('name' => 'exx' , 'item_type_id' => 13 ),
                array('name' => '33' , 'item_type_id' =>13 ),

                array('name' => 'vv' , 'item_type_id' => 14 ),
                array('name' => '33' , 'item_type_id' =>14 ),

                array('name' => 'mki' , 'item_type_id' =>15 ),
                array('name' => '33' , 'item_type_id' =>15 ),

                array('name' => '33' , 'item_type_id' =>16 ),
                array('name' => 'aab' , 'item_type_id' =>16 )
            );

        $this->db->insert_batch('size' , $sizes);
        print 'size table seeded';
        print br(3);
    }

    /*
    public function seed_color(){
        $colors = 
            array(
                array('color_code' => 'A' , 'description' => 'Light Green'),
                array('color_code' => 'B' , 'description' => 'Yellow Green'),
                array('color_code' => 'C' , 'description' => 'Deep Green'),
                array('color_code' => 'D' , 'description' => 'Deep Red')
            );
        $this->db->insert_batch('color' , $colors);
        print 'color table seeded';
        print br(3);
    }
    */


    public function seed_suppliers(){
        $suppliers =
            array(
                array('name' => 'mannan' , 'email' => 'mannan@yahoo.com' , 'cell_no' => '02993344' , 'address' => 'purana paltan , Dhaka'),
                array('name' => 'kamal' , 'email' => 'kamal@yahoo.com' , 'cell_no' => '33242452' , 'address' => 'noya paltan , Dhaka'),
                array('name' => 'jamal' , 'email' => 'jamal@yahoo.com' , 'cell_no' => '02993344' , 'address' => 'Mohakhali , Dhaka'),
                array('name' => 'kibria' , 'email' => 'kibria@yahoo.com' , 'cell_no' => '23234234' , 'address' => 'DHanmondi  , Dhaka'),
                array('name' => 'borkot' , 'email' => 'borkot@yahoo.com' , 'cell_no' => '4577456' , 'address' => 'Motijhil , Dhaka')
            );
        $this->db->insert_batch('supplier' , $suppliers);
        print 'supplier table seeded';
        print br(2);
    }




    public function seed_purchase(){
        $date = new DateTime();

        $supplier_id = 2;
        $item_type_id = 3;
        $color_id = 2;
        $designer_style = '33dd3';
        $this->db->insert('purchase' , array('id' => 'NULL' , 'created_at' => $date->format('Y-m-d H:i:s') ));
        $purchase_id = $this->db->insert_id();

        $date = new DateTime();
        $items =
            array(
                array( 'purchase_id' => $purchase_id, 'size_id' => 5 , 'supplier_id' => $supplier_id ,
                 'sell_price' => 320, 'cost_price' => 0, 'designer_style' => '32ab',  'quantity' => 50 , 'created_at' => $date->format('Y-m-d H:i:s')),
                array( 'purchase_id' => $purchase_id, 'size_id' => 13 , 'supplier_id' => $supplier_id , 
                    'cost_price' => 0, 'sell_price' => 300.0, 'designer_style' => 'bba32',  'quantity' => 70, 'created_at' => $date->format('Y-m-d H:i:s'))
            );

        $data = array();
        foreach($items as $item){
            for($i=0; $i< $item['quantity']; $i++){

                $data []  = array('size_id' => $item['size_id'], 'purchase_id' => $purchase_id ,'supplier_id' => $item['supplier_id'], 'designer_style' => $item['designer_style'] , 'cost_price' => $item['cost_price'] , 'sell_price' => $item['sell_price'] , 'created_at' => $item['created_at']  , 'showroom_id' => 1 , 'color_code' => 'A');
            }
        }
        $this->db->insert_batch('item' , $data);
        print 'purchase table seeded';
        print br(2);
    }



    public function seed_expense_type(){
         $reasons =
            array(
                array('reason' => 'other'),
                array('reason' => 'utility bill'),
                array('reason' => 'store bill'),
                array('reason' => 'money withdraw'),
                array('reason' => 'mp sir')
            );
        $this->db->insert_batch('expense_type' , $reasons);
        print 'expense type table seeded';
        print br(2);
    }



    public function seed_expense(){
        
        
        $date = new DateTime();

        $expenses =
            array(
                array( 'created_at' => $date->format('Y-m-d H:i:s'), 'amount' => 100 , 'explanation' => 'no explanation' , 'showroom_id' => 2, 'expense_type_id' => 2),
                array( 'created_at' => $date->format('Y-m-d H:i:s'), 'amount' => 300 , 'explanation' => 'no explanation' , 'showroom_id' => 3, 'expense_type_id' => 2),
                array('created_at' => $date->format('Y-m-d H:i:s'),'amount' => 200 , 'explanation' => 'no explanation' , 'showroom_id' => 4, 'expense_type_id' => 2),
                array( 'created_at' => $date->format('Y-m-d H:i:s'), 'amount' => 600 , 'explanation' => 'no explanation' , 'showroom_id' => 5, 'expense_type_id' => 2),
                array( 'created_at' => $date->format('Y-m-d H:i:s'), 'amount' => 600 , 'explanation' => 'no explanation' , 'showroom_id' => 6, 'expense_type_id' => 2),

                array('created_at' => $date->format('Y-m-d H:i:s'),'amount' => 200 , 'explanation' => 'mastaner chada' , 'showroom_id' => 2, 'expense_type_id' => 1),
                array('created_at' => $date->format('Y-m-d H:i:s'),'amount' => 600 , 'explanation' => 'shingara cha puri' , 'showroom_id' => 3, 'expense_type_id' => 1),
                array('created_at' => $date->format('Y-m-d H:i:s'),'amount' => 400 , 'explanation' => 'store er light kena holo' , 'showroom_id' => 4, 'expense_type_id' => 1),
                array( 'created_at' => $date->format('Y-m-d H:i:s'), 'amount' => 100 , 'explanation' => 'store rong korano' , 'showroom_id' => 5, 'expense_type_id' => 1),
                array( 'created_at' => $date->format('Y-m-d H:i:s'),  'amount' => 40 , 'explanation' => 'showroom purpose' , 'showroom_id' => 6, 'expense_type_id' => 1)
            );

        $this->db->insert_batch('expense' , $expenses);
        print 'expense table seeded '.br(3);
    }

    public  function seed_staff(){
        $date = new DateTime();
        $data['created_at'] =  $date->format('Y-m-d H:i:s');

        $staffs =
            array(
                array('name' => 'mobarok' , 'phone' => '332323' , 'email' => 'sd@gm.com' ,'showroom_id' => 2 , 'address' => 'kadom tola' , 'created_at' => $date->format('Y-m-d H:i:s')),
                array('name' => 'salim' , 'phone' => '332323' , 'email' => 'salim@gm.com' ,'showroom_id' => 2 , 'address' => 'salim tola' , 'created_at' => $date->format('Y-m-d H:i:s')),
                array('name' => 'hasdak' , 'phone' => '3322' , 'email' => 'sdsd@asdgm.com' ,'showroom_id' => 3 , 'address' => 'jam tola'  , 'created_at' => $date->format('Y-m-d H:i:s') ),
                array('name' => 'kader' , 'phone' => '44566' , 'email' => 'vasd@gm.com' ,'showroom_id' => 4 , 'address' => 'tetul tola' , 'created_at' => $date->format('Y-m-d H:i:s')),
                array('name' => 'rafiq' , 'phone' => '55666' , 'email' => 'sssd@gm.com' ,'showroom_id' => 5 , 'address' => 'kochu tola' , 'created_at' => $date->format('Y-m-d H:i:s')),
                array('name' => 'barkot' , 'phone' => '232556' , 'email' => 'sdsdf@gm.com' ,'showroom_id' => 6 , 'address' => 'kathal tola' , 'created_at' => $date->format('Y-m-d H:i:s'))
            );
        $this->db->insert_batch('staff' , $staffs);
        print 'staff table seeded';
        print br(3);
    }


    public function seed_salary(){
        $date = new DateTime();
        $data =
            array(
                array('amount' => 2000, 'showroom_id' => 2 , 'staff_id' => 1 , 'created_at' => $date->format('Y-m-d H:i:s')),
                array('amount' => 2000, 'showroom_id' => 2 , 'staff_id' => 1 , 'created_at' => $date->format('Y-m-d H:i:s')),
                array('amount' => 3000, 'showroom_id' => 3 , 'staff_id' => 3 , 'created_at' => $date->format('Y-m-d H:i:s'))
            );
        $this->db->insert_batch('salary' , $data);
        print 'salary table seeded';
        print br(3);
    }



}
