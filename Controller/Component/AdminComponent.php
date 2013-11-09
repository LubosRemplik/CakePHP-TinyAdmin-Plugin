<?php

class AdminComponent extends Component {

	public $components = array(
		'Session'
	);

	public function __construct(ComponentCollection $collection, $settings = array()) {
		$this->controller = $collection->getController();
		parent::__construct($collection, array_merge($this->settings, (array)$settings));
	}

	public function beforeRender(Controller $controller) {
		// load helpers
		$blocks = $this->getBlocks();
		$controller->set('blocks', $blocks);
		$controller->helpers[] = 'TinyAdmin.Parser';
		if ($this->Session->check('Auth.User.email')) {
			$controller->helpers[] = 'TinyAdmin.Admin';
		}
	}

	public function getBlocks($url = null) {
		$controller = $this->controller;
		if (!$url) {
			$url = str_replace($controller->request->base, '', $controller->request->here);
		}
		$blocks = ClassRegistry::init('TinyAdmin.Block')->find('all', array(
			'fields' => array('id', 'url', 'dom_id', 'content', 'created'),
			'conditions' => array('url' => $url),
			'order' => array('created' => 'desc'),
			'contain' => false
		));
		if (!empty($blocks)) {
			$parse = $alreadyIn = array();
			foreach ($blocks as $block) {
				$block = $block['Block'];
				if (!in_array(array($block['url'], $block['dom_id']), $alreadyIn)) {
					$parse[] = $block;
					$alreadyIn[] = array($block['url'], $block['dom_id']);
				}
			}
			$parse = Hash::sort($parse, '{n}.created', 'asc');
			return $parse;
		}
		return false;
	}
}
