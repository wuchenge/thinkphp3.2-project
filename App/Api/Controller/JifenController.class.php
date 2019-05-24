<?php
// 本类由系统自动生成，仅供测试用途
namespace Api\Controller;
use Think\Controller;
class JifenController extends Controller {
	//商品列表页面
    public function index(){
		$map['type']=2;
		$map['is_del']=-1;
		$map['is_up']=1;
		$orderstr="sort desc,addtime desc";
		//参数获取
		$p = I('post.p');//页数
		if(empty($p)) $p = 1;
		$num=10;//每页数量
		$firstRow = ($p - 1) * $num;

		$res['list']=M('goods')
					->where($map)
					->order($orderstr)
					->field("gname,xyjifen,guige,imgurl2,id,imgurl")
					->limit($firstRow, $num)
					->select();
		foreach ($res['list'] as  $k=>$v) {
			 $res['list'][$k]['imgs2']='https://'.$_SERVER['SERVER_NAME'].$v['imgurl'];
		}
		//首页的
		$res['sylist']=M('goods')->where($map)->order('sort desc,addtime desc')->limit(5)->select();
		//热销榜
		$res['hotlist']=M('goods')->where($map)->order('score desc ,sort desc,addtime desc')->limit(5)->select();
		foreach ($res['hotlist'] as  $k=>$v) {
			 $res['hotlist'][$k]['imgs2']='https://'.$_SERVER['SERVER_NAME'].$v['imgurl'];
		}
        $res['banner']=M('banner')->where('type=7')->select();
		foreach ($res['banner'] as $k=> $v){
              $res['banner'][$k]['img4']='https://'.$_SERVER['SERVER_NAME'].$v['img'];
        }
		$return['stu'] = '1';
		$return['res'] = $res;
		$this->ajaxReturn($return);
	}
	
    	//商品详情页面
    public function info(){
    	$id= trim(I("post.id/d"));
		$whe= '';
		$whe['id']=$id;
		$whe['is_del']=-1;
		$whe['is_up']=1;
		$res = M('goods')
			->field('gname,price,yprice,description,description2,description3,yunfei,yfmoney,jifen,nums,text,id,imgurl2,xyjifen,guige')
			->where($whe)
			->find();
		if(!$res){
            $return['stu'] = '0';
			$return['code'] = '111';
			$return['msg'] = '信息不存在';
			$this->ajaxReturn($return);
		}
		$uid=trim(I("post.uid/d"));
		if(!empty($uid)){
			$data['uid']=$uid;
			$data['gid']=$id;
			$collres=M('coll')->where($data)->find();
			if(empty($collres)){
				$res['is_coll']=0;
			}else{
				$res['is_coll']=1;
			}
		}else{
			$res['is_coll']=0;
		}
		$res['rollimg']=explode('|',$res['imgurl2']);
        foreach ($res['rollimg'] as $k=>$v) {
			$res['rollimg'][$k]='https://'.$_SERVER['SERVER_NAME'].$v;
		}
		
		$lujing="https://".$_SERVER['SERVER_NAME']."/ueditor";
		//详情里的图片
		$res['text']=str_replace("/ueditor",$lujing,$res['text']);
		//规格列表
		$res['guige']=explode('|',$res['guige']);
        //评价取出
		$res['count'] = M("pingjia")->where("gid=".$id)->count();//总个数
		$res['hcount'] = M("pingjia")->where("status =1 and gid=".$id)->count();//晒图
		$res['zcount'] = M("pingjia")->where("status =2 and gid=".$id)->count();//追评
		//参数获取
		$p = I('post.p');//页数
		if(empty($p)) $p = 1;
		$num=10;//每页数量
		$firstRow = ($p - 1) * $num;
        $w['gid'] =$id;
		$w['status'] = 1;
        $res['comments'] = M('pingjia')->where($w)->order("addtime desc")->limit($firstRow, $num)->select();
        foreach($res['comments'] as $k => $v){
			$user = M("user")->where("id=".$v['uid'])->find();
			$res['comments'][$k]['username'] = $user['uname'];
			$res['comments'][$k]['headimg'] = 'https://'.$_SERVER['SERVER_NAME'].$user['pic'];
		}
		$return['stu'] = '1';
		$return['res'] =$res;
		$this->ajaxReturn($return);

    }	
    	//立即购买,生成订单
	public function buy(){
		$uid=I('post.uid');
		if(!preg_match("/^[1-9]\d*$/", $_POST['gnum'])){
			$return['stu'] = '0';
			$return['code'] = '109';
			$return['msg'] = '请选择正确的数量';
			$this->ajaxReturn($return);
		}
		$goods = M("Goods")->where("is_del = -1 and id = ".$_POST['gid'])->find();
		if(!$goods){
			$return['stu'] = '0';
			$return['code'] = '110';
			$return['msg'] = '该产品不存在或已下架';
			$this->ajaxReturn($return);
		}
		if(empty($_POST['val'])){
			$return['stu'] = '0';
			$return['code'] = '111';
			$return['msg'] = '请选择商品规格';
			$this->ajaxReturn($return);
		}
		$order['orderid'] = date('YmdHis',time()).rand(1000,9999);
		$order['aid'] = $uid;
		$order['addtime'] = time();
		$order['amount'] = $_POST['gnum'];
		$order['totalprice'] =$goods['xyjifen']*$_POST['gnum'];
		$order['gid'] = $_POST['gid'];
		$order['val'] = $_POST['val'];
		$order['status'] =1;
		$order['ordertype'] =2;
		$result = M("Order")->add($order);
		if($result){
			$return['stu'] = '1';
			$return['code'] = $result;
			$return['msg'] = '提交成功，订单已生成！';
			$this->ajaxReturn($return);
		}else{
			$return['stu'] = '0';
			$return['code'] = '112';
			$return['msg'] = '对不起，操作失败';
			$this->ajaxReturn($return);
		}
	}
	public function order(){
		$id=I('post.id');
		$uid=I('post.uid');
		//订单
		$ding=M('order')->where('id='.$id)->find();
		$check_goods=M('goods')->where('id ='.$ding['gid'])->find();
		$goods1['title'] = $check_goods['gname'];
		$goods1['imgurl'] = "https://".$_SERVER['SERVER_NAME'].$check_goods['imgurl'];
		$goods1['amount'] = $ding['amount'];
		$goods1['val'] =$ding['val'];
		$goods1['price'] = $check_goods['xyjifen'];
		$res['goods']=$goods1;

		$ding['total']=$check_goods['xyjifen']*$ding['amount'];
        $res['ding']=$ding;
		//查看是否有发票
		$res['bill']=M('bill')->where('oid='.$id)->find();
		$res['addr']= M("address")->where("uid = ".$uid)->order("addtime desc")->limit(1)->find();

		$return['stu'] = '1';
		$return['res'] =$res;
		$this->ajaxReturn($return);
	}	

