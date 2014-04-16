<?php
class Welcome extends CI_Controller
{
    //搜索结果页面
    function searchResult($pageNow = 1)
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
        } elseif ($temp['urole'] == 'ud') {
            echo '<p>You can not access without permission!</p>';
            return;
        }
        //装载辅助工具
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        //设置每页结果数大小
        $pageSize = 25;
        $this->load->model('Project_model');
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
                $key_array = array(
                    'name' => $s_data['name'],
                    'code' => $s_data['code'],
                    'em' => $s_data['em'],
                    'dailyiquota' => $s_data['dailyiquota'],
                    'pediscribe' => $s_data['pediscribe']);
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
                    'name' => $this->session->flashdata('name'),
                    'code' => $this->session->flashdata('code'),
                    'em' => $this->session->flashdata('em'),
                    'dailyiquota' => $this->session->flashdata('dailyiquota'),
                    'pediscribe' => $this->session->flashdata('pediscribe'));
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
            $param['r'] = $this->Project_model->searchProjectSimple($keyword, $pageNow, $pageSize);
            $total_result = $this->Project_model->getResultNumberForSimple($keyword);
        } elseif ($st == 2) {
            $param['r'] = $this->Project_model->searchProjectComplicate($key_array, $pageNow,
                $pageSize);
            $total_result = $this->Project_model->getResultNumberForComplicate($key_array);
        } else {
            $param['r'] = array();
            $total_result = 0;
        }

        $param['page_str'] = $this->_myPageInation($total_result, $pageSize, $this->url['project'] .
            '/searchResult/');

        $css_js_info = array( //    'js4' => js_url('/tablecloth.js'),
                //  'css1' => css_url('/maincss.css'),
            //'css2' => css_url('/tablecloth.css')
            );
        $param['head_title'] = "搜索结果";
        $param['left_title'] = "项目信息";
        $param['page_stat'] = 1;
        $param['deal_url'] = $this->url['project'] . '/showProjectInfo/';
        $param['css_js_url'] = $css_js_info;
        $param['url_left'] = array(
            'projectMain' => $this->url['project'],
            'projectAdd' => $this->url['project'] . '/addProject',
            'projectSearch' => $this->url['project'] . '/search');
        $param['url'] = $this->url;

        $user_name = $temp['uname'];
        ;
        $this->Project_model->saveLog($user_name, 52);

        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('project_view/left');
        $this->load->view('project_view/projectMain');
        $this->load->view('bottom');
    }
    //添加成功时的界面，此时显示所有已经绑定的顾问，并且用户可以编辑
    function addExpertFinish($piid = 0)
    {
        if ($piid <= 0)
            return;
            
         //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {

            echo '<p>You can not access without permission!</p>';
            return;
        } elseif ($temp['urole'] == 'ud' ) {
            echo '<p>You can not access without permission!</p>';
            return;
        }
        
        //装载辅助工具
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');

        $this->load->model('Project_model');
        $this->load->model('Client_model');
        $param['experts'] = $this->Project_model->getAllExpertInfoJoined($piid);
        $css_js_info = array(
            'js2' => js_url('/myajax.js'),
            //  'js3' => js_url('/jquery.js'),
            'js4' => js_url('/dateSelect.js'),
            //   'css1' => css_url('/maincss.css'),
            //  'css2' => css_url('/bluedream.css')
            );
        $param['head_title'] = "搜索结果";
        $param['left_title'] = "项目信息";
        $param['page_stat'] = 5;
        $param['piid'] = $piid;
        $param['ghalfhour'] = $this->Project_model->getHalfHour($piid);
        $param['css_js_url'] = $css_js_info;
        $param['url_left'] = array(
            'projectMain' => $this->url['project'],
            'projectAdd' => $this->url['project'] . '/addProject',
            'projectSearch' => $this->url['project'] . '/search');
        $param['url'] = $this->url;
        $pguest = $this->Project_model->getClientJoined($piid);
        if($pguest)
        $param['contact_list'] = $this->Client_model->getAllCnntName($pguest['cid']);
        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('project_view/left');
        $this->load->view('project_view/projectExpertInfo');
        $this->load->view('bottom');
        //$this->load->view('head', $param);
        //        $this->load->view('project_view/left');
        //        $this->load->view('project_view/projectExpertInfo');
        //        $this->load->view('button');
    }
    //处理用户的状态转变信息的ajax处理脚本
    //出错原因是js获取不到piid的值
    //这里偷懒了，模型没有完全分离，有点耦合
    function alterEPAjax()
    {
        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo 'n';
            return;
        } elseif ($temp['urole'] == 'ud' || $temp['urole'] == 'uc') {
            echo 'n';
            return;
        }

        $this->load->model('Project_model');
        if (!isset($_POST['ecid']) && !isset($_POST['state'])) {
            echo 'no';
            return;
        }
        $ecid = $_POST['ecid'];
        
        $pid = $_POST['piid'];
        $eid = $_POST['eid'];
        $state = $_POST['state'];
        $epicharge = $_POST['epicharge'];

        if ($state == '1' || $state == '3' || $state == '7' || $state == '2') {
            $query = "update expert_choosed set state='" . $state . "', epicharge='" . $epicharge .
                "' where ecid=" . $ecid;
        } elseif ($state == '4') {
            $itime = $_POST['days'];
            $query = "update expert_choosed set state='4' , itime='" . $itime .
                "', epicharge='" . $epicharge . "' where ecid=" . $ecid;
        } elseif ($state == '5') {
            $ep_data = array(
                'ecid' => $ecid,
                'eid' => $eid,
                'piid' => $pid,
                'state' => $state,
                'starttime' => $_POST['starttime'],
                'endtime' => $_POST['endtime'],
                'totaltime' => $_POST['totaltime'],
                'ilhour' => $_POST['ilhour'],
                'cost' => $_POST['cost'],
                'service' => $_POST['service'],
                'epicharge' => $epicharge);
            $acnt=array(
                'astandard' => $_POST['echarge'],
                'alevel' => $_POST['elevel'],
                'abank' => $_POST['ebank'],
                'asubbranch' => $_POST['esubbank'],
                'acardnumber' => $_POST['eanumber'],
                'aname' => $_POST['eaname']
            );

            if($this->Project_model->altProCost($ep_data,$acnt)){
                $user_name = $temp['uname'];
                $this->Project_model->saveLog($user_name, 33, $pid, $eid);
                echo 'y';   
            }else
                echo 'n';
            //echo...
            return ;
        } elseif ($state == '6') {
            $ep_data = array(
                'ecid' => $ecid,
                'eid' => $eid,
                'piid' => $pid,
                'state' => $state,
                'scorer' => $_POST['scorer'],
                's1' => $_POST['s1'],
                's2' => $_POST['s2'],
                's3' => $_POST['s3'],
                'service' => $_POST['service'],
                'avgs' => $_POST['avgs'],
                'starttime' => $_POST['starttime'],
                'endtime' => $_POST['endtime'],
                'totaltime' => $_POST['totaltime'],
                'ilhour' => $_POST['ilhour'],
                'cost' => $_POST['cost'],                
                'epicharge' => $epicharge);
            $acnt=array(
                'astandard' => $_POST['echarge'],
                'alevel' => $_POST['elevel'],
                'abank' => $_POST['ebank'],
                'asubbranch' => $_POST['esubbank'],
                'acardnumber' => $_POST['eanumber'],
                'aname' => $_POST['eaname']
            );   
            if($this->Project_model->altProCost($ep_data,$acnt)){
                $user_name = $temp['uname'];
                $this->Project_model->saveLog($user_name, 33, $pid, $eid);
                echo 'y';   
            }else
                echo 'n';
            //echo...
            return ;   
        }
        if ($this->Project_model->alterEP($query)) {

            $user_name = $temp['uname'];
            ;
            $this->Project_model->saveLog($user_name, 33, $pid, $eid);

            echo 'y';
        } else {
            echo 'n';
        }
    }
    //处理增加顾问的AJAX脚本文件
    function dealaddexpert()
    {
        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {

            echo 'n';
            return;
        } elseif ($temp['urole'] == 'ud' ) {
            echo 'n';
            return;
        }

        $this->load->model('Project_model');

        //获取post过来的约访信息，并保存到$v中，记得先处理数据
        $post_data = $this->input->post(null, true);
        $state = $post_data['state'];
        $eid = $post_data['eid'];
        $piid = $post_data['piid'];
        $epicharge = $post_data['epicharge'];
        $acnt=array();

        if ($state == '1' || $state == '3' || $state == '7' || $state == '2') {
            $ep_data = array(
                'eid' => $eid,
                'piid' => $piid,
                'state' => $state,
                'epicharge' => $epicharge);
        } elseif ($state == '4') {
            $ep_data = array(
                'eid' => $eid,
                'piid' => $piid,
                'state' => $state,
                'itime' => $post_data['days'],
                'epicharge' => $epicharge);
        } elseif ($state == '5') {
            $ep_data = array(
                'eid' => $eid,
                'piid' => $piid,
                'state' => $state,
                'starttime' => $post_data['starttime'],
                'endtime' => $post_data['endtime'],
                'totaltime' => $post_data['totaltime'],
                'ilhour' => $post_data['ilhour'],
                'cost' => $post_data['cost'],
                'service' => $post_data['service'],
                'epicharge' => $epicharge);
            $acnt=array(
                'astandard' => $post_data['echarge'],
                'alevel' => $post_data['elevel'],
                'abank' => $post_data['ebank'],
                'asubbranch' => $post_data['esubbank'],
                'acardnumber' => $post_data['eanumber'],
                'aname' => $post_data['eaname']
            );
        } elseif ($state == '6') {
            $ep_data = array(
                'eid' => $eid,
                'piid' => $piid,
                'state' => $state,
                'scorer' => $post_data['scorer'],
                's1' => $post_data['s1'],
                's2' => $post_data['s2'],
                's3' => $post_data['s3'],
                'avgs' => $post_data['avgs'],
                'starttime' => $post_data['starttime'],
                'endtime' => $post_data['endtime'],
                'totaltime' => $post_data['totaltime'],
                'ilhour' => $post_data['ilhour'],
                'cost' => $post_data['cost'],     
                'service' => $post_data['service'],           
                'epicharge' => $epicharge);
            $acnt=array(
                'astandard' => $post_data['echarge'],
                'alevel' => $post_data['elevel'],
                'abank' => $post_data['ebank'],
                'asubbranch' => $post_data['esubbank'],
                'acardnumber' => $post_data['eanumber'],
                'aname' => $post_data['eaname']
            );                
        }
        if ($this->Project_model->addAnExpert($ep_data,$acnt,$post_data['ucmt'])) {
            $user_name = $temp['uname'];
            $this->Project_model->saveLog($user_name, 31, $piid, $eid);
            echo 'y';
        } else
            echo 'n';
    }
    //处理用户约访信息的页面
    //另外要将用户id与项目id放置在链接后面
    function inputMeet($piid = 0, $eid = 0)
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
        } elseif ($temp['urole'] == 'ud' ) {
            echo '<p>You can not access without permission!</p>';
            return;
        }

        if ($eid <= 0 || $piid <= 0) {
            //跳转到主要页面
            return;
        }
        //装载url助手
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        $this->load->model('Project_model');
        $this->load->model('Client_model');
        //判断用户是否登录
        //Code...
        //载入页面
        $css_js_info = array(
            'js1' => js_url('/validateForm.js'),
            'js2' => js_url('/myajax.js'),
           
            'js4' => js_url('/dateSelect.js'),
            //'css1' => css_url('/maincss.css')
            );
        $param['head_title'] = "搜索结果";
        $param['left_title'] = "项目信息";
        $param['page_stat'] = 7;
        $param['piid'] = $piid;
        $param['eid'] = $eid;
        $param['ghalfhour'] = $this->Project_model->getHalfHour($piid);
        $param['css_js_url'] = $css_js_info;
        $param['url_project'] = $this->url['project'];
        $param['url_left'] = array(
            'projectMain' => $this->url['project'],
            'projectAdd' => $this->url['project'] . '/addProject',
            'projectSearch' => $this->url['project'] . '/search');
        $param['url'] = $this->url;
        $pguest = $this->Project_model->getClientJoined($piid);
        if($pguest)
        $param['contact_list'] = $this->Client_model->getAllCnntName($pguest['cid']);
        //$this->load->view('head', $param);
        //        $this->load->view('project_view/left');
        //        $this->load->view('project_view/projectAddExpert2');
        //        $this->load->view('button');
        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('project_view/left');
        $this->load->view('project_view/projectAddExpert2');
        $this->load->view('bottom');


    }
    //注意专家id放在第一位，页数放第二位
    function addExpert($piid = 0, $pageNow = 1, $isAll = 0)
    {
        //默认是显示所有的专家
        //和专家搜索一样，只是链接变了而已，因此可以载入专家显示页面
        //链接导向的是约访信息页面
        //装载辅助工具
        if ($piid <= 0) {
            //跳转到主要页面
            return;
        }

        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo '<p>Please Login First!</p>';
            echo '<a href="/CIFramework/index.php">Login!</a>';
            return;
        } elseif ($temp['urole'] == 'ud' ) {
            echo '<p>You can not access without permission!</p>';
            return;
        }

        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        //用户登录参数

        //设置每页结果数大小
        $pageSize = 15;
        $this->load->model('Expert_model');

        //显示所有结果
        if ($isAll == 1) {
            //说明是完全搜索
            $st = 3;
            $session_array['st'] = 3;

        }
        //如果有post数据，说明是新的搜索，应该保存session会话
        elseif (isset($_POST['searchType'])) {

            $s_data = $this->input->post(null, false);
            //简单搜索
            if ($s_data['searchType'] == '2') {
                $st = 1;
                $keyword = $s_data['keyword'];
                $session_array = array('st' => 1, 'keyword' => $s_data['keyword']);
            } elseif ($s_data['searchType'] == '3') { //复杂搜索
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
            //$this->session->set_flashdata($session_array);

            $user_name = $temp['uname'];
            ;
            $this->Expert_model->saveLog($user_name, 51);


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
            //$this->session->set_flashdata($session_array);


        }
        if ($st == 1) {

            $param['s_result'] = $this->Expert_model->searchExpertSimple($keyword, $pageNow,
                $pageSize);
            $total_result = $this->Expert_model->getResultNumberForSimple($keyword);
        } elseif ($st == 2) {
            // echo '<br />I am here2';
            $param['s_result'] = $this->Expert_model->searchExpertComplicate($key_array, $pageNow,
                $pageSize);
            $total_result = $this->Expert_model->getResultNumberForComplicate($key_array);
        } else {
            // echo '<br />I am here3:'.$st;
            $param['s_result'] = $this->Expert_model->getExpertInfo($pageSize, ($pageNow - 1) *
                $pageSize);
            ;
            $total_result = $this->Expert_model->getTotalExperts();
        }
        //如果是全部结果的标识，则要重置session
        //如果没有结果，则要重置session打破死循环
        if ($total_result <= 0) {
            $session_array['st'] = 3;
        }
        $this->session->set_flashdata($session_array);
        $param['page_str'] = $this->_myPageInation($total_result, $pageSize,
            '/CIFramework/index.php/project/welcome/addExpert/' . $piid . '/', 5);
        $css_js_info = array(
            'js1' => js_url('/proSelect.js'),
            'js2' => js_url('/addrSelect.js'),
            'js3' => js_url('/dialog.js'),
            //  'js4' => js_url('/tablecloth.js'),
            'css1' => css_url('/dialog.css'),
            //  'css2' => css_url('/tablecloth.css')
            );
        $param['head_title'] = "添加合作专家";
        $param['left_title'] = "项目信息";
        $param['page_stat'] = 6;
        $param['css_js_url'] = $css_js_info;
        $param['pid'] = $piid;
        $param['url_deal_click'] = $this->url['project'] . '/inputMeet/' . $piid . '/';
        $param['url_left'] = array(
            'projectMain' => $this->url['project'],
            'projectAdd' => $this->url['project'] . '/addProject',
            'projectSearch' => $this->url['project'] . '/search');
        $param['url'] = $this->url;
        //$this->load->view('head', $param);
        //        // $this->load->view('project_view/left');
        //        $this->load->view('project_view/left_search');
        //        $this->load->view('expert_view/searchResult');
        //        $this->load->view('button');

        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('project_view/left_search');
        $this->load->view('expert_view/searchResult');
        $this->load->view('bottom');

    }
    //搜索项目页面
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
        } elseif ($temp['urole'] == 'ud') {
            echo '<p>You can not access without permission!</p>';
            return;
        }

        $css_js_info = array( //  'css1' => css_url('/maincss.css')
                );
        $param['head_title'] = "项目搜索";
        $param['left_title'] = "项目信息";
        $param['page_stat'] = 2;
        $param['css_js_url'] = $css_js_info;
        $param['url_left'] = array(
            'projectMain' => $this->url['project'],
            'projectAdd' => $this->url['project'] . '/addProject',
            'projectSearch' => $this->url['project'] . '/search');
        $param['url'] = $this->url;
        $param['url_project'] = $this->url['project'];
        //$this->load->view('head', $param);
        //        $this->load->view('project_view/left');
        //        $this->load->view('project_view/projectSearch');
        //        $this->load->view('button');

        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('project_view/left');
        $this->load->view('project_view/projectSearch');
        $this->load->view('bottom');
    }
    //项目信息首页
    function index($pageNow = 1)
    {
        //装载url助手
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        $this->load->model('Project_model');

        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo '<p>Please Login First!</p>';
            echo '<a href="/CIFramework/index.php">Login!</a>';
            return;
        } elseif ($temp['urole'] == 'ud') {
            echo '<p>You can not access without permission!</p>';
            return;
        }

        //设置每页结果数量
        $limit = 20;
        //获取本页要显示的数据
        $param['r'] = $this->Project_model->getProjectInfo($limit, ($pageNow - 1) * $limit);
        //将要传给视图的分页代码
        $param['page_str'] = $this->_myPageInation($this->Project_model->
            getTotalProjects(), $limit, '/CIFramework/index.php/project/welcome/index/');
        //用户登录参数
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }

        //载入页面
        $css_js_info = array( //  'js4' => js_url('/tablecloth.js'),
                //            'css1' => css_url('/maincss.css'),
            //            'css2' => css_url('/tablecloth.css')
            );
        $param['deal_url'] = $this->url['project'] . '/showProjectInfo/';
        $param['head_title'] = "项目主页";
        $param['left_title'] = "项目信息";
        $param['page_stat'] = 1;
        $param['css_js_url'] = $css_js_info;
        $param['url_left'] = array(
            'projectMain' => $this->url['project'],
            'projectAdd' => $this->url['project'] . '/addProject',
            'projectSearch' => $this->url['project'] . '/search');
        $param['url'] = $this->url;

        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('project_view/left');
        $this->load->view('project_view/projectMain');
        $this->load->view('bottom');
        // $this->load->view('head', $param);
        //        $this->load->view('project_view/left');
        //        $this->load->view('project_view/projectMain');
        //        $this->load->view('button');
    }
    //添加专家，使用表单辅助助手
    public function addProject()
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
        } elseif ($temp['urole'] == 'ud' || $temp['urole'] == 'uc') {
            echo '<p>You can not access without permission!</p>';
            return;
        }

        //载入页面
        $css_js_info = array(
            'js2' => js_url('/validateForm.js'),
            'js3' => js_url('/dateSelect.js'),
            //'js4' => js_url('/tablecloth.js'),
            //            'css1' => css_url('/maincss.css'),
            //            'css2' => css_url('/tablecloth.css')
            );
        $param['head_title'] = "添加项目信息";
        $param['left_title'] = "项目信息";
        $param['page_stat'] = 3;
        $param['css_js_url'] = $css_js_info;
        $param['url_left'] = array(
            'projectMain' => $this->url['project'],
            'projectAdd' => $this->url['project'] . '/addProject',
            'projectSearch' => $this->url['project'] . '/search');
        $param['url'] = $this->url;
        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('project_view/left');
        $this->load->view('project_view/projectAdd');
        $this->load->view('bottom');
        //$this->load->view('head', $param);
        //        $this->load->view('project_view/left');
        //        $this->load->view('project_view/projectAdd');
        //        $this->load->view('button');
    }

    //添加一个项目的处理页面
    public function addAnProject()
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
        } elseif ($temp['urole'] == 'ud' || $temp['urole'] == 'uc') {
            echo '<p>You can not access without permission!</p>';
            return;
        }
        //取得传送过来的数据
        $project_data = $this->input->post(null, true);
        $id = $this->_saveProjectInfo($project_data);

        $this->load->helper('url');
        $this->load->model('Project_model');
        //页面跳转
        if ($id > 0) {
            $user_name = $temp['uname'];
            $this->Project_model->saveLog($user_name, 22, $id);

            redirect('/project/welcome/showProjectInfo/' . $id . '', 'location', 301);
        } else
            echo 'failed';
    }
    //显示某个专家的信息
    public function showProjectInfo($pid = 0)
    {
        if ($pid == 0) {
            return;
        }
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        //用户登录参数
        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo '<p>Please Login First!</p>';
            echo '<a href="/CIFramework/index.php">Login!</a>';
            return;
        } elseif ($temp['urole'] == 'ud') {
            echo '<p>You can not access without permission!</p>';
            return;
        }
        $this->load->model('Project_model');
        $this->load->model('Client_model');
        $param['pid'] = $pid;
        $param['project_basic'] = $this->Project_model->getProjectBasicInfo($pid);
        $param['project_guest'] = $this->Project_model->getClientJoined($pid);
        $param['project_detail'] = $this->Project_model->getProjectDetailInfo($pid);
        $param['project_expert'] = $this->Project_model->getExpertJoined($pid);
        $css_js_info = array(
            'js1' => js_url('/myajax.js'),
            //     'js2' => js_url('/jquery.js'),
            'js3' => js_url('/dateSelect.js'),
            'js2' => js_url('/validateForm.js')
            //     'css1' => css_url('/maincss.css'),
            //      'css2' => css_url('/bluedream.css')
            );
        $param['head_title'] = "项目详细信息";
        $param['left_title'] = "项目信息";
        $param['url_to_guest_main'] = $this->url['guest'];
        $param['url_project'] = $this->url['project'];
        $param['page_stat'] = 4;
        $param['css_js_url'] = $css_js_info;
        $param['url_left'] = array(
            'projectMain' => $this->url['project'],
            'projectAdd' => $this->url['project'] . '/addProject',
            'projectSearch' => $this->url['project'] . '/search');
        $param['url'] = $this->url;
        $pguest = $this->Project_model->getClientJoined($pid);
        if($pguest)
        $param['contact_list'] = $this->Client_model->getAllCnntName($pguest['cid']);

        $user_name = $temp['uname'];
        $this->Project_model->saveLog($user_name, 72, $pid);


        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('project_view/left');
        $this->load->view('project_view/projectInfo');
        $this->load->view('bottom');
        //$this->load->view('head', $param);
        //        $this->load->view('project_view/left');
        //        $this->load->view('project_view/projectInfo');
        //        $this->load->view('button');

    }
    //修改项目的AJAX
    public function projectAjax()
    {
        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $value) {
            $param[$k] = $value;
        }
        if (!$temp['isLogin']) {
            echo 'n';
            return;
        } elseif ($temp['urole'] == 'ud' || $temp['urole'] == 'uc') {
            echo 'n';
            return;
        }

        if (!isset($_POST['type'])) {
            echo 'n';
            return;
        }
        $this->load->model('Project_model');
        $this->load->model('Expert_model');
        if ($_POST['type'] == "1") { ////修改项目偏好
            $piid = $_POST['piid'];
            $i = 0;
            if (!empty($_POST['peneed'])) {
                $v['eneed'] = $_POST['peneed'];
            }
            if (!empty($_POST['iSMS'])) {
                $v['isms'] = $_POST['iSMS'];
            }
            if (!empty($_POST['comchannel'])) {
                $v['comchannel'] = $_POST['comchannel'];
            }
            if (!empty($_POST['updatefreq'])) {
                $v['updatefreq'] = $_POST['updatefreq'];
            }
            if (!empty($_POST['dailyiquota'])) {
                $v['dailyiquota'] = $_POST['dailyiquota'];
            }
            if (!empty($_POST['endtime'])) {
                $v['endtime'] = $_POST['endtime'];
            }
            if ($this->Project_model->alterProject(1, $piid, $v)) {


                echo "y";
            } else
                echo "n";
        } elseif ($_POST['type'] == "2") { //修改项目基本信息
            $piid = $_POST['piid'];
            $i = 0;
            if (!empty($_POST['pname'])) {
                $v['pname'] = $_POST['pname'];
            }
            if (!empty($_POST['pem'])) {
                $v['pem'] = $_POST['pem'];
            }
            if (!empty($_POST['pcode'])) {
                $v['pcode'] = $_POST['pcode'];
            }
            if (!empty($_POST['pemcontact'])) {
                $v['pemcontact'] = $_POST['pemcontact'];
            }
            if(!empty($_POST['pcontact'])){
                $p_a=array('contact'=>$_POST['pcontact']);
                $re=$this->Project_model->alterProject(1, $piid, $p_a);
            }
            if ($this->Project_model->alterProject(2, $piid, $v) || $re) {

                $user_name = $temp['uname'];
                
                $this->Project_model->saveLog($user_name, 21, $piid);

                echo "y";
            } else
                echo "n";
        } elseif ($_POST['type'] == "3") { //这个是用来修改项目的需求信息
            $piid = $_POST['piid'];
            $i = 0;
            if (!empty($_POST['eneed'])) {
                $v['eneed'] = $_POST['eneed'];
            }
            if (!empty($_POST['goodtime'])) {
                $v['goodtime'] = $_POST['goodtime'];
            }
            if (!empty($_POST['updatefreq'])) {
                $v['updatefreq'] = $_POST['updatefreq'];
            }
            if (!empty($_POST['updateform'])) {
                $v['updateform'] = $_POST['updateform'];
            }
            if (!empty($_POST['testkw'])) {
                $v['testkw'] = $_POST['testkw'];

            }
            if (!empty($_POST['outline'])) {
                $v['outline'] = $_POST['outline'];
            }
            if (!empty($_POST['endtime'])) {
                $v['endtime'] = $_POST['endtime'];
            }
            if (!empty($_POST['expertposition'])) {
                $v['expertposition'] = $_POST['expertposition'];
            }
            if ($this->Project_model->alterProject(1, $piid, $v)) {

                $user_name = $temp['uname'];
                ;
                $this->Project_model->saveLog($user_name, 21, $piid);

                echo "y";
            } else
                echo "n";
        } elseif ($_POST['type'] == "4") { //修改项目备注
            $piid = $_POST['piid'];
            if (!empty($_POST['premark'])) {
                $v['premark'] = $_POST['premark'];
            }
            if ($this->Project_model->alterProject(1, $piid, $v)) {

                $user_name = $temp['uname'];
                ;
                $this->Project_model->saveLog($user_name, 21, $piid);

                echo "y";
            } else
                echo "n";
        } elseif ($_POST['type'] == "5") { //修改项目详细需求
            $piid = $_POST['piid'];
            if (!empty($_POST['pediscribe'])) {
                $v['pediscribe'] = $_POST['pediscribe'];
            }
            if ($this->Project_model->alterProject(1, $piid, $v)) {

                $user_name = $temp['uname'];
                ;
                $this->Project_model->saveLog($user_name, 21, $piid);

                echo "y";
            } else
                echo "n";
        } elseif ($_POST['type'] == "6") { //获取admin列表
            $adminlist = $this->Project_model->getAdminList();
            // echo "<script>alert('".$adminlist."');</script>";

            echo $adminlist;
        } elseif ($_POST['type'] == "7") { //获取联系人列表
            $clientlist = $this->Project_model->getClientList($_POST['pid']);
            echo $clientlist;
        } elseif ($_POST['type'] == "8") { //删除项目
            $this->load->model('Project_model');
            $re = $this->Project_model->delPrjt($_POST['piid']);
            if ($re) {
                $user_name = $temp['uname'];
                $this->Project_model->saveLog($user_name, 83, $_POST['piid']);
                echo "y";
            } else {
                echo 'n';
            }
        } elseif ($_POST['type'] == "9") { //删除一个合作顾问
            if ($this->Project_model->delCnst($_POST['ecid'])){
                echo 'y';
            }else{
                echo 'n';
            }
            
        } elseif ($_POST['type'] == "10") { //删除客户
            if ($this->Project_model->delProGuest($_POST['piid'])){
                echo 'y';
            }else{
                echo 'n';
            }
            
        }elseif ($_POST['type'] == "11") { //修改评论
            if ($this->Expert_model->alterCmt($_POST['cmtid'],$_POST['ctnt'])){
                echo 'y';
            }else{
                echo 'n';
            }
            
        } elseif ($_POST['type'] == "12") { //删除评论
            if ($this->Expert_model->delCmmt($_POST['cmtid'],$_POST['pjtid'],$_POST['eid'])){
                echo 'y';
            }else{
                echo 'n';
            }
            
        } 

    }
    //保存项目信息，返回的是ID
    private function _saveProjectInfo($project_data)
    {
        $this->load->model('Project_model');
        //状态聘用和完成合作
        $pname = $project_data['pname'];
        $pcode = $project_data['pcode'];
        $pem = $project_data['pem'];
        $pemcontact = $project_data['pemcontact'];
        if ($pname != "" && $pcode != "" && $pem != "") {
            $pid = $this->Project_model->addProjectInfo($pname, $pem, $pcode, $pemcontact);
            //if insert success,then insert detail
            if ($pid > 0) {
                $eneed = $project_data['peneed'];
                if ($eneed == "")
                    $eneed = 1;
                
                $ekind = $project_data['pediscribe'];
                $updatefreq = $project_data['updatefreq'];
                if ($project_data['dailyiquota'] != '')
                    $daylimit = $project_data['dailyiquota'];
                else
                    $daylimit = 0;

                $project_info = array(
                    'piid' => $pid,
                    'eneed' => $eneed,
                    'pediscribe' => $ekind,
                    'updatefreq' => $updatefreq,
                    'comchannel' => $project_data['comchannel'],
                    'isms' => $project_data['iSMS'],
                    'dailyiquota' => $daylimit,
                    'contact' => $project_data['pcontact'],
                    'premark' => $project_data['premark'],
                    'endtime' => $project_data['endtime']);

                $this->Project_model->addProjectDetail($project_info);
            }
            return $pid;

        }
        return 0;

    }

    function buildPdf($piid)
    {
        
        $this->load->model('Project_model');
        $project_basic = $this->Project_model->getProjectBasicInfo($piid);
        $project_detail = $this->Project_model->getProjectDetailInfo($piid);
        $project_guest = $this->Project_model->getClientJoined($piid);
        $this->load->library('pdfunicode');
        $this->pdfunicode->Open();
        $this->pdfunicode->AddPage();
        $this->pdfunicode->AddGBFont('ch');
        $this->pdfunicode->Image('yixinlogo.jpg', 5, 10, 40, 15);
        $this->pdfunicode->Line(30, 28, 170, 28);
        //左边距20mm

        $this->pdfunicode->SetLeftMargin(20);
        //在边框里填入数据，首先是标题
        $this->pdfunicode->SetY(40);
        $this->pdfunicode->SetLineWidth(0.3);
        $this->pdfunicode->SetFont('Arial', 'B', 10);
        $this->pdfunicode->SetFillColor(76, 154, 47);
        $this->pdfunicode->SetTextColor(255, 255, 255);
        $this->pdfunicode->Cell(172, 6, 'New project receipt', 1, 1, 'L', 1);

        //General Infromation
        $this->pdfunicode->SetLineWidth(0.2);
        $this->pdfunicode->SetFont('courier', 'B', 10);
        $this->pdfunicode->SetFillColor(205, 205, 205);
        $this->pdfunicode->SetTextColor(0, 0, 0);
        $this->pdfunicode->Cell(172, 6, 'General Information', 1, 1, 'L', 1);
        
        if(strlen($project_basic['pname']) > 29){
            $this->pdfunicode->SetFont('Arial', '', 10);
            $this->pdfunicode->Cell(43, 6, 'Project Name:', 1, 0, 'L');
            $this->pdfunicode->SetFont('ch', '', 10);
            $this->pdfunicode->Cell(129, 6, $this->convertUTF($project_basic['pname']), 1, 1,
                'L');
                
            $this->pdfunicode->SetFont('Arial', '', 10);
            $this->pdfunicode->Cell(43, 6, 'Project No.', 1, 0, 'L');
            $this->pdfunicode->Cell(129, 6, $project_basic['pcode'], 1, 1, 'L');
        }
        else{
        //第一行project name和project code
        $this->pdfunicode->SetFont('Arial', '', 10);
        $this->pdfunicode->Cell(43, 6, 'Project Name:', 1, 0, 'L');
        $this->pdfunicode->SetFont('ch', '', 10);
        $this->pdfunicode->Cell(43, 6, $this->convertUTF($project_basic['pname']), 1, 0,
            'L');
            
        $this->pdfunicode->SetFont('Arial', '', 10);
        $this->pdfunicode->Cell(43, 6, 'Project No.', 1, 0, 'L');
        $this->pdfunicode->Cell(43, 6, $project_basic['pcode'], 1, 1, 'L');
        }
        //第二行客户名和客户联系人
        if (empty($project_guest)) {
            $gname = '';
            $gbcname = '';
        } else {
            $gname = $project_guest['gname'];
            $gbcname = $project_guest['gbcname'];
        }
        if(strlen($gname) > 29){
            $this->pdfunicode->Cell(43, 6, 'Client:', 1, 0, 'L');
            $this->pdfunicode->SetFont('ch', '', 10);
            $this->pdfunicode->Cell(129, 6, $this->convertUTF($gname), 1, 1, 'L');
            $this->pdfunicode->SetFont('Arial', '', 10);
            $this->pdfunicode->Cell(43, 6, 'Project Manager:', 1, 0, 'L');
            $this->pdfunicode->SetFont('ch', '', 10);
            $this->pdfunicode->Cell(129, 6, $this->convertUTF($project_basic['pem']), 1, 1,
                'L');
        }
        else{
            $this->pdfunicode->Cell(43, 6, 'Client:', 1, 0, 'L');
            $this->pdfunicode->SetFont('ch', '', 10);
            $this->pdfunicode->Cell(43, 6, $this->convertUTF($gname), 1, 0, 'L');
            $this->pdfunicode->SetFont('Arial', '', 10);
            $this->pdfunicode->Cell(43, 6, 'Project Manager:', 1, 0, 'L');
            $this->pdfunicode->SetFont('ch', '', 10);
            $this->pdfunicode->Cell(43, 6, $this->convertUTF($project_basic['pem']), 1, 1,
                'L');
        }

        //第三行pem 和pemcontact
        $this->pdfunicode->SetFont('Arial', '', 10);
        $this->pdfunicode->Cell(43, 6, 'Main Contact:', 1, 0, 'L');
        $this->pdfunicode->SetFont('ch', '', 10);
        $this->pdfunicode->Cell(43, 6, $this->convertUTF($gbcname), 1, 0, 'L');
        $this->pdfunicode->SetFont('Arial', '', 10);
        $this->pdfunicode->Cell(43, 6, 'Mobile No.:', 1, 0, 'L');
        $this->pdfunicode->Cell(43, 6, $project_basic['pemcontact'], 1, 1, 'L');

        //客户偏好
        $this->pdfunicode->SetFont('courier', 'B', 10);
        $this->pdfunicode->Cell(172, 6, 'Client Preference', 1, 1, 'L', 1);

        //专家需求和截止日期
        $this->pdfunicode->SetFont('Arial', '', 10);
        $this->pdfunicode->Cell(43, 6, 'Expert required:', 1, 0, 'L');
        $this->pdfunicode->Cell(43, 6, $project_detail['eneed'], 1, 0, 'L');
        $this->pdfunicode->Cell(43, 6, 'Deadline:', 1, 0, 'L');
        $this->pdfunicode->Cell(43, 6, $project_detail['endtime'], 1, 1, 'L');

        //更新频率和联系渠道
        $this->pdfunicode->Cell(43, 6, 'Update frequency:', 1, 0, 'L');
        $this->pdfunicode->Cell(43, 6, $project_detail['updatefreq'], 1, 0, 'L');
        $this->pdfunicode->Cell(43, 6, 'Contact approach:', 1, 0, 'L');
        $this->pdfunicode->SetFont('ch', '', 10);
        $this->pdfunicode->Cell(43, 6, $this->convertUTF($project_detail['comchannel']),
            1, 1, 'L');

        //dailyiquota 和 sms
        $this->pdfunicode->SetFont('Arial', '', 10);
        $this->pdfunicode->Cell(43, 6, 'Daily interview quota:', 1, 0, 'L');
        $this->pdfunicode->Cell(43, 6, $project_detail['dailyiquota'], 1, 0, 'L');
        $this->pdfunicode->Cell(43, 6, 'Interview SMS:', 1, 0, 'L');
        $this->pdfunicode->SetFont('ch', '', 10);
        $this->pdfunicode->Cell(43, 6, $this->convertUTF($project_detail['isms']), 1, 1,
            'L');

        //详细需求
        $this->pdfunicode->SetFont('courier', 'B', 10);
        $this->pdfunicode->Cell(172, 6, 'Detailed request', 1, 1, 'L', 1);
        $this->pdfunicode->SetFont('ch', '', 10);
        $this->pdfunicode->MultiCell(172, 6, $this->convertUTF($project_detail['pediscribe']),
            0, 'L');

        //备注
        $this->pdfunicode->SetFont('courier', 'B', 10);
        $this->pdfunicode->Cell(172, 6, 'Remark', 1, 1, 'L', 1);
        $this->pdfunicode->SetFont('ch', '', 10);
        $this->pdfunicode->MultiCell(172, 6, $this->convertUTF($project_detail['premark']),
            0, 'L');
        //用0.5mm的线画边框
        $this->pdfunicode->SetLineWidth(0.5);
        $this->pdfunicode->Rect(20, 40, 172, 220);

        $this->pdfunicode->Output();
    }

    function convertUTF($name)
    {

        return iconv('UTF-8', 'GB2312', $name);
    }


}
?>