<?php

require_once 'lib/includes/utilities.inc.php';

use website_project\trivia_game\OutputQA;

/* Makes it so we don't have to decode the json coming from JQuery */
header('Content-type: application/json');

//function is_ajax_request() {
//    $server = filter_input(INPUT_SERVER, 'HTTP_X_REQUESTED_WITH', FILTER_SANITIZE_URL);
//    return isset($server) && $server == 'XMLHttpRequest';
//}

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

$q_num = filter_input(INPUT_POST, 'q_num');
$answer = filter_input(INPUT_POST, 'answer');


if (isset($q_num) && isset($answer)) {

    $result = $gamePlay->checkDailyTen($q_num, $answer);

    if ($result) {
        output($result);
    } else {
        $output = ['eof' => TRUE, 'message' => 'There are no more questions'];
        errorOutput($output, 410);
    }
}

/*
 * Set error code then send message to Ajax/JQuery 
 */

function errorOutput($output, $code = 500) {
    http_response_code($code);
    echo json_encode($output);
}

/*
 * If everything validates OK then send success message to Ajax/jQuery 
 */

function output($output) {
    http_response_code(200);
    echo json_encode($output);
}
