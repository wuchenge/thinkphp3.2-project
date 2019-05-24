<?php
namespace Admin\Controller;

use Think\Controller;

class NavController extends BaseController
{
    /**
     *    会员等级
     **/

    //会员等级列表
    public function lists()
    {

        $list = M('nav')->select();
        $this->assign('list', $list);// 赋值数据集


        $this->display("Nav/lists");
    }

    //添加会员等级
    public function add()
    {
        //判断是否有表单传输
        if(!IS_POST)
        {   
            $count = M('nav')->count();
            if($count >= 5)
            {
                $this->error('只能添加五个导航栏项目',U('Nav/lists'));
            }
            $this->display('Nav/add');
        }
        else
        {
            //实例化
            $level = M('nav');

            $count = $level->count();
            if($count > 5)
            {
                $this->error('只能添加五个导航栏项目',U('Nav/lists'));
            }

            //自动验证
            $rules = array(
                  
             array('title','/\S+/','导航栏标题必须填写！',1,'regex'),// // 验证是否为空或者空格回车
             array('url','/\S+/','导航栏URL必须填写！',1,'regex'),// // 验证是否为空或者空格回车
             
             
            );  
           
            if (!($data = $level->validate($rules)->create()))
            {
                 // 如果创建失败 表示验证没有通过 输出错误提示信息
                 $this->error($level->getError());
            }



            $m = $level->add();
            
            if($m)
            {
                $this->success('添加成功！',U('Nav/lists'));
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
                $nav = M('nav')->find($id);
            }
            $this->assign('nav', $nav);
            $this->display("Nav/edit");
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
                $mod = M("nav");

                if (!$mod->find($id))
                {
                    $this->error('该记录不存在');
                }

                
                //自动验证
                $rules = array(
                      
                    array('title','/\S+/','导航栏标题必须填写！',1,'regex'),// // 验证是否为空或者空格回车
                    array('url','/\S+/','导航栏URL必须填写！',1,'regex'),// // 验证是否为空或者空格回车
                    
                
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
                    $this->success("修改成功！",U("Nav/lists"));  
                }
                else
                {
                    $this->error("修改失败！");
                }
        }
    }

    //删除
    public function del()
    {
        $id = I('post.id/d');
        $result = M('nav')->where('id='.$id)->delete();
        if($result)
        {
            $data['code'] = 1;
            $this->ajaxReturn($data);

        }
        else
        {
            $data['code'] = 0;
            $this->ajaxReturn($data);
        }
    }

}