<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -  
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if ($temp['isLogin']) {
            redirect('/welcome/showMain', 'location', 301);
        }
        $css_js_info = array(
            'js1' => js_url('/validateForm.js'),
            'js2' => js_url('/jquery.js'),
            'js3' => js_url('/myajax.js'),
            'css1' => css_url('/index.css'));
        $param['css_js_url'] = $css_js_info;
        $param['head_title'] = "用户登录";
        $param['url'] = $this->url;
        $this->load->view('headlink', $param);
        $this->load->view('index');

    }

    public function loginAjax()
    {
        // echo '<script> alert("'.$ajax_data.'");</script>';

        $ajax_data = $this->input->post(null, true);
        
        //print_r($ajax_data);
        //return;
        $this->load->model('User_info');
        $re = $this->User_info->isLogin($ajax_data['name'], $ajax_data['password']);
        if (empty($re))
            echo 'n';
        else {
            $this->load->helper('cookie');
            $info = $re['wid'] . '|' . $re['wname'] . '|' . $re['wrole'];
            $this->input->set_cookie('uname', $re['wname'], '86400', '', $this->url['base'],
                '', '');
            $this->input->set_cookie('uid', $re['wid'], '86400', '', $this->url['base'], '',
                '');
            $this->input->set_cookie('urole', $re['wrole'], '86400', '', $this->url['base'],
                '', '');
            //记录登录信息
            $this->User_info->saveLog($re['wname'], 61);

            echo $info;

        }


    }

    public function showMain()
    {
        //用户登录
        $temp = $this->_isLogin();
        foreach ($temp as $k => $v) {
            $param[$k] = $v;
        }
        if (!$temp['isLogin']) {
            echo '<p>Please Login First!</p><br />';
            echo '<a href="/CIFramework/index.php">Login!</a>';
            return;
        }

        $this->load->helper('url');
        $this->load->helpers('my_url_helper');
        $css_js_info = array('js4' => js_url('/myajax.js'));
        $param['head_title'] = "主页";
        $param['left_title'] = "主页";
        $param['css_js_url'] = $css_js_info;
        $param['url'] = $this->url;
        
        $this->load->view('headlink', $param);
        $this->load->view('headline');
        $this->load->view('main');
        $this->load->view('bottom');
    }

    public function logOut()
    {
        $this->load->helper('cookie');
        $temp = $this->_isLogin();
        delete_cookie("uname", "", $this->url['base'], "");
        delete_cookie("uid", "", $this->url['base'], "");
        delete_cookie("urole", "", $this->url['base'], "");

        $this->load->model('Project_model');
        $this->Project_model->saveLog($temp['uname'], 62);

        $this->load->view('logout');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
