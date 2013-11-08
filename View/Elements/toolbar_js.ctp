<?php
$this->append('script');
echo $this->Html->script('//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js');
echo $this->Html->script('/tiny_admin/js/tiny_admin.js');
echo $this->Html->script('/tiny_admin/aloha/lib/require.js');
$scriptBlock = <<<EOT
var Aloha = window.Aloha || ( window.Aloha = {} );

Aloha.settings = {
	locale: 'en',
	plugins: {
		format: {
			config : ['b', 'i', 'del', 'sub', 'sup', 'p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'pre', 'removeFormat']
		}
	}
};
EOT;
echo $this->Html->scriptBlock($scriptBlock);
echo $this->Html->script('/tiny_admin/aloha/lib/aloha.js', array(
	'data-aloha-plugins' => 
		'common/ui,
		common/format,
		common/list,
		common/table,
		common/image,
		common/autoparagraph,
		common/undo,
		common/highlighteditables,
		common/link'
));
$scriptBlock = <<<EOT
Aloha.ready( function() {
	Aloha.jQuery('%s').aloha();

	// images deletion
	$('.aloha img').live('dblclick', function(event) {
		if (confirm("Are you sure you want to delete this image?")) {
			event.preventDefault();
			$(this).remove();
		}
		return false;
	});

	// activate save & publish button
	Aloha.bind('aloha-editable-activated', function(event, editable) {
		$('.ta-toolbar .save')
			.removeAttr('disabled')
			.addClass('btn-success')
			.removeClass('btn-default')
			;
		
		$('.ta-toolbar .cancel').show();
	});

	// saving data
	$('.ta-toolbar .save').click(function(e) {
		e.preventDefault();
		var data = {};
		$.each(Aloha.editables, function(key, value ) {
			data[key] = {
				url: '%s',
				dom_id: value.obj[0].id,
				content: value.getContents()
			}
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
