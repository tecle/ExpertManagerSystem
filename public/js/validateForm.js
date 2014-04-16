//转义特殊字符
function coder(str)
{
   var s = "";
   if (str.length == 0) return "";
   s = str.replace(/&/g, "&gt;");
   s = s.replace(/</g,   "&lt;");
   s = s.replace(/>/g,   "&gt;");
   s = s.replace(/ /g,   "&nbsp;");
   s = s.replace(/\'/g,  "&#39;");
   s = s.replace(/\"/g,  "&quot;");
   s = s.replace(/\n/g,  "<br>");
   return s;
}
//反转义
function decoder(str)
{
   var s = "";
   if (str.length == 0) return "";
   s = str.replace("&gt;", /&/g);
   s = s.replace( "&lt;",/</g);
   s = s.replace("&gt;", />/g);
   s = s.replace("&nbsp;", / /g);
   s = s.replace("&#39;",/\'/g);
   s = s.replace("&quot;", /\"/g);
   s = s.replace("<br>", /\n/g);
   return s;
}
/*
*功能：获取字符串长度  
*时间：2007-10-22
*使用说明：传入value；返回true或false
*/

function getLength(str){
   return str.length;
}
/*
*功能：获取输入字符串的字节数，一个中文字为两个字节。
*时间：2008-05-20
*使用说明：传入value；返回length
*/
function getByte(str){
	return str.replace(/[^\x00-\xff]/g,"**").length;
}
/*
*功能：除去字符串前后的回车、空格、换行符 
*时间：2007-10-22
*用法：传入string
*/
function trimSpace(val){  
	return val.replace(/(^[\n\r\s]*)|([\n\r\s]*$)/g, ""); 
}  
/*
*功能：除去字符串前后的空格 
*时间：2007-10-22
*用法：传入string
*/
function trim(val){
    return val.replace(/(^\s*)|(\s*$)/g, "");
} 
/*
*功能：单双引号转义 
*时间：2007-10-22
*用法：传入string
*/
function trimText(val){
    val = val.replace(/\"/g, "&quot;");
	return val.replace(/\'/g,"&acute;")
} 

/*
*功能：字符串空校验
*时间：2007-10-22
*使用说明：传入String；空返回true否则返回false
*/
function isEmpty(str){
	var newString = trim(str);
	if(newString==null||newString=="") return true;
	else  return false;
}       
/*
*功能：数值验证
*时间：2008-05-20
*使用说明：传入value值；返回true或false
*/	
function isNumber(val){
	val = trim(val);
	if(isEmpty(val)){return true; } 
	var testVal=/^\d+$/;
	return testVal.test(val); 
}
/*
*功能：自然数或正整数验证
*时间：2008-05-20
*使用说明：传入value值；返回true或false
*/
function isNatrual(val){
	val = trim(val);	
	if(isEmpty(val)){return true; } 
	var testVal=/^([0-9]|([1-9]\d*))$/;
	return testVal.test(val); 
}
/*
*功能：整数验证
*时间：2008-05-20
*使用说明：传入value值；返回true或false
*/
function isInteger(val){	
	val = trim(val);
	if(isEmpty(val)){return true; } 
	var testVal=/^([-\+]?([0-9]|([1-9]\d*)))$/;
	return testVal.test(val); 
}
/*
*功能：带符号小数验证
*时间：2008-05-20
*使用说明：传入value值；返回true或false
*/
function isSignFloat(val){	 
	val = trim(val);
	if(isEmpty(val)){return true; }
	var testVal=/^([-\+]?([0-9]|([1-9]\d*))(\.\d+)?)$/;
	return testVal.test(val); 
}
/*
*功能：无符号小数验证
*时间：2008-05-20
*使用说明：传入value值；返回true或false
*/
function isFloat(val){	
	val = trim(val); 
	if(isEmpty(val)){return true; }
	var testVal=/^(([0-9]|([1-9]\d*))(\.\d+)?)$/;
	return testVal.test(val); 
}
/*
*功能：英文字符验证
*时间：2008-05-20
*使用说明：传入value值；返回true或false
*/
function isEnglish(val){
	val = trim(val);
	if(isEmpty(val)){return true; }	 
	var testVal=/^[A-Za-z]+$/;
	return testVal.test(val); 
}
/*
*功能：中文字符验证
*时间：2008-05-20
*使用说明：传入value值；返回true或false
*/
function isChinese(val){
	val = trim(val);	
	if(isEmpty(val)){return true; } 
	var testVal=/^[\u0391-\uFFE5]+$/;
	return testVal.test(val); 
}
/*
*功能：名字验证（中文字符，英文字符）
*时间：2008-05-20
*使用说明：传入value值；返回true或false
*/
function isProjectName(val){
	val = trim(val);
	var testVal=/^[0-9A-Za-z\u0391-\uFFE5_-]+$/;
	return testVal.test(val);
}
function isAccountName(val){
	val = trim(val);
	var testVal=/^[0-9A-Za-z_-]+$/;
	return testVal.test(val); 
}
function isName(val){
	val = trim(val);
	var testVal=/^[A-Za-z\u0391-\uFFE5]+$/;
	return testVal.test(val);
}
/*
*功能：英文或数值字符验证 判断是否是0-9或a－z或A－Z的字符
*时间：2008-05-20
*使用说明：传入value值；返回true或false
*/
function isCharOrNum(val){	
	val = trim(val);
	if(isEmpty(val)){return true; } 
	var testVal=/^\w+[\w.-]*$/;
	return testVal.test(val); 
} 
/*
*功能：电话号码验证
*时间：2008-05-20
*使用说明：传入value值；返回true或false
*/
function isPhone(val){ 
	val = trim(val);
	if(isEmpty(val)){return true; }
	var testVal=/^(((\(\d{2,3}\))|(\d{2,3}\-))?(\(0\d{2,3}\)|0\d{2,3})?-?[1-9]\d{6,7}(\-\d{1,4})?)$/;
	return testVal.test(val);
} 
/*
*功能：移动电话验证
*时间：2008-05-20
*使用说明：传入value值；返回true或false
*/
function isMobile(val){ 
	val = trim(val);
	if(isEmpty(val)){return true; }
	var testVal=/^((\(\d{2,3}\))|(\d{3}\-))?1\d{10}$/;
	return testVal.test(val);
}                   
/*
*功能：非法字符校验
*时间：2008-05-22
*使用说明：val为验证的目标String；
		  chars为要验证的特殊字符串；注意"\"为"\\"
		  返回true否则返回false
*/
function isSpecial(val,chars){
	val = trim(val);
	chars = trim(chars);
	if(isEmpty(val)||isEmpty(chars)){return true; }
	var oneChar= "";
	var testChars ="";
	for(var i=0;i<chars.length;i++){
		oneChar=chars.charAt(i);
		testChars = testChars + "\\" + oneChar; 
	} 
	testChars = "^[^\\"+testChars+"]*$";
	var testVal=new RegExp(testChars);    
	return testVal.test(val); 
} 
/*
*功能：校验Email是否合法  
*时间：2007-10-22
*使用说明：传入value；返回true或false
*/
function isEmail(val){
	val = trim(val);
	if(isEmpty(val)){return true; }
	var testVal=/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/; 
	return testVal.test(val);
} 


function checkPicExt(obj){
	var allowext = ".jpg,.gif";
	picsrc = obj.value;
	fileExt = picsrc.substr(obj.value.lastIndexOf(".")).toLowerCase(); 
	 if(allowext.indexOf(fileExt)==-1) return false;
	 return true;
}

function checkPicSize(obj){
   allowsize = 512;
   var image=new Image();        
   image.src = obj.value;        
   if(image.fileSize > (allowsize*1024)) return false;
   else return true;         
}