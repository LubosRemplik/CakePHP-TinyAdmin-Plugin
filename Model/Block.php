<?php
App::uses('AppModel', 'Model');

class Block extends AppModel {
	
	public $actsAs = array(
		'Containable'
	);
}
