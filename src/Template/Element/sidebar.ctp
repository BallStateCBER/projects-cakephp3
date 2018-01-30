<h2>
    Clients, Partners, and Sponsors
</h2>
<ul class="partners">
    <?php foreach ($sidebarVars['partners'] as $partner): ?>
        <li>
            <?php echo $this->Html->link(
                $partner->short_name,
                [
                    'controller' => 'partners',
                    'action' => 'view',
                    'id' => $partner->id,
                    'slug' => $partner->slug
                ],
                [
                    'title' => $partner->name
                ]
            ); ?>
        </li>
    <?php endforeach; ?>
</ul>

<h2>
    Topics
</h2>
<ul class="tags unstyled">
    <?php foreach ($sidebarVars['tags'] as $tag): ?>
        <li>
            <?php echo $this->Html->link(ucwords($tag['name']), [
                'controller' => 'tags',
                'action' => 'view',
                'id' => $tag['id'],
                'slug' => $tag['slug']
            ]); ?>
        </li>
    <?php endforeach; ?>
</ul>

<h2>
    Publishing Date
</h2>
<ul class="unstyled">
    <?php foreach ($sidebarVars['years'] as $year): ?>
        <li>
            <?php echo $this->Html->link($year, [
                'controller' => 'releases',
                'action' => 'year',
                'year' => $year
            ]); ?>
        </li>
    <?php endforeach; ?>
</ul>

<h2>
    Search
</h2>
<?php echo $this->Form->create(
    'Release',
    [
        'method' => 'get',
        'url' => ['controller' => 'releases', 'action' => 'search']
    ]
); ?>
<?php echo $this->Form->input('q', ['label' => false]); ?>
<?php echo $this->Form->submit('Search'); ?>
<?= $this->Form->end() ?>

<?php if ($authUser): ?>
    <div>
        <?= $this->element('users/user_menu'); ?>
    </div>
<?php else: ?>
    <div>
        <?= $this->Html->link(
            'Admin Login',
            [
                'controller' => 'users',
                'action' => 'login',
                'admin' => false,
                'plugin' => false
            ]
        ); ?>
    </div>
<?php endif; ?>
