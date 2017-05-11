<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <h1><?= $this->Html->link(__('Menu'), '/', ['class' => 'sidebar-element'])?></h1>
        <?php if($week->daysQuantity !== 7): ?>
        <div class="col-sm-12 sidebar-element">                   
            <h3><?= $this->Html->link(__('New Day'), ['controller' => 'Days', 'action' => 'add', $week->id]) ?></h3>
        </div>
        <?php endif; ?>
        <div class="col-sm-12 sidebar-element">
           <h3><?= $this->Html->link(__('Add dish'), ['controller' => 'Dishes', 'action' => 'add']) ?></h3>
        </div>         
        <!-- Dish Modal -->
        <div id="addDish" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Dish Modal -->   
    </ul>
</div>
<div class="col-sm-9 col-md-10 main">
    <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-6 main">
            <div class="col-xs-6 main">
                <?= $this->Form->create($day) ?>
                <fieldset>
                    <h3><?= h($week['name']) ?></h3>
                    <div class="form-group">
                        <label for="daytime_id">Daytime</label>
                        <?= $this->Form->input('daytime_id', ['options' => $daytimes, 'label' => false]) ?>
                    </div>

                    <?php foreach ($mealsTypes as $meal): ?>
                        <div class="form-group">
                            <label for="<?= $meal->id ?>"><?= $meal->name ?></label>
                            <?= $this->Form->input($meal->name, ['class' => 'selectpicker', 'empty' => true, 'name' => $meal->id, 'options' => $dishes, 'label' => false, 'data-live-search' => true]) ?>
                        </div> 
                    <?php endforeach; ?>
                </fieldset>
                <?= $this->Form->button(__('Add'), ['class' => 'btn main-button', 'role' => 'button']) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-6 main nopadding">
            <div class="main-rightside-img"></div>
        </div>
    </div>
</div>
