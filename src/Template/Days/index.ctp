<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Day'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Weeks'), ['controller' => 'Weeks', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Week'), ['controller' => 'Weeks', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Daytimes'), ['controller' => 'Daytimes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Daytime'), ['controller' => 'Daytimes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="days index large-9 medium-8 columns content">
    <h3><?= __('Days') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('week_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('daytime_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($days as $day): ?>
            <tr>
                <td><?= $day->has('week') ? $this->Html->link($day->week->name, ['controller' => 'Weeks', 'action' => 'view', $day->week->id]) : '' ?></td>
                <td><?= $day->has('daytime') ? $this->Html->link($day->daytime->name, ['controller' => 'Days', 'action' => 'view', $day->id]) : '' ?></td>
                <td><?= h($day->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $day->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $day->id], ['confirm' => __('Are you sure you want to delete # {0}?', $day->id)]) ?>
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
