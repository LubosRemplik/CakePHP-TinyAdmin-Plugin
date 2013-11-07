<?php
App::uses('TinyAdminAppHelper', 'TinyAdmin.View/Helper');

class AdminHelper extends TinyAdminAppHelper {

	public $helpers = array(
		'Html'
	);

	public function toolbar() {
		$view = $this->_View;
		if ($this->_inBlacklist()) {
			return;
		}
		$toolbar = $view->element('TinyAdmin.toolbar');
		if (preg_match('#</body>#', $view->output)) {
			$view->output = preg_replace('#</body>#', $toolbar . "\n</body>", $view->output, 1);
		}
		return true;
	}

	public function beforeRender($layoutFile) {
		$view = $this->_View;
		if ($this->_inBlacklist()) {
			return;
		}
		$view->element('TinyAdmin.toolbar_css');
		$view->element('TinyAdmin.toolbar_js');
	}

	public function afterLayout($layoutFile) {
		$this->toolbar();
	}
}
