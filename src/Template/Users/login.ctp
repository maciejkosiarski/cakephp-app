<div class="main-login">
    <div class="container">
        <?= $this->Form->create(null, ['class' => 'form-signin main-login-form']) ?>
            <div class="form-group">
                <label for="daytime_id">Email</label>
                <?= $this->Form->input('email', ['class' => 'form-control', 'label' => false]) ?>
            </div>
            <div class="form-group">
                <label for="daytime_id">Password</label>
                <?= $this->Form->input('password', ['class' => 'form-control', 'label' => false]) ?>
            </div>
            <?= $this->Form->button('Login', ['class' => 'btn main-button']) ?>
            <li>Nie masz konta? <?= $this->Html->link(__('Zarejestruj się.'), ['controller' => 'users', 'action' => 'register']) ?></li>
            <?= $this->Form->end() ?>
    </div>	
</div>