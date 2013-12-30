$(document).ready(function() {
	$('#myModal').modal('show');

	$('#myModal').on('hidden.bs.modal', function () {
		//when the modal is closed, we bind a callback where we'll get the slected showroom id.

		//cache the showroomobject.
		var showroom_obj = $('#showroom option:selected');

		//modal is closed, means showroom's been chosen. pick the selected showroom name and add to the Return object.
		ret.from_showroom_id = showroom_obj.val();
		$('#showroom_name').html(showroom_obj.text()); 

	});

	$("table").on("click", "span.glyphicon", function(){
        ret.removeEntry($(this).attr('id'));
        $('.added_items').html(ret.total_added);
        $(this).parent().parent().remove();
        if(ret.total_added <= 0){
            $('#confirm').addClass('disabled');
        }
    });



	 $('#barcode_form').on('submit' , function() {
	 	var barCodeField = $('#barcode');
        barCodeField.addClass('loader_visible');

        var barcode = barCodeField.val();

	 	$.get('../items/get_items_json/'+barcode + "/" + ret.from_showroom_id , function(json_response){
	 		barCodeField.removeClass('loader_visible');
            $item = jQuery.parseJSON(json_response);
            barCodeField.removeClass('loader_visible');
            $item = jQuery.parseJSON(json_response);


            if($item == null){
                alert('item not found');
            }else{

            	var confirm = $('#confirm');
                if(confirm.hasClass('disabled')){
                    confirm.removeClass('disabled');
                }

                ret.addItem($item.id);

                var index = ret.items.length-1;
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
                $('.added_items').html(ret.total_added);
            }

	 	});

        $('#confirm').click(function(){
            console.log(JSON.stringify(ret));

            $.get('create_submit_json' ,{'val' : JSON.stringify(ret)} , function(response){

                
                if(response == 'ok'){

                    $('#body_content p').html('Transferred successfully');
                    $('#notify').modal('hide');

                    $('#notify').on('hidden.bs.modal', function () {
                        alert('Transfer has been done successfully ');
                        location.reload();
                    });

                }else{
                    $('#body_content p').html('Transferred successfully');

                    $('#myModal').on('hidden.bs.modal', function () {
                        location.reload();
                    });
                }
            });
        });

	 });
});





function Return(){
	this.showroom_id = 1;
    this.from_showroom_id = '';
    this.items = new Array();
    this.total_added = 0;

    this.addItem = function (id) {
        this.items.push(id);
        this.total_added += 1;
    }

    this.removeEntry = function(index){
        delete this.items[index];
        this.total_added -= 1;
    }
}

var ret = new Return();
