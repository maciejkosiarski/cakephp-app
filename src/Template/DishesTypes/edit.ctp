<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $dishesType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dishesType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Dishes Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="dishesTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($dishesType) ?>
    <fieldset>
        <legend><?= __('Edit Dishes Type') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
