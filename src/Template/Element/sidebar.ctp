<?php if ($authUser): ?>
    <div>
        <?= $this->element('users/user_menu'); ?>
    </div>
<?php endif; ?>

<?php if (!$authUser): ?>
    <div>
        <?= $this->Html->link(
            'Reporter / Admin Login',
            [
                'controller' => 'users',
                'action' => 'login',
                'admin' => false,
                'plugin' => false
            ]
        ); ?>
    </div>
<?php endif; ?>
