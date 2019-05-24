<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends UserbaseController{
    //首页
    public function index(){
        //获取用户ID
        $id = I('session.uid/d');
        //查询优惠券条件
        $coupon_map = array(
            'uid'=>array('EQ',$id),
            'end'=>array('GT',time()),
            'is_use'=>array('NEQ',1),
        );
        $user = M("user")->find($id);
        $coupon = M("usercoupon")->where($coupon_map)->count();
        $dfcount = M("order")->where('aid = '.$id." and status=1")->count();
        $dscount = M("order")->where('aid = '.$id." and status=3")->count();
        $dpcount = M("order")->where('aid = '.$id." and status=4")->count();
        $coll = M("coll")->where('uid = '.$id)->count();
        //查询会员等级
        $level= M('user u')->field('l.title,l.discount')->join(C('DB_PREFIX').'user_level l on u.level_id=l.id','LEFT')
        ->where('u.id='.$id)->find();
        $top="个人中心首页";
        $this->assign('top',$top);
        $this->assign('user',$user);
        $this->assign('coupon',$coupon);
        $this->assign('dfcount',$dfcount);
        $this->assign('dscount',$dscount);
        $this->assign('dpcount',$dpcount);
        $this->assign('coll',$coll);
        $this->assign('level',$level);
        $this->display();
    }
    //上传评价图片
    public function pjimg(){
        if (!empty($_FILES['file'])) {
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
            $data['status']=1;
            $data['info']=$str;
            $this->ajaxReturn($data);
        }
    }
    public function payment(){
        $payment = trim(I('post.payment'));
        $id = trim(I('post.id'));
        $a = array(1,2,3);
        if(!in_array($payment,$a)){
            $this->error('您选择的支付方式不存在');
        }
        $order = M("order")->where("aid = ".$_SESSION['uid']." and id=".$id)->find();
        if(empty($order)){
            $this->error('该订单不存在');
        }
        switch($payment){
            case 1:
                $p['oid'] = $order['id'];
                $p['orderid'] = $order['orderid'];
                $p['money'] = $order['total'];
                $p['orderid'] = date('YmdHis',time()).rand(10000,99999);
                $result = M("pay_log")->add($p);
                if($result){
                    $gid = explode(',',$order['gid']);
                    $data['title'] = M("goods")->where("id=".$gid[0])->getField('gname');
                    $data['total'] = $order['totalprice'];
                    $data['orderid'] = $p['orderid'];
                    alipay($data);
                }else{
                    $this->error('网络异常，请稍候操作');
                }
                break;
            case 2:
                $p['oid'] = $order['id'];
                $p['orderid'] = $order['orderid'];
                $p['money'] = $order['total'];
                $p['orderid'] = date('YmdHis',time()).rand(10000,99999);
                $result = M("pay_log")->add($p);
                if($result){
                    $gid = explode(',',$order['gid']);
                    $data['title'] = M("goods")->where("id=".$gid[0])->getField('gname');
                    $data['total'] = $order['totalprice'];
                    $data['orderid'] = $p['orderid'];
                    $this->union($data);
                }else{
                    $this->error('网络异常，请稍候操作');
                }
                
                break;
            case 3:
                $this->redirect("user/weixin?id=".$id);
                break;
        }
    }

    
    
    //微信扫码支付
    public function weixin(){
        $id = I("id");
        $order = M("order")->where("aid = ".$_SESSION['uid']." and id = ".$id)->find();
        if($order){
            if($order['status'] != 1){
                $this->error('该订单已支付或者已取消',U("user/billlist"));
            }else{
                $p['oid'] = $order['id'];
                $p['orderid'] = $order['orderid'];
                $p['money'] = $order['totalprice'];
                $p['orderid'] = date('YmdHis',time()).rand(10000,99999);
                $result2 = M("pay_log")->add($p);
                if(!$result2){
                    $this->error('网络异常，请稍候操作',U("user/billlist"));
                }
                $gid = explode(',',$order['gid']);
                $title = M("goods")->where("id=".$gid[0])->getField('gname');
                
                require_once "./Public/wxpay/lib/WxPay.Api.php";
                require_once "./Public/wxpay/lib/WxPay.NativePay.php";
                $notify = new \NativePay();
                $input = new \WxPayUnifiedOrder();
                $input->SetBody($title);
                $input->SetAttach($title);
                $input->SetOut_trade_no($p['orderid']);
                $input->SetTotal_fee($order['totalprice']*100);
                $input->SetTime_start(date("YmdHis"));
                $input->SetTime_expire(date("YmdHis", time() + 300));
                $input->SetGoods_tag($title);
                $input->SetNotify_url("http://".$_SERVER['HTTP_HOST']."/index.php/pay/weixin");
                $input->SetTrade_type("NATIVE");
                $input->SetProduct_id(rand(1000,9999));
                $result = $notify->GetPayUrl($input);
                $url2 = $result["code_url"];
                $url2 = "http://".$_SERVER['HTTP_HOST']."/Public/wxpay/lib/qrcode.php?data=".urlencode($url2);
                $this->config['title'] = "微信扫码支付-".$this->config['title'];
                $this->assign('config',$this->config);
                $this->assign('url',$url2);
                $this->assign('order',$order);
                $this->display();
            }
        }else{
            $this->error('该订单不存在');
        }
    }
    
    public function ispay(){
        $id = I("post.id");
        $order = M("order")->where("id=".$id)->find();
        if($order['status'] > 1){
            $this->ajaxReturn(1);
        }else{
            $this->ajaxReturn(0);
        }
    }
    
    //电脑端
    public function union($data){
        header("Content-Type: text/html; charset=UTF-8");

        include_once './Public/unionpay/utf8/func/common.php';
        include_once './Public/unionpay/utf8/func/SDKConfig.php';
        include_once './Public/unionpay/utf8/func/secureUtil.php';
        include_once './Public/unionpay/utf8/func/log.class.php';
        
        // 初始化日志
        $log = new \PhpLog ( SDK_LOG_FILE_PATH, "PRC", SDK_LOG_LEVEL );
        $log->LogInfo ( "============处理前台请求开始===============" );
        // 初始化日志
        $params = array(
                'version' => '5.0.0',               //版本号
                'encoding' => 'utf-8',              //编码方式
                'certId' => getSignCertId (),           //证书ID
                'txnType' => '01',              //交易类型  
                'txnSubType' => '01',               //交易子类
                'bizType' => '000201',              //业务类型
                'frontUrl' =>  SDK_FRONT_NOTIFY_URL,        //前台通知地址
                'backUrl' => SDK_BACK_NOTIFY_URL,       //后台通知地址    
                'signMethod' => '01',       //签名方法
                'channelType' => '07',      //渠道类型，07-PC，08-手机
                'accessType' => '0',        //接入类型
                'merId' => MERID,               //商户代码，请改自己的测试商户号
                'orderId' => $data['orderid'],  //商户订单号
                'txnTime' => date('YmdHis'),    //订单发送时间
                'txnAmt' => $data['total']*100,     //交易金额，单位分
                'currencyCode' => '156',    //交易币种
                'defaultPayType' => '0001', //默认支付方式    
                //'orderDesc' => '订单描述',  //订单描述，网关支付和wap支付暂时不起作用
                'reqReserved' =>' 透传信息', //请求方保留域，透传字段，查询、通知、对账文件中均会原样出现
                );


        // 签名
        sign ( $params );


        // 前台请求地址
        $front_uri = SDK_FRONT_TRANS_URL;
        $log->LogInfo ( "前台请求地址为>" . $front_uri );
        // 构造 自动提交的表单
        $html_form = create_html ( $params, $front_uri );

        $log->LogInfo ( "-------前台交易自动提交表单>--begin----" );
        $log->LogInfo ( $html_form );
        $log->LogInfo ( "-------前台交易自动提交表单>--end-------" );
        $log->LogInfo ( "============处理前台请求 结束===========" );
        echo $html_form;
        echo "支付跳转中，请稍候.......";
    }
    
    //财务明细
    public function money(){
        $search['end'] = I('get.end');
        $search['start'] = I('get.start');
        $search['title'] = I('get.title');
//        dump($search);
        if(!empty($search['title'])){
            $map['xiangmu'] = array('like', '%' . $search['title'] . '%');
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
            // $map['addtime']      = array('lt', $search['end']-539162);
        }

        $map['uid']=$_SESSION['uid'];
        $count=M('moneymx')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();
        $mx=M('moneymx')->where($map)->order('addtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach($mx as $k =>$v){
            $mx[$k]['money']= round($v['money'] ,2);
            $mx[$k]['yuemoney']= round($v['yuemoney'] ,2);
        }

        $top="财务明细";
        $this->assign('top',$top);
        $this->assign('mx',$mx);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $this->display();
    }
       
    //积分明细
    public function score(){
        $search['title'] = I('get.title');
        if(!empty($search['title'])){
            $map['xiangmu'] = array('like', '%' . $search['title'] . '%');
        }
        $this->assign('search',$search);// 赋值分页输出
        $map['uid']=$_SESSION['uid'];
        $count=M('pointmx')->where($map)->count();
        $Page = new \Think\Hpage($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();
        $mx=M('pointmx')->where($map)->order('addtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $top="积分明细";
        $this->assign('top',$top);
        $this->assign('mx',$mx);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $where['uid']=$_SESSION['uid'];
        $this->display();
    }
    
    //在线支付
    public function pay(){
        $top="在线支付";
        $this->assign('top',$top);
        $this->display();
    }
    //购物车
    public function cart(){
        $uid=$_SESSION['uid'];
        $cartM = M('cart c');
        $goodsM = M('goods g');
        $clist = $goodsM->join(C('DB_PREFIX').'cart c on g.id=c.gid','LEFT')->where('c.uid="'.$uid.'" AND g.is_del =-1 AND g.is_up =1 ')->select();
        $count = $cartM->join(C('DB_PREFIX').'goods g on c.gid=g.id','LEFT')->where('c.uid="'.$uid.'" AND g.is_del =-1 AND g.is_up =1')->count();
        foreach($clist as $k=>$v){
				$res=M("goods")->where('id ='.$v['gid'])->find();
                $cart[$k]['price']=$res['price'];
                $cart[$k]['nums']=$res['nums'];
                $cart[$k]['gname']=$res['gname'];
                $cart[$k]['imgurl']=$res['imgurl'];
                $cart[$k]['id']=$v['id'];
                $cart[$k]['gid']=$v['gid'];
                $cart[$k]['is_norm']=$v['is_norm'];
                $cart[$k]['num']=$v['num'];
                $cart[$k]['keywords']=$res['keywords'];
                $cart[$k]['is_up']=$res['is_up'];
		}
        $this->assign('top','购物车'); 
		$this->assign('glist',$cart);
		$this->assign('count',$count);
        $this->display();
    }

    //商品移除购物车
    public function cartdel(){
        $id=I('post.id');
        if(empty($id)){
            $data['status']=0;
            $data['msg']='缺少必要参数';
            $this->ajaxReturn($data);
        }
        $result=M('cart')->where('id ='.$id)->find();
        if(!$result){
            $data['status']=0;
            $data['msg']='数据错误';
            $this->ajaxReturn($data);
        }
        $fina=M('cart')->where('id ='.$id)->delete();
        if($fina){
            $data['status']=1;
            $data['msg']='商品移除购物车成功';
            $this->ajaxReturn($data);
        }else{
            $data['status']=0;
            $data['msg']='商品移除购物车失败';
            $this->ajaxReturn($data);
        }
    }
    //全部删除
    public function alldel(){
        $where['uid'] = $_SESSION['uid'];
        $cart = M("Cart")->where($where)->select();
        if(!$cart){
            $data['status'] = 0;
            $data['msg'] = "数据不存在";
            $this->ajaxReturn($data);
        }
        $result = M("Cart")->where($where)->delete();
        if($result){
            $data['status'] = 1;
            $data['msg'] = "删除成功！";
            $this->ajaxReturn($data);
        }else{
            $data['status'] = 0;
            $data['msg'] = "删除失败！";
            $this->ajaxReturn($data);
        }
    }
    //批量删除购物车产品
    public function mitudel(){
        $id = I("post.ids");
        if(empty($id)){
            $data['status'] = 0;
            $data['msg'] = "请选择要删除的数据";
            $this->ajaxReturn($data);
        }
        $ids = explode(',',$id);
        $where['id'] = array('in',$ids);
        $where['uid'] = $_SESSION['uid'];
        $cart = M("Cart")->where($where)->select();
        if(!$cart){
            $data['status'] = 0;
            $data['msg'] = "数据不存在";
            $this->ajaxReturn($data);
        }
        $result = M("Cart")->where($where)->delete();
        if($result){
            $data['status'] = 1;
            $data['msg'] = "删除成功！";
            $this->ajaxReturn($data);
        }else{
            $data['status'] = 0;
            $data['msg'] = "删除失败！";
            $this->ajaxReturn($data);
        }
    }
    
    //生成订单
    public function makeorder(){
        $at=I('post.at');
        $gd=I('post.gd');
        $gui=I('post.gui');
        $cid=I('post.cid');
        if(empty($at)){
            $data['status']=0;
            $data['msg']="缺少商品数量";
            $this->ajaxReturn($data);
        }
        if(empty($gd)){
            $data['status']=0;
            $data['msg']="缺少商品id";
            $this->ajaxReturn($data);
        }
        if(empty($gui)){
            $data['status']=0;
            $data['msg']="缺少商品规格id";
            $this->ajaxReturn($data);
        }
        if(empty($cid)){
            $data['status']=0;
            $data['msg']="缺少商品颜色id";
            $this->ajaxReturn($data);
        }
        $map['gid']=ltrim($gd,',');
        $map['ggid']=ltrim($gui,',');
        $map['color']=ltrim($cid,',');
        $amount=ltrim($at,',');
        $gid=explode(',',$map['gid']);
        $ggid=explode(',',$map['ggid']);
        $color=explode(',',$map['color']);
        $amo=explode(',',$amount);
        foreach($gid as $k=>$v){
            $pie[$k]['gid']=$v;
            $pie[$k]['ggid']=$ggid[$k];
            $pie[$k]['color']=$color[$k];
            $rel[$k]=M('goodscolor')->where($pie[$k])->find();
            if($amo[$k] > $rel[$k]['num']){
                $data['status']=0;
                $data['msg']="抱歉，库存不足";
                $this->ajaxReturn($data);
            }
            
        }
        $map['aid']=$_SESSION['uid'];
        $map['amount']=$amount;
        $map['is_cart']=1;
        $rand=rand(1000,9999);
        $map['orderid']=date('YmdHis',time()).$rand;
        $fa=M('order')->add($map);
        if(!empty($fa)){
            $data['status']=1;
            $data['msg']="前往结算~";
            $data['id']=$fa;
            $this->ajaxReturn($data);
        }else{
            $data['status']=0;
            $data['msg']="订单生成异常";
            $this->ajaxReturn($data);
        }
    }
    
    
    //快速购买生成订单
    public function quickbuy(){
        $cid=I('post.cid');
        $amount=I('post.amount');
        if(empty($cid)){
            $data['status']=0;
            $data['msg']="缺少重要参数";
            $this->ajaxReturn($data);
        }
        if(empty($amount)){
            $data['status']=0;
            $data['msg']="缺少商品数量";
            $this->ajaxReturn($data);
        }
        $result=M('goodscolor')->where('id ='.$cid)->find();
        if(empty($result)){
            $data['status']=0;
            $data['msg']="商品不存在";
            $this->ajaxReturn($data);
        }
        if($amount > $result['num']){
            $data['status']=0;
            $data['msg']="抱歉，库存不足";
            $this->ajaxReturn($data);
        }
        $map['aid']=$_SESSION['uid'];
        $map['gid']=$result['gid'];
        $map['ggid']=$result['ggid'];
        $map['color']=$result['color'];
        $map['amount']=$amount;
        $rand=rand(1000,9999);
        $map['orderid']=date('YmdHis',time()).$rand;
        $fa=M('order')->add($map);
        if(!empty($fa)){
            $data['status']=1;
            $data['msg']="前往结算~";
            $data['id']=$fa;
            $this->ajaxReturn($data);
        }else{
            $data['status']=0;
            $data['msg']="订单生成异常";
            $this->ajaxReturn($data);
        }
    }
    
    
    //确认订单
    public function sureorder(){
        if(IS_POST){
            $id=I('post.id');
            $aid=I('post.aid');
            $cid=I('post.cid');
            $paybeizhu=I('post.paybeizhu');
            if(empty($id)){
                $data['status']=0;
                $data['msg']="缺少必要参数";
                $this->ajaxReturn($data);
            }
            if(empty($aid)){
                $data['status']=0;
                $data['msg']="缺少收货地址";
                $this->ajaxReturn($data);
            }
            $adfi=M('address')->where('id ='.$aid)->find();
            if(empty($adfi)){
                $data['status']=0;
                $data['msg']="收货地址不存在";
                $this->ajaxReturn($data);
            }
            
            if(!empty($cid)){
                $cpmid=M('usercoupon')->where('id ='.$cid)->find();
                if(empty($cpmid)){
                    $data['status']=0;
                    $data['msg']="用户优惠券不存在";
                    $this->ajaxReturn($data);
                }
                if($cpmid['is_use'] == 1){
                    $data['status']=0;
                    $data['msg']="优惠券已使用";
                    $this->ajaxReturn($data);
                }
            }
            $r = true;
            $m=M('order');
            $m->startTrans();//事务开启
            $pis['id']=$id;
            $pis['aid']=$_SESSION['uid'];
            $nefgoods=$m->where($pis)->find();
            if($nefgoods['status'] == 1){
                $data['status']=0;
                $data['msg']="订单已生成，无法再次提交！";
                $this->ajaxReturn($data);
            }
            if($nefgoods['is_cart'] == 1){
                $goodid=explode(',',$nefgoods['gid']);
                $guigeid=explode(',',$nefgoods['ggid']);
                $colorid=explode(',',$nefgoods['color']);
                $amount=explode(',',$nefgoods['amount']);
                foreach($goodid as $k=>$v ){
                    $where['gid']=$v;
                    $where['ggid']=$guigeid[$k];
                    $where['color']=$colorid[$k];
                    $num=$amount[$k];
                    $result=M('goodscolor')->where($where)->find();
                    if($num > $result['num']){
                        $data['status']=0;
                        $data['msg']="抱歉，库存不足";
                        $this->ajaxReturn($data);
                    }
                    $mid[$k]=$result['price'];
                    $late[$k]=$result['price']*$num;
                    $res = M('goodscolor')->where($where)->setDec('num',$num);
                    if($res === false){
                        $r = false;
                    }
                    $where['uid']=$_SESSION['uid'];
                    $rul=M('cart')->where($where)->delete();
                    $unus[$k]=1;
                    $pingjia[$k]=1;
                }
                $map['unusual']=implode(',',$unus);
                $map['pingjia']=implode(',',$pingjia);
                $map['totalprice']=array_sum($late);
                $map['price']=implode(',',$mid);
            }else{
                $where['gid']=$nefgoods['gid'];
                $where['ggid']=$nefgoods['ggid'];
                $where['color']=$nefgoods['color'];
                $num=$nefgoods['amount'];
                $result=M('goodscolor')->where($where)->find();
                if($num > $result['num']){
                    $data['status']=0;
                    $data['msg']="抱歉，库存不足";
                    $this->ajaxReturn($data);
                }
                $mid=$result['price'];
                $late=$result['price']*$num;
                $res = M('goodscolor')->where($where)->setDec('num',$num);
                if($res === false){
                    $r = false;
                }
                $where['uid']=$_SESSION['uid'];
                $rul=true;
                $map['totalprice']=$late;
                $map['price']=$mid;
                $map['unusual']=1;
                $map['pingjia']=1;
            }
            $map['addressid']=$aid;
            $map['addressman']=$adfi['name'];
            $map['addressmobile']=$adfi['tel'];
            $map['address']=$adfi['province'].$adfi['city'].$adfi['address'];
            if(!empty($cid)){
                $map['totalprice']=$map['totalprice']-$cpmid['money'];
                if(!empty($cpmid)){ 
                    $map['coupon']='满'.$cpmid['conditionm'].'减'.$cpmid['money'];
                }
                $cpmap['is_use']=1;
                $cpmap['bid']=$id;
                $cpmap['usetime']=time();
                $cpzt=M('usercoupon')->where('id ='.$cid)->save($cpmap);
            }else{
                $cpzt=true;
            }
            if(!empty($paybeizhu)){
                $map['paybeizhu']=$paybeizhu;
            }
            $map['addtime']=time();
            $map['status']=1;
            $fa=$m->where('id ='.$id)->save($map);
            
            if(!empty($fa) && $res && $rul && $cpzt){
                $m->commit();//成功则提交
                $data['status']=1;
                $data['msg']="前往结算~";
                $data['id']=$id;
                $this->ajaxReturn($data);
            }else{
                $m->rollback();//不成功，则回滚
                $data['status']=0;
                $data['msg']="订单生成异常";
                $this->ajaxReturn($data);
            }
        }else{
            $top="确认订单";
            $map['id']=I('get.id');
            $map['aid']=$_SESSION['uid'];
            $result=M('order')->where($map)->find();
            $goods=explode(',',$result['gid']);
            $ggid=explode(',',$result['ggid']);
            $color=explode(',',$result['color']);
            $amount=explode(',',$result['amount']);
            $num=0;
            foreach($goods as $k=>$v){
                $where['gid']=$v;
                $where['ggid']=$ggid[$k];
                $where['color']=$color[$k];
                $orderlist[$k]['price']=M('goodscolor')->where($where)->getField('price');
                $fia=M('goods')->where('id ='.$v)->find();
                $orderlist[$k]['gname']=$fia['gname'];
                $orderlist[$k]['imgurl']=$fia['imgurl'];
                $orderlist[$k]['guige']=M('goodsnorm')->where('id ='.$ggid[$k])->getField('title');
                $orderlist[$k]['color']=M('color')->where('id ='.$color[$k])->getField('title');
                $orderlist[$k]['amount']=$amount[$k];
                $late[$k]=$orderlist[$k]['price']*$orderlist[$k]['amount'];
                $num=$num+1;
            }
            $totalprice=array_sum($late);
            $address=M('address')->where('uid ='.$_SESSION['uid'])->select();
            foreach($address as $k=>$v){
                $def=$v['is_default'];
                if($def == 1){
                    $address[$k]['border']="border-color:red";
                    $address[$k]['attr']="display:block";
                    $address[$k]['asid']=1;
                }else{
                    $address[$k]['border']="border-color:#b0b0b0";
                    $address[$k]['attr']="display:none";
                    $address[$k]['asid']=0;
                }
            }
            $uscp['uid']=$_SESSION['uid'];
            $uscp['is_use']="-1";
            $uscp['end']=array('egt',time());
            $uc=M('usercoupon')->where($uscp)->select();
            foreach($uc as $k=>$v){
                $ucoup[$k]['money']=$v['money'];
                $ucoup[$k]['condition']=$v['conditionm'];
                $ucoup[$k]['end']=$v['end'];
                $ucoup[$k]['id']=$v['id'];  
            }
            $this->assign('num',$num);
            $this->assign('id',$map['id']);
            $this->assign('ucoup',$ucoup);
            $this->assign('top',$top);
            $this->assign('totalprice',$totalprice);
            $this->assign('result',$result);
            $this->assign('orderlist',$orderlist);
            $this->assign('address',$address);
            $this->display();
        }
    }
    
    //确认支付
    public function payconf(){
        //热销推荐和配套推荐
        $listta = M('goods')->field('id,gname,imgurl,imgurl2,rooty,modelnum,is_nc')->order('addtime desc')->limit(4)->select();
        foreach ($listta as $k => $v) {
            $listta[$k]['name'] = "product_" . $v['id'];
            $listta[$k]['namegl'] = $v['id'];
            $l = explode('|', $listta[$k]['imgurl2']);
            $this->assign("product_" . $v['id'], $l);
            $lnewprice = M('goodscolor')->field('price')->where('gid = ' . $listta[$k]['id'])->order('id desc')->find();
            $listta[$k]['price'] = round($lnewprice['price'],2);
            $listta[$k]['kunum'] = intval($lnewprice['num']);
        }
        $listta2 = M('goods')->field('id,gname,imgurl,imgurl2,rooty,modelnum,is_nc')->order('ordernum desc')->limit(4)->select();
        //图片转换
        foreach ($listta2 as $k => $v) {
            $listta2[$k]['name'] = "product_" . $v['id'];
            $listta2[$k]['namegl'] = $v['id'];
            $l = explode('|', $listta2[$k]['imgurl2']);
            $this->assign("product_" . $v['id'], $l);
            $lnewprice = M('goodscolor')->field('price')->where('gid = ' . $listta2[$k]['id'])->order('id desc')->find();
            $listta2[$k]['price'] = round($lnewprice['price'],2);
            $listta2[$k]['kunum'] = intval($lnewprice['num']);
        }
        $top="确认支付";
        $map['id']=I('get.id');
        $map['aid']=$_SESSION['uid'];
        $result=M('order')->where($map)->find();
        $result['totalprice']=round($result['totalprice'],2);
        $this->assign('top',$top);
        $this->assign('result',$result);
        $this->assign('listta', $listta);
        $this->assign('listta2', $listta2);
        $this->display();
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

    

 
 
}