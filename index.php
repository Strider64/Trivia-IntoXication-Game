<?php
require_once 'lib/includes/utilities.inc.php';

use website_project\trivia_game\GenerateGame as Generate;

$dailyTen = [];
$categories = ['movie', 'space'];
$generate = new Generate();

$result = $generate->checkTriviaTable();

if ($result) {
    $data = $generate->readTriviaQuestions($categories);

    if ($data) {
        $dailyTen = $generate->dailyQuestions($data);
        $generate->updateTriviaQuestions($dailyTen);
    }
}
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
        <meta name="viewport" content="initial-scale=1.0, width=device-width" />
        <title>Trivia IntoXication</title>
        <link rel="stylesheet" href="lib/css/stylesheet.css">
    </head>
    <body>
        <div id="container">
            <div id="heading">
                <h1>Trivia<span id="toxic">IntoXication</span></h1>
                <h2 id="subheading">Don't Drive Drunk, Play this Game Instead!</h2>
            </div>

            <div id="mainGame">
                <div id="screen">
                    <!-- The Question that is pulled in from PHP and JavaScript -->
                    <h2 id="question">Question</h2>
                </div>
                <!-- The Possible Answers that is also pulled in from PHP and pure JavaScript -->
                <button id="answer1" class="answers enable" data-answer="1">&nbsp;</button>
                <button id="answer2" class="answers enable" data-answer="2">&nbsp;</button>
                <button id="answer3" class="answers enable" data-answer="3">&nbsp;</button>
                <button id="answer4" class="answers enable" data-answer="4">&nbsp;</button>

                <div id="scoring">
                    <h2><span id="correct">&#10004;  0</span><span id="wrongText">&#10004; 0</span></h2>
                </div>

                <div id="display">
                    <h2 id="clock">&nbsp;</h2>
                    <button id="next">Next</button>
                </div>


            </div>

            <div id="info">
                <p>I have decided to chuck jQuery to the trash bin and convert this game over to pure JavaScript (some call it vanilla JavaScript), so when I eventually deem this HTML/CSS game worthy enough for a tutorial it will be more portable. It should be also easier for people to write javascript, for in my opinion learning javascript makes it easier to understand and there really is not that much more code added.</p>
            </div>
            
            <div id="myFooter">
                <p class="footer-text">&copy;<?php echo date("Y"); ?> John R. Pepp</p>
            </div>
            
        </div>
        <script src="lib/js/trivia.js"></script>
    </body>
</html>