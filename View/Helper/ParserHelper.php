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
				$doc[sprintf('#%s', $block['dom_id'])]->html($block['content']);
			}
			$view->output = phpQuery::getDocument($doc->getDocumentID());
		}
		if (!empty($this->_View->viewVars['metadata'])) {
			$metadata = $this->_View->viewVars['metadata'];
			$doc = phpQuery::newDocument($view->output);
			$doc['title']->html($metadata['title']);
			if ($doc['meta[name="description"]']->attr('name')) {
				$doc['meta[name="description"]']->attr('content', $metadata['description']);
			} else {
				$doc['head']->append($this->Html->meta(array('name' => 'description', 'content' => $metadata['description'])));
			}
			if ($doc['meta[name="keywords"]']->attr('name')) {
				$doc['meta[name="keywords"]']->attr('content', $metadata['keywords']);
			} else {
				$doc['head']->append($this->Html->meta(array('name' => 'keywords', 'content' => $metadata['keywords'])));
			}
			$view->output = phpQuery::getDocument($doc->getDocumentID());
		}
		return true;
	}

	public function getMetadata() {
		$view = $this->_View;
		if ($this->_inBlacklist()) {
			return;
		}
		$doc = phpQuery::newDocument($view->output);
		$data = array(
			'title' => trim($doc['title']->html()),
			'description' => trim($doc['meta[name="description"]']->attr('content')),
			'keywords' => trim($doc['meta[name="keywords"]']->attr('content')),
		);
		return $data;
	}
}
