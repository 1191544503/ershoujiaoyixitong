<?php

namespace Home\Controller;

use Think\Controller;

class StoreController extends BaseController
{

    /**
     * 添加商品
     *
     * @return void
     */
    public function addGood()
    {
        if (!session('?id'))
            $this->success('请先登录', U('/land'));
        else {
            if ($_POST['submit'] == "上架") {
                $flag = true;
                $data['username'] = $_SESSION['id'];
                $data['goodsname'] = I('post.storename');
                $data['introduce'] = I('post.introduce');
                $data['image'] = '0000.jpg';
                if (strlen($data['introduce']) > 80) {
                    $flag = false;
                    $this->error = "简介字数太多";
                }
                $data['price'] = I('post.price');
                $data['phone'] = I('post.phone');
                $data['type'] = I('post.phonetype');
                $data['phone'] = $data['type'] . ":" . $data['phone'];
                $data['create_time'] = date("Y:m:d");
                $number1 = rand(5, 100000);
                $number2 = rand(5, 100000);
                $number3 = rand(5, 100000);
                $number4 = rand(5, 100000);
                $number5 = rand(5, 100000);
                $number6 = rand(5, 100000);
                $number7 = rand(5, 100000);
                $filename = $_SESSION['id'] . $number1 . $number2 . $number3 . $number4 . $number5 . $number4 . $number7;//图片名字保证唯一性
                if (!empty($_FILES[fname][name])) {
                    $fileinfo = $_FILES['fname'];
                    if (!$this->upload($fileinfo, $filename)) {//上传图片
                        $flag = false;
                    }
                } else {
                    $flag = false;
                    $this->error = '请添加jpg图片';

                }
                if ($flag) {//压缩图片
                    $data['image'] = $filename . '.jpg';
                    $this->zip($data['image']);
                }
                $storeModel = D('Store');
                if ($flag) {
                    if ($storeModel->goodsToMysql($data)) {
                        $this->success('添加成功', U('/list'));
                    } else {
                        $this->display('addGood');
                    }
                } else {
                    $this->display('addGood');
                }
            }
        }
    }

    /**
     * 显示分页后的商品列表
     *
     * @return void
     */
    public function storelist()
    {//商品列表
        $this->shownotice = 0;
        $storeModel = D('Store');
        $data = $storeModel->goodsCountBy1();
        $page = new\Think\Page($data, 8);
        $page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('last', '末页');
        $page->setConfig('first', '首页');
        $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $page->lastSuffix = false;//最后一页不显示为总页数
        $show = $page->show();
        $list = $storeModel->where(1)->order('create_time')->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign('list', $list);
        $this->assign('page', $show);
        if (!session('?id'))
            $this->islogin = 0;
        else
            $this->islogin = 1;
        $this->display('index/index');
    }
    /**
     * 按条件搜索商品
     *
     * @return void
     */
    public function storelistByBookname()
    {
        $this->shownotice = 0;
        $storeModel = D('Store');
        $name = I('get.soushuo');
        $data = $storeModel->goodsCountByBookname($name);
        $page = new\Think\Page($data, 8);
        $page->setConfig('header', '<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
        $page->setConfig('prev', '上一页');
        $page->setConfig('next', '下一页');
        $page->setConfig('last', '末页');
        $page->setConfig('first', '首页');
        $page->setConfig('theme', '%FIRST%%UP_PAGE%%LINK_PAGE%%DOWN_PAGE%%END%%HEADER%');
        $page->lastSuffix = false;//最后一页不显示为总页数
        $show = $page->show();
        $list = $storeModel->where("goodsname like '%{$name}%'")->order('create_time')->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->assign('list', $list);
        $this->assign('page', $show);
        if (!session('?id'))
            $this->islogin = 0;
        else
            $this->islogin = 1;
        $this->display('index/index');
    }
/**
 * //个人商品列表
 *
 * @return void
 */
    public function peoplestoreList()
    {
        $this->shownotice = 0;
        if (!session('?id'))
            $this->success('请先登录', U('/land'));
        $storeMdoel = D('store');
        $name = session('id');
        $data = $storeMdoel->goodsFromByname($name);
        $this->assign('data', $data);
        $this->display('peoplestorelist');
    }

    /**
     * 管理员所使用的所有商品列表
     *
     * @return void
     */
    public function adminstorelist()
    {//管理员所有商品列表
        $this->shownotice = 0;
        if (!session('?id'))
            $this->success('请先登录', U('/list'));
        $storeMdoel = D('store');
        $data = $storeMdoel->goodsFromBy1();
        $this->assign('data', $data);
        $this->display('adminstorelist');
    }  
    /**
     * 文件上传
     *
     * @param 文件信息.二位数组
     * @param 文件名
     * @return void
     */ 
    public function upload($fileinfo, $filename)
    {//
        $upload = new \Think\Upload();
        $upload->maxSize = 3145728000;
        $upload->autoSub = false;
        $upload->exts = array('jpg', 'jpeg');//设置文件允许传送类型
        $upload->rootPath = './Public/image/';
        $upload->saveName = $filename;
        $info = $upload->uploadOne($fileinfo);
        if (!$info) {
            $this->error = $upload->getError();//获取文件上传错误
            return false;
        } else {
            return true;
        }
    }

    /**
     * 删除商品
     *
     * @return void
     */
    public function Delete()
    {
        $id = $_GET['id'];
        if ($_SESSION['admin']) {//根据不同的权限给予不同的值
            $name = $_GET['username'];
        } else {
            $name = $_SESSION['id'];
        }
        $storeMdoel = D('Store');
        $storeMdoel->goodsDeleteByname($name, $id);
        $cartModel = D('Shopcart');
        $cartModel->setIsDelete($id);
        if ($_SESSION['admin']) {
            $this->success("成功删除", U('/adminstorelist'));
        } else {
            $this->success("成功删除", U('/peopleList'));
        }
    }

    /**
     * 图片压缩
     * @param $name
     */
    public function zip($name)
    {//图片压缩
        $image = new\Think\Image();
        $image->open("H:\AppServ\www\huabanshe\Public\image\\$name");
        $image->thumb(350, 350)->save("H:\AppServ\www\huabanshe\Public\image\\$name");
    }


    public function addGoodhtml()
    {
        if (!session('?id'))
            $this->success('请先登录', U('/land'));
        else
            $this->display('addGood');
    }


}

?>