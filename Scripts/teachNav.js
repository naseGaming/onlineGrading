$(document).ready(function(){
	var userLog = sessionStorage.getItem('prof');
	var user = sessionStorage.getItem('user');
	var upFlag = sessionStorage.getItem('upFlag');
	var checkFlag = sessionStorage.getItem('checkFlag');
	window.sessionStorage.setItem('year', '');
	window.sessionStorage.setItem('section', '');
	var section = sessionStorage.getItem('section');
	var year = sessionStorage.getItem('year');

	document.getElementById("userName").innerHTML = userLog;
	var isLog = document.getElementById("userName").innerHTML
	
	$("#changePassword").hide();
	$("#upForm").hide();
	$("#manualForms").hide();
	$("#viewEnrolledForm").hide();
	$("#completionform").hide();
	
	
	if(isLog == ""){
		alert("Error getting account information");
		window.location.href = "home.php";
	}
	
	if(checkFlag == "true"){
		$("#upGradeForm").hide();
		document.getElementById("selectedSubject").value = sessionStorage.getItem('selSub');
		document.getElementById("selectedSection").value = sessionStorage.getItem('selSec');
		document.getElementById("currentYear").value = sessionStorage.getItem('selCurYear');
		document.getElementById("cYear").value = sessionStorage.getItem('selcYear');
		$("#upForm").show();
		window.sessionStorage.removeItem("checkFlag");
		window.sessionStorage.setItem('checkFlag', 'false');
	}
	
	upGradeForm(section,year,user);
	
	$("#userName").click(function(){
		window.sessionStorage.removeItem("upFlag");
		window.sessionStorage.setItem('upFlag', 'false');
		$("#userName").removeClass().addClass('active');
		$("#upGrade").removeClass().addClass('inactive');
		$("#changePassword").show();
		$("#upGradeForm").hide();
		$("#upForm").hide();
		$("#manualForms").hide();
		$("#viewEnrolledForm").hide();
	});
	
	$("#upGrade").click(function(){
		window.sessionStorage.removeItem("upFlag");
		window.sessionStorage.setItem('upFlag', 'false');
		$("#userName").removeClass().addClass('inactive');
		$("#upGrade").removeClass().addClass('active');
		$("#changePassword").hide();
		$("#upGradeForm").show();
		$("#upForm").hide();
		$("#manualForms").hide();
		$("#viewEnrolledForm").hide();
		upGradeForm(section,year,user);
	});
	
	$("#logout").click(function(){
		logout();
	});
});