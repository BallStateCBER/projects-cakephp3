<?=
	$this->Html->script('/uploadify/jquery.uploadify-3.1.min.js', ['inline' => false]);
	$this->Html->css('/uploadify/uploadify.css', ['inline' => false]);
?>
<script>
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
</script>

<input type="file" name="file_upload" id="file_upload" />