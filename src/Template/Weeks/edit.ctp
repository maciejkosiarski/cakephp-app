<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $week->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $week->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Weeks'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Days'), ['controller' => 'Days', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Day'), ['controller' => 'Days', 'action' => 'add', $week->id]) ?></li>
    </ul>
</nav>
<div class="weeks form large-9 medium-8 columns content">
    <?= $this->Form->create($week) ?>
    <fieldset>
        <legend><?= __('Edit Week') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('active');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
