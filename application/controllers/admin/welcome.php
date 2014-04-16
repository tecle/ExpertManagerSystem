<?php
class Welcome extends CI_Controller
{
    private $url_to_adduser = '/CIFramework/index.php/admin/welcome/addUser';
    private $url_to_showLogs = '/CIFramework/index.php/admin/welcome/showLogs';
    //默认页面，也是管理页面的主页
    public function __construct()
    {
        parent::__construct();
    }
    public function index($pageNow = 1)
    {
        //装载url助手
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        $this->load->model('User_info');

        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo '<p>Please Login First!</p>';echo '<a href="/CIFramework/index.php">Login!</a>';
            return;
        } elseif ($temp['urole'] != 'a') {
            echo '<p>You can not access without permission!</p>';
            return;
        }


        $temp = $this->_isLogin();
        if (!$temp['isLogin']) {
            //这里要转向哦

            //return ;
        }
        $param['uname'] = $temp['uname'];
        //判断用户等级
        //code...,结果存在下面
        $param['urole'] = '管理员';

        //设置每页结果数量
        $limit = 10;
        //获取本页要显示的数据
        $param['r'] = $this->User_info->getWorkerInfo($limit, ($pageNow - 1) * $limit);
        //告诉视图本页是否有数据
        $param['isHaveResult'] = true;
        //将要传给视图的分页代码
        $param['page_str'] = $this->_myPageInation($this->User_info->getTotalNumbers(),
            $limit, '/CIFramework/index.php/admin/welcome/index/');

        $param['url_add'] = $this->url_to_adduser;
        $param['url_log'] = $this->url_to_showLogs;

        $css_js_info = array(
            'js2' => js_url('/zDialog.js'),
            'js3' => js_url('/zDrag.js'),
            'js4' => js_url('/validateForm.js'),
            'js5' => js_url('/manageUser.js'),
            //'js6' => js_url('/jquery.js'),
           // 'css1' => css_url('/maincss.css'),
           // 'css2' => css_url('/tablecloth.css'),
            'css3' => css_url('/adminMain.css'));
        $param['head_title'] = "管理员首页";
        $param['left_title'] = "管理员操作";
        $param['page_stat'] = 1;
        $param['css_js_url'] = $css_js_info;
        $param['url'] = $this->url;
        $param['url_left'] = array(
            'show_userinfo' => $this->url['admin'],
            'add_user' => $this->url['admin'] . '/addUser',
            'show_log' => $this->url['admin'] . '/showLogs');

