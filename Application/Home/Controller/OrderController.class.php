<?php
namespace Home\Controller;
use Think\Controller;

class OrderController extends BaseController{
    /**
     * 添加订单
     *
     * @return void
     */
    public function addOrder(){
        $data['goodsid']=I('get.goodsid');
        $data['seller']=I('get.seller');
        $data['buyers']=$_SESSION('id');
        $data['orderstate']=1;
        $orderModel=D('Order');
        if($PrderModel->addData($data)){/////////////////////////////////////////////
            $this->success('订单添加成功',U('/???????????/'));
        }else{
             $this->error('订单添加失败',U('/???????????/'));
        }
    }
    /**
     * 我的订单
     *
     * @return void
     */
    public function showOwnerOrder(){
        $id=$_SESSION['id'];
        $result=queryOrdeByBuyer($id);////////////////////////////////
        $this->assign('order',$result);
        $this->display('showorder');
    }
    /**
     * 我正在出售中的商品
     *
     * @return void
     */
    public function showBuyOrder(){
        $id=$_SESSION['id'];
        $result=queryOrdeBySeller($id);////////////////////////////////
        $this->assign('order',$result);
        $this->display('showorder');
    }
}
?>