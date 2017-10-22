<?php

namespace RedBeanPHP;


$format = 0;


switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $the_request = &$_GET;
        break;
    case 'POST':
        $the_request = &$_POST;
        break;
}

if (isset($the_request['format'])) {
    $format = $the_request['format'];
}

$parser = ParserFactory::GetParser( $format );
$parser->Parse();