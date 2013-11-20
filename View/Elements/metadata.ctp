<?php
if (empty($metadata)) {
	$metadata = $this->Parser->getMetadata();
}
$url = str_replace($this->request->base, '', $this->request->here);
echo $this->Html->modal(
	'metadata',
	implode('', array(
		$this->Form->create('Metadata'),
		$this->Form->inputs(array(
			'fieldset' => false,
			'url' => array(
				'type' => 'hidden',
				'value' => $url
			),
			'title' => array(
				'label' => __d('tiny_admin', 'Title'),
				'value' => $metadata['title'],
			),
			'description' => array(
				'label' => __d('tiny_admin', 'Description'),
				'type' => 'textarea',
				'value' => $metadata['description'],
			),
			'keywords' => array(
				'label' => __d('tiny_admin', 'Keywords'),
				'type' => 'textarea',
				'value' => $metadata['keywords'],
			),
		)),
		$this->Form->end(),
	)),
	implode('', array(
		$this->Html->close(),
		$this->Html->tag('h4', __d('tiny_admin', 'Meta data'), array('class' => 'modal-title'))
	)),
	implode('', array(
		$this->Html->button(
			'btn-success', __d('tiny_admin', 'Save changes'), 
			array(
				'id' => 'modal-save',
				'href' => $this->Html->url(array(
					'plugin' => 'tiny_admin',
					'controller' => 'metadata',
					'action' => 'save'
				))
			)
		),
		$this->Html->button(
			'btn-danger', __d('tiny_admin', 'Close'), 
			array('data-dismiss' => 'modal')
		),
	))
);