        //装载视图，并将参数传送到视图中,所有参数通过param数组传入到视图中，在视图中可以直接引用
        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('admin/left');
        $this->load->view('admin/adminMain');
        $this->load->view('bottom');

    }
    //添加用户的页面
    public function addUser()
    {
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');

        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo '<p>Please Login First!</p>';echo '<a href="/CIFramework/index.php">Login!</a>';
            return;
        } elseif ($temp['urole'] != 'a') {
            echo '<p>You can not access without permission!</p>';
            return;
        }

        $css_js_info = array(
            'js4' => js_url('/validateForm.js'),
            'js5' => js_url('/manageUser.js'),
          //  'js6' => js_url('/jquery.js'),
            'css1' => css_url('/maincss.css'));
        $param['head_title'] = "管理员-添加用户";
        $param['left_title'] = "管理员操作";
        $param['page_stat'] = 2;
        $param['css_js_url'] = $css_js_info;
        $param['url'] = $this->url;
        $param['url_left'] = array(
            'show_userinfo' => $this->url['admin'],
            'add_user' => $this->url['admin'] . '/addUser',
            'show_log' => $this->url['admin'] . '/showLogs');
        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('admin/left');
        $this->load->view('admin/adminAdd');
        $this->load->view('bottom');
        /*$this->load->view('head', $param);
        $this->load->view('admin/left');
        $this->load->view('admin/adminAdd');
        $this->load->view('button');*/

    }
    //显示日志的页面
    public function showLogs($pageNow = 1)
    {
        $pageSize = 15;
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        $this->load->model('User_log_model');
        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo '<p>Please Login First!</p>';echo '<a href="/CIFramework/index.php">Login!</a>';
            return;
        } elseif (trim($temp['urole']) != 'a') {
            echo '<p>You can not access without permission!</p>';
            return;
        }

        $param['log_data_array'] = $this->_createLogString($pageNow, $pageSize);
        //传给视图分页代码
        $param['page_str'] = $this->_myPageInation($this->User_log_model->getTotalLogs(),
            $pageSize, '/CIFramework/index.php/admin/welcome/showLogs/');

        $css_js_info = array(
           // 'js3' => js_url('/tablecloth.js'),
            'js4' => js_url('/validateForm.js'),
            'js5' => js_url('/manageUser.js'),
           // 'js6' => js_url('/jquery.js'),
            'js7' => js_url('/dialog.js'),
            'css3' => css_url('/dialog.css'),
           // 'css1' => css_url('/maincss.css'),
            //'css2' => css_url('/tablecloth.css')
            );
        $param['head_title'] = "管理员-查看日志";
        $param['left_title'] = "管理员操作";
        $param['page_stat'] = 3;
        $param['css_js_url'] = $css_js_info;
        $param['url'] = $this->url;
        $param['url_left'] = array(
            'show_userinfo' => $this->url['admin'],
            'add_user' => $this->url['admin'] . '/addUser',
            'show_log' => $this->url['admin'] . '/showLogs');
        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('admin/left');
        $this->load->view('admin/adminLog');
        $this->load->view('bottom');

        //   $this->load->view("admin/adminLog", $param);
    }

    //处理用户管理的AJAX请求
    public function userAjax()
    {
        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo 'n';
            return;
        } elseif ($temp['urole'] != 'a') {
            echo 'n';
            return;
        }
        //添加的用户信息：用户名字，用户登陆账户，登陆密码，角色代码，备注
        //操作模式3种：增加用户--1，修改用户登陆账号--2，删除用户--3，修改登陆密码--4
        $this->load->model('User_info');
        $this->load->model('User_log_model');
        $opKind = $this->input->post('opKind');
        if (!$opKind) {
            echo "n";
            return;
        }
        $ajax_data = $this->input->post(null, true);
        if ($opKind == '1') {
            //$wname = iconv("gb2312", "utf-8", $wname);
            //查看是否账户重复
            if ($this->User_info->checkIsRepeat($ajax_data['waccount'])) {
                echo "e";
            } else {
                $worker_info = array(
                    'wname' => $ajax_data['wname'],
                    'waccount' => $ajax_data['waccount'],
                    'wpassword' => $ajax_data['wpassword'],
                    'wrole' => $ajax_data['wrole'],
                    'winfo' => $ajax_data['winfo']);
                if ($this->User_info->addWorker($worker_info)) {

                    echo 'y';
                } else
                    echo 'n';
            }
        } elseif ($opKind == '2') {
            //修改用户登陆账号；
            if ($this->User_info->checkIsRepeat($ajax_data['waccount'])) {
                echo "e";
            } else {
                $alter_data = array('waccount' => $ajax_data['waccount'],
                                    'wrole' => $ajax_data['wrole'],
                                    'winfo' => $ajax_data['winfo']);
                if ($this->User_info->alterInfo($alter_data, $ajax_data['wid'])) {
                    echo "y";
                } else
                    echo "n";
            }
        } elseif ($opKind == '3') {
            //删除使用ajax，然后按返回值刷新页面和给出提示
            //获取要删除的用户的wid
            if ($this->User_info->deleteWorker($ajax_data['wid']))
                echo "y";
            else
                echo "n";
        } elseif ($opKind == '4') {
            //修改用户登陆密码
            if($ajax_data['wpassword']==""){
                $alter_data = array('wrole' => $ajax_data['wrole'],
                                'winfo' => $ajax_data['winfo']);
            }
            else{
                $alter_data = array('wpassword' => $ajax_data['wpassword'],
                                'wrole' => $ajax_data['wrole'],
                                'winfo' => $ajax_data['winfo']);
            }
            if ($this->User_info->alterInfo($alter_data, $ajax_data['wid'])) {
                echo "y";
            } else
                echo "n";
        }elseif($opKind == '5'){
            //删除日志
            if($this->User_log_model->deleteLog($ajax_data['logstime'],$ajax_data['logetime']))
                echo 'y';
            else
                echo 'n';
        }
        
    }

    //生成日志文本信息
    private function _createLogString($i, $pageNum)
    {
        //这是按照时间从近到远排的，即递减，默认是递增
        //若是要用到表格，则在输出语句中带上<tr></tr>标签就行了
        //返回的是处理后的字符串数组
        $this->load->model('User_log_model');
        $this->load->model('Expert_model');
        $this->load->model('Project_model');
        $this->load->model('Client_model');
        //$this->load->model('User_info');

        $result = $this->User_log_model->getLogs($i, $pageNum);
        //解析结果
        $j = 0;
        $t = 0;
        foreach ($result as $r) {
            if($t == 0) 
                $tableclass = 'gradeA';
            else
                $tableclass = 'gradeB';
            $t = (++$t)%2;    
            $name = $r->user;
            $code = $r->opcode;
            $time = $r->optime;
            $main = $r->main;
            $sub = $r->sub;
            $log_str = "<tr class='".$tableclass."'><td>【" . $name . "】</td><td>  " . $time . "</td><td>";
            //对操作进行解码
            $type = floor($code / 10);
            $decode_str = '';
            if ($type == 1) {
                /*  1----添加操作 */
                $type1 = $code % 10;
                switch ($type1) {
                    case 1:
                        //$decode_str="添加了顾问 ";
                        $ename = $this->Expert_model->getExpertName($main);
                        $decode_str = "添加了顾问<a href='" . $this->url['expert'] . "/showExpertInfo/" . $main .
                            "'>" . $ename . "</a>";
                        break;
                    case 2:
                        //$decode_str="添加了项目 ";
                        $pname = $this->Project_model->getProjectName($main);
                        $decode_str = "添加了项目<a href='" . $this->url['project'] . "/showProjectInfo/" . $main .
                            "'>" . $pname . "</a>";
                        break;
                    case 3:
                        //$decode_str="添加了客户 ";
                        $cname = $this->Client_model->getClientName($main);
                        $decode_str = "添加了客户公司<a href='" . $this->url['guest'] . "/showGuestInfo/" . $main .
                            "'>" . $cname . "</a>";
                        break;
                    case 4:
                        //$decode_str="为顾问 ";//添加了工作经验
                        $ename = $this->Expert_model->getExpertName($main);
                        $decode_str = "为顾问<a href='" . $this->url['expert'] . "/showExpertInfo/" . $main .
                            "'>" . $ename . "</a> 添加了一项工作经验";
                        break;
                    default:
                        $decode_str='记录已损坏';
                        break;
                }
            } elseif ($type == 2) {
                $type1 = $code % 10;
                switch ($type1) {
                    case 1:
                        //$decode_str="修改了顾问信息 ";
                        $ename = $this->Expert_model->getExpertName($main);
                        $decode_str = "修改了顾问<a href='" . $this->url['expert'] . "/showExpertInfo/" . $main .
                            "'>" . $ename . "</a>的信息";
                        break;
                    case 2:
                        //$decode_str="修改了顾问收费情况 ";
                        $ename = $this->Expert_model->getExpertName($main);
                        $decode_str = "修改了顾问<a href='" . $this->url['expert'] . "/showExpertInfo/" . $main .
                            "'>" . $ename . "</a>的收费情况";
                        break;
                    case 3:
                        //$decode_str="修改了项目信息 ";
                        $pname = $this->Project_model->getProjectName($main);
                        $decode_str = "修改了项目<a href='" . $this->url['project'] . "/showProjectInfo/" . $main .
                            "'>" . $pname . "</a>的信息";
                        break;
                    case 4:
                        //$decode_str="修改了客户信息 ";
                        $cname = $this->Client_model->getClientName($main);
                        $decode_str = "修改了客户公司<a href='" . $this->url['guest'] . "/showGuestInfo/" . $main .
                            "'>" . $cname . "</a>信息";
                        break;
                    default:
                        $decode_str='记录已损坏';
                        break;
                }

            } elseif ($type == 3) {
                $type1 = $code % 10;
                switch ($type1) {
                    case 1:
                        //$decode_str="为项目添加了顾问 ";
                        $ename = $this->Expert_model->getExpertName($sub);
                        $pname = $this->Project_model->getProjectName($main);
                        $decode_str = "为项目<a href='" . $this->url['project'] . "/showProjectInfo/" . $main .
                            "'>" . $pname . "</a>添加顾问
					<a href='" . $this->url['expert'] . "/showExpertInfo/" . $sub . "'>" . $ename .
                            "</a>";
                        break;
                    case 2:
                        //$decode_str="为客户添加了项目 ";
                        $pname = $this->Project_model->getProjectName($sub);
                        $cname = $this->Client_model->getClientName($main);
                        $decode_str = "为客户公司<a href='" . $this->url['guest'] . "/showGuestInfo/" . $main .
                            "'>" . $cname . "</a>添加项目
					<a href='" . $this->url['project'] . "/showProjectInfo/" . $sub . "'>" . $pname .
                            "</a>";
                        break;
                    case 3:
                        //$decode_str="修改了项目的顾问状态 ";
                        $pname = $this->Project_model->getProjectName($main);
                        $ename = $this->Expert_model->getExpertName($sub);
                        $decode_str = "修改了项目<a href='" . $this->url['project'] . "/showProjectInfo/" . $main .
                            "'>" . $pname . "</a>的合作顾问<a href='" . $this->url['expert'] . "/showExpertInfo/" .
                            $sub . "'>" . $ename . "</a>的状态";
                        break;
                    default:
                        $decode_str='记录已损坏';
                        break;
                }

            } elseif ($type == 4) {
                    $type1 = $code % 10;
                    switch ($type1) {
                    case 1:
                        $decode_str = '导出顾问信息';
                        break;
                    case 2:
                        $decode_str = '导出项目信息';
                        break;
                    case 3:
                        $decode_str = '导出客户公司信息';
                        break;
                    default:
                        $decode_str='记录已损坏';
                        break;
                }
                    
            } elseif ($type == 5) {
                $type1 = $code % 10;
                switch ($type1) {
                    case 1:
                        $decode_str = '搜索顾问信息';
                        break;
                    case 2:
                        $decode_str = '搜索项目信息';
                        break;
                    case 3:
                        $decode_str = '搜索客户公司信息';
                        break;
                    default:
                        $decode_str='记录已损坏';
                        break;
                }
            } elseif ($type == 6) {
                $type1 = $code % 10;
                if ($type1 == 1) {
                    $decode_str = '登入系统';
                } else
                    $decode_str = '登出系统';
            }elseif($type == 7){
                 $type1 = $code % 10;
                    switch ($type1) {
                    case 1:
                        $ename = $this->Expert_model->getExpertName($main);
                        $decode_str = "查看了顾问<a href='" . $this->url['expert'] . "/showExpertInfo/" . $main .
                            "'>" . $ename . "</a>的信息";
                        break;
                    case 2:
                        $pname = $this->Project_model->getProjectName($main);
                        $decode_str = "修改了项目<a href='" . $this->url['project'] . "/showProjectInfo/" . $main .
                            "'>" . $pname . "</a>的信息";
                        break;
                    case 3:
                        $cname = $this->Client_model->getClientName($main);
                        $decode_str = "查看了客户公司<a href='" . $this->url['guest'] . "/showGuestInfo/" . $main .
                            "'>" . $cname . "</a>信息";
                        break;
                    default:
                        $decode_str='记录已损坏';
                        break;
                }
            }
            $log_str = $log_str . $decode_str . "</td></tr>";
            $str_array[$j] = $log_str;
            $j++;
        }
        if(isset($str_array))
            return $str_array;
        else   
            return array();
    }


}

?>