<?php
$this->append('script');
echo $this->Html->script('/tiny_admin/js/jquery-1.10.2.min.js');
echo $this->Html->script('/twbs/bootstrap/dist/js/bootstrap.min.js');
echo $this->Html->script('/tiny_admin/ckeditor/ckeditor.js');
echo $this->Html->script('/tiny_admin/ckeditor/adapters/jquery.js');
echo $this->Html->script('/tiny_admin/js/jquery.cookie.js');
$scriptBlock = <<<EOT
$(function() {
	$('.ta-toggle').click(function(e) {
		e.preventDefault();
		$('.ta-toolbar').toggleClass('active');
		$('i', this).toggleClass('fa-chevron-left fa-chevron-right');
		ckeditor();
		if ($('.ta-toolbar').hasClass('active')) {
			$.cookie('ta-toolbar', true, {expires: 60, path: '/'});
		} else {
			$.cookie('ta-toolbar', false, {expires: 60, path: '/'});
		}
	});
	// cookie
	if ($.cookie('ta-toolbar') == 'true') {
		$('.ta-toolbar i')
			.removeClass('fa-chevron-right')
			.addClass('fa-chevron-left');
		$('.ta-toolbar').addClass('active');
	}
	if ($.cookie('ta-toolbar') == 'false') {
		$('.ta-toolbar i')
			.removeClass('fa-chevron-left')
			.addClass('fa-chevron-right');
		$('.ta-toolbar').removeClass('active');
	}
	ckeditor();
});

function ckeditor() {
	var domIDs = '%s';
	if ($('.ta-toolbar').hasClass('active')) {
		// ckeditor instance
		$(domIDs).attr('contenteditable', 'true');
		var config = {
			allowedContent: true,
			language: 'en',
			toolbar: [
				{ items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
				{ items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
				{ items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
				{ items: [ 'TextColor', 'BGColor' ] },
				{ items: [ 'Sourcedialog'] },
				'/',
				{ items: [ 'Format' ] },
				{ items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
				{ items: [ 'Link', 'Unlink', 'Anchor' ] }, 
				{ items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
			]
		};

		$(domIDs).ckeditor(config);

		// allow save
		for (var i in CKEDITOR.instances) {
			CKEDITOR.instances[i].on('change', function() {
				$('.ta-toolbar .ta-save')
					.removeAttr('disabled')
					.addClass('btn-success')
					.removeClass('btn-default')
					;
				
				$('.ta-toolbar .ta-cancel').show();
			});
		}

		// variables for later use
		var url = '%s';

		// save data
		$('.ta-toolbar .ta-save').click(function(e) {
			e.preventDefault();
			var data = {};
			var i = 0;
			$.each(CKEDITOR.instances, function(key, value ) {
				data[i] = {
					url: url,
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
				$('.ta-toolbar .ta-save')
					.attr('disabled', 'disabled')
					.addClass('btn-default')
					.removeClass('btn-success')
					;
				
				$('.ta-toolbar .ta-cancel').hide();
			});
		}); 

		// cancel action
		$('.ta-toolbar .ta-cancel').click(function(e) {
			e.preventDefault();
			$.ajax({
				type: "POST",
				url: "%s",
				data: {
					url: url
				} 
			}).done(function(data) {
				$.each(JSON.parse(data), function(key, value ) {
					$('#'+value.dom_id).html(value.content);
				});
				$('.ta-toolbar .ta-save')
					.attr('disabled', 'disabled')
					.addClass('btn-default')
					.removeClass('btn-success')
					;
				
				$('.ta-toolbar .ta-cancel').hide();
			});
		}); 
	} else {
		$(domIDs).removeAttr('contenteditable');
		$.each(CKEDITOR.instances, function(key, value ) {
			value.destroy()
		});
	}
}
EOT;
$domIDs = Configure::read('TinyAdmin.domIDs');
$selectors = array();
foreach ($domIDs as $id) {
	$selectors[] = sprintf('#%s', $id);
}
$selectors = implode(', ', $selectors);
$url = str_replace($this->request->base, '', $this->request->here);
$saveUrl = Router::url(array(
	'plugin' => 'tiny_admin', 'controller' => 'blocks', 
	'action' => 'save'
));
$findUrl = Router::url(array(
	'plugin' => 'tiny_admin', 'controller' => 'blocks', 
	'action' => 'find'
));
$scriptBlock = sprintf($scriptBlock, $selectors, $url, $saveUrl, $findUrl);
echo $this->Html->scriptBlock($scriptBlock);
$scriptBlock = '';
$scriptBlock = <<<EOT
$(function() {
	$('#modal-save').click(function(e) {
		$.ajax({
			type: "POST",
			url: $(this).attr('href'),
			data: $('#metadata form').serialize() 
		}).done(function() {
			$('#metadata').modal('hide');
		});
	});
});
EOT;
echo $this->Html->scriptBlock($scriptBlock);
$this->end();
