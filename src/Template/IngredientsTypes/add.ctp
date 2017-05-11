<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Ingredients Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="ingredientsTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($ingredientsType) ?>
    <fieldset>
        <legend><?= __('Add Ingredients Type') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
