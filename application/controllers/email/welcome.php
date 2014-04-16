<?php
class Welcome extends CI_Controller
{
    public function send_email_ajax(){
        $this->load->library("My_mail");
        $p = $this->input->post();
        $tt = $p["title"];
        $ct = $p["content"];
        $files = explode (",",$p["files"]);
        $ems = explode (",",$p["allemail"]);
        $ids = explode (",",$p["eids"]);
        
        $i = 0;
        $mails=array();
        foreach ($ems as $key => $v_email) {
            if($v_email=="")
                continue;
            $mails[$i]=$v_email;
            $i++;
        }
        if(empty($mails))
        {
            return;
        }
        $allf=array();
        for($j=0;$j<count($files);$j++){
                if($files[$j]!="")
                    $allf[$j]=mb_convert_encoding( "public/email-file/".$files[$j],'GB2312' ,'GB2312,UTF-8');
        }
        $sr=$this->my_mail->send($tt,$ct,$allf,$mails);
        if($sr[0]=="y"){
            foreach($allf as $k=>$v){
                if(file_exists($v))
    				@unlink($v);
            }
        }
        echo json_encode($sr);
    }
    
    public function json()
    {
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
    public function index()
    {
        $this->load->helper('file');
        //delete_files('public/email-file/', TRUE);
        $this->load->view('email/email');
    }

    public function send_email_ajax_v1(){
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
        echo $this->email->print_debugger();
    }
    public function f_cancel_ajax(){
        $fpath="public/email-file/";
        if(file_exists($fpath.$_GET['fname'])){
        				@unlink($fpath.$_GET['fname']);
        				echo "{result:'Cancel Success!'}";
        }else
        	echo "{result:'File Dose Not Exist!'}";
    }
    //传中文附件有问题,修正
    public function f_upload_ajax(){
        //$realName=$_POST['realname'];
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
                //$ext = end(explode('.',$_FILES[$myUpName]['name']));
                //$fileRandName = time(); //根据当前时间生成一个字符串
    			$msg .= " File Size: " . @filesize($_FILES[$myUpName]['tmp_name']);
    			//move the tempfile to a permanate location
    			$newFileName=str_ireplace(",", "_", $destination.$_FILES[$myUpName]['name']);
    			$fname=str_ireplace(",", "_", $_FILES[$myUpName]['name']);
                $newFileName=mb_convert_encoding( $newFileName,'GB2312' ,'GB2312,UTF-8');
    			//if file is exist , delete it
    			if(file_exists($newFileName)){
    				@unlink($newFileName);
    				//$fname="";
    			}
    			move_uploaded_file($_FILES[$myUpName]['tmp_name'], $newFileName);
    			//for security reason, we force to remove all uploaded file
    			@unlink($_FILES[$myUpName]);
    	}
        //$error=	$_FILES[$myUpName]['tmp_name'];	
    	echo "{";
    	echo				"error: '" . $error . "',\n";
    	echo				"msg: '" . $msg . "',\n";
    	echo 				"fname:'".$fname."'\n";
   		echo "}";
    }

}

?>