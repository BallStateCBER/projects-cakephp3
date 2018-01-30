<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Release $release
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Release'), ['action' => 'edit', $release->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Release'), ['action' => 'delete', $release->id], ['confirm' => __('Are you sure you want to delete # {0}?', $release->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Releases'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Release'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Partners'), ['controller' => 'Partners', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Partner'), ['controller' => 'Partners', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Graphics'), ['controller' => 'Graphics', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Graphic'), ['controller' => 'Graphics', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Authors'), ['controller' => 'Authors', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Author'), ['controller' => 'Authors', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tags'), ['controller' => 'Tags', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tag'), ['controller' => 'Tags', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="releases view large-9 medium-8 columns content">
    <h3><?= h($release->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($release->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($release->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Partner') ?></th>
            <td><?= $release->has('partner') ? $this->Html->link($release->partner->name, ['controller' => 'Partners', 'action' => 'view', $release->partner->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($release->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Released') ?></th>
            <td><?= h($release->released) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($release->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($release->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($release->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Authors') ?></h4>
        <?php if (!empty($release->authors)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($release->authors as $authors): ?>
            <tr>
                <td><?= h($authors->id) ?></td>
                <td><?= h($authors->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Authors', 'action' => 'view', $authors->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Authors', 'action' => 'edit', $authors->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Authors', 'action' => 'delete', $authors->id], ['confirm' => __('Are you sure you want to delete # {0}?', $authors->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Tags') ?></h4>
        <?php if (!empty($release->tags)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Slug') ?></th>
                <th scope="col"><?= __('Parent Id') ?></th>
                <th scope="col"><?= __('Lft') ?></th>
                <th scope="col"><?= __('Rght') ?></th>
                <th scope="col"><?= __('Selectable') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($release->tags as $tags): ?>
            <tr>
                <td><?= h($tags->id) ?></td>
                <td><?= h($tags->name) ?></td>
                <td><?= h($tags->slug) ?></td>
                <td><?= h($tags->parent_id) ?></td>
                <td><?= h($tags->lft) ?></td>
                <td><?= h($tags->rght) ?></td>
                <td><?= h($tags->selectable) ?></td>
                <td><?= h($tags->created) ?></td>
                <td><?= h($tags->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Tags', 'action' => 'view', $tags->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Tags', 'action' => 'edit', $tags->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Tags', 'action' => 'delete', $tags->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tags->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Graphics') ?></h4>
        <?php if (!empty($release->graphics)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Release Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Url') ?></th>
                <th scope="col"><?= __('Image') ?></th>
                <th scope="col"><?= __('Dir') ?></th>
                <th scope="col"><?= __('Weight') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($release->graphics as $graphics): ?>
            <tr>
                <td><?= h($graphics->id) ?></td>
                <td><?= h($graphics->release_id) ?></td>
                <td><?= h($graphics->title) ?></td>
                <td><?= h($graphics->url) ?></td>
                <td><?= h($graphics->image) ?></td>
                <td><?= h($graphics->dir) ?></td>
                <td><?= h($graphics->weight) ?></td>
                <td><?= h($graphics->created) ?></td>
                <td><?= h($graphics->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Graphics', 'action' => 'view', $graphics->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Graphics', 'action' => 'edit', $graphics->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Graphics', 'action' => 'delete', $graphics->id], ['confirm' => __('Are you sure you want to delete # {0}?', $graphics->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
