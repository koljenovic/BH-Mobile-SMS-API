<?php

require_once 'messageform.php';

// format 061xxxxxx ili 061xxxxxx
$broj = '';
$poruka = 'Test: ' . time();

$x = new MessageForm($broj, $poruka);
$x->dispatch();