<div class="index large-4 medium-4 large-offset-4 medium-offsest-4 columns">
	<div class="panel"> 
		<h1 class="text-center">Rejestracja</h1>
		<?= $this->Form->create($user, array( 'id' => 'registerForm', 'class' => 'one-click-form')) ?>
		<?= $this->Form->input('email') ?>
		<?= $this->Form->input('password', ['label' => 'Hasło']) ?>
		<?= $this->Form->input('confirm_password', ['type' => 'password','label' => 'Powtórz hasło'] ) ?>
		<?= $this->Form->button('Zarejestruj się', array( 'name' => 'submitButton'), array( 'class' => 'button')) ?>
		<?= $this->Html->link('Wróć', array('controller' => 'Users', 'action' => 'login'), array( 'class' => 'button')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>