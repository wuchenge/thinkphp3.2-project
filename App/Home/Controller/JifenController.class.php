<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class JifenController extends BaseController {
	//商品列表页面
    public function index(){
		$title=I('get.title');
		//搜索条件
		if(!empty($title)){
			$map['gname']=array('like','%'.$title.'%');
		}
		$map['type']=2;
		$map['is_del']=-1;
		$map['is_up']=1;
		$orderstr="sort desc,addtime desc";
		$count = M("goods")->where($map)->count();// 查询满足要求的总记录数
		$Page  = new \Think\Page($count,4);// 实例化分页类 传入总记录数和每页显示的记录数
		$show  = $Page->show();// 分页显示输出
		$list=M('goods')->where($map)->order($orderstr)->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach ($list as  $k=>$v) {
			 $list[$k]['imgs']=explode('|',$v['imgurl2']);
		}
		$top='积分商城';
		//首页的
		$sylist=M('goods')->where($map)->order('sort desc,addtime desc')->limit(5)->select();
		$this->assign('sylist',$sylist);
		//热销榜
		$hotlist=M('goods')->where($map)->order('score desc ,sort desc,addtime desc')->limit(5)->select();
		$this->assign('hotlist',$hotlist);
		$banner=M('banner')->where('type=7')->select();
		$this->assign('banner',$banner);
		$this->assign('count',$count);
		$this->assign('list',$list);
		$this->assign('top',$top);
		$this->assign('page',$show);
		$this->display();
	}
	
	//商品详情页面
    public function info(){
		//判断id参数
		$id=intval(I('get.id'));
		$result=M('goods')->where('id ='.$id.' AND is_del =-1 AND is_up =1 ')->find();
		if(!$result){
			$this->error('该商品不存在',U('aegis/index'));
		}
		if(!empty($_SESSION['uid'])){
			$data['uid']=$_SESSION['uid'];
			$data['gid']=$id;
			$collres=M('coll')->where($data)->find();
			if(empty($collres)){
				$result['is_coll']=0;
			}else{
				$result['is_coll']=1;
			}
		}else{
			$result['is_coll']=0;
		}
		$rollimg=explode('|',$result['imgurl2']);
		array_unshift($rollimg,$result['imgurl']);
		//评价取出
		$c['count'] = M("pingjia")->where("gid=".$_GET['id'])->count();//总个数
		$c['hcount'] = M("pingjia")->where("status =1 and gid=".$_GET['id'])->count();//晒图
		$c['zcount'] = M("pingjia")->where("status =2 and gid=".$_GET['id'])->count();//追评
		$w['gid'] = $_GET['id'];
		$ping=$_GET['ping'];
		if($ping==1){
           $w['status'] = 1;
		}elseif($ping==2){
           $w['status'] = 2;
		}
		//判断排序规则
		if($_GET['pai']==1){
             $orderstr="score desc,addtime desc";
		}else{
             $orderstr="addtime desc,score desc";
		}
		$count=M('pingjia')->where($w)->count();
		$Page = new \Think\Page($count,8);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$comments = M('pingjia')->where($w)->order($orderstr)->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($comments as $k => $v){
			$user = M("user")->where("id=".$v['uid'])->find();
			$comments[$k]['username'] = $user['uname'];
			$comments[$k]['headimg'] = $user['pic'];
		}
		//规格列表
		$guige=explode('|',$result['guige']);
		$this->assign('guige',$guige);
		$this->assign('top',$result['gname']);
		$this->assign('result',$result);
		$this->assign('rollimg',$rollimg);
		$this->assign('comments', $comments);
		$this->assign('count', $c);
		$this->display();
	}
	
	
	//立即购买,生成订单
	public function buy(){
		if(empty($_SESSION['uid'])){
			$data['status'] = 0;
			$data['msg'] = "请您先登录";
			$this->ajaxReturn($data);
		}
		if(!preg_match("/^[1-9]\d*$/", $_POST['gnum'])){
			$data['status'] = 0;
			$data['msg'] = "请选择正确的数量";
			$this->ajaxReturn($data);
		}
		$goods = M("Goods")->where("is_del = -1 and id = ".$_POST['gid'])->find();
		if(!$goods){
			$data['status'] = 0;
			$data['msg'] = "该产品不存在";
			$this->ajaxReturn($data);
		}
		if(empty($_POST['val'])){
			$data['status'] = 0;
			$data['msg'] = "请选择商品规格";
			$this->ajaxReturn($data);
		}
		$order['orderid'] = date('YmdHis',time()).rand(1000,9999);
		$order['aid'] = $_SESSION['uid'];
		$order['addtime'] = time();
		$order['amount'] = $_POST['gnum'];
		$order['totalprice'] =$goods['xyjifen']*$_POST['gnum'];
		$order['gid'] = $_POST['gid'];
		$order['val'] = $_POST['val'];
		$order['status'] =1;
		$order['ordertype'] =2;
		$result = M("Order")->add($order);
		if($result){
			$data['status'] = 1;
			$data['id'] = $result;
			$data['msg'] = "提交成功，订单已生成！";
			$this->ajaxReturn($data);
		}else{
			$data['status'] = 0;
			$data['msg'] = "对不起，操作失败";
			$this->ajaxReturn($data);
		}
	}
	public function order(){
		$id=I('get.id');
		//订单
		$ding=M('order')->where('id='.$id)->find();
		$check_goods=M('goods')->where('id ='.$ding['gid'])->find();
		$goods1['title'] = $check_goods['gname'];
		$goods1['imgurl'] = $check_goods['imgurl'];
		$goods1['amount'] = $ding['amount'];
		$goods1['val'] =$ding['val'];
		$goods1['price'] = $check_goods['xyjifen'];
		$order['total']=$check_goods['xyjifen']*$ding['amount'];

		$goods=$goods1;
		$quick['amount']=$ding['amount'];
		$quick['id']=$id;
		$quick['val']=$ding['val'];
		$this->assign('quick',$quick);

		//查看是否有发票
		$bill=M('bill')->where('oid='.$id)->find();
		$this->assign('bill',$bill);
		$user = M("user")->where("id=".$_SESSION['uid'])->find();
		$address = M("address")->where("uid = ".$_SESSION['uid'])->order("is_default desc,addtime desc")->select();
		$addr = M("address")->where("uid = ".$_SESSION['uid'])->order("is_default desc,addtime desc")->limit(1)->find();
		$this->assign('addr',$addr);//默认地址id
		$this->assign('user',$user);
		$this->assign('amount',$amount);
		$this->assign('order',$order);
		$this->assign('goods',$goods);
		$this->assign('address',$address);
		$this->display();
	}	

	//积分支付
  	public function payment(){
		$id = trim(I('post.id'));
		$order = M("order")->where("aid = ".$_SESSION['uid']." and id=".$id)->find();
		if(empty($order)){
			$this->error('该订单不存在');
		}
		//处理留言-地址-发票
		$liuyan=trim(I('post.liuyan'));
		if(!empty($liuyan)){
			$xiu['paybeizhu']=$liuyan;
		}
		$adid=trim(I('post.adid'));
		if(empty($adid)){
             $this->error('请选择收货地址');
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
                 $this->error('您好没有填写发票');
        	}
        }else{
        	$fapiao=M('bill')->where('oid='.$id)->delete();
        }
        $xiu['is_wan']=2;
        $result=M('order')->where('id='.$id)->save($xiu);
        $user=M('user')->where('id='.$_SESSION['uid'])->find();
        if($user['integral']<$order['totalprice']){
             $this->error('您的积分余额不足');
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
		$content=date('Y-m-d H:i:s',time()).' '.'支付记录生成，支付方式：支付宝支付，订单号:'.$p['orderid'].'用户id:'.$order['aid'].'订单金额：'.$p['money']."\r\n";
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

				$this->success('积分支付成功',U('order/index'));
			}else{
				$content=date('Y-m-d H:i:s',time()).' '.'更改订单状态失败，订单号：'.$r['orderid']."\r\n";
				write_paylogs($r['orderid'],$content);
				$this->error('积分支付成功');
			}
			
	}
}