<?php
App::uses('TinyAdminAppModel', 'TinyAdmin.Model');

class Metadata extends TinyAdminAppModel {
	
	public $actsAs = array(
		'Containable'
	);

	public $useTable = 'metadata';
}
