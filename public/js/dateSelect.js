
var syear = 2015;
var init_year = 0;
var init_day = 0;
var init_month = 0;
function initDate(yobj, mobj, dobj, year, month, day){
   // alert(init_year);
//    alert(init_month);
//    alert(init_day);
    yobj.length = 0;
    mobj.length = 0;
    dobj.length = 0;
    init_year = year;
    init_month = month;
    init_day = day;
	var oOption = document.createElement("OPTION");
	oOption.text = "请选择";
	oOption.value = 0;
	yobj.add(oOption);
	
	var oOption = document.createElement("OPTION");
	oOption.text = "请选择";
	oOption.value = 0;
	mobj.add(oOption);
	
	var oOption = document.createElement("OPTION");
	oOption.text = "请选择";
	oOption.value = 0;
	dobj.add(oOption);
	for(var i = syear; i >= 1900; i--){
			var oOption = document.createElement("OPTION");
			oOption.text= i;
			oOption.value= i;
            if(i==init_year)
                oOption.selected = true;
			yobj.add(oOption);
		  }
	for(var i = 1; i <= 12; i++){
			var oOption = document.createElement("OPTION");
			oOption.text= i;
			oOption.value= i;
            if(i==init_month)
                oOption.selected = true;
			mobj.add(oOption);
		  }
    if((init_day) && init_day!=0){
        resetDay(yobj, mobj, dobj);
    }
}
/*for(var i = 1; i <= 31; i++){
	    var oOption = document.createElement("OPTION");
	  	oOption.text= i;
		oOption.value= i;
		dobj.add(oOption);
	  }*/
	  function setSyear(year){
		syear = year;
		}
	  function resetDay(yobj, mobj, dobj){
		//  alert("resetday");
		  dobj.length = 0;	
		  var oOption = document.createElement("OPTION");
		  oOption.text= "请选择";
		  oOption.value= 0;
		  dobj.add(oOption);
		  var maxDay;
		  var year = yobj.value;
		  var month = mobj.value;
		  if(month == 1 || month == 3 || month == 5 || month == 7 || month == 8 || month == 10 || month == 12){
			 maxDay = 31;
		  }
		  else if(month == 2){
			if(year%4 == 0){
				maxDay = 29;
			}
			else{
				maxDay = 28;
			}
		  }
		  else{
			maxDay = 30;  
		  }
		  for(var i = 1; i <= maxDay; i++){
			var oOption = document.createElement("OPTION");
			oOption.text= i;
			oOption.value= i;
            if(i==init_day)
                oOption.selected = true;
			dobj.add(oOption);
		  }
		}
	   // JavaScript Document
	  
	 