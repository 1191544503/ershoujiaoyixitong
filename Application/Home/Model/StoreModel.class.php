<?php
namespace Home\Model;
use Think\Model;
class StoreModel extends BaseModel{
    public function goodsToMysql($con){
       if($this->data($con)->add()){
            return true;
        }
        return false;
    }
    public function goodsFromBy1(){
        $sql = "SELECT * FROM store";
		$data = $this->query($sql);
		return $data;
    }
    public function goodsCountBy1(){
        $data=$this->where(1)->count();
        return $data;
    }
    public function goodsCountByBookname($name){
        $data=$this->where("goodsname like '%{$name}%'")->count();
        return $data;
    }
	public function goodsFromByname($name){
        $data = $this->where("username={$name}")->select();
		return $data;
	}
    public function goodsDeleteByname($name,$id){
        $sql = "delete from store where id = {$id} and username='{$name}'";
        $this->execute($sql);
    }
    public function goodsFromByID($id){
        $result=$this->where("id={$id}")->select();
        return $result;
    }
    
}
?>