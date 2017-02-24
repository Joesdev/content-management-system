// Post WYSIWYG Editor (what you see if what you get)
tinymce.init({ selector:'textarea' });
$(document).ready(function(){
	$('#selectAllBoxes').click(function(event){
		if(this.checked){
			$('.checkBoxes').each(function(){
				this.checked = true;
			});
		} else{
			$('.checkBoxes').each(function(){
				this.checked = false;
			});
		}
	});
});