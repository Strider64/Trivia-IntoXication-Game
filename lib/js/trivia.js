var mainGame = document.getElementById("mainGame");
var question = document.getElementById("question");
var answer1 = document.getElementById('answer1');
var answer2 = document.getElementById('answer2');
var answer3 = document.getElementById('answer3');
var answer4 = document.getElementById('answer4');
var next = document.getElementById("next");
var controls = document.getElementById("controls");
var buttons = document.getElementsByClassName("answers");
var scoring = document.getElementById("scoring");
var correct = document.getElementById("correct");
var wrongText = document.getElementById("wrongText");
var theAnswer = 0;
var id = 1;
var check = "";
var right = 0;
var wrong = 0;
var total = 0;
var timeLeft = 0;
var clock = document.getElementById('clock');
var gameOver = false;

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



function gameover() {
    //console.log("Game Over");
    mainGame.style["height"] = "12.500rem";
    mainGame.innerHTML = '<p id="gameOver">' + right + ' Right and ' + wrong + ' Wrong out of a Total of ' + total + ' Questions</p>';
    next.innerHTML = "Game Over!";
    next.disabled = true;
    next.style['display'] = "block";
    scoring.style['display'] = "none";
    clock.style['display'] = "none";
}

function ajaxRoutine() {
    /*
     *  If answer is undefined or null load question & answers else check user's answer against database table.
     */
    var check =  "id=" + id;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        //console.log('readyState: ' + xhr.readyState, 'xhr.status: ' + xhr.status);
        if (xhr.readyState === 2) {
            //console.log(xhr.status);
            if (xhr.status === 410) {
                gameover();
            }
        }
        if (xhr.readyState === 4 && xhr.status === 200) {
            var info = JSON.parse(xhr.responseText);

            //console.log('xhr.status: ' + xhr.status);
            question.innerHTML = info.question;
            answer1.innerHTML = info.answer1;
            answer2.innerHTML = info.answer2;
            answer3.innerHTML = info.answer3;
            answer4.innerHTML = info.answer4;
            theAnswer = info.correct;

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
    answer = parseInt(this.getAttribute('data-answer'));
    
    if (answer ===  theAnswer) {
        right += 1;
        total += 1;
        buttons[answer - 1].classList.add('correct');
    } else {
        wrong += 1;
        total += 1;
        buttons[theAnswer - 1].classList.add('correct');
        buttons[answer - 1].classList.add('wrong');

    }
    clearInterval(timer);
    next.style["display"] = "block";
    correct.innerHTML = "&#10004; " + right;
    wrongText.innerHTML = "&#88; " + wrong;
    //console.log("You answered ", right, " right and ", wrong, " wrong out of a total ", total, " questions.");

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