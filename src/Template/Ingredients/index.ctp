<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <h1><?= $this->Html->link(__('Menu'), '/', ['class' => 'sidebar-element'])?></h1>
        <div class="col-sm-12 sidebar-element">
           <h3><?= $this->Html->link(__('Add Dish'), '/dishes/create/') ?></h3>
        </div>
        <div class="col-sm-12 sidebar-element">
           <h3><?= $this->Html->link(__('List dishes'), '/dishes') ?></h3>
        </div>       
    </ul>
</div>
<div class="col-sm-9 col-md-10 main">
    <h3><?= __('Ingredients') ?></h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ingredients as $ingredient): ?>
            <tr>
                <td><?= $this->Html->link(__(h($ingredient->name)), ['action' => 'view', $ingredient->id]) ?></td>
                <td><?= h($ingredient->ingredients_type['name']) ?></td>
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
