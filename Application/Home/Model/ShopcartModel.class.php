<?php
namespace Home\Model;
use Think\Model;
class ShopcartModel extends BaseModel{
    /**
     * 添加购物车
     * @param $data
     */
    public function addshopcart($data){
        if($this->data($data)->add()){
            return true;
        }
        return false;
    }
    /**
     * 检查该商品是否已经存在购物车里
     */
    public function checkIsExist($data){
        $result=$this->where("id={$data['id']} and username='{$data['username']}'")->count();
        if($result){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 商家删除后失效标记
     */
    public function setIsDelete($id){
        $sql="update shopcart set isdelete=1 where id= $id";
        $this->execute($sql);
    }
    /**
     * 用户删除购物车中商品
     */
    public function deleteCarts($id,$username){
        $this->where("id={$id} and username='{$username}'")->delete();
    }

    /**
     * 根据用户名查询信息
     * @param $username
     * @return mixed
     */
    public function QueryByUsername($username){
        $result=$this->where("username='{$username}'")->select();
        return $result;
    }


}
