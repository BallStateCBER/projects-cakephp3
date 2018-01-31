<?php
// Common form used for adding and editing
?>

<?php
	// Load validation library
	$this->Html->script('jquery.validationEngine', ['inline' => false]);
	$this->Html->script('jquery.validationEngine-en', ['inline' => false]);
	$this->Html->css('validationEngine.jquery', null, ['inline' => false]);

	$validExtensions = [];
	foreach ($reportFiletypes as $ext) {
		$validExtensions[] = '*.'.$ext;
	}
	$this->Html->script('admin', ['inline' => false]);
?>

<script>
    releaseForm.init();
</script>

<?php
    // Determine file upload limit
    $maxUpload = (int) (ini_get('upload_max_filesize'));
    $maxPost = (int) (ini_get('post_max_size'));
    $memoryLimit = (int) (ini_get('memory_limit'));
    $uploadMb = min($maxUpload, $maxPost, $memoryLimit);

	// Load uploadify library
	$this->Html->script('/uploadify/jquery.uploadify.min.js', ['inline' => false]);
	$this->Html->css('uploadify.css', null, ['inline' => false]);
?>

<script>
    releaseForm.setupUploadify({
        valid_extensions: '<?= ".implode('; ', $validExtensions)." ?>',
        time: <?= ".time()." ?>,
        token: '<?= ".md5(Configure::read('upload_token').time())." ?>',
        fileSizeLimit: '{<?= $uploadMb ?>}MB'
    });
</script>

<?php
	/* $i is the next key to be applied to a new input row.
	 * It begins at zero (or the highest key of data['Graphic'] + 1)
	 * and needs to be provided to jQuery. */
	if (isset($this->request->data['Graphic']) && ! empty($this->request->data['Graphic'])) {
		$i = 1 + max(array_keys($this->request->data['Graphic']));
	} else {
		$i = 0;
	}
?>
<script>
    $('body').data('graphics_iterator', <?= $i ?>);
</script>

<h1 class="page_title">
	<?= $titleForLayout; ?>
</h1>
<?= $this->Form->create(
		'Release',
		[
			'id' => 'ReleaseForm',
			'type' => 'file'
		]
	);
	if ($mode == 'edit') {
		echo $this->Form->input('id', ['type' => 'hidden', 'value' => $release_id]);
	}
	echo $this->Form->input('title', ['class' => 'validate[required]']);
	echo $this->Form->input('released', [
		'type' => 'date',
		'dateFormat' => 'MDY',
		'label' => 'Date Published',
		'minYear' => 2001,
		'maxYear' => date('Y')
	]);
?>

<?php if (empty($partners)): ?>
	<?= $this->Form->input('new_partner', [
		'type' => 'text',
		'label' => 'Client, Partner, or Sponsor',
		'class' => 'validate[required]'
	]); ?>
<?php else: ?>
	<div id="choose_partner">
		<?= $this->Form->input('partner_id', [
			'options' => $partners,
			'label' => 'Client, Partner, or Sponsor',
			'empty' => true,
			'after' => ' <a href="#" id="add_partner_button">Add new</a>',
			'class' => 'partner validate[funcCall[checkPartner]]'
		]); ?>
	</div>
	<div id="add_partner" style="display: none;">
		<?= $this->Form->input('new_partner', [
			'type' => 'text',
			'label' => 'Client, Partner, or Sponsor',
			'after' => ' <a href="#" id="choose_partner_button">Choose from list</a>',
			'class' => 'partner validate[funcCall[checkPartner]]'
		]); ?>
	</div>
<?php endif; ?>

<?= $this->Form->input('author', [
	'after' => ' <a href="#" id="add_author_toggler">Add new</a>',
	'div' => [
		'id' => 'author_select'
	],
	'empty' => true,
	'label' => 'Author(s)'
]); ?>
<div id="new_author" style="display: none;">
	<input type="text" placeholder="Author's name" />
	<a id="add_author_button" href="#">
		Add
	</a>
	|
	<a id="cancel_add_author_button" href="#">
		Cancel
	</a>
</div>
<ul id="authors_container">
	<?php if (isset($this->request->data['Author'])): ?>
		<?php foreach ($this->request->data['Author'] as $author): ?>
			<li>
				<?= $author['name']; ?>
				<input type="hidden" name="data[Author][Author][]" value="<?= $author['id']; ?>" />
				<button>
					X
				</button>
			</li>
		<?php endforeach; ?>
	<?php endif; ?>
</ul>

<?= $this->Form->input('description', ['class' => 'validate[required]']); ?>

<fieldset class="reports">
	<legend>
		Upload Reports
		<a href="#" id="footnote_upload_reports_handle">
			<img src="/data_center/img/icons/information.png" alt="More info" />
		</a>
	</legend>
	<ul class="footnote" style="display: none;" id="footnote_upload_reports">
		<li>Click on <strong>Select Files</strong> above to upload one or more documents.</li>
		<li>Files must have one of the following extensions: <?= $this->Text->toList($reportFiletypes, 'or'); ?>.</li>
		<?php if ($uploadMb): ?>
			<li>Files larger than <?= $uploadMb; ?>MB will need to be uploaded via FTP client.</li>
		<?php endif; ?>
		<li>These files will be uploaded to a reports folder and can be linked to with linked graphics or in a release's description.</li>
	</ul>
	<input type="file" name="file_upload" id="upload_reports" />
	<input type="checkbox" name="overwrite" value="1" id="overwrite_reports" />
	<label for="overwrite_reports">
		Overwrite reports with the same filename
	</label>
</fieldset>

