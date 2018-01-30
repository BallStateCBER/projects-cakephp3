<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Partner $partner
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Partner'), ['action' => 'edit', $partner->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Partner'), ['action' => 'delete', $partner->id], ['confirm' => __('Are you sure you want to delete # {0}?', $partner->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Partners'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Releases'), ['controller' => 'Releases', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Release'), ['controller' => 'Releases', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="partners view large-9 medium-8 columns content">
    <h3><?= h($partner->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($partner->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Short Name') ?></th>
            <td><?= h($partner->short_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($partner->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($partner->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($partner->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($partner->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Releases') ?></h4>
        <?php if (!empty($partner->releases)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Released') ?></th>
                <th scope="col"><?= __('Partner Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($partner->releases as $releases): ?>
            <tr>
                <td><?= h($releases->id) ?></td>
                <td><?= h($releases->title) ?></td>
                <td><?= h($releases->slug) ?></td>
                <td><?= h($releases->description) ?></td>
                <td><?= h($releases->released) ?></td>
                <td><?= h($releases->partner_id) ?></td>
                <td><?= h($releases->created) ?></td>
                <td><?= h($releases->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Releases', 'action' => 'view', $releases->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Releases', 'action' => 'edit', $releases->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Releases', 'action' => 'delete', $releases->id], ['confirm' => __('Are you sure you want to delete # {0}?', $releases->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
