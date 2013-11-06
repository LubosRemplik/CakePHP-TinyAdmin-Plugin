<?php
App::uses('AppHelper', 'View/Helper');

class ToolbarHelper extends AppHelper {

	public $helpers = array(
		'Html'
	);

	public function display() {
		$view = $this->_View;
		$view->element('TinyAdmin.toolbar_css');
		$view->element('TinyAdmin.toolbar_js');
		$toolbar = $view->element('TinyAdmin.toolbar');
		if (preg_match('#</body>#', $view->output)) {
			$view->output = preg_replace('#</body>#', $toolbar . "\n</body>", $view->output, 1);
		}
	}

	public function beforeRender($layoutFile) {
		$this->display();
	}
}
