<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $mealsType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $mealsType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Meals Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="mealsTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($mealsType) ?>
    <fieldset>
        <legend><?= __('Edit Meals Type') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
