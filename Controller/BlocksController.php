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
}
