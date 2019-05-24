<?php
namespace Api\Controller;
use Think\Controller;
class UserController extends Controller{
    //首页
    public function index(){
        $uid=I('post.uid');
        if(empty($uid)){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少重要参数';
            $this->ajaxReturn($return);
        }else{
            $where['uid']=$uid;
        }
        $res['user']= M("user")->
                where($where)->
                find();
        $res['user']['pic2']='https://'.$_SERVER['SERVER_NAME'].$res['user']['pic'];
        $return['stu'] = '1';
        $return['res'] = $res;
        $this->ajaxReturn($return);
        
    }
    //存入购物车
    public function addcart(){
        $gid=I('post.gid/d');
        $guige=I('post.guige');
        $gnum=I('post.gnum');
        $uid=I('post.uid');
        if(empty($gid)){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少商品id';
            $this->ajaxReturn($return);
        }
        if(empty($gnum)){
            $return['stu'] = '0';
            $return['code'] = '109';
            $return['msg'] = '缺少商品数量';
            $this->ajaxReturn($return);
        }
        if(empty($guige)){
            $return['stu'] = '0';
            $return['code'] = '112';
            $return['msg'] = '缺少商品规格';
            $this->ajaxReturn($return);
        }
        $map['gid']=$gid;
        $map['uid']=$uid;
        $cartM = M('cart');
        $cart_find=$cartM ->where($map)->find();
        if(!empty($cart_find)){
            $return['stu'] = '0';
            $return['code'] = '110';
            $return['msg'] = '商品已加入购物车';
            $this->ajaxReturn($return);
        }
        $map['num']=$gnum;
        $map['val']=$guige;
        $final=$cartM->add($map);
        if(empty($final)){
            $return['stu'] = '0';
            $return['code'] = '111';
            $return['msg'] = '商品加入购物车失败';
            $this->ajaxReturn($return);
        }else{
            $return['stu'] = '1';
            $return['res'] = $final;
            $this->ajaxReturn($return);
        }
        
    }
       
    //积分明细
    public function score(){
        //参数获取
        $p = I('post.p/d');//页数
        if(empty($p)) $p = 1;
        $num=10;//每页数量
        $firstRow = ($p - 1) * $num;
        
        $uid=I('post.uid');
        $map['uid']=$uid;
        $mx=M('pointmx')->where($map)->order('addtime desc')->limit($firstRow, $num)->select();
        $return['stu'] = '1';
        $return['res'] = $mx;
        $this->ajaxReturn($return);
    }
    //购物车
    public function cart(){
        $uid=I('post.uid');
        if(empty($uid)){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少重要参数';
            $this->ajaxReturn($return);
        }
        $goodsM = M('goods g');
        $clist = $goodsM->join(C('DB_PREFIX').'cart c on g.id=c.gid','LEFT')->where('c.uid="'.$uid.'" AND g.is_del =-1 AND g.is_up =1 ')->select();
        foreach($clist as $k=>$v){
				$res=M("goods")->where('id ='.$v['gid'])->find();
                $cart[$k]['price']=$res['price'];
                $cart[$k]['nums']=$res['nums'];
                $cart[$k]['gname']=$res['gname'];
                $cart[$k]['imgurl']='https://'.$_SERVER['SERVER_NAME'].$res['imgurl'];
                $cart[$k]['id']=$v['id'];
                $cart[$k]['gid']=$v['gid'];
                $cart[$k]['num']=$v['num'];
                $cart[$k]['guige']=$v['val'];
		}
        $return['stu'] = '1';
        $return['res'] = $cart;
        $this->ajaxReturn($return);
    }

    //商品移除购物车
    public function cartdel(){
        $id=I('post.id');
        $uid=I('post.uid');
        if(empty($id)||empty($uid)){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '缺少重要参数';
            $this->ajaxReturn($return);
        }
        $ids=explode(",",$id);
        //$this->ajaxReturn($ids);
        $where['id'] = array('in',$ids);
        $where['uid'] =$uid;
        $result=M('cart')->where($where)->find();
        if(!$result){
            $return['stu'] = '0';
            $return['code'] = '109';
            $return['msg'] = '该商品已移除购物车';
            $this->ajaxReturn($return);
        }
        $fina=M('cart')->where($where)->delete();
        if($fina){
            $return['stu'] = '1';
            $this->ajaxReturn($return);
        }else{
            $return['stu'] = '0';
            $return['code'] = '110';
            $return['msg'] = '移除购物车失败';
            $this->ajaxReturn($return);
        }
        
    }

    //批量删除购物车产品
    public function mitudel(){
        $uid=I('post.uid');
        $where['uid'] = $uid;
        $cart = M("Cart")->where($where)->select();
        if(!$cart){
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '数据不存在';
            $this->ajaxReturn($return);
        }
        $result = M("Cart")->where($where)->delete();
        if($result){
            $return['stu'] = '1';
            $return['res'] = $result;
            $return['msg'] = '删除成功！';
            $this->ajaxReturn($return);
        }else{
            $return['stu'] = '0';
            $return['code'] = '108';
            $return['msg'] = '删除失败！';
            $this->ajaxReturn($return);
        }
    }

 
}