<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <h1><?= $this->Html->link(__('Menu'), '/', ['class' => 'sidebar-element'])?></h1>
        <?php if($week->daysQuantity !== 7): ?>
        <div class="col-sm-12 sidebar-element" data-toggle="modal" data-target="#addWeek">                   
            <h3><?= $this->Html->link(__('New Day'), '/day/create/'.$week->id) ?></h3>           
        </div>
        <?php endif; ?>
        <div class="col-sm-12 sidebar-element">
           <h3><?= $this->Html->link(__('Add Dish'), '/dishes/create/'.$week->id) ?></h3>
        </div>          
    </ul>
</div>
<div class="col-sm-9 col-md-10 main">
    <h3><?= h($week->name) ?></h3>
    <p><?= h($week->created) ?></p>
    <div >
        <?php if (!empty($week->days)): ?>
            <h4><?= __('Days') ?></h4>
            <div class="row">
                <?php foreach ($week->days as $day): ?>
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="thumbnail main-thumbnail">
                            <?= $this->Html->image('http://data.whicdn.com/images/3562154/large.jpg'); ?>
                            <div class="caption">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="row">
                                            <div class="col-xs-9">
                                                <h3><?= $this->Html->tag('a', __(h($day->daytime['name'])), ['role' => 'button', 'data-toggle' => 'modal', 'data-target' => '#day'.$day->id]) ?></h3>
                                            </div>
                                            <div class="col-xs-3">
                                                <?php if (!empty($day->meals)): ?>
                                                    <i id="<?= $day->id ?>" class="fa fa-shopping-basket fa-2x shoping-icon sidebar-element shoping-list" data-toggle="modal" data-target="#shopingList<?= $day->id ?>"></i>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php foreach ($day->meals as $dish): ?>
                                            <?= h($dish->meals_type['name']) ?>
                                            :
                                            <?= $this->Html->link(__(h($dish->dish['name'])), '/dish/'.$dish->dish['id']) ?>
                                            </br>
                                        <?php endforeach; ?>
                                        <?php if ($day->mealsQuantity < 5): ?>
                                        <div class="add-meal-button" data-toggle="modal" data-target="#addMeal<?= $day->id ?>">
                                            <i class="fa fa-cutlery fa-2x"></i>
                                            <i class="fa fa-plus fa-2x"></i>
                                        </div>
                                        <!-- Add Meal Modal -->
                                        <div id="addMeal<?= $day->id ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <i class="fa fa-times-circle-o fa-2x modal-close" data-dismiss="modal"></i>
                                                        <h4 class="modal-title">Add meal</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?= $this->Form->create(null, ['url' => ['controller' => 'Meals', 'action' => 'add', $day->id]]) ?>
                                                        <fieldset>
                                                            <?= $this->Form->hidden('day_id', ['value' => $day->id]) ?>
                                                            <div class="form-group">
                                                                <label for="daytime_id">Dish</label>
                                                                <?= $this->Form->input('dish_id', ['class' => 'selectpicker', 'options' => $dishes, 'label' => false, 'data-live-search' => true]) ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="daytime_id">Type</label>
                                                                <?= $this->Form->input('type', ['class' => 'form-control input-normal', 'options' => $mealsTypes, 'label' => false]) ?>
                                                            </div>
                                                        </fieldset>
                                                        <?= $this->Form->button(__('Add'), ['class' => 'btn main-button', 'role' => 'button']) ?>
                                                        <?= $this->Form->end() ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shoping List Modal -->
                    <div id="shopingList<?= $day->id ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <i class="fa fa-times-circle-o fa-2x modal-close" data-dismiss="modal"></i>
                                    <h4 class="modal-title"><?= $day->daytime['name'] ?> Shopping list</h4>
                                </div>
                                <div class="modal-body<?= $day->id ?>">
                                    <center>
                                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw main-spinner"></i>
                                        <span class="sr-only">Loading...</span>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Week Modal -->
                    <div id="day<?= $day->id ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <i class="fa fa-times-circle-o fa-2x modal-close" data-dismiss="modal"></i>
                                    <h4 class="modal-title"><?= h($day->daytime['name']) ?></h4>
                                </div>
                                <div class="modal-body">
                                    <table class="borderless">
                                        <?= $this->Form->create(null, ['url' => '/day/update/'.$day->id.'/'.$day->week_id]) ?>
                                        <?= $this->Form->hidden('daytime_id', ['value' => $day->daytime_id]) ?>
                                        <?= $this->Form->hidden('week_id', ['value' => $day->week_id]) ?>
                                        <?php foreach ($day->meals as $dish): ?>
                                            <tr>
                                                <td><?php echo $dish->meals_type['name']; ?>:</td>
                                                <td><?= $this->Form->input($dish->meals_type['name'], ['name' => $dish->id, 'class' => 'form-control', 'default' => $dish->dish_id, 'options' => $dishes, 'label' => false, 'data-live-search' => true]) ?></td>
                                                <td><?= $this->Html->link(__('Delete meal'), '/meal/'.$dish->id, ['class' => 'btn btn-danger main-button-danger']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <?= $this->Form->button(__('Edit'), ['class' => 'btn main-button']) ?>
                                    <?= $this->Form->end() ?>
                                    <?= $this->Html->link(__('Delete day'), '/day/'.$day->id, ['class' => 'btn btn-danger main-button-danger']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <?= $this->Html->link('<h3>Week is empty add day!</h3>', '/day/create/'.$week->id, ['escape' => false]) ?>
        <?php endif; ?>        
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var shopingIcons = document.getElementsByClassName('shoping-list');
        Array.prototype.forEach.call(shopingIcons, function(el) {
            var url = "<?= $this->Url->build('/day/shoppingList', true); ?>/"+el.getAttribute('id')+'/<?= $week->id ?>';
            $('#'+el.getAttribute('id')).click(function() {
                if($('.modal-body'+el.getAttribute('id')+' > center > .main-spinner').length){
                   $.ajax({
                        type: 'POST',
                        url: url,
                        success: function(data,textStatus,xhr){
                            var response = $.parseJSON(data);
                            var shoppingList
                            if(response.length == 0){
                                shoppingList = '<h4>Shopping list is empty</h4>';
                            }else{
                                shoppingList= '<ul>';
                                $.each(response, function(i, val) {
                                    shoppingList += '<h4 class="ingredient-type">'+i+'</h4>';
                                    $.each(val, function() {
                                        shoppingList += '<li class="ingredient">'+this+'</li>';
                                    });
                                });
                                shoppingList += '</ul>';
                            }
                                                     
                            $('.modal-body'+el.getAttribute('id')).html(shoppingList);

                            $('.ingredient').click(function() {
                                $(this).toggleClass( "shopping-list-checked" );
                            });
                        },
                        error: function(xhr,textStatus,error){
                            $('.modal-body'+el.getAttribute('id')).html('<h4>Shopping list is unavailable</h4>');   
                        }
                    }); 
                }
            });
        });
    });
</script>
