<?php
Router::connect(
	'/tinyadmin',
    array('plugin' => 'tiny_admin', 'controller' => 'auth', 'action' => 'login')
);

Router::connect(
	'/tinyadmin/:controller/:action/*',
    array('plugin' => 'tiny_admin')
);
