<?php
namespace Admin\Controller;
use Think\Controller;
class SpaceController extends BaseController {
	/**
	*	办公空间列表
	**/
    public function lists(){
        //参数获取
        $search['end'] = I('get.end');
        $search['start'] = I('get.start');
        $search['title'] = I('get.title');
//        dump($search);
        if(!empty($search['title'])){
            $map['title'] = array('like', '%' . $search['title'] . '%');
        }
        $this->assign('search',$search);// 赋值分页输出
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
        $count=M('space')->where($map)->count();
        $Page = adminpage($count,10);
       // $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('space')->where($map)->order('addtime desc')->limit($Page->firstRow.','.$Page->listRows)->
        select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $this->display();
    }
    /**
	*	办公空间添加
	**/
    public function add(){
        if(!IS_POST){
            if(!empty($_GET['id'])){
               $newsxiugl=M('space')->find($_GET['id']);
            }
            $this->assign('newsxiugl',$newsxiugl);
            //第一个属性
            $c1name=M('spacecate')->where('id=58')->getField('title');
            $result=M('spacecate')->where('pid=58')->select();
            $this->assign('c1name',$c1name);
            $cate="<option value=''>请选择</option>";
            foreach($result as $v){
                $cate .= "<option value='{$v['id']}'>{$v['title']}</option>";
            }
            $this->assign('cate',$cate);
            //第2个
            $c2name=M('spacecate')->where('id=59')->getField('title');
            $result2=M('spacecate')->where('pid=59')->select();
            $this->assign('c2name',$c2name);
            $cate2="<option value=''>请选择</option>";
            foreach($result2 as $v){
                $cate2 .= "<option value='{$v['id']}'>{$v['title']}</option>";
            }
            $this->assign('cate2',$cate2);
            //第3个
            $c3name=M('spacecate')->where('id=60')->getField('title');
            $result3=M('spacecate')->where('pid=60')->select();
            $this->assign('c3name',$c3name);
            $cate3="<option value=''>请选择</option>";
            foreach($result3 as $v){
                $cate3 .= "<option value='{$v['id']}'>{$v['title']}</option>";
            }
            $this->assign('cate3',$cate3);
            $this->display();
        }else{
            $news = M('space');
            $news->create();
            //属性
            // $c1id=I('post.c1id');
            // if(empty($c1id)){
            //         $this->error('请选择属性1');
            // }
            // $c2id=I('post.c2id');
            // if(empty($c2id)){
            //         $this->error('请选择属性2');
            // }
            // $c3id=I('post.c3id');
            // if(empty($c3id)){
            //         $this->error('请选择属性3');
            // }
            $stime=I('post.addtime');
            if(empty($stime)){
                $news->addtime = time();
            }else{
                $news->addtime = strtotime($stime);
            }
            $imgurlglgo=I('post.imgurlglgo');
            if(empty($imgurlglgo)){
                    $this->error('请您上传商品图');
            }
            // $price=I('post.price');
            // if(empty($price)){
            //         $this->error('请您上传价格');
            // }
            $news->price=I('post.price');
            $news->imgurl=$imgurlglgo[0];
            $news->description2=I('post.description2');
            $news->description3=I('post.description3');
            $imgurlgl=I('post.imgurlgl');
            if(empty($imgurlgl)){
                    $this->error('请您上传商品细节图');
            }
            $news->simgs= implode('|',$imgurlgl);
            $result = $news->add();
            if($result){
                $this->success('新增办公空间成功',U('Space/lists'));
            }else{
                $this->error('新增办公空间失败，请稍候操作');
            }
        }
    }

    public function edit(){
        if(!IS_POST){
            if(!empty($_GET['id'])){
                $newsxiugl=M('space')->find($_GET['id']);
            }

            $newsxiugl = M('space')->where("id = ".$_GET['id'])->find();
            $imgroll=explode('|',$newsxiugl['simgs']);
            $this->assign('imgroll',$imgroll);
            if($newsxiugl){
                $this->assign('newsxiugl',$newsxiugl);
                //第一个属性
            $c1name=M('spacecate')->where('id=58')->getField('title');
            $cate=M('spacecate')->where('pid=58')->select();
            $this->assign('c1name',$c1name);
            $this->assign('cate',$cate);
            //第2个
            $c2name=M('spacecate')->where('id=59')->getField('title');
            $cate2=M('spacecate')->where('pid=59')->select();
            $this->assign('c2name',$c2name);
            $this->assign('cate2',$cate2);
            //第3个
            $c3name=M('spacecate')->where('id=60')->getField('title');
            $cate3=M('spacecate')->where('pid=60')->select();
            $this->assign('c3name',$c3name);
            $this->assign('cate3',$cate3);
                $this->display("Space/edit");
            }else{
                $this->error('该数据不存在');
            }
        }else{
            $news = M('space');
            $news->create();
            //办公空间修改时间处理
            $news->addtime = strtotime(I('post.addtime'));
           //属性
            // $c1id=I('post.c1id');
            // if(empty($c1id)){
            //         $this->error('请选择属性1');
            // }
            // $c2id=I('post.c2id');
            // if(empty($c2id)){
            //         $this->error('请选择属性2');
            // }
            // $c3id=I('post.c3id');
            // if(empty($c3id)){
            //         $this->error('请选择属性3');
            // }
            // $price=I('post.price');
            // if(empty($price)){
            //         $this->error('请您上传租金价格');
            // }else{
            //     $news->price=I('post.price');
            // }
            $imgurlglgo=I('post.imgurlglgo');
            $imgurlgl=I('post.imgurlgl');
           if(!empty($imgurlglgo)){
                //删除编辑前的图片
                $file=M('goods')->find($id);
                $file = $file['imgurl'];
                @unlink($_SERVER['DOCUMENT_ROOT'].$file);
                $news->imgurl= $imgurlglgo[0];
            }
            if(!empty($imgurlgl)){
                //删除编辑前的图片
                $file=M('space')->find($id);
                $file = $file['imgurl2'];
                @unlink($_SERVER['DOCUMENT_ROOT'].$file);
                $news->simgs= implode('|',$imgurlgl);
            }
            $result = $news->save();
            if($result !== false){
                $this->success('办公空间修改成功',U("Space/lists"));
            }else{
                $this->error('办公空间修改失败，请稍候操作');
            }
        }
    }
    /**
     *	删除办公空间
     **/
    public function del(){
        $nid=$_POST['id'];
        if(empty($nid)){
            $data['code']=0;
            $data['msg']="请选择要移除的办公空间信息";
            $this->ajaxReturn($data);
        }
        if(!is_numeric($nid)){
            $data['code']=0;
            $data['msg']="参数错误，请稍后再试";
            $this->ajaxReturn($data);
        }
        $addr=M('space');
        $result=$addr->where('id ='.$nid)->find();
        if($result){
            $deladdr=$addr->where('id ='.$nid)->delete();
            if($deladdr){
                $data['code']=1;
                $data['msg']="删除办公空间信息成功";
                $this->ajaxReturn($data);
            }else{
                $data['code']=0;
                $data['msg']="删除办公空间信息失败";
                $this->ajaxReturn($data);
            }
        }else{
            $data['code']=0;
            $data['msg']="要删除的办公空间信息不存在";
            $this->ajaxReturn($data);
        }
    }

}