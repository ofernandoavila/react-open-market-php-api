<?php

require_once 'config.php';

$core = new Core();

$core->route->get('/', function () {
    echo '<h2>Welcome to avilamidia API package!</h2>' . '<br>';
    echo '<h4>To start using, create a route at <code>index.php</code>!<h4>';
});