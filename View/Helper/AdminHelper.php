<?php
App::uses('AppHelper', 'View/Helper');

class AdminHelper extends AppHelper {

	public $helpers = array(
		'Html'
	);

	public function toolbar() {
		$view = $this->_View;
		$view->element('TinyAdmin.toolbar_css');
		$view->element('TinyAdmin.toolbar_js');
		$toolbar = $view->element('TinyAdmin.toolbar');
		if (preg_match('#</body>#', $view->output)) {
			$view->output = preg_replace('#</body>#', $toolbar . "\n</body>", $view->output, 1);
		}
		return true;
	}

	public function beforeRender($layoutFile) {
		$this->toolbar();
	}
}
