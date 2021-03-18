/* function addSubject(){ function for adding subjects 
	var a = $("#saveSubj").attr("class");
	
	if(a == "addButtons"){
		var sc = document.getElementById("txtSubjCode").value;
		var sd = document.getElementById("txtSubjDesc").value;
		var y = document.getElementById("txtYear").value;
		var s = document.getElementById("txtSection").value;
		
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var a = this.responseText;
				alert(a);
				document.getElementById("txtSubjCode").value = "";
				document.getElementById("txtSubjDesc").value = "";
				document.getElementById("txtYear").value = "Grade 1";
				document.getElementById("txtSection").value = "";
			}
		};
		xhttp.open("GET", "Process/addSubj.php?sc="+sc+"&sd="+sd+"&y="+y+"&s="+s, true);
		xhttp.send();
	}
	else{
		alert("Please fill up all the form or input a valid character");
	}
} */

function addTeacher(){ /*function for adding teacher */
	var a = $("#saveTeacher").attr("class");
	
	if(a == "addButtons"){
		var f = document.getElementById("txtFirst").value;
		var m = document.getElementById("txtMiddle").value;
		var l = document.getElementById("txtLast").value;
		
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var a = this.responseText;
				alert(a);
				document.getElementById("txtFirst").value = "";
				document.getElementById("txtMiddle").value = "";
				document.getElementById("txtLast").value = "";
			}
		};
		xhttp.open("GET", "Process/addTeacher.php?f="+f+"&m="+m+"&l="+l, true);
		xhttp.send();
	}
	else{
		alert("Please fill up all the form or input a valid character");
	}
}

function checkInput(app){ /*Checks for the validity of the characters inputted in the textbox*/
	var a = app.value;
	var b = app.id;
	
	if(b == "txtSection"){
		if(nameValid(a) == true){
			$("#"+b).removeClass().addClass('addInps');
		}
		else{
			$("#"+b).removeClass().addClass('addInp');
		}
	}
	else if(b == "txtSubjDesc"){
		if(nameValid(a) == true){
			$("#"+b).removeClass().addClass('addTexts');
		}
		else{
			$("#"+b).removeClass().addClass('addText');
		}
	}
	else if(b == "txtFirst" || b == "txtMiddle" || b == "txtLast"){
		if(nameValid(a) == true){
			$("#"+b).removeClass().addClass('addInps');
		}
		else{
			if(b == "txtMiddle"){
				if(a == ""){
					$("#"+b).removeClass().addClass('addInps');
				}
				else{
					$("#"+b).removeClass().addClass('addInp');
				}
			}
			else{
				$("#"+b).removeClass().addClass('addInp');
			}
		}
	}
	else{
		if(inputValid(a) == true){
			$("#"+b).removeClass().addClass('addInps');
		}
		else{
			$("#"+b).removeClass().addClass('addInp');
		}
	}
	checkSubjInp();
	checkProfInp();
}

function addSubjectLoad(last){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("addSubjLoad").innerHTML = this.responseText; /*Displays the list of teachers*/
			document.getElementById("txtSearch").value = last;
		}
	};
	xhttp.open("GET", "Process/addSubjLoad.php?last="+last, true);
	xhttp.send();
}

function searchProf(){
	var last = document.getElementById("txtSearch").value;
	window.sessionStorage.removeItem("last");
	window.sessionStorage.setItem('last', last);
	addSubjectLoad(last);
}

function addHere(app){
	var id = app.id;
	window.sessionStorage.setItem('id', id);
	var desc = sessionStorage.getItem('desc');
	
	addSubjectLoad2(desc);
	$("#addSubjLoad").hide();
	$("#addSubjLoad2").show();
}

function viewHere(app){
	var id = app.id;
	window.sessionStorage.setItem('id', id);
	
	viewSubjectLoad(id);
	$("#addSubjLoad").hide();
	$("#viewSubjectLoad").show();
}

function addSubjectLoad2(desc){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("addSubjLoad2").innerHTML = this.responseText; /*Displays the list of subjects*/
			document.getElementById("txtSearchDesc").value = desc;
		}
	};
	xhttp.open("GET", "Process/addSubjLoad2.php?desc="+desc, true);
	xhttp.send();
}

