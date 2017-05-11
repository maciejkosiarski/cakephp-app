<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <?php if($day->daysQuantity !== 5):?>
        <li><?= $this->Html->link(__('New Meal'), ['controller' => 'Meals', 'action' => 'add', $day['id']]) ?></li>
        <?php endif; ?>
        <li><?= $this->Html->link(__('Edit Day'), ['action' => 'edit', $day->id, $day->week_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Day'), ['action' => 'delete', $day->id, $day->week_id], ['confirm' => __('Are you sure you want to delete # {0}?', $day->daytime['name'])]) ?> </li>
    </ul>
</nav>
<div class="days view large-9 medium-8 columns content">
    <h3><?= h($day->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Week') ?></th>
            <td><?= $day->has('week') ? $this->Html->link($day->week->name, ['controller' => 'Weeks', 'action' => 'view', $day->week->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Daytime') ?></th>
            <td><?= h($day->daytime->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($day->created) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Meals:') ?></h4>
        <?php if (!empty($day->meals)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Meal Type') ?></th>
                <th scope="col"><?= __('Meal') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($day->meals as $meal): ?>
            <tr>
                <td><?= h($meal->meals_type['name']) ?></td>
                <td><?= $this->Html->link(__(h($meal->dish['name'])), ['controller' => 'Dishes', 'action' => 'view', $meal->dish_id]) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Meals', 'action' => 'edit', $meal->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Meals', 'action' => 'delete', $meal->id], ['confirm' => __('Are you sure you want to delete # {0}?', $meal->meals_type['name'])]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
