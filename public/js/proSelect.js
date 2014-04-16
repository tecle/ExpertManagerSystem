var profession = new Array(19); 
var init_pro = '';
var init_sub = ''; 
function setPro(pro,subpro) { this.pro = pro; this.subpro = subpro; }  
profession[0]= new setPro("请选择行业","请选择子行业"); 
profession[1] = new setPro("农、林、牧、渔业","|农业|林业|畜牧业|渔业|农林牧渔服务业");  
profession[2] = new setPro("采矿业","|煤炭开采和洗选业|石油和天然气开采业|黑色金属矿采选业|有色金属矿采选业|非金属矿采选业|开采辅助活动|其他采矿业");  
profession[3] = new setPro("制造业","|农副食品加工业|食品制造业|酒、饮料和精制茶制造业|烟草制造业|纺织业|纺织服装、服饰业|皮草、毛皮、羽毛及其制品和制造业|木材加工和木、竹、藤、棕、草制品业|家具制造业|造纸和纸制品业|印刷和记录媒介复制业|文教、工美、体育和娱乐用品制造业|石油加工、冶焦和核燃料加工业|化学原料和化学制品制造业|医药制造业|化学纤维制造业|橡胶和塑料制品业|非金属矿物制品业|黑色金属冶炼和压延加工业|有色金属冶炼和压延加工业|金属制品业|通用设备制造业|专用设备制造业|汽车制造业|铁路、船舶、航空航天和其他运输设备制造业|电器机械和器材制造业|计算机、通信和其他电子设备制造业|仪器仪表制造业|其他制造业|废弃资源综合利用业|金属制品、机械和设备修理业");  
profession[4] = new setPro("电力、热力、燃气及水生产和供应业","|电力、热力生产和供应业|燃气生产和供应业|水的生产和供应业");  
profession[5] = new setPro("建筑业","|房屋建筑业|土木工程建筑业|建筑安装业|建筑饰物和其他建筑业");  
profession[6] = new setPro("批发和零售业","|批发业|零售业");  
profession[7] = new setPro("交通运输、仓储和邮政业","|铁路运输业|道路运输业|水上运输业|航空运输业|管道运输业|装卸搬运和运输代理业|仓储业|邮政业");  
profession[8] = new setPro("住宿和餐饮业","|住宿业|餐饮业");  
profession[9] = new setPro("信息传输、软件和信息技术服务业","|电信、广播电视和卫星传输服务|互联网和相关服务|软件和信息技术服务业");  
profession[10] = new setPro("金融业","|货币金融服务|资本市场服务|保险业|其他金融业");  
profession[11] = new setPro("房地产业","|房地产开发经营|物业管理|房地产中介服务|自由房地产经营活动|其他房地产业");  
profession[12] = new setPro("租赁和商务服务业","|租赁业|商务服务业");  
profession[13] = new setPro("科学研究和技术服务业","|研究和试验发展|专业技术服务业|科技推广与应用服务业");  
profession[14] = new setPro("水利、环境和公共设施管理业","|水利管理业|生态保护和环境治理业|公共设施管理业");  
profession[15] = new setPro("居民服务、修理和其他服务业","|居民服务业|机动车、电子产品和日用产品修理业|其他服务业");  
profession[16] = new setPro("教育","|学前教育|初等教育|中等教育|高等教育|特殊教育|技能培训、教育辅助及其他教育");  
profession[17] = new setPro("卫生和社会工作","|卫生|社会工作");  
profession[18] = new setPro("文化、体育和娱乐业 ","|新闻和出版业|广播、电视、电影和影视录音制作业|文化艺术业|体育|娱乐业"); 
function listPro(pobj,sobj,pro,sub){
    pobj.length = 0;
    sobj.length = 0;
    init_pro = pro;
    init_sub = sub;
	for(var i = 0;i < profession.length; i++){ 
		var oOption = document.createElement("OPTION");
		oOption.text= profession[i].pro;
		oOption.value= profession[i].pro;
        if( profession[i].pro == init_pro)
            oOption.selected = true;
		pobj.add(oOption);
	}

	var oOption = document.createElement("OPTION");
	oOption.text = profession[0].subpro;
	oOption.value = profession[0].subpro;
	sobj.add(oOption);
    
    if(init_sub)
        selectPro(pobj, sobj); 
}
function selectPro(pobj,sobj) { 
	sobj.length = 0;
  	pro = pobj.value;
	for(var i = 0;i < profession.length;i ++) { 
		if (profession[i].pro == pro) { 
			break;
		}
	}
	var subpros = (profession[i].subpro).split("|"); 
	var oOption;
	for(var j = 0;j < subpros.length;j++) { 
		oOption = document.createElement("OPTION");
		oOption.text= subpros[j];
		oOption.value= subpros[j];
        if( subpros[j] == init_sub)
            oOption.selected = true;
		sobj.add(oOption);
	}
	
}
function getProNum(pro, sub, eid)
{
    if(pro && sub){
        for(var i = 0;i < profession.length; i++){ 
            if(profession[i].pro == pro)
            break;    
        }
        var subpros = (profession[i].subpro).split("|");
        for(var j = 0;j < subpros.length;j++) { 
            if(subpros[j]==sub)
            break;
        }
        var str='';
        if(i>=10)
            str = i.toString();
        else
            str = '0' + i; 
        if(j>=10)
            str = str + j.toString();
        else
            str = str + '0' + j;
        str = str + '000000'.substr(0, 6-eid.toString().length) + eid.toString();
        return str;
    }   
    return "请先设置行业和子行业";
}
