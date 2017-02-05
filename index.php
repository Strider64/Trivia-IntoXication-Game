<?php
require_once 'lib/includes/utilities.inc.php';
?>
<!DOCTYPE html>
<!--
Trivia Game Version 1.0;
by John Pepp
January 31, 2017
-->
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Trivia IntoXication</title>
        <link rel="stylesheet" href="lib/css/stylesheet.css">
    </head>
    <body>

        <div id="heading">
            <h1>Trivia<span id="toxic">IntoXication</span></h1>
            <h2 id="subheading">Don't Drive Drunk, Play a Game Instead!</h2>

        </div>

        <div id="mainGame">
            <!-- The Question that is pulled in from PHP and JavaScript -->
            <h2 id="question">Question</h2>
            <!-- The Possible Answers that is also pulled in from PHP and pure JavaScript -->
            <button id="answer1" class="answers enable" data-answer="1">&nbsp;</button>
            <button id="answer2" class="answers enable" data-answer="2">&nbsp;</button>
            <button id="answer3" class="answers enable" data-answer="3">&nbsp;</button>
            <button id="answer4" class="answers enable" data-answer="4">&nbsp;</button>
        </div>
        <div id="controls">
            <div id="scoring">
                <h2><span id="correct">&#10004;  0</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="wrongText">&#88; 0</span></h2>
            </div>
            <button id="next">Next</button>
            <div id="timer">
                <h2 id="clock">30 seconds</h2>
            </div>
        </div>
        <script src="lib/js/trivia.js"></script>
    </body>
</html>
