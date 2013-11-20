<?php
$url = str_replace($this->request->base, '', $this->request->here);
$optionsData = ClassRegistry::init('TinyAdmin.Block')->find('list', array(
	'fields' => array('created', 'id'),
	'conditions' => array('url' => $url),
	'order' => array('created' => 'desc'),
	'group' => 'created',
	'contain' => false
));
$options = array();
foreach ($optionsData as $created => $id) {
	$options[$created] = sprintf(
		'revision #%s, created at %s',
		$id, $this->Time->format('j M y, H:i:s', $created)
	);
}
echo $this->Html->modal(
	'revisions',
	implode('', array(
		$this->Form->create(false),
		$this->Form->inputs(array(
			'fieldset' => false,
			'url' => array(
				'type' => 'hidden',
				'value' => $url
			),
			'created' => array(
				'label' => false,
				'type' => 'select',
				'multiple' => true,
				'size' => 10,
				'options' => $options,
			),
		)),
		$this->Form->end(),
	)),
	implode('', array(
		$this->Html->close(),
		$this->Html->tag('h4', __d('tiny_admin', 'Revisions'), array('class' => 'modal-title'))
	)),
	implode('', array(
		$this->Html->button(
			'btn-success', __d('tiny_admin', 'Load revision'), 
			array(
				'id' => 'modal-load',
				'href' => $this->Html->url(array(
					'plugin' => 'tiny_admin',
					'controller' => 'blocks',
					'action' => 'load'
				))
			)
		),
		$this->Html->button(
			'btn-danger', __d('tiny_admin', 'Close'), 
			array('data-dismiss' => 'modal')
		),
	))
);
