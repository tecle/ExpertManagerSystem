<?php
class User_info extends CI_Model
{
    private $table_name;
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table_name='worker_info';
    }
    function isLogin($name,$pw){
        $this->db->select('wid,wname,wrole');
        $this->db->where(array('waccount'=>$name,'wpassword'=>$pw));
        $re=$this->db->get($this->table_name);
        if($re->num_rows()>0)
            return $re->row_array();
        return array();
    }
    function getWorkerInfo($limit, $offset)
    {
        $names = $this->db->get($this->table_name, $limit, $offset);

        return $names->result();

    }
    function getTotalNumbers()
    {
        return $this->db->count_all_results('worker_info');
    }
    function checkIsRepeat($waccount)
    {
        $this->db->where('waccount',$waccount);
        $query = $this->db->get($this->table_name);      
        $r=$query->result();
        if (!empty($r))
            return true;
        else
            return false;
    }
    function addWorker($info)
    {
        if ($this->db->insert('worker_info', $info)>0)
            return true;
        else 
            return false;
        
    }
    
    function alterInfo($a,$id){
        $this->db->where('wid',$id);
        if($this->db->update('worker_info',$a)>0)
            return true;
        else
            return false;
    }
    
    function deleteWorker($wid){
        if($this->db->delete('worker_info',array('wid'=>$wid))>0)
            return true;
        else 
            return false;
    }

}
?>