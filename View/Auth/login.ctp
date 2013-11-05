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
	)
));
echo $this->Form->submit(__d('tiny_admin', 'Login'));
echo $this->Form->end();
