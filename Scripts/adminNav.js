$(document).ready(function(){
	var userLog = sessionStorage.getItem('user');
	window.sessionStorage.setItem('year', 'Grade 1');
	window.sessionStorage.setItem('section', '');
	window.sessionStorage.setItem('last', '');
	window.sessionStorage.setItem('desc', '');
	window.sessionStorage.setItem('seSE', '');
	window.sessionStorage.setItem('seYe', '');
	var last = sessionStorage.getItem('last');
	
	if(userLog != "admin"){
		alert("Error getting account information");
		window.location.href = "home.php";
	}
	
	$("#subBar").hide();
	$("#addSubjs").hide();
	$("#profBar").hide();
	$("#addTeacher").hide();
	$("#addSubjLoad").hide();
	$("#addSubjLoad2").hide();
	$("#viewSubjectLoad").hide();
	$("#viewSubjects").hide();
	$("#viewStudents").hide();
	addSubjectLoad(last);
	
	$("#students").click(function(){
		$("#students").removeClass().addClass('active');
		$("#subjects").removeClass().addClass('inactive');
		$("#teacher").removeClass().addClass('inactiveT');
		$("#upStud").removeClass().addClass('actives');
		$("#viewStud").removeClass().addClass('inactives');
		$("#studBar").slideDown();
		$("#subBar").slideUp();
		$("#profBar").slideUp();
		$("#addSubjs").hide();
		$("#addTeacher").hide();
		$("#addStudents").show();
		$("#addSubjLoad").hide();
		$("#addSubjLoad2").hide();
		$("#viewSubjectLoad").hide();
		$("#viewSubjects").hide();
		$("#viewStudents").hide();
	});
	
	$("#subjects").click(function(){
		$("#students").removeClass().addClass('inactive');
		$("#subjects").removeClass().addClass('active');
		$("#teacher").removeClass().addClass('inactiveT');
		$("#addSub").removeClass().addClass('actives');
		$("#subLoad").removeClass().addClass('inactives');
		$("#studBar").slideUp();
		$("#subBar").slideDown();
		$("#profBar").slideUp();
		$("#addSubjs").show();
		$("#addTeacher").hide();
		$("#addStudents").hide();
		$("#addSubjLoad").hide();
		$("#addSubjLoad2").hide();
		$("#viewSubjectLoad").hide();
		$("#viewSubjects").hide();
		$("#viewStudents").hide();
	});
	
	$("#teacher").click(function(){
		$("#students").removeClass().addClass('inactive');
		$("#subjects").removeClass().addClass('inactive');
		$("#teacher").removeClass().addClass('activeT');
		$("#studBar").slideUp();
		$("#subBar").slideUp();
		$("#profBar").slideDown();
		$("#addSubjs").hide();
		$("#addTeacher").show();
		$("#addStudents").hide();
		$("#addSubjLoad").hide();
		$("#addSubjLoad2").hide();
		$("#viewSubjectLoad").hide();
		$("#viewSubjects").hide();
		$("#viewStudents").hide();
	});
	
	$("#upStud").click(function(){
		$("#upStud").removeClass().addClass('actives');
		$("#viewStud").removeClass().addClass('inactives');
		$("#viewSubjects").hide();
		$("#viewStudents").hide();
		$("#addStudents").show();
	});
	
	$("#viewStud").click(function(){
		$("#upStud").removeClass().addClass('inactives');
		$("#viewStud").removeClass().addClass('actives');
		$("#addStudents").hide();
		$("#viewStudents").hide();
		var year = sessionStorage.getItem('seYe');
		var section = sessionStorage.getItem('section');
		viewSubjects(year,section);
		$("#viewSubjects").show();
	});
	
	$("#addSub").click(function(){
		$("#addSub").removeClass().addClass('actives');
		$("#subLoad").removeClass().addClass('inactives');
		$("#addSubjs").show();
		$("#addSubjLoad").hide();
		$("#addSubjLoad2").hide();
		$("#viewSubjectLoad").hide();
	});
	
	$("#subLoad").click(function(){
		$("#addSub").removeClass().addClass('inactives');
		$("#subLoad").removeClass().addClass('actives');
		$("#addSubjs").hide();
		$("#addSubjLoad").show();
		$("#addSubjLoad2").hide();
		$("#viewSubjectLoad").hide();
	});
	
	$("#logout").click(function(){
		logout();
	});
});