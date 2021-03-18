function changePassword(){
	var a = $("#btnChange").attr("class");
	var b = $("#txtOld").attr("class");
	var c = $("#txtNew").attr("class");
	var d = $("#txtConfirm").attr("class");
	
	if(a == "btnsC"){
		var newp = document.getElementById("txtNew").value;
		var user = sessionStorage.getItem('user');
		
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var a = this.responseText;
				alert(a);
				document.getElementById("txtOld").value = "";
				document.getElementById("txtNew").value = "";
				document.getElementById("txtConfirm").value = "";
				$("#txtOld").removeClass().addClass('inp');
				$("#txtNew").removeClass().addClass('inp');
				$("#txtConfirm").removeClass().addClass('inp');
			}
		};
		xhttp.open("GET", "Process/changePassword.php?user="+user+"&newp="+newp, true);
		xhttp.send();
	}
	else{
		if(b == "inp"){
			alert("You've entered incorrect password or the text box is empty!");
		}
		else if(c == "inp"){
			alert("You've entered invalid character or the text box is empty!");
		}
		else if(d == "inp"){
			alert("Password does not match or the text box is empty!");
		}
		else{
			alert("There's an error communicating in our database please re login");
			logout();
		}
	}
}

function checkInput(app){ /*Checks for the validity of the characters inputted in the textbox*/
	var a = app.value;
	var b = app.id;
	var c = document.getElementById("txtNew").value;
	var user = sessionStorage.getItem('user');
	
	if(b == "txtConfirm"){
		if(a == c){
			$("#"+b).removeClass().addClass('inpC');
		}
		else{
			$("#"+b).removeClass().addClass('inp');
		}
	}
	else{
		if(inputValid(a) == true){
			if(a == user){
				alert("password and username should not be the same");
				$("#"+b).removeClass().addClass('inp');
			}
			else{
				$("#"+b).removeClass().addClass('inpC');
			}
		}
		else{
			$("#"+b).removeClass().addClass('inp');
		}
	}
	
	checkChangeInp();
}

function checkOldPassword(app){
	var pass = app.value;
	var b = app.id;
	var user = sessionStorage.getItem('user');
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var a = this.responseText;
			if(a == "1"){
				$("#"+b).removeClass().addClass('inpC');
			}
			else{
				$("#"+b).removeClass().addClass('inp');
			}
		}
	};
	xhttp.open("GET", "Process/checkOldPassword.php?user="+user+"&pass="+pass, true);
	xhttp.send();
}

function upGradeForm(year,section,teacher){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("upGradeForm").innerHTML = this.responseText; /*Displays the list of subjects loaded to the teacher*/
			document.getElementById("txtYear").value = year;
			document.getElementById("txtSection").value = section;
		}
	};
	xhttp.open("GET", "Process/upGradeForm.php?year="+year+"&section="+section+"&teacher="+teacher, true);
	xhttp.send();
}

function addGrade(app){
	$("#upGradeForm").hide();
	var sub = app.id;
	var section = app.name;
	window.sessionStorage.removeItem("selSub");
	window.sessionStorage.setItem('selSub', sub);
	window.sessionStorage.removeItem("selSec");
	window.sessionStorage.setItem('selSec', section);
	checkSchoolYear(sub,section);
}

function checkSchoolYear(sub,section){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var sy = this.responseText;
			sy1 = sy -1;
			var year = "20" + sy1 + "-20" + sy;
			window.sessionStorage.removeItem("selCurYear");
			window.sessionStorage.setItem('selCurYear', year);
			window.sessionStorage.removeItem("selcYear");
			window.sessionStorage.setItem('selcYear', sy);
			manualForm();
		}
	};
	xhttp.open("GET", "Process/checkSy.php", true);
	xhttp.send();
}

function manualForm(){
	var sub = sessionStorage.getItem('selSub');
	var sec = sessionStorage.getItem('selSec');
	var cyear = sessionStorage.getItem('selcYear');
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("manualForms").innerHTML = this.responseText; /*Displays the list of subjects loaded to the teacher*/
			document.getElementById("selectedSubjectMan").value = sub;
			document.getElementById("selectedSectionMan").value = sec;
			document.getElementById("currentYearMan").value = sessionStorage.getItem('selCurYear');
			document.getElementById("cYearMan").value = cyear;
			$("#manualForms").show();
		}
	};
	xhttp.open("GET", "Process/manualForm.php?sub="+sub+"&sec="+sec+"&cyear="+cyear, true);
	xhttp.send();
}

function saveGrade(app){
	var flags = confirm("Are you sure that the grades inputted below is correct ?");
	
	if(flags == true){
		var a = 0;
		var b = app.value;
		var subj = document.getElementById("selectedSubjectMan").value;
		var section = document.getElementById("selectedSectionMan").value;
		var period = document.getElementById("PeriodMan").value;
		var sy = document.getElementById("cYearMan").value;
		
		for(var ctr = 0;ctr<b;ctr++){
			var sn = document.getElementById(a+"sn").value;
			var g = document.getElementById(a).value;
			uploadGrades(sn,subj,g,section,period,sy);
			a++;
		}
		window.location.href = "teacher.php";
	}
}

function uploadGrades(sn,subj,g,section,period,sy) { /* function 2 for saving grade*/
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var message = this.responseText;
			
			if(message == "0"){
			}
			else if(message == "1"){
				alert("There's an error connecting to the database");
			}
			else{
				alert(message + " already has grades for this subject");
			}
		}
	};
	xhttp.open("GET", "Process/saveGrades.php?sn="+sn+"&subj="+subj+"&g="+g+"&section="+section+"&period="+period+"&sy="+sy, true);
	xhttp.send();
}

