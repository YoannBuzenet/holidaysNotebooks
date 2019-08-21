
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
	for(let i = 0; i<json.length;i++){
		console.log(json[i]);
		questionDiv = createQuestion(divToAppendNewQuestions);
		number_of_questions += 1;
	}
	setTimeout(function(){
		allQuestionsCreated = document.getElementsByClassName('question-div');

		for(let i=0;i<allQuestionsCreated.length; i++){
			hydrateChildren(allQuestionsCreated[i], json, i)
		}

	}, 200)

	setTimeout(function(){

		completeQuestion(questionDiv);

	}, 300)
	
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

function completeQuestion(div){

	
	
}