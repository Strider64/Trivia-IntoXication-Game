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
        <title>Trivia Quiz with JavaScript</title>
        <link rel="stylesheet" href="lib/css/stylesheet.css">
    </head>
    <body>

        <div id="heading">
            <h1>Trivia Quiz with <span>JavaScript </span></h1>

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
        <script>
            var question = document.getElementById("question");
            var answer1 = document.getElementById('answer1');
            var answer2 = document.getElementById('answer2');
            var answer3 = document.getElementById('answer3');
            var answer4 = document.getElementById('answer4');
            var next = document.getElementById("next");
            var controls = document.getElementById("controls");
            var buttons = document.getElementsByClassName("answers");
            var correct = document.getElementById("correct");
            var wrongText = document.getElementById("wrongText");
            var id = 1;
            var check = "";
            var right = 0;
            var wrong = 0;
            var total = 0;
            var timeLeft = 0;
            var clock = document.getElementById('clock');

            var timer = null;

            function startTimer() {
                timeLeft = 30;
                timer = setInterval(countdown, 1000);
            }

            function countdown() {
                var counter = 0;
                if (timeLeft === 0) {
                    clearTimeout(timer);
                    clock.style['color'] = "red";
                    clock.innerHTML = '00 seconds';
                    ajaxRoutine(5);
                } else {
                    if (timeLeft < 10) {
                        counter = '0' + timeLeft;
                    } else {
                        counter = timeLeft;
                    }
                    clock.innerHTML = counter + ' seconds';
                    timeLeft--;
                }
            }

            function ajaxRoutine(answer = null) {
                /*
                 *  If answer is undefined or null load question & answers else check user's answer against database table.
                 */
                var check = (typeof answer === 'undefined' || answer === null) ? "id=" + id : "q_num=" + id + "&answer=" + answer;

                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    console.log('readyState: ' + xhr.readyState, 'xhr.status: ' + xhr.status);
                    if (xhr.status === 410) {
                        console.log("Game Over");
                        next.innerHTML = "Game Over!";
                        next.disabled = true;
                        next.style['display'] = "block";
                    }
                    if (xhr.readyState === 2) {
                    }
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var info = JSON.parse(xhr.responseText);
                        //console.log(info);
                        if (info.question) {
                            question.innerHTML = info.question;
                            answer1.innerHTML = info.answer1;
                            answer2.innerHTML = info.answer2;
                            answer3.innerHTML = info.answer3;
                            answer4.innerHTML = info.answer4;
                        } else {
                            if (info.correct) {
                                right += 1;
                                total += 1;
                                buttons[info.right_answer - 1].classList.add('correct');
                            } else {
                                wrong += 1;
                                total += 1;
                                buttons[info.right_answer - 1].classList.add('correct');
                                if (info.user_answer !== 5) {
                                    buttons[info.user_answer - 1].classList.add('wrong');
                                }
                            }
                            clearInterval(timer);
                            next.style["display"] = "block";
                            correct.innerHTML = "&#10004; " + right;
                            wrongText.innerHTML = "&#88; " + wrong;
                            //console.log("You answered ", right, " right and ", wrong, " wrong out of a total ", total, " questions.");
                        }
                    }
                }; // End of Ready State:

                xhr.open('POST', 'trivia.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.send(check);
            }

            startTimer();
            ajaxRoutine();
            next.style["display"] = "none";


            function disableButtons() {
                for (i = 0; i < buttons.length; i++) {
                    buttons.item(i).disabled = true;
                    buttons[i].classList.remove('enable'); // Disable hover feature by removing a class:
                }
            }

            function enableButtons() {
                for (i = 0; i < buttons.length; i++) {
                    buttons.item(i).disabled = false; // Make buttons clickable again:
                    buttons[i].classList.remove('correct', 'wrong'); // Remove previous results by dropping classes:
                    buttons[i].classList.add('enable'); // Enable hover feature by adding a class:
                }

            }

            function checkAnswer() {
                disableButtons(); // Disable the answer buttons:
                answer = this.getAttribute('data-answer');
                ajaxRoutine(answer);

            }

            for (i = 0; i < buttons.length; i++) {
                buttons.item(i).addEventListener("click", checkAnswer);
            }

            function resetGame() {
                clock.style['color'] = "green";
                next.style['display'] = "none";
                enableButtons(); // Restore buttons back to normal function:
                id += 1;
                answer = null;
                startTimer();
                ajaxRoutine();

            }

            next.addEventListener("click", resetGame); // Add next button addEventListener to the game:


        </script>
    </body>
</html>
