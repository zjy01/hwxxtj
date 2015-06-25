function check(){
	if(login.number.value==''){
		alert("职工号不能为空！请重新输入");
		login.number.focus();
		return false;
	}
	else if(login.password.value==''){
		alert("密码不能为空！请重新输入");
		login.password.focus();
		return false;
	}
}