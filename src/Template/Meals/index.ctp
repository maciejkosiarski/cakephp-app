<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Meal'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Dishes'), ['controller' => 'Dishes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Dish'), ['controller' => 'Dishes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Days'), ['controller' => 'Days', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Day'), ['controller' => 'Days', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="meals index large-9 medium-8 columns content">
    <h3><?= __('Meals') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dish_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('day_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($meals as $meal): ?>
            <tr>
                <td><?= $this->Number->format($meal->id) ?></td>
                <td><?= $meal->has('dish') ? $this->Html->link($meal->dish->name, ['controller' => 'Dishes', 'action' => 'view', $meal->dish->id]) : '' ?></td>
                <td><?= $meal->has('day') ? $this->Html->link($meal->day->daytime['name'], ['controller' => 'Days', 'action' => 'view', $meal->day->id]) : '' ?></td>
                <td><?= $meal->meals_type['name'] ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $meal->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $meal->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $meal->id], ['confirm' => __('Are you sure you want to delete # {0}?', $meal->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
