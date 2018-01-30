<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Graphic $graphic
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Graphics'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Releases'), ['controller' => 'Releases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Release'), ['controller' => 'Releases', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="graphics form large-9 medium-8 columns content">
    <?= $this->Form->create($graphic) ?>
    <fieldset>
        <legend><?= __('Add Graphic') ?></legend>
        <?php
            echo $this->Form->control('release_id', ['options' => $releases]);
            echo $this->Form->control('title');
            echo $this->Form->control('url');
            echo $this->Form->control('image');
            echo $this->Form->control('dir');
            echo $this->Form->control('weight');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
