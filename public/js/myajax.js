function callAjax(string) {
         // alert(string);
        $.ajax({
                type: 'post',
                //可选get
                url: '/CIFramework/index.php/expert/welcome/expertAjax',
                //这里是接收数据的PHP程序
                data: string,
                //传给PHP的数据，多个参数用&连接
                dataType: 'text',
                //服务器返回的数据类型 可选XML ,Json jsonp script html text等
                success: function(msg) {

                        if ($.trim(msg) == "y") {
                                alert("修改成功!");
                                window.top.location.reload();
                        } else {
                                alert("修改失败!");
                        }
                        
                        //这里是ajax提交成功后，PHP程序返回的数据处理函数。msg是返回的数据，数据类型在dataType参数里定义！
                },
                error: function() {
                        alert("处理异常，请重试!");
                }
        })
}
//file
function uf() {
    var fileObj = document.getElementById("imgfile").files[0]; // 获取文件对象
    var FileController = "/CIFramework/index.php/expert/welcome/uploadImg";                    // 接收上传文件的后台地址 
    var form = new FormData();
    
    form.append("eid", $('#expertid').val());                        // 可以增加表单数据
    form.append("file", fileObj);                           // 文件对象
    var xhr = new XMLHttpRequest();
    xhr.open("post", FileController, true);
    xhr.onload = function () {

        if (this.status == 200) {
            var data=eval("("+this.responseText+")");
            if(data.error != '')
				{
					alert(data.error);
				}else
				{
					//alert('Upload success!');
                    $('#cng_span').hide();
				    $('#ephoto').attr("src","/CIFramework/public/uploads/"+data.fname);
				}

		}
    };
    xhr.send(form);
}
//guestajax
function callGuestAjax(string){
    //alert(string);
        $.ajax({
                type: 'post',
                //可选get
                url: '/CIFramework/index.php/guest/welcome/alterGuestAjax',
                //这里是接收数据的PHP程序
                data: string,
                //传给PHP的数据，多个参数用&连接
                dataType: 'text',
                //服务器返回的数据类型 可选XML ,Json jsonp script html text等
                success: function(msg) {
                    //alert(msg);
                        if ($.trim(msg) == "y") {
                                alert("修改成功!");
                                window.top.location.reload();
                        } else {
                                alert("修改失败!");
                        }
                        //这里是ajax提交成功后，PHP程序返回的数据处理函数。msg是返回的数据，数据类型在dataType参数里定义！
                },
                error: function() {
                        alert("处理异常，请重试!");
                }
        })
}
//这个就是用来修改EP的ajax脚本

function callAjaxAlterEP(string) {
        $.ajax({
                type: 'post',
                //可选get
                url: '/CIFramework/index.php/project/welcome/alterEPAjax',
                //这里是接收数据的PHP程序
                data: string,
                //传给PHP的数据，多个参数用&连接
                dataType: 'text',
                //服务器返回的数据类型 可选XML ,Json jsonp script html text等
                success: function(msg) {
                        if ($.trim(msg) == "y") {
                                //alert("修改成功!");
                                window.top.location.reload();
                        } else {
                                alert("修改失败!");
                        }
                        //这里是ajax提交成功后，PHP程序返回的数据处理函数。msg是返回的数据，数据类型在dataType参数里定义！
                },
                error: function() {
                        alert("处理异常，请重试!");
                }
        })
}
//这个是修改项目信息的AJAX调用

function callAjaxToProject(string) {
        $.ajax({
                type: 'post',
                //可选get
                url: '/CIFramework/index.php/project/welcome/projectAjax',
                //这里是接收数据的PHP程序
                data: string,
                //传给PHP的数据，多个参数用&连接
                dataType: 'text',
                //服务器返回的数据类型 可选XML ,Json jsonp script html text等
                success: function(msg) {
                        //alert(msg);
                        if ($.trim(msg) == "y") {
                                //alert("修改成功!");
                                window.top.location.reload();
                        } else {
                                alert("修改失败!");
                        }
                        //这里是ajax提交成功后，PHP程序返回的数据处理函数。msg是返回的数据，数据类型在dataType参数里定义！
                },
                error: function() {
                        alert("处理异常，请重试!");
                }
        })
}
//绑定专家到项目

