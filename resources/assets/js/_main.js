$(document).ready(function(){
 
	var postId = 0;
	var postBodyElement = null;
	var $editHook = $('.post').find('.interaction').find('.edit');
	$editHook.on('click', function(e){

		e.preventDefault();
		postBodyElement = e.target.parentNode.parentNode.childNodes[1];
		var postBody = postBodyElement.textContent;
		postId = e.target.parentNode.parentNode.dataset['postid'];
		$('#modal-post-body').val(postBody);
		$('#edit-modal').modal();

	});

	$('#modal-save').on('click', function(){

		$.ajax({
			method: 'POST',
			url: urlEdit,
			data: 	{	body: $('#modal-post-body').val(),
						postId: postId,
						_token: token 
					}
		})
		.done(function(msg){
			$(postBodyElement).text(msg['new_body']);
			$('#edit-modal').modal('hide');
		});

	});

	$('.like').on('click', function(e){

		e.preventDefault();
		postId = e.target.parentNode.parentNode.dataset['postid'];
		var isLike = e.target.previousElementSibling  == null ? true : false; //check if Like button or Dislike button was clicked
		$.ajax({
			method: 'POST',
			url: urlLike,
			data: 	{
						isLike: isLike,
						postId: postId,
						_token: token
					}
		})
		.done(function(){
			
			if( isLike ){ //Like was clicked returns true above
				if(e.target.textContent == 'Like'){
					e.target.textContent = 'You like this post';
				} else {
					e.target.textContent = 'Like';
				}
			} else { //Dislike was clicked returns false above
				if(e.target.textContent == 'Dislike'){
					e.target.textContent = 'You don\'t like this post';
				} else {
					e.target.textContent = 'Dislike';
				}
			}

			if(isLike){
				e.target.nextElementSibling.textContent = 'Dislike';
			} else{
				e.target.previousElementSibling.textContent = 'Like';
			}

		});

	});

});