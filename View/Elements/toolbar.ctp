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
$output .= <<<EOT
<!-- Modal -->
<div class="modal fade" id="meta-data" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
EOT;
$output = $this->Html->div('ta-toolbar active', $output);
echo $output;
