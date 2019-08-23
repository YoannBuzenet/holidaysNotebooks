onload = init;

function init(){

	var allAnswerDiv = document.querySelectorAll('.answer');

	for(let i =0; i < allAnswerDiv.length ; i++){
		allAnswerDiv[i].addEventListener('click', function(e){
			tickRadiosBox(this);
		})
	}

	var articleWithIdQuestion = document.getElementById('main-article');
	var currentQuestionId = articleWithIdQuestion.getAttribute('data-idquestion');

	gets(currentQuestionId);

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

}

function gets(currentQuestionId){
	var xhr = new XMLHttpRequest();
 	xhr.onreadystatechange = function() {
    	if (xhr.readyState == 4 && xhr.status == 200) {
	    	console.log(xhr.responseText);
	    }
 	};
  	xhr.open("GET", "index.php?section=ajax&page=gets&idq="+currentQuestionId, true);
  	xhr.send();
}