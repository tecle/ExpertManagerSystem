<?php
class Welcome extends CI_Controller
{
    //记住，当前使用的用户名字变量名为$user_name
    //搜索结果页面
    function searchResult($pageNow = 1)
    {
        //装载辅助工具
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo '<p>Please Login First!</p>';
            echo '<a href="/CIFramework/index.php">Login!</a>';
            return;
        }
        //第四类权限，只能搜索其负责的顾问
        if ($temp['urole'] == 'ud') {
            $uid = $temp['uid'];
        } else
            $uid = 0;
        //设置每页结果数大小
        $pageSize = 15;
        $this->load->model('Expert_model');
        //如果有post数据，说明是新的搜索，应该保存session会话
        if (isset($_POST['searchType'])) {
            $s_data = $this->input->post(null, false);
            //简单搜索
            if ($s_data['searchType'] == '1') {
                $st = 1;
                $keyword = $s_data['keyword'];
                $session_array = array('st' => 1, 'keyword' => $s_data['keyword']);
            } elseif ($s_data['searchType'] == '2') { //复杂搜索
                $st = 2;
                if (empty($s_data['ep'])) {
                    $location = "";
                } elseif (empty($s_data['ec'])) {
                    $location = $s_data['ep'];
                } else {
                    $location = $s_data['ep'] . "," . $s_data['ec'];
                }
                if ($s_data['esex'] == '0') //若用户为点击性别，则性别为空

                    $sex = "";
                else
                    $sex = $s_data['esex'];
                $key_array = array(
                    'company' => $s_data['ecompany'],
                    'agency' => $s_data['esection'],
                    'position' => $s_data['eposition'],
                    'duty' => $s_data['responbilities'],
                    'area' => $s_data['experisearea'],
                    'ename' => $s_data['ename'],
                    'esex' => $sex,
                    'etrade' => $s_data['eprofession'],
                    'esubtrade' => $s_data['esubprofession'],
                    'elocation' => $location);
                foreach ($key_array as $key => $value)
                    $session_array[$key] = $value;
                $session_array['st'] = 2;
            } else {
                $st = 3;
                $session_array['st'] = 3;
            }
            $this->session->set_flashdata($session_array);
        } else { //继续上次的查询，从闪存session中读取搜索信息
            $st = $this->session->flashdata('st');
            if ($st == '1') {
                $st = 1;
                $keyword = $this->session->flashdata('keyword');
                $session_array = array('st' => 1, 'keyword' => $keyword);
            } elseif ($st == '2') {
                $st = 2;
                $key_array = array(
                    'company' => $this->session->flashdata('company'),
                    'agency' => $this->session->flashdata('agency'),
                    'position' => $this->session->flashdata('position'),
                    'duty' => $this->session->flashdata('duty'),
                    'area' => $this->session->flashdata('area'),
                    'ename' => $this->session->flashdata('ename'),
                    'esex' => $this->session->flashdata('esex'),
                    'etrade' => $this->session->flashdata('etrade'),
                    'esubtrade' => $this->session->flashdata('esubtrade'),
                    'elocation' => $this->session->flashdata('elocation'));
                foreach ($key_array as $key => $value)
                    $session_array[$key] = $value;
                $session_array['st'] = 2;

            } else {
                $st = 3;
                $session_array['st'] = 3;
            }
            $this->session->set_flashdata($session_array);

        }
        if ($st == 1) {
            $param['s_result'] = $this->Expert_model->searchExpertSimple($keyword, $pageNow,
                $pageSize, $uid);
            $total_result = $this->Expert_model->getResultNumberForSimple($keyword, $uid);
        } elseif ($st == 2) {
            $param['s_result'] = $this->Expert_model->searchExpertComplicate($key_array, $pageNow,
                $pageSize, $uid);
            $total_result = $this->Expert_model->getResultNumberForComplicate($key_array, $uid);
        } else {
            $param['s_result'] = array();
            $total_result = 0;
        }

        $param['page_str'] = $this->_myPageInation($total_result, $pageSize, $this->url['expert'] .
            '/searchResult/');

