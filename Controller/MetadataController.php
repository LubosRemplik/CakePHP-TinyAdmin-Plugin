<?php
App::uses('AppController', 'Controller');

class MetadataController extends AppController {

	public $uses = array(
		'TinyAdmin.Metadata'	
	);

	public function save() {
		$this->autoRender = false;
		if (!empty($this->request->data)) {
			$data = $this->request->data;
			if ($found = $this->Metadata->findByUrl($data['Metadata']['url'])) {
				$this->Metadata->id = $found['Metadata']['id'];
			} else {
				$this->Metadata->create();
			}
			$this->Metadata->save($data);
		}
		return true;
	}

}
