<?php
$this->append('script');
echo $this->Html->script('/tiny_admin/aloha/lib/require.js');
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

	$('.aloha img').live('dblclick', function(event) {
		if (confirm("Are you sure you want to delete this image?")) {
			event.preventDefault();
			$(this).remove();
		}
		return false;
	});

	Aloha.bind('aloha-editable-deactivated', function(event, editable) {
		$.ajax({
			type: "POST",
			url: "%s",
			data: {
				dom_id: Aloha.activeEditable.obj[0].id,
				url: '%s', 
				content: Aloha.activeEditable.getContents()
			}
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
$scriptBlock = sprintf($scriptBlock, $selectors, $requestUrl, $url);
echo $this->Html->scriptBlock($scriptBlock);
$this->end();
