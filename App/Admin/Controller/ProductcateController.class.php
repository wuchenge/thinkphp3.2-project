<?php
namespace Admin\Controller;
use Think\Controller;
class ProductcateController extends BaseController {

    /**
	*	商品分类列表
	**/
    public function lists(){
        //搜索参数获取
        $search['end'] = I('get.end');
        $search['start'] = I('get.start');
        $search['title'] = I('get.title');
        $search['pid'] = I('get.pid');
        $search['is_two'] = I('get.is_two');
        if(!empty($search['title'])){
            $map['title'] = array('like', '%' . $search['title'] . '%');
        }
        if(!empty($search['pid'])){
            if($search['pid']==1){
                $search['is_two']=2;//修改二级状态，判断不生效
                $map['pid'] = 0;
            }else{
                $map['pid'] = $search['pid'];
            }
        }
        $this->assign('search',$search);
        // 查询条件（结束时间）设置
        if (!empty($search['end'])) {
            $search['end'] = strtotime($search['end']) + 86399;
        } else {
            $search['end'] = time();
        }
        // 查询条件（开始时间）设置
        if (!empty($search['start'])) {
            $search['start'] = strtotime($search['start']);
            if($search['start'] > $search['end']){
                $this->error('开始时间不能大于结束时间');
            }
            $map['addtime'] = array('BETWEEN', array($search['start'], $search['end']));
        } else {
            $map['addtime'] = array('LT', $search['end'] );
        }
        $count=M('productcate')->where($map)->count();
        $Page = adminpage($count,10);
        //$Page = new \Think\Page($count,20);
        $show = $Page->show();
        $list = M('productcate')->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        //获取商品父级标题
        foreach($list as $k=>$v){
            if($v['pid']==0)  {
                $list[$k]['fid'] ='顶级分类' ;
            }else{
                $fid=M('productcate')->field('title')->where('id ='.$v['pid'])->find();
                $list[$k]['fid'] =$fid['title'] ;
            }
        }
        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        session('productcate_url',$url);
        if(!empty($search['pid']) && $search['is_two']==1){
            //获取一级分类id的父id
            $resultc=M('productcate')->where('pid = 0')->find($search['pid']);
            $resultc2=M('productcate')->where('pid = 0')->select();
            $cate="<option value='0'>全部分类</option><option value='1'>一级分类</option>";
            foreach($resultc2 as $v){
                if($v['id'] ==$resultc['pid']){
                    $cate .= "<option value='{$v['id']}' selected>{$v['title']}</option>";
                }else{
                    $cate .= "<option value='{$v['id']}'>{$v['title']}</option>";
                }
            }

            //获取二级分类,状态保持
            $result=M('productcate')->where('pid = '.$resultc['pid'])->select();
            $cate2="";
            foreach($result as $v){
                if($v['id'] ==$search['pid']){
                    $cate2 .= "<option value='{$v['id']}' selected>{$v['title']}</option>";
                }else{
                    $cate2 .= "<option value='{$v['id']}'>{$v['title']}</option>";
                }
            }
        }else{
            //获取分类,状态保持

            $result=M('productcate')->where('pid = 0')->select();
            if($search['pid']==1){
                $cate="<option value='0'>全部分类</option><option value='1' selected >一级分类</option>";
            }else{
                $cate="<option value='0'>全部分类</option><option value='1'  >一级分类</option>";
            }
            foreach($result as $v){
                if($v['id'] ==$search['pid']){
                    $cate .= "<option value='{$v['id']}' selected>{$v['title']}</option>";
                }else{
                    $cate .= "<option value='{$v['id']}'>{$v['title']}</option>";
                }
            }
        }
        $this->assign('cate',$cate);
        $this->assign('cate2',$cate2);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $this->display();
    }


    /**
     *	商品分类新增
     **/
    public function add(){
        if(!IS_POST){
            //获取分类
            $result=M('productcate')->where('pid = 0')->select();
            $cate="<option value='0'>顶级分类</option>";
            foreach($result as $v){
                $cate .= "<option value='{$v['id']}'>{$v['title']}</option>";
            }
            $this->assign('cate',$cate);
            $this->display();
        }else{
//            dump($_POST);exit();
            $productcate = M("productcate");
            $productcate->create();
            $title=I('post.title');
            // $keywords=I('post.keywords');
            // $description=I('post.description');
            if(empty($title)){
                $this->error('请输入商品分类标题');
            }
            // if(empty($keywords)){
            //     $this->error('请输入商品分类关键字');
            // }
            // if(empty($description)){
            //     $this->error('请输入商品分类描述');
            // }

            $productcate->addtime=time();
            $result = $productcate->add();
            if($result){
                $this->success('添加成功',U("productcate/lists"));
            }else{
                $this->error('添加失败，请稍候操作');
            }
        }
    }

