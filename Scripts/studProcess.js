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

function viewGrades(user,sy,yr,section){
	if(yr == "Grade 11" || yr == "Grade 12"){
		viewGradesTwo(user,sy,yr,section);
	}
	else if(yr == ""){
		alert("There's an error connecting to the database");
		logout();
	}
	else{
		viewGradesOne(user,sy,yr,section);
	}
}

function viewGradesOne(user,sy,yr,section){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("viewGrade").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "Process/viewGrades.php?user="+user+"&sy="+sy+"&yr="+yr+"&section="+section, true);
	xhttp.send();
}

function viewGradesTwo(user,sy,yr,section){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("viewGrade").innerHTML = this.responseText;
		}
	};
	xhttp.open("GET", "Process/viewGradesSem.php?user="+user+"&sy="+sy+"&yr="+yr+"&section="+section, true);
	xhttp.send();
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