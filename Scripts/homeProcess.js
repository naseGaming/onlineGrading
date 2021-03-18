function loginProcess() { /*function for login process*/
	var btnClass = $("#btnLogin").attr("class");
	var user = document.getElementById("txtUsername").value;
	var pass = document.getElementById("txtPassword").value;
	
	if(btnClass == "btnsC"){
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var a = this.responseText; /*returns the value of process*/
				if(a == "1"){
					alert("Account does not exist");
				}
				else if(a == "2"){
					alert("Invalid password");
				}
				else{
					alert("Successful");
					checkRole(a);
				}
			}
		};
		xhttp.open("GET", "Process/loginProcess.php?user="+user+"&pass="+pass, true);
		xhttp.send();
	}
	else{
		alert("Inputs cannot be empty");
	}
}

function changeColor(){ /*Changes the css of inputs depending if its empty or not*/
	var user = document.getElementById("txtUsername").value;
	var pass = document.getElementById("txtPassword").value;
	
	if(user == "" && pass == ""){
		$("#txtUsername").removeClass().addClass('inp');
		$("#txtPassword").removeClass().addClass('inp');
		$("#btnLogin").removeClass().addClass('btns');
	}
	else if(user != "" && pass == ""){
		$("#txtUsername").removeClass().addClass('inpC');
		$("#txtPassword").removeClass().addClass('inp');
		$("#btnLogin").removeClass().addClass('btns');
	}
	else if(user == "" && pass != ""){
		$("#txtUsername").removeClass().addClass('inp');
		$("#txtPassword").removeClass().addClass('inpC');
		$("#btnLogin").removeClass().addClass('btns');
	}
	else{
		$("#txtUsername").removeClass().addClass('inpC');
		$("#txtPassword").removeClass().addClass('inpC');
		$("#btnLogin").removeClass().addClass('btnsC');
	}
}

function checkRole(user){ /*checks the role of the user*/
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var a = this.responseText;
			window.sessionStorage.setItem('user', user);
			if(a == "0"){
				window.location.href = "admin.php";
			}
			else if(a == "1"){
				checkName(user,a)
			}
			else if(a == "2"){
				checkName(user,a)
				checkSy();
				checkYear(user);
				checkSection(user);
			}
			else{
				alert(a);
			}
		}
	};
	xhttp.open("GET", "Process/checkRole.php?user="+user, true);
	xhttp.send();
}

function checkName(user,role){ /*checks the name of the user*/
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var a = this.responseText;
			window.sessionStorage.setItem('prof', a);
			window.sessionStorage.setItem('stud', a);
			
			var sub = "";
			var sec = "";
			
			if(role == "1"){
				window.location.href = "teacher.php?sub="+sub+"&sec="+sec;
				window.sessionStorage.setItem('upFlag', 'false');
				window.sessionStorage.setItem('checkFlag', 'false');
			}
			else if(role = "2"){
				window.location.href = "student.php";
			}
			else{
				alert("Error getting account type");
			}
		}
	};
	xhttp.open("GET", "Process/checkName.php?user="+user, true);
	xhttp.send();
}

function checkSy(){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var sy = this.responseText;
			window.sessionStorage.setItem('sy', sy);
		}
	};
	xhttp.open("GET", "Process/checkSy.php", true);
	xhttp.send();
}

function checkYear(user){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var year = this.responseText;
			window.sessionStorage.setItem('year', year);
		}
	};
	xhttp.open("GET", "Process/checkYear.php?user="+user, true);
	xhttp.send();
}

function checkSection(user){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var section = this.responseText;
			window.sessionStorage.setItem('section', section);
		}
	};
	xhttp.open("GET", "Process/checkSection.php?user="+user, true);
	xhttp.send();
}