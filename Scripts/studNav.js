$(document).ready(function(){
	var user = sessionStorage.getItem('user');
	var userLog = sessionStorage.getItem('stud');

	document.getElementById("userName").innerHTML = userLog;
	var isLog = document.getElementById("userName").innerHTML;
	
	if(isLog == ""){
		alert("Error getting account information");
		window.location.href = "home.php";
	}

	var sy = sessionStorage.getItem('sy');
	var year = sessionStorage.getItem('year');
	var section = sessionStorage.getItem('section');
	
	viewGrades(user,sy,year,section);
	$("#changePassword").hide();
	
	$("#userName").click(function(){
		$("#userName").removeClass().addClass('active');
		$("#viewGrades").removeClass().addClass('inactive');
		$("#changePassword").show();
		$("#viewGrade").hide();
	});
	
	$("#viewGrades").click(function(){
		$("#userName").removeClass().addClass('inactive');
		$("#viewGrades").removeClass().addClass('active');
		$("#changePassword").hide();
		viewGrades(user,sy,year,section);
		$("#viewGrade").show();
	});
	
	$("#logout").click(function(){
		logout();
	});
});