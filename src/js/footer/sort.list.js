// jQuery and before image loaded
( function( $ ) {
	$(document).ready(function () {
        $('#sort_list li:not(:first)').sort(sort_li).appendTo('#sort_list');
    });
} )( jQuery );

// sort function callback
function sort_li(a, b){
    return ($(b).data('position')) < ($(a).data('position')) ? 1 : -1;    
}