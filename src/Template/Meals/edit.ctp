<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $meal->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $meal->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Meals'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Dishes'), ['controller' => 'Dishes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Dish'), ['controller' => 'Dishes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Days'), ['controller' => 'Days', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Day'), ['controller' => 'Days', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="meals form large-9 medium-8 columns content">
    <?= $this->Form->create($meal) ?>
    <fieldset>
        <legend><?= __('Edit Meal') ?></legend>
        <?php
            echo $this->Form->input('dish_id', ['options' => $dishes]);
            echo $this->Form->input('day_id', ['options' => $days]);
            echo $this->Form->input('type', ['options' => $mealsTypes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