function callAjaxBoundEP(string, pid) {
        $.ajax({
                type: 'post',
                //可选get
                url: '/CIFramework/index.php/project/welcome/dealaddexpert',
                //这里是接收数据的PHP程序
                data: string,
                //传给PHP的数据，多个参数用&连接
                dataType: 'text',
                //服务器返回的数据类型 可选XML ,Json jsonp script html text等
                success: function(msg) {
                  
                        if ($.trim(msg) == "y") {
                                alert("修改成功!");
                                window.location.href = "/CIFramework/index.php/project/welcome/addExpertFinish/" + pid;
                        } else {
                                alert("修改失败!请检查该专家是否已经被添加！");
                                //window.location.href="projectAddExperted.php?piid="+pid;
                        }
                        //这里是ajax提交成功后，PHP程序返回的数据处理函数。msg是返回的数据，数据类型在dataType参数里定义！
                },
                error: function() {
                        alert("处理异常，请重试!");
                }
        })
}
//修改专家基本信息

function alterBasicInfo() {
        var estate = $('#estatus').attr('value');
        var ecomefrom = $('#ecomefrom').attr('value');
        var ename = $('#ename').attr('value');
        var mobile = $('#ecellphone').attr('value');
        var landline = $('#elandphone').attr('value');
        var email = $('#email').attr('value');
        var msn = $('#emsn').attr('value');
        var qq = $('#eqq').attr('value');
        var sex = $('#esex').attr('value');
        var eid = $('#expertid').attr('value');
        var birday = $('#ebirthday').attr('value');
        if (estate == 0) {
                estate = '';
        }
        
        if (sex != 'F' && sex != 'M') sex = '';
        var location = $('#eprovince').attr('value') + "," + $('#ecity').attr('value');
        if ($('#eprovince').attr('value') == "") location = "";
        var sendInfo = "ebirthday=" + birday + "&esex=" + sex + "&elocation=" + location + "&emobile=" + mobile + 
        "&elandline=" + landline + "&eemail=" + email + "&emsn=" + msn + "&eqq=" + qq + "&type=1" + "&eid=" + eid + "&estate=" + estate + "&ename=" + ename + "&ecomefrom=" + ecomefrom;
        callAjax(sendInfo);
}
//修改行业和子行业

function alterTrade() {
        var etrade = $('#eprofession').attr('value');
        var esubtrade = $('#esubprofession').attr('value');
        var eid = $('#expertid').attr('value');
        var sendInfo = "etrade=" + etrade + "&esubtrade=" + esubtrade + "&type=3" + "&eid=" + eid;
        callAjax(sendInfo);
}
//修改备注

function alterRemark() {
        var note = $('#eremark').attr('value');
        var eid = $('#expertid').attr('value');
        //alert(note);
        var str = "eremark=" + note + "&eid=" + eid + "&type=6";
        callAjax(str);
}
//添加工作经验

function addExp() {
        var istonow = $('#etonow').attr('value');
        var company = $('#ecompany').attr('value');
        var agency = $('#esection').attr('value');
        var position = $('#eposition').attr('value');
        var duty = $('#responbilities').attr('value');
        var area = $('#experisearea').attr('value');
        var eid = $('#expertid').attr('value');
        var sw = $('#stime').attr('value');
        var ew = $('#etime').attr('value');
        var sendInfo = "company=" + company + "&agency=" + agency 
        + "&position=" + position + "&duty=" + duty + "&area=" +area
        + "&type=4" + "&eid=" + eid + "&stime=" + sw + "&etime=" + ew + "&istonow=" + istonow;
        callAjax(sendInfo);
}
//修改经历
function alterExp() {
        var expid = $('#cur_exp').attr('value');
        var istonow = $('#etonow').attr('value');
        var company = $('#ecompany').attr('value');
        var agency = $('#esection').attr('value');
        var position = $('#eposition').attr('value');
        var duty = $('#responbilities').attr('value');
        var area = $('#experisearea').attr('value');
        var eid = $('#expertid').attr('value');
        var sw = $('#stime').attr('value');
        var ew = $('#etime').attr('value');
        var sendInfo = "expid=" + expid + "&newcompany=" + company + "&newagency=" + agency 
        + "&newposition=" + position + "&newduty=" + duty + "&newarea=" +area
        + "&type=7" + "&newstime=" + sw + "&newetime=" + ew + "&newistonow=" + istonow+'&eid='+eid;
       // alert(sendInfo);
        callAjax(sendInfo);
}
//增加顾问评论

function addComment() {
        var eproblem = $('#eproblem').attr('value');
        var ecomment = $('#ecomment').attr('value');
        var eid = $('#expertid').attr('value');
        var sendInfo = "eproblem=" + eproblem + "&ecomment=" + ecomment + "&eid=" + eid + "&type=5";
        callAjax(sendInfo);
}
//修改专家收费标准

