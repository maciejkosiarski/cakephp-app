<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <h1><?= $this->Html->link(__('Menu'), '/', ['class' => 'sidebar-element'])?></h1>
        <div class="col-sm-12 sidebar-element">
           <h3><?= $this->Html->link(__('List dishes'), '/dishes') ?></h3>
        </div>
        <div class="col-sm-12 sidebar-element">
           <h3><?= $this->Html->link(__('List ingredients'), '/ingredients') ?></h3>
        </div>
    </ul>
</div>
<div class="col-sm-9 col-md-10 main">
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-6 main">
            <div class="col-xs-6 main">
                <h3>New Dish</h3>
                <?= $this->Form->create($dish) ?>
                <fieldset>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <?= $this->Form->input('name', ['label' => false]) ?>
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <?= $this->Form->input('notes', ['label' => false]) ?>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <?= $this->Form->input('type', ['options' => $dishesTypes, 'label' => false]) ?>
                    </div>

                    <div class="form-group">
                        <label for="ingredients">Ingredients</label>
                        <select name="ingredients[]" class="selectpicker" data-live-search="true" multiple>
                            <?php $ingredientsTypesInArray = $ingredientsTypes->toArray() ?>
                            <?php foreach ($ingredientsByType as $key => $ingredientByType): ?>
                                <optgroup label="<?= $ingredientsTypesInArray[$key] ?>">
                                <?php foreach ($ingredientByType as $ingredient): ?>
                                    <option value="<?= $ingredient->id ?>"><?= $ingredient->name ?></option>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </fieldset>
                <?= $this->Form->button(__('Add'), ['class' => 'btn main-button', 'role' => 'button']) ?>
                <?= $this->Form->end() ?>
            </div>
            <div class="col-xs-6 main">
                <h3>New Ingredients</h3>
                <?php if($weekId): ?>
                    <?= $this->Form->create($ingredient) ?>
                    <fieldset>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <?= $this->Form->input('name', ['label' => false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <?= $this->Form->input('type', ['options' => $ingredientsTypes, 'label' => false]) ?>
                        </div>
                    </fieldset>
                    <?= $this->Form->button(__('Add'), ['class' => 'btn main-button', 'role' => 'button']) ?>
                    <?= $this->Form->end() ?>

                <?php else: ?>

                    <?= $this->Form->create(null, ['url' => ['controller' => 'Ingredients', 'action' => 'add']]); ?>
                    <fieldset>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <?= $this->Form->input('name', ['label' => false]) ?>
                        </div>
                        <div class="form-group">
                            <label for="type">Type</label>
                            <?= $this->Form->input('type', ['options' => $ingredientsTypes ,'label' => false]) ?>
                        </div>
                    </fieldset>
                    <?= $this->Form->button(__('Add'), ['class' => 'btn main-button', 'role' => 'button']) ?>
                    <?= $this->Form->end() ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-6 main nopadding">
            <div class="main-rightside-img"></div>
        </div>
    </div>
</div>
