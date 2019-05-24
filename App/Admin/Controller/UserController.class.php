<?php
namespace Admin\Controller;

use Think\Controller;

class UserController extends BaseController
{
    /**
     *    用户列表
     **/
    public function lists()
    {
        //参数获取

        $search['end'] = I('get.end');
        $search['start'] = I('get.start');
        $search['uname'] = I('get.key');
        $search['tel'] = I('get.key');
//        dump($search);
        if (!empty($search['uname'])) {
            $map['uname|tel'] = array('like', '%' . $search['uname'] . '%');
        }

        $this->assign('search', $search);// 赋值分页输出
        // 查询条件（结束时间）设置
        if (!empty($search['end'])) {
            $search['end'] = strtotime($search['end']) + 86399;
        } else {
            $search['end'] = time();
        }
        // 查询条件（开始时间）设置
        if (!empty($search['start'])) {
            $search['start'] = strtotime($search['start']);
            if ($search['start'] > $search['end']) {
                $this->error('开始时间不能大于结束时间');
            }
            $map['addtime'] = array('BETWEEN', array($search['start'], $search['end']));
        } else {
            $map['addtime'] = array('LT', $search['end']);
            // $map['addtime']      = array('lt', $search['end']-539162);
        }
        $count = M('user')->where($map)->count();
        $Page = adminpage($count,10);
       // $Page = new \Think\Page($count, 10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('user u')->field('u.*,l.title')->join(C('DB_PREFIX').'user_level l on u.level_id=l.id','LEFT')->where($map)->order('addtime desc', 'xiutime desc')->limit($Page->firstRow . ',' . $Page->listRows)->
        select();
        $this->assign('list', $list);// 赋值数据集
        $this->assign('page', $show);// 赋值分页输出
        $this->assign('count', $count);// 赋值分页输出
//        dump($list);
        $this->display("User/lists");
    }

