<?php
class Expert_model extends CI_Model
{
    private $table_name = '';
    function __construct()
    {
        parent::__construct();
        $this->table_name = 'expert_info';
        $this->load->database();
    }
    public function addComment($v)
    {
        $this->db->insert('expert_comments', $v);
        if ($this->db->affected_rows() > 0)
            return true;
        return false;

    }
    public function alterCmt($cmtid,$ctnt,$qstn=""){
        $this->db->where('cmtid',$cmtid);
        $this->db->update('expert_comments',array('ecomment'=>$ctnt,'eproblem'=>$qstn));
        if($this->db->affected_rows() > 0)
            return true;
        return false;
    }
    //删除工作经历
    function delWorkExp($expid){
        $this->db->trans_begin();
        $this->db->delete('work_exp', array('expid' => $expid));
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    //删除评论
    function delCmmt($cmtid,$pjtid='0',$eid='0'){
        $this->db->trans_begin();
        
        
        if($pjtid!='0' && $eid!='0'){//如果是查看项目顾问界面的删除评论操作
            $this->db->where(array('piid'=>$pjtid,'eid'=>$eid));
            $this->db->update('expert_choosed',array('comment'=>'0'));
        }else{//如果是顾问界面的删除评论操作
            $this->db->where(array('comment'=>$cmtid));
            $this->db->update('expert_choosed',array('comment'=>'0'));
        }
        $this->db->delete('expert_comments', array('cmtid' => $cmtid));
        
        
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    //删除专家
    function delExpt($eid)
    {
        //删除顾问，需要删除的信息：expert_info/money_cost/work_exp/expert_choosed/expert_comments
        $this->db->trans_begin();
        $this->db->delete('expert_comments', array('eid' => $eid));
        $this->db->delete('expert_choosed', array('eid' => $eid));
        $this->db->delete('money_cost', array('eid' => $eid));
        $this->db->delete('work_exp', array('eid' => $eid));
        $this->db->delete('expert_info', array('eid' => $eid));
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }


    }
    //添加图片名称
    function savePic($id, $pic)
    {
        $this->db->where('eid', $id);
        $this->db->update('expert_info', array('ephoto' => $pic));
    }
    //获取顾问的评论
    public function getComtOfExpert($eid)
    {
        $this->db->where('eid', $eid);
        $re = $this->db->get('expert_comments');
        if ($re->num_rows() > 0) {
            return $re->result_array();
        }
        return array();
    }
    public function getResultNumberForComplicate($k, $uid = 0)
    {
        if ($k['ename'] == "" && $k['esex'] == "" && $k['etrade'] == "" && $k['esubtrade'] ==
            "" && $k['elocation'] == "")
            $st = 1;
        else
            if ($k['company'] == "" && $k['agency'] == "" && $k['position'] == "" && $k['duty'] ==
                "" && $k['area'] == "")
                $st = 2;
            else
                $st = 3;

        $q1 = "select distinct eid from work_exp where 1=1 ";
        if (!empty($k['company']))
            $q1 = $q1 . "and company like '%" . $k['company'] . "%' ";
        if ($k['agency'] != "")
            $q1 = $q1 . "and agency like '%" . $k['agency'] . "%' ";
        if ($k['position'] != "")
            $q1 = $q1 . "and position like '%" . $k['position'] . "%' ";
        if ($k['duty'] != "")
            $q1 = $q1 . "and duty like '%" . $k['duty'] . "%' ";
        if ($k['area'] != "")
            $q1 = $q1 . "and area like '%" . $k['area'] . "%' ";


        $q2 = "select eid from expert_info where 1=1 ";
        if ($k['ename'] != "")
            $q2 = $q2 . "and ename like '%" . $k['ename'] . "%' ";
        if ($k['esex'] != "")
            $q2 = $q2 . "and esex='" . $k['esex'] . "' ";
        if ($k['etrade'] != "")
            $q2 = $q2 . "and etrade='" . $k['etrade'] . "' ";
        if ($k['esubtrade'] != "")
            $q2 = $q2 . "and esubtrade='" . $k['esubtrade'] . "' ";
        if ($k['elocation'] != "")
            $q2 = $q2 . "and elocation like '%" . $k['elocation'] . "%' ";
        if ($st == 1) {
            $query = $q1;
        } elseif ($st == 2) {
            $query = $q2;
        } else {
            $query = "select s2.eid as eid from ";
            $query = $query . "(" . $q1 . ") as s1 ,expert_info as s2 where s1.eid=s2.eid ";
            if ($k['ename'] != "")
                $query = $query . "and s2.ename like '%" . $k['ename'] . "%' ";
            if ($k['esex'] != "")
                $query = $query . "and s2.esex='" . $k['esex'] . "' ";
            if ($k['etrade'] != "")
                $query = $query . "and s2.etrade='" . $k['etrade'] . "' ";
            if ($k['esubtrade'] != "")
                $query = $query . "and s2.esubtrade='" . $k['esubtrade'] . "' ";
            if ($k['elocation'] != "")
                $query = $query . "and s2.elocation like '%" . $k['elocation'] . "%' ";
        }
        if ($uid != 0)
            $query = $query . ' and admin_id = ' . $uid . ' ';

        $re = $this->db->query($query);
        return $re->num_rows();
    }
    public function getResultNumberForSimple($keyword, $uid = 0)
    {
        $query = "select eid from expert_info where (ename like '%" . $keyword .
            "%' or etrade like '%" . $keyword . "%' or esubtrade like '%" . $keyword .
            "%' or elocation like '%" . $keyword . "%') ";
        if ($uid != 0)
            $query = $query . ' and admin_id = ' . $uid . ' ';
        $re = $this->db->query($query);
        return $re->num_rows();
    }
    //高级搜索专家
    public function searchExpertComplicate($k, $page, $page_size, $uid = 0,$statu="0",$haveEmail=false)
    {
        if ($k['ename'] == "" && $k['esex'] == "" && $k['etrade'] == "" && $k['esubtrade'] ==
            "" && $k['elocation'] == "")
            $st = 1;
        else
            if ($k['company'] == "" && $k['agency'] == "" && $k['position'] == "" && $k['duty'] ==
                "" && $k['area'] == "")
                $st = 2;
            else
                $st = 3;

        $q1 = "select distinct eid from work_exp where 1=1 ";
        if (!empty($k['company']))
            $q1 = $q1 . "and company like '%" . $k['company'] . "%' ";
        if ($k['agency'] != "")
            $q1 = $q1 . "and agency like '%" . $k['agency'] . "%' ";
        if ($k['position'] != "")
            $q1 = $q1 . "and position like '%" . $k['position'] . "%' ";
        if ($k['duty'] != "")
            $q1 = $q1 . "and duty like '%" . $k['duty'] . "%' ";
        if ($k['area'] != "")
            $q1 = $q1 . "and area like '%" . $k['area'] . "%' ";


        $q2 = "select eid from expert_info where 1=1 ";
        if ($k['ename'] != "")
            $q2 = $q2 . "and ename like '%" . $k['ename'] . "%' ";
        if ($k['esex'] != "")
            $q2 = $q2 . "and esex='" . $k['esex'] . "' ";
        if ($k['etrade'] != "")
            $q2 = $q2 . "and etrade like '%" . $k['etrade'] . "%' ";
        if ($k['esubtrade'] != "")
            $q2 = $q2 . "and esubtrade like '%" . $k['esubtrade'] . "%' ";
        if ($k['elocation'] != "")
            $q2 = $q2 . "and elocation like '%" . $k['elocation'] . "%' ";
        if ($st == 1) {
            $query = $q1;
        } elseif ($st == 2) {
            $query = $q2;
        } else {
            $query = "select s2.eid as eid from ";
            $query = $query . "(" . $q1 . ") as s1 ,expert_info as s2 where s1.eid=s2.eid ";
            if ($k['ename'] != "")
                $query = $query . "and s2.ename like '%" . $k['ename'] . "%' ";
            if ($k['esex'] != "")
                $query = $query . "and s2.esex='" . $k['esex'] . "' ";
            if ($k['etrade'] != "")
                $query = $query . "and s2.etrade='" . $k['etrade'] . "' ";
            if ($k['esubtrade'] != "")
                $query = $query . "and s2.esubtrade='" . $k['esubtrade'] . "' ";
            if ($k['elocation'] != "")
                $query = $query . "and s2.elocation like '%" . $k['elocation'] . "%' ";
        }

        if ($uid != 0)
            $query = $query . ' and admin_id = ' . $uid . ' ';
            
        if($statu=="1")
            $query .=' and estate=3 ';
        else if($statu=='2')
            $query .=' and estate!=3 ';

        $query = $query . " limit " . ($page - 1) * $page_size . "," . $page_size;
//        $this->saveLog($query);
        $re = $this->db->query($query);
        if ($re->num_rows() <= 0)
            return array();
        $counter = 0;
        foreach ($re->result() as $row) {
            $eid = $row->eid;
            $p[$counter] = $this->getMainInfo($eid,$haveEmail);
            $counter++;
        }
        return $p;
    }
    //搜索专家,返回的是专家的二维数组
    public function searchExpertSimple($keyword, $page, $page_size, $uid = 0)
    {
        if ($uid != 0) {
            $q1_more = 'and admin_id=' . $uid;
            $q2_more = "and eid in (select eid from expert_info where admin_id=" . $uid .
                ")";
        } else {
            $q1_more = '';
            $q2_more = '';
        }


        //搜索符合表expert_info的eid
        $q1 = "select eid from expert_info where (ename like '%" . $keyword .
            "%' or etrade like '%" . $keyword . "%' or esubtrade like '%" . $keyword .
            "%' or elocation like '%" . $keyword . "%') " . $q1_more;
        //搜索符合表work_exp的eid
        $q2 = "select eid from work_exp where (position like '%" . $keyword .
            "%' or company like '%" . $keyword . "%' or agency like '%" . $keyword . "%' " .
            " or duty like '%" . $keyword . "%' or area like '%" . $keyword . "%') " . $q2_more;

        $query = $q1 . ' union ' . $q2 . " limit " . ($page - 1) * $page_size . "," . $page_size;

        $re = $this->db->query($query); //获取结果对象集
        if ($re->num_rows() <= 0)
            return array();
        $counter = 0;
        foreach ($re->result() as $row) {
            $eid = $row->eid;
            $p[$counter] = $this->getMainInfo($eid);
            $counter++;
        }
        return $p;

    }
    //增加收费经历
    public function addMoneyCost($eid, $v)
    {
        foreach ($v as $key => $value) {
            if ($value != '') {
                $p[$key] = $value;
            }
        }
        $p['eid'] = $eid;
        $this->db->insert('money_cost', $p);
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    //修改收费经历
    public function alterMoneyCost($eid, $v)
    {
        $isEmpty = true;
        foreach ($v as $key => $value) {
            if ($value != '') {
                $isEmpty = false;
                $p[$key] = $value;
            }
        }
        if ($isEmpty)
            return false;
        $this->db->where('eid', $eid);
        $this->db->update('money_cost', $p);
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    //判断是否有收费经历
    public function isHaveMoneyCost($eid)
    {
        $this->db->where('eid', $eid);
        $r = $this->db->get('money_cost');
        if ($r->num_rows() > 0)
            return true;
        else
            return false;
    }

    //判断是否拥有该顾问
    public function isOwned($eid, $uid)
    {
        $this->db->select('admin_id');
        $this->db->where('eid', $eid);
        $re = $this->db->get('expert_info');
        if ($re->num_rows() <= 0)
            return false;
        $true_id = $re->row()->admin_id;
        if (trim($uid) == trim($true_id))
            return true;
        return false;

    }
    //修改工作经历
    //出错经历：猜测是update之间用and连接出错了
    public function alterWorkExp($id, $v)
    {
        /*
        $num = 0;
        //过滤掉空项，防止数据抹除
        foreach ($v as $key => $value) {
        if (!empty($value)) {
        $num++;//记录有多少个变量
        $p[$key] = $value;
        }
        }
        if ($num==0)
        return false;
        
        //生成更新语句
        $q='update work_exp set ';
        $count=0;
        foreach($p as $k1=>$v1){
        $count++;
        //如果读到最后一个了
        if($count==$num){
        //就不要在末尾加逗号了，并补全表达式
        $q=$q.' '.$k1.'='."'".$v1."' where expid=".$id;
        }else{
        //要在末尾加逗号
        $q=$q.' '.$k1.'='."'".$v1."',";
        }
        
        }
        //return $q;
        $this->db->query($q);
        if ($this->db->affected_rows() > 0)
        return true;
        else
        return false;*/
        $isempty = true;
        //过滤掉空项，防止数据抹除
        foreach ($v as $key => $value) {
            if (!empty($value)) {
                $isempty = false;
                $p[$key] = $value;
            }
        }
        if ($isempty)
            return false;
        $this->db->where('expid', $id);
        $this->db->update('work_exp', $p);
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    //修改专家信息
    public function alterBasicInfo($eid, $v)
    {
        $isempty = true;
        //过滤掉空项，防止数据抹除
        foreach ($v as $key => $value) {
            if (!empty($value)) {
                $isempty = false;
                $p[$key] = $value;
            }
        }
        if ($isempty)
            return false;
        $this->db->where('eid', $eid);
        $this->db->update('expert_info', $p);
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    //获取专家的工作经验，二维数组
    public function getExpertWrokExps($eid)
    {
        $this->db->where('eid', $eid);
        $r = $this->db->get('work_exp');
        if ($r->num_rows() > 0) {
            //遍历每一个工作经验
            $counter = 0;
            foreach ($r->result_array() as $exp_array) {
                /* $p[$counter] = array(
                'etime' => $exp_array['etime'],
                'stime' => $exp_array['stime'],
                'company' => $exp_array['company'],
                'agency' => $exp_array['agency'],
                'position' => $exp_array['position'],
                'duty' => $exp_array['duty'],
                'area' => $exp_array['area'],
                'istonow' => $exp_array['istonow']);*/
                $p[$counter] = $exp_array;
                $counter++;
            }
            return $p;

        }
        return array();
    }
    //获取专家参与的项目id及名称，二维数组
    public function getProjectJoined($eid)
    {
        $this->db->select('piid');
        $this->db->where('eid', $eid);
        $re = $this->db->get('expert_choosed');
        if ($re->num_rows() <= 0)
            return array();
        $counter = 0;
        //遍历获取所有项目的id
        foreach ($re->result_array() as $row) {
            $piid = $row['piid'];
            //获取项目名
            $this->db->select('pname');
            $this->db->where('piid', $row['piid']);
            $re1 = $this->db->get('project_info');
            if ($re1->num_rows() > 0) {
                $pname = $re1->row()->pname;
            } else
                $pname = '信息丢失';
            $p[$counter] = array('piid' => $piid, 'pname' => $pname);
            $counter++;
        }
        return $p;

    }
    //获取专家的详细信息，包括介绍以及收费标准
    public function getExpertDetail($eid)
    {
        $this->db->where('eid', $eid);
        $r1 = $this->db->get('expert_info');
        //只有一条结果，使用row获取结果并展开
        if ($r1->num_rows() > 0) {
            foreach ($r1->row_array() as $k => $v) {
                $p[$k] = $v;
            }
            $this->db->where('eid', $eid);
            $r2 = $this->db->get('money_cost');
            //有收费信息则数组包含索引，没有则返回空数组
            if ($r2->num_rows() > 0) {
                foreach ($r2->row_array() as $k => $v) {
                    $p[$k] = $v;
                }

            }
        }
        return $p;
    }
    //保存工作经验
    public function saveWorkExp($v)
    {
        $this->db->insert('work_exp', $v);
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    //保存收费标准
    public function saveExpertMoneyCost($v)
    {
        $this->db->insert('money_cost', $v);
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    //保存一个专家
    public function saveAnExpert($v)
    {

        foreach ($v as $key => $value) {
            if (!empty($value))
                $v_new[$key] = $value;
        }
        $this->db->insert('expert_info', $v_new);
        $id= $this->db->insert_id();
        $q="update expert_info set addtime=now() where eid=".$id;
        $this->db->query($q);
        return $id;
    }
    //获取专家总数
    public function getTotalExperts($uid = 0)
    {
        if ($uid == 0)
            return $this->db->count_all_results('expert_info');
        else {
            $this->db->where('admin_id', $uid);
            $this->db->from('expert_info');
            return $this->db->count_all_results();
        }
    }
    //获取指定专家姓名
    public function getExpertName($eid)
    {
        $this->db->select('ename');
        $this->db->where('eid', $eid);
        $r = $this->db->get($this->table_name);
        $enames = $r->result();
        if (!empty($enames)) {
            foreach ($enames as $es) {
                return $es->ename;
            }
        } else
            return '未知';
    }

    //返回的是主页的专家信息，由二维数组保存
    public function getExpertInfo($pageSize, $offset, $uid = 0,$haveEmail=false)
    {
        if ($uid != 0)
            $this->db->where('admin_id', $uid);
        $this->db->select('eid');
        $this->db->order_by("eid", "desc"); 
        $this->db->limit($pageSize, $offset);
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            $counter = 0;
            foreach ($r->result() as $row) {
                $a = $this->getMainInfo($row->eid,$haveEmail);
                //如果返回的不是空数组
                if (!empty($a)) //将返回的数组信息保存在b数组中

                    $b[$counter] = $a;
                $counter++;
            }
            return $b;
        } else //若没有结果则返回空的数组

            return array();
    }
    //私有成员，内部调用，可以预见传入的eid均是有资料的
    private function getMainInfo($eid,$haveEmail=false)
    {

        $this->db->select('ename,estate,eemail');
        $this->db->where('eid', $eid);
        $re = $this->db->get($this->table_name);
        if ($re->num_rows() <= 0) {
            return array();
        }
        //取得第一条查询结果
        $row = $re->row();
        $a[0] = $eid;
        $a[1] = $row->ename;
        $email=$row->eemail;
        if ($row->estate == '1')
            $a[2] = '已获得联系方式';
        else
            if ($row->estate == '2')
                $a[2] = '聘用';
            else
                $a[2] = '已合作';

        $this->db->select('company,agency,position');
        $this->db->where(array('istonow' => 1, 'eid' => $eid));

        //这里使用了表名work_exp
        $re1 = $this->db->get('work_exp');
        //能找到相应的工作经历
        if ($re1->num_rows() > 0) {
            //有结果，选第一个
            $row1 = $re1->row_array();
            $a[3] = $row1['company'];
            $a[4] = $row1['agency'];
            $a[5] = $row1['position'];

        } else {
            //没有结果，选出最近的一个
            $this->db->select('company,agency,position');
            $this->db->where('eid', $eid);
            $this->db->order_by('etime', 'desc');
            $re2 = $this->db->get('work_exp');
            if ($re2->num_rows() <= 0) { //工作经历都没有
                $a[3] = 'NULL';
                $a[4] = 'NULL';
                $a[5] = 'NULL';
            } else {
                $row2 = $re2->row();
                $a[3] = $row2->company;
                $a[4] = $row2->agency;
                $a[5] = $row2->position;

            }
        }
        //取得收费标准
        $this->db->select('astandard,alevel');
        $this->db->where('eid', $eid);
        $re3 = $this->db->get('money_cost');
        if ($re3->num_rows() <= 0) {
            $a[6] = 'NULL';
            $a[7] = "NULL";
        } else {
            $row3 = $re3->row();
            $a[6] = $row3->astandard;
            $a[7] = $row3->alevel;
        }
        if($haveEmail)
            $a[8]=$email;
        return $a;
    }
    function getCurWork($eid)
    {
        $this->db->where(array('istonow' => 1, 'eid' => $eid));
        //这里使用了表名work_exp
        $re1 = $this->db->get('work_exp');
        //能找到相应的工作经历
        if ($re1->num_rows() > 0) {
            //有结果，选第一个
            return $re1->row_array();
        } else {
            //没有结果，选出最近的一个
            $this->db->where('eid', $eid);
            $this->db->order_by('etime', 'desc');
            $re2 = $this->db->get('work_exp');
            if ($re2->num_rows() <= 0) { //工作经历都没有
                return array();
            } else {
                return $re2->row_array();
            }
        }
    }
    function saveLog($log){
        $v["log"]=$log;
        $this->db->insert("mylog",$v);
    }
}

?>