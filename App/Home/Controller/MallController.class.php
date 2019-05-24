<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class MallController extends BaseController {
	//商品列表页面
    public function index(){
		$title=I('get.title');
		$tcate=I('get.tcate');
		//搜索条件
		if(!empty($title)){
			$map['gname']=array('like','%'.$title.'%');
		}
		if(!empty($tcate)){
			$map['tcate']=$tcate;
		}
		$map['type']=1;
		$map['fcate']=134;
		$map['is_del']=-1;
		$map['is_up']=1;
		$orderstr="sort desc,addtime desc";
		$count = M("goods")->where($map)->count();// 查询满足要求的总记录数
		$Page  = new \Think\Hpage($count,4);// 实例化分页类 传入总记录数和每页显示的记录数
		$show  = $Page->show();// 分页显示输出
		//二级分类
		$cate=M('productcate')->where('pid = 134')->select();
		foreach ($cate as  $k=>$v) {
			//三级分类
			 $cate[$k]['sxjihe']=M('productcate')->where('pid ='.$v['id'])->select();
		}
		$this->assign('cate',$cate);
		$list=M('goods')->where($map)->order($orderstr)->limit($Page->firstRow.','.$Page->listRows)->select();
		foreach ($list as  $k=>$v) {
			 $list[$k]['imgs']=explode('|',$v['imgurl2']);
		}
		$top='精选商城';
		$banner=M('banner')->where('type=5')->select();
		$this->assign('banner',$banner);
		$this->assign('count',$count);
		$this->assign('list',$list);
		$this->assign('top',$top);
		$this->assign('page',$show);
		$this->assign('fir',$fir);
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
			$data['type']=2;
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
		$str=I('post.str');
		$gnum=I('post.gnum/d');
		$is_norm=I('post.is_norm');
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
		if(empty($is_norm)){
			$data['status']=0;
			$data['msg']='缺少商品是否有规格';
			$this->ajaxReturn($data);
		}
		if($is_norm == 1 ){
			if(empty($str)){
				$data['status']=0;
				$data['msg']='缺少商品规格';
				$this->ajaxReturn($data);
			}
			$nstr=rtrim($str,'|');
			$stra=explode('|',$nstr);
			foreach($stra as $k => $v){
				$term_name[]=M('goodsnormtm')->where('id ='.$v)->getField('title');
			}
			$termstr=implode('|',$term_name);
			if(empty($_SESSION['uid'])){
					$map['gid']=$gid;
					$map['is_norm']=$is_norm;
					$map['nid']=$nstr;
			        if(!$_COOKIE['cid'])
					{
						//自动生成字符串
		    			$string = new \Org\Util\String;
				        // $format：字符格式，#表示数字，*表示字母和数字，$表示字母
				        // $number：生成数量，默认1个
				        $cid = implode($string -> buildFormatRand('*',32));
						$map['cid']=md5($cid);
						setcookie('cid',$map['cid'],time()+3600*24,'/');
					}
					else
					{
						$map['cid'] = $_COOKIE['cid'];
					}
					$cartM = M('cart');
					$cart_find=$cartM ->where($map)->find();
					if(!empty($cart_find)){
						$data['status']=0;
						$data['msg']='商品已加入购物车';
						$this->ajaxReturn($data);
					}
					$map['num']=$gnum;
					$map['val']=$termstr;
					$final=$cartM->add($map);
					if(empty($final)){
						$data['status']=0;
						$data['msg']='商品加入购物车失败';
						$this->ajaxReturn($data);
					}else{
						$data['num'] = M('cart c')->join(C('DB_PREFIX').'goods g on c.gid=g.id','LEFT')->where('c.cid="'.$_COOKIE['cid'].'" AND g.is_del =-1 AND g.is_up =1')->count();
						$data['status']=1;
						$data['msg']='商品成功加入购物车';
						$this->ajaxReturn($data);
					}
			}else{
				$map['gid']=$gid;
				$map['is_norm']=$is_norm;
				$map['nid']=$nstr;
				$map['uid']=$_SESSION['uid'];
				$cartM = M('cart');
				$cart_find=$cartM ->where($map)->find();
				if(!empty($cart_find)){
					$data['status']=0;
					$data['msg']='商品已加入购物车';
					$this->ajaxReturn($data);
				}
				$map['num']=$gnum;
				$map['val']=$termstr;
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
		}else{
			if(empty($_SESSION['uid'])){
				$map['gid']=$gid;
				$map['is_norm']=$is_norm;
				$map['nid']=0;
				if(!$_COOKIE['cid'])
				{
					//自动生成字符串
	    			$string = new \Org\Util\String;
			        // $format：字符格式，#表示数字，*表示字母和数字，$表示字母
			        // $number：生成数量，默认1个
			        $cid = implode($string -> buildFormatRand('*',32));
					$map['cid']=md5($cid);
					setcookie('cid',$map['cid'],time()+3600*24,'/');
				}
				else
				{
					$map['cid'] = $_COOKIE['cid'];
				}
				$cartM = M('cart');
				$cart_find=$cartM ->where($map)->find();
				if(!empty($cart_find)){
					$data['status']=0;
					$data['msg']='商品已加入购物车';
					$this->ajaxReturn($data);
				}
				$map['num']=$gnum;
				$map['val']=0;
				$final=$cartM->add($map);
				if(empty($final)){
					$data['status']=0;
					$data['msg']='商品加入购物车失败';
					$this->ajaxReturn($data);
				}else{
					$data['num'] = M('cart c')->join(C('DB_PREFIX').'goods g on c.gid=g.id','LEFT')->where('c.cid="'.$_COOKIE['cid'].'" AND g.is_del =-1 AND g.is_up =1')->count();
					$data['status']=1;
					$data['msg']='商品成功加入购物车';
					$this->ajaxReturn($data);
				}		
			}else{
				$map['gid']=$gid;
				$map['is_norm']=$is_norm;
				$map['nid']=0;
				$map['uid']=$_SESSION['uid'];
				$cartM = M('cart');
				$cart_find=$cartM ->where($map)->find();
				if(!empty($cart_find)){
					$data['status']=0;
					$data['msg']='商品已加入购物车';
					$this->ajaxReturn($data);
				}
				$map['num']=$gnum;
				$map['val']=0;
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
		

}