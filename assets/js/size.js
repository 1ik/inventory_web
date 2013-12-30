$(document).ready(function(){
    var firstGroup = $("#group option:first").val();
    show_sub_groups(firstGroup , function(){
        var firstSubGroup = $("#sub_group option:first").val();
        show_item_types(firstSubGroup , function(){
            var item_type = $("#item_type option:first").val();
            show_sizes(item_type);
        });
    });
});


$( "#group" ).change(function() {
    show_sub_groups($(this).val(),  function(){
        var firstSubGroup = $("#sub_group option:first").val();
        show_item_types(firstSubGroup , function(){
            var item_type = $("#item_type option:first").val();
            show_sizes(item_type);
        });
    });
});



$("#sub_group").change(function(){
    show_item_types($(this).val() , function(){
        var item_type = $("#item_type option:first").val();
        show_sizes(item_type);
    });
});

$('#item_type').change(function(){
    show_sizes($(this).val());
});


function show_sub_groups(group_id , callback){
	$('#loader_sub_group').removeClass('invisible');
    var url = 'subgroup/get_sub_groups_json/'+group_id;
    $.get( url, function( data ) {
    	$('#loader_sub_group').addClass('invisible');
        var subgrps = jQuery.parseJSON(data);
        var html= '';
        for(i=0; i<subgrps.length; i++){
            var subgrp = subgrps[i];
            html += "<option value="+subgrp.id+">"+subgrp.name+"</option>";
        }
        $('#sub_group').html(html);
        callback();
    });
}

function show_item_types(sub_id , callback){
	$('#loader_item_type').removeClass('invisible');
    var url = "item_type/get_item_type_json/"+sub_id;
    $.get( url, function( data ) {
        $('#loader_item_type').addClass('invisible');


        var item_types = jQuery.parseJSON(data);
        var html= '';
        for(i=0; i<item_types.length; i++){
            var item_type = item_types[i];
            html += "<option value="+item_type.id+">"+item_type.name+"</option>";
        }
        $('#item_type').html(html);
        callback();
    });
}


function show_sizes(item_type_id){
    $('#loader_size').removeClass('invisible');
    var url = "size/get_sizes_json/"+item_type_id;
    $.get( url, function( json ){
        $('#loader_size').addClass('invisible');
        var sizes = jQuery.parseJSON(json);

        var html= '<tr><th>size name </th> <th> ACTION</th><tr>';
        for(i=0; i<sizes.length; i++){
            var size = sizes[i];
            var delurl = 'size/delete/'+size.id;
            var dellink = '<a class="btn btn-sm btn-danger" href="'   + delurl+'"> DELETE </a>';
            html += '<tr class="success"><td>'+size.name  + "</td><td>" +  dellink + '</td></tr>';
        }
        $('#size_table').html(html);
    });
}