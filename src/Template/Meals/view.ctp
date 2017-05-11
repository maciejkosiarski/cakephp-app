<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Meal'), ['action' => 'edit', $meal->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Meal'), ['action' => 'delete', $meal->id], ['confirm' => __('Are you sure you want to delete # {0}?', $meal->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Meals'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Meal'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Dishes'), ['controller' => 'Dishes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dish'), ['controller' => 'Dishes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Days'), ['controller' => 'Days', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Day'), ['controller' => 'Days', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="meals view large-9 medium-8 columns content">
    <h3><?= h($meal->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Dish') ?></th>
            <td><?= $meal->has('dish') ? $this->Html->link($meal->dish->name, ['controller' => 'Dishes', 'action' => 'view', $meal->dish->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Day') ?></th>
            <td><?= $meal->has('day') ? $this->Html->link($meal->day->name, ['controller' => 'Days', 'action' => 'view', $meal->day->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($meal->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= $this->Number->format($meal->type) ?></td>
        </tr>
    </table>
</div>
