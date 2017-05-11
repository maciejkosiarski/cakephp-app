<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <h1><?= $this->Html->link(__('Menu'), '/', ['class' => 'sidebar-element'])?></h1>
        <div class="col-sm-12 sidebar-element">
           <h3><?= $this->Html->link(__('List dishes'), ['controller' => 'Dishes', 'action' => 'index']) ?></h3>
        </div>
        <div class="col-sm-12 sidebar-element">
           <h3><?= $this->Html->link(__('List ingredients'), ['controller' => 'Ingredients', 'action' => 'index']) ?></h3>
        </div>
    </ul>
</div>
<div class="col-sm-9 col-md-10 main">
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-6 main">
            <h4><?= h($day['week']['name']); ?></h4>
            <?= $this->Form->create($day) ?>
            <fieldset>
                <?= $this->Form->hidden('week_id', ['value' => $day['week_id']]) ?>
                <div class="form-group">
                    <label for="daytime_id">Daytime</label>
                    <?= $this->Form->input('daytime_id', ['options' => $daytimes, 'label' => false]) ?>
                </div>
                <?php foreach ($day['meals'] as $meal): ?>
                    <div class="form-group">
                        <label for="<?= $meal->id ?>"><?= $meal->meals_type['name'] ?></label>
                        <?= $this->Form->input($meal->meals_type['name'], ['name' => $meal->id, 'default' => $meal->dish['id'], 'options' => $dishes, 'label' => false]) ?>
                    </div>
                <?php endforeach; ?>
            </fieldset>
            <?= $this->Form->button(__('Submit'), ['class' => 'btn main-button']) ?>
            <?= $this->Form->end() ?>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-6 main nopadding">
            <div class="main-rightside-img"></div>
        </div>
    </div> 
</div>
