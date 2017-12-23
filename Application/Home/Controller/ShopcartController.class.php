<?php
namespace Home\Controller;
use Think\Controller;

class ShopcartController extends BaseController{
    /**
     * 将商品添加到购物车中
     *
     * @return void
     */
    public function addshopcart(){
        if(!session('?id')){
             $data['error_code'] = 1002;      
         }else{
            $data['id'] = I('post.id');
            $data['username'] = session('id');
            $data['isdelete'] = 0;
            $userModel = D('Shopcart');
            if ($userModel->checkIsExist($data)) {
                $data['error_code'] = 1001;
            } else {
                $userModel->addshopcart($data);
                $data['error_code'] = 1;
            }
         }
            $this->ajaxReturn($data);
    }
    /**
     * 展示购物车
     *
     * @return void
     */
    public function showShopcart(){
        $cartModel=D('Shopcart');
        $storeModel=D('Store');
        $username=session('id');

        $result= $cartModel->QueryByUsername($username);
        $data=array();
        $i=0;

        foreach($result as $link){
            if($link['isdelete']==0){
                $temp=$storeModel->goodsFromByID($link['id']);
                $data[$i]=$temp[0];
                $i++;
            }
        }
        $this->assign(data,$data);
        $this->display('Shopcart/peopleshopcart');
    }
/**
 * 删除购物车中商品
 *
 * @return void
 */
    public function Deletecart(){
        $id = $_GET['id'];
        $name = $_SESSION['id'];
 
        $cartMdoel = D('Shopcart');
        $cartMdoel->deleteCarts($id,$name);
        $this->success("成功删除",U('/Shopcart'));

    }
}

/**
 * 订单处理状态：1.刚下单状态 2.正在发货状态 3.已经完成的订单
 * 立即购买之后，经过一轮流程
 * 将货物ID号 和货物的Username传给OrderDeal函数
 * OrderDeal函数内 将卖家username和卖家username货物ID订单初始装态传给数据库中
 * 
 * 其余地方改变：
 * 1.在用户想删除商品的时候，先判断是否为正在处理的订单，如果为正在处理的订单则不能删除，
 * 2.添加《我的订单》模块，可以根据数据库中《买家是自己的SQL》进行查询出自己的订单，还要展示出订单的状态
 * 要根据订单的状态升序展现
 * 3.添加《正在受理的订单》，可以根据数据库中《卖家是自己的SQL》来查询要展示出我正在的处理的订单，按照订单的状态
 * 升序展现
 * ---------------------------------------------------------------------
 * */