function viewSubjectLoad(id){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("viewSubjectLoad").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "Process/viewSubjectLoad.php?id="+id, true);
	xhttp.send();
}

function searchDesc(){
	var desc = document.getElementById("txtSearchDesc").value;
	window.sessionStorage.removeItem("desc");
	window.sessionStorage.setItem('desc', desc);
	var id = sessionStorage.getItem('id');
	addSubjectLoad2(id,desc);
}

function addLoad(app){
	var subj = app.id
	var prof = sessionStorage.getItem('id');
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var a = this.responseText; /*Displays the records of students*/
			if(a == "Successful"){
				searchDesc();
			}
			else{
				alert(a);
			}
		}
	};
	xhttp.open("GET", "Process/addSubjLoadProcess.php?subj="+subj+"&prof="+prof, true);
	xhttp.send();
}

//function checkSubject(){
//	var year = document.getElementById("txtYearLoad").value;
//	var section = document.getElementById("txtSectionLoad").value;
//	window.sessionStorage.removeItem("year");
//	window.sessionStorage.setItem('year', year);
//	window.sessionStorage.removeItem("section");
//	window.sessionStorage.setItem('section', section);
//	addSubjectLoad(year,section);
//}

function inputValid(user){ /* sets the valid characters for text boxes */
    validChars = /^[A-Z a-z_0-9]+$/;
    if(!user.match(validChars)){
        return false;
    }else{
        return true;
    }
}

function nameValid(user){ /* sets the valid characters for text boxes */
    validChars = /^[A-Z a-z]+$/;
    if(!user.match(validChars)){
        return false;
    }else{
        return true;
    }
}

function checkSubjInp(){ /* checks if all the text box for adding subject is filled up and has no invalid characters */
	var a = $("#txtSubjCode").attr("class");
	var b = $("#txtSubjDesc").attr("class");
	var c = $("#txtSection").attr("class");
	
	if(a == "addInps" && b == "addTexts" && c == "addInps"){
		$("#saveSubj").removeClass().addClass('addButtons');
	}
	else{
		$("#saveSubj").removeClass().addClass('addButton');
	}
}

function checkProfInp(){ /* checks if all the text box for adding teacher is filled up and has no invalid characters */
	var a = $("#txtFirst").attr("class");
	var b = $("#txtLast").attr("class");
	var c = $("#txtMiddle").attr("class");
	
	if(a == "addInps" && b == "addInps" && c == "addInps"){
		$("#saveTeacher").removeClass().addClass('addButtons');
	}
	else{
		$("#saveTeacher").removeClass().addClass('addButton');
	}
}

function logout(){ /* function for logout */
	sessionStorage.clear();
	window.location.href = "Home.php";
}

function exportData(){
	window.location.href = "/onlineGrading/process/exportStudentList.php";
}

function checkYear(app){
	var year  = app.value;
	window.sessionStorage.removeItem("seYe");
	window.sessionStorage.setItem('seYe', year);
	var section = sessionStorage.getItem('seSe');
	viewSubjects(year,section);
}

function checkSection(app){
	var section  = app.value;
	window.sessionStorage.removeItem("seSe");
	window.sessionStorage.setItem('seSe', section);
	var year = sessionStorage.getItem('seYe');
	viewSubjects(year,section);
}

function viewSubjects(year,section){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("viewSubjects").innerHTML = this.responseText; /*Displays the list of subjects loaded to the teacher*/
			document.getElementById("searchYear").value = year;
			document.getElementById("searchSection").value = section;
		}
	};
	xhttp.open("GET", "Process/viewSubjects.php?year="+year+"&section="+section, true);
	xhttp.send();
}

function viewEnrolls(app){
	var year = app.id;
	var section = app.name;
	var source = "admin";
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("viewStudents").innerHTML = this.responseText;
			$("#viewSubjects").hide();
			$("#viewStudents").show();
		}
	};
	xhttp.open("GET", "Process/viewEnrolled.php?year="+year+"&section="+section+"&source="+source, true);
	xhttp.send();
}

function exportCurriculum(){
	var year = document.getElementById("txtYear").value;
	window.location.href = "/onlineGrading/process/exportCurriculum.php?year="+year;
}

function printClass(app){
	alert("Finding Printer...");
	alert("Printer not found!");
}

function printSolo(app){
	alert("Finding Printer...");
	alert("Printer not found!");
}