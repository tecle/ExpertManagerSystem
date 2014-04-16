<?php
class Welcome extends CI_Controller
{

    public function index($pageNow = 1)
    {
        //装载url助手
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        $this->load->model('Client_model');

        //设置每页结果数量
        $limit = 20;
        //获取本页要显示的数据
        $param['r'] = $this->Client_model->getGuestInfo($limit, ($pageNow - 1) * $limit);
        //将要传给视图的分页代码
        $param['page_str'] = $this->_myPageInation($this->Client_model->getTotalNumbers
            (), $limit, $this->url['guest'] . '/index/');
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

        if (!$param['r'])
            $param['isHaveResult'] = false;

        //载入页面
        $css_js_info = array(
          //  'js4' => js_url('/tablecloth.js'),
         //   'css1' => css_url('/maincss.css'),
          //  'css2' => css_url('/tablecloth.css')
          );
        $param['head_title'] = "客户信息首页";
        $param['left_title'] = "客户信息";
        $param['page_stat'] = 1;
        $param['css_js_url'] = $css_js_info;
        $param['url_left'] = array(
            'guestMain' => $this->url['guest'],
            'guestAdd' => $this->url['guest'] . '/addGuest',
            'guestSearch' => $this->url['guest'] . '/search');
        $param['url'] = $this->url;
        
        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('guest_view/left');
        $this->load->view('guest_view/guestMain');
        $this->load->view('bottom');
        //$this->load->view('head', $param);
//        $this->load->view('guest_view/left');
//        $this->load->view('guest_view/guestMain');
//        $this->load->view('button');
    }
    //客户查找
    public function search()
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

        $css_js_info = array(//'css1' => css_url('/maincss.css')
        );
        $param['head_title'] = "客户搜索";
        $param['left_title'] = "客户信息";
        $param['page_stat'] = 2;
        $param['css_js_url'] = $css_js_info;
        $param['url_left'] = array(
            'guestMain' => $this->url['guest'],
            'guestAdd' => $this->url['guest'] . '/addGuest',
            'guestSearch' => $this->url['guest'] . '/search');
        $param['url'] = $this->url;

        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('guest_view/left');
        $this->load->view('guest_view/guestSearch');
        $this->load->view('bottom');
       // $this->load->view('head', $param);
//        $this->load->view('guest_view/left');
//        $this->load->view('guest_view/guestSearch');
//        $this->load->view('button');
    }
    //搜索结果
    public function searchResult($pageNow = 1)
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
        //装载辅助工具
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        //设置每页结果数大小
        $pageSize = 20;
        $this->load->model('Client_model');
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
                if ($s_data['gtype'] == '0')
                    $gtype = '';
                else
                    $gtype = $s_data['gtype'];
                $key_array = array(
                    'gname' => $s_data['gname'],
                    'gtype' => $gtype,
                    'gbclient' => $s_data['gbclient'],
                    'gpclient' => $s_data['gpclient'],
                    'gintroduction' => $s_data['gintroduction'],
                    'gremark' => $s_data['gremark']);
                foreach ($key_array as $key => $value)
                    $session_array[$key] = $value;
                $session_array['st'] = 2;
            } else {
                $st = 3;
                $session_array['st'] = 3;
            }
            //全新的搜索，保存搜索日志
            $user_name = $temp['uname'];
            $this->Client_model->saveLog($user_name, 53);

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
                    'gname' => $this->session->flashdata('gname'),
                    'gtype' => $this->session->flashdata('gtype'),
                    'gbclient' => $this->session->flashdata('gbclient'),
                    'gpclient' => $this->session->flashdata('gpclient'),
                    'gintroduction' => $this->session->flashdata('gintroduction'),
                    'gremark' => $this->session->flashdata('gremark'));
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
            $param['r'] = $this->Client_model->searchGuestSimple($keyword, $pageNow, $pageSize);
            $total_result = $this->Client_model->getResultNumberForSimple($keyword);
        } elseif ($st == 2) {
            $param['r'] = $this->Client_model->searchGuestComplicate($key_array, $pageNow, $pageSize);
            $total_result = $this->Client_model->getResultNumberForComplicate($key_array);
        } else {
            $param['r'] = array();
            $total_result = 0;
        }

        $param['page_str'] = $this->_myPageInation($total_result, $pageSize, $this->url['guest'] .
            '/searchResult/');

        //显示搜索结果的代码，由前台填充
        //载入页面
        $css_js_info = array(
         //   'js4' => js_url('/tablecloth.js'),
           // 'css1' => css_url('/maincss.css'),
            //'css2' => css_url('/tablecloth.css')
            );
        $param['head_title'] = "客户信息搜索";
        $param['left_title'] = "客户搜索结果";
        $param['page_stat'] = 2;
        $param['css_js_url'] = $css_js_info;
        $param['url_left'] = array(
            'guestMain' => $this->url['guest'],
            'guestAdd' => $this->url['guest'] . '/addGuest',
            'guestSearch' => $this->url['guest'] . '/search');
        $param['url'] = $this->url;

        //$this->load->view('head', $param);
