<?php
namespace Admin\Controller;

use Think\Controller;

class LevelController extends BaseController
{
    /**
     *    会员等级
     **/

    //会员等级列表
    public function lists()
    {

        $list = M('user_level')->select();
        $this->assign('list', $list);// 赋值数据集


        $this->display("Level/lists");
    }

    //添加会员等级
    public function add()
    {
        //判断是否有表单传输
        if(!IS_POST)
        {
            $this->display('Level/add');
        }
        else
        {
            //实例化
            $level = M('user_level');
            //查询会员等级数据
            $num = $level->count();
            if($num>=3)
            {
                $this->error('只能添加到三级会员');
            }
            //自动验证
            $rules = array(
                  
             array('title','/\S+/','会员等级名称必须填写！',1,'regex'),// // 验证是否为空或者空格回车
             array('condition','/\S+/','会员等级升级条件必须填写！',1,'regex'),// // 验证是否为空或者空格回车
             array('discount','/\S+/','会员折扣必须填写！',1,'regex'),// // 验证是否为空或者空格回车
             
            );  
           
            if (!($data = $level->validate($rules)->create()))
            {
                 // 如果创建失败 表示验证没有通过 输出错误提示信息
                 $this->error($level->getError());
            }

            $m = $level->add();
            
            if($m)
            {
                $this->success('添加成功！',U('Level/add'));
            }
            else
            {
                $this->error('添加失败！');
            }
        }
        
        
    }

    //编辑会员等级
    public function edit()
    {
        if (!IS_POST) 
        {   
            $id = I('get.id/d');
            if (!empty($id))
            {
                $level = M('user_level')->find($id);
            }
            $this->assign('level', $level);
            $this->display("Level/edit");
        }
        else
        {
                //获取值
                $id = I('post.id/d');

                if (empty($id)) 
                {
                    $this->error('参数错误');
                }
                 
                 //实例化
                $mod = M("user_level");

                if (!$mod->find($id))
                {
                    $this->error('该记录不存在');
                }

                
                //自动验证
                $rules = array(
                      
                    array('title','/\S+/','会员等级名称必须填写！',1,'regex'),// // 验证是否为空或者空格回车
                    array('condition','/\S+/','会员等级升级条件必须填写！',1,'regex'),// // 验证是否为空或者空格回车
                    array('discount','/\S+/','会员折扣必须填写！',1,'regex'),// // 验证是否为空或者空格回车
                
                );  
               
                if (!($data = $mod->validate($rules)->create()))
                {
                     // 如果创建失败 表示验证没有通过 输出错误提示信息
                     $this->error($mod->getError());
                }
                //执行修改
                
                $m = $mod->save();

                //判断并输出对应的提示信息
                if($m!==false)
                {   
                    $this->success("修改成功！",U("Level/lists"));  
                }
                else
                {
                    $this->error("修改失败！");
                }
        }
    }

}