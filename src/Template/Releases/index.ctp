<div class="paging">
	<?php if ($this->Paginator->hasPrev()) echo $this->Paginator->prev('< ' . __('previous'), [], null, ['class' => 'prev disabled']); ?>
	<?= $this->Paginator->numbers(['separator' => '']); ?>
	<?php if ($this->Paginator->hasNext()) echo $this->Paginator->next(__('next') . ' >', [], null, ['class' => 'next disabled']); ?>
</div>

<div class="releases">
	<?php foreach ($releases as $release): ?>
		<?= $this->element('release', compact('release')); ?>
	<?php endforeach; ?>
</div>

<div class="paging">
	<?php if ($this->Paginator->hasPrev()) echo $this->Paginator->prev('< ' . __('previous'), [], null, ['class' => 'prev disabled']); ?>
	<?= $this->Paginator->numbers(['separator' => '']); ?>
	<?php if ($this->Paginator->hasNext()) echo $this->Paginator->next(__('next') . ' >', [], null, ['class' => 'next disabled']); ?>
</div>