//        $this->load->view('guest_view/left');
//        $this->load->view('guest_view/guestMain');
//        $this->load->view('button');
//        
        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('guest_view/left');
        $this->load->view('guest_view/guestMain');
        $this->load->view('bottom');
    }
    //用户点击添加项目后返回的是客户信息页面，当然要提示添加成功
    public function dealaddproject($cid = 0, $piid = 0)
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

        if ($piid <= 0 || $cid <= 0)
            return;
        $this->load->model('Client_model');
        if ($this->Client_model->addProjectToGuest($piid, $cid)) {
            //给项目添加客户成功，保存日志
            $user_name = $temp['uname'];
            $this->Client_model->saveLog($user_name, 32, $piid, $cid);

            $param['isOk'] = true;
            $param['next_url'] = $this->url['guest'] . '/showGuestInfo/' . $cid;
        } else {
            $param['isOk'] = false;
            $param['next_url'] = $this->url['guest'] . '/addProject/' . $cid . '/1/1';
        }
        //装载添加失败的页面
        $this->load->view('web_tips', $param);

    }
    //给项目增加客户的选择页面，用户在此浏览项目信息，用到了项目搜索
    //同理，这里所需要做的也只是改变链接而已

    public function addProject($gid = 0, $pageNow = 1, $isAll = 0)
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
        } elseif ($temp['urole'] == 'ud' || $temp['urole'] == 'uc') {
            echo '<p>You can not access without permission!</p>';
            return;
        }

        //设置每页结果数大小
        $pageSize = 15;
        $this->load->model('Project_model');
        if ($isAll == 1) {
            $st = 3;
            $session_array['st'] = 3;
        }
        //如果有post数据，说明是新的搜索，应该保存session会话
        elseif (isset($_POST['searchType'])) {
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
                    'client' => $s_data['client'],
                    'em' => $s_data['em'],
                    'dissuer' => $s_data['pdissuer'],
                    'ia' => $s_data['pia'],
                    'pediscribe' => $s_data['pediscribe']);
                foreach ($key_array as $key => $value)
                    $session_array[$key] = $value;
                $session_array['st'] = 2;
            } else {
                $st = 3;
                $session_array['st'] = 3;
            }
            //$this->session->set_flashdata($session_array);
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
                    'client' => $this->session->flashdata('client'),
                    'em' => $this->session->flashdata('em'),
                    'dissuer' => $this->session->flashdata('dissuer'),
                    'ia' => $this->session->flashdata('ia'),
                    'pediscribe' => $this->session->flashdata('ediscribe'));
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
            $param['r'] = $this->Project_model->searchProjectSimple($keyword, $pageNow, $pageSize);
            $total_result = $this->Project_model->getResultNumberForSimple($keyword);
        } elseif ($st == 2) {
            $param['r'] = $this->Project_model->searchProjectComplicate($key_array, $pageNow,
                $pageSize);
            $total_result = $this->Project_model->getResultNumberForComplicate($key_array);
        } else {
            $param['r'] = $this->Project_model->getProjectInfo($pageSize, ($pageNow - 1) * $pageSize);
            $total_result = $this->Project_model->getTotalProjects();
        }

        //如果是全部结果的标识，则要重置session
        //如果没有结果，则要重置session打破死循环
        if ($total_result <= 0) {
            $session_array['st'] = 3;
        }
        $this->session->set_flashdata($session_array);

        $param['page_str'] = $this->_myPageInation($total_result, $pageSize,
            '/CIFramework/index.php/guest/welcome/addProject/' . $gid . '/', 5);
        $css_js_info = array(
           // 'js4' => js_url('/tablecloth.js'),
//            'css1' => css_url('/maincss.css'),
//            'css2' => css_url('/tablecloth.css')
);
        $param['head_title'] = "客户添加项目";
        $param['left_title'] = "客户信息";
        $param['page_stat'] = 6;
        //搜索到的专家代表的链接，第一个参数是客户的id(在这里设置),第二个参数项目的id
        $param['deal_url'] = $this->url['guest'] . '/dealaddproject/' . $gid . '/';
        $param['css_js_url'] = $css_js_info;
        $param['url_left'] = array(
            'guestMain' => $this->url['guest'],
            'guestAdd' => $this->url['guest'] . '/addGuest',
            'guestSearch' => $this->url['guest'] . '/search');
        $param['url'] = $this->url;

       // $this->load->view('head', $param);
