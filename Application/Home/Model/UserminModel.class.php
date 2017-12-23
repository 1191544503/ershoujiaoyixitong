<?php
namespace Home\Model;
use Think\Model;
class UserminModel extends BaseModel{
    protected $_validate = array(
        array('user','2,30','用户名不合法',0,'length'),
        array('verify','require','验证码不能为空！'),
        array('password','password1','两次密码输入不一致',0,'confirm'),
        array('email','email','邮箱格式不符合要求'),
    );
    public function addUser($data){
        $query = "insert into usermin (username,password,email,administrator,isactivation) values ('{$data['user']}','{$data['password']}','{$data['email']}',{$data['administrator']},0)";
        $data = new \Think\Model();
        $data->execute($query);
    }


    public function isExistsUser($id){
        $sql = "select *from usermin where username = '{$id}'";
        return  $this->query($sql); 
    }

    public function checkcorrect($data){//检查用户名密码是否匹配
        $sql = "select *from usermin where username = '{$data['user']}'";
        $result = $this->query($sql);
        if($result[0]['password'] == $data['password'])
            return true;
        return false;
    }

    public function outputPeople($id = "0" ){
        if($id == "0"){
            $result=$this->where(1)->select();
        }else{
            $result=$this->where("username={$id}")->select();
        }
        return $result;
    }

    public function isactivation($id){//获取该用户是否被激活
        $result=$this->where("username={$id}")->select();
        return $result[0]['isactivation'];
    }
	public function alterpwdByname($data){
		$sql = "update usermin set password = '{$data['password']}' where username = '{$data['user']}'";
		$this->execute($sql);
	}

    public function queryadministrator($name){//判断是不是管理员是管理员返回真
        $result=$this->where("username={$name}")->select();
        return $result[0]['administrator'];
    }

    public function activeuser($id){
		$sql = "update usermin set isactivation = 1 where username = '{$id}'";
		$this->execute($sql);
	}

    public function changeAdminState($username){
        $result=$this->execute("update usermin set administrator=1 where username={$username}");
        if($result){
            return true;
        }else{
            return false;
        }
    }
}
?>