<?php
App::uses('AppShell', 'Console/Command');

class UserShell extends AppShell {
	
	public $uses = array(
		'TinyAdmin.User'
	);

	public function create() {
		$password = $this->_generatePassword();
		if (!empty($this->args[1])) {
			$password = $this->args[1];
		}
		$data = array(
			'email' => $this->args[0],
			'password' => $password
		);
		$this->User->create();
		if ($this->User->save($data)) {
			$message = __d(
				'tiny_admin', 
				'User login with email %s and password %s created.',
				$data['email'], $data['password']
			);
			$message = sprintf('<info>%s</info>', $message);
			$this->out($message);
		} else {
			$this->err(__d('tiny_admin', 'User has not been created'));
		}
	}

	public function getOptionParser() {
		$parser = parent::getOptionParser();

		$parser->addSubcommand('create', array(
			'help' => __d('tiny_admin', 'Create new user.'),
			'parser' => array(
				'arguments' => array(
					'email' => array(
						'help' => __('User email'),
						'required' => true
					),
					'password' => array(
						'help' => __('User password (skip this argument to auto generate password)'),
					)
				)
			)
		));

		return $parser;
	}

	protected function _generatePassword($length = 8) {
		$allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$password = str_shuffle($allowed);
		$password = substr($password, 0, $length);
		return $password;
	}
}