//        $this->load->view('guest_view/left');
//        $this->load->view('project_view/projectMain');
//        $this->load->view('button');
         $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('guest_view/left');
        $this->load->view('project_view/projectMain');
        $this->load->view('bottom');
    }

    //显示添加客户的页面
    public function addGuest()
    {

        //装载url助手
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        $this->load->model('Client_model');
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

        $css_js_info = array(
            'js2' => js_url('/validateForm.js'),
            'js3' => js_url('/proSelect.js'),
            'js4' => js_url('/dateSelect.js'),
            //'css1' => css_url('/maincss.css')
            );
        $param['head_title'] = "添加客户";
        $param['left_title'] = "客户信息";
        $param['page_stat'] = 3;
        $param['css_js_url'] = $css_js_info;
        $param['url_left'] = array(
            'guestMain' => $this->url['guest'],
            'guestAdd' => $this->url['guest'] . '/addGuest',
            'guestSearch' => $this->url['guest'] . '/search');
        $param['url'] = $this->url;

        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('guest_view/left');
        $this->load->view('guest_view/guestAdd');
        $this->load->view('bottom');
        //$this->load->view('head', $param);
//        $this->load->view('guest_view/left');
//        $this->load->view('guest_view/guestAdd');
//        $this->load->view('button');
//
    }
    //显示客户公司的信息
    public function showGuestInfo($cid = 0)
    {
        if ($cid == 0) {
            echo 'No data!';
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
        } elseif ($temp['urole'] == 'ud') {
            echo '<p>You can not access without permission!</p>';
            return;
        }
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        $this->load->model('Client_model');
        $param['guest_company'] = $this->Client_model->getCompanyInfo($cid);
        if (!empty($param['guest_company'])) {
            $param['contact_info'] = $this->Client_model->getGuestBasicInfo($param['guest_company']['gbclient']);
            $param['pay_info'] = $this->Client_model->getGuestBasicInfo($param['guest_company']['gpclient']);
        } else {
            $param['contact_info'] = array();
            $param['pay_info'] = array();
        }
        $param['client_others'] = $this->Client_model->getAllCnnt($cid);
        $param['guest_project'] = $this->Client_model->getProjectJoined($cid);
        $css_js_info = array(
            'js1' => js_url('/updateClient.js'),
            'js2' => js_url('/validateForm.js'),
            'js4' => js_url('/dateSelect.js'),
            'js5' => js_url('/jquery.js'),
            'js6' => js_url('/myajax.js'),
          //  'css1' => css_url('/maincss.css'),
//            'css2' => css_url('/bluedream.css')
);
        $param['gid'] = $cid;
        $param['head_title'] = "客户详细信息";
        $param['left_title'] = "客户信息";
        $param['page_stat'] = 4;
        $param['css_js_url'] = $css_js_info;
        $param['url_left'] = array(
            'guestMain' => $this->url['guest'],
            'guestAdd' => $this->url['guest'] . '/addGuest',
            'guestSearch' => $this->url['guest'] . '/search');
        $param['url'] = $this->url;

        //数据获取完毕，保存查看日志
        $user_name = $temp['uname'];
        $this->Client_model->saveLog($user_name, 73, $cid);

        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('guest_view/left');
        $this->load->view('guest_view/guestInfo');
        $this->load->view('bottom');
        //$this->load->view('head', $param);
//        $this->load->view('guest_view/left');
//        $this->load->view('guest_view/guestInfo');
//        $this->load->view('button');
    }
    //处理修改客户信息的AJAX请求
    public function alterGuestAjax()
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

        $this->load->model('Client_model');
        $ajax_data = $this->input->post();
        if (!isset($ajax_data['type'])) {
            echo 'n';
            return;
        }
        if ($ajax_data['type'] == '2') { //修改联系人信息
            foreach ($ajax_data as $key => $value) {
                //过滤掉键为cid的数据以及值为空的数据和键值为type的数据
                if ($key != 'type' && $key != 'cid' && $value != '') {
                    $alter_data[$key] = $value;
                }
            }
            if (!isset($alter_data)) {
                echo 'n';
                return;
            }
            if ($this->Client_model->alterInfo($alter_data, $ajax_data['cid'])) {
                //修改完毕，保存日志
                $user_name = $temp['uname'];
                $this->Client_model->saveLog($user_name, 24, $ajax_data['cid']);
                echo 'y';
            } else
                echo 'n';
            return;
        } elseif ($ajax_data['type'] == '1') { //修改客户公司信息
            foreach ($ajax_data as $key => $value) {
                //过滤掉键为gid的数据以及值为空的数据
                if ($key != 'type' && $key != 'gid' && $value != '') {
                    $alter_data[$key] = $value;
                }
            }
            if (!isset($alter_data)) {
                echo 'n';
                return;
            }
            if ($this->Client_model->alterCompanyInfo($alter_data, $ajax_data['gid'])) {
                //修改完毕，保存日志
                $user_name = $temp['uname'];
                $this->Client_model->saveLog($user_name, 24, $ajax_data['gid']);
                echo 'y';
            } else
                echo 'n';
            return;
        } elseif ($ajax_data['type'] == '3') { //删除客户
            $this->load->model('Client_model');
            $re = $this->Client_model->delGust($ajax_data['gid']);
            if ($re) {
                $user_name = $temp['uname'];
                $this->Client_model->saveLog($user_name, 84, $ajax_data['gid']);
                echo 'y';
            } else {
                echo 'n';
            }
            return;
        } elseif ($ajax_data['type'] == '4') { //增加一个其他联系人
            foreach ($ajax_data as $key => $value) {
                //过滤掉键为cid的数据以及值为空的数据和键值为type的数据
                if ($key != 'type' && $key != 'gid' && $value != '') {
                    $cnnt_data[$key] = $value;
                }
            }
            //如果传进来的是空数据
            if (!isset($cnnt_data)) {
                echo 'n';
                return;
            }
            //保存
            if ($this->Client_model->addCnnt( $ajax_data['gid'],$cnnt_data)) {
                //完毕，保存日志
                $user_name = $temp['uname'];
                $this->Client_model->saveLog($user_name, 15, $ajax_data['gid']);
                echo 'y';
            } else
                echo 'n';
            return;
        } elseif ($ajax_data['type'] == '5') { //获取所有的联系人姓名
            $this->load->model('Client_model');
            $re = $this->Client_model->getAllCnntName($ajax_data['gid']);
            //返回数据
            json_encode($re);
            return;
        } elseif ($ajax_data['type'] == '6') { //删除一个其他联系人
            $this->load->model('Client_model');
            $re = $this->Client_model->delCnnt($ajax_data['cid'],$ajax_data['gid']);
            //返回数据
            if($re){
                echo 'y';
            }else{
                echo 'n';
            }
            return;
        }
        echo 'n';

    }
    //处理添加客户的请求
    public function addclient()
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

        $this->load->helper('url');
        //获取POST数据
        $add_data = $this->input->post(null, true);

        //获取公司信息
        $company['gname'] = $add_data['gname'];
        $company['gtype'] = $add_data['gtype'];
        $company['ghalfhour'] = $add_data['ghalfhour'];
        $company['gintroduction'] = $add_data['gintroduction'];
        $company['gremark'] = $add_data['gremark'];


        //获取业务联系人信息
        $vc['cname'] = $add_data['gbcname'];
        $vc['csex'] = $add_data['gbcsex'];
        $vc['cposition'] = $add_data['gbcposition'];
        $vc['clandline'] = $add_data['gbclandphone'];
        $vc['cmobile'] = $add_data['gbccellphone'];
        $vc['cemail'] = $add_data['gbcemail'];
        $vc['cbirthday'] = $add_data['gbcbirthday'];
        


        //获取付款联系人信息
        $vp['cname'] = $add_data['gpcname'];
        $vp['csex'] = $add_data['gpcsex'];
        $vp['cposition'] = $add_data['gpcposition'];
        $vp['clandline'] = $add_data['gpclandphone'];
        $vp['cmobile'] = $add_data['gpccellphone'];
        $vp['cemail'] = $add_data['gpcemail'];
        $vp['cbirthday'] = $add_data['gpcbirthday'];
        


        $this->load->model('Client_model');
        $cid = $this->Client_model->addGuest($company, $vc, $vp);
        if ($cid > 0) {
            //添加客户公司成功，保存日志
            $user_name = $temp['uname'];
            $this->Client_model->saveLog($user_name, 13, $cid);
            redirect('/guest/welcome/showGuestInfo/' . $cid . '', 'location', 301);
        } else
            redirect('/guest/addclient/', 'location', 301);
    }
}
?>