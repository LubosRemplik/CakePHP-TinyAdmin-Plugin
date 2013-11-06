<?php
App::uses('AppController', 'Controller');

class BlocksController extends AppController {

	public $uses = array(
		'TinyAdmin.Block'	
	);

	public function save() {
		$this->autoRender = false;
		if (!empty($this->request->data)) {
			$conditions = array(
				'Block.url' => $this->request->data['url'],
				'Block.dom_id' => $this->request->data['dom_id'],
			);
			$id = $this->Block->field('Block.id', $conditions);
			if ($id) {
				$this->Block->id = $id;
			} else {
				$this->Block->create();
			}
			$this->Block->save($this->request->data);
		}
		return true;
	}
}
