<?php
App::uses('AppHelper', 'View/Helper');

class TinyAdminAppHelper extends AppHelper {

	public $helpers = array(
		'Html'
	);

	protected function _inBlacklist() {
		$blacklist = Configure::read('TinyAdmin.blacklist');
		if (!$blacklist) {
			return false;
		}
		$result = array();
		foreach ($blacklist as $url) {
			$result[] = $this->Html->url($url);
		}
		return in_array($this->request->here, $result);
	}
}
