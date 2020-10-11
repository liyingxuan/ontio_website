/*前端密码加密*/
function pwd_addMD5(pwd){
	pwd_arr = new Array;
	pwd = $.md5(pwd);
	pwd_arr = pwd.split('');
	pwd_arr.reverse();
	pwd_arr = pwd_arr.join('');
	pwd_arr = $.md5(pwd_arr);
	return pwd_arr;
}