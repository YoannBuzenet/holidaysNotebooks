onload=init;

var number_of_questions = 0;
var orderFollowUp = [];
var selectedSchoolLevel;
var selectedDiscipline;


function init(){

	// Allowing Question creation
	var createQuestionButton = document.getElementById('button-add');
	var divToAppendNewQuestions = document.getElementById('course-question-add');
	
	createQuestionButton.addEventListener('click', function(){
		createQuestion(divToAppendNewQuestions);
		number_of_questions += 1;
	});

	
	//Checking form validation
	var submitButton = document.getElementById('create-course-button');
	submitButton.addEventListener('click', function(e){
		checkBeforeSubmit(e, submitButton);
		});

	//Questions creation follow-up
	
}

function createQuestion(divToAppendNewQuestions){
		var questionDiv = document.createElement('div');
		questionDiv.classList.add('question-div');
		questionDiv.setAttribute('data-number', number_of_questions);
		// questionDiv.setAttribute('name', 'question-'+number_of_questions);

		//adding removebutton 
		var removeButton = document.createElement('div');
		removeButton.classList.add('remove-question');
		removeButton.innerHTML ='<i class="far fa-trash-alt"></i>';
		questionDiv.appendChild(removeButton);

		//Delete Question event
		removeButton.addEventListener('click', function(){
			//deleting
			this.parentNode.remove();
			resetOptions();
			//updating the attribute data number of each question to follow up its order number
			let allQuestionsCreated = document.querySelectorAll('.question-div');
			for(let i=0;i<allQuestionsCreated.length;i++){
				allQuestionsCreated[i].setAttribute('data-number', i);
				//updating the "name" of questions id AND order to get the final POST differenciated
				let selectQuestion = allQuestionsCreated[i].querySelector('#select-question');
				console.log(selectQuestion);
				if(selectQuestion == null){

				}
				else{
				selectQuestion.setAttribute('name', 'question-'+i);
				}
			}
			number_of_questions = allQuestionsCreated.length;

			//updating the "saving" array
			currentIndexOfQuestionWeWantToRemove = this.parentNode.getAttribute('data-number');
			let filteredItems = orderFollowUp.splice(currentIndexOfQuestionWeWantToRemove,1);

			//updating order number of each remaining question
			for(let i=0;i<allQuestionsCreated.length;i++){
				allQuestionsCreated[i].querySelector('.order-question').value = orderFollowUp[i];
				//updating the "name" of order to get the final POST differenciated
				allQuestionsCreated[i].querySelector('.order-question').setAttribute('name', 'order-'+i);
			}

		})

		//adding order selection in questions
		var orderButton = document.createElement('select');
		orderButton.classList.add('order-question');
		orderButton.setAttribute('id','order-question');
		orderButton.setAttribute('name','order-'+number_of_questions);
		questionDiv.appendChild(orderButton);
		divToAppendNewQuestions.appendChild(questionDiv);
		//Saving the order in the global array orderFollowUp
		orderButton.addEventListener('change', function(){
			orderFollowUp[this.parentNode.getAttribute('data-number')] = this.value;
		})

		//Updating all options when adding a new question
		resetOptions();

		//Order follow up in a global array that allows to save the order indicated on the question
		let currentQuestionOrder = questionDiv.getAttribute('data-number');
		orderFollowUp[currentQuestionOrder]=0;

		//updating each existing question with the good number order
		let allQuestionsCreated = document.querySelectorAll('.question-div');
			for(let i=0;i<allQuestionsCreated.length;i++){
				allQuestionsCreated[i].querySelector('.order-question').value = orderFollowUp[i];
			}

		getDisciplines(questionDiv);
		setTimeout(function(){
			getSchoolLevels(questionDiv)}
			,10);
	  	  	
}

function resetOptions(){
	allOrderFormCreated = document.getElementsByClassName('order-question');

	for(var n=0;n<allOrderFormCreated.length;n++){
		allOrderFormCreated[n].innerHTML ="";
		for(let i=0;i<allOrderFormCreated.length;i++){
			var numberOption = document.createElement('option');
			numberOption.value = i;
			numberOption.text = i;
			allOrderFormCreated[n].appendChild(numberOption);
		}
	}
}

