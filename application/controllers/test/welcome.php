<?php
class Welcome extends CI_Controller
{
    /*
    邮件流程：
    1、用户选择收件人，编辑邮件信息，邮件信息可以是文本的或者是HTML代码，目前不能保存图片
    2、调用函数完成发送，返回发送结果
    
    */
    private $my_email_user = 'jiuqian_test';
    private $my_email_addr = 'smtp.163.com';
    private $my_email_pw = '12qwaszx';
    private $my_email_name = 'jiuqian_test@163.com';
    private $my_email_port = 25;
    public function json()
    {
        //从页面获取搜索关键字，然后返回结果
        //1所有结果，2简单搜索，3复杂搜索
        $this->load->model('Expert_model');
        $ad = $this->input->post();
        $k['ename'] = $ad["name"];
        if($ad["sex"]=="0"){
            $k['esex'] = "";
            }
        else
            $k['esex'] = $ad["sex"];
        $k['etrade'] = $ad["trade"];
        $k['esubtrade'] = $ad["subtrade"];
        if($ad["province"]!="")
            $k['elocation'] = $ad["province"].",".$ad["city"];
        else
            $k['elocation'] = "";
        $k['company'] = "";
        $k['agency'] = "";
        $k['position'] = "";
        $k['duty'] = "";
        $k['area'] = "";
                
        $pn = $ad['pageNow'];
        $ps = $ad['pageSize'];

        if ($ad['searchType'] == '1') {
            $experts = $this->Expert_model->getExpertInfo($ps, ($pn - 1) * $ps,0,true);
            if (!empty($experts)) {
                echo json_encode($experts);
            } else {
                echo '';
            }
        } elseif ($ad['searchType'] == '2') {
            $experts = $this->Expert_model->searchExpertComplicate($k, $pn, $ps,0,$ad["iscoo"],true);
            if (!empty($experts)) {
                echo json_encode($experts);
            } else {
                echo '';
            }
        }
    }
    public function test()
    {
        $this->load->model('Project_model');
        $filter=array(
            "st"=>"1999-9-9 0:0:0"
        );
        $rd=$this->Project_model->getAllNewExperts("","",10,1);
        foreach($rd as $k1=>$v1){
            echo $k1.":<br />";
            foreach($v1 as $k2=>$v2){
                echo "[".$k2."]=>".$v2."<br />";
            }
        }
        
    }
    public function index()
    {
        $this->load->model('Project_model');
        $ep_data = array(
                'eid' => 29456,
                'piid' => 2,
                'state' => 5,
                'starttime' => '2013-5-6 15:56:36',
                'cost' => "");
        $acnt=array(
            'aicharge' => '122',
            'ailevel' => '2',
            'aibank' => 'test5',
            'aisubbranch' => '',
            'aicardnumber' => '',
            'ainame' => 'sb');
        if(!$this->Project_model->addAnExpert($ep_data,$acnt)){
            echo "0";
        }else
            echo "1";
    }
    public function testD()
    {
        //delete all file in emal-file
        $this->load->helper('file');
        delete_files('public/email-file/', TRUE);
        $this->load->view('email');
        
    }
    public function send_email_ajax(){
        //need add identify
        $p = $this->input->post();
        $tt = $p["title"];
        $ct = $p["content"];
        $files = explode (",",$p["files"]);
        $ems = explode (",",$p["allemail"]);
        $ids = explode (",",$p["eids"]);
        error_reporting(0);
        $this->load->library('email');
        $config['protocol'] = 'smtp'; //发送协议
        $config['charset'] = 'utf-8'; //字符设置
        $config['wordwrap'] = true; //是否自动换行
        //$config['crlf'] = TRUE;//换行符
        $config['smtp_host'] = $this->my_email_addr;
        $config['smtp_user'] = $this->my_email_user;
        $config['smtp_pass'] = $this->my_email_pw;
        $config['smtp_port'] = $this->my_email_port;
        $config['crlf'] = "\n";              
        $config['newline'] = "\n";
        $config['smtp_timeout'] = 5;
        $this->email->initialize($config);
        $i = 0;
        foreach ($ems as $key => $v_email) {
            if($v_email=="")
                continue;
            $this->email->clear(true);
            $this->email->from($this->my_email_name, 'jiuqian');
            $this->email->to($v_email);
            $this->email->subject($tt);
            $this->email->message($ct);
            for($j=0;$j<count($files);$j++){
                if($files[$j]!="")
                    $this->email->attach("public/email-file/".$files[$j]);
            }
            if ($this->email->send()) {
                $success[$i] = $ids[$key];
            } else {
                $failed[$i] = $ids[$key];
            }
            $i++;
        }
        //有发送成功的用户
        if (isset($success)) {
            $re[0] = $success;
        } else
            $re[0] = array();
        if (isset($failed)) {
            $re[1] = $failed;
        } else
            $re[1] = array();
        echo json_encode($re);
        //echo $this->email->print_debugger();
    }
    public function f_cancel_ajax(){
        $fpath="public/email-file/";
        if(file_exists($fpath.$_GET['fname'])){
        				@unlink($fpath.$_GET['fname']);
        				echo "{result:'Cancel Success!'}";
        }else
        	echo "{result:'File Dose Not Exist!'}";
    }
    public function f_upload_ajax(){
        $error = "";
    	$msg = "";
    	$fname = "";
    	$newFileName="";
    	$myUpName='file';
    	$fileElementName = $myUpName;
    	$destination='public/email-file/';
    	if(!empty($_FILES[$fileElementName]['error']))
    	{
    		switch($_FILES[$fileElementName]['error'])
    		{
    
    			case '1':
    				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
    				break;
    			case '2':
    				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
    				break;
    			case '3':
    				$error = 'The uploaded file was only partially uploaded';
    				break;
    			case '4':
    				$error = 'No file was uploaded.';
    				break;
    
    			case '6':
    				$error = 'Missing a temporary folder';
    				break;
    			case '7':
    				$error = 'Failed to write file to disk';
    				break;
    			case '8':
    				$error = 'File upload stopped by extension';
    				break;
    			default:
    				$error = 'No error code avaiable';
    		}
    	}elseif(empty($_FILES[$myUpName]['tmp_name']) || $_FILES[$myUpName]['tmp_name'] == 'none')
    	{
    		$error = 'No file was uploaded..';
    	}else 
    	{
    			$msg .= " File Size: " . @filesize($_FILES[$myUpName]['tmp_name']);
    			//move the tempfile to a permanate location
    			$newFileName=str_ireplace(",", "_", $destination.$_FILES[$myUpName]['name']);
    			$fname=str_ireplace(",", "_", $_FILES[$myUpName]['name']);
    			//if file is exist , delete it
    			if(file_exists($newFileName)){
    				@unlink($newFileName);
    				//$fname="";
    			}
    			move_uploaded_file($_FILES[$myUpName]['tmp_name'], $newFileName);
    			//for security reason, we force to remove all uploaded file
    			@unlink($_FILES[$myUpName]);
    	}		
    	echo "{";
    	echo				"error: '" . $error . "',\n";
    	echo				"msg: '" . $msg . "',\n";
    	echo 				"fname:'".$fname."'\n";
   		echo "}";
    }
    private function _my_email($receiver = array(), $title = '', $content = '')
    {
        if (empty($receiver))
            return array();
        error_reporting(0);
        $this->load->library('email');
        $config['protocol'] = 'smtp'; //发送协议
        $config['charset'] = 'utf-8'; //字符设置
        $config['wordwrap'] = true; //是否自动换行
        //$config['crlf'] = TRUE;//换行符
        $config['smtp_host'] = $this->my_email_addr;
        $config['smtp_user'] = $this->my_email_user;
        $config['smtp_pass'] = $this->my_email_pw;
        $config['smtp_port'] = $this->my_email_port;
        $config['crlf'] = "\r\n";              
        $config['newline'] = "\r\n";
        $config['smtp_timeout'] = 5;
        $this->email->initialize($config);

        $i = 0;
        foreach ($receiver as $v_email) {
            $this->email->clear(true);
            $this->email->from($this->my_email_name, 'jiuqian');
            $this->email->to($v_email);
            //$this->email->cc('tecle@126.com');//抄送，不需要
            $this->email->subject('你好、世界');
            $this->email->message('hello world');
            $this->email->attach("public/uploads/10001.jpg");
            //如果发送成功,保存到成功数组里面
            
            if ($this->email->send()) {
                $success[$i] = $v_email;
            } else {
                $failed[$i] = $v_email;
            }
            //echo $this->email->print_debugger();
            $i++;
        }
        //有发送成功的用户
        if (isset($success)) {
            $re['success'] = $success;
        } else
            $re['success'] = array();
        if (isset($failed)) {
            $re['failed'] = $failed;
        } else
            $re['failed'] = array();

        return $re;
        //echo $this->email->print_debugger();

    }

}

?>