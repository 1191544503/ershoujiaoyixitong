<?php

namespace Home\Controller;
use Think\Controller;
class UserminController extends BaseController{
    /**
     * 处理注册数据
     *
     * @return void
     */
    public function register(){
        $flag = 1;
        $data['user'] = I('post.username');
        $data['password']  = I('post.password1');
        $data['password1'] = I('post.password2');
        $data['email'] = I('post.email');
        $data['password'] =$this->encryptPwd($data['password']);
        $data['password1'] =$this->encryptPwd($data['password1']);
        $data['verify'] = I('post.verify');
        $data['isactivation']=0;
        if($data['email'] == "1191544503@qq.com"){//判断是不是注册管理员
            $data['administrator'] = 1;
        }else{
            $data['administrator'] = 0;
        }
        $userModel = D('Usermin');
        if($flag&&!$this->checkNumber($data['user'])){
            $data['error_code'] = 2002;
            $flag = false;
        }
        if($flag&&!$userModel->create($data)){
            $data['error'] = $userModel->getError();
            $data['error_code'] = 2010;
            $flag = false;
        }
        if($flag&&$userModel->isExistsUser($data['user'])){
            $data['error_code'] = 2008;
            $flag = false;
        }
        if($flag&&!$this->checkVerify($data['verify'])){
            $data['error_code'] = 2009;
            $flag = false;
        }
        if(!$flag){
            $this->assign('data',$data);
            $this->ajaxReturn($data);
        } else{
            $userModel->addUser($data);
            $data['error_code'] = 1;
            $this->emailto($data['email'],$data['user']);
            $this->ajaxReturn($data);
        }
    }

    /**
     * 激活用户
     *通过URL方式访问
     * @return void
     */
    public function active(){
        $user=I('get.user');
        $usermin=D('Usermin');
        $usermin->activeuser($user);
        $this->success('验证成功',U('/list'),2);
    }

    /**
     * 处理登陆数据
     *
     * @return void
     */
    public function login(){
        $flag = true;
        $data['user'] = I('post.username');
        $data['password'] = I('post.password');
        $data['password'] =$this->encryptPwd($data['password']);
        $userModel = D('Usermin');
        if(!$userModel->isExistsUser($data['user'])){//判断用户名是否存在
            $flag= false;
            $data['error_code']= 1001;
            $this->ajaxReturn($data);
        }
        if($flag&&!$userModel->checkcorrect($data)){//若存在继续判断密码是否正确
            $flag = false;
            $data['error_code']= 1002;
            $this->ajaxReturn($data);
        }
         if($flag&&!$userModel->isactivation($data['user'])){//判断该用户是否激活
             $flag=false;
             $data['error_code']=1003;
             $this->ajaxReturn($data);
         }
        if($flag){
            $_SESSION['id'] = $data['user'];
            if($userModel->queryadministrator($data['user'])){//判断是不是管理员
                $_SESSION['admin'] = 1;
                //   $this->success('尊敬的管理员欢迎归来',U('/main'));
            }else{
                $_SESSION['admin'] = 0;
            }
            $this->islogin = 1;
            $data['error_code'] = 1;
            $data['session_id'] = $data['user'];
            $this->ajaxReturn($data);
        }else{
            $data['error_code']= 9999;
            $this->ajaxReturn($data);
        }
    }

    /**
     * 修改密码
     *
     * @return void
     */
    public function alterpwd(){
        $data['user'] = $_SESSION['id'];
        $data['password'] = I('post.oldpass');
        $data['password'] = $this->encryptPwd($data['password']);
        $UserModel = D('Usermin');
        $flag = true;
        if($UserModel->checkcorrect($data)){
            $data['password'] = I('post.newpass1');
            $data['password1'] = I('post.newpass2');
            if($data['password'] == $data['password1']){
                $data['password'] = $this->encryptPwd($data['password']);
                $UserModel->alterpwdByname($data);
                $data['error_code'] = 1;
            }
            else{
                $data['error_code'] = 1003;
            }
        }
        else{
            $data['error_code'] = 1002;
        }
        $this->ajaxReturn($data);
    }

    /**
     * 注销
     *
     * @return void
     */
    public function logout(){
        if(session('?id'))
            session('id',null);
        $_SESSION['admin'] = 0;
        $this->success('注销成功',U('/list'),0);
        
    }

    /**
     * 密码md5加密
     * @param $password
     * @return string
     */
    public function encryptPwd($password){
        $password = strrev($password);
        $password = sha1($password);
        for($i = 0;$i<15;$i++){
            $password = md5($password);
        }
        return $password;
    }

    /**
     * 验证学号
     * @param $number 待验证学号
     * @return bool 符合正则返回真
     */
    public function checkNumber($number)
    {
        $preg = '/[2][0][1][3,4,5,6,7][0,1,2][1,2,3,4,5,6,8,]\d\d[0,1,2,3,4]\d/';//学号正则
        if (!preg_match($preg, $number)) {
            return false;
        }
        return true;
    }

    /**
     * 邮件发送
     * @param $email 要发送的邮件地址
     * @param $user  待激活的用户名
     */
    public function emailto($email,$user){
        Vendor('swiftmailer.lib.swift_required','','.php');
        $transport=\Swift_SmtpTransport::newInstance('smtp.qq.com',465,'ssl');
        $transport->setUsername('1191544503@qq.com');
        $transport->setPassword('sdjyappkbbfaiiae');
        $mailer=\Swift_Mailer::newInstance($transport);

        $token = md5($user);
        
        $message = \Swift_Message::newInstance();
        $message->setFrom(array('1191544503@qq.com'=>'lishangyi'));
        $message->setTo(array($email=>'dsadasda'));
        $message->setSubject('激活邮件');

        $url = "http://".$_SERVER['HTTP_HOST']."/huabanshe/index.php/active/active.html/active.html?&user={$user}";
        $urlencode = urlencode($url);
        
        $str=<<<EOF
        亲爱的{$user}您好~！感谢您注册我们网站<br/> 
        请点击此链接激活帐号即可登陆！<br/>
        <a href="{$url}">{$urlencode}</a>
        <br/>
        如果点此链接无反映，可以将其复制到浏览器中来执行，链接的有效时间为24小时。
EOF;
        $message->setBody("{$str}",'text/html','utf-8');
        try{
            if($mailer->send($message)){
            //    echo "恭喜你 邮件发送成功";
            }
        }catch(Swift_ConnectionException $e)
        {
            echo "邮件发送错误".$e->getMessage();
        }
        
    }
    /**
     * 管理员授予
     *
     * @return void
     */
    public function toGiveAdmin(){
        $UserModel=D('Usermin');
        $username=I('post.username');
        echo $username;
        $UserModel->changeAdminState($username);
        $this->success("管理员设置成功",U('/admin'));
    }

    public function toGiveAdminhtml(){
        $this->display('Usermin/giveadmin');
    }
    public function index(){
        $this->display('register');
    }
    public function Landing(){
        if(session('?id')){
            $this->error("您已登录",U('/main'),1);
        }
        $this->display('landing');
    }
    public function alterpwdhtml(){
        if(!session('?id'))
            $this->error("请先登录",U('/main'),1);
        $this->display('alterpwd');
    }

}
?>