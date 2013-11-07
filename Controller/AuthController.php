<?php
App::uses('AppController', 'Controller');

class AuthController extends AppController {

	public $uses = array(
		'TinyAdmin.User'	
	);

	public $components = array(
		'Auth' => array(
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
		),
		'Twbs.BootstrapSession',
	);

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				$message = __d('tiny_admin', 'Email or password is incorrect');
				$options = array('class' => 'col-md-9 col-md-offset-3');
				$this->BootstrapSession->flash($message, 'danger', $options);
			}
		}
		$this->set('title_for_layout', 'User login');
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
}
