onload = init;

function init(){

	//Putting AddEventListener on every answer
	var allAnswerDiv = document.querySelectorAll('.answer');
	for(let i =0; i < allAnswerDiv.length ; i++){
		allAnswerDiv[i].addEventListener('click', function(e){
			tickRadiosBox(this);
		})
	}

	// Getting the question ID
	var articleWithIdQuestion = document.getElementById('main-article');
	var currentQuestionId = articleWithIdQuestion.getAttribute('data-idquestion');
	

	//Putting AddEventListener on the "Next" Button
	//CHECK IF NO QUESTION HAVE BEEN SELECTED HERE 
	var formButton = document.getElementById('form-validate');
	formButton.addEventListener('click', function(){
		gets(currentQuestionId);
	})

}

function tickRadiosBox(divParent){

	//Removing color from all .answer div
	var allAnswerDiv = document.querySelectorAll('.answer');
	for(let i =0; i < allAnswerDiv.length ; i++){
		allAnswerDiv[i].style.backgroundColor="";
	}

	//Adding color to the selected .answer div
	divParent.style.backgroundColor="#3B87FB";

	//Checking the radio input from this div
	let currentInput = divParent.getElementsByTagName('input');
	currentInput[0].checked=true;
	selectedAnswer = currentInput[0].getAttribute('value');

}

function gets(currentQuestionId){
	var xhr = new XMLHttpRequest();
 	xhr.onreadystatechange = function() {
    	if (xhr.readyState == 4 && xhr.status == 200) {
	    	data = JSON.parse(xhr.responseText);
	    	//console.log(data);
	    	//display the solution (process data will have to be customized for each id_type. id_type is referenced as data-idtype on the html page)
	    	process(data);
	    }
 	};
  	xhr.open("GET", "index.php?section=ajax&page=gets&idq="+currentQuestionId, true);
  	xhr.send();
}

function process(json){
	//console.log(data);
	let pageForm = document.getElementById('question-form');

	//Black background
	var greyBackgroundDiv = document.createElement('div');
	greyBackgroundDiv.className=('background-modal')

	//Main Div
	var globalDiv = document.createElement('div');
	greyBackgroundDiv.appendChild(globalDiv);
	globalDiv.className=('modal');

	var resultTitle = document.createElement('h1');
	globalDiv.appendChild(resultTitle);

	//Dynamic title of the modal
	if(selectedAnswer == json.solution_number){
		var resultcontent = document.createTextNode('Bonne réponse');
	}
	else{
		var resultcontent = document.createTextNode('Mauvaise réponse');
	}
	
	resultTitle.appendChild(resultcontent);
	resultTitle.className=('modal-title');

	//First paragraph
	var messageParagraph = document.createElement('p');
	globalDiv.appendChild(messageParagraph);

	//Dynamic message of the modal
	if(selectedAnswer == json.solution_number){
		var newContent = document.createTextNode('Bien joué !');
	}
	else{
		var newContent = document.createTextNode("C'est pas grave !");
	}
	
	messageParagraph.appendChild(newContent);
	messageParagraph.className=('modal-paragraph');

	//Solution
	var solutionParagraph = document.createElement('p');
	globalDiv.appendChild(solutionParagraph);
	var solutionContent = document.createTextNode(json.solution);
	solutionParagraph.appendChild(solutionContent);
	globalDiv.appendChild(solutionParagraph);
	solutionParagraph.className=('modal-paragraph');

	//Paragraph containing final button
	var alertParagraphButtons = document.createElement('p');
	globalDiv.appendChild(alertParagraphButtons);
	alertParagraphButtons.className=('next-button');
	var nextButton = document.createElement('input');
	nextButton.type = 'button';
	nextButton.value = "Suivant";
	nextButton.onclick = function (){
		//window.location.href = event.target.parentNode.href;
		//what does it do when you click on next ?
		pageForm.submit();
	}
	alertParagraphButtons.appendChild(nextButton);

	//Appending the whole to the DOM
	var currentDiv = document.getElementById('main-article');
	currentDiv.parentNode.insertBefore(greyBackgroundDiv, currentDiv);

}