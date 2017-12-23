<?php
namespace Home\Controller;
use Think\Controller;

//                            _ooOoo_
//                           o8888888o
//                           88" . "88
//                           (| -_- |)
//                            O\ = /O
//                        ____/`---'\____
//                      .   ' \\| |// `.
//                       / \\||| : |||// \
//                     / _||||| -:- |||||- \
//                       | | \\\ - /// | |
//                     | \_| ''\---/'' | |
//                      \ .-\__ `-` ___/-. /
//                   ___`. .' /--.--\ `. . __
//                ."" '< `.___\_<|>_/___.' >'"".
//               | | : `- \`.;`\ _ /`;.`/ - ` : | |
//                 \ \ `-. \_ __\ /__ _/ .-` / /
//         ======`-.____`-.___\_____/___.-`____.-'======
//                            `=---='
//
//         .............................................
//                  佛祖保佑 永无BUG 永不修改
//          佛曰:
//                  写字楼里写字间，写字间里程序员；
//                  程序人员写程序，又拿程序换酒钱。
//                  酒醒只在网上坐，酒醉还来网下眠；
//                  酒醉酒醒日复日，网上网下年复年。
//                  但愿老死电脑间，不愿鞠躬老板前；
//                  奔驰宝马贵者趣，公交自行程序员。
//                  别人笑我忒疯癫，我笑自己命太贱；
//                  不见满街漂亮妹，哪个归得程序员？
class IndexController extends Controller {
    /**
     * 正常账号主界面
     *
     * @return void
     */
    public function index(){
        if(session('?id')){
            $this->islogin = 1;
            $this->id = $_SESSION['id'];
        }else{
            $this->islogin = 2;
        }
        $noticeModel = D('Notice');
        $notice = $noticeModel->queryNotice();
        $this->shownotice=1;
        $this->assign(notice,$notice[0]['noticetext']);

        $this->display('Index/index');
    }
    /**
     * 管理员界面
     *
     * @return void
     */
    public function admin(){
    if($_SESSION['admin'] == 0){
       $this->display('index');
    }else{
        $this->display('admin');
    }
    }
}