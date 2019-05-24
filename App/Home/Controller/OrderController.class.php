<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class OrderController extends UserbaseController {
	//订单列表
    public function index(){
		$top="订单列表";
		$st=I('get.st');
		if(empty($st)){
			$map['status']=array('not in','0,-1');
		}else{
			if($st == "complited"){
				$map['status']=array('in','4,5');
			}else{
				$map['status']=$st;
			}
		}
		$key=I('get.key');
		if(empty($key)){
			$map['orderid']=array('like', '%' .$key. '%');
		}
		$map['aid']=$_SESSION['uid'];
		$map['is_wan']=2;
		$count=M('order')->where($map)->count();
		$Page = new \Think\Hpage($count,6);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$result=M('order')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
		foreach($result as $k => $v){
			$res=array();
			$gid=array();
			$ggid=array();
			$color=array();
			$price=array();
			$gid=explode(',',$v['gid']);
			$ggname=explode(',',$v['val']);
			$price=explode(',',$v['price']);
			$amount=explode(',',$v['amount']);
			foreach($gid as $key => $val){
				$rul=M('goods')->where('id ='.$val)->find();
				$res[$key]['gid']=$val;//无法跳详情解决
				$res[$key]['gname']=$rul['gname'];
				$res[$key]['gurl']=$rul['imgurl'];
				$res[$key]['ggname']=$ggname[$key];
				$res[$key]['price']=$price[$key];
				$res[$key]['amount']=$amount[$key];
				$res[$key]['gtype']=$rul['type'];
			}
			//一个订单中的数量
			$result[$k]['geshu']=count($gid);
			$result[$k]['res']=$res;
			$zt=$v['status'];
			switch($zt){
				case 1:
					$result[$k]['zt']="等待付款";
					break;

				case 2:
					$result[$k]['zt']="等待发货";
					break;

				case 3:
					$result[$k]['zt']="已发货";
					break;

				case 4:
					$result[$k]['zt']="待评价";
					break;

				case 5:
					$result[$k]['zt']="交易完成";
					break;

				case -1:
					$result[$k]['zt']="订单取消";
					break;

				case -2:
					$result[$k]['zt']="退货";
					break;

				case -3:
					$result[$k]['zt']="换货";
					break;
			}
		}
		//判断是手机还是pc
		$agent = $_SERVER['HTTP_USER_AGENT'];
		if(strpos($agent, 'iPhone') || strpos($agent, 'Android')){
			$is_pc=1;
			$this->assign('is_pc','1');
		}else{
			$is_pc=2;
			$this->assign('is_pc','2');
		}
		$this->assign('top',$top);
		$this->assign('st',$st);
		$this->assign('result',$result);
		$this->assign('page',$show);
		$this->display();
	}
	
	//立即购买,生成订单
	public function buy(){
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
		$order['totalprice'] = $goods['price']*$_POST['gnum']+$goods['yfmoney'];
		$order['score'] = $goods['jifen']*$_POST['gnum'];
		$order['price'] = $goods['price'];
		$order['gid'] = $_POST['gid'];
		$order['val'] = $_POST['val'];
		$order['yunfei'] = $goods['yfmoney'];
		$order['status'] =1;
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
   	//购物车购买,生成订单
	public function cartbuy(){
		//商品的数量集合
		$at=ltrim($_POST['at'],",");
		//购物车的id集合
		$gd=ltrim($_POST['gd'],",");
		//dump($gd);die;
		if(empty($gd)){
			$data['status'] = 0;
			$data['msg'] = "商品不能为空";
			$this->ajaxReturn($data);
		}
		$gids=explode(',',$gd);
		$jihe=array();
		//dump($gids);die;
		foreach($gids as $k => $v){
			//dump($v);
			$cart=M('cart')->where('id='.$v)->find();
			//dump($cart);
            $goods=M('goods')->where('id='.$cart['gid'])->find();
            //集合
			$totalprice=$goods['price']*$at[$k]+$goods['yfmoney'];
			$order['totalprice'] +=$totalprice;
			//运费计算
			$order['yunfei'] +=$goods['yfmoney'];
			//积分计算
			$totalscore=$goods['jifen']*$at[$k];
			$order['score'] +=$totalscore;
			$oprice.=$goods['price'].',';
			$ogid.=$goods['id'].',';
			$oval.=$cart['val'].',';
		}
          
		$order['price'] =trim($oprice,",");
		$order['gid'] =trim($ogid,",");
		$order['val'] =trim($oval,",");
		$order['orderid'] = date('YmdHis',time()).rand(1000,9999);
		$order['aid'] = $_SESSION['uid'];
		$order['addtime'] = time();
		$order['amount'] =$at;
		$order['status'] =1;
		$result = M("Order")->add($order);
		// //删除购物车里的商品
		// $tiao['id']=array('in',$gd);
		// $result2 = M("cart")->where($tiao)->delete();
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
	// //订单支付
	// public function pay(){
	// 	$top="确认支付";
	// 	$map['id']=I('get.id');
	// 	$map['aid']=$_SESSION['uid'];
	// 	$order=M('order')->where($map)->find();
	// 	if(!empty($order)){
	// 		if($order['status'] != 1){
	// 			$this->error('该订单已支付或者已取消');
	// 		}
	// 		if(time() > $order['addtime']+3600){

	// 			$m=M('order');
	// 			$order_id = $m->where('id='.$map['id'])->getField('orderid');
	// 			$reason="超期付款，返回余额-订单ID：".$order_id;
	// 			$m->startTrans();
	// 			$o_res=$m->where('id ='.$order['id'])->setField('status',-1);
	// 			if($o_res === false){
	// 				$m->rollback();
	// 				$this->error('订单取消失败');
	// 			}
	// 			$u_res=M('user')->where('id ='.$_SESSION['uid'])->setInc('balance',$order['remain']);
	// 			if($u_res === false){
	// 				$m->rollback();
	// 				$this->error('余额恢复失败');
	// 			}
	// 			$money_res=add_moneymx($_SESSION['uid'],$reason,$order['remain']);
	// 			if(!$money_res){
	// 				$m->rollback();
	// 				$this->error('财务明细生成失败');
	// 			}
	// 			$cart_array=explode(',',$order['gid']);
	// 			$norm_array=explode(',',$order['nid']);
	// 			$amount_array=explode(',',$order['amount']);
	// 			foreach($cart_array as $k=>$v){
	// 				$check_goods=M('goods')->where('id ='.$v)->find();
	// 				if(!empty($check_goods)){
	// 					if($check_goods['is_norm'] == 1){
	// 						$map=array();
	// 						$map['gid']=$check_goods['id'];
	// 						$nid_array=array();
	// 						$nid_array=explode('|',$norm_array[$k]);
	// 						foreach($nid_array as $key =>$val){
	// 							$map['nt'.$key]=$val;
	// 						}
	// 						$pn=M('goodsnormpn')->where($map)->find();
	// 						if(!empty($pn)){
	// 							$gpn=M('goodsnormpn')->where($map)->setInc('nums',$amount_array[$k]);
	// 							if($gpn === false){
	// 								$m->rollback();
	// 								$this->error('库存修改失败');
	// 							}
	// 						}
	// 					}else{
	// 						$gpn=M('goods')->where('id ='.$v)->setInc('nums',$amount_array[$k]);
	// 						if($gpn === false){
	// 							$m->rollback();
	// 							$this->error('库存修改失败');
	// 						}
	// 					}
	// 				}
	// 			}
	// 			$m->commit();
	// 			$this->error('订单已过期，余额已返还到账户');
	// 		}
	// 		$this->assign('top',$top);
	// 		$order['sxtime'] = $order['addtime']+3600;
	// 		$this->assign('order',$order);
	// 		$this->assign('user',$user);
	// 		$this->display();
	// 	}else{
	// 		$this->error('该订单不存在');
	// 	}
	// }
    //消息列表
   public function mglist(){
    	$when['uid']=$_SESSION['uid'];
        $count=M('orderlog')->where($when)->count();
		$Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$list=M('orderlog')->where($when)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
		foreach ($list as $k => $v) {
			$list[$k]['orderid']=M('order')->where('id='.$v['oid'])->getField('orderid');
		}
		$this->assign("list",$list);
		$this->assign('page',$show);
		$this->display();	
   }
	//订单详情
	public function info(){
		//判断id参数
		$id=intval(I('get.id'));
		$result=M('order')->where('id ='.$id)->find();
		if(!$result){
			$this->error('订单不存在');
		}
		switch($result['status']){
			case 1:
				$result['zt']="等待付款";
				break;
			case 2:
				$result['zt']="等待发货";
				break;
			case 3:
				$result['zt']="已发货";
				break;
			case 4:
				$result['zt']="待评价";
				break;
			case 5:
				$result['zt']="交易完成";
				break;
			case -1:
				$result['zt']="订单取消";
				break;
			case -2:
				$result['zt']="退货";
				break;
			case -3:
				$result['zt']="换货";
				break;
		}

		$gid=explode(',',$result['gid']);
		$ggid=explode(',',$result['nid']);
		$valn=explode(',',$result['val']);//规格
		$color=explode(',',$result['color']);
		$price=explode(',',$result['price']);
		$amount=explode(',',$result['amount']);
		$unusual=explode(',',$result['unusual']);
		$pingjia=explode(',',$result['pingjia']);
		$sun=array_search('1',$unusual);//订单详情页面显示出确认收货按钮
		if($sun === false){
			$result['sun']=1;
		}else{
			$result['sun']=2;
		}
		$num=0;
		foreach($gid as $key => $val){
			$rul=M('goods')->where('id ='.$val)->find();
			$res[$key]['gid']=$rul['id'];
			$res[$key]['val']=$valn[$key];//规格值
			$res[$key]['uid']=$_SESSION['uid'];
			$res[$key]['bid']=$id;
			$res[$key]['gname']=$rul['gname'];
			$res[$key]['gurl']=$rul['imgurl'];
			$res[$key]['price']=$price[$key];
			$res[$key]['amount']=$amount[$key];
			$res[$key]['unusual']=$unusual[$key];
			$res[$key]['pingjia']=$pingjia[$key];
			$res[$key]['status']=$result['status'];
			$num=$num+1;
			$late[$key]=$res[$key]['price']*$res[$key]['amount'];
		}
		$result['gnum']=$num;
		$prevtotal=array_sum($late);
		$result['prevtotal']=$prevtotal;
		$this->assign('top',$top);
		$config=M('config')->find(1);
		$this->assign('config',$config);
		//发票信息
		if($result['is_fa']=1){
			$bill=M('bill')->where('oid='.$result['id'])->find();
			$this->assign('bill',$bill);
		}
		$this->assign('result',$result);
		$this->assign('res',$res);
		$this->display();
	}
	//取消订单
	public function billdel(){
		$id=I('post.id');
		$order=M('order')->where('id ='.$id)->find();
		if($order['status'] !=1){
			$data['status']=0;
			$data['msg']='订单无法取消';
			$this->ajaxReturn($data);
		}
		$m=M('order');
		$m->startTrans();
		$o_res=$m->where('id ='.$order['id'])->setField('status',-1);
		if($o_res === false){
			$m->rollback();
			$data['status']=0;
			$data['msg']='订单取消失败';
			$this->ajaxReturn($data);
		}
		$m->commit();
		$data['status']=1;
		$data['msg']='订单取消成功';
		$this->ajaxReturn($data);
	}

	//确认收货
	public function confirmbill(){
		$id=I('post.id');
		if(empty($id)){
			$data['status']=0;
			$data['msg']='缺少必要参数';
			$this->ajaxReturn($data);
		}
		$st=M('order')->where('id ='.$id)->getField('status');
		if($st == 4){
			$data['status']=0;
			$data['msg']='订单已经确认收货';
			$this->ajaxReturn($data);
		}
		$map['status']=4;
		$map['shtime']=time();
		$re=M('order')->where('id ='.$id)->save($map);
		if($re){
			$data['status']=1;
			$data['msg']='确认收货';
			$this->ajaxReturn($data);
		}else{
			$data['status']=0;
			$data['msg']='确认收货失败';
			$this->ajaxReturn($data);
		}
	}
	// //商品评论
	// public function comments(){
	// 	if(empty($_POST['content'])){
	// 		$this->error('请输入要评论的内容');
	// 	}
	// 	$a = array(0,1,2,3,4,5);
	// 	if(!in_array($_POST['score'],$a)){
	// 		$this->error('参数错误');
	// 	}
	// 	$g = M('Goods')->where('id='.$_POST['gid'])->find();
	// 	if(empty($g)){
	// 		$this->error('你要评论的商品不存在');
	// 	}
	// 	$o = M('order')->where('id='.$_POST['oid'])->find();
	// 	if(empty($o)){
	// 		$this->error('你要评论的商品订单不存在');
	// 	}
	// 	$c = M('comments');
	// 	$_POST['imgurl']=implode('|',$_POST['imgurl']);
	// 	$c->create();
	// 	$c->addtime = time();
	// 	$c->uid = $_SESSION['uid'];
	// 	$result = $c->add();
	// 	if($result){
	// 		$this->success('评论成功',U('order/index'));
	// 	}else{
	// 		$this->success('评论失败',U('order/index'));
	// 	}
	// }

    //修改发票
	public function xiubill(){
		$id = I("post.id");
		$bill = M("bill")->where("id = ".$id)->find();
		$data['bill']=$bill;
		$this->ajaxReturn($data);
	}
	//发票保存实现
    public function dobill(){
        if(empty($_POST['btitle'])){
            $data['status'] = 0;
            $data['msg'] = "请输入发票抬头";
            $this->ajaxReturn($data);
        }
        if(empty($_POST['btel'])){
            $data['status'] = 0;
            $data['msg'] = "请输入收票手机";
            $this->ajaxReturn($data);
        }
        if(!preg_match("/^1[3|4|5|7|8][0-9]\d{8}$/",$_POST['btel'])){
            $data['status'] = 0;
            $data['msg'] = "请输入正确的手机号码！";
            $this->ajaxReturn($data);
        }
        if(empty($_POST['bemail'])){
            $data['status'] = 0;
            $data['msg'] = "请输入收票邮箱";
            $this->ajaxReturn($data);
        }
        $oid = trim(I("post.oid"));
        $billid = trim(I("post.billid"));
        if(empty($billid)){
            $addr = M("bill");
            $addr->create();
            $addr->title = $_POST['btitle'];
            $suinum=I("post.bsuihao");
            if(!empty($suinum)){
              $addr->suinum=$suinum;
              $addr->type=2;
            }else{
            	$addr->type=1;
            }
            $addr->tel =I("post.btel"); 
            $addr->email=I("post.bemail");
            $addr->oid=$oid;
            $addr->addtime = time();
            $result = $addr->add();
            if($result){
                $data['status'] = 1;
                $data['msg'] = "新增成功！";
                $this->ajaxReturn($data);
            }else{
                $data['status'] = 0;
                $data['msg'] = "新增失败！";
                $this->ajaxReturn($data);
            }
        }else{
            $address = M("bill")->where("id = ".$billid)->find();
            if(empty($address)){
                $data['status'] = 0;
                $data['msg'] = "该数据不存在";
                $this->ajaxReturn($data);
            }
            $addr = M("bill");
            $addr->create();
            $addr->title = $_POST['btitle'];
            $suinum=I("post.bsuihao");
            if(!empty($suinum)){
              $addr->suinum=$suinum;
              $addr->type=2;
            }else{
            	$addr->type=1;
            }
            $addr->tel =I("post.btel"); 
            $addr->email=I("post.bemail");
            $addr->oid=$oid;
            $addr->id=$$billid;
            $result = $addr->save();
            if($result !== false){
                $data['status'] = 1;
                $data['msg'] = "修改成功！";
                $this->ajaxReturn($data);
            }else{
                $data['status'] = 0;
                $data['msg'] = "修改失败！";
                $this->ajaxReturn($data);
            }
        }
    }
	//填写核对订单
	public function order(){
		if($_GET['quick'] == 1){
			//订单的id
			$id=I('get.id');
			//订单
			$ding=M('order')->where('id='.$id)->find();
			$check_goods=M('goods')->where('id ='.$ding['gid'])->find();
			$goods1['title'] = $check_goods['gname'];
			$goods1['imgurl'] = $check_goods['imgurl'];
			$goods1['amount'] = $ding['amount'];
			$goods1['val'] =$ding['val'];
			$goods1['price'] = $check_goods['price'];
			$goods1['yunfei']=$ding['yunfei'];
			$order['total']=$check_goods['price']*$ding['amount'];

			$goods[]=$goods1;
			$quick['amount']=$ding['amount'];
			$quick['id']=$id;
			$quick['val']=$ding['val'];
			$this->assign('quick',$quick);
		}else{
			$id=I('get.id');
			$quick['id']=$id;
			$this->assign('quick',$quick);
			//订单
			$gwc=M('order')->where('id='.$id)->find();
			$cart_array=explode(',',$gwc['gid']);
			$amount_array=explode(',',$gwc['amount']);
			$order['total'] = 0;
			foreach($cart_array as $k=>$v){
				$check_goods=M('goods')->where('id ='.$v)->find();
				if(($check_goods['is_up'] == -1) || ($check_goods['is_del'] == 1) ){
					$this->error('该商品已下架或已删除');
				}
				$goods[$k]['yunfei'] = $check_goods['yfmoney'];
				$goods[$k]['title'] = $check_goods['gname'];
				$goods[$k]['imgurl'] = $check_goods['imgurl'];
				$goods[$k]['amount'] = $amount_array[$k];
				$goods[$k]['price'] = $check_goods['price'];
				$order['total']=$order['total']+$goods[$k]['price']*$goods[$k]['amount'];
			}
		}
		//判断是手机还是pc
		$agent = $_SERVER['HTTP_USER_AGENT'];
		if(strpos($agent, 'iPhone') || strpos($agent, 'Android')){
			$is_pc=1;
			$this->assign('is_pc','1');
		}else{
			$is_pc=2;
			$this->assign('is_pc','2');
		}
		//查看是否有发票
		$bill=M('bill')->where('oid='.$id)->find();
		$this->assign('bill',$bill);
		$user = M("user")->where("id=".$_SESSION['uid'])->find();
		$address = M("address")->where("uid = ".$_SESSION['uid'])->order("is_default desc,addtime desc")->select();
		$addr = M("address")->where("uid = ".$_SESSION['uid'])->order("is_default desc,addtime desc")->limit(1)->find();
		//默认地址id
		$top='提交订单';
		$this->assign('top',$top);
		$this->assign('ucoup',$ucoup);
		$this->assign('user',$user);
		$this->assign('cart',$cart);
		$this->assign('discount',$dis_res/100);
		$this->assign('amount',$amount);
		$this->assign('order',$order);
		$this->assign('goods',$goods);
		$this->assign('address',$address);
		$this->assign('addr',$addr);//默认地址id
		$this->display();
	}
	
	//第三方支付方法
	public function payment(){
		$payment = 1;
		$id = trim(I('post.id'));
		$a = array(1,2,3);
		if(!in_array($payment,$a)){
			$this->error('您选择的支付方式不存在');
		}
		$order = M("order")->where("aid = ".$_SESSION['uid']." and id=".$id)->find();
		if(empty($order)){
			$this->error('该订单不存在');
		}
		//删除购物车里的列表
		$cha['uid']=$_SESSION['uid'];
		$gids=explode(',',$order['gid']);
		$cha['gid']=array('in',$gids);
		$jieguo=M('cart')->where($cha)->find();
		if($jieguo){
			$jieguo2=M('cart')->where($cha)->delete();
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
        //判断是否选择地址等资料
        $xiu['is_wan']=2;
        $result2=M('order')->where('id='.$id)->save($xiu);
		switch($payment){
			case 1:
				$p['oid'] = $order['id'];
				$p['orderid'] = $order['orderid'];
				$p['money'] = $order['totalprice'];
				$p['order_id'] = date('YmdHis',time()).rand(10000,99999);
				$result = M("pay_log")->add($p);
				if(!empty($result)){
					$gid = explode(',',$order['gid']);
					$data['title'] = M("goods")->where("id=".$gid[0])->getField('gname');
					//$data['total'] = $order['online'];
					$data['total'] = $order['totalprice'];
					$data['orderid'] = $p['order_id'];
					$content=date('Y-m-d H:i:s',time()).' '.'支付记录生成，支付方式：支付宝支付，订单号:'.$p['orderid'].'用户id:'.$order['aid'].'订单金额：'.$p['money']."\r\n";
					write_paylogs($p['orderid'],$content);
					alipay($data);
				}else{
					$content=date('Y-m-d H:i:s',time()).' '.'支付记录生成失败，支付方式：支付宝支付，订单号:'.$p['orderid'].'用户id:'.$order['aid'].'订单金额：'.$p['money']."\r\n";
					write_paylogs($p['orderid'],$content);
					$this->error('网络异常，请稍候操作');
				}
				break;
		}
	}
	//第三方支付方法
	public function payment2(){
		$payment = 1;
		$id = I('get.id');
		$order = M("order")->where("aid = ".$_SESSION['uid']." and id=".$id)->find();
		if(empty($order)){
			$this->error('该订单不存在');
		}
		switch($payment){
			case 1:
				$p['oid'] = $order['id'];
				$p['orderid'] = $order['orderid'];
				$p['money'] = $order['totalprice'];
				$p['order_id'] = date('YmdHis',time()).rand(10000,99999);
				$result = M("pay_log")->add($p);
				if(!empty($result)){
					$gid = explode(',',$order['gid']);
					$data['title'] = M("goods")->where("id=".$gid[0])->getField('gname');
					//$data['total'] = $order['online'];
					$data['total'] = $order['totalprice'];
					$data['orderid'] = $p['order_id'];
					$content=date('Y-m-d H:i:s',time()).' '.'支付记录生成，支付方式：支付宝支付，订单号:'.$p['orderid'].'用户id:'.$order['aid'].'订单金额：'.$p['money']."\r\n";
					write_paylogs($p['orderid'],$content);
					alipay($data);
				}else{
					$content=date('Y-m-d H:i:s',time()).' '.'支付记录生成失败，支付方式：支付宝支付，订单号:'.$p['orderid'].'用户id:'.$order['aid'].'订单金额：'.$p['money']."\r\n";
					write_paylogs($p['orderid'],$content);
					$this->error('网络异常，请稍候操作');
				}
				break;
		}
	}
   //手机支付宝支付
	public function mpayment(){
		$payment = 1;
		$id = trim(I('post.id'));
		$a = array(1,2,3);
		if(!in_array($payment,$a)){
			$this->error('您选择的支付方式不存在');
		}
		$order = M("order")->where("aid = ".$_SESSION['uid']." and id=".$id)->find();
		if(empty($order)){
			$this->error('该订单不存在');
		}
		//删除购物车里的列表
		$cha['uid']=$_SESSION['uid'];
		$gids=explode(',',$order['gid']);
		$cha['gid']=array('in',$gids);
		$jieguo=M('cart')->where($cha)->find();
		if($jieguo){
			$jieguo2=M('cart')->where($cha)->delete();
		}
		//处理留言-地址-发票
		$liuyan=trim(I('post.liuyan'));
		if(!empty($liuyan)){
			$xiu['paybeizhu']=$liuyan;
		}
		$adid=trim(I('post.adid'));
		//$xiu['addressid']=$adid;
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
        //判断是否选择地址等资料
        $xiu['is_wan']=2;
        $result2=M('order')->where('id='.$id)->save($xiu);
		switch($payment){
			case 1:
				$p['oid'] = $order['id'];
				$p['orderid'] = $order['orderid'];
				$p['money'] = $order['totalprice'];
				$p['order_id'] = date('YmdHis',time()).rand(10000,99999);
				$result = M("pay_log")->add($p);
				if(!empty($result)){
					$gid = explode(',',$order['gid']);
					$data['title'] = M("goods")->where("id=".$gid[0])->getField('gname');
					//$data['total'] = $order['online'];
					$data['total'] = $order['totalprice'];
					$data['orderid'] = $p['order_id'];
					$content=date('Y-m-d H:i:s',time()).' '.'支付记录生成，支付方式：支付宝支付，订单号:'.$p['orderid'].'用户id:'.$order['aid'].'订单金额：'.$p['money']."\r\n";
					write_paylogs($p['orderid'],$content);
			        webalipay($data);
				}else{
					$content=date('Y-m-d H:i:s',time()).' '.'支付记录生成失败，支付方式：支付宝支付，订单号:'.$p['orderid'].'用户id:'.$order['aid'].'订单金额：'.$p['money']."\r\n";
					write_paylogs($p['orderid'],$content);
					$this->error('网络异常，请稍候操作');
				}
				break;
		}
	}
	//手机支付宝支付--订单表里的
	public function mpayment2(){
		$payment = 1;
		$id = trim(I('get.id'));
		$order = M("order")->where("aid = ".$_SESSION['uid']." and id=".$id)->find();
		if(empty($order)){
			$this->error('该订单不存在');
		}
		switch($payment){
			case 1:
				$p['oid'] = $order['id'];
				$p['orderid'] = $order['orderid'];
				$p['money'] = $order['totalprice'];
				$p['order_id'] = date('YmdHis',time()).rand(10000,99999);
				$result = M("pay_log")->add($p);
				if(!empty($result)){
					$gid = explode(',',$order['gid']);
					$data['title'] = M("goods")->where("id=".$gid[0])->getField('gname');
					//$data['total'] = $order['online'];
					$data['total'] = $order['totalprice'];
					$data['orderid'] = $p['order_id'];
					$content=date('Y-m-d H:i:s',time()).' '.'支付记录生成，支付方式：支付宝支付，订单号:'.$p['orderid'].'用户id:'.$order['aid'].'订单金额：'.$p['money']."\r\n";
					write_paylogs($p['orderid'],$content);
			        webalipay($data);
				}else{
					$content=date('Y-m-d H:i:s',time()).' '.'支付记录生成失败，支付方式：支付宝支付，订单号:'.$p['orderid'].'用户id:'.$order['aid'].'订单金额：'.$p['money']."\r\n";
					write_paylogs($p['orderid'],$content);
					$this->error('网络异常，请稍候操作');
				}
				break;
		}
	}
	//支付成功
    public function paysuccess(){
		$id = I('id');
		$order = M("order")->where("id=".$id)->find();
		$top="支付成功";
		$this->assign('top',$top);
		$this->assign('order',$order);
		$this->display();
	}
	
	//支付失败
    public function payfalse(){
		$top="支付失败";
		$this->assign('top',$top);
		$this->display();
	}
	
	//多图上传
	public function uploadify(){
		if (!empty($_FILES['fileurl'])){
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->exts  = array('jpg','jpeg','gif','png');// 设置附件上传类型
			$upload->savePath =  '/pingjia/';// 设置附件上传目录
			$info =  $upload->upload();
			if(!$info) {// 上传错误提示错误信息
				$this->error($upload->getError());
			}
			$str = '/Public/uploads'.$info['fileurl']['savepath'].$info['fileurl']['savename'];
			echo $str;    //返回文件名给JS作回调用
		}
	}
	//评价添加页
    public function judge(){
        $id=trim(I('get.id'));
        $result=M('order')->where('id ='.$id)->find();
        if(!$result){
			$this->error('订单不存在');
		}
		$gid=explode(',',$result['gid']);
		$price=explode(',',$result['price']);
		foreach($gid as $key => $val){
			$rul=M('goods')->where('id ='.$val)->find();
			$res[$key]['gid']=$rul['id'];
			$res[$key]['uid']=$_SESSION['uid'];
			$res[$key]['bid']=$id;
			$res[$key]['gname']=$rul['gname'];
			$res[$key]['gurl']=$rul['imgurl'];
		}
		$this->assign('result',$result);
		$this->assign('res',$res);
		$top="评价";
		$this->assign('top',$top);
		$this->display();
	}
	//数据加入评价表
	public function dojudge(){
		$bid=I('post.oid');//订单表id
		$gid=I('post.gid');//商品id
		//$gid=explode(',',$gid2);
		$contents=I('post.content');
		$score=I('post.score');
		$score2=I('post.score2');
		$imgs=I('post.image');
		//$imgs=explode(',',$imgs2);
		//$this->ajaxReturn($imgs);
		if(empty($bid)||empty($gid)){
			$data['status']=0;
			$data['msg']='参数异常';
			$this->ajaxReturn($data);
		}
		foreach ($gid as $k=> $v){
			$map[$k]['bid']=$bid;
			$map[$k]['gid']=$v;
			$map[$k]['content']=$contents[$k];
			$map[$k]['score']=$score[$k];
			$map[$k]['score2']=$score2[$k];
			if(!empty($imgs[$k])){
                $map[$k]['status']=1;
			}
			$map[$k]['img']=$imgs[$k];
			$map[$k]['uid']=$_SESSION['uid'];
			$map[$k]['price']=$v;
			$map[$k]['addtime']=time();
		}
		$result=M('pingjia')->addall($map);
		$result2=M('order')->where('id='.$bid)->setField('status','5');
		if($result){
			$data['status']=1;
			$data['msg']='评价成功';
			$this->ajaxReturn($data);
		}else{
			$data['status']=0;
			$data['msg']='评价异常';
			$this->ajaxReturn($data);
		}
	}

	//已评价订单
	public function evaluate(){
		$top="已评价订单";
		$map['uid']=$_SESSION['uid'];
		//$map['status']=0;
		$count=M('pingjia')->where($map)->count();
		$Page = new \Think\Hpage($count,6);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$result=M('pingjia')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
		foreach($result as $k => $v){
			$res=M('goods')->where('id ='.$v['gid'])->find();
			$result[$k]['gname']=$res['gname'];
			$result[$k]['gimg']=$res['imgurl'];
			$order=M('order')->where('id = '.$v['bid'])->find();
			$result[$k]['otime']=$order['addtime'];
			$result[$k]['orderid']=$order['orderid'];
			$result[$k]['img']=explode('|',$v['img']);
		}
		$this->assign('top',$top);
		$this->assign('page',$show);
		$this->assign('result',$result);
		$this->display();
	}
	//官方回复
	public function huifu(){
		$top="已评价订单";
		$map['uid']=$_SESSION['uid'];
		$map['status']=3;
		$count=M('pingjia')->where($map)->count();
		$Page = new \Think\Page($count,6);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$result=M('pingjia')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
		foreach($result as $k => $v){
			$res=M('goods')->where('id ='.$v['gid'])->find();
			$result[$k]['gname']=$res['gname'];
			$result[$k]['gimg']=$res['imgurl'];
			$order=M('order')->where('id = '.$v['bid'])->find();
			$result[$k]['otime']=$order['addtime'];
			$result[$k]['orderid']=$order['orderid'];
			$result[$k]['img']=explode('|',$v['img']);
		}
		$this->assign('top',$top);
		$this->assign('page',$show);
		$this->assign('result',$result);
		$this->display();
	}
	//删除评价
	public function delping(){
        $nid=$_POST['id'];
        if(empty($nid)){
            $data['code']=0;
            $data['msg']="请选择要移除的评价信息";
            $this->ajaxReturn($data);
        }
        if(!is_numeric($nid)){
            $data['code']=0;
            $data['msg']="参数错误，请稍后再试";
            $this->ajaxReturn($data);
        }
        $addr=M('pingjia');
        $result=$addr->where('id ='.$nid)->find();
        if($result){
            $deladdr=$addr->where('id ='.$nid)->setField('status','-1');
            $data['code']=1;
           $data['msg']="删除评价信息成功";
            $this->ajaxReturn($data);
        }else{
            $data['code']=0;
            $data['msg']="要删除的评价信息不存在";
            $this->ajaxReturn($data);
        }
    }

}