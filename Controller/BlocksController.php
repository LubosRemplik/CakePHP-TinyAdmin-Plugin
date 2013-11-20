<?php
App::uses('AppController', 'Controller');

class BlocksController extends AppController {

	public $uses = array(
		'TinyAdmin.Block'	
	);

	public function save() {
		$this->autoRender = false;
		if (!empty($this->request->data)) {
			$data = $this->request->data;
			$this->Block->saveMany($data);
		}
		return true;
	}

	public function find() {
		$this->autoRender = false;
		if (!empty($this->request->data['url'])) {
			$url = $this->request->data['url'];
			$data = $this->Admin->getBlocks($url);
			return json_encode($data);
		}
		return true;
	}

	public function load() {
		$this->autoRender = false;
		if (
			!empty($this->request->data['url']) &&
			!empty($this->request->data['created'])
		) {
			$url = $this->request->data['url'];
			$created = $this->request->data['created'];
			$data = $this->Admin->getBlocks($url, $created);
			return json_encode($data);
		}
		return true;
	}
}
