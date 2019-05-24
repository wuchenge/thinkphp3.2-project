<?php
// 本类由系统自动生成，仅供测试用途
namespace Api\Controller;
use Think\Controller;
class PayController extends Controller {
		//微信支付异步回调
	public function weixin(){
		include_once("./Public/wxpay/lib/WxPayPubHelper.php");
		
		//使用通用通知接口
		$notify = new \Notify_pub();
		//存储微信的回调
		$xml = $GLOBALS['HTTP_RAW_POST_DATA'];	
		$notify->saveData($xml);
		//测试毁掉
		// $hd['title']='测试11';
		// $jieguo=M('nav')->add($hd);
		//验证签名，并回应微信。
		//对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
		//微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
		//尽可能提高通知的成功率，但微信不保证通知最终能成功。
		if($notify->checkSign() == FALSE){
			$notify->setReturnParameter("return_code","FAIL");//返回状态码
			$notify->setReturnParameter("return_msg","签名失败");//返回信息
		}else{
			$notify->setReturnParameter("return_code","SUCCESS");//设置返回码
		}
		$data = $notify->getData();
		$returnXml = $notify->returnXml();
		echo $returnXml;
		
		//==商户根据实际情况设置相应的处理流程，此处仅作举例=======
		
		//以log文件形式记录回调信息
		$orderid = explode("_",$data['out_trade_no']);
		if($notify->checkSign() == TRUE){
			if ($notify->data["return_code"] == "FAIL") {
				//此处应该更新一下订单状态，商户自行增删操作
				writelog($data['out_trade_no'],"【通信出错】:\n".$xml);
			}
			elseif($notify->data["result_code"] == "FAIL"){
				//此处应该更新一下订单状态，商户自行增删操作
				writelog($data['out_trade_no'],"【业务出错】:\n".$xml);
			}
			else{
				writelog($data['out_trade_no'],"验证成功，开始执行业务逻辑");
				$orderid = $data['out_trade_no'];
				$order = M("pay_log")->where("order_id = '".$orderid."'")->find();
				$this->edit_order($order['oid']);
				echo 'success';
			}
		}else{
			writelog(date("YmdHis"),"支付失败");
			echo 'fail';
		}
	}
//微信支付
public function edit_order($id){
		$r = M("Order")->where("id = ".$id)->find();
		if($r['status'] == 1){
			//业务逻辑此处写
			$content=date('Y-m-d H:i:s',time()).' '.'订单回调业务逻辑开启，订单号：'.$r['orderid']."\r\n";
			write_paylogs($r['orderid'],$content);
			$map['status']=2;
			$map['paytime']=time();
			$map['paytype']=2;
			$o_res=M("order")->where("id=".$id)->save($map);
			if($o_res){
				$content=date('Y-m-d H:i:s',time()).' '.'更改订单状态成功，订单号：'.$r['orderid']."\r\n";
				write_paylogs($r['orderid'],$content);
			}else{
				$content=date('Y-m-d H:i:s',time()).' '.'更改订单状态失败，订单号：'.$r['orderid']."\r\n";
				write_paylogs($r['orderid'],$content);
			}
			$result=M('order')->where("id =".$id)->find();
			//修改库存和销量
			$kuids=explode('|',$result['amount']);
			$gids=explode('|',$result['gid']);
			foreach ($gids as $k=> $v){
				$xgoods=M('goods')->where('id='.$v)->setDec('num',$kuids[$k]);
				$xgoods2=M('goods')->where('id='.$v)->setInc('sales',$v);
			}
			$smoney=M('user')->where('id ='.$result['aid'])->setInc('summoney',$result['totalprice']);
			$stimes=M('user')->where('id ='.$result['aid'])->setInc('sumtimes');
			$score=M('user')->where('id ='.$result['aid'])->setInc('score',$result['score']);
		}else{
			$content=date('Y-m-d H:i:s',time()).' '.'回调异常，找不到订单'."\r\n";
			write_paylogs($order['orderid'],$content);
		}
	}
	//支付成功
	public function pay_success(){
		$config = M("config")->where('id=1')->find();
		$config['title'] = "支付成功-".$config['title'];
		$this->assign('config',$config);
		$this->assign('top',"支付成功");
		$this->display();
	}
	
	//支付失败
	public function pay_fail(){
		$config = M("config")->where('id=1')->find();
		$config['title'] = "支付失败-".$config['title'];
		$this->assign('config',$config);
		$this->assign('top',"支付失败");
		$this->display();
	}
}