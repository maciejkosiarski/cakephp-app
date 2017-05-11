<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Dishes Type'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="dishesTypes index large-9 medium-8 columns content">
    <h3><?= __('Dishes Types') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dishesTypes as $dishesType): ?>
            <tr>
                <td><?= $this->Number->format($dishesType->id) ?></td>
                <td><?= h($dishesType->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $dishesType->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dishesType->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dishesType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dishesType->id)]) ?>
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
