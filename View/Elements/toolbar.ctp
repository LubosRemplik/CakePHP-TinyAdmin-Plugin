<?php
$output = array(
	$this->Html->link('Save & Publish', '#', array('class' => 'save')),
	$this->Html->link(
		'Edit meta data', 
		array(
			'plugin' => 'tiny_admin', 'controller' => 'meta_data', 
			'action' => 'edit', $this->request->here
		), 
		array('class' => 'save')
	),
);
$output = $this->Html->div('ta-toolbar', implode('', $output));
echo $output;
