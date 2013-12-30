/**
 * Created with JetBrains PhpStorm.
 * User: Anik
 * Date: 10/16/13
 * Time: 6:50 PM
 * To change this template use File | Settings | File Templates.
 */

$(document).ready(function(){
    $("table").on("click", "span.glyphicon", function(){
        console.log('length : '+ p.entries.length);
        //get the array of entries.
        //tell purchase object to remove this entry by index.
        p.removeEntry($(this).attr('id'));
        //then show the current number of items added.
        $('.text-info').html('Total added : '+ p.numbers);
        //and also remove it from table.
        console.log('length : '+ p.entries.length);
        $(this).parent().parent().remove();
    });

    $("#purchase_add").click(function(){
        var thisbutton = this;
        $(thisbutton).val('Adding purchase ...');
        $(thisbutton).attr('disabled','disabled');

        $.get('create_submit_json' ,{'val' : JSON.stringify(p)} , function(response){
            if(response == 'ok'){
                alert('Purchase Has sucessfully added');
                location.reload();
            }else{
                alert('Purchase adding failed');
            }
            $(thisbutton).removeAttr('disabled');
            $("#purchase_add").val('submit');

        });
        return false;
    });

    $("#designer_style").keyup(function(){
        var val = $(this).val();
        if(val !== ""){
            $.get("../purchase/get_color_code/"+$(this).val() , function (response){
                $('#color_code').val(response);
            });
        }
        
    }); 

});


function purchase(){
    this.entries = new Array();
    this.numbers = 0;
    this.addQuantity = function( val ){
        this.quantity += val;
    };
    this.addEntry = function (e) {
        this.entries.push(e);
        this.numbers += e.quantity;
    }
    this.removeEntry = function(index){
        var object = this.entries[index];
        this.numbers = this.numbers - object.quantity;
        delete this.entries[index];
    }

}

function entry(id,itm_type,size_id,qnty,dsn_style,sell,sup_id,cost,color_code){
    this.id = id;
    this.item_type_id = itm_type;
    this.size_id = size_id;
    this.quantity = qnty;
    this.designer_style = dsn_style;
    this.sell_price = sell;
    this.supplier_id = sup_id;
    this.cost_price = cost;
    this.color_code = color_code;
}


var p  = new purchase();

$('#purchase_submit').on('click' , function(){
    //get all the objects.
    var id = p.entries.length;
    var type = $('#item_type');
    var size = $('#size');
    var quantity = $('#quantity');
    var designer_style = $('#designer_style');
    var sell_price = $("#sell_price");
    var cost_price  = $("#cost_price");
    var supplier = $('#supplier');
    var color_code_field = $('#color_code');


//    alert(type.find(":selected").text());
//    var en = new entry(id,)
    // alert(color_code_field.val());


    var patt1=new RegExp("^[0-9]*$");
    if(!patt1.test(quantity.val())){
        alert('enter valid quanitty number');
    }


    var newentry =
        new entry
            (   id,
                type.find(":selected").val(),
                size.find(":selected").val(),
                parseInt(quantity.val()),
                designer_style.val(),
                sell_price.val(),
                supplier.find(":selected").val(),
                cost_price.val(),
                color_code_field.val()
            );
    p.addEntry(newentry);

    //now create the view;

    var sl = p.entries.length;
    var item_type = type.find(":selected").text();
    var size = size.find(":selected").text();
    var item_num = quantity.val();
    var style = designer_style.val();
    var sell_price = sell_price.val();
    var supplier_name = supplier.find(":selected").text();
    var cost_price = cost_price.val();
    var color_code = color_code_field.val();

    
    var html = '<tr>';
    html += '<td>' + sl +'</td>';
    html += '<td>' + item_type +'</td>';
    html += '<td>' + size +'</td>';
    html += '<td>' + supplier_name +'</td>';
    html += '<td>' + item_num +'</td>';
    html += '<td>' + style +'</td>';
    html += '<td>' + sell_price +'</td>';
    html += '<td>' + cost_price +'</td>';
    html += '<td>' + color_code +'</td>';
    html += '<td > <span id="'+id+'" class="remove glyphicon glyphicon-trash"></span></td>';
    html += '</tr>';
    $(html).appendTo('#purchase_table');
    $('.text-info').html('Total added : '+ p.numbers);
    return false;
});
