<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller
{

    private static $instance;

    /**
     * Constructor
     */
    public $url=array(
            'base' => '/CIFramework',
            'main' => '/CIFramework/index.php/welcome/showMain',
            'expert' => '/CIFramework/index.php/expert/welcome',
            'project' => '/CIFramework/index.php/project/welcome',
            'guest' => '/CIFramework/index.php/guest/welcome',
            'email' => '/CIFramework/index.php/email/welcome',
            'logout' => '/CIFramework/index.php/welcome/logOut',
            'admin' => '/CIFramework/index.php/admin/welcome',
            'image' => '/CIFramework/public/image/',
            'upload'=>'/CIFramework/public/uploads');
    public function __construct()
    {
        self::$instance = &$this;

        // Assign all the class objects that were instantiated by the
        // bootstrap file (CodeIgniter.php) to local class variables
        // so that CI can run as one big super object.
        foreach (is_loaded() as $var => $class) {
            $this->$var = &load_class($class);
        }

        $this->load = &load_class('Loader', 'core');

        $this->load->initialize();

        log_message('debug', "Controller Class Initialized");


    }

    public static function &get_instance()
    {
        return self::$instance;
    }
    //读取cookies，判断用户是否登录
    public function _isLogin()
    {
        $this->load->helper('cookie');
        $p['uname'] = $this->input->cookie('uname');
        $p['urole'] = $this->input->cookie('urole');
        $p['uid'] = $this->input->cookie('uid');
        if ($p['uid'] == '')
            $p['isLogin'] = false;
        else
            $p['isLogin'] = true;
        return $p;
    }
    //分页功能，返回当前的分页html代码
    public function _myPageInation($total, $pageSize, $url,$page_site=4)
    {

        $this->load->library('pagination');
        $config['base_url'] = $url;
        $config['total_rows'] = $total;
        $config['per_page'] = $pageSize;
        $config['num_links'] = 4;
        $config['use_page_numbers'] = true;
        $config['uri_segment'] = $page_site;
        $this->pagination->initialize($config);

        return $this->pagination->create_links();
    }
}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */
