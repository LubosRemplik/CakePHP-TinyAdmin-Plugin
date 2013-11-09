<?php
App::uses('TinyAdminAppHelper', 'TinyAdmin.View/Helper');
App::import('Vendor', 'TinyAdmin.phpquery/phpQuery/phpQuery');

class ParserHelper extends TinyAdminAppHelper {

	public $helpers = array(
		'Html'
	);

	public function afterLayout($layoutFile) {
		$view = $this->_View;
		if ($this->_inBlacklist()) {
			return;
		}
		if (!empty($this->_View->viewVars['blocks'])) {
			$doc = phpQuery::newDocument($view->output);
			foreach ($this->_View->viewVars['blocks'] as $block) {
				pq($doc[sprintf('#%s', $block['dom_id'])])->html($block['content']);
			}
			$view->output = phpQuery::getDocument($doc->getDocumentID());
		}
		return true;
	}
}
