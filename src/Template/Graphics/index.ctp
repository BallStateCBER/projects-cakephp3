<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Graphic[]|\Cake\Collection\CollectionInterface $graphics
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Graphic'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Releases'), ['controller' => 'Releases', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Release'), ['controller' => 'Releases', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="graphics index large-9 medium-8 columns content">
    <h3><?= __('Graphics') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('release_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('url') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dir') ?></th>
                <th scope="col"><?= $this->Paginator->sort('weight') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($graphics as $graphic): ?>
            <tr>
                <td><?= $this->Number->format($graphic->id) ?></td>
                <td><?= $graphic->has('release') ? $this->Html->link($graphic->release->title, ['controller' => 'Releases', 'action' => 'view', $graphic->release->id]) : '' ?></td>
                <td><?= h($graphic->title) ?></td>
                <td><?= h($graphic->url) ?></td>
                <td><?= h($graphic->image) ?></td>
                <td><?= h($graphic->dir) ?></td>
                <td><?= $this->Number->format($graphic->weight) ?></td>
                <td><?= h($graphic->created) ?></td>
                <td><?= h($graphic->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $graphic->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $graphic->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $graphic->id], ['confirm' => __('Are you sure you want to delete # {0}?', $graphic->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
