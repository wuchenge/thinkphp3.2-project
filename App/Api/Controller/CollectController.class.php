<?php
namespace Api\Controller;
use Think\Controller;
class CollectController extends Controller{
    
    //收藏的办公空间
    public function space(){
        $uid=I('post.uid');
        if(empty($uid)){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少重要参数';
            $this->ajaxReturn($return);
        }else{
            $when['c.uid']=$uid;
        }
        $when['c.type']=1;
        //参数获取
        $p = I('post.p');//页数
        if(empty($p)) $p = 1;
        $num=10;//每页数量
        $firstRow = ($p - 1) * $num;

        $res['mycoll']=M('coll')->
                        table(array("xmb_coll"=>"c","xmb_space"=>"s"))->
                        field("c.*,s.id as sid")->
                        where($when)->where("s.id=c.gid")->
                        limit($firstRow, $num)->
                        select();
        // if(empty($res['mycoll'])){
        //     $return['stu'] = '0';
        //     $return['code'] = '111';
        //     $return['msg'] = '没有你要查询的数据';
        //     $this->ajaxReturn($return);
        // }
        foreach($res['mycoll'] as $k=>$v){
            $res['mycoll'][$k]['space']=M('space')->where('id ='.$res['mycoll'][$k]['gid'])->find();
            $res['mycoll'][$k]['space']['imgurl2']="https://".$_SERVER['SERVER_NAME'].$res['mycoll'][$k]['space']['imgurl'];
        }
        $return['stu'] = '1';
        $return['res'] = $res;
        $this->ajaxReturn($return);
    }
    //收藏商品
    public function product(){
        $uid=I('post.uid');
        if(empty($uid)){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少重要参数';
            $this->ajaxReturn($return);
        }else{
            $when['c.uid']=$uid;
        }
        $when['c.type']=2;
        //参数获取
        $p = I('post.p');//页数
        if(empty($p)) $p = 1;
        $num=10;//每页数量
        $firstRow = ($p - 1) * $num;

        $res['mycoll']=M('coll')->
                table(array("xmb_coll"=>"c","xmb_goods"=>"s"))->
                field("c.*,s.id as sid")->
                where($when)->
                where("s.id=c.gid")->
                limit($firstRow, $num)->
                select();

        foreach($res['mycoll'] as $k=>$v){
            $res['mycoll'][$k]['goods']=M('goods')->where('id ='.$v['gid'])->find();
            $res['mycoll'][$k]['goods']['imgurl2']="https://".$_SERVER['SERVER_NAME'].$res['mycoll'][$k]['goods']['imgurl'];
        }

        $return['stu'] = '1';
        $return['res'] = $res;
        $this->ajaxReturn($return);
    }

    //收藏商品
    public function docoll(){
        $user['gid'] = I("post.gid");
        $user['uid']=I('post.uid');
        if(empty($user['gid'])||empty($user['uid'])){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少重要参数';
            $this->ajaxReturn($return);
        }
        $user['type']=2;
        $sou=M('coll')->where($user)->find();
        if($sou){
            $return['stu'] = '0';
            $return['code'] = '110';
            $return['msg'] = '该商品不能重复收藏';
            $this->ajaxReturn($return);
        } 
        $user['addtime']=time();
        $result = M("coll")->add($user);
        if($result !== false){
            $return['stu'] = '1';
            $return['res'] = $result;
            $this->ajaxReturn($return);
        }else{
            $return['stu'] = '0';
            $return['code'] = '109';
            $return['msg'] = '收藏失败';
            $this->ajaxReturn($return);
        }
    }
   //收藏办公空间
   public function docoll2(){
        $user['gid'] = I("post.gid");
        $user['uid']=I('post.uid');
        if(empty($user['gid'])||empty($user['uid'])){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少重要参数';
            $this->ajaxReturn($return);
        }
        $user['type']=1;
        $sou=M('coll')->where($user)->find();
        if($sou){
            $return['stu'] = '0';
            $return['code'] = '110';
            $return['msg'] = '不能重复收藏';
            $this->ajaxReturn($return);
        } 
        $user['addtime']=time();
        $result = M("coll")->add($user);
        if($result !== false){
            $return['stu'] = '1';
            $return['res'] = $result;
            $this->ajaxReturn($return);
        }else{
            $return['stu'] = '0';
            $return['code'] = '109';
            $return['msg'] = '收藏失败';
            $this->ajaxReturn($return);
        }
    }
    //删除收藏
    public function bucoll(){
        $when['id'] = I("post.id");
        $when['uid']=I("post.uid");
        if(empty($when['id'])||empty($when['uid'])){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少重要参数';
            $this->ajaxReturn($return);
        }
        $result = M("coll")->where($when)->delete();
        if($result){
            $return['stu'] = '1';
            $return['res'] = $result;
            $this->ajaxReturn($return);
        }else{
            $return['stu'] = '0';
            $return['code'] = '109';
            $return['msg'] = '取消收藏失败';
            $this->ajaxReturn($return);
        }
    }
    //批量
    public function delmuti(){
        $id = I('post.ids');
        $ids=explode(",",$id);
        $uid=I('post.uid');
        $where['id']=array('in',$ids);
        $where['uid'] =$uid;
        $news = M('coll')->where($where)->select();
        if(!$news){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '数据不存在';
            $this->ajaxReturn($return);
        }
        $result = M('coll')->where($where)->delete();
        if($result){
            $return['stu'] = '1';
            $return['msg'] = '删除成功！';
            $this->ajaxReturn($return);
        }else{
            $return['stu'] = '0';
            $return['code'] = '109';
            $return['msg'] = '删除失败！';
            $this->ajaxReturn($return);
        }
    }
 
}