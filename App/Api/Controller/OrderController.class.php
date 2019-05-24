<?php
// 本类由系统自动生成，仅供测试用途
namespace Api\Controller;
use Think\Controller;
class OrderController extends Controller {
	//订单列表
    public function index(){
		$st=I('post.st');
		$uid=I('post.uid');
		if(empty($st)){
			$map['status']=array('not in','0,-1');
		}else{
			$map['status']=$st;
		}
		$key=I('post.key');
		if(empty($key)){
			$map['orderid']=array('like', '%' .$key. '%');
		}
		$map['is_wan']=2;
		//参数获取
		$p = I('post.p/d');//页数
		if(empty($p)) $p = 1;
		$num=10;//每页数量
		$firstRow = ($p - 1) * $num;
		$orderstr="addtime desc";

		$map['aid']=$uid;
		$result=M('order')->where($map)->limit($firstRow, $num)->order($orderstr)->select();
		foreach($result as $k => $v){
			$res=array();
			$gid=array();
			$price=array();
			$gid=explode(',',$v['gid']);
			$ggname=explode(',',$v['val']);
			$price=explode(',',$v['price']);
			$amount=explode(',',$v['amount']);
			foreach($gid as $key => $val){
				$rul=M('goods')->where('id ='.$val)->find();
				$res[$key]['gid']=$val;//无法跳详情解决
				$res[$key]['gname']=$rul['gname'];
				$res[$key]['gurl']="https://".$_SERVER['SERVER_NAME'].$rul['imgurl'];
				$res[$key]['ggname']=$ggname[$key];
				$res[$key]['price']=$price[$key];
				$res[$key]['amount']=$amount[$key];
				//$res[$key]['geshu']=count($gid);
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
			}
		}
		$return['stu'] = '1';
		$return['res'] = $result;
		$this->ajaxReturn($return);
	}
	
