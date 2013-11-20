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
		// blocks
		$blocks = $this->getBlocks();
		$controller->set('blocks', $blocks);
		// metadata
		$metadata = $this->getMetadata();
		$controller->set('metadata', $metadata);

		// helpers
		$controller->helpers[] = 'TinyAdmin.Parser';
		$controller->helpers['Form'] = array(
			'className' => 'Twbs.TwbsForm'
		);
		$controller->helpers['Html'] = array(
			'className' => 'Twbs.TwbsHtml'
		);
		if ($this->Session->check('Auth.User.email')) {
			$controller->helpers[] = 'TinyAdmin.Admin';
		}
	}

	public function getBlocks($url = null, $created = null) {
		$controller = $this->controller;
		if (!$url) {
			$url = str_replace($controller->request->base, '', $controller->request->here);
		}
		$conditions = array('url' => $url);
		if ($created) {
			$conditions['created'] = $created;
		}
		$blocks = ClassRegistry::init('TinyAdmin.Block')->find('all', array(
			'fields' => array('id', 'url', 'dom_id', 'content', 'created'),
			'conditions' => $conditions,
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

	public function getMetadata($url = null) {
		$controller = $this->controller;
		if (!$url) {
			$url = str_replace($controller->request->base, '', $controller->request->here);
		}
		$data = ClassRegistry::init('TinyAdmin.Metadata')->find('first', array(
			'conditions' => array('url' => $url),
			'contain' => false
		));
		if (empty($data)) {
			return false;
		}
		return $data['Metadata'];
	}
}
