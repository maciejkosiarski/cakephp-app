<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Daytime'), ['action' => 'edit', $daytime->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Daytime'), ['action' => 'delete', $daytime->id], ['confirm' => __('Are you sure you want to delete # {0}?', $daytime->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Daytimes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Daytime'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Days'), ['controller' => 'Days', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Day'), ['controller' => 'Days', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="daytimes view large-9 medium-8 columns content">
    <h3><?= h($daytime->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($daytime->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($daytime->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Days') ?></h4>
        <?php if (!empty($daytime->days)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Week Id') ?></th>
                <th scope="col"><?= __('Daytime Id') ?></th>
                <th scope="col"><?= __('Breakfast') ?></th>
                <th scope="col"><?= __('Diner') ?></th>
                <th scope="col"><?= __('Supper') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($daytime->days as $days): ?>
            <tr>
                <td><?= h($days->id) ?></td>
                <td><?= h($days->week_id) ?></td>
                <td><?= h($days->daytime_id) ?></td>
                <td><?= h($days->breakfast) ?></td>
                <td><?= h($days->diner) ?></td>
                <td><?= h($days->supper) ?></td>
                <td><?= h($days->created) ?></td>
                <td><?= h($days->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Days', 'action' => 'view', $days->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Days', 'action' => 'edit', $days->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Days', 'action' => 'delete', $days->id], ['confirm' => __('Are you sure you want to delete # {0}?', $days->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
