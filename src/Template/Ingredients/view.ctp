<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <h1><?= $this->Html->link(__('Menu'), '/', ['class' => 'sidebar-element'])?></h1>
        <div class="col-sm-12 sidebar-element">
            <h3><?= $this->Html->link(__('List ingredeints'), ['controller' => 'Ingredients', 'action' => 'index']) ?></h3>
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
                <h3><?= __('Dishes with '.h($ingredient->name.':')) ?></h3>
                <div class="related">
                    <?php if (!empty($ingredient->components)): ?>
                    <table class='table'>
                        <?php foreach ($ingredient->components as $component): ?>
                        <tr>
                            <td><?= $this->Html->link(__(h($component->dish['name'])), ['controller' => 'Dishes', 'action' => 'view', $component->dish['id']]) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <?php endif; ?>
                </div>
             </div>
         </div>
        <div class="col-xs-2 col-sm-2 col-md-6 main nopadding">
            <div class="main-rightside-img"></div>
        </div>
     </div>
</div>
