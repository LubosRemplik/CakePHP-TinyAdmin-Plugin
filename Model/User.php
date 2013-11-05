<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	
	public $actsAs = array(
		'Containable'
	);

	public function beforeSave($options = array()) {
        if (!empty($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
			$password = $this->data[$this->alias]['password'];
			$password = $passwordHasher->hash($password);
            $this->data[$this->alias]['password'] = $password;
        }
		return true;
	}
}
