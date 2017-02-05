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

        <div id="heading" class="rounded">
            <h1>Trivia<span id="toxic">IntoXication</span></h1>
            <h2 id="subheading">Don't Drive Drunk, Play this Game Instead!</h2>
        </div>

        <div id="mainGame" class="top-rounded">
            <div id="screen">
                <!-- The Question that is pulled in from PHP and JavaScript -->
                <h2 id="question">Question</h2>
            </div>
            <!-- The Possible Answers that is also pulled in from PHP and pure JavaScript -->
            <button id="answer1" class="answers enable" data-answer="1">&nbsp;</button>
            <button id="answer2" class="answers enable" data-answer="2">&nbsp;</button>
            <button id="answer3" class="answers enable" data-answer="3">&nbsp;</button>
            <button id="answer4" class="answers enable" data-answer="4">&nbsp;</button>
        </div>
        <div id="controls" class="bottom-rounded one-edge-shadow">
            <div id="scoring">
                <h2><span id="correct">&#10004;  0</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="wrongText">&#88; 0</span></h2>
            </div>
            <button id="next" class="rounded shadow">Next</button>
            <div id="timer">
                <h2 id="clock">30 seconds</h2>
            </div>
        </div>
        <div id="footer" class="rounded">
            <p class="footer-text">&copy;<?php echo date("Y"); ?> John R. Pepp</p>
        </div>
        <script src="lib/js/trivia.js"></script>
    </body>
</html>
