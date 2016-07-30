$(document).ready(function(){
 
	$editHook = $('.post').find('.interaction').find('.edit');
	$editHook.on('click', function(e){

		e.preventDefault();
		var postBody = e.target.parentNode.parentNode.childNodes[1].textContent;
		$('#modal-post-body').val(postBody);
		$('#edit-modal').modal();

	});

});