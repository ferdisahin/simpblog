$(document).ready(function () {
	var select = $('.select');

	var url = $('body').data('url');

	var editor = $('#editor');
	if(editor.length > 0){
		Quill.register("modules/imageUploader", ImageUploader);

		var toolbarOptions = [
			['bold', 'italic', 'underline', 'strike'],        // toggled buttons
			['blockquote', 'code-block'],
		  
			[{ 'list': 'ordered'}, { 'list': 'bullet' }],
			[{ 'header': [1, 2, 3, 4, 5, 6, false] }],
		  
			[{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
			[{ 'align': [] }],
			['link', 'image', 'video'],
			['clean']                                         // remove formatting button
		 ];	
	
		var quill = new Quill('#editor', {
			modules: {
				toolbar: toolbarOptions,
				imageUploader: {
					upload: file => {
					  return new Promise((resolve, reject) => {
						const formData = new FormData();
						formData.append("image", file);
	  
						fetch(
						  "https://api.imgbb.com/1/upload?key=cc76b16fa4b46d39237a72558a8445f1",
						  {
							method: "POST",
							body: formData
						  }
						)
						  .then(response => response.json())
						  .then(result => {
							console.log(result);
							resolve(result.data.url);
						  })
						  .catch(error => {
							reject("Upload failed");
							console.error("Error:", error);
						  });
					  });
					}
				  }		
			},		
			theme: 'snow',
			placeholder: 'Bir şeyler yaz...',
		});
	}

	$('.form-expand').on('click', function(){
		$('.input-area').removeClass('d-none');
	});

	$('.comment-form .btn').on('click', function(e){
		var serialize = $(this).closest('.comment-form').serialize();
		var id = $('.single-page').attr('id');
		var id = id.split('-').pop();

		var data = new FormData();
		data.append('sendComment', 1);
		data.append('serialize', serialize);
		data.append('id', id);

		$.ajax({
			url: url + 'ajax',
			type: 'POST',
			dataType:'JSON',
			data: data,
			contentType: false,
			processData: false,
			success: function(r){
				if(r.error){
					Swal.fire({
						title: 'Hata!',
						text: r.text,
						icon: 'error',
						showConfirmButton: false,
						timer: 2000						
					});					
				}

				if(r.success){
					Swal.fire({
						title: 'Başarılı!',
						text: r.text,
						icon: 'success',
						showConfirmButton: false,
						timer: 2500						
					});							
				}
			}
		});

		e.preventDefault();
	});

	$('.send-login').on('click', function(e){
		var serialize = $(this).closest('.login').serialize();

		var data = new FormData();
		data.append('login', 1);
		data.append('serialize', serialize);
		
		$.ajax({
			url: url + 'ajax',
			type: 'POST',
			dataType: 'JSON',
			data: data,
			processData: false,
			contentType: false,
			success: function(r){
				if(r.error){
					Swal.fire({
						title: 'Hata!',
						text: r.text,
						icon: 'error',
						showConfirmButton: false,
						timer: 2000						
					});					
				}

				if(r.success){
					Swal.fire({
						title: 'Başarılı!',
						text: r.text,
						icon: 'success',
						showConfirmButton: false,
						timer: 2500						
					});		
					setTimeout(function(){
						location.reload();
					}, 2500);					
				}
			}
		});

		e.preventDefault();
	});

	$('#editor').keyup(function(){
		var content = $('.ql-editor').html();
		$('.message-content').val(content);
	});
});