function getDisciplines(questionDiv){
  	//Getting disciplines
	//Creating the Select form with it
	var xhttp = new XMLHttpRequest();
 	xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
	    	var listOfDisciplines = JSON.parse(this.responseText);

	    	selectDiscipline = document.createElement('select');
	    	selectDiscipline.id ="select-discipline";
	    	selectDiscipline.setAttribute('required','true');

	    	var labelForselectDiscipline = document.createElement('label');
	    	labelForselectDiscipline.setAttribute('for','select-discipline');
	    	labelForselectDiscipline.innerHTML = "Choisissez la discipline:";

	    	questionDiv.appendChild(labelForselectDiscipline);

	    	//Adding the default option
	    	var defaultOption = document.createElement('option');
	    	defaultOption.setAttribute('selected','true');
	    	defaultOption.setAttribute('disabled','true');
	    	defaultOption.value=0;
	    	defaultOption.innerHTML ="Choisir";
	    	selectDiscipline.appendChild(defaultOption);

	    	for(let i=0;i<listOfDisciplines.length;i++){
	    		let option = document.createElement('option');
	    		option.value = listOfDisciplines[i][0];
	    		option.innerHTML = listOfDisciplines[i][1];
	    		selectDiscipline.appendChild(option);
	  		}

	  		questionDiv.appendChild(selectDiscipline);
	  		currentDataNumber = questionDiv.getAttribute('data-number');

	  		//Checking if both discipline AND school level have been selected
	  		//Once school level AND discipline have been both selected, we GET the relevant questions in DB
  			selectDiscipline.addEventListener('change',function(e){
  				selectedDiscipline = e.target.value;
  				currentDataNumber = questionDiv.getAttribute('data-number');
		  		checkDisciplineANDSchoolLevel(questionDiv, currentDataNumber, selectedSchoolLevel, selectedDiscipline);
		  		});

	    }
 	};
  	xhttp.open("GET", "index.php?section=ajax&page=discipline", true);
  	xhttp.send();
}

function getSchoolLevels(questionDiv){
	  		//Getting school_level
	  	//Creating the Select form with it
		var xhttp2 = new XMLHttpRequest();
	 	xhttp2.onreadystatechange = function() {
	    	if (this.readyState == 4 && this.status == 200) {
		    	var listOfSchoolLevel = JSON.parse(this.responseText);

		    	selectSchoolLevel = document.createElement('select');
		    	selectSchoolLevel.id ="select-school_level";

		    	var labelForselectSchoolLevel = document.createElement('label');
		    	labelForselectSchoolLevel.setAttribute('for','select-school_level');
		    	labelForselectSchoolLevel.innerHTML = "Choisissez le niveau scolaire:";

		    	questionDiv.appendChild(labelForselectSchoolLevel);

		    	//Adding the default option
		    	var defaultOption = document.createElement('option');
		    	defaultOption.setAttribute('selected','true');
		    	defaultOption.setAttribute('disabled','true');
		    	defaultOption.value=0;
		    	defaultOption.innerHTML ="Choisir";
		    	selectSchoolLevel.appendChild(defaultOption);

		    	for(let i=0;i<listOfSchoolLevel.length;i++){
		    		let option = document.createElement('option');
		    		option.value = listOfSchoolLevel[i][0];
		    		option.innerHTML = listOfSchoolLevel[i][1];
		    		selectSchoolLevel.appendChild(option);
		  		}

		  		questionDiv.appendChild(selectSchoolLevel);
		  		currentDataNumber = questionDiv.getAttribute('data-number');

		  		//Checking if both discipline AND school level have been selected
		  		//Once school level AND discipline have been both selected, we GET the relevant questions in DB
		  		selectSchoolLevel.addEventListener('change',function(e){
		  			selectedSchoolLevel = e.target.selectedIndex;
		  			currentDataNumber = questionDiv.getAttribute('data-number');
		  			checkDisciplineANDSchoolLevel(questionDiv, currentDataNumber, selectedSchoolLevel, selectedDiscipline);
		  		});

		    }
	 	};
	  	xhttp2.open("GET", "index.php?section=ajax&page=get_school_level", true);
	  	xhttp2.send();
}