<fieldset class="graphics">
	<legend>
		Linked Graphics
		<a href="#" id="footnote_upload_graphics_handle">
			<img src="/data_center/img/icons/information.png" alt="More info" />
		</a>
	</legend>
	<ul class="footnote" style="display: none;" id="footnote_upload_graphics">
		<li>Images must be .jpg, .jpeg, .gif, or .png.</li>
		<li>Thumbnails (max 195&times;195px) will be automatically generated.</li>
		<li>Graphics with lower order-numbers are displayed first.</li>
	</ul>
	<?php $rows_prepopulated = (isset($this->request->data['Graphic']) && ! empty($this->request->data['Graphic'])); ?>
	<table class="graphics">
		<thead <?php if (! $rows_prepopulated): ?>style="display: none;"<?php endif; ?>>
			<th>Remove</th>
			<th>File</th>
			<th>Title</th>
			<th>Link URL</th>
			<th>Order</th>
		</thead>
		<tbody>
			<?php if ($rows_prepopulated): ?>
				<?php foreach ($this->request->data['Graphic'] as $k => $g): ?>
					<tr>
						<?php if ($mode == 'add'): ?>
							<td>
								<a href="#" class="remove_graphic">
									<img src="/data_center/img/icons/cross.png" alt="Remove" />
								</a>
							</td>
							<td>
								<?= $this->Form->input("Graphic.$k.image", [
									'type' => 'file',
									'label' => false,
									'class' => 'validate[required] upload'
								]); ?>
							</td>
						<?php elseif ($mode == 'edit'): ?>
							<td>
								<?= $this->Form->input("Graphic.$k.remove", [
									'type' => 'checkbox',
									'label' => false
								]); ?>
							</td>
							<td>
								<?php
									$img_url = '/img/releases/';
									$img_url .= $this->request->data['Graphic'][$k]['dir'].'/';
									$img_url .= $this->Graphic->thumbnail($this->request->data['Graphic'][$k]['image']);
								?>
								<img src="<?= $img_url; ?>" />
								<?php foreach (['id', 'dir', 'image'] as $field): ?>
									<?= $this->Form->input("Graphic.$k.$field", [
										'value' => $this->request->data['Graphic'][$k][$field],
										'type' => 'hidden'
									]); ?>
								<?php endforeach; ?>
							</td>
						<?php endif; ?>
						<td>
							<?= $this->Form->input("Graphic.$k.title", [
								'label' => false,
								'class' => "validate[condRequired[Graphic{$k}Image]]"
							]); ?>
						</td>
						<td>
							<?= $this->Form->input("Graphic.$k.url", [
								'label' => false,
								'class' => "validate[condRequired[Graphic{$k}Image]]",
								'after' =>  '<a href="#" title="Find report" class="find_report" id="find_report_button_'.$k.'"><img src="/data_center/img/icons/magnifier.png" alt="Find report" /></a>'
							]); ?>
                            <script>
                                $('#find_report_button_<?= $k ?>').click(function(event) {
                                    event.preventDefault();
                                    toggleReportFinder(this, <?= $k ?>);
                                });
                            </script>
						</td>
						<td>
							<?= $this->Form->input("Graphic.$k.weight", [
								'label' => false,
								'type' => 'select',
								'options' => range(1, count($this->request->data['Graphic']))
							]); ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
		<tfoot>
			<tr class="add_graphic">
				<th colspan="4">
					<a href="#" class="add_graphic">
						<img src="/data_center/img/icons/plus.png" /> Add a linked graphic
					</a>
				</th>
			</tr>
			<tr class="dummy_row">
				<td>
					<a href="#" class="remove_graphic">
						<img src="/data_center/img/icons/cross.png" alt="Remove" />
					</a>
				</td>
				<td>
					<?= $this->Form->input("Graphic.{i}.image", [
						'type' => 'file',
						'label' => false,
						'disabled' => true,
						'required' => true,
						'class' => 'validate[required,funcCall[checkExtension]] upload'
					]); ?>
				</td>
				<td>
					<?= $this->Form->input("Graphic.{i}.title", [
						'label' => false,
						'disabled' => true,
						'required' => true,
						'class' => 'validate[condRequired[Graphic{i}Image]]'
					]); ?>
				</td>
				<td>
					<?= $this->Form->input("Graphic.{i}.url", [
						'label' => false,
						'disabled' => true,
						'required' => true,
						'class' => 'validate[condRequired[Graphic{i}Image]',
						'after' => ' <a href="#" title="Find report" class="find_report"><img src="/data_center/img/icons/magnifier.png" alt="Find report" /></a>'
					]); ?>
				</td>
				<td>
					<?php
						if (isset($this->request->data['Graphic'])) {
							$options = range(1, count($this->request->data['Graphic']) + 1);
						} else {
							$options = [1];
						}
						echo $this->Form->input("Graphic.{i}.weight", [
							'label' => false,
							'disabled' => true,
							'type' => 'select',
							'options' => $options
						]);
					?>
				</td>
			</tr>
		</tfoot>
	</table>
</fieldset>

<?php
	echo $this->element('DataCenter.jquery_ui');
	echo $this->element(
		'tags/editor',
		[
			'available_tags' => $available_tags,
			'selected_tags' => isset($this->request->data['Tag']) ? $this->request->data['Tag'] : [],
			'hide_label' => true,
			'allow_custom' => true
		],
		[
			'plugin' => 'DataCenter'
		]
	);
	echo $this->Form->end('Submit');
	echo $this->element(
		'DataCenter.rich_text_editor_init',
		[
			'customConfig' => Configure::read('ckeditor_custom_config')
		]
	);