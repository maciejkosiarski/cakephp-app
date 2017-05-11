<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <h1><?= $this->Html->link(__('Menu'), '/', ['class' => 'sidebar-element'])?></h1>
        <div class="col-sm-12 sidebar-element">
           <h3><?= $this->Html->link(__('Add Dish'), '/dishes/create/') ?></h3>
        </div>
        <div class="col-sm-12 sidebar-element">
           <h3><?= $this->Html->link(__('List ingredients'), '/ingredients') ?></h3>
        </div>
    </ul>
</div>
<div class="col-sm-9 col-md-10 main">
    <h3><?= __('Dishes') ?></h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dishes as $dish): ?>
            <tr>
                <td><?= $this->Html->link(__(h($dish->name)), ['action' => 'view', $dish->id]) ?></td>
                <td><?= h($dish->dishes_type['name']) ?></td>
                <td><?= h($dish->created) ?></td>
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