	//积分支付
  	public function payment(){
		$id = trim(I('post.id'));
		$uid = trim(I('post.uid'));
		$order = M("order")->where("aid = ".$uid." and id=".$id)->find();
		if(empty($order)){
			$return['stu'] = '0';
			$return['code'] = '108';
			$return['msg'] = '该订单不存在';
			$this->ajaxReturn($return);
		}
		//处理留言-地址-发票
		$liuyan=trim(I('post.liuyan'));
		if(!empty($liuyan)){
			$xiu['paybeizhu']=$liuyan;
		}
		$adid=trim(I('post.adid'));
		if(empty($adid)){
			$return['stu'] = '0';
			$return['code'] = '108';
			$return['msg'] = '请选择收货地址';
			$this->ajaxReturn($return);
		}else{
			$xiu['addressid']=$adid;
			$dizhi=M('address')->where('id='.$adid)->find();
			$xiu['addressman']=$dizhi['name'];
			$xiu['addressmobile']=$dizhi['tel'];
			$xiu['address']=$dizhi['sheng'].$dizhi['shi'].$dizhi['xian'].$dizhi['address'];
		}
        $is_fa=trim(I('post.is_fa'));
        if(!empty($is_fa)){
        	$xiu['is_fa']=$is_fa;
        	//判断是否添加发票
        	$fapiao=M('bill')->where('oid='.$id)->find();
        	if(empty($fapiao)){
        		$return['stu'] = '0';
				$return['code'] = '109';
				$return['msg'] = '您好没有填写发票';
				$this->ajaxReturn($return);
        	}
        }else{
        	$fapiao=M('bill')->where('oid='.$id)->delete();
        }
        $xiu['is_wan']=2;
        $result=M('order')->where('id='.$id)->save($xiu);
        $user=M('user')->where('id='.$uid)->find();
        if($user['integral']<$order['totalprice']){
        	    $return['stu'] = '0';
				$return['code'] = '110';
				$return['msg'] = '您的积分余额不足';
				$this->ajaxReturn($return);
        }
	    $p['oid'] = $order['id'];
		$p['orderid'] = $order['orderid'];
		$p['money'] = $order['totalprice'];
		$p['order_id'] = date('YmdHis',time()).rand(10000,99999);
		$result = M("pay_log")->add($p);

		$gid = $order['gid'];
		$data['title'] = M("goods")->where("id=".$gid)->getField('gname');
		$data['total'] = $order['totalprice'];
		$data['orderid'] = $p['order_id'];
		$content=date('Y-m-d H:i:s',time()).' '.'支付记录生成，支付方式：积分支付，订单号:'.$p['orderid'].'用户id:'.$order['aid'].'订单金额：'.$p['money']."\r\n";
			write_paylogs($p['orderid'],$content);

        $r = M("Order")->where("id = ".$id)->find();
			//业务逻辑此处写
			$content=date('Y-m-d H:i:s',time()).' '.'订单回调业务逻辑开启，订单号：'.$r['orderid']."\r\n";
			write_paylogs($r['orderid'],$content);
			$map['status']=2;
			$map['paytime']=time();
			$map['paytype']=4;
			$o_res=M("order")->where("id=".$id)->save($map);
			if($o_res){
				$content=date('Y-m-d H:i:s',time()).' '.'更改订单状态成功，订单号：'.$r['orderid']."\r\n";
				write_paylogs($r['orderid'],$content);
				$result=M('order')->where("id =".$id)->find();	

				$stimes=M('user')->where('id ='.$result['aid'])->setInc('sumtimes');
				$score=M('user')->where('id ='.$result['aid'])->setDec('integral',$result['totalprice']);
                $return['stu'] = '1';
				$return['msg'] = '积分支付成功';
				$this->ajaxReturn($return);
			}else{
				$content=date('Y-m-d H:i:s',time()).' '.'更改订单状态失败，订单号：'.$r['orderid']."\r\n";
				write_paylogs($r['orderid'],$content);
				$return['stu'] = '0';
				$return['code'] = '111';
				$return['msg'] = '积分支付失败';
				$this->ajaxReturn($return);
			}
			
	}
	//列表里积分兑换
	public function payment2(){
		$id = trim(I('post.id'));
		$uid = trim(I('post.uid'));
		$order = M("order")->where("aid = ".$uid." and id=".$id)->find();
		if(empty($order)){
			$return['stu'] = '0';
			$return['code'] = '108';
			$return['msg'] = '该订单不存在';
			$this->ajaxReturn($return);
		}
        $user=M('user')->where('id='.$uid)->find();
        if($user['integral']<$order['totalprice']){
        	    $return['stu'] = '0';
				$return['code'] = '110';
				$return['msg'] = '您的积分余额不足';
				$this->ajaxReturn($return);
        }
	    $p['oid'] = $order['id'];
		$p['orderid'] = $order['orderid'];
		$p['money'] = $order['totalprice'];
		$p['order_id'] = date('YmdHis',time()).rand(10000,99999);
		//$result = M("pay_log")->add($p);

		$gid = $order['gid'];
		$data['title'] = M("goods")->where("id=".$gid)->getField('gname');
		$data['total'] = $order['totalprice'];
		$data['orderid'] = $p['order_id'];
		$content=date('Y-m-d H:i:s',time()).' '.'支付记录生成，支付方式：积分支付，订单号:'.$p['orderid'].'用户id:'.$order['aid'].'订单金额：'.$p['money']."\r\n";
			write_paylogs($p['orderid'],$content);

        $r = M("Order")->where("id = ".$id)->find();
			//业务逻辑此处写
			$content=date('Y-m-d H:i:s',time()).' '.'订单回调业务逻辑开启，订单号：'.$r['orderid']."\r\n";
			write_paylogs($r['orderid'],$content);
			$map['status']=2;
			$map['paytime']=time();
			$map['paytype']=4;
			$o_res=M("order")->where("id=".$id)->save($map);
			if($o_res){
				$content=date('Y-m-d H:i:s',time()).' '.'更改订单状态成功，订单号：'.$r['orderid']."\r\n";
				write_paylogs($r['orderid'],$content);
				$result=M('order')->where("id =".$id)->find();	

				$stimes=M('user')->where('id ='.$result['aid'])->setInc('sumtimes');
				$score=M('user')->where('id ='.$result['aid'])->setDec('integral',$result['totalprice']);
                $return['stu'] = '1';
				$return['msg'] = '积分支付成功';
				$this->ajaxReturn($return);
			}else{
				$content=date('Y-m-d H:i:s',time()).' '.'更改订单状态失败，订单号：'.$r['orderid']."\r\n";
				write_paylogs($r['orderid'],$content);
				$return['stu'] = '0';
				$return['code'] = '111';
				$return['msg'] = '积分支付失败';
				$this->ajaxReturn($return);
			}
			
	}
}