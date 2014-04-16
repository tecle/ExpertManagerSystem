<?php
class Project_model extends CI_Model
{
    private $table_name = '';
    
    public function getAllNewExperts($st,$et,$ps,$pn){
        $c1=($st!="")?(" addtime >= '".$st."'"):("1=1");
        $c2=($et!="")?(" addtime <= '".$et."'"):("1=1");
        $q1="select t1.eid,t1.ename,t1.ecomefrom,t1.ephoto,t1.emobile,t1.admin_id,t1.addtime,t2.alevel 
            from (expert_info as t1 left outer join money_cost as t2 on t1.eid=t2.eid) 
                where t1.addtime is not null and ".$c1." and ".$c2." limit ".($pn-1)*$ps.",".$ps;
        $re=$this->db->query($q1);
        $count=0;
        $rd=array();
        if($re->num_rows()>0){
            foreach($re->result_array() as $row){
                $ta=$row;
                $q2="select company from work_exp where eid=".$ta['eid']." and istonow=1";
                $re1=$this->db->query($q2);
                if($re1->num_rows()>0){
                    $ta['company']=$re1->row()->company;
                }
                else{
                    $ta['company']="";
                }
                $q3="select wname from worker_info where wid=".$ta['admin_id'];
                $re2=$this->db->query($q3);
                if($re2->num_rows()>0){
                    $ta['pic']=$re2->row()->wname;
                }
                else{
                    $ta['pic']="";
                }
                $rd[$count]=$ta;
                $count++;
            }
        }
        return $rd;
    }
    
