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
		$url = str_replace($this->request->base, '', $this->request->here);
		$blocks = ClassRegistry::init('TinyAdmin.Block')->find('all', array(
			'fields' => array('id', 'url', 'dom_id', 'content', 'created'),
			'conditions' => array('url' => $url),
			'order' => array('created' => 'desc'),
			'contain' => false
		));
		if (!empty($blocks)) {
			$doc = phpQuery::newDocument($view->output);
			$parse = $alreadyIn = array();
			foreach ($blocks as $block) {
				$block = $block['Block'];
				if (!in_array(array($block['url'], $block['dom_id']), $alreadyIn)) {
					$parse[] = $block;
					$alreadyIn[] = array($block['url'], $block['dom_id']);
				}
			}
			$parse = Hash::sort($parse, '{n}.created', 'asc');
			foreach ($parse as $block) {
				pq($doc[sprintf('#%s', $block['dom_id'])])->html($block['content']);
			}
			$view->output = phpQuery::getDocument($doc->getDocumentID());
		}
		return true;
	}
}
