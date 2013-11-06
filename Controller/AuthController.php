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
				'Form' => array(
					'userModel' => 'TinyAdmin.User',
					'passwordHasher' => 'Blowfish',
					'fields' => array('username' => 'email'),
				)
			)
		),
		'Session',
	);

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Session->setFlash(__d(
					'tiny_admin', 
					'Email or password is incorrect'
				));
			}
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
}
