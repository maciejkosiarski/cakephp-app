<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $ingredientsType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $ingredientsType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Ingredients Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="ingredientsTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($ingredientsType) ?>
    <fieldset>
        <legend><?= __('Edit Ingredients Type') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