function alterCost() {
        var astandard = $('#echarge').attr('value');
        var alevel = $('#elevel').attr('value');
        var abank = $('#ebank').attr('value');
        var asubbranch = $('#esubbank').attr('value');
        var acardnumber = $('#eanumber').attr('value');
        var aname = $('#eaname').attr('value');
        var eid = $('#expertid').attr('value');
        var sendInfo = "astandard=" + astandard + "&alevel=" + alevel + "&abank=" + abank + "&asubbranch=" + asubbranch + "&acardnumber=" + acardnumber + "&aname=" + aname + "&type=2" + "&eid=" + eid;
        callAjax(sendInfo);
}
//修改项目需求信息,1
function alterNeedInfo() {
        var piid = $('#proid').attr('value');
        var peneed = $('#peneed').attr('value');
        var updatefreq = $('#updatefreq').attr('value');
        var comchannel = $('#comchannel').attr('value');
        var dailyiquota = $('#dailyiquota').attr('value');
        var iSMS = $('#iSMS').attr('value');
        var ew = $('#endtime').attr('value');
        
        var sendInfo = "piid=" + piid + "&peneed=" + peneed + "&updatefreq=" + updatefreq + 
        "&type=1" + "&comchannel=" + comchannel + "&endtime=" + ew + "&dailyiquota=" + dailyiquota + 
        "&iSMS=" + iSMS;
        callAjaxToProject(sendInfo);
}
//修改项目高级信息,3
function alterAdvancedInfo() {
        var piid = $('#proid').attr('value');
        var eneed = $('#peneed').attr('value');
        var outline = $('#poutline').attr('value');
        var ey = $('#peyear').attr('value');
        var em = $('#pemonth').attr('value');
        var ed = $('#peday').attr('value');
        if (ey == '') var ew = "";
        else {
                if (em == '') em = "1";
                if (ed == '') ed = '1';
                var ew = ey + "-" + em + "-" + ed;
        }
        var goodtime = $('#piperiod').attr('value');
        var expertposition = $('#peposition').attr('value');
        var updatefreq = $('#updatefreq').attr('value');
        var updateform = $('#updateform').attr('value');
        var testkw = $('#testkw2').attr('value');
        var sendInfo = "eneed=" + eneed + "&goodtime=" + goodtime + "&outline=" + outline + 
        "&type=3" + "&piid=" + piid + "&expertposition=" + expertposition + 
        "&endtime=" + ew + "&updatefreq=" + updatefreq + "&updateform=" + 
        updateform + "&testkw=" + testkw;
        callAjaxToProject(sendInfo);
}
//修改项目基本信息,2
function alterProBasic() {
        var piid = $('#proid').attr('value');
        var pname = $('#pname').attr('value');
        var pemcontact = $('#pemcontact').attr('value');
        var pem = $('#pem').attr('value');
        var pcode = $('#pcode').attr('value');
        var pcontact = $('#pcontact').attr('value');
        var sendInfo = "piid=" + piid + "&pname=" + pname +  
        "&pem=" + pem + "&pcode=" + pcode + "&pemcontact=" + pemcontact + "&type=2" + "&pcontact=" + pcontact;
        callAjaxToProject(sendInfo);
}
//修改项目备注,4
function alterProRemark(){
        var piid = $('#proid').attr('value');
        var premark = $('#premark').attr('value');
        var sendInfo = "piid=" + piid + "&premark=" + premark + "&type=4" ;
        callAjaxToProject(sendInfo);
}
//修改项目详细需求,5
function alterProDiscribe(){
        var piid = $('#proid').attr('value');
        var pediscribe = $('#pediscribe').attr('value');
        var sendInfo = "piid=" + piid + "&pediscribe=" + pediscribe + "&type=5" ;
        callAjaxToProject(sendInfo);
}

function loginUser() {
        var name = $('#name').attr('value');
        var password = $('#password').attr('value');
        var sendInfo = "name=" + name + "&password=" + password;
        //alert(sendInfo);
        $.ajax({
                type: 'post',
                //可选get
                url: '/CIFramework/index.php/welcome/loginAjax',
                //这里是接收数据的PHP程序
                data: sendInfo,
                //传给PHP的数据，多个参数用&连接
                dataType: 'text',
                //服务器返回的数据类型 可选XML ,Json jsonp script html text等
                success: function(msg) {
                        msg = $.trim(msg);
                        if (msg == "n") {
                                alert("用户名密码错误！");
                        } else {
                                var info = msg.split("|");
                                if (info.length < 3) {
                                        alert(info.length);
                                        alert("System Wrong!");
                                        return;
                                }
                                if (info[2] != "a") {
                                        alert("欢迎您，" + info[1] + '!(普通用户)');
                                        var userId = info[0]; //接下来应该设置cookies
                                        top.location = '/CIFramework/index.php/welcome/showMain';
                                } else if (info[2] == "a") {
                                        alert("欢迎您，" + info[1] + "(管理员)");
                                        var userId = info[0]; //接下来应该设置cookies,包括用户id，用户名，用户角色
                                        top.location = '/CIFramework/index.php/welcome/showMain';
                                }
                        }
                },
                error: function() {
                        alert("处理异常，请重试!");
                }
        });
}

