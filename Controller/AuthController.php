<?php
App::uses('AppController', 'Controller');

class AuthController extends AppController {

	public $uses = array(
		'TinyAdmin.User'	
	);

	public $components = array(
		'TinyAdmin.Admin',
		'Twbs.TwbsSession',
		'Cookie',
	);

	public function __construct($request = null, $response = null) {
		$this->components['Auth'] = Configure::read('TinyAdmin.Auth');
		parent::__construct($request, $response);
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				if (
					$this->request->data['User']['remember_me'] == 1 && 
					$this->Auth->user('id')
				) {
					$User = ClassRegistry::init('TinyAdmin.User');
					$User->id = $this->Auth->user('id');
					$password = $User->field('password');
					$password = Security::hash(
						$this->request->data['User']['password'], 
						'blowfish', $password
					);
					$cookie = array(
						'email' => $this->request->data['User']['email'],
						'password' => $password
					);
					$this->Cookie->write('remember_me', $cookie, true, '60 days');
				}
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				$message = __d('tiny_admin', 'Email or password is incorrect');
				$options = array('class' => 'col-md-9 col-md-offset-3');
				$this->TwbsSession->flash($message, 'danger', $options);
			}
		}
		$this->set('title_for_layout', 'User login');
	}

	public function logout() {
		$this->Cookie->delete('remember_me');
		return $this->redirect($this->Auth->logout());
	}
}