    /**
     *	商品分类编辑
     **/
    public function edit(){
        if(!IS_POST){
            $id=intval($_GET['id']);
            $cated=M('productcate')->find($id);
            $catetop=M('productcate')->find($cated['pid']);
            if(empty($cated)){
                $this->error('参数错误');
            }
            if($cated['pid']==0){
                //获取分类,状态保持
                $result=M('productcate')->where('pid = 0')->select();
                $cate="<option value='0'>顶级分类</option>";
                foreach($result as $v){
                    if($v['id'] ==$id){
                        $cate .= "<option value='{$v['id']}' selected>{$v['title']}</option>";
                    }else{
                        $cate .= "<option value='{$v['id']}'>{$v['title']}</option>";
                    }
                }
            }elseif($catetop['pid']==0){
                //获取一级分类id的父id
                $resultc=M('productcate')->where('pid = 0')->find($id);
                $resultc2=M('productcate')->where('pid = 0')->select();
                $cate="<option value='0'>顶级分类</option>";
                foreach($resultc2 as $v){
                    if($v['id'] ==$resultc['pid']){
                        $cate .= "<option value='{$v['id']}' selected>{$v['title']}</option>";
                    }else{
                        $cate .= "<option value='{$v['id']}'>{$v['title']}</option>";
                    }
                }
                //获取二级分类,状态保持
                $result=M('productcate')->where('pid = '.$resultc['pid'])->select();
                $cate2="<option value='{$resultc['pid']}'>顶级分类</option>";
                foreach($result as $v){
                    if($v['id'] ==$id){
                        $cate2 .= "<option value='{$v['id']}' selected>{$v['title']}</option>";
                    }else{
                        $cate2 .= "<option value='{$v['id']}'>{$v['title']}</option>";
                    }
                }
            }else{
                //获取一级分类id的父id
                $resultc=M('productcate')->where('pid = 0')->find($catetop['pid']);
                $resultc2=M('productcate')->where('pid = 0')->select();
                $cate="<option value='0'>顶级分类</option>";
                foreach($resultc2 as $v){
                    if($v['id'] ==$resultc['id']){
                        $cate .= "<option value='{$v['id']}' selected>{$v['title']}</option>";
                    }else{
                        $cate .= "<option value='{$v['id']}'>{$v['title']}</option>";
                    }
                }
                //获取二级分类,状态保持
                $result=M('productcate')->where('pid = '.$catetop['pid'])->select();
                $cate2="<option value='{$resultc['pid']}'>顶级分类</option>";
                foreach($result as $v){
                    if($v['id'] ==$catetop['id']){
                        $cate2 .= "<option value='{$v['id']}' selected>{$v['title']}</option>";
                    }else{
                        $cate2 .= "<option value='{$v['id']}'>{$v['title']}</option>";
                    }
                }
            }
            $this->assign('cate',$cate);//顶级分类
            $this->assign('cate2',$cate2);//二级分类
            $this->assign('cated',$cated);//当前分类信息
            $this->assign('catetop',$catetop);//父级id
            $this->display();
        }else{
            $productcate = M("productcate");
            $productcate->create();
            $title=I('post.title');
            // $keywords=I('post.keywords');
            // $description=I('post.description');
            if(empty($title)){
                $this->error('请输入商品分类标题');
            }
            // if(empty($keywords)){
            //     $this->error('请输入商品分类关键字');
            // }
            // if(empty($description)){
            //     $this->error('请输入商品分类描述');
            // }
            $result = $productcate->save();
            if($result !== false){
                $url = U("productcate/lists");
                $this->success('修改成功',$url);
            }else{
                $this->error('修改失败，请稍候操作');
            }
        }
    }

    /**
     *	商品分类删除
     **/
    public function del(){
        $id=intval($_POST['id']);
        $addr=M('productcate');
        $result=$addr->where('id ='.$id)->find();
        if(empty($result)){
            $data['code']=0;
            $data['msg']="该商品分类不存在";
            $this->ajaxReturn($data);
        }
        $cate=$addr->where('pid ='.$result['id'])->find();
        if($cate){
            $data['code']=0;
            $data['msg']="该分类下有数据";
            $this->ajaxReturn($data);
        }else{
            $map['fcate|scate|tcate']=array('eq',$id);
            $goods=M('goods')->where($map)->find();
            if(!empty($goods)){
                $data['code']=0;
                $data['msg']="该商品分类下有商品";
                $this->ajaxReturn($data);
            }
            $deladdr=$addr->where('id ='.$id)->delete();
            if($deladdr){
                $data['code']=1;
                $data['msg']="删除商品分类信息成功";
                $this->ajaxReturn($data);
            }else{
                $data['code']=0;
                $data['msg']="删除商品分类信息失败";
                $this->ajaxReturn($data);
            }
        }
    }

    /**
     *	顶级分类联动处理
     **/
    public function cate1(){
        $id=intval($_POST['id']);
        $addr=M('productcate');
        $result=$addr->where('pid ='.$id)->select();
        if($result){
            $data['code']=1;
            $data['msg']="<option value='{$id}'>顶级分类</option>";
            foreach($result as $v){
                if($v['id'] ==$id){
                    $data['msg'] .= "<option value='{$v['id']}' selected>{$v['title']}</option>";
                }else{
                    $data['msg'] .= "<option value='{$v['id']}'>{$v['title']}</option>";
                }
            }
            $this->ajaxReturn($data);
        }else{
            $data['code']=0;
            $data['msg']="该分类下暂无信息";
            $this->ajaxReturn($data);
        }
    }
}