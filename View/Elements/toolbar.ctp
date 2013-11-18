<?php
$output = implode('', array(
	$this->Html->div('btn-group btn-group-xs', implode('', array(
		$this->Html->link(
			'Save & Publish', '#', 
			array(
				'class' => 'btn btn-default ta-save',
				'disabled' => 'true'
			)
		),
		$this->Html->link(
			'Cancel', '#', 
			array(
				'class' => 'btn btn-danger ta-cancel',
				'style' => 'display: none;'
			),
			'Are you sure?'
		),
	))),
	$this->Html->div('btn-group btn-group-xs', implode('', array(
		$this->Html->link(
			'Meta data', 
			'#',
			//array(
				//'plugin' => 'tiny_admin', 'controller' => 'meta_data', 
				//'action' => 'edit', $this->request->here
			//),
			array(
				'data-toggle' => 'modal',
				'data-target' => '#meta-data',
				'class' => 'btn btn-primary'
			)
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
	))),
	$this->Html->div('btn-group btn-group-xs', implode('', array(
		$this->Html->link(
			'Logout', 
			array('plugin' => 'tiny_admin', 'controller' => 'auth', 'action' => 'logout'),
			array('class' => 'btn btn-primary')
		),
	))),
));
$output = implode('', array(
	$this->Html->div('btn-toolbar', $output),
	$this->Html->link(
		$this->Html->tag('i', '', array('class' => 'fa fa-chevron-left')),
		'#',
		array('escape' => false, 'class' => 'ta-toggle')
	)
));
$output .= $this->element('TinyAdmin.meta_data');
$output = $this->Html->div('ta-toolbar active', $output);
echo $output;