        $css_js_info = array( //  'js4' => js_url('/tablecloth.js'),
                //  'css1' => css_url('/maincss.css'),
            //  'css2' => css_url('/tablecloth.css')
            );
        $param['head_title'] = "搜索结果";
        $param['left_title'] = "行业顾问信息";
        $param['page_stat'] = 1;
        $param['css_js_url'] = $css_js_info;
        $param['url_deal_click'] = $this->url['expert'] . '/showExpertInfo/';
        $param['url_left'] = array(
            'expertMain' => $this->url['expert'],
            'expertAdd' => $this->url['expert'] . '/addExpert',
            'expertSearch' => $this->url['expert'] . '/search');
        $param['url'] = $this->url;

        $user_name = $temp['uname'];
        ;
        $this->Expert_model->saveLog($user_name, 51);

        // $this->load->view('head', $param);
        //        $this->load->view('expert_view/left');
        //        $this->load->view('expert_view/searchResult');
        //        $this->load->view('button');

        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('expert_view/left');
        $this->load->view('expert_view/searchResult');
        $this->load->view('bottom');

    }
    //搜索专家页面
    function search()
    {
        //装载url助手
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo '<p>Please Login First!</p>';
            echo '<a href="/CIFramework/index.php">Login!</a>';
            return;
        }

        $css_js_info = array(
            //  'css1' => css_url('/maincss.css'),
            'css2' => css_url('/expertSearch.css'),
            'js2' => js_url('/proSelect.js'),
            'js3' => js_url('/dateSelect.js'),
            'js4' => js_url('/addrSelect.js'));
        $param['head_title'] = "行业顾问搜索";
        $param['left_title'] = "行业顾问信息";
        $param['page_stat'] = 2;
        $param['css_js_url'] = $css_js_info;
        $param['url_left'] = array(
            'expertMain' => $this->url['expert'],
            'expertAdd' => $this->url['expert'] . '/addExpert',
            'expertSearch' => $this->url['expert'] . '/search');
        $param['url'] = $this->url;
        //$this->load->view('head', $param);
        //        $this->load->view('expert_view/left');
        //        $this->load->view('expert_view/expertSearch');
        //        $this->load->view('button');
        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('expert_view/left');
        $this->load->view('expert_view/expertSearch');
        $this->load->view('bottom');
    }
    //专家信息首页
    //出错，用户点击分页使，链接会出错
    function index($pageNow = 1)
    {
        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo '<p>Please Login First!</p>';
            echo '<a href="/CIFramework/index.php">Login!</a>';
            return;
        }
        //第四类权限，只能搜索其负责的顾问
        if ($temp['urole'] == 'ud') {
            $uid = $temp['uid'];
        } else
            $uid = 0;
        //装载url助手
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        $this->load->model('Expert_model');

        //设置每页结果数量
        $limit = 20;
        //获取本页要显示的数据
        $param['r'] = $this->Expert_model->getExpertInfo($limit, ($pageNow - 1) * $limit,
            $uid);
        //将要传给视图的分页代码
        $param['page_str'] = $this->_myPageInation($this->Expert_model->getTotalExperts
            ($uid), $limit, '/CIFramework/index.php/expert/welcome/index/');

        //$param['url_add']=$this->url_to_adduser;
        //$param['url_log']=$this->url_to_showLogs;
        if (!$param['r'])
            $param['isHaveResult'] = false;

        //载入页面
        $css_js_info = array('js1' => js_url('/dialog.js'), 'css1' => css_url('/dialog.css')
                // 'css2' => css_url('/tablecloth.css')
                );
        $param['head_title'] = "行业顾问首页";
        $param['left_title'] = "行业顾问信息";
        $param['page_stat'] = 1;
        $param['css_js_url'] = $css_js_info;
        $param['url_left'] = array(
            'expertMain' => $this->url['expert'],
            'expertAdd' => $this->url['expert'] . '/addExpert',
            'expertSearch' => $this->url['expert'] . '/search');
        $param['url'] = $this->url;
        //$this->load->view('head', $param);
        //        $this->load->view('expert_view/left');
        //        $this->load->view('expert_view/expertMain');
        //        $this->load->view('button');
        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('expert_view/left');
        $this->load->view('expert_view/expertMain');
        $this->load->view('bottom');
        //$this->load->view('expert_view/expertMain', $param);
    }
    //添加专家的页面
    public function addExpert()
    {
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo '<p>Please Login First!</p>';
            echo '<a href="/CIFramework/index.php">Login!</a>';
            return;
        }
        //载入页面
        $css_js_info = array(
            'js1' => js_url('/validateForm.js'),
            'js2' => js_url('/proSelect.js'),
            'js3' => js_url('/dateSelect.js'),
            'js4' => js_url('/addrSelect.js'),
            //  'css1' => css_url('/maincss.css'),
            'css2' => css_url('/expertAdd.css'));
        $param['head_title'] = "添加行业顾问";
        $param['left_title'] = "行业顾问信息";
        $param['page_stat'] = 3;
        $param['css_js_url'] = $css_js_info;
        $param['url_left'] = array(
            'expertMain' => $this->url['expert'],
            'expertAdd' => $this->url['expert'] . '/addExpert',
            'expertSearch' => $this->url['expert'] . '/search');
        $param['url'] = $this->url;
        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('expert_view/left');
        $this->load->view('expert_view/expertAdd');
        $this->load->view('bottom');
        //$this->load->view('head', $param);
        //        $this->load->view('expert_view/left');
        //        $this->load->view('expert_view/expertAdd');
        //        $this->load->view('button');
    }

    //添加专家信息的处理页面
    public function addAnExpert()
    {
        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo '<p>Please Login First!</p>';
            echo '<a href="/CIFramework/index.php">Login!</a>';
            return;
        }

        //取得传送过来的数据
        $expert_data = $this->input->post(null, true);
        //保存专家信息以及添加该专家的用户
        $id = $this->_saveExpertInfo($expert_data, $temp['uid']);

        $this->load->helper('url');
        $this->load->model('Expert_model');
        //页面跳转
        if ($id > 0) {
            //保存图片
            $isSaveOk = $this->_saveFile($id);
            if (!empty($isSaveOk)) { //如果不是空数组，则表明保存成功
                $finalFileName = $isSaveOk['file_name'];
            }
            //将文件名保存在数据表中
            $this->Expert_model->savePic($id, $finalFileName);


            $user_name = $temp['uname'];
            ;
            $this->Expert_model->saveLog($user_name, 11, $id);

            redirect('/expert/welcome/showExpertInfo/' . $id . '', 'location', 301);
        } else
            echo 'Add failed!';
    }
    //显示某个专家的信息
    public function showExpertInfo($eid = 0)
    {
        if ($eid == 0) {
            echo 'Unvalid access!';
            return;
        }
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo '<p>Please Login First!</p>';
            echo '<a href="/CIFramework/index.php">Login!</a>';
            return;
        }

        $this->load->model('Expert_model');
        //判断是否由权限查看，主要是拦截ud类用户的操作
        //传入参数，要查看的id以及用户的id
        if ($temp['urole'] == 'ud' && (!$this->Expert_model->isOwned($eid, $temp['uid']))) {
            echo '<p>You can not access without permission!</p>';
            return;
        }

        $param['eid'] = $eid;
        $param['expert_info'] = $this->Expert_model->getExpertDetail($eid);
        if ($param['expert_info']['estate'] == '1')
            $param['expert_info']['estate'] = '获得联系方式';
        elseif ($param['expert_info']['estate'] == '2')
            $param['expert_info']['estate'] = '聘用';
        elseif ($param['expert_info']['estate'] == '3')
            $param['expert_info']['estate'] = '已合作';
        else
            $param['expert_info']['estate'] = '暂无信息';

        $param['current_work'] = $this->Expert_model->getCurWork($eid);
        $param['expert_exps'] = $this->Expert_model->getExpertWrokExps($eid);
        $param['projects_joined'] = $this->Expert_model->getProjectJoined($eid);
        $param['expert_comt'] = $this->Expert_model->getComtOfExpert($eid);
        $css_js_info = array(
            'js1' => js_url('/validateForm.js'),
            'js2' => js_url('/proSelect.js'),
            'js3' => js_url('/dateSelect.js'),
            //   'js4' => js_url('/jquery.js'),
            'js5' => js_url('/myajax.js'),
            'js6' => js_url('/addrSelect.js'),
            'js7' => js_url('/dialog.js'),
            'css4' => css_url('/dialog.css'),
            //     'css1' => css_url('/maincss.css'),
            //     'css2' => css_url('/bluedream.css'),
            'css3' => css_url('/expertInfo.css'));
        $param['head_title'] = "行业顾问详细信息";
        $param['left_title'] = "行业顾问信息";
        $param['page_stat'] = 4;
        $param['css_js_url'] = $css_js_info;
        $param['url_left'] = array(
            'expertMain' => $this->url['expert'],
            'expertAdd' => $this->url['expert'] . '/addExpert',
            'expertSearch' => $this->url['expert'] . '/search');
        $param['url'] = $this->url;


        $user_name = $temp['uname'];
        ;
        $this->Expert_model->saveLog($user_name, 71, $eid);

        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('expert_view/left');
        $this->load->view('expert_view/expertInfo');
        $this->load->view('bottom');

        //  $this->load->view('head', $param);
        //        $this->load->view('expert_view/left');
        //        $this->load->view('expert_view/expertInfo');
        //        $this->load->view('button');

    }
    //修改专家的AJAX
    //遇到的错误：第一，没有将eid作为隐藏域放到页面中，导致js访问不到eid的值
    //模型中的sql函数没有给出要操作的表名
    public function expertAjax()
    {
        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo 'n';
            return;
        }

        $this->load->model('Expert_model');
        $ajax_data = $this->input->post(null, true);
        if (!isset($ajax_data['type'])) {
            echo 'n';
            return;
        }

        switch ($ajax_data['type']) {
            case '1': //修改专家基本信息
                $basic_data = array(
                    'ebirthday' => $ajax_data['ebirthday'],
                    'esex' => $ajax_data['esex'],
                    'elocation' => $ajax_data['elocation'],
                    'emobile' => $ajax_data['emobile'],
                    'elandline' => $ajax_data['elandline'],
                    'emsn' => $ajax_data['emsn'],
                    'eemail' => $ajax_data['eemail'],
                    'estate' => $ajax_data['estate'],
                    'eqq' => $ajax_data['eqq'],
                    'ecomefrom' => $ajax_data['ecomefrom'],
                    'ename' => $ajax_data['ename']);
                if ($this->Expert_model->alterBasicInfo($ajax_data['eid'], $basic_data)) {

                    $user_name = $temp['uname'];
                    ;
                    $this->Expert_model->saveLog($user_name, 21, $ajax_data['eid']);


                    echo 'y';
                } else
                    echo 'n';


                break;
            case '2': //修改用户的收费标准，这里应该是先查是否已经存储过，有则更新，没则修改
                $cost_data = array(
                    'astandard' => $ajax_data['astandard'],
                    'alevel' => $ajax_data['alevel'],
                    'abank' => $ajax_data['abank'],
                    'asubbranch' => $ajax_data['asubbranch'],
                    'acardnumber' => $ajax_data['acardnumber'],
                    'aname' => $ajax_data['aname']);
                if ($this->Expert_model->isHaveMoneyCost($ajax_data['eid'])) {
                    //修改
                    if ($this->Expert_model->alterMoneyCost($ajax_data['eid'], $cost_data)) {
                        $user_name = $temp['uname'];
                        ;
                        $this->Expert_model->saveLog($user_name, 22, $ajax_data['eid']);

                        echo 'y';
                    } else
                        echo 'n';
                } else {
                    //插入
                    if ($this->Expert_model->addMoneyCost($ajax_data['eid'], $cost_data)) {

                        $user_name = $temp['uname'];
                        ;
                        $this->Expert_model->saveLog($user_name, 22, $ajax_data['eid']);

                        echo 'y';
                    } else
                        echo 'n';
                }
                break;
            case '3': //修改用户的行业信息
                $trade_data = array('etrade' => $ajax_data['etrade'], 'esubtrade' => $ajax_data['esubtrade']);
                if ($this->Expert_model->alterBasicInfo($ajax_data['eid'], $trade_data)) {

                    $user_name = $temp['uname'];
                    ;
                    $this->Expert_model->saveLog($user_name, 21, $ajax_data['eid']);

                    echo 'y';
                } else
                    echo 'n';
                break;
            case '4': //这个是用来添加工作经历
                $exp_data = array(
                    'eid' => $ajax_data['eid'],
                    'company' => $ajax_data['company'],
                    'agency' => $ajax_data['agency'],
                    'position' => $ajax_data['position'],
                    'duty' => $ajax_data['duty'],
                    'area' => $ajax_data['area'],
                    'istonow' => $ajax_data['istonow']);
                if ($ajax_data['etime'] != '')
                    $exp_data['etime'] = $ajax_data['etime'];
                if ($ajax_data['stime'] != '')
                    $exp_data['stime'] = $ajax_data['stime'];
                if ($this->Expert_model->saveWorkExp($exp_data)) {

                    $user_name = $temp['uname'];
                    ;
                    $this->Expert_model->saveLog($user_name, 14, $ajax_data['eid']);

                    echo 'y';
                } else
                    echo 'n';
                break;
            case '5': //增加顾问评论,出错原因，ajax参数字符串少写了=号
                $comt_data = array(
                    'eproblem' => $ajax_data['eproblem'],
                    'ecomment' => $ajax_data['ecomment'],
                    'eid' => $ajax_data['eid']);
                if ($this->Expert_model->addComment($comt_data)) {

                    $user_name = $temp['uname'];
                    ;
                    $this->Expert_model->saveLog($user_name, 14, $ajax_data['eid']);


                    echo 'y';

                } else
                    echo 'n';
                break;
            case '6': //修改备注
                $remark_array = array('eremark' => $ajax_data['eremark']);
                if ($this->Expert_model->alterBasicInfo($ajax_data['eid'], $remark_array)) {

                    $user_name = $temp['uname'];
                    ;
                    $this->Expert_model->saveLog($user_name, 14, $ajax_data['eid']);

                    echo 'y';

                } else
                    echo 'n';
                break;
            case '7': //修改工作经历
                $expid = $ajax_data['expid'];
                if ($ajax_data['newistonow'] == '0') {
                    $tv_itn = '2';
                } else
                    $tv_itn = '1';
                $exp_data = array(
                    'company' => $ajax_data['newcompany'],
                    'agency' => $ajax_data['newagency'],
                    'position' => $ajax_data['newposition'],
                    'duty' => $ajax_data['newduty'],
                    'area' => $ajax_data['newarea'],
                    'istonow' => $tv_itn);
                if ($ajax_data['newetime'] != '')
                    $exp_data['etime'] = $ajax_data['newetime'];
                if ($ajax_data['newstime'] != '')
                    $exp_data['stime'] = $ajax_data['newstime'];

                // print_r($exp_data);
                //return;

                if ($this->Expert_model->alterWorkExp($expid, $exp_data)) {

                    $user_name = $temp['uname'];
                    $this->Expert_model->saveLog($user_name, 14, $ajax_data['eid']);

                    echo 'y';
                } else
                    echo 'n';
                break;
            case '8': //删除顾问,如果想保存被删除的顾问名称，得在日志里设置一个备注项
                $eid = $ajax_data['eid'];
                if ($this->Expert_model->delExpt($eid)) {
                    $user_name = $temp['uname'];
                    $this->Expert_model->saveLog($user_name, 81, $ajax_data['eid']);
                    echo 'y';
                } else {
                    echo 'n';
                }
                break;
            case '9': //删除顾问经历
                $expid = $ajax_data['expid'];
                if ($this->Expert_model->delWorkExp($expid)) {
                    $user_name = $temp['uname'];
                    $this->Expert_model->saveLog($user_name, 82, $ajax_data['eid']);
                    echo 'y';
                } else {
                    echo 'n';
                }
                break;
            case '10': //删除顾问评论
                $cmtid = $ajax_data['cmtid'];
                if ($this->Expert_model->delCmmt($cmtid)) {
                    $user_name = $temp['uname'];
                    $this->Expert_model->saveLog($user_name, 85, $ajax_data['eid']);
                    echo 'y';
                } else {
                    echo 'n';
                }
                break;
            default:
                echo 'n';
                break;

        }

    }
    //保存专家信息，返回的是ID
    private function _saveExpertInfo($expert_data, $uid)
    {

        $this->load->model('Expert_model');
        //状态聘用和完成合作
        if ($expert_data['estatus'] == '2' || $expert_data['estatus'] == '3') {
            $expert_info = array(
                'ename' => $expert_data['ename'],
                'estate' => $expert_data['estatus'],
                'esex' => $expert_data['esex'],
                'emobile' => $expert_data['ecellphone'],
                'eemail' => $expert_data['email'],
                'elandline' => $expert_data['elandphone'],
                'emsn' => $expert_data['msn'],
                'eqq' => $expert_data['eqq'],
                'etrade' => $expert_data['eprofession'],
                'esubtrade' => $expert_data['esubprofession'],
                'ebirthday' => $expert_data['ebirthday'],
                'ecomefrom' => $expert_data['ecomefrom'],
                'admin_id' => $uid,
                'elocation' => '');
            if (!empty($expert_data['eprovince']))
                $expert_info['elocation'] = $expert_data['eprovince'] . ',' . $expert_data['ecity'];

            $id = $this->Expert_model->saveAnExpert($expert_info);
            if ($id > 0) {

                //保存收费标准
                if (isset($expert_data['select1'])) {
                    $expert_cost = array(
                        'eid' => $id,
                        'astandard' => $expert_data['echarge'],
                        'alevel' => $expert_data['elevel'],
                        'abank' => $expert_data['ebank'],
                        'asubbranch' => $expert_data['esubbank'],
                        'acardnumber' => $expert_data['eanumber'],
                        'aname' => $expert_data['eaname']);
                    $this->Expert_model->saveExpertMoneyCost($expert_cost);
                }
                return $id;
            }
        } else
            if ($expert_data['estatus'] == '1') { //状态获得联系方式
                $expert_info = array(
                    'ename' => $expert_data['ename1'],
                    'emobile' => $expert_data['ecellphone1'],
                    'estate' => $expert_data['estatus'],
                    'esex' => 'M',
                    'admin_id' => $uid,
                    'elandline' => $expert_data['elandphone1']);
                $id = $this->Expert_model->saveAnExpert($expert_info);
                if ($id > 0) {
                    $expert_exp = array(
                        'company' => $expert_data['ecompany'],
                        'eid' => $id,
                        'agency' => $expert_data['esection'],
                        'position' => $expert_data['eposition'],
                        'istonow' => 1);
                    $this->Expert_model->saveWorkExp($expert_exp);
                    return $id;
                }
            }
        return 0;
    }
    private function _saveFile($fileName)
    {
        $config['upload_path'] = './public/uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name'] = $fileName;
        $config['max_size'] = '516';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload()) {
            return $this->upload->data();
        }
        return array();
    }
    //存储文件
    //导出访谈信息

    function interviewExcel()
    {
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo '<p>Please Login First!</p>';
            echo '<a href="/CIFramework/index.php">Login!</a>';
            return;
        }
        error_reporting(E_ALL);
        ini_set('display_errors', true);
        ini_set('display_startup_errors', true);
        date_default_timezone_set('Europe/London');
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '访谈日期')->setCellValue('B1',
            '客户')->setCellValue('C1', '项目代码')->setCellValue('D1', '专家PIC')->setCellValue('E1',
            '专家来源')->setCellValue('F1', 'SERVICE')->setCellValue('G1', '公司（现）')->setCellValue('H1', '专家名字')->setCellValue('I1',
            '专家级别')->setCellValue('J1', '访谈时长（分钟）')->setCellValue('K1', '访谈花费')->
            setCellValue('L1', '打分')->setCellValue('M1', 'COMMENTS')->setCellValue('N1',
            '开户行')->setCellValue('O1', '开户支行')->setCellValue('P1', '账号')->setCellValue('Q1',
            '账户名')->setCellValue('R1', '手机');

        //取得传送过来的数据
        
        $interview_data = $this->input->post(null, true);
        $filter = array(
            'st' => $interview_data['isdate'],
            'et' => $interview_data['iedate'],
            'guest' => $interview_data['iguest'],
            'project' => $interview_data['ipcode']);
        $this->load->model('Project_model');
        $pagesize = 500;
        $pagenow = 1;
        $interview_infos = $this->Project_model->getAllMeets($filter, $pagesize, $pagenow);
        $i = 2;
        while (true) {
            foreach ($interview_infos as $interview_info) {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $interview_info['itime'])->
                    setCellValue('B' . $i, $interview_info['gname'])->setCellValue('C' . $i, $interview_info['pcode'])->
                    setCellValue('D' . $i, $interview_info['pic'])->setCellValue('E' . $i, $interview_info['ecomefrom'])->setCellValue('F' . $i, $interview_info['service'])->
                    setCellValue('G' . $i, $interview_info['company'])->setCellValue('H' . $i, $interview_info['ename'])->
                    setCellValue('I' . $i, $interview_info['alevel'])->setCellValue('J' . $i, $interview_info['totaltime'])->
                    setCellValue('K' . $i, $interview_info['cost'])->setCellValue('L' . $i, $interview_info['avgs'])->
                    setCellValue('M' . $i, $interview_info['remark'])->setCellValue('N' . $i, $interview_info['abank'])->
                    setCellValue('O' . $i, $interview_info['asubbranch'])->setCellValue('P' . $i, $interview_info['acardnumber'].' ')->
                    setCellValue('Q' . $i, $interview_info['aname'])->setCellValue('R' . $i, $interview_info['emobile'].' ');
                $i++;
            }
            if (count($interview_infos) < $pagesize) {
                break;
            }
            $interview_infos = $this->Project_model->getAllMeets($filter, $pagesize, ++$pagenow);
        }
        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
        //发送标题强制用户下载文件
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="interviewinfo.xls"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }
    //导出新添加专家的excel
    function expertInfoExcel()
    {
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo '<p>Please Login First!</p>';
            echo '<a href="/CIFramework/index.php">Login!</a>';
            return;
        }
        error_reporting(E_ALL);
        ini_set('display_errors', true);
        ini_set('display_startup_errors', true);
        date_default_timezone_set('Europe/London');
        $this->load->library('PHPExcel');
        $this->load->library('PHPExcel/IOFactory');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '添加日期')->setCellValue('B1',
            '专家PIC')->setCellValue('C1', '专家来源')->setCellValue('D1', '公司（现）')->setCellValue('E1',
            '专家名字')->setCellValue('F1', '专家级别');
        //取得传送过来的数据
        $expert_data = $this->input->post(null, true);
        $this->load->model('Project_model');
        $pagesize = 500;
        $pagenow = 1;
        $expert_infos = $this->Project_model->getAllNewExperts($expert_data['sdate'], $expert_data['edate'],
            $pagesize, $pagenow);
        $i = 2;

        while (true) {
            foreach ($expert_infos as $expert_info) {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $expert_info['addtime'])->
                    setCellValue('B' . $i, $expert_info['pic'])->setCellValue('C' . $i, $expert_info['ecomefrom'])->
                    setCellValue('D' . $i, $expert_info['company'])->setCellValue('E' . $i, $expert_info['ename'])->
                    setCellValue('F' . $i, $expert_info['alevel']);
                $i++;
            }
            if (count($expert_infos) < $pagesize) {
                break;
            }
            $expert_infos = $this->Project_model->getAllNewExperts($expert_data['sdate'], $expert_data['edate'], $pagesize, ++$pagenow);
        }

        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
        //发送标题强制用户下载文件
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="expertinfo.xls"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }

    public function uploadImg()
    {
        $error = "";
        $msg = "";
        $fname = "";
        $eid = $_POST['eid'];
        $newFileName = "";
        $myUpName = 'file';
        $fileElementName = $myUpName;
        $destination = 'public/uploads/';
        if (!empty($_FILES[$fileElementName]['error'])) {
            switch ($_FILES[$fileElementName]['error']) {

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
        } elseif (empty($_FILES[$myUpName]['tmp_name']) || $_FILES[$myUpName]['tmp_name'] ==
        'none') {
            $error = 'No file was uploaded..';
        } else {
            $tp = $_FILES[$myUpName]['type'];
            if ($tp == "image/jpeg")
                $tp = "jpg";
            elseif ($tp == "image/png")
                $tp = "png";
            elseif ($tp == "image/gif")
                $tp = "gif";
            elseif ($tp == "image/bmp")
                $tp = "bmp";
            $msg .= " File Size: " . @filesize($_FILES[$myUpName]['tmp_name']);
            if (@filesize($_FILES[$myUpName]['tmp_name']) > 1048576) {
                $error = "File is too large!Size<=1MB";
            } elseif ($tp != 'jpg' && $tp != 'jpeg' && $tp != 'gif' && $tp != 'png' && $tp != 'bmp') {
                $error = "Only jpg/jpeg/gif/png/bmp allowed!";
            } else {
                //move the tempfile to a permanate location
                $this->load->model('Expert_model');
                $fname = $eid . "." . $tp;
                $newFileName = $destination.$fname;
                //if file is exist , delete it
                if (file_exists($newFileName)) {
                    @unlink($newFileName);
                    //$fname="";
                }
                move_uploaded_file($_FILES[$myUpName]['tmp_name'], $newFileName);
                $this->Expert_model->savePic($eid, $fname);
                //for security reason, we force to remove all uploaded file
                @unlink($_FILES[$myUpName]);
            }
        }
        echo "{";
        echo "error: '" . $error . "',\n";
        echo "msg: '" . $msg . "',\n";
        echo "fname:'" . $fname . "'\n";
        echo "}";

    }
}
?>