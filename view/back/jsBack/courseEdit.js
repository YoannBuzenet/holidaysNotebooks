onload = init;

function init(){

	//getting the ID from GET parameters
	var queryDict = {};
	location.search.substr(1).split("&").forEach(function(item) {queryDict[item.split("=")[0]] = item.split("=")[1]});
	var id = queryDict.id;

	callCourseData(id);



}



function callCourseData(id){

	var xhttp = new XMLHttpRequest();
 	xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
	    	var courseData = this.responseText;
	    	//var courseData = JSON.parse(this.responseText);
	    	console.log(courseData);
	    	

	    }
 	};
  	xhttp.open("GET", "index.php?section=ajax&page=data&id="+id, true);
  	xhttp.send();
}

