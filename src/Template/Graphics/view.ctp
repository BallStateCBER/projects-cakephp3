<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Graphic $graphic
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Graphic'), ['action' => 'edit', $graphic->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Graphic'), ['action' => 'delete', $graphic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $graphic->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Graphics'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Graphic'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Releases'), ['controller' => 'Releases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Release'), ['controller' => 'Releases', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="graphics view large-9 medium-8 columns content">
    <h3><?= h($graphic->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Release') ?></th>
            <td><?= $graphic->has('release') ? $this->Html->link($graphic->release->title, ['controller' => 'Releases', 'action' => 'view', $graphic->release->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($graphic->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Url') ?></th>
            <td><?= h($graphic->url) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Image') ?></th>
            <td><?= h($graphic->image) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dir') ?></th>
            <td><?= h($graphic->dir) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($graphic->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Weight') ?></th>
            <td><?= $this->Number->format($graphic->weight) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($graphic->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($graphic->modified) ?></td>
        </tr>
    </table>
</div>
