<?php
Configure::load('TinyAdmin.config', 'default', true);
Configure::write('TinyAdmin.Auth', array(
	'loginAction' => array(
		'plugin' => 'tiny_admin',
		'controller' => 'auth',
		'action' => 'login',
	),
	'loginRedirect' => '/',
	'logoutRedirect' => '/',
	'authenticate' => array(
		'TinyAdmin.Admin' => array(
			'userModel' => 'TinyAdmin.User',
			'passwordHasher' => 'Blowfish',
			'fields' => array('username' => 'email'),
		)
	)
));