    public function getAllMeets($filter,$pagesize,$pagenow){
        if(!isset($filter['st']) || $filter['st']==""){
            $cnd1=" 1=1 ";
        }else{
            $cnd1=" starttime >= '".$filter['st']."' ";
        }
        if(!isset($filter['et']) || $filter['et']==""){
            $cnd2=" 1=1 ";
        }else{
            $cnd2=" endtime <= '".$filter['et']."' ";
        }
        if(!isset($filter['guest']) || $filter['guest']==""){
            $cnd3=" 1=1 ";
        }else{
            $cnd3=" gname = '".$filter['guest']."' ";
        }
        if(!isset($filter['project']) || $filter['project']==""){
            $cnd4=" 1=1 ";
        }else{
            $cnd4=" pcode = '".$filter['project']."' ";
        }
        $q1="select t7.*,t8.* from ((select t5.*,t6.gname 
                    from((select t3.*,t4.gid as tgid 
                            from ((select t1.eid,t1.piid,t1.aiid as taiid,t1.cost,t1.epicharge,t1.remark,t1.starttime,t1.service,t1.totaltime,t1.avgs,t2.pcode 
                                    from(expert_choosed as t1 inner join project_info as t2 on t1.piid = t2.piid) 
                                    where ".$cnd1." and ".$cnd2." and ".$cnd4.") as t3 
                                left outer join project_client as t4 on t3.piid=t4.piid))as t5
                            left outer join client_company as t6 on  t5.tgid = t6.gid)
                        where ".$cnd3.") as t7
                        left outer join 
                            acnt_info as t8 on t7.taiid=t8.aiid) order by t7.piid 
                            limit ".($pagenow-1)*$pagesize.",".$pagesize;
       // echo $q1."<br />";
        $re=$this->db->query($q1);
        $count=0;
        $rtdt=array();
        if($re->num_rows()>0){
            foreach ($re->result_array() as $row) {
                $ta=$row;
                $itime = explode(" ",$ta['starttime']);
                $ta['itime'] = $itime[0];
                $q2="select t1.ename,t1.ecomefrom,t1.ephoto,t1.emobile,t2.* 
                        from (expert_info as t1 left outer join money_cost as t2 on t1.eid=t2.eid) 
                            where t1.eid=".$ta['eid'];
                //echo $q2."<br />";
                $re1=$this->db->query($q2);
                if($re1->num_rows()>0){
                    foreach($re1->row_array() as $k => $v)
                        $ta[$k]=$v;
                }
                $q3="select company from work_exp where eid=".$ta['eid']." and istonow=1 ";
               //echo $q3."<br />";
                $re2=$this->db->query($q3);
                if($re2->num_rows()>0){
                    $ta['company']=$re2->row()->company;
                }
                else{
                    $ta['company']="";
                }
                $q4="select wname from worker_info where wid=".$ta['epicharge'];
                $re3=$this->db->query($q4);
                if($re3->num_rows()>0){
                    $ta['pic']=$re3->row()->wname;
                }
                else{
                    $ta['pic']="";
                }
                $rtdt[$count]=$ta;
                $count++;
            }
            
        }
        return $rtdt;
        
    }
    
    function __construct()
    {
        parent::__construct();
        $this->table_name = 'project_info';
        $this->load->database();
    }
    function getProjectName($pid)
    {
        $this->db->select('pname');
        $this->db->where('piid', $pid);
        $result = $this->db->get($this->table_name);
        $pnames = $result->result();
        if (!empty($pnames)) {
            foreach ($pnames as $ps) {
                return $ps->pname;
            }
        } else
            return '未知';
    }
    //删除一个客户
    public function delProGuest($piid){
        $this->db->trans_begin();
        $this->db->delete('project_client',array('piid'=>$piid));
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    //删除一个合作顾问
    public function delCnst($ecid){
        $this->db->trans_begin();
        $this->db->delete('expert_choosed',array('ecid'=>$ecid));
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
    //删除一个项目
    public function delPrjt($piid){
        //删除project_info/project_detail/project_client/expert_choosed
        $this->db->trans_begin();
        $this->db->delete('project_client', array('piid' => $piid));
        $this->db->delete('expert_choosed', array('piid' => $piid));
        $this->db->delete('project_detail', array('piid' => $piid));
        $this->db->delete('project_info', array('piid' => $piid));
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }

    }
    //项目的简单搜索，已排错
    public function searchProjectSimple($keyword, $page, $page_size)
    {

        $query = "select pi.piid as piid from project_info as pi,project_detail as pd 
        where pi.piid=pd.piid 
        and( pname like '%" . $keyword . "%' or pem like '%" . $keyword .
            "%' or pcode like '%" . $keyword . "%'  or pediscribe like '%".$keyword."%') 
            order by createtime desc limit " . ($page - 1) * $page_size . "," . $page_size;
        $re = $this->db->query($query); //获取结果对象集
        if ($re->num_rows() <= 0)
            return array();
        $counter = 0;
        foreach ($re->result() as $row) {
            $piid = $row->piid;
            $p[$counter] = $this->getMainInfo($piid);
            $counter++;
        }
        return $p;

    }

    //获取项目的主要信息，已排错
    private function getMainInfo($piid)
    {
        $this->db->select('piid ,pcode,pname,createtime,pem');
        $this->db->where('piid', $piid);
        $r1 = $this->db->get('project_info');
        if ($r1->num_rows() > 0)
            $v = $r1->row_array();
        else
            return array();
        $query="select t1.gid as gid,t2.gname as gname from project_client as t1,client_company as t2 ";
        $query=$query."where t2.gid=t1.gid and t1.piid=".$piid;
        $re = $this->db->query($query); //获取结果对象集
        if ($re->num_rows() <= 0){
            $v['gid']="0";
            $v['gname']="NULL";
        }else{
            $v['gid']=$re->row()->gid;
            $v['gname']=$re->row()->gname;
        }
        return $v;
    }
    //获取查询到的结果数，已排错
    public function getResultNumberForSimple($keyword)
    {
        $query = "select pi.piid as piid from project_info as pi,project_detail as pd 
        where pi.piid=pd.piid 
        and( pname like '%" . $keyword . "%' or pem like '%" . $keyword .
            "%' or pcode like '%" . $keyword . "%'  or pediscribe like '%".$keyword."%') ";
        $re = $this->db->query($query);
        return $re->num_rows();
    }
    //复杂搜索,已排错
    public function searchProjectComplicate($k, $page, $page_size)
    {
        $query = "select s1.piid as piid  
			  from project_info as s1,project_detail as s2 where s1.piid=s2.piid ";

        if ($k['name'] != "")
            $query = $query . "and s1.pname like '%" . $k['name'] . "%' ";
        /* if($k['client']!="")  这里应该等客户信息完成后再使用，
        $query=$query."and pname like '%".."%' "; */
        if ($k['code'] != "")
            $query = $query . "and s1.pcode like '%" . $k['code'] . "%' ";
        if ($k['em'] != "")
            $query = $query . "and s1.pem like '%" . $k['em'] . "%' ";
        if ($k['dailyiquota'] != "")
            $query = $query . "and s2.dailyiquota like '%" . $k['dailyiquota'] . "%' ";
        if ($k['pediscribe'] != "")
            $query = $query . "and s2.pediscribe like '%" . $k['pediscribe'] . "%' ";
        $query = $query . "order by createtime desc limit " . ($page - 1) * $page_size .
            "," . $page_size;
        $re = $this->db->query($query);
        if ($re->num_rows() <= 0)
            return array();
        $counter = 0;
        foreach ($re->result() as $row) {
            $piid = $row->piid;
            $p[$counter] = $this->getMainInfo($piid);
            $counter++;
        }
        return $p;
    }
    //获取复杂查询的结果数，已排错
    public function getResultNumberForComplicate($k)
    {
        $query = "select s1.piid as piid ,pcode,pname,pem,createtime 
			  from project_info as s1,project_detail as s2 where s1.piid=s2.piid ";

        if ($k['name'] != "")
            $query = $query . "and pname like '%" . $k['name'] . "%' ";
        /* if($k['client']!="")  这里应该等客户信息完成后再使用，
        $query=$query."and pname like '%".."%' "; */
        if ($k['code'] != "")
            $query = $query . "and pcode like '%" . $k['code'] . "%' ";
        if ($k['em'] != "")
            $query = $query . "and pem like '%" . $k['em'] . "%' ";
        if ($k['dailyiquota'] != "")
            $query = $query . "and dailyiquota like '%" . $k['dailyiquota'] . "%' ";
        if ($k['pediscribe'] != "")
            $query = $query . "and pediscribe like '%" . $k['pediscribe'] . "%' ";

        $re = $this->db->query($query);
        return $re->num_rows();
    }
    //修改项目的相关信息
    public function alterProject($sign, $piid, $v)
    {
        switch ($sign) {
            case 1:
                $table = 'project_detail';
                break;
            case 2:
                $table = 'project_info';
                break;
        }
        $this->db->where('piid', $piid);
        $this->db->update($table, $v);
        if ($this->db->affected_rows() > 0)
            return true;
        return false;

    }
    //修改项目的收费情况
    public function altProCost($content,$acnt){
            //过滤掉空值
            foreach($content as $k => $v){
                if($v!=""){
                    $cnt_cpy[$k]=$v;
                }
            }
            foreach($acnt as $k => $v){
                if($v==""){
                    unset($acnt[$k]);
                }
            }
            $this->db->where(array('eid'=>$content['eid']));
            $re=$this->db->get('money_cost');
            if($re->num_rows()>0)//如果>0，则表示有对应的账户信息，做更新操作
            {
                $this->db->where(array('ecid'=>$content['ecid']));
                $this->db->update("expert_choosed",$cnt_cpy);
                $this->db->where('eid',$content['eid']);
                $this->db->update("money_cost",$acnt);

            }else{//插入操作
                $acnt['eid']=$content['eid'];
                $this->db->insert('money_cost',$acnt);
                $this->db->where(array('ecid'=>$content['ecid']));
                $this->db->update("expert_choosed",$cnt_cpy);

            }
            return true;
    }
    //修改项目和专家的信息
    public function alterEP($query)
    {
        $this->db->query($query);
        if ($this->db->affected_rows() > 0)
            return true;
        return false;
    }
    //返回的是主页的项目信息，由二维数组保存
    public function getProjectInfo($pageSize, $offset)
    {
        $this->db->select('piid');
        $this->db->order_by('createtime', 'desc');
        $this->db->limit($pageSize, $offset);
        $r = $this->db->get($this->table_name);
        if ($r->num_rows() > 0) {
            $counter = 0;
            foreach ($r->result() as $row) {
                $a = $this->getMainInfo($row->piid);
                //如果返回的不是空数组
                if (!empty($a)) //将返回的数组信息保存在b数组中

                    $b[$counter] = $a;
                $counter++;
            }
            return $b;
        } else //若没有结果则返回空的数组

            return array();
    }

    public function getTotalProjects()
    {
        return $this->db->count_all_results('project_info');
    }
    //增加一个项目基本信息,返回ID
    public function addProjectInfo($pname, $pem, $pcode,$pemcontact)
    {
        $query = "insert into project_info(pname,pem,pcode,createtime,pemcontact) values('" . $pname .
            "','" . $pem . "','" . $pcode . "',now(),'".$pemcontact."')";
        $re = $this->db->query($query);
        return $this->db->insert_id();
    }
    //增加一个项目详细信息，返回是否成功
    public function addProjectDetail($v)
    {
        foreach($v as $k1 => $v1){
            if($v1=="")
                unset($v[$k1]);
        }
        
        $this->db->insert('project_detail', $v);
        if ($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }

    //获取项目的基本信息，返回数组,fixed
    public function getProjectBasicInfo($pid)
    {
        $this->db->where('piid', $pid);
        $r1 = $this->db->get('project_info');
        //只有一条结果，使用row获取结果并展开
        if ($r1->num_rows() > 0) {
            return $r1->row_array();
        }
        return array();
    }
    //获取项目的详细信息，返回数组,fixed
    public function getProjectDetailInfo($pid)
    {
        $this->db->where('piid', $pid);
        $r1 = $this->db->get('project_detail');
        //只有一条结果，使用row获取结果并展开
        if ($r1->num_rows() > 0) {
            return $r1->row_array();
        }
        return array();
    }
    //获取用户的信息，返回二维数组
    public function getAllExpertInfoJoined($pid)
    {
        $this->db->where('piid', $pid);
        $re_expert = $this->db->get('expert_choosed');
        if ($re_expert->num_rows() <= 0)
            return array();
        $counter = 0;
        foreach ($re_expert->result_array() as $row) {
            $this->db->select('ename');
            $this->db->where('eid', $row['eid']);
            $re_ename = $this->db->get('expert_info');
            
            $this->db->select('wname');
            $this->db->where('wid', $row['epicharge']);
            $re_wname = $this->db->get('worker_info');
            
            $this->db->select('ecomment');
            $this->db->where('cmtid', $row['comment']);
            $re_cmt = $this->db->get('expert_comments');
            
            $rows = $row;
            $rows['ename'] = ($re_ename->num_rows()>0)?$re_ename->row()->ename:" ";
            $rows['wname'] = ($re_wname->num_rows()>0)?$re_wname->row()->wname:" ";
            $rows['ucmt'] = ($re_cmt->num_rows()>0)?$re_cmt->row()->ecomment:" ";
            
            $this->db->where('eid',$row['eid']);
            $acnt=$this->db->get("money_cost");
            if($acnt->num_rows()>0){
                foreach($acnt->row_array() as $k=>$v){
                    $rows[$k]=$v;
                }
            }
            $p[$counter] = $rows;
            $counter++;
        }
        return $p;
    }
    //获取该项目的客户名称和ID,fixed
    public function getClientJoined($piid)
    {
        $query = "select s1.gid as cid, gname ,gbclient from (select gid from project_client where piid=" .
            $piid . ") as s1,client_company as s2 where s1.gid=s2.gid;";
        $r1 = $this->db->query($query);
        //只有一条结果，使用row获取结果并展开
        if ($r1->num_rows() > 0) {
            $re=$r1->row_array();
            $this->db->select('cname');
            $this->db->where('cid',$re['gbclient']);
            $name_re=$this->db->get('client');
            if($name_re->num_rows()>0)
                $re['gbcname']=$name_re->row()->cname;
            else
                $re['gbcname']='';
            return $re;
        }
        return array();
    }
    private function getExpertCompany($eid){
        $this->db->select('company');
        $this->db->where(array('istonow' => 1, 'eid' => $eid));

        //这里使用了表名work_exp
        $re1 = $this->db->get('work_exp');
        //能找到相应的工作经历
        if ($re1->num_rows() > 0) {
            //有结果，选第一个
            $row1 = $re1->row_array();
            //返回所在公司名
            return $row1['company'];

        } else {
            //没有结果，选出最近的一个
            $this->db->select('company,agency,position');
            $this->db->where('eid', $eid);
            $this->db->order_by('etime', 'desc');
            $re2 = $this->db->get('work_exp');
            if ($re2->num_rows() <= 0) { //工作经历都没有
                return 'NULL';
            } else {
                $row2 = $re2->row();
                return $row2->company;
            }
        }
    }
    //获取加入该项目的顾问的名字，id，状态,fixed,返回二维数组,元组(eid,ename,state,ecompany)
    public function getExpertJoined($piid)
    {
        $this->db->select('eid,state,ecid,starttime,totaltime');
        $this->db->where('piid', $piid);
        $r = $this->db->get('expert_choosed');
        $counter = 0;
        //如果有专家
        if ($r->num_rows() > 0) {
            //获取所有专家的ID

            foreach ($r->result_array() as $row) {
                $temp_array = array('eid' => $row['eid'], 'state' => $row['state'], 'ecid' => $row['ecid'], 'starttime' => $row['starttime'], 'totaltime' => $row['totaltime']);
                $this->db->select('ename');
                $this->db->where('eid', $row['eid']);
                $r1 = $this->db->get('expert_info');
                $temp_array['ename'] = $r1->row()->ename;
                $temp_array['ecompany'] = $this->getExpertCompany($row['eid']);
                $v[$counter] = $temp_array;
                $counter++;
            }
            return $v;
        }
        return array();
    }
    //为项目增加个顾问
    public function addAnExpert($content,$count=array(),$ucmt="")
    {
        foreach($content as $k => $v){
                if($v==""){
                    unset($content[$k]);
                }
            }
        foreach($count as $k => $v){
                if($v==""){
                    unset($count[$k]);
                }
            }  
            
        $this->db->trans_begin();
        
        if(!empty($count)){
            //如果有该专家的账户信息，则要修改
            $this->db->select('eid');
            $this->db->where('eid', $content['eid']);
            $acnt=$this->db->get("money_cost");
            if($acnt->num_rows()>0){//若存在账户信息，只更新
                $this->db->where('eid', $content['eid']);
                $this->db->update("money_cost",$count);
            }else{//若没有账户信息，则插入
                $count['eid']=$content['eid'];
                $this->db->insert("money_cost",$count);
            }
        }
        $this->db->insert('expert_comments',array('eid'=>$content['eid'],'ecomment'=>$ucmt));
        $content['comment']=$this->db->insert_id();
        $this->db->insert('expert_choosed', $content);
        
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
        if($this->db->affected_rows()>0)
            return true;
        return false;
    }
    
    public function getAdminList()
    {
        $this->db->select('wid,wname');
        $r = $this->db->get('worker_info');
        $rlist = '';
        foreach ($r->result_array() as $row) {
            foreach ($row as $k => $v) {
                $rlist = $rlist.$v.'|';
            }
            
        }
        return $rlist;
    }
    
    public function getClientList($piid)
    {
        $this->db->select('gid');
        $this->db->where('piid', $piid);
        $r = $this->db->get('project_client');
        if ($r->num_rows() > 0){
            $gid = $r->row()->gid;
            $this->db->select('gbclient,gpclient');
            $this->db->where('gid', $gid);
            $r1 = $this->db->get('client_company');
            $clist = '';
            $cid_1 = $r1->row()->gbclient;
            $this->db->select('cname');
            $this->db->where('cid', $cid_1);
            $c1 = $this->db->get('client');
            $cid_2 = $r1->row()->gpclient;
            $this->db->select('cname');
            $this->db->where('cid', $cid_2);
            $c2 = $this->db->get('client');
            $clist = $c1->row()->cname.'|'.$c2->row()->cname;
            return $clist;
        }
        return 'n';
    }
    
    public function getHalfHour($piid)
    {
        $this->db->select('gid');
        $this->db->where('piid', $piid);
        $r = $this->db->get('project_client');
        if ($r->num_rows() > 0){
            $gid = $r->row()->gid;
            $this->db->select('ghalfhour');
            $this->db->where('gid', $gid);
            $r1 = $this->db->get('client_company');
            if($r1->row()->ghalfhour == 'Y')
                return '0.5';
            else 
                return '1';
        }
        return '0.5';
    }
}
?>