function checkYear(app){
	var year  = app.value;
	window.sessionStorage.removeItem("year");
	window.sessionStorage.setItem('year', year);
	var user = sessionStorage.getItem('user');
	var section = sessionStorage.getItem('section');
	upGradeForm(year,section,user);
}

function checkSection(app){
	var section  = app.value;
	window.sessionStorage.removeItem("section");
	window.sessionStorage.setItem('section', section);
	var user = sessionStorage.getItem('user');
	var year = sessionStorage.getItem('year');
	upGradeForm(year,section,user);
}

function checkChangeInp(){ /* checks if all the text box for changing password is filled up and has no invalid characters */
	var a = $("#txtOld").attr("class");
	var b = $("#txtNew").attr("class");
	var c = $("#txtConfirm").attr("class");
	
	if(a == "inpC" && b == "inpC" && c == "inpC"){
		$("#btnChange").removeClass().addClass('btnsC');
	}
	else{
		$("#btnChange").removeClass().addClass('btns');
	}
}

function inputValid(user){ /* sets the valid characters for text boxes */
    validChars = /^[A-Z a-z_0-9]+$/;
    if(!user.match(validChars)){
        return false;
    }else{
        return true;
    }
}

function logout(){ /* function for logout */
	sessionStorage.clear();
	window.location.href = "Home.php";
}

function importdata(){
	var sub = document.getElementById("selectedSubjectMan").value;
	var sec = document.getElementById("selectedSectionMan").value;
	var year = document.getElementById("currentYearMan").value;
	var cyear = document.getElementById("cYearMan").value;
	window.sessionStorage.removeItem("selSub");
	window.sessionStorage.setItem('selSub', sub);
	window.sessionStorage.removeItem("selSec");
	window.sessionStorage.setItem('selSec', sec);
	window.sessionStorage.removeItem("selCurYear",);
	window.sessionStorage.setItem('selCurYear', year);
	window.sessionStorage.removeItem("selcYear");
	window.sessionStorage.setItem('selcYear', cyear);
	window.sessionStorage.removeItem("checkFlag");
	window.sessionStorage.setItem('checkFlag', 'true');
	window.location.href = "teacher.php?sub="+sub+"&sec="+sec;	
}

function exportData(){
	var sec = document.getElementById("selectedSection").value;
	var year = document.getElementById("cYear").value;
	window.location.href = "/onlineGrading/process/exportStudents.php?year="+year+"&sec="+sec;
}

function viewEnrolls(app){
	var year = app.id;
	var section = app.name;
	var source = "teacher";
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("viewEnrolledForm").innerHTML = this.responseText;
			$("#upGradeForm").hide();
			$("#viewEnrolledForm").show();
		}
	};
	xhttp.open("GET", "Process/viewEnrolled.php?year="+year+"&section="+section+"&source="+source, true);
	xhttp.send();
}

function unlock(sub,sec,cyear,period,year){
	if(period == ""){
		if(year == "Grade 11" && year == "Grade 12"){
			period = "1st Sem";
		}
		else{
			period = "1st Grading";
		}
	}
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("completionform").innerHTML = this.responseText;
			document.getElementById("selectedSubjectCom").value = sub;
			document.getElementById("currentYearCom").value = cyear;
			document.getElementById("selectedSectionCom").value = sec;
			if(period == ""){
				if(year == "Grade 11" && year == "Grade 12"){
					document.getElementById("PeriodCom").value = "1st Sem";
				}
				else{
					document.getElementById("PeriodCom").value = "1st Grading";
				}
			}
			else{
				document.getElementById("PeriodCom").value = period;
			}
			$("#manualForms").hide();
			$("#completionform").show();
		}
	};
	xhttp.open("GET", "Process/completionform.php?sub="+sub+"&sec="+sec+"&cyear="+cyear+"&period="+period, true);
	xhttp.send();
}

function unlockme(){
	var sub = document.getElementById("selectedSubjectMan").value;
	window.sessionStorage.setItem('compSub', sub);
	var sec = document.getElementById("selectedSectionMan").value
	window.sessionStorage.setItem('compSec', sec);
	var cyear = document.getElementById("cYearMan").value;
	window.sessionStorage.setItem('compYear', cyear);
	var period = "";
	var year = document.getElementById("manualYear").value;
	window.sessionStorage.setItem('compPeriod', year);
	unlock(sub,sec,cyear,period,year);
}

function changeSem(){
	var period = document.getElementById("PeriodCom").value;
	var sub = sessionStorage.getItem('compSub');
	var sec = sessionStorage.getItem('compSec');
	var cyear = sessionStorage.getItem('compYear');
	var year = sessionStorage.getItem('compPeriod');
	unlock(sub,sec,cyear,period,year);
}

function complete(app){
	var flags = confirm("Are you sure that the grades inputted below is correct ?");
	
	if(flags == true){
		var a = 0;
		var b = app.value;
		var subj = document.getElementById("selectedSubjectCom").value;
		var section = document.getElementById("selectedSectionCom").value;
		var period = document.getElementById("PeriodCom").value;
		var sy = document.getElementById("currentYearCom").value;
		
		for(var ctr = 0;ctr<b;ctr++){
			var sn = document.getElementById(a+"snC").value;
			var g = document.getElementById(a+"C").value;
			uploadGrades(sn,subj,g,section,period,sy);
			a++;
		}
		window.location.href = "teacher.php";
	}
}