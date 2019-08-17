onload=init;

function init(){

	var createQuestionButton = document.getElementById('button-add');
	var divToAppendNewQuestions = document.getElementById('course-question-add');

	createQuestionButton.addEventListener('click', createQuestion);


	function createQuestion(){
		questionDiv = document.createElement('div');
		questionDiv.classList.add('question-div');

		//removebutton 
		var removeButton = document.createElement('div');
		removeButton.classList.add('remove-question');
		removeButton.innerHTML ='<i class="far fa-trash-alt"></i>';
		questionDiv.appendChild(removeButton);

		removeButton.addEventListener('click', function(){
			this.parentNode.remove();
		})

		divToAppendNewQuestions.appendChild(questionDiv);

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

		
	}

}

