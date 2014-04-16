<?php
class Client_model extends CI_Model
{
    private $table_name = '';
    function __construct()
    {
        parent::__construct();
        $this->table_name = 'client';
        $this->load->database();
    }
    //修改公司信息
    function alterCompanyInfo($v, $id)
    {
        $this->db->where('gid', $id);
        $this->db->update('client_company', $v);
        if ($this->db->affected_rows() > 0)
            return true;
        return false;

    }
    //删除指定联系人
    function delCnnt($cid,$gid){
        $this->db->trans_begin();
        $this->db->delete('client_other', array('gid' => $gid,'cid'=>$cid));
        $this->db->delete('client', array('cid' => $cid));
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    //删除客户公司
    function delGust($gid)
    {
        //先获取客户的两个联系人
        $rst = $this->db->get_where('client_company', array('gid' => $gid));
        if ($rst->num_rows() > 0) {
            $row = $rst->row_array();
        } else {
            $row['gbclient'] = 0;
            $row['gpclient'] = 0;
        }

        //删除client/client_company/project_client
        $this->db->trans_begin();
        $this->db->delete('project_client', array('gid' => $gid));
        $this->db->delete('client_company', array('gid' => $gid));
        $this->db->delete('client_other', array('gid' => $gid));
        $this->db->delete('client', array('cid' => $row['gbclient']));
        $this->db->delete('client', array('cid' => $row['gpclient']));
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    //获取复杂搜索结果集大小
    //完全可以写个子函数生成查询语句的，2了
    function getResultNumberForComplicate($k)
    {
        //判断是否为空
        $isEmpty = true;
        foreach ($k as $key => $value) {
            if ($value != '')
                $isEmpty = false;
        }

        //组织查询语句
        if ($isEmpty)
            return 0;

        if ($k['gbclient'] != '') {
            $gbc_str0 = '(select cid from client where cname like "%' . $k['gbclient'] .
                '%") as t1 ,';
            $gbc_str1 = ' and t1.cid = t3.gbclient ';
        } else {
            $gbc_str0 = '';
            $gbc_str1 = '';
        }
        if ($k['gpclient'] != '') {
            $gpc_str0 = '(select cid from client where cname like "%' . $k['gpclient'] .
                '%") as t2 ,';
            $gpc_str1 = ' and t2.cid = t3.gpclient ';
        } else {
            $gpc_str0 = '';
            $gpc_str1 = '';
        }

        $q = 'select gid,gname,gbclient,gpclient,gtype,ghalfhour from ' . $gbc_str0 . $gpc_str0 .
            ' client_company as t3 where 1=1 ';
        $q = $q . $gbc_str1 . $gpc_str1;
        if ($k['gname'] != '')
            $q = $q . ' and gname like "%' . $k['gname'] . '%"';
        if ($k['gtype'] != '')
            $q = $q . ' and gtype="' . $k['gtype'] . '"';
        if ($k['gintroduction'] != '')
            $q = $q . ' and gintroduction like "%' . $k['gintroduction'] . '%"';
        if ($k['gremark'] != '')
            $q = $q . ' and gremark like "%' . $k['gremark'] . '%"';
        //执行查询语句
        $gids = $this->db->query($q);
        return $gids->num_rows();
    }
    //复杂搜索客户
    function searchGuestComplicate($k, $pageNow, $pageSize)
    {
        //判断是否为空
        $isEmpty = true;
        foreach ($k as $key => $value) {
            if ($value != '')
                $isEmpty = false;
        }

        //组织查询语句
        if ($isEmpty)
            return array();

        if ($k['gbclient'] != '') {
            $gbc_str0 = '(select cid from client where cname like "%' . $k['gbclient'] .
                '%") as t1 ,';
            $gbc_str1 = ' and t1.cid = t3.gbclient ';
        } else {
            $gbc_str0 = '';
            $gbc_str1 = '';
        }
        if ($k['gpclient'] != '') {
            $gpc_str0 = '(select cid from client where cname like "%' . $k['gpclient'] .
                '%") as t2 ,';
            $gpc_str1 = ' and t2.cid = t3.gpclient ';
        } else {
            $gpc_str0 = '';
            $gpc_str1 = '';
        }

        $q = 'select gid,gname,gbclient,gpclient,gtype,ghalfhour from ' . $gbc_str0 . $gpc_str0 .
            ' client_company as t3 where 1=1 ';
        $q = $q . $gbc_str1 . $gpc_str1;
        if ($k['gname'] != '')
            $q = $q . ' and gname like "%' . $k['gname'] . '%"';
        if ($k['gtype'] != '')
            $q = $q . ' and gtype="' . $k['gtype'] . '"';
        if ($k['gintroduction'] != '')
            $q = $q . ' and gintroduction like "%' . $k['gintroduction'] . '%"';
        if ($k['gremark'] != '')
            $q = $q . ' and gremark like "%' . $k['gremark'] . '%"';
        $q = $q . ' limit ' . ($pageNow - 1) * $pageSize . ',' . $pageSize;

        //return $q;
        //执行查询语句
        $gids = $this->db->query($q);
        if ($gids->num_rows() <= 0)
            return array();
        $i = 0;
        //获取联系人姓名
        foreach ($gids->result_array() as $row) {
            foreach ($row as $k => $v) {
                if ($k == 'gbclient' || $k == 'gpclient')
                    $re[$k] = $this->getClientName($v);
                else
                    $re[$k] = $v;
            }
            $re_back[$i] = $re;
            $i++;
        }
        return $re_back;

    }
    //获取简单搜索总结果
    function getResultNumberForSimple($keyword)
    {
        $this->db->select('gid');
        $this->db->like('gname', $keyword);
        $this->db->or_like('gtype', $keyword);
        $this->db->or_like('gremark', $keyword);
        $this->db->or_like('gintroduction', $keyword);
        $re = $this->db->get('client_company');
        return $re->num_rows();
    }
    //简单搜索客户
    function searchGuestSimple($keyword, $pageNow, $pageSize)
    {
        $this->db->like('gname', $keyword);
        $this->db->or_like('gtype', $keyword);
        $this->db->or_like('gremark', $keyword);
        $this->db->or_like('gintroduction', $keyword);
        $comps = $this->db->get('client_company', $pageSize, ($pageNow - 1) * $pageSize);
        if ($comps->num_rows() <= 0)
            return array();
        $i = 0;
        //获取联系人姓名
        foreach ($comps->result_array() as $row) {
            foreach ($row as $k => $v) {
                if ($k == 'gbclient' || $k == 'gpclient')
                    $re[$k] = $this->getClientName($v);
                else
                    $re[$k] = $v;
            }
            $re_back[$i] = $re;
            $i++;
        }
        return $re_back;

    }
    //保存客户与项目
    function addProjectToGuest($piid, $cid)
    {
        //先判断是否已经关联了
        $isHave = $this->db->get_where('project_client', array('piid' => $piid));
        if ($isHave->num_rows() > 0)
            return false;
        $this->db->insert('project_client', array('piid' => $piid, 'gid' => $cid));
        if ($this->db->affected_rows() > 0)
            return true;
        return false;
    }
    //修改信息,一定不要忘记写表名，容易导致ajax出错
    function alterInfo($v, $cid)
    {

        $this->db->where('cid', $cid);
        $this->db->update('client', $v);
        if ($this->db->affected_rows() > 0)
            return true;
        return false;
    }
    //获取客户参与的项目名称,格式为p[项目名]=项目ID
    function getProjectJoined($cid)
    {
        $this->db->where('gid', $cid);
        $re = $this->db->get('project_client');
        if ($re->num_rows() > 0) {
            foreach ($re->result() as $row) {
                $pid = $row->piid;
                $this->db->select('pname');
                $this->db->where('piid', $pid);
                $re_p = $this->db->get('project_info');
                if ($re_p->num_rows() > 0) {
                    $p[$re_p->row()->pname] = $pid;
                }
            }
            return $p;
        }
        return array();
    }
    //获取客户公司的信息,返回公司信息数组
    public function getCompanyInfo($gid)
    {
        $this->db->where('gid', $gid);
        $re = $this->db->get('client_company');
        if ($re->num_rows() <= 0)
            return array();
        return $re->row_array();

    }
    //返回客户的基本信息，保存在数组中
    function getGuestBasicInfo($cid)
    {
        $this->db->where('cid', $cid);
        $re = $this->db->get('client');
        if ($re->num_rows() > 0)
            return $re->row_array();
        return array();
    }
    //g获取所有联系人姓名，第1、2项是必填的支付/付款联系人
    function getAllCnntName($gid)
    {
        $this->db->select('gbclient,gpclient');
        $this->db->where('gid',$gid);
        $re0=$this->db->get('client_company');
        if($re0->num_rows()<=0)
            return array();
        $row0=$re0->row_array();
        $data_back[$row0['gbclient']] = $this->getClientPersonName($row0['gbclient']);
        $data_back[$row0['gpclient']] = $this->getClientPersonName($row0['gpclient']);
        $this->db->select('cid');
        $this->db->where('gid', $gid);
        $re = $this->db->get('client_other');
        if ($re->num_rows() > 0) {
            foreach ($re->result_array() as $row) {
                $data_back[$row['cid']] = $this->getClientPersonName($row['cid']);
            }
        }
        return $data_back;
    }
    //获取所有其他联系人
    function getAllCnnt($gid)
    {
        $this->db->select('cid');
        $this->db->where('gid', $gid);
        $re = $this->db->get('client_other');
        if ($re->num_rows() <= 0)
            return array();
        $count = 0;
        foreach ($re->result_array() as $row) {
            $data_back[$count] = $this->getGuestBasicInfo($row['cid']);
            $count++;
        }
        return $data_back;
    }
    //添加一个其他联系人
    function addCnnt($gid, $vc)
    {
        $this->db->insert($this->table_name, $vc);
        $vc_id = $this->db->insert_id();
        $temp = array('gid' => $gid, 'cid' => $vc_id);
        $this->db->insert('client_other', $temp);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        return false;
    }
    //添加一个客户
    function addGuest($v, $vc, $vp)
    {
        $this->db->insert($this->table_name, $vc);
        $vc_id = $this->db->insert_id();
        $this->db->insert($this->table_name, $vp);
        $vp_id = $this->db->insert_id();
        if ($vp_id <= 0 || $vc_id <= 0)
            return 0;
        $v['gbclient'] = $vc_id;
        $v['gpclient'] = $vp_id;
        $this->db->insert('client_company', $v);
        return $this->db->insert_id();
    }
    function getTotalNumbers()
    {
        return $this->db->count_all_results('client_company');
    }
    //获取客户公司名称
    function getClientName($cid)
    {
        $this->db->select('gname');
        $this->db->where('gid', $cid);
        $cnames = $this->db->get('client_company');
        if ($cnames->num_rows() > 0) {
            return $cnames->row()->gname;
        } else
            return 'Unknown';
    }
    //获取客户联系人名称
    function getClientPersonName($cid)
    {
        $this->db->select('cname');
        $this->db->where('cid', $cid);
        $cnames = $this->db->get('client');
        if ($cnames->num_rows() > 0) {
            return $cnames->row()->cname;
        } else
            return 'Unknown';
    }
    //获取客户公司的主要信息
    function getGuestInfo($limit, $offset)
    {
        $this->db->select('gid,gname,gtype,gbclient,gpclient');
        $comps = $this->db->get('client_company', $limit, $offset);
        if ($comps->num_rows() <= 0)
            return array();

        $i = 0;
        //获取联系人姓名
        foreach ($comps->result_array() as $row) {
            foreach ($row as $k => $v) {
                if ($k == 'gbclient' || $k == 'gpclient')
                    $re[$k] = $this->getClientPersonName($v);
                else
                    $re[$k] = $v;
            }
            $re_back[$i] = $re;
            $i++;
        }
        return $re_back;

    }

}
?>