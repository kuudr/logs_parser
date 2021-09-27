<?php

use Src\Parser;

require 'src/Parser.php';

$parser = new Parser('logs/logs');

try {
    echo $parser->jsonResponse();
} catch (Exception $e) {
}
