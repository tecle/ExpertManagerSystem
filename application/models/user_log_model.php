<?php
class User_log_model extends CI_Model
{
    private $table_name = '';
    function __construct()
    {
        parent::__construct();
        $this->table_name = 'op_log';
        $this->load->database();
    }
    function getLogs($pageNow, $pageSize)
    {
        $this->db->order_by('optime', 'desc');
        $q = $this->db->get($this->table_name, $pageSize, ($pageNow - 1) * $pageSize);
        //返回结果的对象集合
        return $q->result();
    }
    function getTotalLogs()
    {
        return $this->db->count_all_results($this->table_name);
    }
    //传入的code
    function getLogByType($code,$pageNow,$pageSize){
        $this->db->where('opcode',$code);
        $this->db->order_by('optime', 'desc');
        $q = $this->db->get($this->table_name, $pageSize, ($pageNow - 1) * $pageSize);
        //返回结果的对象集合
        return $q->result();
    }
    //删除区间为[$start,$end]的日志记录
    function deleteLog($start, $end)
    {
        //先查看区间有没有记录，没有返回成功
        $q_check = 'select optime from op_log where optime >"' . $start .
            '" and optime < "' . $end.'"';
        $re = $this->db->query($q_check);
        if ($re->num_rows() <= 0)
            return true;
        $q = 'delete from op_log where optime >"' . $start . '" and optime < "' . $end.'"';
        $this->db->query($q);
        if ($this->db->affected_rows() > 0)
            return true;
        return false;
    }
    //查看指定区间的日志记录
}
?>