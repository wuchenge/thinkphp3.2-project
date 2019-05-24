<?php
namespace Admin\Controller;
use Think\Controller;
class JifenController extends BaseController {

    /**
	*	产品管理
	**/
    public function Lists(){
        //参数获取
        $search['end'] = I('get.end');
        $search['start'] = I('get.start');
        $search['title'] = I('get.title');
        if(!empty($search['title'])){
            $map['gname'] = array('like', '%' . $search['title'] . '%');
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
		$map['is_del']=array('neq',1);
		$map['type']=2;
        $count=M('goods')->where($map)->count();
        $Page = adminpage($count,10);
        //$Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('goods')->where($map)->order('sort desc,sales desc,score desc,collect desc,addtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		//分页跳转记录的url
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		session('jifen_url',$url);
		$this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $this->display("Jifen/lists");
    }
	
    /**
     *	商品新增
     **/
    public function add(){
        if(!IS_POST){
            $this->display();
        }else{	
				$gname=I('post.gname');
				$keywords=I('post.keywords');
				$description=I('post.description');
				$description2=I('post.description2');
				$description3=I('post.description3');
				$yfmoney=I('post.yfmoney');
				$yunfei=I('post.yunfei');
				$sort=I('post.sort');
				$num=I('post.num');//库存
				$guige=I('post.guige');//规格
				$xyjifen=I('post.xyjifen');//是否优惠
				$imgurlglgo=I('post.imgurlglgo');
				$imgurlgl=I('post.imgurlgl');
				$is_norm=I('post.is_norm');
				// $is_index=I('post.is_index');
				// $is_hot=I('post.is_hot');
				//$text=I('post.text');
                $text2=$_POST['text'];
                $text=str_replace("\&quot;",'',$text2); 
				if(empty($gname)){
					$this->error('请选择商品名称');
				}
				if(empty($keywords)){
					$this->error('请选择商品关键字');
				}
				if(empty($description)){
					$this->error('请选择商品描述');
				}
				// if(empty($yfmoney)){
				// 	$this->error('请输入运费');
				// }
				// if(empty($yunfei)){
				// 	$this->error('请输入运费描述');
				// }
				if(empty($sort)){
					$sort=0;
				}
				if(empty($imgurlglgo)){
                    $this->error('请您上传商品图');
                }
                if(empty($imgurlgl)){
                    $this->error('请您上传商品细节图');
                }
				if(empty($text)){
                    $this->error('请您填写商品详情');
                }
				if(empty($num)){
						$this->error('请填写库存');
				}
				    $goods['gname']= $gname;
					$goods['is_norm']= $is_norm;
					//$goods['is_index']= $is_index;
					//$goods['is_hot']= $is_hot;
					$goods['keywords']= $keywords;
					$goods['description']= $description;
					$goods['description2']= $description2;
					$goods['description3']= $description3;
					$goods['yfmoney']= $yfmoney;
					$goods['yunfei']= $yunfei;
					$goods['xyjifen']= $xyjifen;
					$goods['sort']= $sort;
					$goods['imgurl']= $imgurlglgo[0];
					$goods['imgurl2']= implode('|',$imgurlgl);
					$goods['nums']= $num;
					$goods['guige']= $guige;
					$goods['text']=$text;
					$goods['addtime']=time();
					$goods['type']=2;
					$gres=M('goods')->add($goods);
					if(empty($gres)){
						$this->error('积分商品添加失败');
					}else{
						$this->success('添加成功');
					}
        }
    }
    
    /**
     *	商品修改
     **/
    public function edit(){
        if(!IS_POST){
			$id=(int)I('id');
            if(!empty($id)){
                $addr=M('goods');
                $newsxiugl=$addr->find($id);
                $imgroll=explode('|',$newsxiugl['imgurl2']);
            }
            $this->assign('imgroll',$imgroll);
            $this->assign('newsxiugl',$newsxiugl);
            $this->display("Jifen/edit");
        }else{
                $gname=I('post.gname');
				$keywords=I('post.keywords');
				$description=I('post.description');
				$description2=I('post.description2');
				$description3=I('post.description3');
				$yfmoney=I('post.yfmoney');
				$yunfei=I('post.yunfei');
				$sort=I('post.sort');
				$nums=I('post.nums');//库存
				$guige=I('post.guige');//规格
				$xyjifen=I('post.xyjifen');//是否优惠
				$imgurlglgo=I('post.imgurlglgo');
				//dump($imgurlglgo);die;
				$imgurlgl=I('post.imgurlgl');
				$is_norm=I('post.is_norm');
				//$text=I('post.text');
                $text2=$_POST['text'];
                $text=str_replace("\&quot;",'',$text2); 
				$id=I('post.id');
				if(empty($gname)){
					$this->error('请选择商品名称');
				}
				// if(empty($keywords)){
				// 	$this->error('请选择商品关键字');
				// }
				// if(empty($description)){
				// 	$this->error('请选择商品描述');
				// }
				// if(empty($yfmoney)){
				// 	$this->error('请输入运费');
				// }
				// if(empty($yunfei)){
				// 	$this->error('请输入运费描述');
				// }
				if(empty($sort)){
					$sort=0;
				}
				if(empty($text)){
                    $this->error('请您填写商品详情');
                }
				// if(empty($nums)){
				// 		$this->error('请填写库存');
				// }
				    $goods['gname']= $gname;
					$goods['is_norm']= $is_norm;
					//$goods['is_index']= $is_index;
					//$goods['is_hot']= $is_hot;
					$goods['keywords']= $keywords;
					$goods['description']= $description;
					$goods['description2']= $description2;
					$goods['description3']= $description3;
					$goods['yfmoney']= $yfmoney;
					$goods['yunfei']= $yunfei;
					$goods['xyjifen']= $xyjifen;
					$goods['sort']= $sort;
					// $goods['imgurl']= $imgurlglgo[0];
					// $goods['imgurl2']= implode('|',$imgurlgl);
					$goods['nums']= $nums;
					$goods['guige']= $guige;
					$goods['text']=$text;
					$goods['addtime']=time();
					$goods['type']=2;
						if(!empty($imgurlglgo)){
							//删除编辑前的图片
							$file=M('goods')->find($id);
							$file = $file['imgurl'];
							@unlink($_SERVER['DOCUMENT_ROOT'].$file);
							$goods['imgurl']= $imgurlglgo[0];
						}
						if(!empty($imgurlgl)){
							//删除编辑前的图片
							$file=M('goods')->find($id);
							$file = $file['imgurl2'];
							@unlink($_SERVER['DOCUMENT_ROOT'].$file);
							$goods['imgurl2']= implode('|',$imgurlgl);
						}
						$goods['id']=$id;
						$gres=M('goods')->save($goods);
						if($gres !== false){
							$this->success('更新商品成功');
						}else{
							$this->error('更新商品失败');
						}
					
				
		}	
    }

        /**
     *	删除商品
     **/
    public function del(){
        $nid=$_POST['id'];
        if(empty($nid)){
            $data['code']=0;
            $data['msg']="请选择要移除的商品信息";
            $this->ajaxReturn($data);
        }
        if(!is_numeric($nid)){
            $data['code']=0;
            $data['msg']="参数错误，请稍后再试";
            $this->ajaxReturn($data);
        }
        $addr=M('goods');
        $result=$addr->where('id ='.$nid)->find();
        if($result){
            $deladdr=$addr->where('id ='.$nid)->setField('is_del',1);
            if($deladdr){
                $data['code']=1;
                $data['msg']="删除商品信息成功";
                $this->ajaxReturn($data);
            }else{
                $data['code']=0;
                $data['msg']="删除商品信息失败";
                $this->ajaxReturn($data);
            }
        }else{
            $data['code']=0;
            $data['msg']="要删除的商品信息不存在";
            $this->ajaxReturn($data);
        }
    }

    //下架
    public function xiaglgood(){
        $nid=$_POST['id'];
        if(empty($nid)){
            $data['code']=0;
            $data['msg']="请选择要下架的商品信息";
            $this->ajaxReturn($data);
        }
        if(!is_numeric($nid)){
            $data['code']=0;
            $data['msg']="参数错误，请稍后再试";
            $this->ajaxReturn($data);
        }
        $addr=M('goods');
        $result=$addr->where('id ='.$nid)->find();
        if($result){
            $deladdr=$addr->where('id ='.$nid)->setField('is_edp',-1);
            if($deladdr){
            $data['code']=1;
            $data['msg']="下架商品信息成功";
            $this->ajaxReturn($data);
            }else{
                $data['code']=0;
                $data['msg']="下架商品信息失败，请再次上传";
                $this->ajaxReturn($data);
            }
        }else{
            $data['code']=0;
            $data['msg']="该商品不存在";
            $this->ajaxReturn($data);
        }
    }

    //上架
    public function upglgood(){
        $nid=$_POST['id'];
        if(empty($nid)){
            $data['code']=0;
            $data['msg']="请选择要上架的商品信息";
            $this->ajaxReturn($data);
        }
        if(!is_numeric($nid)){
            $data['code']=0;
            $data['msg']="参数错误，请稍后再试";
            $this->ajaxReturn($data);
        }
        $addr=M('goods');
        $result=$addr->where('id ='.$nid)->find();
        if($result){
            $deladdr=$addr->where('id ='.$nid)->setField('is_up',1);
            if($deladdr){
                $data['code']=1;
                $data['msg']="上架商品信息成功";
                $this->ajaxReturn($data);
            }else{
                $data['code']=0;
                $data['msg']="上架商品信息失败，请再次上传";
                $this->ajaxReturn($data);
            }
        }else{
            $data['code']=0;
            $data['msg']="该商品不存在";
            $this->ajaxReturn($data);
        }
    }
    
}