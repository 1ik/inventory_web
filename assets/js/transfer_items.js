/**
 * Created with JetBrains PhpStorm.
 * User: Anik
 * Date: 10/18/13
 * Time: 1:40 PM
 * To change this template use File | Settings | File Templates.
 */


function Transfer(){
    this.showroom_id = '';
    this.items = new Array();
    this.item_price = new Array();
    this.total_added = 0;
    this.total_price = 0;

    this.addItem = function (id,price) {
        this.items.push(id);
        this.item_price.push(price);
        this.total_price += parseFloat(price);
        this.total_added += 1;
    }

    this.removeEntry = function(index){
        delete this.items[index];
        this.total_price -= this.item_price[index];
        delete this.item_price[index];
        this.total_added -= 1;
        $('.item_price').html(t.total_price);
    }
}

var t = new Transfer();


$(document).ready(function(){

    $('#purchase_id_form').on('submit' , function(){
        var purchase_field_obj = $('#purchase_id_field');
        purchase_field_obj.addClass('loader_visible');

        var purchase_id = purchase_field_obj.val();
        $.get("../items/get_items_by_purchase_id/"+purchase_id , function(json_response){

            purchase_field_obj.removeClass('loader_visible');
            var items = jQuery.parseJSON(json_response);

            var html ='';
            if(items.length > 0){
                var confirm = $('#confirm');
                    if(confirm.hasClass('disabled')){
                        confirm.removeClass('disabled');
                }
            }


            for (var i=0; i<items.length; i++){
                var item = items[i];
                t.addItem(item.id,item.sell_price);

                var index = t.items.length-1;
                var row = '<tr>';
                row += '<td>' + item.id +'</td>';
                row += '<td>' + item.item_type +'</td>';
                row += '<td>' + item.size +'</td>';
                row += '<td>' + item.supplier +'</td>';
                row += '<td>' + item.designer_style +'</td>';
                row += '<td>' + item.sell_price +'</td>';
                row += '<td>' + item.purchase_id +'</td>';
                row += '<td>' + item.current_location +'</td>';
                row += '<td > <span id="'+index+'" class="remove glyphicon glyphicon-trash"></span></td>';
                row += '</tr>';
                html += row;
            }

            $(html).appendTo('#transfer_table');
            purchase_field_obj.val('');
            $('.added_items').html(t.total_added);
            $('.item_price').html(t.total_price);
            
            document.getElementById('bottomOfDiv').scrollIntoView(true);
            //console.log(json_response);
        });

    });



    $('#barcode_form').on('submit' , function() {
        var barCodeField = $('#barcode');
        barCodeField.addClass('loader_visible');

        var barcode = barCodeField.val();
        $.get('../items/get_items_json/'+barcode , function(json_response){
            barCodeField.removeClass('loader_visible');
            $item = jQuery.parseJSON(json_response);


            if($item == null){
                alert('item not found');
            }else{

                var confirm = $('#confirm');
                if(confirm.hasClass('disabled')){
                    confirm.removeClass('disabled');
                }
                // alert ($item.sell_price);
                t.addItem($item.id,$item.sell_price);
                var index = t.items.length-1;
                var html = '<tr>';
                html += '<td>' + $item.id +'</td>';
                html += '<td>' + $item.item_type +'</td>';
                html += '<td>' + $item.size +'</td>';
                html += '<td>' + $item.supplier +'</td>';
                html += '<td>' + $item.designer_style +'</td>';
                html += '<td>' + $item.sell_price +'</td>';
                html += '<td>' + $item.purchase_id +'</td>';
                html += '<td>' + $item.current_location +'</td>';
                html += '<td > <span id="'+index+'" class="remove glyphicon glyphicon-trash"></span></td>';
                html += '</tr>';
                $(html).appendTo('#transfer_table');
                barCodeField.val('');
                $('.added_items').html(t.total_added);
                $('.item_price').html(t.total_price);
                document.getElementById('bottomOfDiv').scrollIntoView(true);
            }
        });
        return false;
    });


    $("table").on("click", "span.glyphicon", function(){
        t.removeEntry($(this).attr('id'));
        $('.added_items').html(t.total_added);
        $(this).parent().parent().remove();
        if(t.total_added <= 0){
            $('#confirm').addClass('disabled');
        }
    });


    $('#transfer_item').click(function(){
        var thisbutton = this;
        t.showroom_id = $('#showroom').val();
        $('#btn_label').html('Transferring');
        $('#ajax_loader').removeClass('invisible').addClass('visible');

        var data = { showroom_id : t.showroom_id, items : t.items};

        $.post('create_submit_json' ,{'val' : JSON.stringify(data)} , function(response){
            
            $('#ajax_loader').removeClass('visible').addClass('invisible');
            $('#ajax_loader').removeClass('invisible').addClass('visible');
            $('#myModal').modal('hide');
            if(response == 'ok'){

                
                
                $('#btn_label').html('Transferred successfully');

                $('#myModal').on('hidden.bs.modal', function () {
                    alert('Transfer has been done successfully ');
                    location.reload();
                });

            }else{
                $('#btn_label').html('Transferred failed');

                $('#myModal').on('hidden.bs.modal', function () {
                    location.reload();
                });
            }
        });
    });

    $('.close_modal').click(function(){
        $('#btn_label').html('Transfer');
        $('#ajax_loader').removeClass('visible').addClass('invisible');
    });

});