function len(s) {
        var l = 0;
        var a = s.split("");
        for (var i = 0; i < a.length; i++) {
                if (a[i].charCodeAt(0) < 299) {
                        l++;
                } else {
                        l += 2;
                }
        }
        return l;
}
//写cookies

function setCookie(name, value, time) {
        var Days = 1;
        var exp = new Date();
        exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
        document.cookie = name + "=" + encodeURI(value) + ";expires=" + exp.toGMTString();
}
//读取cookies

function getCookie(name) {
        var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
        if (arr = document.cookie.match(reg)) return (arr[2]);
        else
        return null;
}
//删除cookies

function delCookie(name) {
        var exp = new Date();
        exp.setTime(exp.getTime() - 1);
        var cval = getCookie(name);
        if (cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
}

function getsec(str) {
        var str1 = str.substring(1, str.length) * 1;
        var str2 = str.substring(0, 1);
        if (str2 == "s") {
                return str1 * 1000;
        } else if (str2 == "h") {
                return str1 * 60 * 60 * 1000;
        } else if (str2 == "d") {
                return str1 * 24 * 60 * 60 * 1000;
        }
}
//删除工作经历
function deleteWork(eid, wid){
    var sendInfo = "eid=" + eid + "&expid=" + wid + "&type=9";
    callAjax(sendInfo);
}
//删除评论
function deleteComment(eid, cmtid){
    var sendInfo = "eid=" + eid + "&cmtid=" + cmtid + "&type=10";
    callAjax(sendInfo);
}
//删除专家
function deleteExpert(eid){
    var string = "eid=" + eid + "&type=8";
    $.ajax({
                type: 'post',
                //可选get
                url: '/CIFramework/index.php/expert/welcome/expertAjax',
                //这里是接收数据的PHP程序
                data: string,
                //传给PHP的数据，多个参数用&连接
                dataType: 'text',
                //服务器返回的数据类型 可选XML ,Json jsonp script html text等
                success: function(msg) {

                        if ($.trim(msg) == "y") {
                                alert("删除成功!");
                                window.top.location="/CIFramework/index.php/expert/welcome";
                        } else {
                                alert("删除失败!");
                        }
                        
                        //这里是ajax提交成功后，PHP程序返回的数据处理函数。msg是返回的数据，数据类型在dataType参数里定义！
                },
                error: function() {
                        alert("处理异常，请重试!");
                }
        })
}
//删除项目
function deleteProject(piid){
    var string = "piid="+piid+"&type=8";
    $.ajax({
                type: 'post',
                //可选get
                url: '/CIFramework/index.php/project/welcome/projectAjax',
                //这里是接收数据的PHP程序
                data: string,
                //传给PHP的数据，多个参数用&连接
                dataType: 'text',
                //服务器返回的数据类型 可选XML ,Json jsonp script html text等
                success: function(msg) {
                        //alert(msg);
                        if ($.trim(msg) == "y") {
                                alert("删除成功!");
                                window.top.location='/CIFramework/index.php/project/welcome';
                        } else {
                                alert("删除失败!");
                        }
                        //这里是ajax提交成功后，PHP程序返回的数据处理函数。msg是返回的数据，数据类型在dataType参数里定义！
                },
                error: function() {
                        alert("处理异常，请重试!");
                }
        })
}

//删除客户
function deleteGuest(gid){
    var string = "gid=" + gid + "&type=3";
    $.ajax({
                type: 'post',
                //可选get
                url: '/CIFramework/index.php/guest/welcome/alterGuestAjax',
                //这里是接收数据的PHP程序
                data: string,
                //传给PHP的数据，多个参数用&连接
                dataType: 'text',
                //服务器返回的数据类型 可选XML ,Json jsonp script html text等
                success: function(msg) {
                    //alert(msg);
                        if ($.trim(msg) == "y") {
                                alert("修改成功!");
                                window.top.location='/CIFramework/index.php/guest/welcome';
                        } else {
                                alert("修改失败!");
                        }
                        //这里是ajax提交成功后，PHP程序返回的数据处理函数。msg是返回的数据，数据类型在dataType参数里定义！
                },
                error: function() {
                        alert("处理异常，请重试!");
                }
        })
}