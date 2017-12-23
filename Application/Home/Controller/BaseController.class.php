<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class BaseController extends Controller{
    public function createVerify($id = 1){
        $config = array(
            'length'=>4,
            'useImage' => true,
        );
        $verify = new Verify($config);
        $verify->entry($id);
    }
    /**
     * 检查验证码的正确性
     *
     * @param [type] $code 用户输入的验证码
     * @param integer $id
     * @return void
     */
    protected function checkVerify($code,$id = 1){
        $verify = new verify();
        return $verify->check($code,$id);
    }
   
}
?>