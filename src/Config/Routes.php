<?php
$routes->group('log-viewer', function($routes) {
    $routes->get('/', 'LogViewerController::index');
    $routes->get('export', 'LogViewerController::export');
});