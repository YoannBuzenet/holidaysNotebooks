
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

	allQuestionsCreated = document.getElementsByClassName('question-div');
	for(let i=0;i<allQuestionsCreated.length; i++){
		hydrateChildren(allQuestionsCreated[i], json, i)
	}

	

}

function hydrateChildren(div, json, i){

	div.childNodes[1].selectedIndex = json[i].order_question;
	console.log(div.childNodes[1].childNodes);
	console.log(json[i].order_question);
}