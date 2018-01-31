<?php 
	$this->Html->script('/uploadify/jquery.uploadify-3.1.min.js', array('inline' => false));
	$this->Html->css('/uploadify/uploadify.css', array('inline' => false));
	$this->Js->buffer("
		$(function() {
			$('#file_upload').uploadify({
				'swf'      : '/uploadify/uploadify.swf',
				'uploader' : '/releases/upload_reports', //'/uploadify/uploadify.php',
				'onUploadSuccess' : function(file, data, response) {
					//alert(data);
					if (data.indexOf('Error') == -1) {
						var classname = 'success';
					} else {
						var classname = 'error';
					}
					insertFlashMessage(data, classname);
				} 
			});
		}); 
	");
?>

<input type="file" name="file_upload" id="file_upload" />