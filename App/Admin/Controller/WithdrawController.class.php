<?php
namespace Admin\Controller;

use Think\Controller;

class WithdrawController extends BaseController
{
    /**
     *    提现申请列表
     **/
    public function lists()
    {
        //判断是否有关键字传值
       if($key = I('get.key'))
       {
            $id = M('user')->getFieldByUname($key,'id');
            $map['uid'] = array('eq',$id);
       }
       //判断是否有时间值传递
       $start = I('get.start');
       $end = I('get.end');
       if($start  && $end)
       {
          
            $start = strtotime($start ." 00:00:00");
            $end = strtotime($end." 23:59:59");
            if ($start > $end) {
                $this->error('开始时间不能大于结束时间');
            }
            $map['w.addtime'] = array(array('EGT',$start),array('ELT',$end),'AND');
            
       }

        //只传一个值的时候
        if($start && $end==null)
        {
            $start = strtotime($start ." 00:00:00");
            $end = time();
            $map['w.addtime'] = array(array('EGT',$start),array('ELT',$end),'AND');
        }
        if($start==null && $end)
        {
            $end = strtotime($end." 23:59:59");
            $map['w.addtime'] = array('ELT',$end);
        }

        
        $mod = M('tixian w');
        $count = $mod->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $mod->join(C('DB_PREFIX').'user u on w.uid=u.id','RIGHT')->field('u.uname,u.tel,w.*')->where($map)->order('addtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list', $list);// 赋值数据集
        $this->assign('page', $show);// 赋值分页输出
        $this->assign('count', $count);// 赋值分页输出

        $this->display("Withdraw/lists");
    }
    //处理页面
    public function edit()
    {
        if (!IS_POST) 
        {

            

            if (!empty($_GET['id'])) 
            {
                $data = M('tixian w')->join(C('DB_PREFIX').'user u on w.uid=u.id','LEFT')->field('u.uname,u.tel,w.*')->where('w.id='.$_GET['id'])->find();
                //判断状态是处理中的时候才执行修改
                // dump((int)$data['old_status']);die;
                if((int)$data['old_status']!=0)
                {
                    $this->error('无法修改此申请状态!');
                }
            }
            $this->assign('data', $data);
            $this->display("withdraw/edit");
        }
        else
        {
            //获取值
            $id = I('post.id/d');
                if (empty($id)) 
                {
                    $this->error('参数错误');
                }
                $tx = M('tixian w')->getFieldById($id,'money');
                if (!$tx)
                {
                    $this->error('该记录不存在');
                }

                 //实例化
                $mod = M("tixian");
                //自动验证
                $rules = array(
                      
                 array('status','/\S+/','同意拒绝必须选择！',1,'regex'),// // 验证是否为空或者空格回车
                 
                );  
               
                if (!($data = $mod->validate($rules)->create()))
                {
                     // 如果创建失败 表示验证没有通过 输出错误提示信息
                     $this->error($mod->getError());
                }
                // dump($data);die;
                //判断是否已经变更了状态
                if($data['status'] == $mod->getFieldById($id,'status'))
                {
                    $this->error('已经变更了状态，请重新查看列表',U('Withdraw/lists'));
                }
                //执行修改
                //启动事务
                $mod->startTrans();
                $m = $mod->save();

                //判断并输出对应的提示信息
                if($m!==false)
                {   
                    //判断同意后的操作
                    if($data['status']==1)
                    {
                        
                        $mod->commit();
                        
                       $this->success("修改成功！",U("Withdraw/lists"));
                    }
                    //判断拒绝后的操作
                    if($data['status']==2)
                    {
                        //把余额写入用户表
                        $m_user = M('user');
                        $balance = $m_user->getFieldById($data['uid'],'balance');
                        $balance = $balance + $tx;

                        $user = $m_user->where('id='.$data['uid'])->setField('balance',$balance);
                        
                        //把提现记录写入余额明细
                        $moneymx['uid'] = $data['uid'];
                        $moneymx['xiangmu'] = '提现失败退还';
                        $moneymx['money'] = $tx;
                        $moneymx['yuemoney'] = $balance;
                        $moneymx['addtime'] = time();
                        $money = M('moneymx')->add($moneymx);
                        
                        if($user && $money)
                        {
                            $mod->commit();
                            $this->success("修改成功！",U("Withdraw/lists"));
                        }
                        else
                        {
                            $mod->rollback();
                            $this->error("修改失败！");
                        }
                    }
                }
                else
                {
                    $mod->rollback();
                   $this->error("修改失败！");
                }
        }
    }
}