	//立即购买,生成订单
	public function buy(){
		if(!preg_match("/^[1-9]\d*$/", $_POST['gnum'])){
			$return['stu'] = '0';
			$return['code'] = '108';
			$return['msg'] = '请选择正确的数量';
			$this->ajaxReturn($return);
		}
		$goods = M("Goods")->where("is_del = -1 and id = ".$_POST['gid'])->find();
		if(!$goods){
			$return['stu'] = '0';
			$return['code'] = '109';
			$return['msg'] = '该产品不存在';
			$this->ajaxReturn($return);
		}
		if(empty($_POST['val'])){
			$return['stu'] = '0';
			$return['code'] = '110';
			$return['msg'] = '请选择商品规格';
			$this->ajaxReturn($return);
		}
		$uid=I('post.uid');
		$order['orderid'] = date('YmdHis',time()).rand(1000,9999);
		$order['aid'] = $uid;
		$order['addtime'] = time();
		$order['amount'] = $_POST['gnum'];
		$order['totalprice'] = $goods['price']*$_POST['gnum']+$goods['yfmoney'];
		$order['score'] = $goods['jifen']*$_POST['gnum'];
		$order['price'] = $goods['price'];
		$order['gid'] = $_POST['gid'];
		$order['val'] = $_POST['val'];
		$order['status'] =1;
		$result = M("Order")->add($order);
		$result2=M('order')->where('id='.$result)->find();
		if($result){
			$return['stu'] = '1';
            $return['res'] = $result2;
            $this->ajaxReturn($return);
		}else{
			$return['stu'] = '0';
			$return['code'] = '111';
			$return['msg'] = '对不起，操作失败';
			$this->ajaxReturn($return);
		}
	}
   	//购物车购买,生成订单
	public function cartbuy(){
		$uid=I("post.uid");
		//商品的数量集合
		$at=ltrim($_POST['at'],",");
		//购物车的id集合
		$gd=ltrim($_POST['gd'],",");
		if(empty($gd)){
			$return['stu'] = '0';
			$return['code'] = '108';
			$return['msg'] = '商品不能为空';
			$this->ajaxReturn($return);
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
		$order['aid'] = $uid;
		$order['addtime'] = time();
		$order['amount'] =$at;
		$order['status'] =1;
		$result = M("Order")->add($order);
		$result2=M('order')->where('id='.$result)->find();
		if($result){
			$return['stu'] = '1';
            $return['res'] = $result2;
            $this->ajaxReturn($return);
		}else{
			$return['stu'] = '0';
			$return['code'] = '109';
			$return['msg'] = '商品不能为空';
			$this->ajaxReturn($return);
		}
	}
    //消息列表
   public function mglist(){
   	//参数获取
		$p = I('post.p/d');//页数
		if(empty($p)) $p = 1;
		$num=10;//每页数量
		$firstRow = ($p - 1) * $num;

		$uid = I('post.uid/d');
        $when['uid']=$uid;
		$list=M('orderlog')->where($when)->limit($firstRow, $num)->order('addtime desc')->select();
		foreach ($list as $k => $v) {
			$list[$k]['orderid']=M('order')->where('id='.$v['oid'])->getField('orderid');
		}
		$return['stu'] = '1';
		$return['res'] = $list;
		$this->ajaxReturn($return);	
   }
	//订单详情
	public function info(){
		//判断id参数
		$id=I('post.id');
		$uid=I('post.uid');
		$result=M('order')->where('id ='.$id)->find();
		if(!$result){
			$return['stu'] = '0';
			$return['code'] = '108';
			$return['msg'] = '订单不存在';
			$this->ajaxReturn($return);
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
			$res[$key]['uid']=$uid;
			$res[$key]['bid']=$id;
			$res[$key]['gname']=$rul['gname'];
			$res[$key]['gurl']='https://'.$_SERVER['SERVER_NAME'].$rul['imgurl'];
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
       //发票信息
		if($result['is_fa']=1){
			$res2['bill']=M('bill')->where('oid='.$result['id'])->find();
		}
        $res2['goods']=$res;
        $res2['order']=$result;

		$return['stu'] = '1';
		$return['res'] = $res2;
		$this->ajaxReturn($return);
	}
	//取消订单
	public function billdel(){
		$id=I('post.id');
		$order=M('order')->where('id ='.$id)->find();
		if($order['status'] !=1){
			$return['stu'] = '0';
			$return['code'] = '108';
			$return['msg'] = '订单无法取消';
			$this->ajaxReturn($return);
		}
		$m=M('order');
		$o_res=$m->where('id ='.$order['id'])->setField('status',-1);
		$return['stu'] = '1';
		$return['res'] = $gpn;
		$this->ajaxReturn($return);
	}
    //选择地址
	public function xzaddres(){
		$id=I('post.id');
		$res=M('address')->where('id ='.$id)->find();
		if(empty($res)){
			$return['stu'] = '0';
			$return['code'] = '108';
			$return['msg'] = '地址不存在';
			$this->ajaxReturn($return);
		}
		$return['stu'] = '1';
		$return['res'] = $res;
		$this->ajaxReturn($return);
	}
	//确认收货
	public function confirmbill(){
		$id=I('post.id');
		if(empty($id)){
			$return['stu'] = '0';
			$return['code'] = '108';
			$return['msg'] = '缺少必要参数';
			$this->ajaxReturn($return);
		}
		$st=M('order')->where('id ='.$id)->getField('status');
		if($st == 4){
			$return['stu'] = '0';
			$return['code'] = '109';
			$return['msg'] = '订单已经确认收货';
			$this->ajaxReturn($return);
		}
		$map['status']=4;
		$map['shtime']=time();
		$re=M('order')->where('id ='.$id)->save($map);
		if($re){
			$return['stu'] = '1';
			$return['res'] =$re;
			$this->ajaxReturn($return);
		}else{
			$return['stu'] = '0';
			$return['code'] = '110';
			$return['msg'] = '确认收货失败';
			$this->ajaxReturn($return);
		}
	}
    //选择发票
	public function xzbill(){
		$id=I('post.id');
		$res=M('bill')->where('id ='.$id)->find();
		if(empty($res)){
			$return['stu'] = '0';
			$return['code'] = '108';
			$return['msg'] = '发票不存在';
			$this->ajaxReturn($return);
		}
		$return['stu'] = '1';
		$return['res'] = $res;
		$this->ajaxReturn($return);
	}
	//发票保存实现
    public function dobill(){
        if(empty($_POST['btitle'])){
        	$return['stu'] = '0';
			$return['code'] = '108';
			$return['msg'] = '请输入发票抬头';
			$this->ajaxReturn($return);
        }
        if(empty($_POST['btel'])){
        	$return['stu'] = '0';
			$return['code'] = '109';
			$return['msg'] = '请输入收票手机';
			$this->ajaxReturn($return);
        }
        if(!preg_match("/^1[3|4|5|7|8][0-9]\d{8}$/",$_POST['btel'])){
        	$return['stu'] = '0';
			$return['code'] = '110';
			$return['msg'] = '请输入正确的手机号码！';
			$this->ajaxReturn($return);
        }
        if(empty($_POST['bemail'])){
        	$return['stu'] = '0';
			$return['code'] = '111';
			$return['msg'] = '请输入收票邮箱！';
			$this->ajaxReturn($return);
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
                $return['stu'] = '1';
                $return['bid'] =$result;
                $this->ajaxReturn($return);
            }else{
            	$return['stu'] = '0';
				$return['code'] = '112';
				$return['msg'] = '新增失败！';
				$this->ajaxReturn($return);
            }
        }else{
            $address = M("bill")->where("id = ".$billid)->find();
            if(empty($address)){
            	$return['stu'] = '0';
				$return['code'] = '113';
				$return['msg'] = '该数据不存在';
				$this->ajaxReturn($return);
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
            $addr->id=$billid;
            $result = $addr->save();
            if($result !== false){
            	$return['stu'] = '1';
				$return['res'] =$result;
				$return['bid'] =$billid;
				$this->ajaxReturn($return);
            }else{
            	$return['stu'] = '0';
				$return['code'] = '114';
				$return['msg'] = '修改失败！';
				$this->ajaxReturn($return);
            }
        }
    }
	//填写核对订单
	public function order(){
		//订单的id
		$id=I('post.id');
		$uid=I('post.uid');
		//订单
		$ding=M('order')->where('id='.$id)->find();
		$check_goods=M('goods')->where('id ='.$ding['gid'])->find();
		$goods1['title'] = $check_goods['gname'];
		$goods1['imgurl'] = 'https://'.$_SERVER['SERVER_NAME'].$check_goods['imgurl'];
		$goods1['amount'] = $ding['amount'];
		$goods1['val'] =$ding['val'];
		$goods1['price'] = $check_goods['price'];
		$goods1['yunfei']=$ding['yunfei'];
		$ding['total']=$check_goods['price']*$ding['amount'];
		$res['goods'][]=$goods1;
		//$res['goods']=$goods;

        $res['ding']=$ding;
		//查看是否有发票
		$res['bill']=M('bill')->where('oid='.$id)->find();
		//$res['user']= M("user")->where("id=".$uid)->find();
		$res['addr'] = M("address")->where("uid = ".$uid)->order("addtime desc")->limit(1)->find();
		$return['stu'] = '1';
		$return['res'] =$res;
		$this->ajaxReturn($return);
	}
	//填写核对订单,多个商品
	public function order2(){
		//订单的id
		$id=I('post.id');
		$uid=I('post.uid');
		//订单
		$ding=M('order')->where('id='.$id)->find();
		$cart_array=explode(',',$ding['gid']);
		$amount_array=explode(',',$ding['amount']);
		$order['total'] = 0;
		foreach($cart_array as $k=>$v){
			$check_goods=M('goods')->where('id ='.$v)->find();
			if(($check_goods['is_up'] == -1) || ($check_goods['is_del'] == 1) ){
					$return['stu'] = '0';
					$return['code'] = '108';
					$return['msg'] = '该商品已下架或已删除';
					$this->ajaxReturn($return);
			}
			$goods[$k]['yunfei'] = $check_goods['yfmoney'];
			$goods[$k]['title'] = $check_goods['gname'];
			$goods[$k]['imgurl'] = 'https://'.$_SERVER['SERVER_NAME'].$check_goods['imgurl'];
			$goods[$k]['amount'] = $amount_array[$k];
			$goods[$k]['price'] = $check_goods['price'];
			$order['total']=$order['total']+$goods[$k]['price']*$goods[$k]['amount'];
		}
		$res['goods']=$goods;
        $ding['total']=$order['total'];
        $res['ding']=$ding;
		//查看是否有发票
		$res['bill']=M('bill')->where('oid='.$id)->find();
		//$res['user']= M("user")->where("id=".$uid)->find();
		//$res['address']= M("address")->where("uid = ".$uid)->order("addtime desc")->select();
		$res['addr'] = M("address")->where("uid = ".$uid)->order("addtime desc")->limit(1)->find();

		$return['stu'] = '1';
		$return['res'] =$res;
		$this->ajaxReturn($return);
	}
	//第三方支付方法
	public function payment(){
		$payment = 1;
		$id = trim(I('post.id'));
		$uid=I('post.uid');
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
			$return['code'] = '109';
			$return['msg'] = '请选择收货地址';
			$this->ajaxReturn($return);
		}else{
			$xiu['addressid']=$adid;
			$useraddress=M('address')->where('id='.$adid)->find();
			if($useraddress){
				$xiu['addressman']=$useraddress['name'];
				$xiu['addressmobile']=$useraddress['tel'];
				$xiu['address']=$useraddress['sheng'].$useraddress['shi'].$useraddress['xian'].$useraddress['address'];
			}else{
				$return['stu'] = '0';
				$return['code'] = '111';
				$return['msg'] = '收货地址不存在';
				$this->ajaxReturn($return);
			}
			
		}
        $is_fa=trim(I('post.is_fa'));
        if(!empty($is_fa)){
        	$xiu['is_fa']=$is_fa;
        	//判断是否添加发票
        	$fapiao=M('bill')->where('oid='.$id)->find();
        	if(empty($fapiao)){
                 $return['stu'] = '0';
				$return['code'] = '110';
				$return['msg'] = '您好没有填写发票';
				$this->ajaxReturn($return);
        	}
        }else{
        	$fapiao=M('bill')->where('oid='.$id)->delete();
        }
        $xiu['is_wan']=2;
        $result=M('order')->where('id='.$id)->save($xiu);
        //删除购物车里的商品
        $cartids=explode(',',$order['gid']);
        $scart['uid']=$uid;
        $scart['gid']=array('in',$cartids);
        $fa_cart=M('cart')->where($scart)->select();
        if($fa_cart){
             $delcart=M('cart')->where($scart)->delete();
        }
        $log['oid'] = $id;
		$log['order_id'] = time().rand(100000,999999);
		$log['money'] = $order['totalprice'];
		$log['uid'] = $uid;
		$log['addtime'] = time();
		$result = M("pay_log")->add($log);
		if(!$result){
			return 0;
		}
		require_once './Public/wxpay/lib/WxPay.Api.php'; 
		require_once './Public/wxpay/jsapi/WxPay.JsApiPay.php';
		//①、获取用户openid
		$tools = new \JsApiPay();
		$openId = M("user")->where("id=".$uid)->getField('openid');
		//$openId='od0ia5XSCOzKv_sdvT0ZZ9--9vDw';
		$gid = explode(',',$order['gid']);
		$title = M("goods")->where("id=".$gid[0])->getField('gname');
		//$title = $log['order_id'];
		if(strlen($title)>128){
			$title=substr($title,120);
		}
		//②、统一下单
		$input = new \WxPayUnifiedOrder();
		$input->SetBody($title);
		$input->SetAttach($title);
		$input->SetOut_trade_no($log['order_id']);
		$input->SetTotal_fee($log['money']*100);
		$input->SetTime_start(date("YmdHis"));
		$input->SetGoods_tag('0');
		$input->SetNotify_url("http://www.qylhqf.com/api.php/pay/weixin.html");
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openId);

		
		$order2 = \WxPayApi::unifiedOrder($input);
		$jsApiParameters = $tools->GetJsApiParameters($order2);
		$data = json_decode($jsApiParameters,true);
		//return $data;
	    $this->ajaxReturn($data);

	}
	//订单列表里的支付
	public function payment2(){
		$payment = 1;
		$id = trim(I('post.id'));
		$uid=I('post.uid');
		$order = M("order")->where("aid = ".$uid." and id=".$id)->find();
		if(empty($order)){
			$return['stu'] = '0';
			$return['code'] = '108';
			$return['msg'] = '该订单不存在';
			$this->ajaxReturn($return);
		}

        $log['oid'] = $id;
		$log['order_id'] = time().rand(100000,999999);
		$log['money'] = $order['totalprice'];
		$log['uid'] = $uid;
		$log['addtime'] = time();
		// $result = M("pay_log")->add($log);
		// if(!$result){
		// 	return 0;
		// }
		require_once './Public/wxpay/lib/WxPay.Api.php'; 
		require_once './Public/wxpay/jsapi/WxPay.JsApiPay.php';
		//①、获取用户openid
		$tools = new \JsApiPay();
		$openId = M("user")->where("id=".$uid)->getField('openid');
		//$openId='od0ia5XSCOzKv_sdvT0ZZ9--9vDw';
		$gid = explode(',',$order['gid']);
		$title = M("goods")->where("id=".$gid[0])->getField('gname');
		//$title = $log['order_id'];
		if(strlen($title)>128){
			$title=substr($title,120);
		}
		//②、统一下单
		$input = new \WxPayUnifiedOrder();
		$input->SetBody($title);
		$input->SetAttach($title);
		$input->SetOut_trade_no($log['order_id']);
		$input->SetTotal_fee($log['money']*100);
		$input->SetTime_start(date("YmdHis"));
		$input->SetGoods_tag('0');
		$input->SetNotify_url("http://www.qylhqf.com/api.php/pay/weixin.html");
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openId);

		
		$order2 = \WxPayApi::unifiedOrder($input);
		$jsApiParameters = $tools->GetJsApiParameters($order2);
		$data = json_decode($jsApiParameters,true);
		//return $data;
	    $this->ajaxReturn($data);

	}
	//评价添加页
    public function judge(){
        $id=trim(I('post.id'));
        $uid=trim(I('post.uid'));
        $result=M('order')->where('id ='.$id)->find();
        if(!$result){
        	$return['stu'] = '0';
			$return['code'] = '108';
			$return['msg'] = '订单不存在';
			$this->ajaxReturn($return);
		}
		$gid=explode(',',$result['gid']);
		$price=explode(',',$result['price']);
		foreach($gid as $key => $val){
			$rul=M('goods')->where('id ='.$val)->find();
			$res[$key]['gid']=$rul['id'];
			$res[$key]['uid']=$uid;
			$res[$key]['bid']=$id;
			$res[$key]['gname']=$rul['gname'];
			$res[$key]['gurl']='https://'.$_SERVER['SERVER_NAME'].$rul['imgurl'];
		}
		$res2['result']=$result;
        $res2['res']=$res;
		$return['stu'] = '1';
		$return['res'] =$res2;
		$this->ajaxReturn($return);
	}
	//数据加入评价表
	public function dojudge(){
		$bid=I('post.oid');//订单表id
		$gid2=I('post.gid');//商品id
		$gid=explode(',',$gid2);
		$contents=I('post.content');
		$score=I('post.score');
		$score2=I('post.score2');
		$imgs2=I('post.image');
        $imgs=explode(',',$imgs2);
		$uid=I('post.uid');
		if(empty($bid)||empty($gid)){
			$return['stu'] = '0';
			$return['code'] = '108';
			$return['msg'] = '缺少总要参数';
			$this->ajaxReturn($return);
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
			$map[$k]['uid']=$uid;
			$map[$k]['price']=$v;
			$map[$k]['addtime']=time();
		}
		//$this->ajaxReturn($map);
		$result=M('pingjia')->addall($map);
		$result2=M('order')->where('id='.$bid)->setField('status','5');
		if(empty($result)){
			$return['stu'] = '0';
			$return['code'] = '109';
			$return['msg'] = '评价异常';
			$this->ajaxReturn($return);
		}else{
			$return['stu'] = '1';
			$return['res'] =$result;
			$this->ajaxReturn($return);
		}
	}
    public function uploadify(){
        //if (!empty($_FILES['fileurl'])){
            $upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			$upload->exts  = array('jpg','jpeg','gif','png');// 设置附件上传类型
			$upload->savePath =  '/pingjia/';// 设置附件上传目录
			$info =  $upload->upload();
			if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getError());
			}
			$str = '/Public/uploads'.$info['file']['savepath'].$info['file']['savename'];
			//echo $str;    //返回文件名给JS作回调用
			$this->ajaxReturn($str);
        //}
    }
	//已评价订单
	public function evaluate(){
		//参数获取
		$p = I('post.p');//页数
		if(empty($p)) $p = 1;
		$num=10;//每页数量
		$firstRow = ($p - 1) * $num;
        $uid=I('post.uid');
		$map['uid']=$uid;
		//$map['status']=0;
		$result=M('pingjia')->where($map)->limit($firstRow, $num)->order('addtime desc')->select();
		foreach($result as $k => $v){
			$res=M('goods')->where('id ='.$v['gid'])->find();
			$result[$k]['gname']=$res['gname'];
			$result[$k]['gimg']=$res['imgurl'];
			$order=M('order')->where('id = '.$v['bid'])->find();
			$result[$k]['otime']=$order['addtime'];
			$result[$k]['orderid']=$order['orderid'];
			//$result[$k]['img']=explode('|',$v['img']);
			$result[$k]['img']="https://".$_SERVER['SERVER_NAME'].$v['img'];
		}
        $return['stu'] = '1';
		$return['res'] = $result;
		$this->ajaxReturn($return);
	}
	//官方回复
	public function huifu(){
		//参数获取
		$p = I('post.p');//页数
		if(empty($p)) $p = 1;
		$num=10;//每页数量
		$firstRow = ($p - 1) * $num;

		$uid=I('post.uid');
		$map['uid']=$uid;
		$map['status']=3;
		$result=M('pingjia')->where($map)->limit($firstRow, $num)->order('addtime desc')->select();
		foreach($result as $k => $v){
			$res=M('goods')->where('id ='.$v['gid'])->find();
			$result[$k]['gname']=$res['gname'];
			$result[$k]['gimg']="https://".$_SERVER['SERVER_NAME'].$res['imgurl'];
			$order=M('order')->where('id = '.$v['bid'])->find();
			$result[$k]['otime']=$order['addtime'];
			$result[$k]['orderid']=$order['orderid'];
			//$result[$k]['img']=explode('|',$v['img']);
			$result[$k]['img']="https://".$_SERVER['SERVER_NAME'].$v['img'];
		}
		$return['stu'] = '1';
		$return['res'] = $result;
		$this->ajaxReturn($return);
	}
	//删除评价
	public function delping(){
        $id=I('post.id');
        $uid=I('post.uid');
        if(empty($id)){
        	$return['stu'] = '0';
			$return['code'] = '108';
			$return['msg'] = '请选择要移除的评价信息';
			$this->ajaxReturn($return);
        }
        $ids=explode(",",$id);
        $where['id'] = array('in',$ids);
        $where['uid'] =$uid;
        $addr=M('pingjia');
        $res=$addr->where($where)->find();
        if(empty($res)){
        	$return['stu'] = '0';
			$return['code'] = '109';
			$return['msg'] = '要删除的评价信息不存在';
			$this->ajaxReturn($return);
        }
        $result=$addr->where($where)->delete();
        if($result){
            $return['stu'] = '1';
			$this->ajaxReturn($return);
        }else{
        	$return['stu'] = '0';
			$return['code'] = '110';
			$return['msg'] = '删除的信息失败';
			$this->ajaxReturn($return);
        }
    }

}