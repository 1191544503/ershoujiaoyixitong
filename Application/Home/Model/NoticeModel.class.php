<?php
namespace Home\Model;
use Think\Model;
class NoticeModel extends BaseModel{
    public function  addNotice($data){
        if($this->data($data)->add()){
            return true;
        }
        return false;
    }
     public function queryNoticecount(){
        $result = $this->where(1)->count();
        return $result;
    }
    public function queryNotice(){
        $result = $this->where(1)->select();
        return $result;
    }
    public function alterNotice($data){
        $sql = "update notice set noticetext = '{$data['noticetext']}' where username = '{$data['username']}'";
        $this->execute($sql);
    }
    public function queryNoticeBy1(){
        $result=$this->where(1)->select();
        return $result;
    }
}