    //积分详情
    public function integral()
    {
        $mod = M('pointmx m');
        $id = I('get.id/d');
        //参数获取

        $search['end'] = I('get.end');
        $search['start'] = I('get.start');

        // 查询条件（结束时间）设置
        if (!empty($search['end'])) {
            $search['end'] = strtotime($search['end']) + 86399;
        } else {
            $search['end'] = time();
        }
        // 查询条件（开始时间）设置
        if (!empty($search['start'])) {
            $search['start'] = strtotime($search['start']);
            if ($search['start'] > $search['end']) {
                $this->error('开始时间不能大于结束时间');
            }
            $map['m.addtime'] = array('BETWEEN', array($search['start'], $search['end']));
        } else {
            $map['m.addtime'] = array('LT', $search['end']);
        }
        
        $map['m.uid'] = array('EQ',$id);
        $count = $mod->where($map)->count();
        $Page = new \Think\Page($count, 10);// 实例化分页类 传入总记录数和每页显示的记录数(10)
        $show = $Page->show();// 分页显示输出
        $list = $mod->join(C('DB_PREFIX').'admin a on m.adminid=a.id','LEFT')->field('m.money,m.addtime,m.xiangmu,a.username,a.name')->where($map)->order('m.addtime desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $mod = M('user');
        $userinfo = $mod->find($id);

        $this->assign('userinfo',$userinfo);
        $this->assign('list', $list);// 赋值数据集
        $this->assign('page', $show);// 赋值分页输出
        $this->assign('count', $count);// 赋值分页输出

        $this->display("User/integral");
    }

    //余额
    public function balance()
    {
        $mod = M('moneymx m');
        $id = I('get.id/d');
        //参数获取

        $search['end'] = I('get.end');
        $search['start'] = I('get.start');

        // 查询条件（结束时间）设置
        if (!empty($search['end'])) {
            $search['end'] = strtotime($search['end']) + 86399;
        } else {
            $search['end'] = time();
        }
        // 查询条件（开始时间）设置
        if (!empty($search['start'])) {
            $search['start'] = strtotime($search['start']);
            if ($search['start'] > $search['end']) {
                $this->error('开始时间不能大于结束时间');
            }
            $map['m.addtime'] = array('BETWEEN', array($search['start'], $search['end']));
        } else {
            $map['m.addtime'] = array('LT', $search['end']);
        }
        
        $map['m.uid'] = array('EQ',$id);
        
                
        $count = $mod->where($map)->count();
        $Page = new \Think\Page($count, 10);// 实例化分页类 传入总记录数和每页显示的记录数(10)
        $show = $Page->show();// 分页显示输出
        $list = $mod->join(C('DB_PREFIX').'admin a on m.adminid=a.id','LEFT')->field('m.money,m.addtime,m.xiangmu,a.username,a.name')->where($map)->order('m.addtime desc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $mod = M('user');
        $userinfo = $mod->find($id);

        $this->assign('userinfo',$userinfo);
        $this->assign('list', $list);// 赋值数据集
        $this->assign('page', $show);// 赋值分页输出
        $this->assign('count', $count);// 赋值分页输出

        $this->display("User/balance");
    }
//管理员封号
    public function adminStop()
    {
        $fd = M("user")->find($_GET['id']);
        $fd['status'] = 0;
        if (M("user")->save($fd)) {
            $data['status'] = 1;
            $data['msg'] = "禁用成功！";
            $this->ajaxReturn($data);
        } else {
            $data['status'] = 0;
            $data['msg'] = "禁用失败！";
            $this->ajaxReturn($data);
        }
    }

    //管理员解封
    public function adminStart()
    {
        $fd = M("user")->find($_GET['id']);
        $fd['status'] = 1;
        if (M("user")->save($fd)) {
            $data['status'] = 1;
            $data['msg'] = "启用成功！";
            $this->ajaxReturn($data);
        } else {
            $data['status'] = 0;
            $data['msg'] = "启用失败！";
            $this->ajaxReturn($data);
        }
    }
    


public function edit()
{   
        if (!IS_POST) {
           $id = I('get.id/d');
           $user = M('user');
            $newsxiugl = $user->find($id);
            if (!$newsxiugl) {
                $this->error('该会员不存在');
            }
            if (!empty($id)) {
                $map = array('m.uid'=>$id,'m.is_admin'=>1);
                $money = M('moneymx m');
                $moneylogs = $money->join(C('DB_PREFIX').'admin a on m.adminid=a.id','LEFT')->field('m.money,m.addtime,m.xiangmu,a.username,a.name')->where($map)->order('addtime desc')->select();
                $point = M('pointmx m');
                $pointlogs = $point->join(C('DB_PREFIX').'admin a on m.adminid=a.id','LEFT')->field('m.money,m.addtime,m.xiangmu,a.username,a.name')->where($map)->order('addtime desc')->select();

                setcookie('HTTP',get_url(),time()+3600,"/");   
            }
            $this->assign('newsxiugl', $newsxiugl);
            $this->assign('moneylogs', $moneylogs);
            $this->assign('pointlogs', $pointlogs);
            $this->display();
        } else {

            if (!empty($_POST['newid'])) {
                $newsxiugl = M('user')->find($_POST['newid']);
                if (!$newsxiugl) {
                    $this->error('该会员不存在');
                }

                if ($_POST['gl'] == 2) {

                    if (!is_numeric($_POST['point'])) {
                        $this->error('参数错误，请稍后再试');
                    }
                    $ord = M("user");
                    $ord->startTrans();
                    $result1 = $ord->where('id =' . $_POST['newid'])->setInc('integral', $_POST['point']);
                    $gl['uid'] = $_POST['newid'];
                    $gl['xiangmu'] = $_POST['xiangmu'];
                    $gl['yuemoney'] = $newsxiugl['integral'];
                    $gl['money'] = $_POST['point'];
                    $gl['addtime'] = time();
                    $gl['adminid'] = I('session.adminid');
                    $gl['is_admin'] = 1;

                    $result2 = M('pointmx')->add($gl);

                    $http = $_COOKIE['HTTP'];
                    setcookie('HTTP',null,time()-1,"/");

                    if ($result1!==false && $result2) {
                        $ord->commit();
                        $this->success('修改会员积分成功',$http);
                    } else {
                        $ord->rollback();
                        $this->error('修改会员积分失败');
                    }
                } else if ($_POST['gl'] == 1) {
 
                    if (!is_numeric($_POST['point'])) {
                        $this->error('参数错误，请稍后再试');
                    }
                    $ord2 = M("user");
                    $ord2->startTrans();
                    $result3= $ord2->where('id =' . $_POST['newid'])->setInc('balance',$_POST['point']);
                    $gl2['uid'] = $_POST['newid'];
                    $gl2['xiangmu'] = $_POST['xiangmu'];
                    $gl2['yuemoney'] = $newsxiugl['balance'];
                    $gl2['money'] = $_POST['point'];
                    $gl2['addtime'] = time();
                    $gl2['adminid'] = I('session.adminid');
                    $gl2['is_admin'] = 1;

                    $result4 = M('moneymx')->add($gl2);

                    $http = $_COOKIE['HTTP'];
                    setcookie('HTTP',null,time()-1,"/");

                    if ($result3!==false && $result4) {
                        $ord2->commit();
                        $this->success('修改会员余额成功',$http);
                    } else {
                        $ord2->rollback();
                        $this->error('修改会员余额失败');
                    }
                }
            }
        }
    }
}