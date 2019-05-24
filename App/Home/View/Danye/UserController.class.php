<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends UserbaseController
{
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
    
    //充值支付方式选择
    public function chongzhi(){
        $payment = trim(I('post.payment'));
        $money = trim(I('post.money'));
        $a = array(1,2,3);
        if(!in_array($payment,$a)){
            $this->error('您选择的支付方式不存在');
        }
        if(!preg_match("/^(([0-9]+\.[0-9]*[1-9][0-9]*)|([0-9]*[1-9][0-9]*\.[0-9]+)|([0-9]*[1-9][0-9]*))$/",$money)){
            $this->error('请输入正确的充值金额');
        }
        switch($payment){
            case 1:
                $p['oid'] = $_SESSION['uid'];
                $p['orderid'] = "";
                $p['money'] = $money;
                $p['type'] = 2;
                $p['orderid'] = date('YmdHis',time()).rand(10000,99999);
                $result = M("pay_log")->add($p);
                if($result){
                    $data['title'] = "商城余额充值";
                    $data['total'] = $money;
                    $data['orderid'] = $p['orderid'];
                    alipay($data);
                }else{
                    $this->error('网络异常，请稍候操作');
                }
                break;
            case 2:
                $p['oid'] = $_SESSION['uid'];
                $p['orderid'] = "";
                $p['money'] = $money;
                $p['type'] = 2;
                $p['orderid'] = date('YmdHis',time()).rand(10000,99999);
                $result = M("pay_log")->add($p);
                if($result){
                    $data['title'] = "喜梦宝商城余额充值";
                    $data['total'] = $money;
                    $data['orderid'] = $p['orderid'];
                    $this->union($data);
                }else{
                    $this->error('网络异常，请稍候操作');
                }
                
                break;
            case 3:
                $this->redirect("user/wxcz?id=".$money);
                break;
        }
    }
    
    //微信扫码支付
    public function wxcz(){
        $id = I("id");
        
        $p['oid'] = $_SESSION['uid'];
        $p['orderid'] = "";
        $p['money'] = $id;
        $p['type'] = 2;
        $p['orderid'] = date('YmdHis',time()).rand(10000,99999);
        $result2 = M("pay_log")->add($p);
        if(!$result2){
            $this->error('网络异常，请稍候操作',U("user/pay"));
        }
        $title = "喜梦宝商城余额充值";
        $p['id'] = $result2;
        require_once "./Public/wxpay/lib/WxPay.Api.php";
        require_once "./Public/wxpay/lib/WxPay.NativePay.php";
        $notify = new \NativePay();
        $input = new \WxPayUnifiedOrder();
        $input->SetBody($title);
        $input->SetAttach($title);
        $input->SetOut_trade_no($p['orderid']);
        $input->SetTotal_fee($id*100);
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
        $this->assign('order',$p);
        $this->display();
        
    }
    
    public function czispay(){
        $id = I("post.id");
        $order = M("pay_log")->where("id=".$id)->find();
        if($order['status'] > 0){
            $this->ajaxReturn(1);
        }else{
            $this->ajaxReturn(0);
        }
    }
    
    
    //订单列表
    public function billlist(){
        $top="订单列表";
        $st=I('get.st/d');
        if(empty($st)){
            $map['status']=array('not in','0,-1');
        }else{
            if($st == "complited"){
                $map['status']=array('in','4,5');
            }else{
                $map['status']=$st;
            }
        }
        $map['aid']=(int)$_SESSION['uid'];
        $count=M('order')->where($map)->count();
        $Page = new \Think\Page($count,4);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $result=M('order')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
        foreach($result as $k => $v){
            $res=array();
            $gid=array();
            $ggid=array();
            $color=array();
            $price=array();
            $unuaual=array();
            $gid=explode(',',$v['gid']);
            $ggid=explode(',',$v['ggid']);
            $color=explode(',',$v['color']);
            $price=explode(',',$v['price']);
            $amount=explode(',',$v['amount']);
            $unuaual=explode(',',$v['unusual']);
            $sun=array_search('1',$unuaual);
            if($sun === false){
                $result[$k]['sun']=1;
            }else{
                $result[$k]['sun']=2;
            }
            foreach($gid as $key => $val){
                $rul=M('goods')->where('id ='.$val)->find();
                $res[$key]['gname']=$rul['gname'];
                $res[$key]['gurl']=$rul['imgurl'];
                $res[$key]['ggname']=M('goodsnorm')->where('id ='.$ggid[$key])->getField('title');
                $res[$key]['cname']=M('color')->where('id ='.$color[$key])->getField('title');
                $res[$key]['price']=$price[$key];
                $res[$key]['amount']=$amount[$key];
            }
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
        $this->assign('top',$top);
        $this->assign('st',$st);
        $this->assign('result',$result);
        $this->assign('page',$show);
        $this->display();
    }
    
    //订单详情
    public function billdetail(){
        $id=I('get.id');
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
        $ggid=explode(',',$result['ggid']);
        $color=explode(',',$result['color']);
        $price=explode(',',$result['price']);
        $amount=explode(',',$result['amount']);
        $unusual=explode(',',$result['unusual']);
        $pingjia=explode(',',$result['pingjia']);
        $num=0;
        foreach($gid as $key => $val){
            $rul=M('goods')->where('id ='.$val)->find();
            $res[$key]['gid']=$rul['id'];
            $res[$key]['ggid']=$ggid[$key];
            $res[$key]['cid']=$color[$key];
            $res[$key]['uid']=$_SESSION['uid'];
            $res[$key]['bid']=$id;
            $res[$key]['gname']=$rul['gname'];
            $res[$key]['gurl']=$rul['imgurl'];
            $res[$key]['ggname']=M('goodsnorm')->where('id ='.$ggid[$key])->getField('title');
            $res[$key]['cname']=M('color')->where('id ='.$color[$key])->getField('title');
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
        $result['youhui']='-'.($prevtotal-$result['totalprice']);
        $result['prevtotal']=$prevtotal;
        $this->assign('result',$result);
        $this->assign('res',$res);
        $this->display();
    }
    
    //数据加入退换货表
    public function dotuihuan(){
        $bid=I('post.bid');
        $gid=I('post.gid');
        $ggid=I('post.ggid');
        $cid=I('post.cid');
        if(empty($bid)||empty($gid)||empty($ggid)||empty($cid)){
            $data['status']=0;
            $data['msg']='参数异常';
            $this->ajaxReturn($data);
        }
        $map['bid']=$bid;
        $map['gid']=$gid;
        $map['ggid']=$ggid;
        $map['cid']=$cid;
        $map['uid']=$_SESSION['uid'];
        
        $fop=M('order')->where('id ='.$bid)->find();
        $orp=explode(',',$fop['gid']);
        $ok=array_search($gid,$orp);
        $oprice=explode(',',$fop['price']);
        $map['price']=$oprice[$ok];
        
        $result=M('tuihuan')->add($map);
        if(empty($result)){
            $data['status']=0;
            $data['msg']='申请退换货异常';
            $this->ajaxReturn($data);
        }else{
            $data['status']=1;
            $data['msg']='申请退换成功';
            $data['id']=$result;
            $this->ajaxReturn($data);
        }
    }
    
    //退换货
    public function exchangegood(){
        if(IS_POST){
            $map['id']=I('post.id');
            //dump($map['id']);
            $map['type']=I('post.type');
            $map['exp']=I('post.exp');
            $map['bid']=I('post.bid');
            $status=I('post.status');
            $map['expnum']=I('post.expnum');
            $map['reason']=I('post.reason');
            if(empty($map['id'])){
                $this->error('缺少退换记录id');
            }
            $stmid=M('tuihuan')->where('id ='.$map['id'])->find();
            $st=$stmid['status'];
            $gid=$stmid['gid'];
            if($st == 1){
                $this->error('退换申请已提交，无法再次提交');
            }
            if(empty($map['bid'])){
                $this->error('缺少订单id');
            }
            if(empty($map['type'])){
                $this->error('缺少退换类型');
            }
            if($status == 3){
                if(empty($map['exp'])){
                $this->error('缺少快递公司');
                }
                if(empty($map['expnum'])){
                    $this->error('缺少物流单号');
                }
            }
            if(empty($map['reason'])){
                $this->error('缺少退换原因');
            }
            $map['tno']=date('YmdHis',time()).rand(1000,9999);
            $map['addtime']=time();
            $map['status']=1;
            $m=M('tuihuan');
            $m->startTrans();
            $th=M('tuihuan')->save($map);
            if($map['type'] == 1){
                $mp=2;
            }else{
                $mp=3;
            }
            $fop=M('order')->where('id ='.$map['bid'])->find();
            $orp=explode(',',$fop['gid']);
            $ok=array_search($gid,$orp);
            $oun=explode(',',$fop['unusual']);
            $pingjia=explode(',',$fop['pingjia']);
            if($oun[$ok] != 1){
                $this->error('商品已申请退换货');
            }
            $oun[$ok]=$mp;
            $pingjia[$ok]=2;
            $stf['unusual']=implode(',',$oun);
            $stf['pingjia']=implode(',',$pingjia);
            $cgo=M('order')->where('id ='.$map['bid'])->save($stf);
            if($th && $cgo){
                $m->commit();//成功则提交
                $this->success('退换货申请成功',U('exchangejl'));
            }else{
                $m->rollback();//不成功，则回滚
                $this->error('退换货申请失败');
            }
        }else{
            $top="退换货";
            $id=I('get.id');
            $result=M('tuihuan')->where('id ='.$id)->find();
            $mid=M('order')->where('id ='.$result['bid'])->find();
            $result['bno']=$mid['orderid'];
            $result['status']=$mid['status'];
            $result['bman']=$mid['addressman'];
            $result['bmobile']=$mid['addressmobile'];
            $result['baddress']=$mid['address'];
            $result['bprice']=$mid['totalprice'];
            $res=M('goods')->where('id ='.$result['gid'])->find();
            $result['gname']=$res['gname'];
            $result['img']=$res['imgurl'];
            $result['ggname']=M('goodsnorm')->where('id ='.$result['ggid'])->getField('title');
            $result['cname']=M('color')->where('id ='.$result['cid'])->getField('title');
            $this->assign('top',$top);
            $this->assign('result',$result);
            $this->display();
        }
        
    }
    
    //退换货明细
    public function exchangerecord(){
        $top="退换货明细";
        $map['uid']=$_SESSION['uid'];
        $map['status']=array('neq',0);
        $count=M('tuihuan')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $result=M('tuihuan')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
        foreach($result as $k =>$v){
            $rh=M('goods')->where('id ='.$v['gid'])->find();
            $rgg=M('goodsnorm')->where('id ='.$v['ggid'])->find();
            $rco=M('color')->where('id ='.$v['cid'])->find();
            $re=M('order')->where('id ='.$v['bid'])->find();
            $result[$k]['gname']=$rh['gname'];
            $result[$k]['gimg']=$rh['imgurl'];
            $result[$k]['oid']=$re['orderid'];
            $result[$k]['ggname']=$rgg['title'];
            $result[$k]['cname']=$rco['title'];
            switch($result[$k]['status']){
                case 1:
                    $result[$k]['zt']='申请中';
                    break;
                case 2:
                    $result[$k]['zt']='已受理';
                    break;
                case -1:
                    $result[$k]['zt']='取消退换';
                    break;  
            }
        }
        $this->assign('top',$top);
        $this->assign('page',$show);
        $this->assign('result',$result);
        $this->display();
    }
    
    //退换货记录
    public function exchangejl(){
        $top="退换货记录";
        $map['uid']=$_SESSION['uid'];
        $map['status']=array('neq',0);
        $count=M('tuihuan')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $result=M('tuihuan')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
        foreach($result as $k =>$v){
            $rh=M('goods')->where('id ='.$v['gid'])->find();
            $re=M('order')->where('id ='.$v['bid'])->find();
            $result[$k]['gname']=$rh['gname'];
            $result[$k]['oid']=$re['orderid'];
            switch($result[$k]['status']){
                case 1:
                    $result[$k]['zt']='申请中';
                    break;
                case 2:
                    $result[$k]['zt']='已受理';
                    break;
                case -1:
                    $result[$k]['zt']='取消退换';
                    break;  
            }
        }
        $this->assign('top',$top);
        $this->assign('page',$show);
        $this->assign('result',$result);
        $this->display();
    }
    
    
    //取消订单
    public function billdel(){
        $id=I('post.id');
        $rh=M('order')->where('id ='.$id)->find();
        if($rh['status'] !=1){
            $data['status']=0;
            $data['msg']='订单无法取消';
            $this->ajaxReturn($data);
        }
        $m=M('order');
        $m->startTrans();//事务开启
        $result=$m->where('id ='.$id)->setField('status',-1);
        $gid=explode(',',$rh['gid']);
        $ggid=explode(',',$rh['ggid']);
        $color=explode(',',$rh['color']);
        $amount=explode(',',$rh['amount']);
        $r=true;
        foreach($gid as $k => $v){
            $pie['gid']=$v;
            $pie['ggid']=$ggid[$k];
            $pie['color']=$color[$k];
            $num=$amount[$k];
            $pi=M('goodscolor')->where($pie)->setInc('num',$num);
            if($pi === false){
                $r=false;
            }
        }
        if($result && $r){
            $m->commit();//成功则提交
            $data['status']=1;
            $data['msg']='订单删除成功';
            $this->ajaxReturn($data);
        }else{
            $m->rollback();//不成功，则回滚
            $data['status']=0;
            $data['msg']='订单删除失败';
            $this->ajaxReturn($data);
        }
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
    
    //积分明细
    public function score(){
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
        $count=M('pointmx')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
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

    //我的推荐
    public function mytj(){
        $tel = I("t");
        $stime = strtotime($_GET['stime']);
        $etime = strtotime($_GET['etime'])+86400;
        $where['pid'] = $_SESSION['uid'];
        if(!empty($tel)){
            $where['tel'] = array('like',"%".$tel."%");
        }
        if(!empty($_GET['stime']) && !empty($_GET['etime'])){
            $where['addtime'] = array('between',$stime.','.$etime);
        }
        $count = M("user")->where($where)->count();// 查询满足要求的总记录数
        $Page  = new \Think\Page($count,12);// 实例化分页类 传入总记录数和每页显示的记录数
        $show  = $Page->show();// 分页显示输出
        $mytj = M("user")->where($where)->order("addtime desc")->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('mytj',$mytj);
        $this->config['title'] = "我的推荐-".$this->config['title'];
        $this->assign('config',$this->config);
        $this->assign('page',$show);
        $this->display();
    }
    
    //数据加入评价表
    public function dojudge(){
        $bid=I('post.bid');
        $gid=I('post.gid');
        $ggid=I('post.ggid');
        $cid=I('post.cid');
        if(empty($bid)||empty($gid)||empty($ggid)||empty($cid)){
            $data['status']=0;
            $data['msg']='参数异常';
            $this->ajaxReturn($data);
        }
        $map['bid']=$bid;
        $map['gid']=$gid;
        $map['ggid']=$ggid;
        $map['cid']=$cid;
        $map['uid']=$_SESSION['uid'];
        
        $fop=M('order')->where('id ='.$bid)->find();
        $orp=explode(',',$fop['gid']);
        $ok=array_search($gid,$orp);
        $oprice=explode(',',$fop['price']);
        $map['price']=$oprice[$ok];
        
        $result=M('pingjia')->add($map);
        if(empty($result)){
            $data['status']=0;
            $data['msg']='评价异常';
            $this->ajaxReturn($data);
        }else{
            $data['status']=1;
            $data['msg']='评价成功';
            $data['id']=$result;
            $this->ajaxReturn($data);
        }
    }
    
    //评价订单
    public function judge(){
        if(IS_POST){
            $map['id']=I('post.id');
            $map['content']=I('post.content');
            $map['score']=I('post.score');
            $imgurl=I('post.imgurl');
            
            if(empty($map['id'])){
                $this->error('缺少评价id');
            }
            $stmid=M('pingjia')->where('id ='.$map['id'])->find();
            $st=$stmid['status'];
            if($st == 1){
                $this->error('该商品评价已提交，无法再次提交');
            }
            if(empty($map['content'])){
                $this->error('缺少评价内容');
            }
            if(empty($map['score'])){
                $this->error('缺少商品评分');
            }
            if(!empty($imgurl)){
                $map['img']=implode('|',$imgurl);
            }
            $map['status']=1;
            $map['addtime']=time();
            $m=M('pingjia');
            $m->startTrans();//事务回滚开启
            $rh=$m->save($map);
            $addpoint=M('user')->where('id ='.$_SESSION['uid'])->setInc('point',20);
            $adpt['money']=20;
            $adpt['addtime']=time();
            $adpt['uid']=$_SESSION['uid'];
            $adpt['xiangmu']='评价送积分';
            $adpt['yuemoney']=20+$this->user['point'];
            $pmx=M('pointmx')->add($adpt);
            $fop=M('order')->where('id ='.$stmid['bid'])->find();
            $orp=explode(',',$fop['gid']);
            $ok=array_search($stmid['gid'],$orp);
            $oun=explode(',',$fop['pingjia']);
            if($oun[$ok] != 1){
                $this->error('商品已评价');
            }
            $oun[$ok]=2;
            $fsl=array_search(1,$oun);
            if(!$fsl){
                $onew['pingjia']=implode(',',$oun);
                $onew['status']=5;
                $cgo=M('order')->where('id ='.$stmid['bid'])->save($onew);
            }else{
                $unus=implode(',',$oun);
                $cgo=M('order')->where('id ='.$stmid['bid'])->setField('pingjia',$unus);
            }
            if($rh && $cgo && $addpoint && $pmx){
                $m->commit();//成功则提交
                $this->success('评价成功',U('billlist'));
            }else{
                $m->rollback();//不成功，则回滚
                $this->error('评价失败');
            }
            
        }else{
            $top="评价商品";
            $id=I('get.id');
            $result=M('pingjia')->where('id ='.$id)->find();
            $mid=M('order')->where('id ='.$result['bid'])->find();
            $result['bno']=$mid['orderid'];
            $result['status']=$mid['status'];
            $result['bman']=$mid['addressman'];
            $result['bmobile']=$mid['addressmobile'];
            $result['baddress']=$mid['address'];
            $result['bprice']=$mid['totalprice'];
            $res=M('goods')->where('id ='.$result['gid'])->find();
            $result['gname']=$res['gname'];
            $result['img']=$res['imgurl'];
            $result['ggname']=M('goodsnorm')->where('id ='.$result['ggid'])->getField('title');
            $result['cname']=M('color')->where('id ='.$result['cid'])->getField('title');
            $this->assign('top',$top);
            $this->assign('result',$result);
            $this->display();
        }
    }
    

    //收藏商品
    public function collect(){
        $where['uid']=$_SESSION['uid'];
        $count=M('coll')->where($where)->count();
        $Page = new \Think\Page($count,16);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $mycoll=M('coll')->where($where)->order('addtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach($mycoll as $k=>$v){
            $mycoll[$k]['goods']=M('goods')->where('id ='.$mycoll[$k]['gid'])->find();
//            $glprice=M('goodscolor')->where('gid ='.$mycoll[$k]['gid'])->order('id')->find();
//            $mycoll[$k]['price']=$glprice['price'];
//            $mycoll[$k]['cid']=$glprice['id'];
        }
      dump($show);
        $top="收藏商品";
        $this->assign('top',$top);
        $this->assign('mycoll',$mycoll);
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $this->display();
    }

    //收藏商品
    public function docoll(){
        $user['gid'] = I("post.gid");
        if(empty($user['gid'])){
            $data['status'] = 0;
            $data['msg'] = "收藏商品失败！";
            $this->ajaxReturn($data);
        }
        $user['addtime']=time();
        $user['uid']=$_SESSION['uid'];
        $result = M("coll")->add($user);
        if($result !== false){
            $data['status'] = 1;
            $data['msg'] = "收藏商品成功！";
            $this->ajaxReturn($data);
        }else{
            $data['status'] = 0;
            $data['msg'] = "收藏商品失败！";
            $this->ajaxReturn($data);
        }
    }

    //取消商品
    public function bucoll(){
        $user['gid'] = I("post.gid");
        if(empty($user['gid'])){
            $data['status'] = 0;
            $data['msg'] = "收藏商品失败！";
            $this->ajaxReturn($data);
        }
		$user['uid']=$_SESSION['uid'];
        $result = M("coll")->where($user)->delete();
        if($result !== false){
            $data['status'] = 1;
            $data['msg'] = "取消收藏商品成功！";
            $this->ajaxReturn($data);
        }else{
            $data['status'] = 0;
            $data['msg'] = "取消收藏商品失败！";
            $this->ajaxReturn($data);
        }
    }
    //设置头像
    public function headimg(){
        $top="设置头像";
        $this->assign('top',$top);
        $this->display();
    }
//  //设置头像
//  public function doheadimg(){
//      $user['head1'] = trim(I("post.head1"));
//      $user['head2'] = trim(I("post.head2"));
//      $user['head3'] = trim(I("post.head3"));
//      if(empty($user['head1'])||empty($user['head2'])||empty($user['head3'])){
//          $data['status'] = 0;
//          $data['msg'] = "请选择要裁剪的头像图片！";
//          $this->ajaxReturn($data);
//      }
//      $result = M("user")->where("id = ".$_SESSION['uid'])->save($user);
//      if($result !== false){
//          $data['status'] = 1;
//          $data['msg'] = "修改成功！";
//          $this->ajaxReturn($data);
//      }else{
//          $data['status'] = 0;
//          $data['msg'] = "修改失败，请稍候操作！";
//          $this->ajaxReturn($data);
//      }
//
//  }
    //设置头像
    public function savehead(){
        require_once('./public/avatar/crop.php');

//$src = 'upload/2014/06/07/14021146715797.jpg';
        $src = ".".$_GET['src'];
        $rs = explode(".",$src);
        $ext = strtolower($rs[count($rs)-1]);

        $type = array('jpg', 'jpeg', 'png');
        $path = sprintf('%s/%s/%s/', date('Y'), date('m'), date('d'));

        $fileName = time() . rand(1000, 9999) . '.' . $ext;
        $fullName = $path . $fileName;
        $path = rtrim('./Public/avatar/upload', DIRECTORY_SEPARATOR) . '/' . $fullName;

        $crop = new \App_Util_Crop();
        $crop->initialize($src, $path, $_GET['x'], $_GET['y'], 200, 200, $_GET['w'], $_GET['h']);
        $success = $crop->generate_shot();
//print_r($success);
        $msg = $success ? '裁剪成功' : '裁剪失败';
        $user['pic'] = ltrim($path,".");
        $result = M("user")->where("id = ".$_SESSION['uid'])->save($user);
        if($result !== false){
//          dump($_GET['src']);
            unlink(ltrim($src,"."));
            $msg = '设置头像成功';
        }else{
            $msg = '设置头像失败';
        }
        echo json_encode(array('result' => $success, 'msg' => $msg));

    }

    
    
    //修改密码
    public function resetpwd(){
        $top="修改密码";
        $this->assign('top',$top);
        $this->display();
    }

    //保存密码
    public function dopwd(){
        $password = trim(I("post.password"));
        $newpwd = trim(I("post.newpwd"));
        $cfmpwd = trim(I("post.cfmpwd"));
        $pwd = md5(md5($password).$this->user['rand'].md5($this->user['tel']));
//      $pwd = md5(md5(md5($password).$this->user['rand']));


        $user = M("User")->where("id = ".$_SESSION['uid']." and password = '".$pwd."'")->find();
        if(!$user){
            $data['status'] = 0;
            $data['msg'] = "旧密码输入有误";
            $this->ajaxReturn($data);
        }
        if(strlen($newpwd) < 6 || strlen($newpwd) > 20){
            $data['status'] = 0;
            $data['msg'] = "新密码长度在6-20个字符之间";
            $this->ajaxReturn($data);
        }
        if($newpwd != $cfmpwd){
            $data['status'] = 0;
            $data['msg'] = "两次输入密码不一致";
            $this->ajaxReturn($data);
        }
        $u['rand'] = rand(10000,99999);
        $u['password'] = md5(md5($newpwd).$u['rand'].md5($this->user['tel']));
//      $u['password'] = md5(md5(md5($newpwd).$u['rand']));
        $result = M("User")->where("id = ".$_SESSION['uid'])->save($u);
        if($result !== false){
            session('uid',null);
            session('username',null);
            $data['status'] = 1;
            $data['msg'] = "修改成功！";
            $this->ajaxReturn($data);
        }else{
            $data['status'] = 0;
            $data['msg'] = "对不起，修改失败";
            $this->ajaxReturn($data);
        }
    }
    
    //修改信息
    public function resetinfor(){
        $top="我的资料";
        $this->assign('top',$top);
        $this->display();
    }

    //修改资料实现
    public function doinfo(){
        $user['uname'] = trim(I("post.uname"));
        $user['sex'] = trim(I("post.sex"));
        $user['province'] = trim(I("post.province"));
        $user['city'] = trim(I("post.city"));
        // $user['tuiman'] = trim(I("post.tuiman"));
//      $user['tel'] = trim(I("post.tel"));
//      $user['email'] = trim(I("post.email"));
//      $user['question'] = trim(I("post.question"));
//      $user['answer'] = trim(I("post.answer"));
//      $user['qq'] = trim(I("post.qq"));
//      $user['wx'] = trim(I("post.wx"));
        if(empty($user['uname'])){
            $data['status'] = 0;
            $data['msg'] = "请输入你的真实姓名！";
            $this->ajaxReturn($data);
        }
        if(empty($user['province'])||empty($user['city'])){
            $data['status'] = 0;
            $data['msg'] = "请选择完整的地址信息！";
            $this->ajaxReturn($data);
        }

//      if(!preg_match("/^1[3|4|5|8][0-9]\d{7,}$/",$user['tel'])){
//          $data['status'] = 0;
//          $data['msg'] = "请输入正确的手机号码！";
//          $this->ajaxReturn($data);
//      }
//      if(!preg_match("/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.(?:com|cn)$/",$user['email'])){
//          $data['status'] = 0;
//          $data['msg'] = "请输入正确的邮箱！";
//          $this->ajaxReturn($data);
//      }
//      if(empty($user['question'])){
//          $data['status'] = 0;
//          $data['msg'] = "请输入你的密保问题！";
//          $this->ajaxReturn($data);
//      }
//      if(empty($user['answer'])){
//          $data['status'] = 0;
//          $data['msg'] = "请输入你的密保答案！";
//          $this->ajaxReturn($data);
//      }
//      if(!empty($user['qq'])){
//          if(!preg_match("/^\d{5,10}$/",$user['qq'])){
//              $data['status'] = 0;
//              $data['msg'] = "请输入正确的QQ号码！";
//              $this->ajaxReturn($data);
//          }
//      }
        $result = M("user")->where("id = ".(int)$_SESSION['uid'])->save($user);
        if($result !== false){
            $data['status'] = 1;
            $data['msg'] = "修改成功！";
            $this->ajaxReturn($data);
        }else{
            $data['status'] = 0;
            $data['msg'] = "修改失败，请稍候操作！";
            $this->ajaxReturn($data);
        }
    }

    //已评价订单
    public function billjudge(){
        $top="已评价订单";
        $map['uid']=$_SESSION['uid'];
        $map['status']=1;
        $count=M('pingjia')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $result=M('pingjia')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
        foreach($result as $k => $v){
            $res=M('goods')->where('id ='.$v['gid'])->find();
            $result[$k]['gname']=$res['gname'];
            $result[$k]['gimg']=$res['imgurl'];
            $order=M('order')->where('id = '.$v['bid'])->find();
            $result[$k]['otime']=$order['addtime'];
            $result[$k]['img']=explode('|',$v['img']);
        }
        $this->assign('top',$top);
        $this->assign('page',$show);
        $this->assign('result',$result);
        $this->display();
    }
    
    //优惠券列表
    public function couponlist(){
        $top="优惠券列表";
        $map['is_use']=-1;
        $map['end']=array('gt',time());
        $map['uid']=$_SESSION['uid'];
        $count=M('usercoupon')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $result=M('usercoupon')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
        foreach($result as $k => $v){
            $result[$k]['money']=$v['money'];
            $result[$k]['limit']=$v['conditionm'];
            $result[$k]['start']=$v['start'];
            $result[$k]['end']=$v['end'];
            $result[$k]['addtime']=$v['addtime'];
        }
        $this->assign('top',$top);
        $this->assign('st',$st);
        $this->assign('page',$show);
        $this->assign('result',$result);
        $this->display();
    }
    
    //过期优惠券列表
    public function couponod(){
        $top="过期优惠券列表";
        $map['end']=array('lt',time());
        $map['uid']=$_SESSION['uid'];
        
        $count=M('usercoupon')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $result=M('usercoupon')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
        foreach($result as $k => $v){
            $result[$k]['money']=$v['money'];
            $result[$k]['limit']=$v['conditionm'];
            $result[$k]['start']=$v['start'];
            $result[$k]['end']=$v['end'];
            $result[$k]['addtime']=$v['addtime'];
        }
        $this->assign('top',$top);
        $this->assign('st',$st);
        $this->assign('page',$show);
        $this->assign('result',$result);
        $this->display();
    }
    
    //已使用优惠券列表
    public function couponused(){
        $top="已使用优惠券列表";
        $map['is_use']=1;
        $map['uid']=$_SESSION['uid'];
        $count=M('usercoupon')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $result=M('usercoupon')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
        foreach($result as $k => $v){
            $result[$k]['money']=$v['money'];
            $result[$k]['limit']=$v['conditionm'];
            $result[$k]['start']=$v['start'];
            $result[$k]['end']=$v['end'];
            $result[$k]['addtime']=$v['addtime'];
        }
        $this->assign('top',$top);
        $this->assign('st',$st);
        $this->assign('page',$show);
        $this->assign('result',$result);
        $this->display();
    }

   //银行卡列表
    public function bank(){
        $where['uid'] = $_SESSION['uid'];
        $bank = M("bank")->where($where)->order("addtime desc")->select();
        $this->assign('bank',$bank);
        $this->config['title'] = "银行卡管理-".$this->config['title'];
        $this->assign('config',$this->config);
        $this->display();
    }
    
    //新增银行卡
    public function bank_add(){
        $this->config['title'] = "新增银行卡-".$this->config['title'];
        $this->assign('config',$this->config);
        $this->display();
    }
    
    //新增银行卡实现
    public function bankadd(){
        
        if(empty($_POST['bank'])){
            $data['status'] = 0;
            $data['msg'] = "请输入开户行名称";
            $this->ajaxReturn($data);
        }
        if(!preg_match("/^[0-9]{16,19}$/",$_POST['no'])){
            $data['status'] = 0;
            $data['msg'] = "银行卡账号格式不正确";
            $this->ajaxReturn($data);
        }
        if(trim($_POST['no']) != trim($_POST['cfmno'])){
            $data['status'] = 0;
            $data['msg'] = "两次输入银行卡账号不一致";
            $this->ajaxReturn($data);
        }
        if(empty($_POST['name'])){
            $data['status'] = 0;
            $data['msg'] = "请输入户名";
            $this->ajaxReturn($data);
        }
        $count = M("bank")->where("id = ".$_SESSION['uid'])->count();
        if($count >= 8){
            $data['status'] = 0;
            $data['msg'] = "最多只能添加8张银行卡";
            $this->ajaxReturn($data);
        }
        $bank = M("Bank");
        $bank->create();
        $bank->addtime = time();
        $bank->uid = $_SESSION['uid'];
        $result = $bank->add();
        if($result){
            $data['status'] = 1;
            $data['msg'] = "新增成功！";
            $this->ajaxReturn($data);
        }else{
            $data['status'] = 0;
            $data['msg'] = "对不起，新增失败，请稍候操作";
            $this->ajaxReturn($data);
        }
        
    }
    
    //修改银行卡
    public function bank_edit(){
        $id = I("id");
        $bank = M("Bank")->where("id = ".$id." and uid = ".$_SESSION['uid'])->find();
        if($bank){
        $this->config['title'] = "修改银行卡-".$this->config['title'];
        $this->assign('config',$this->config);
        $this->assign('bank',$bank);
        $this->display();
        }else{
            $this->error('差错啦，没有该数据');
        }
    }
    
    //修改银行卡实现
    public function bankedit(){
        if(empty($_POST['bank'])){
            $data['status'] = 0;
            $data['msg'] = "请输入开户行名称";
            $this->ajaxReturn($data);
        }
        if(!preg_match("/^[0-9]{16,19}$/",$_POST['no'])){
            $data['status'] = 0;
            $data['msg'] = "银行卡账号格式不正确";
            $this->ajaxReturn($data);
        }
        if(empty($_POST['name'])){
            $data['status'] = 0;
            $data['msg'] = "请输入户名";
            $this->ajaxReturn($data);
        }
        $bank = M("Bank");
        $bank->create();
        $result = $bank->save();
        if($result !== false){
            $data['status'] = 1;
            $data['msg'] = "修改成功！";
            $this->ajaxReturn($data);
        }else{
            $data['status'] = 0;
            $data['msg'] = "对不起，修改失败，请稍候操作";
            $this->ajaxReturn($data);
        }
        
    }
    
    //银行卡删除
    public function bankdel(){
        $id = I("id");
        $bank = M("Bank")->where("id = ".$id." and uid = ".$_SESSION['uid'])->find();
        if($bank){
            $result = M("Bank")->where("id = ".$id)->delete();
            if($result){
                $data['status'] = 1;
                $data['msg'] = "删除成功！";
                $this->ajaxReturn($data);
            }else{
                $data['status'] = 0;
                $data['msg'] = "删除失败，请稍候操作";
                $this->ajaxReturn($data);
            }
        }else{
            $data['status'] = 0;
            $data['msg'] = "要删除的数据不存在";
            $this->ajaxReturn($data);
        }
    }

    //提现申请
    public function txsq()
    {
        $bank = M("Bank")->where("uid = ".$_SESSION['uid'])->order("addtime desc")->select();
        $balance = M('user')->getFieldById($_SESSION['uid'],'balance');
        $this->config['title'] = "余额提现-".$this->config['title'];
        $this->assign('config',$this->config);
        $this->assign('bank',$bank);
        $this->assign('balance',$balance);
        $this->assign('top',"余额提现");
        $this->display();
    }
    
    //提现申请实现
    public function dotxsq(){
        if(empty($_POST['bank'])){
            $data['status'] = 0;
            $data['msg'] = "请选择银行卡";
            $this->ajaxReturn($data);
        }
        $bank = M("Bank")->where("id = ".$_POST['bank']." and uid=".$_SESSION['uid'])->find();
        if(empty($bank)){
            $data['status'] = 0;
            $data['msg'] = "你选择银行卡不存在";
            $this->ajaxReturn($data);
        }
        
        if(!preg_match('/^[0-9]+(.[0-9]{1,2})?$/', $_POST['money'])){
            $data['status'] = 0;
            $data['msg'] = "请输入正确的提现金额";
            $this->ajaxReturn($data);
        }
        if($_POST['money'] == 0){
            $data['status'] = 0;
            $data['msg'] = "提现金额不能为0";
            $this->ajaxReturn($data);
        }
        if($_POST['money'] > $this->user['balance']){
            $data['status'] = 0;
            $data['msg'] = "提现金额不能大于可提现金额";
            $this->ajaxReturn($data);
        }
        $b['bank'] = $bank['bank'];
        $b['bno'] = $bank['no'];
        $b['name'] = $bank['name'];
        $b['money'] = $_POST['money'];
        $b['uid'] = $_SESSION['uid'];
        $b['addtime'] = time();
        $result = M("tixian")->add($b);
        if($result){
            M("User")->where("id = ".$_SESSION['uid'])->setDec('balance',$_POST['money']);
            $data['status'] = 1;
            $data['msg'] = "信息提交成功！";
            $this->ajaxReturn($data);
        }else{
            $data['status'] = 0;
            $data['msg'] = "对不起，提现失败，请稍候操作";
            $this->ajaxReturn($data);
        }
    }
    
    //提现记录
    public function tx_record(){
        $where['uid'] = $_SESSION['uid'];
        $count = M("tixian")->where($where)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $tixian = M("tixian")->where($where)->order("addtime desc")->limit($Page->firstRow.','.$Page->listRows)->select();
        // dump($tixian);die;
        $this->assign('tixian',$tixian);
        $this->config['title'] = "提现记录-".$this->config['title'];
        $this->assign('config',$this->config);
        $this->assign('page',$show);
        $this->assign('top',"提现记录");
        $this->display();
    }
    
    //选择银行卡
    public function bank_select(){
        $where['uid'] = $_SESSION['uid'];
        $bank = M("bank")->where($where)->order("addtime desc")->select();
        foreach($bank as $k => $v){
            $str = substr($v['no'], -4);
            $bank[$k]['no'] = $str;
        }
        $this->assign('bank',$bank);
        $this->config['title'] = "选择银行卡-".$this->config['title'];
        $this->assign('config',$this->config);
        $this->assign('top',"选择银行卡");
        $this->display();
    }

    //购物车
    public function cart(){
        $uid=$_SESSION['uid'];
        $count=M('cart')->where('uid ='.$uid)->count();
        $clist=M('cart')->where('uid ='.$uid)->select();
        foreach($clist as $k=>$v){
			if($v['is_norm'] == 1){
				$res=M("goods")->where('id ='.$v['gid'])->find();
				$cart[$k]['gname']=$res['gname'];
				$cart[$k]['imgurl']=$res['imgurl'];
				$cart[$k]['keywords']=$res['keywords'];
				$cart[$k]['is_up']=$res['is_up'];
				$nidarray=array();
				$nidarray=explode('|',$v['nid']);
				$map=array();
				foreach($nidarray as $key => $val){
					$map["nt".$key]=$val;
				}
				$map['gid']=$v['gid'];
				$str=M('goodsnormpn')->where($map)->find();
				$cart[$k]['price']=$str['prices'];
				$cart[$k]['nums']=$str['nums'];
				$cart[$k]['val']=$v['val'];
                $cart[$k]['id']=$v['id'];
				$cart[$k]['gid']=$v['gid'];
				$cart[$k]['is_norm']=$v['is_norm'];
				$cart[$k]['num']=$v['num'];
			}else{
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
		}
		// dump($cart);die;
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
        if(empty($result)){
            $data['status']=0;
            $data['msg']='该商品已移除购物车';
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

    //地址
    public function address(){
        $id = I("id");
        if(!empty($id)){
            $addr = M("Address")->where("id = ".$id." and uid = ".$_SESSION['uid'])->find();
            if($addr){
                $this->assign('addr',$addr);
            }else{
                $this->error('没有该数据');
            }
//          dump($addr);
        }
        $where['uid'] = $_SESSION['uid'];
        $address = M("address")->where($where)->order("addtime desc")->select();
        $this->assign('address',$address);
        $top="地址管理";
        $this->assign('top',$top);
        $this->display();
    }
    
    //确认订单中的修改地址
    public function changeadd(){
        $id=I('get.id');
        $result=M('address')->where('id ='.$id)->find();
        if(!empty($result)){
            $data['status']=1;
            $data['name']=$result['name'];
            $data['province']=$result['province'];
            $data['city']=$result['city'];
            $data['address']=$result['address'];
            $data['tel']=$result['tel'];
            $data['is_default']=$result['is_default'];
            $data['id']=$result['id'];
            $this->ajaxReturn($data);
        }else{
            $data['status']=0;
            $data['msg']="该地址不存在";
            $this->ajaxReturn($data);
        }
    }

    //地址保存实现
    public function doaddr(){
        //dump($_POST);exit;
        if(empty($_POST['name'])){
            $data['status'] = 0;
            $data['msg'] = "请输入收货人";
            $this->ajaxReturn($data);
        }

        if(empty($_POST['sheng']) || empty($_POST['shi']) || empty($_POST['address'])){
            $data['status'] = 0;
            $data['msg'] = "请输入完整的收货地址";
            $this->ajaxReturn($data);
        }
        if(!preg_match("/^1[3|4|5|7|8][0-9]\d{8}$/",$_POST['tel'])){
            $data['status'] = 0;
            $data['msg'] = "请输入正确的手机号码！";
            $this->ajaxReturn($data);
        }
        $id = trim(I("post.id"));
        if(empty($id)){
//          $count = M("Address")->where("uid = ".$_SESSION['uid'])->count();
//          if($count >= 5){
//              $data['status'] = 0;
//              $data['msg'] = "最多只能新增5个地址";
//              $this->ajaxReturn($data);
//          }
            $addr = M("address");
            $addr->create();
            $addr->addtime = time();
            $addr->uid = $_SESSION['uid'];
            
            if(empty($_POST['is_default'])){
                $addr->is_default = -1;
            }else{
                $addr->is_default = 1;
            }
            $result = $addr->add();
            if($result){
                if(!empty($_POST['is_default'])){
                    M("address")->where("id!=".$result." and uid = ".$_SESSION['uid'])->setField('is_default',-1);
                }
                $data['status'] = 1;
                $data['msg'] = "新增成功！";
                $this->ajaxReturn($data);
            }else{
                $data['status'] = 0;
                $data['msg'] = "新增失败！";
                $this->ajaxReturn($data);
            }
        }else{
            $address = M("address")->where("id = ".$id." and uid = ".$_SESSION['uid'])->find();
            if(empty($address)){
                $data['status'] = 0;
                $data['msg'] = "该数据不存在";
                $this->ajaxReturn($data);
            }
            $addr = M("address");
            $addr->create();
            if(empty($_POST['is_default'])){
                $addr->is_default = -1;
            }else{
                $addr->is_default = 1;
            }
            
            $result = $addr->save();
            if($result !== false){
                if(!empty($_POST['is_default'])){
                    M("address")->where("id != ".$id." and uid=".$_SESSION['uid'])->setField('is_default',-1);
                }
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

    //地址删除
    public function addrdel(){
        $id = I("id");
        $address = M("address")->where("id = ".$id." and uid = ".$_SESSION['uid'])->find();
        if($address){
            $result = M("address")->where("id = ".$id)->delete();
            if($result){
                $data['status'] = 1;
                $data['msg'] = "删除成功！";
                $this->ajaxReturn($data);
            }else{
                $data['status'] = 0;
                $data['msg'] = "删除失败，请稍候操作";
                $this->ajaxReturn($data);
            }
        }else{
            $data['status'] = 0;
            $data['msg'] = "要删除的数据不存在";
            $this->ajaxReturn($data);
        }
    }


    
    //抽奖
    public function choujiang(){
        $top="抽奖";
        $map['title'] = array('notlike', '%谢谢参与%');
        $fina=M('prizerecord')->where($map)->order('addtime desc')->limit(10)->select();
        foreach($fina as $k => $v){
            $tel=M('user')->where('id ='.$v['uid'])->getField('tel');
            $fina[$k]['cmobile']=substr_replace($tel,"****",3,6);
        }
        $result=M('prize')->select();
        $this->assign('top',$top);
        $this->assign('result',$result);
        $this->assign('fina',$fina);
        $this->display();
    }
    
    public function checkPoint(){
        $fiuser=M('user')->where('id ='.$_SESSION['uid'])->find();
        if($fiuser['point']-10 < 0){
            $data['status']=0;
            $data['msg']='积分不足';
            $this->ajaxReturn($data);
        }else{
            $data['status']=1;
            $data['msg']='成功';
            $this->ajaxReturn($data);
            
        }
        
        
    }
    
    public function jiangpin(){
        //prize表示奖项内容，v表示中奖几率(若数组中七个奖项的v的总和为100，如果v的值为1，则代表中奖几率为1%，依此类推)
        $prize=M('prize')->select();
        foreach($prize as $k =>$v){
            $prize_arr[$k]['id']=$k;
            $prize_arr[$k]['prize']=$v['title'];
            $prize_arr[$k]['v']=rtrim($v['rate'],'%');
        }
        foreach ($prize_arr as $k=>$v) {
            $arr[$v['id']] = $v['v'];

        }

        $prize_id =$this->getRand($arr); //根据概率获取奖项id 
        foreach($prize_arr as $k=>$v){ //获取前端奖项位置
            if($v['id'] == $prize_id){
             $prize_site = $k;
             break;
            }
        }
        //$res = $prize_arr[$prize_id -1]; //中奖项 
        $res = $prize_arr[$prize_id]; //中奖项
        $fu=M('user')->where('id ='.$_SESSION['uid'])->find();
        $m=M('user');
        $m->startTrans();//事务回滚开启
        $math['uid']=$_SESSION['uid'];
        $math['xiangmu']="抽奖消耗积分";
        $math['money']=-10;
        $math['addtime']=time();
        $math['yuemoney']=$fu['point']-10;
        $pfi=M('pointmx')->add($math);  
        $setfi=$m->where('id ='.$_SESSION['uid'])->setDec('point',10);
        $prir['uid']=$_SESSION['uid'];
        $prir['title']=$res['prize'];
        $prir['addtime']=time();
        $recordp=M('prizerecord')->add($prir);
        if(!empty($pfi) && !empty($recordp) && $setfi){
            $m->commit();//成功则提交
            $data['prize_name'] = $res['prize'];
            $data['prize_site'] = $prize_site;//前端奖项从-1开始
            $data['prize_id'] = $prize_id;
            echo json_encode($data);
        }else{
            $m->rollback();//失败则回滚
        }
        
    }

    public function getRand($proArr) {
        $data = '';
        $proSum = array_sum($proArr); //概率数组的总概率精度 

        foreach ($proArr as $k => $v) { //概率数组循环
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $v) {
                $data = $k;
                break;
            } else {
                $proSum -= $v;
            }
        }
        unset($proArr);

        return $data;
    }
    
    public function delth(){
        $id=I('post.id');
        $result=M('tuihuan')->where('id ='.$id)->find();
        $fop=M('order')->where('id ='.$result['bid'])->find();
        $orp=explode(',',$fop['gid']);
        $ok=array_search($gid,$orp);
        $oun=explode(',',$fop['unusual']);
        $pingjia=explode(',',$fop['pingjia']);
        if($oun[$ok] == 1){
            $data['status']=0;
            $data['msg']="该物品已不属于退换状态";
            $this->ajaxReturn($data);
        }
        $m=M('order');
        $m->startTrans();//事务开启
        $del=M('tuihuan')->where('id ='.$id)->delete();
        $oun[$ok]=1;
        $pingjia[$ok]=1;
        $stf['unusual']=implode(',',$oun);
        $stf['pingjia']=implode(',',$pingjia);
        $cgo=$m->where('id ='.$result['bid'])->save($stf);
        if(($result['status'] == 1) && $cgo && $del){
            $m->commit();
            $data['status']=1;
            $data['msg']="取消退换成功";
            $this->ajaxReturn($data);
        }else{
            $m->rollback();
            $data['status']=0;
            $data['msg']="取消退换失败";
            $this->ajaxReturn($data);
        }
        
    }   
}