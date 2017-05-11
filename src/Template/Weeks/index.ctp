<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <h1><?= $this->Html->link(__('Menu'), '/', ['class' => 'sidebar-element'])?></h1> 
        <div class="col-sm-12 sidebar-element" data-toggle="modal" data-target="#addWeek">                   
            <h3>Add week</h3>           
        </div>
        <!-- Week Modal -->
        <div id="addWeek" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Week</h4>
                    </div>
                    <div class="modal-body">
                        <?= $this->Form->create($week, ['url' => '/week/create']) ?>
                        <div class="input-group">
                            <?= $this->Form->input('name', ['class' => 'form-control', 'type' => 'text', 'placeholder' => 'Week name', 'label' => false]) ?>
                            <span class="input-group-btn">
                                <?= $this->Form->button('Create', ['class' => 'btn main-button', 'type' => 'submit']) ?>
                            </span>
                        </div>
                        <div class="row">
                        <?php foreach ($thumbnails as $thumbnail): ?>
                            <div class="col-xs-4">
                                <label>
                                <input type="radio" name="thumbnail" value="<?= $thumbnail; ?>" aria-label="...">
                                 <?= $this->Html->image('thumbnails/'.$thumbnail.'.jpg', ['class' => 'main-img img-rounded']); ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn main-button" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Week Modal -->
        <div class="col-sm-12 sidebar-element">
           <h3><?= $this->Html->link(__('Add Dish'), '/dishes/create') ?></h3>
        </div>       
    </ul>
</div>
<div class="col-sm-9 col-md-10 main">
    <h3><?= __('Weeks') ?></h3>
    <div class="row">
    <?php if(!$weeks->isEmpty()): ?>
    <?php foreach ($weeks as $week): ?>
        <div class="col-xs-6 col-md-3">
            <div class="thumbnail main-thumbnail">
                <?= $this->Html->image('thumbnails/'.$week->thumbnail.'.jpg'); ?>
                <div class="caption">
                    <div class="row">
                        <div class="col-xs-9">
                            <h3><?= $this->Html->link(__(h($week->name)), '/week/'.$week->id) ?></h3>
                            <p><?= h($week->created) ?></p>
                            <a href="#" class="btn main-button btn-block" role="button" data-toggle="modal" data-target="#editWeek<?= $week->id ?>">Edit</a> 
                            <a href="#" class="btn main-button btn-block" role="button" data-toggle="modal" data-target="#deleteWeek<?= $week->id ?>">Delete</a>    
                        </div>
                        <div class="col-xs-3">
                            <center>
                                <div class="days-icon">
                                    <i class="fa fa-calendar fa-2x" aria-hidden="true"></i>
                                    <h4><span class="label label-warning">
                                        <?php if(empty($week->days)): ?>
                                        0
                                        <?php else : ?>
                                            <?= $week->days[0]['total'] ?>
                                        <?php endif; ?>
                                    </span></h4>
                                </div>
                            </center>
                            <i id="<?= $week->id ?>" class="fa fa-shopping-basket fa-2x shoping-icon sidebar-element shoping-list" data-toggle="modal" data-target="#shopingList<?= $week->id ?>"></i>                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Shoping List Modal -->
        <div id="shopingList<?= $week->id ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <i class="fa fa-times-circle-o fa-2x modal-close" data-dismiss="modal"></i>
                        <h4 class="modal-title">Shopping list</h4>
                    </div>
                    <div class="modal-body<?= $week->id ?>">
                        <center>
                            <i class="fa fa-spinner fa-pulse fa-3x fa-fw main-spinner"></i>
                            <span class="sr-only">Loading...</span>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Week Modal -->
        <div id="editWeek<?= $week->id ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <i class="fa fa-times-circle-o fa-2x modal-close" data-dismiss="modal"></i>
                        <h4 class="modal-title">Edit week</h4>
                    </div>
                    <div class="modal-body">
                        <?= $this->Form->create(null, ['url' => '/week/update/'.$week->id]) ?>
                        <fieldset>
                            <div class="form-group">
                                <label for="daytime_id">Name</label>
                                <?= $this->Form->input('name', ['class' => 'form-control', 'value' => $week->name, 'label' => false]) ?>
                            </div>
                            <input type="hidden" value="0" name="active" />
                            <div class="form-group">
                                <label for="">Active</label><br />
                                <div class="switch switch-square"                                   
                                    data-on-label="<i class=' fa fa-check'></i>"
                                    data-off-label="<i class='fa fa-times'></i>">
                                    <input name="active" type="checkbox" checked="checked" value="1"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Thumbnail</label>
                                <div class="row">
                                    <center>
                                    <?php foreach ($thumbnails as $thumbnail): ?>
                                        <div class="col-xs-4">
                                            <label>
                                            <input type="radio" name="thumbnail" value="<?= $thumbnail; ?>" aria-label="...">
                                             <?= $this->Html->image('thumbnails/'.$thumbnail.'.jpg', ['class' => 'main-img img-rounded']); ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                    </center>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                         <?= $this->Form->button(__('Edit'), ['class' => 'btn main-button']) ?>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Week Modal -->
        <div id="deleteWeek<?= $week->id ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <i class="fa fa-times-circle-o fa-2x modal-close" data-dismiss="modal"></i>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <?= h($week->name) ?>?</p>
                    </div>
                    <div class="modal-footer">
                        <?= $this->Html->Link(__('Delete'), '/week/remove/'.$week->id, ['class' => 'btn btn-danger main-button-danger', 'type' => 'button']) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php else : ?>
        <div class="col-sm-12 sidebar-element" data-toggle="modal" data-target="#addWeek">
            <h3>You didn't have weeks. Create one.</h3>
        </div>
        
    <?php endif; ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var shopingIcons = document.getElementsByClassName('shoping-list');
        Array.prototype.forEach.call(shopingIcons, function(el) {
            var url = "<?= $this->Url->build('/week/shoppingList', true); ?>/"+el.getAttribute('id');
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
<?= $this->Html->script('jquery.dcjqaccordion.2.7') ?>
<?= $this->Html->script('bootstrap-switch') ?>
