<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Ingredients Type'), ['action' => 'edit', $ingredientsType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Ingredients Type'), ['action' => 'delete', $ingredientsType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ingredientsType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Ingredients Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Ingredients Type'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="ingredientsTypes view large-9 medium-8 columns content">
    <h3><?= h($ingredientsType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($ingredientsType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($ingredientsType->id) ?></td>
        </tr>
    </table>
</div>
