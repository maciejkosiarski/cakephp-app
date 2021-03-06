<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $daytime->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $daytime->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Daytimes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Days'), ['controller' => 'Days', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Day'), ['controller' => 'Days', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="daytimes form large-9 medium-8 columns content">
    <?= $this->Form->create($daytime) ?>
    <fieldset>
        <legend><?= __('Edit Daytime') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
