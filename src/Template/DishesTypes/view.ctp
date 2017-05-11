<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Dishes Type'), ['action' => 'edit', $dishesType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Dishes Type'), ['action' => 'delete', $dishesType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dishesType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Dishes Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dishes Type'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="dishesTypes view large-9 medium-8 columns content">
    <h3><?= h($dishesType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($dishesType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($dishesType->id) ?></td>
        </tr>
    </table>
</div>
