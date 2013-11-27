<?php
echo $this->Form->create('User');
echo $this->Form->inputs(array(
	'fieldset' => false,
	'email' => array(
		'label' => __d('tiny_admin', 'Email'),
	),
	'password' => array(
		'label' => __d('tiny_admin', 'Password'),
		'type' => 'password',
	),
	'remember_me' => array(
		'label' => __d('tiny_admin', 'Remember me on this computer'),
		'type' => 'checkbox',
	)
));
echo $this->Form->submit(__d('tiny_admin', 'Login'));
echo $this->Form->end();