function checkDisciplineANDSchoolLevel(questionDiv, currentDataNumber, selectedSchoolLevel){
	if(selectedSchoolLevel != 0 && selectedDiscipline != 0){

	xhr = new XMLHttpRequest();
	xhr.open('POST', 'index.php?section=ajax&page=ask');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        relevantQuestions = JSON.parse(xhr.responseText);

	        		//checking if the result already exist, to just modify it instead of creating severals
	        		currentSelectQuestion = questionDiv.querySelector('#select-question');

					if(currentSelectQuestion == null){
	        			var selectQuestion = document.createElement('select');
	        		}
	        		else{
	        			//removing old options if filters disciplines & school level changed
	        			var selectQuestion = currentSelectQuestion;
	        			selectQuestion.options.length = 0;
	        		}

		        	selectQuestion.setAttribute('id','select-question');

	        		for(let i=0; i<relevantQuestions.length; i++){
			        	questionOption = document.createElement('option');
			        	questionOption.value = relevantQuestions[i]['id'];
			        	questionOption.text = relevantQuestions[i]['name'];
			        	selectQuestion.appendChild(questionOption);
	        		}
	        		questionDiv.appendChild(selectQuestion);
	        		currentDataNumber = selectQuestion.parentNode.getAttribute('data-number');
	        		selectQuestion.setAttribute('name','question-'+currentDataNumber);

	    }
	};
	xhr.send(encodeURI('id_discipline=' + selectedDiscipline +'&id_school_level='+selectedSchoolLevel));
	}
}

function checkBeforeSubmit(e, submitButton){

		var submit = true;
		
		//CHECKING if all questions have an order and are in order
		allQuestionsCreated = document.getElementsByClassName('question-div');
		var checkOrderArray = [];
		for(var n=0; n<allQuestionsCreated.length; n++){
			currentOrderQuestion = allQuestionsCreated[n].querySelector('#order-question');
			//taking value of each order chosen, translating it into a INT to compare it with i just below
			checkOrderArray.push(parseInt(currentOrderQuestion.value));
		}
		for(let i=0;i<checkOrderArray.length;i++){
			if(checkOrderArray.includes(i)){
				continue;
			}
			else{
				submit = false;
			}
		}
		//end of the check

		// //getting all the questions created to put them into array to prepare ajax sending
		// allQuestionsCreated = document.getElementsByClassName('question-div');
		// var questionsArray = [];
		// 	for(var n=0;n<allQuestionsCreated.length;n++){
		// 		currentOrderQuestion = allQuestionsCreated[n].querySelector('#order-question');
		// 		currentQuestionSelectedID = allQuestionsCreated[n].querySelector('#select-question');
		// 		let question = new Question(currentQuestionSelectedID.value, currentOrderQuestion.value);
		// 		questionsArray.push(question);
		// 	}
		// 	//ON A EGALEMENT BESOIN DU NOM DU PARCOURS
		// 	//a ajouter dans l'array qui part
		// 	// et d'une image (upload here + url dans le json)
		// 	//et d'une description (à ajouter en base)
		// 	let courseName = document.getElementById('course-name').value;
		// 	var finalArray = [];
		// 	finalArray.push(courseName,questionsArray)

		if(!submit){
			e.preventDefault();
			paragraphCheck = document.getElementById('problem-paragraph');
			if(paragraphCheck == null){
				var problemParagraph = document.createElement('p');
				problemParagraph.setAttribute('id','problem-paragraph');
			}	
			else{
				problemParagraph = document.getElementById('problem-paragraph');
			}	

			problemParagraph.innerHTML = "L'ordre des questions ne semble pas complet. Pouvez-vous revérifier ?";
			problemParagraph.classList.add('alert');
			problemParagraph.classList.add('problem');

			formParent = document.getElementById('course-form');

			formParent.insertBefore(problemParagraph, submitButton);
		}

}

function sendAjax(array){
	console.log(array);

	xhr = new XMLHttpRequest();
	xhr.open('POST', 'index.php?section=courses&action=2V');
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	rep = xhr.responseText;
	    	console.log(rep);
	    }
	};
	xhr.send(encodeURI('jsonArray='+JSON.stringify(array)));
}



