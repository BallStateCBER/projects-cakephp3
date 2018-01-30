<h2>
    Administration
</h2>
<ul class="unstyled">
    <li><?php echo $this->Html->link('New Release', array('controller' => 'releases', 'action' => 'add')); ?></li>
    <li><?php echo $this->Html->link('New User', array('controller' => 'users', 'action' => 'add')); ?></li>
    <li><?php echo $this->Html->link('Clients / Partners / Sponsors', array('controller' => 'partners', 'action' => 'index')); ?></li>
    <li><?php echo $this->Html->link('Tags', array('controller' => 'tags', 'action' => 'edit')); ?></li>
    <li><?php echo $this->Html->link('Authors', array('controller' => 'authors', 'action' => 'index')); ?></li>
    <li><?php echo $this->Html->link('Change my password', array('controller' => 'users', 'action' => 'change_password')); ?></li>
    <li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
</ul>