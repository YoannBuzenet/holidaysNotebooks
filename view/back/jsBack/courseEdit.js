
//We're telling the script we're in edit mode. It will allow few behaviour modification, like removing the check on the picture when posting.
editmode = true;

//getting the ID from GET parameters
var queryDict = {};
location.search.substr(1).split("&").forEach(function(item) {queryDict[item.split("=")[0]] = item.split("=")[1]});
var id = queryDict.id;

//Get all data from the course
callCourseData(id);





function callCourseData(id){

	var xhttp = new XMLHttpRequest();
 	xhttp.onreadystatechange = function() {
    	if (xhttp.readyState == 4 && xhttp.status == 200) {
    		//console.log(xhttp.responseText); 
	    	var courseData = JSON.parse(xhttp.responseText);	
	    	reCreateCourseForm(courseData);
	    }
 	};
  	xhttp.open("GET", "index.php?section=ajax&page=data&id="+id, true);
  	xhttp.send();
}

function reCreateCourseForm(json){

	var divToAppendNewQuestions = document.getElementById('course-question-add');
	var questionDiv;

	//Creating the question div
	for(let i = 0; i<json.length;i++){
		questionDiv = createQuestion(divToAppendNewQuestions);
		number_of_questions += 1;

		//Saving the order question in the saving array orderFollowUp
		let currentQuestionOrder = questionDiv.getAttribute('data-number');
		orderFollowUp[currentQuestionOrder]=json[i].order_question;
	}
	//Giving it id_discipline and id_school_level. We wait in setTimeout because there's an AJAX call on them.
	setTimeout(function(){
		allQuestionsCreated = document.getElementsByClassName('question-div');

		for(let i=0;i<allQuestionsCreated.length; i++){
			hydrateChildren(allQuestionsCreated[i], json, i)
		}

	}, 600)

	// Giving it the selected question. We wait in setTimeout AND sleep because there's also an AJAX call.
	setTimeout(async function(){

		allQuestionsCreated = document.getElementsByClassName('question-div');

		for(let i=0;i<allQuestionsCreated.length; i++){
			currentDataNumber = allQuestionsCreated[i].getAttribute('data-number');
			questionDiv = allQuestionsCreated[i];

			let selectedDiscipline = json[i][2];
			let selectedSchoolLevel = json[i][4];
			let preselectedQuestion = json[i][1];

			await sleep(300);
			checkDisciplineANDSchoolLevel(questionDiv, currentDataNumber, selectedSchoolLevel, selectedDiscipline, preselectedQuestion);


		}
	}, 50)
	
}

function hydrateChildren(div, json, i){

	//console.log(div.childNodes);

	//setting order question
	div.childNodes[1].selectedIndex = json[i].order_question;
	//setting id school level
	div.childNodes[5].selectedIndex = json[i][4];
	

	//setting id discipline (we browse each option so that we can keep the alphabetical order)
	allOptionsAvailable = div.childNodes[3].childNodes;
	for(let n=0; n<allOptionsAvailable.length;n++){
		if(allOptionsAvailable[n].value == json[i][2]){
			allOptionsAvailable[n].setAttribute('selected', true);
		}
	}
}

function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}