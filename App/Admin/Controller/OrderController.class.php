<?php
namespace Admin\Controller;
use Think\Controller;
class OrderController extends BaseController {
	/**
	*	订单列表
	**/
    public function orderList(){
        //参数获取
        $search['cate'] = I('get.cate');
        $search['end'] = I('get.end');
        $search['start'] = I('get.start');
        $search['title'] = I('get.title');
		if(!empty($search['cate'])){
			$map['status'] = $search['cate'];
		}
        if(!empty($search['title'])){
            $map['orderid'] = array('like', '%' . $search['title'] . '%');
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
        $count=M('order')->where($map)->count();
        $Page = adminpage($count,10);
        //$Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('order')->where($map)->order('addtime desc')->limit($Page->firstRow.','.$Page->listRows)->
        select();
		foreach($list as $k=>$v){
			$user=M('user')->where('id ='.$v['aid'])->find();
			$list[$k]['uname']=$user['uname'];
			$list[$k]['tel']=$user['tel'];
			switch($v['status']){
				case -3:
					$list[$k]['zt']="换货";
					break;
				case -2:
					$list[$k]['zt']="退货";
					break;
				case -1:
					$list[$k]['zt']="订单已取消";
					break;
				case 1:
					$list[$k]['zt']="未付款";
					break;			
				case 2:
					$list[$k]['zt']="已付款";
					break;
				case 3:
					$list[$k]['zt']="已发货";
					break;
				case 4:
					$list[$k]['zt']="已签收";
					break;
				case 5:
					$list[$k]['zt']="已完成";
					break;		
			}
		}
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $this->display();
    }
   //这里是导出Excel 表
    public function exportmessages(){
            vendor("PHPExcel.PHPExcel");
            $res = M('order');
            $status= I('get.status');
	        $end= I('get.end');
	        $start= I('get.start');
			if(!empty($status)){
				$map['status'] = $status;
			}
            if (!empty($end)) {
	            $end= strtotime($end) + 86399;
	        }else{
	            $end= time();
	        }
	        // 查询条件（开始时间）设置
	        if (!empty($start)) {
	            $start = strtotime($start);
	            if($start > $end){
	                $this->error('开始时间不能大于结束时间');
	            }
	            $map['addtime'] = array('BETWEEN', array($start, $end));
	        }else{
	            $map['addtime'] = array('LT', $end);
	        }
            $list= $res->where($map)->order('addtime desc')->select();   //查出数据
            foreach ($list as $k=> $v) {
            	$list[$k]['gids']=explode(',', $list[$k]['gid']);
                foreach ($list[$k]['gids'] as $k2 => $v2) {
                	$list[$k]['gnames'].=M('goods')->where('id='.$v2)->getField('gname').'|';
                }
                //$list[$k]['gnames'].=$list[$k]['gids']['gname1'].'|';
                switch($list[$k]['status']){
					case -1:
						$list[$k]['zt']="订单已取消";
						break;			
					case 1:
						$list[$k]['zt']="未付款";
						break;
					case 2:
						$list[$k]['zt']="已付款";
						break;
					case 3:
						$list[$k]['zt']="已发货";
						break;
					case 4:
						$list[$k]['zt']="已签收";
						break;
					case 5:
						$list[$k]['zt']="已完成";
						break;		
		        }
            }
            $name='Excelfile';    //生成的Excel文件文件名
            $res=push($list,$name);
    }
	//订单详情
    public function orderdetail(){
        $id=I('get.id');
		if(empty($id)){
			$this->error('参数异常');
		}
		$result=M('order')->where('id ='.$id)->find();
		switch($result['status']){
				case -3:
					$result['zt']="换货";
					break;
				case -2:
					$result['zt']="退货";
					break;
				case -1:
					$result['zt']="订单已取消";
					break;			
				case 1:
					$result['zt']="未付款";
					break;
				case 2:
					$result['zt']="已付款";
					break;
				case 3:
					$result['zt']="已发货";
					break;
				case 4:
					$result['zt']="已签收";
					break;
				case 5:
					$result['zt']="已完成";
					break;		
		}
		$user=M('user')->where('id ='.$result['aid'])->find();
		$result['user']=$user['uname'];
		if(empty($result['paytype'])){
			$result['payment']="暂未支付";
		}else{
			switch($result['paytype']){
				case 1:
					$result['payment']="支付宝支付";
					break;
				case 2:
					$result['payment']="微信支付";
					break;
				case 3:
					$result['payment']="银联支付";
					break;
			}
		}
		$goods=explode(',',$result['gid']);
		$amount=explode(',',$result['amount']);
		$norm=explode(',',$result['val']);
		$price=explode(',',$result['price']);
		$unusual=explode(',',$result['unusual']);
		foreach($goods as $k=>$v){
			$rh=M('goods')->where('id ='.$v)->find();
			$glist[$k]['title']=$rh['gname'];
			$glist[$k]['norm']=$norm[$k];
			$glist[$k]['price']=$price[$k];
			$glist[$k]['amount']=$amount[$k];
			switch($unusual[$k]){
				case 1:
					$glist[$k]['unusual']='正常';
					break;
				case 2:
					$glist[$k]['unusual']='退货';
					break;
				case 3:
					$glist[$k]['unusual']='换货';
					break;		
			}
		}
		$orderlogs=M('orderlog')->where('oid ='.$id)->order('addtime desc')->select();
		$this->assign('result',$result);
		$this->assign('glist',$glist);
		$this->assign('orderlogs',$orderlogs);
		$this->display();
    }
	
	
	//订单发货
	public function orderchange(){
		if(IS_POST){
			$id=I('post.id');
			$map['aid']=$_SESSION['adminid'];
			$map['aname']=$_SESSION['name'];
			$map['type']="发货";
			$map['oid']=$id;
			$exp=I('post.exp');
			$expnum=I('post.expnum');
			if(empty($id)){
				$this->error('缺少重要参数');
			}
			if(empty($exp)){
				$this->error('缺少物流公司');
			}
			if(empty($expnum)){
				$this->error('缺少物流单号');
			}
			$data['exp']=$exp;
			$data['expnum']=$expnum;
			$data['fhtime']=time();
			$data['status']=3;
			$data['fhbeizhu']=I('post.fhbeizhu');
			$m=M('order');
			$m->startTrans();//事务开启
			$result=$m->where('id ='.$id)->setField($data);
			$map['addtime']=time();
			$map['uid']=$m->where('id ='.$id)->getField('aid');
			$rt=M('orderlog')->add($map);
			if($result && $rt){
				$m->commit();//成功则提交
				$this->success('物流信息添加成功',U('orderList'));
			}else{
				$m->rollback();//不成功，则回滚
				$this->error('物流信息添加失败');
			}
		}else{
			$id=I('get.id');
			$this->assign('id',$id);
			$this->display();
		}	
	}
	
	//修改物流
	public function expedit(){
		if(IS_POST){
			$id=I('post.id');
			if(empty($id)){
				$this->error('缺少重要参数');
			}
			$map['aid']=$_SESSION['adminid'];
			$map['aname']=$_SESSION['name'];
			$map['type']="修改物流信息";
			$map['oid']=$id;
			$exp=I('post.exp');
			$expnum=I('post.expnum');
			if(empty($exp)){
				$this->error('缺少物流公司');
			}
			if(empty($expnum)){
				$this->error('缺少物流单号');
			}
			$data['exp']=$exp;
			$data['expnum']=$expnum;
			$data['fhbeizhu']=I('post.fhbeizhu');
			$m=M('order');
			$m->startTrans();//事务开启
			$result=$m->where('id ='.$id)->setField($data);
			$map['addtime']=time();
			$rt=M('orderlog')->add($map);
			if($result && $rt){
				$m->commit();//成功则提交
				$this->success('物流信息修改成功',U('orderList'));
			}else{
				$m->rollback();//不成功，则回滚
				$this->error('物流信息修改失败');
			}
		}else{
			$id=I('get.id');
			$fina=M('order')->where('id ='.$id)->find();
			$this->assign('id',$id);
			$this->assign('fina',$fina);
			$this->display();
		}	
	}
    
	
	//取消订单
	public function del(){
		$id=I('post.id');
		$map['aid']=$_SESSION['adminid'];
		$map['aname']=$_SESSION['name'];
		$map['type']="取消订单";
		$map['oid']=$id;
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
		$map['addtime']=time();
		$map['uid']=$m->where('id ='.$id)->getField('aid');
		$rt=M('orderlog')->add($map);
		if($result && $rt && $r){
			$m->commit();//成功则提交
			$data['status']=1;
			$data['msg']='订单取消成功';
			$this->ajaxReturn($data);
		}else{
			$m->rollback();//不成功，则回滚
			$data['status']=0;
			$data['msg']='订单取消失败';
			$this->ajaxReturn($data);
		}
	}
	
	//设为收货
	public function takeover(){
		$id=I('post.id');
		$map['aid']=$_SESSION['adminid'];
		$map['aname']=$_SESSION['name'];
		$map['type']="设为收货";
		$map['oid']=$id;
		$rh=M('order')->where('id ='.$id)->getField('status');
		$num=array('-3','-2','3');
		if(!in_array($rh,$num)){
			$data['status']=0;
			$data['msg']='订单无法设为收货';
			$this->ajaxReturn($data);
		}
		$m=M('order');
		$m->startTrans();//事务开启
		$result=$m->where('id ='.$id)->setField('status',4);
		$map['addtime']=time();
		$map['uid']=$m->where('id ='.$id)->getField('aid');
		$rt=M('orderlog')->add($map);
		if($result && $rt){
			$m->commit();//成功则提交
			$data['status']=1;
			$data['msg']='订单设为收货成功';
			$this->ajaxReturn($data);
		}else{
			$m->rollback();//不成功，则回滚
			$data['status']=0;
			$data['msg']='订单设为收货失败';
			$this->ajaxReturn($data);
		}
	}
	
	//退换列表
	public function tuihuanList(){
		//参数获取
        $search['end'] = I('get.end');
        $search['start'] = I('get.start');
        $search['title'] = I('get.title');
        if(!empty($search['title'])){
            $map['bid'] = array('like', '%' . $search['title'] . '%');
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
		$map['status']=array('neq',0);
		$count=M('tuihuan')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
		$result=M('tuihuan')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
		foreach($result as $k =>$v){
			$rh=M('goods')->where('id ='.$v['gid'])->find();
			$re=M('order')->where('id ='.$v['bid'])->find();
			$ru=M('user')->where('id ='.$v['uid'])->find();
			$result[$k]['gname']=$rh['gname'];
			$result[$k]['oid']=$re['orderid'];
			$result[$k]['uname']=$ru['uname'];
			$result[$k]['tel']=$ru['tel'];
			if(!empty($v['confirm'])){
				if($v['confirm'] == 1){
					$result[$k]['con']="同意";
				}else{
					$result[$k]["con"]='拒绝';
				}
			}
			
			if(!empty($v['admin'])){
				$result[$k]['adname']=M('admin')->where('id ='.$v['admin'])->getField('username');
			}
			switch($result[$k]['status']){
				case 1:
					$result[$k]['zt']='申请退换';
					break;
				case 2:
					$result[$k]['zt']='已受理';
					break;
				case -1:
					$result[$k]['zt']='取消退换';
					break;	
			}
		}
		$this->assign('result',$result);
		$this->assign('page',$show);
		$this->assign('count',$count);
		$this->display();
	}
	
	//退换受理
	public function tuihuanedit(){
		if(IS_POST){
			$id=I('post.id');
			$bid=I('post.bid');
			$gid=I('post.gid');
			$uid=I('post.uid');
			$confirm=I('post.confirm');
			$cjnum=I('post.cjnum');
			$thbeizhu=I('post.thbeizhu');
			if(empty($id)){
				$this->error('id不能为空');
			}
			if(empty($confirm)){
				$this->error('受理状态不能为空');
			}
			if(empty($bid)){
				$this->error('订单id不能为空');
			}
			if(empty($gid)){
				$this->error('商品id不能为空');
			}
			$fop=M('order')->where('id ='.$bid)->find();
			$orp=explode(',',$fop['gid']);
			$ok=array_search($gid,$orp);
			$oun=explode(',',$fop['unusual']);
			if($oun[$ok] == 1){
				$this->error('商品未申请退换货');
			}
			//修改判断
			if($cjnum<0){
				$zcjnum=-$cjnum;
				if($zcjnum >$fop['totalprice'] ){
					$this->error('返回差价已大于总价！');
				}
			}else{
				if($cjnum >$fop['totalprice'] ){
					$this->error('返回差价已大于总价！');
				}
			}
			$m=M('tuihuan');
			$m->startTrans();//事务开启
			$map['status']=2;
			$map['chajia']=$cjnum;
			$map['confirm']=$confirm;
			$map['admin']=$_SESSION['adminid'];
			$re=$m->where('id ='.$id)->save($map);
			if(!empty($cjnum)){
				if($cjnum < 0){
					$ttp=M('order')->where('id ='.$bid)->setInc('totalprice',$cjnum);
					$utp=M('user')->where('id ='.$uid)->setInc('yue',$zcjnum);
					$uinfor=M('user')->where('id ='.$uid)->find();
				}else{
					$ttp=M('order')->where('id ='.$bid)->setInc('totalprice',$cjnum);
					$utp=true;
					$mxr=true;
				}
			}else{
				$ttp=true;
				$mxr=true;
				$utp=true;
			}
			$fsl=array_search(1,$oun);
			if(!$fsl){
				$onew['status']=5;
				$onew['thbeizhu']=$thbeizhu;
				$cgo=M('order')->where('id ='.$bid)->save($onew);
			}else{
				$onew['thbeizhu']=$thbeizhu;
				$cgo=M('order')->where('id ='.$bid)->save($onew);
			}
			$reason="退换货返差价";
			$score_res=add_moneymx($uid,$reason,$cjnum);
			if($score_res == 0){
				$m->rollback();
				$this->error('财务明细生成失败');
			}
			if(($cgo !== false) && $mxr && $ttp && ($re!==false) && $utp){
				$m->commit();
				$this->success('退换受理成功',U('tuihuanList'));
			}else{
				$m->rollback();
				$this->error('退换受理失败');
			}
		}else{
			$id=I('get.id');
			if(empty($id)){
				$this->error('参数异常');
			}
			$result=M('tuihuan')->where('id ='.$id)->find();
			$rh=M('goods')->where('id ='.$result['gid'])->find();
			$re=M('order')->where('id ='.$result['bid'])->find();
			$ru=M('user')->where('id ='.$result['uid'])->find();
			$result['gname']=$rh['gname'];
			$result['oid']=$re['orderid'];
			switch($re['status']){
					case -3:
						$result['zt']="换货";
						break;
					case -2:
						$result['zt']="退货";
						break;
					case -1:
						$result['zt']="订单已取消";
						break;			
					case 1:
						$result['zt']="未付款";
						break;
					case 2:
						$result['zt']="已付款";
						break;
					case 3:
						$result['zt']="已发货";
						break;
					case 4:
						$result['zt']="已签收";
						break;
					case 5:
						$result['zt']="已完成";
						break;	
				}
			$result['uname']=$ru['uname'];
			$result['tel']=$ru['tel'];
			$this->assign('result',$result);
			$this->display();
		}	
	}
	
	//评价列表
	public function pingjiaList(){
		//参数获取
        $search['end'] = I('get.end');
        $search['start'] = I('get.start');
        $search['title'] = I('get.title');
        if(!empty($search['title'])){
            $map['bid'] = array('like', '%' . $search['title'] . '%');
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
		$map['status']=array('neq',0);
		$count=M('pingjia')->where($map)->count();
		$Page = adminpage($count,10);
        //$Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
		$result=M('pingjia')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('addtime desc')->select();
		foreach($result as $k =>$v){
			$rh=M('goods')->where('id ='.$v['gid'])->find();
			$re=M('order')->where('id ='.$v['bid'])->find();
			$ru=M('user')->where('id ='.$v['uid'])->find();
			$result[$k]['gname']=$rh['gname'];
			$result[$k]['oid']=$re['orderid'];
			$result[$k]['uname']=$ru['uname'];
			$result[$k]['tel']=$ru['tel'];
		}
		$this->assign('result',$result);
		$this->assign('page',$show);
		$this->assign('count',$count);
		$this->display();
	}
	
	//评鉴删除
	public function pingjiadel(){
		$id=I('post.id');
		if(empty($id)){
			$data['status']=0;
			$data['msg']="缺少必要参数";
			$this->ajaxReturn($data);
		}
		$result=M('pingjia')->where('id ='.$id)->find();
		if(empty($result)){
			$data['status']=0;
			$data['msg']="评价已经不存在！";
			$this->ajaxReturn($data);
		}
		$pj=M('pingjia')->where('id ='.$id)->delete();
		if($pj){
			$data['status']=1;
			$data['msg']="删除成功";
			$this->ajaxReturn($data);
		}else{
			$data['status']=0;
			$data['msg']="删除失败";
			$this->ajaxReturn($data);
		}
	}
	
	//评价详情
	public function pingjiadetail(){
		$id=I('get.id');
		$result=M('pingjia')->where('id ='.$id)->find();
		$rh=M('goods')->where('id ='.$result['gid'])->find();
		$re=M('order')->where('id ='.$result['bid'])->find();
		$ru=M('user')->where('id ='.$result['uid'])->find();
		$result['gname']=$rh['gname'];
		$result['oid']=$re['orderid'];
		$result['uname']=$ru['uname'];
		$result['tel']=$ru['tel'];
		$result['imglist']=explode('|',$result['img']);
		$this->assign('result',$result);
		$this->display();
	}
	public function huifu(){ 
		$pjid=I('post.pjid');
		$hui=I('post.hui');
		$res=M('pingjia')->where('id='.$pjid)->find();
		if($res){
			$xiu['huifu']=$hui;
			$xiu['status']=3;
			$result=M('pingjia')->where('id='.$pjid)->save($xiu);
			$this->success('评价回复成功',U('order/pingjiaList'));
		}else{
			$this->error('该评价不存在');
		}
   }
}