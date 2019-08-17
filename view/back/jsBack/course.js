onload=init;

function init(){

	var createQuestionButton = document.getElementById('button-add');
	var divToAppendNewQuestions = document.getElementById('course-question-add');

	createQuestionButton.addEventListener('click', createQuestion);


	function createQuestion(){
		questionDiv = document.createElement('div');
		questionDiv.classList.add('question-div');

		//adding removebutton 
		var removeButton = document.createElement('div');
		removeButton.classList.add('remove-question');
		removeButton.innerHTML ='<i class="far fa-trash-alt"></i>';
		questionDiv.appendChild(removeButton);

		removeButton.addEventListener('click', function(){
			this.parentNode.remove();
			resetOptions();
		})

		//adding order selection in questions
		var orderButton = document.createElement('select');
		orderButton.classList.add('order-question');
		orderButton.setAttribute('id','order-question');
		questionDiv.appendChild(orderButton);
		divToAppendNewQuestions.appendChild(questionDiv);

		//Updating all options when adding a new question
		resetOptions();

		//Getting disciplines
		//Creating the Select form with it
		var xhttp = new XMLHttpRequest();
	 	xhttp.onreadystatechange = function() {
	    	if (this.readyState == 4 && this.status == 200) {
		    	var listOfDisciplines = JSON.parse(this.responseText);

		    	selectDiscipline = document.createElement('select');
		    	selectDiscipline.id ="select-discipline";

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

		  		//Checking if both discipline AND school level have been selected
		  		//Once school level AND discipline have been both selected, we GET the relevant questions in DB
	  			selectDiscipline.addEventListener('change',checkDisciplineANDSchoolLevel);

				function checkDisciplineANDSchoolLevel(){
	  				if(selectSchoolLevel.selectedIndex != 0 && selectDiscipline.selectedIndex != 0){

						xhr = new XMLHttpRequest();
						xhr.open('POST', 'index.php?section=ajax&page=ask');
						xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
						xhr.onload = function() {
						    if (this.readyState == 4 && this.status == 200) {
						    	relevantQuestions = JSON.parse(xhr.responseText);

						    	var check_if_form_already_exists = document.getElementById('select-question');

						        if(check_if_form_already_exists != null){
						        	check_if_form_already_exists.parentNode.removeChild(check_if_form_already_exists);
						        }

						    	selectQuestion = document.createElement('select');
						    	selectQuestion.setAttribute('id','select-question');
						    	selectQuestion.setAttribute('name','select-question');

						        for(let i=0; i<relevantQuestions.length; i++){
						        	questionOption = document.createElement('option');
						        	questionOption.value = relevantQuestions[i]['id'];
						        	questionOption.text = relevantQuestions[i]['name'];
						        	selectQuestion.appendChild(questionOption);
						        	questionDiv.appendChild(selectQuestion);
						        }

						    }
						};
						xhr.send(encodeURI('id_discipline=' + selectDiscipline.value +'&id_school_level='+selectSchoolLevel.value));
	  				}
	  			}

		    }
	 	};
	  	xhttp.open("GET", "index.php?section=ajax&page=discipline", true);
	  	xhttp.send();


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

		  		//Checking if both discipline AND school level have been selected
		  		//Once school level AND discipline have been both selected, we GET the relevant questions in DB
		  		selectSchoolLevel.addEventListener('change',checkDisciplineANDSchoolLevel);

	  			function checkDisciplineANDSchoolLevel(){
	  				if(selectSchoolLevel.selectedIndex != 0 && selectDiscipline.selectedIndex != 0){

						xhr = new XMLHttpRequest();
						xhr.open('POST', 'index.php?section=ajax&page=ask');
						xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
						xhr.onload = function() {
						    if (this.readyState == 4 && this.status == 200) {
						        relevantQuestions = JSON.parse(xhr.responseText);

						        var check_if_form_already_exists = document.getElementById('select-question');

						        if(check_if_form_already_exists != null){
						        	check_if_form_already_exists.parentNode.removeChild(check_if_form_already_exists);
						        }

						        selectQuestion = document.createElement('select');
						        selectQuestion.setAttribute('id','select-question');
						        selectQuestion.setAttribute('name','select-question');

						        for(let i=0; i<relevantQuestions.length; i++){
						        	questionOption = document.createElement('option');
						        	questionOption.value = relevantQuestions[i]['id'];
						        	questionOption.text = relevantQuestions[i]['name'];
						        	selectQuestion.appendChild(questionOption);
						        	questionDiv.appendChild(selectQuestion);
						        }
						    }
						};
						xhr.send(encodeURI('id_discipline=' + selectDiscipline.value +'&id_school_level='+selectSchoolLevel.value));
	  				}
	  			}

		    }
	 	};
	  	xhttp2.open("GET", "index.php?section=ajax&page=get_school_level", true);
	  	xhttp2.send();


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

		
	}

	var submitButton = document.getElementById('create-course-button');
	submitButton.addEventListener('click', checkBeforeSubmit);

	function checkBeforeSubmit(){

		var submit = true;
		problemParagraph = document.createElement('p');
		
		//checking if all questions have an order and are in order
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


		//getting all the questions created
		allQuestionsCreated = document.getElementsByClassName('question-div');

			for(var n=0;n<allQuestionsCreated.length;n++){
				currentOrderQuestion = allQuestionsCreated[n].querySelector('#order-question');
				currentQuestionSelectedID = allQuestionsCreated[n].querySelector('#select-question');
			}

		if(submit){
			console.log('envoyer ajax');
		}
		else{
			problemParagraph.innerHTML = "L'ordre des questions ne semble pas complet. Pouvez-vous revérifier ?";
			problemParagraph.classList.add('alert');
			problemParagraph.classList.add('problem');

			formParent = document.getElementById('course-form');

			formParent.insertBefore(problemParagraph, submitButton);


		}
	}

}

