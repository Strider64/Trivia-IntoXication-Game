<?php

require_once 'lib/includes/utilities.inc.php';

use website_project\trivia_game\OutputQA;

/* Makes it so we don't have to decode the json coming from JQuery */
header('Content-type: application/json');

$gamePlay = new OutputQA();

$id = filter_input(INPUT_POST, 'id');

if (isset($id)) {
    $data = $gamePlay->readQA($id);
    if ($data) {
        $output = $data[0];
        output($output);
    } else {
        $output = 'eof';
        errorOutput($output, 410);
    }
}

/*
 * Set error code then send message to Ajax / JavaScript
 */

function errorOutput($output, $code = 500) {
    http_response_code($code);
    echo json_encode($output);
}

/*
 * If everything validates OK then send success message to Ajax / JavaScript
 */

function output($output) {
    http_response_code(200);
    echo json_encode($output);
}