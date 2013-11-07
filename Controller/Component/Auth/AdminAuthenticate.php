<?php
App::uses('FormAuthenticate', 'Controller/Component/Auth');

class AdminAuthenticate extends FormAuthenticate {

	public function authenticate(CakeRequest $request, CakeResponse $response) {
		$superadmin = Configure::read('TinyAdmin.superadmin');			
		if ($superadmin) {
			$userModel = $this->settings['userModel'];
			list(, $model) = pluginSplit($userModel);
			$usernameField = $this->settings['fields']['username'];
			$passwordField = $this->settings['fields']['password'];
			if (
				$superadmin['email'] == $request->data[$model][$usernameField] &&
				$superadmin['password'] == $request->data[$model][$passwordField]
			) {
				unset($superadmin['password']);
				return $superadmin;
			}
		}
		return parent::authenticate($request, $response); 
	}

}
