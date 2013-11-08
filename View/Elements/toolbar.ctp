<?php
$output = implode('', array(
	$this->Html->div('btn-group btn-group-xs', implode('', array(
		$this->Html->link(
			'Save & Publish', '#', 
			array(
				'class' => 'btn btn-default save',
				'disabled' => 'true'
			)
		),
		$this->Html->link(
			'Cancel', '#', 
			array(
				'class' => 'btn btn-danger cancel',
				'style' => 'display: none;'
			),
			'Are you sure?'
		),
	))),
	$this->Html->div('btn-group btn-group-xs', implode('', array(
		$this->Html->link(
			'Meta data', 
			array(
				'plugin' => 'tiny_admin', 'controller' => 'meta_data', 
				'action' => 'edit', $this->request->here
			),
			array('class' => 'btn btn-primary')
		),
		$this->Html->link(
			'Revisions', 
			'#',
			array('class' => 'btn btn-primary')
		),
		$this->Html->link(
			'Pages', 
			'#',
			array('class' => 'btn btn-primary')
		),
		$this->Html->link(
			'File repository', 
			'#',
			array('class' => 'btn btn-primary')
		),
	))),
	$this->Html->div('btn-group btn-group-xs', implode('', array(
		$this->Html->link(
			'Logout', 
			array('plugin' => 'tiny_admin', 'controller' => 'auth', 'action' => 'logout'),
			array('class' => 'btn btn-primary')
		),
	)))
));
$output = $this->Html->div('btn-toolbar', $output);
$output = $this->Html->div('ta-toolbar', $output);
echo $output;
