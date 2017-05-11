<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <h1><?= $this->Html->link(__('Menu'), '/', ['class' => 'sidebar-element'])?></h1>
        <div class="col-sm-12 sidebar-element">
           <h3><?= $this->Html->link(__('List Dishes'), '/dishes') ?></h3>
        </div>
        <div class="col-sm-12 sidebar-element">
           <h3><?= $this->Html->link(__('Add Dish'), '/dishes/create') ?></h3>
        </div>          
    </ul>
</div>
<div class="col-sm-9 col-md-10 main">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-md-6 main">
            <div class="thumbnail main-thumbnail">
                <div class="caption">
                    <div class="row">
                        <div class="col-xs-9">
                            <div class="row">
                                <div class="col-xs-6">
                                    <h3><?= h($dish->name) ?></h3>
                                    <?= h($dish->dishes_type['name'])  ?>
                                    <p><?= h($dish->created) ?></p>
                                </div>
                                <div class="col-xs-6 dish-thumbnail">
                                    <?= $this->Html->image('dish.jpg', ['class' => 'img-responsive']); ?>
                                </div>
                            </div>                       
                            <h4><?= __('Notes') ?></h4>
                            <?= $this->Text->autoParagraph(h($dish->notes)); ?>   
                        </div>
                        <div class="col-xs-3">
                            <h4><?= __('Components:') ?></h4>
                            <ul>
                            <?php foreach ($dish->components as $components): ?>
                                <li><?=  $this->Html->link(__(h($components->ingredient['name'])), ['controller' => 'Ingredients', 'action' => 'view', $components->ingredient_id]) ?></li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <a href="#" class="btn main-button" role="button" data-toggle="modal" data-target="#editDish">Edit</a> 
            </div>
        </div>
        <!-- Edit Week Modal -->
        <div id="editDish" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <i class="fa fa-times-circle-o fa-2x modal-close" data-dismiss="modal"></i>
                        <h4 class="modal-title">Edit <?= h($dish->name)  ?></h4>
                    </div>
                    <div class="modal-body">
                        <?= $this->Form->create(null, ['url'=> '/dish/update/'.$dish->id]) ?>
                        <?= $this->Form->hidden('ingredients') ?>
                        <fieldset>
                            <div class="form-group">
                                <label for="daytime_id">Name</label>
                                <?= $this->Form->input('name', ['class' => 'form-control', 'default' => $dish->name, 'label' => false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="daytime_id">Name</label>
                                <?= $this->Form->textarea('notes', ['class' => 'form-control', 'default' => $dish->notes, 'label' => false]) ?>
                            </div>
                            <div class="form-group">
                                <label for="daytime_id">Name</label>
                                <?= $this->Form->input('type', ['class' => 'form-control', 'default' => $dish->type, 'options' => $dishesTypes, 'label' => false]) ?>
                            </div>
                        </fieldset>                      
                    </div>
                    <div class="modal-footer">
                        <?= $this->Form->button(__('Edit'), ['class' => 'btn main-button']) ?>
                        <?= $this->Form->end() ?>
                        <?= $this->Html->link(__('Delete dish'), '/dish/remove/'.$dish->id, ['class' => 'btn btn-danger main-button-danger']) ?>
                    </div>
                </div>
            </div>
        </div>
         <div class="hidden-xs col-sm-2 col-md-6 main nopadding">
            <div class="main-rightside-img"></div>
        </div>
    </div>  
</div>
