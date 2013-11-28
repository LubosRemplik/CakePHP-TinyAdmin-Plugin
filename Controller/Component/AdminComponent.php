<?php

class AdminComponent extends Component {

	public $components = array(
		'Session',
		'Cookie',
	);

	public function __construct(ComponentCollection $collection, $settings = array()) {
		$this->controller = $collection->getController();
		$this->components['Auth'] = Configure::read('TinyAdmin.Auth');
		parent::__construct($collection, array_merge($this->settings, (array)$settings));
	}

	public function initialize(Controller $controller) {
		// set cookie options
		$this->Cookie->key = Configure::read('Security.salt');
		$this->Cookie->httpOnly = true;

		$cookie = $this->Cookie->read('remember_me');
		if (!$this->Auth->loggedIn() && !empty($cookie['email']) && !empty($cookie['password'])) {

			$user = ClassRegistry::init('TinyAdmin.User')->find('first', array(
				'conditions' => array(
					'User.email' => $cookie['email'],
					'User.password' => $cookie['password']
				)
			));

			if ($user && !$this->Auth->login($user)) {
				// destroy session & cookie
				$this->redirect(array(
					'plugin' => 'tiny_admin', 'controller' => 'auth',
					'action' => 'logout'
				));
			}
		}
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
		if ($this->Auth->loggedIn()) {
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
