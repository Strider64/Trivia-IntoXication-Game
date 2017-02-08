var mainGame = document.getElementById('mainGame');

var screen = document.createElement('div');
var screenId = document.createAttribute('id');
screenId.value = "screen";
screen.setAttributeNode(screenId);
var question = document.createElement('h2');
var questionId = document.createAttribute('id');
questionId.value = "question";
question.setAttributeNode(questionId);

var button_1 = document.createElement("button");
var buttonId_1 = document.createAttribute("id");
var buttonClass_1 = document.createAttribute("class");
var buttonData_1 = document.createAttribute("data-answer");
buttonId_1.value = "answer1";
buttonClass_1.value = "answers enable";
buttonData_1.value = "1";
button_1.setAttributeNode(buttonId_1);
button_1.setAttributeNode(buttonClass_1);
button_1.setAttributeNode(buttonData_1);

var button_2 = document.createElement("button");
var buttonId_2 = document.createAttribute("id");
var buttonClass_2 = document.createAttribute("class");
var buttonData_2 = document.createAttribute("data-answer");
buttonId_2.value = "answer2";
buttonClass_2.value = "answers enable";
buttonData_2.value = "2";
button_2.setAttributeNode(buttonId_2);
button_2.setAttributeNode(buttonClass_2);
button_2.setAttributeNode(buttonData_2);

var button_3 = document.createElement("button");
var buttonId_3 = document.createAttribute("id");
var buttonClass_3 = document.createAttribute("class");
var buttonData_3 = document.createAttribute("data-answer");
buttonId_3.value = "answer3";
buttonClass_3.value = "answers enable";
buttonData_3.value = "3";
button_3.setAttributeNode(buttonId_3);
button_3.setAttributeNode(buttonClass_3);
button_3.setAttributeNode(buttonData_3);

var button_4 = document.createElement("button");
var buttonId_4 = document.createAttribute("id");
var buttonClass_4 = document.createAttribute("class");
var buttonData_4 = document.createAttribute("data-answer");
buttonId_4.value = "answer4";
buttonClass_4.value = "answers enable";
buttonData_4.value = "4";
button_4.setAttributeNode(buttonId_4);
button_4.setAttributeNode(buttonClass_4);
button_4.setAttributeNode(buttonData_4)

var scoring = document.createElement('div');
var scoringId = document.createAttribute('id');
scoringId.value = "scoring";
scoring.setAttributeNode(scoringId);

var display = document.createElement('div');
var displayId = document.createAttribute('id');
displayId.value = "display";
display.setAttributeNode(displayId);


mainGame.appendChild(screen);
screen.appendChild(question);
mainGame.appendChild(button_1);
mainGame.appendChild(button_2);
mainGame.appendChild(button_3);
mainGame.appendChild(button_4);
mainGame.appendChild(scoring);
mainGame.appendChild(display);

scoring.innerHTML = '<h2><span id="correct">&#10004;  0</span><span id="wrongText">&#10004; 0</span></h2>';
display.innerHTML = '<h2 id="clock">&nbsp;</h2><button id="next">Next</button>';


console.log(mainGame);