<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Dish'), ['controller' => 'Dishes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="meals form large-9 medium-8 columns content">
    <?= $this->Form->create($meal) ?>
    <fieldset>
        <legend><?= __('Add Meal') ?></legend>
        <?php
            echo $this->Form->input('dish_id', ['options' => $dishes]);
            echo $this->Form->hidden('day_id', ['value' => $day['id']]);
            echo $this->Form->input('type', ['options' => $mealsTypes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
