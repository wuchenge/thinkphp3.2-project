<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class GoodsController extends BaseController {
	public function __construct(){
		parent::__construct();  //调用父构造函数避免冲突
	}

	//商品列表页面
    public function lists(){
		$searchp=I('post.search');
		$fcate=I('get.fcate/d');
		$scate=I('get.scate/d');
		$tcate=I('get.tcate/d');
		$order=I('get.order/d');
		//搜索条件
		if(!empty($searchp)){
			$map['gname']=array('like','%'.$searchp.'%');
			$this->assign('searchp',$searchp);
		}
		if(!empty($fcate)){
			$map['fcate']=$fcate;
		}
		if(!empty($scate)){
			$map['scate']=$scate;
		}
		if(!empty($tcate)){
			$map['tcate']=$tcate;
		}
		$map['is_del']=-1;
		$map['is_up']=1;
		//根据用户点击进行排序（默认，价格等）
		if(!empty($order)){
			switch($order){
				case 1:
					$orderstr="price desc,ordernum desc,sales desc,score desc,collect desc,addtime desc";
					break;
				case -1:
					$orderstr="price asc,ordernum desc,sales desc,score desc,collect desc,addtime desc";
					break;
				case 2:
					$orderstr="liunum desc,ordernum desc,sales desc,score desc,collect desc,addtime desc";
					break;
				case -2:
					$orderstr="liunum asc,ordernum desc,sales desc,score desc,collect desc,addtime desc";
					break;
				case 3:
					$orderstr="addtime desc,ordernum desc,sales desc,score desc,collect desc";
					break;
				case -3:
					$orderstr="addtime asc,ordernum desc,sales desc,score desc,collect desc";
					break;	
	
			}
		}else{
			$orderstr="ordernum desc,sales desc,score desc,collect desc,addtime desc";
		}
		
		$count = M("goods")->where($map)->count();// 查询满足要求的总记录数
		$Page  = new \Think\HomePage($count,20);// 实例化分页类 传入总记录数和每页显示的记录数
		$show  = $Page->show();// 分页显示输出
		$fir=M('productcate')->where('pid = 0')->select();
		if(!empty($fcate)){
			$sec=M('productcate')->where('pid = '.$fcate)->select();
			$this->assign('sec',$sec);
		}
		if(!empty($scate)){
			$thi=M('productcate')->where('pid = '.$scate)->select();
			$this->assign('thi',$thi);
		}
		$fcate=M('productcate')->where('pid = 0')->select();
		$list=M('goods')->where($map)->order($orderstr)->limit($Page->firstRow.','.$Page->listRows)->select();
		$top='商品列表';
		$this->assign('list',$list);
		$this->assign('top',$top);
		$this->assign('page',$show);
		$this->assign('fir',$fir);
		$this->display();
	}
	
	//商品详情页面
    public function details(){
		//判断id参数
		$id=intval(I('get.id'));
		$result=M('goods')->where('id ='.$id.' AND is_del =-1 AND is_up =1 ')->find();
		if(!$result){
			$this->error('该商品不存在',U('goods/lists'));
		}
		$url = 'goodurl' . $id;
		if (empty($_COOKIE[$url])) {
			M('goods')->where("id = ".$id)->setInc('liunum',1);
			setcookie($url, $_SERVER['PHP_SELF'], time() + 300);
		}
		$this->cookie_history($id,$result['gname'],$result['price'],$result['imgurl'],U('goods/details?id='.$id));

		//热门
		$hot = M("goods")->where("is_hot=1 AND id !=".$id.' AND is_del =-1 AND is_up =1 ')->order("liunum desc")->limit(5)->select();
		//浏览历史
		$history = $this->cookie_history_read();
		if($result['is_norm'] == 1){
			$normname=M('goodsnormnm')->where('gid ='.$id)->select();
			foreach($normname as $k =>$v){
				$psn=array();
				$psn=M('goodsnormtm')->where('gnid='.$v['id']." and gid = ".$id)->select();
				//动态定义生成数组的名称，然后assign到前台，才能用volist(必须二维)
				$normname[$k]['term'] = "psn_".$v['id'];
				$this->assign($normname[$k]['term'],$psn);
			}
			//求商品库存总和
			//求商品的最大价格
			$nums=0;
			$maxprice=0;
			$tnums=M('goodsnormpn')->where('gid ='.$id)->field('nums,prices')->select();
			foreach($tnums as $k =>$v){
				$nums=$nums+$v['nums'];
				if($v['prices']>$maxprice){
					$maxprice=$v['prices'];
				}
			}
			//求商品的最大价格
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
		$c['count'] = M("pingjia")->where("status =1 and gid=".$_GET['id'])->count();
		$c['hcount'] = M("pingjia")->where("status =1 and score >= 4 and gid=".$_GET['id'])->count();
		$c['zcount'] = M("pingjia")->where("status =1 and score = 3 and gid=".$_GET['id'])->count();
		$c['ccount'] = M("pingjia")->where("status =1 and score < 3 and gid=".$_GET['id'])->count();
		$w['gid'] = $_GET['id'];
		$w['status'] = 1;
		$sc = I("sc");
		if(!empty($sc)){
			switch($sc){
				case 4:
					$w['score'] = array('egt',4);
					break;
				case 3:
					$w['score'] = 3;
					break;
				case 2:
					$w['score'] = array('elt',2);
					break;
			}
		}
		$count=M('pingjia')->where($w)->count();
		$Page = new \Think\Page($count,8);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$show = $Page->show();// 分页显示输出
		$comments = M('pingjia')->where($w)->order("addtime desc")->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach($comments as $k => $v){
			$user = M("user")->where("id=".$v['uid'])->find();
			$comments[$k]['username'] = $user['uname'];
			$comments[$k]['tel'] = $user['tel'];
			$comments[$k]['headimg'] = $user['pic'];
			$comments[$k]['name'] = "img_".$v['id'];
			$img = array();
			$img = explode("|",$v['img']);
			$this->assign("img_".$v['id'],$img);
		}
		$this->assign('top',$result['gname']);
		$this->assign('result',$result);
		$this->assign('hot',$hot);
		$this->assign('normname',$normname);
		$this->assign('history',$history);
		$this->assign('rollimg',$rollimg);
		$this->assign('comments', $comments);
		$this->assign('count', $c);
		$this->assign('nums', $nums);//替代--商品规格库存和
		$this->assign('maxprice', $maxprice);//替代--商品最大价格
		// dump($rollimg);die;
		$this->display();
	}
	
	
	//改变价格，有规格的情况下
	public function change_price(){
		$id=I('post.gid');
		$str=I('post.str');
		$str=rtrim($str,'|');
		$nt=explode('|',$str);
		foreach($nt as $k =>$v){
			$map['nt'.$k]=$v;
		}
		$map['gid']=$id;
		$res=M('goodsnormpn')->where($map)->find();
		if(empty($res)){
			$data['code']=0;
			$data['msg']='该商品规格不存在';
			$this->ajaxReturn($data);
		}else{
			$data['code']=1;
			$data['nums']=$res['nums'];
			$data['prices']=$res['prices'];
			$this->ajaxReturn($data);
		}
	}
	
	//存入购物车
	public function cart(){
		$gid=I('post.gid/d');
		$guige=I('post.guige');
		$gnum=I('post.gnum/d');
		if(empty($gid)){
			$data['status']=0;
			$data['msg']='缺少商品id';
			$this->ajaxReturn($data);
		}
		if(empty($gnum)){
			$data['status']=0;
			$data['msg']='缺少商品数量';
			$this->ajaxReturn($data);
		}
		if(empty($guige)){
			$data['status']=0;
			$data['msg']='缺少商品规格';
			$this->ajaxReturn($data);
		}
		$map['gid']=$gid;
		$map['uid']=$_SESSION['uid'];
		$cartM = M('cart');
		$cart_find=$cartM ->where($map)->find();
		if(!empty($cart_find)){
			$data['status']=0;
			$data['msg']='商品已加入购物车';
			$this->ajaxReturn($data);
		}
		$map['num']=$gnum;
		$map['val']=$guige;
		$final=$cartM->add($map);
		if(empty($final)){
			$data['status']=0;
			$data['msg']='商品加入购物车失败';
			$this->ajaxReturn($data);
		}else{
			$data['num'] = M('cart c')->join(C('DB_PREFIX').'goods g on c.gid=g.id','LEFT')->where('c.uid='.$_SESSION['uid'].' AND g.is_del =-1 AND g.is_up =1')->count();
			$data['status']=1;
			$data['msg']='商品成功加入购物车';
			$this->ajaxReturn($data);
		}
		
	}
	
	//未登录读取cookie信息
	public function read_cart(){
		if($_SESSION['uid'])
		{
			$this->redirect('goods/cart');
		}
		$cid=I('cookie.cid');
        $cartM = M('cart c');
        $goodsM = M('goods g');
        $clist = $goodsM->join(C('DB_PREFIX').'cart c on g.id=c.gid','LEFT')->where('c.cid="'.$cid.'" AND g.is_del =-1 AND g.is_up =1 ')->select();
        $count = $cartM->join(C('DB_PREFIX').'goods g on c.gid=g.id','LEFT')->where('c.cid="'.$cid.'" AND g.is_del =-1 AND g.is_up =1')->count();
        foreach($clist as $k=>$v){
			if($v['is_norm'] == 1){
				$res=M("goods")->where('id ='.$v['gid'])->find();
                    $cart[$k]['gname'] = $res['gname'];
                    $cart[$k]['imgurl'] = $res['imgurl'];
                    $cart[$k]['keywords'] = $res['keywords'];
                    $cart[$k]['is_up'] = $res['is_up'];
                    $nidarray = array();
                    $nidarray = explode('|', $v['nid']);
                    $map = array();
                    foreach ($nidarray as $key => $val) {
                        $map["nt" . $key] = $val;
                    }
                    $map['gid'] = $v['gid'];
                    $str = M('goodsnormpn')->where($map)->find();
                    $cart[$k]['price'] = $str['prices'];
                    $cart[$k]['nums'] = $str['nums'];
                    $cart[$k]['val'] = $v['val'];
                    $cart[$k]['id'] = $v['id'];
                    $cart[$k]['gid'] = $v['gid'];
                    $cart[$k]['is_norm'] = $v['is_norm'];
                    $cart[$k]['num'] = $v['num'];
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
		$count = $cartM->join(C('DB_PREFIX').'goods g on c.gid=g.id','LEFT')->where('c.cid="'.$_COOKIE['cid'].'" AND g.is_del =-1 AND g.is_up =1')->count();
		// dump($cart);die;
		$top="我的购物车";
		$this->assign('top',$top);
		$this->assign('glist',$cart);
		$this->assign('count',$count);
		$this->display();
	}
	
	//删除cookie里面的内容
	public function cartdel(){
		$id=I('post.id');
		if(empty($id)){
			$data['status']=0;
			$data['msg']='缺少商品id';
			$this->ajaxReturn($data);
		}
 		$cartM = M('cart');
        $res1 = $cartM->where('id='.$id)->delete();
        if($res1)
        {
        	$data['status']=1;
			$data['msg']='成功移除该商品';
			$this->ajaxReturn($data);
        }
	}
	
	
	function history(){
		cookie('history',null);
	}
	
	/**
	  +----------------------------------------------------------
	 * 浏览记录按照时间排序
	  +----------------------------------------------------------
	 */
	function my_sort($a, $b){
	$a = substr($a,1);
	$b = substr($b,1);
	if ($a == $b) return 0;
	return ($a > $b) ? -1 : 1;
	  }
	/**
	  +----------------------------------------------------------
	 * 网页浏览记录生成
	  +----------------------------------------------------------
	 */
	function cookie_history($id,$title,$price,$img,$url){
		$dealinfo['gname'] = $title;
		$dealinfo['gid'] = $id;
		$dealinfo['price'] = $price;
		$dealinfo['img'] = $img;
		$dealinfo['url'] = $url;
		if(!$_COOKIE['cid'])//判断是否存在cid
		{
			//自动生成字符串
			$string = new \Org\Util\String;
			// $format：字符格式，#表示数字，*表示字母和数字，$表示字母
			// $number：生成数量，默认1个
			$cid = implode($string -> buildFormatRand('*',32));
			$dealinfo['cid']=md5($cid);
			setcookie('cid',$dealinfo['cid'],time()+3600*24,'/');
		}
		else
		{
			$dealinfo['cid'] = $_COOKIE['cid'];
		}
		$dealinfo['addtime']=time();
//		dump($dealinfo);
		M('history')->add($dealinfo);
		$time = NOW_TIME;
		$cookie_history = array($time => json_encode($dealinfo));  //设置cookie
		if (!cookie('history')){//cookie空，初始一个
		cookie('history',$cookie_history);
		}else{
		$new_history = array_merge(cookie('history'),$cookie_history);//添加新浏览数据

		rsort($new_history,SORT_NUMERIC);

		//uksort($new_history, "my_sort");//按照浏览时间排序
		$history = array_unique($new_history);
		if (count($history) > 5){
		$history = array_slice($history,0,5);
		}
		cookie('history',$history);
		}
	}
	
	/**
	  +----------------------------------------------------------
	 * 网页浏览记录读取
	  +----------------------------------------------------------
	 */
	function cookie_history_read(){
		$arr = cookie('history');
		foreach ((array)$arr as $k => $v){
		$list[$k] = json_decode($v,true);
		}
		return $list;
	}
}