<?php
App::uses('TinyAdminAppModel', 'TinyAdmin.Model');

class Block extends TinyAdminAppModel {
	
	public $actsAs = array(
		'Containable'
	);
}
