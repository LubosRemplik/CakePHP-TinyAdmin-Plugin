<?php
$this->append('script');
echo $this->Html->script('/tiny_admin/js/jquery-1.10.2.min.js');
echo $this->Html->script('/twbs/bootstrap/dist/js/bootstrap.min.js');
echo $this->Html->script('/tiny_admin/ckeditor/ckeditor.js');
echo $this->Html->script('/tiny_admin/ckeditor/adapters/jquery.js');
echo $this->Html->script('/tiny_admin/js/jquery.cookie.js');
$scriptBlock = <<<EOT
$(function() {
	// ckeditor instance
	var domIDs = '%s';
	$(domIDs).attr('contenteditable', 'true');
	var config = {
		allowedContent: true
	};
	$(domIDs).ckeditor(config);

	// allow save
	for (var i in CKEDITOR.instances) {
	    CKEDITOR.instances[i].on('change', function() {
			$('.ta-toolbar .save')
				.removeAttr('disabled')
				.addClass('btn-success')
				.removeClass('btn-default')
				;
			
			$('.ta-toolbar .cancel').show();
		});
	}

	// save data
	$('.ta-toolbar .save').click(function(e) {
		e.preventDefault();
		var data = {};
		var i = 0;
		$.each(CKEDITOR.instances, function(key, value ) {
			data[i] = {
				url: '%s',
				dom_id: value.container.getId(),
				content: value.getData()
			}
			i++;
		});
		$.ajax({
			type: "POST",
			url: "%s",
			data: data 
		}).done(function() {
			$('.ta-toolbar .save')
				.attr('disabled', 'disabled')
				.addClass('btn-default')
				.removeClass('btn-success')
				;
			
			$('.ta-toolbar .cancel').hide();
		});
	}); 
});
EOT;
$domIDs = Configure::read('TinyAdmin.domIDs');
$selectors = array();
foreach ($domIDs as $id) {
	$selectors[] = sprintf('#%s', $id);
}
$selectors = implode(', ', $selectors);
$url = str_replace($this->request->base, '', $this->request->here);
$requestUrl = Router::url(array(
	'plugin' => 'tiny_admin', 'controller' => 'blocks', 
	'action' => 'save'
));
$scriptBlock = sprintf($scriptBlock, $selectors, $url, $requestUrl);
echo $this->Html->scriptBlock($scriptBlock);
$this->end();
