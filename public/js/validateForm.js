//ת�������ַ�
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
//��ת��
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
*���ܣ���ȡ�ַ�������  
*ʱ�䣺2007-10-22
*ʹ��˵��������value������true��false
*/

function getLength(str){
   return str.length;
}
/*
*���ܣ���ȡ�����ַ������ֽ�����һ��������Ϊ�����ֽڡ�
*ʱ�䣺2008-05-20
*ʹ��˵��������value������length
*/
function getByte(str){
	return str.replace(/[^\x00-\xff]/g,"**").length;
}
/*
*���ܣ���ȥ�ַ���ǰ��Ļس����ո񡢻��з� 
*ʱ�䣺2007-10-22
*�÷�������string
*/
function trimSpace(val){  
	return val.replace(/(^[\n\r\s]*)|([\n\r\s]*$)/g, ""); 
}  
/*
*���ܣ���ȥ�ַ���ǰ��Ŀո� 
*ʱ�䣺2007-10-22
*�÷�������string
*/
function trim(val){
    return val.replace(/(^\s*)|(\s*$)/g, "");
} 
/*
*���ܣ���˫����ת�� 
*ʱ�䣺2007-10-22
*�÷�������string
*/
function trimText(val){
    val = val.replace(/\"/g, "&quot;");
	return val.replace(/\'/g,"&acute;")
} 

/*
*���ܣ��ַ�����У��
*ʱ�䣺2007-10-22
*ʹ��˵��������String���շ���true���򷵻�false
*/
function isEmpty(str){
	var newString = trim(str);
	if(newString==null||newString=="") return true;
	else  return false;
}       
/*
*���ܣ���ֵ��֤
*ʱ�䣺2008-05-20
*ʹ��˵��������valueֵ������true��false
*/	
function isNumber(val){
	val = trim(val);
	if(isEmpty(val)){return true; } 
	var testVal=/^\d+$/;
	return testVal.test(val); 
}
/*
*���ܣ���Ȼ������������֤
*ʱ�䣺2008-05-20
*ʹ��˵��������valueֵ������true��false
*/
function isNatrual(val){
	val = trim(val);	
	if(isEmpty(val)){return true; } 
	var testVal=/^([0-9]|([1-9]\d*))$/;
	return testVal.test(val); 
}
/*
*���ܣ�������֤
*ʱ�䣺2008-05-20
*ʹ��˵��������valueֵ������true��false
*/
function isInteger(val){	
	val = trim(val);
	if(isEmpty(val)){return true; } 
	var testVal=/^([-\+]?([0-9]|([1-9]\d*)))$/;
	return testVal.test(val); 
}
/*
*���ܣ�������С����֤
*ʱ�䣺2008-05-20
*ʹ��˵��������valueֵ������true��false
*/
function isSignFloat(val){	 
	val = trim(val);
	if(isEmpty(val)){return true; }
	var testVal=/^([-\+]?([0-9]|([1-9]\d*))(\.\d+)?)$/;
	return testVal.test(val); 
}
/*
*���ܣ��޷���С����֤
*ʱ�䣺2008-05-20
*ʹ��˵��������valueֵ������true��false
*/
function isFloat(val){	
	val = trim(val); 
	if(isEmpty(val)){return true; }
	var testVal=/^(([0-9]|([1-9]\d*))(\.\d+)?)$/;
	return testVal.test(val); 
}
/*
*���ܣ�Ӣ���ַ���֤
*ʱ�䣺2008-05-20
*ʹ��˵��������valueֵ������true��false
*/
function isEnglish(val){
	val = trim(val);
	if(isEmpty(val)){return true; }	 
	var testVal=/^[A-Za-z]+$/;
	return testVal.test(val); 
}
/*
*���ܣ������ַ���֤
*ʱ�䣺2008-05-20
*ʹ��˵��������valueֵ������true��false
*/
function isChinese(val){
	val = trim(val);	
	if(isEmpty(val)){return true; } 
	var testVal=/^[\u0391-\uFFE5]+$/;
	return testVal.test(val); 
}
/*
*���ܣ�������֤�������ַ���Ӣ���ַ���
*ʱ�䣺2008-05-20
*ʹ��˵��������valueֵ������true��false
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
*���ܣ�Ӣ�Ļ���ֵ�ַ���֤ �ж��Ƿ���0-9��a��z��A��Z���ַ�
*ʱ�䣺2008-05-20
*ʹ��˵��������valueֵ������true��false
*/
function isCharOrNum(val){	
	val = trim(val);
	if(isEmpty(val)){return true; } 
	var testVal=/^\w+[\w.-]*$/;
	return testVal.test(val); 
} 
/*
*���ܣ��绰������֤
*ʱ�䣺2008-05-20
*ʹ��˵��������valueֵ������true��false
*/
function isPhone(val){ 
	val = trim(val);
	if(isEmpty(val)){return true; }
	var testVal=/^(((\(\d{2,3}\))|(\d{2,3}\-))?(\(0\d{2,3}\)|0\d{2,3})?-?[1-9]\d{6,7}(\-\d{1,4})?)$/;
	return testVal.test(val);
} 
/*
*���ܣ��ƶ��绰��֤
*ʱ�䣺2008-05-20
*ʹ��˵��������valueֵ������true��false
*/
function isMobile(val){ 
	val = trim(val);
	if(isEmpty(val)){return true; }
	var testVal=/^((\(\d{2,3}\))|(\d{3}\-))?1\d{10}$/;
	return testVal.test(val);
}                   
/*
*���ܣ��Ƿ��ַ�У��
*ʱ�䣺2008-05-22
*ʹ��˵����valΪ��֤��Ŀ��String��
		  charsΪҪ��֤�������ַ�����ע��"\"Ϊ"\\"
		  ����true���򷵻�false
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
*���ܣ�У��Email�Ƿ�Ϸ�  
*ʱ�䣺2007-10-22
*ʹ��˵��������value������true��false
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