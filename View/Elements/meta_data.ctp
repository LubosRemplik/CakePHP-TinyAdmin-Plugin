<?php
echo $this->Html->modal(
	'meta-data',
	implode('', array(
		$this->Form->create('Meta'),
		$this->Form->inputs(array(
			'fieldset' => false,
			'title' => array(
				'label' => __d('tiny_admin', 'Title'),
			),
			'description' => array(
				'label' => __d('tiny_admin', 'Description'),
				'type' => 'textarea',
			),
			'keywords' => array(
				'label' => __d('tiny_admin', 'Keywords'),
				'type' => 'textarea',
			),
		)),
		$this->Form->end(),
	)),
	implode('', array(
		$this->Html->close(),
		$this->Html->tag('h4', __d('tiny_admin', 'Meta data'), array('class' => 'modal-title'))
	)),
	implode('', array(
		$this->Html->button('btn-success', __d('tiny_admin', 'Save changes')),
		$this->Html->button(
			'btn-danger', __d('tiny_admin', 'Close'), 
			array('data-dismiss' => 'modal')
		),
	))
);
