<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Meals Type'), ['action' => 'edit', $mealsType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Meals Type'), ['action' => 'delete', $mealsType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $mealsType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Meals Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Meals Type'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="mealsTypes view large-9 medium-8 columns content">
    <h3><?= h($mealsType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($mealsType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($mealsType->id) ?></td>
        </tr>
    </table>
</div>
