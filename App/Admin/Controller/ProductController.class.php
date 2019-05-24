<?php
namespace Admin\Controller;
use Think\Controller;
class ProductController extends BaseController {

    /**
	*	产品管理
	**/
    public function ProductList(){
        //参数获取
        $search['end'] = I('get.end');
        $search['start'] = I('get.start');
        $search['title'] = I('get.title');
        $search['fcate'] = I('get.fcate');
        $search['scate'] = I('get.scate');
        $search['tcate'] = I('get.tcate');
        if(!empty($search['title'])){
            $map['gname'] = array('like', '%' . $search['title'] . '%');
        }
        if(!empty($search['fcate'])){
            $map['fcate'] = $search['fcate'];
        } 
		if(!empty($search['scate'])){
            $map['scate'] = $search['scate'];
        } 
		if(!empty($search['tcate'])){
            $map['tcate'] = $search['tcate'];
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
		$map['type']=1;
        $count=M('goods')->where($map)->count();
        $Page = adminpage($count,10);
        //$Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('goods')->where($map)->order('sort desc,addtime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        foreach($list as $k => $v){
			$list[$k]['ftitle']=M('productcate')->where('id ='.$v['fcate'])->getField('title');
			$list[$k]['stitle']=M('productcate')->where('id ='.$v['scate'])->getField('title');
			$list[$k]['ttitle']=M('productcate')->where('id ='.$v['tcate'])->getField('title');
		}
		$result=M('productcate')->where('pid =0')->select();
		if(empty($search['fcate'])){
			if($result[0]['id']){
				$result2=M('productcate')->where('pid ='.$result[0]['id'])->select();
			}
		}else{
			$result2=M('productcate')->where('pid ='.$search['fcate'])->select();
		}
		if(empty($search['scate'])){
			if($result2[0]['id'])
			{
				$result3=M('productcate')->where('pid ='.$result2[0]['id'])->select();
			}
		}else{
			$result3=M('productcate')->where('pid ='.$search['scate'])->select();
		}
		//分页跳转记录的url
		$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		session('product_url',$url);
		$this->assign('res',$result);
		$this->assign('res2',$result2);
		$this->assign('res3',$result3);
		$this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $this->display("Product/productList");
    }
	

	//获取新的二级
	public function second(){
		$id = I("post.id");
		$cate = M("productcate")->where('pid='.$id)->select();
		$str = "";
		$ttr = "";
		foreach($cate as $k => $v){
			$str .= "<option value=".$v['id'].">".$v['title']."</option>";
		}
		$thir=M('productcate')->where('pid='.$cate[0]['id'])->select();
		foreach($thir as $k => $v){
			$ttr .= "<option value=".$v['id'].">".$v['title']."</option>";
		}
		$data['str']=$str;
		$data['ttr']=$ttr;
		$this->ajaxReturn($data);
	}

	//获取新的三级
	public function third(){
		$id = I("post.id");
		$cate = M("productcate")->where('pid='.$id)->select();
		$str = "";
		foreach($cate as $k => $v){
			$str .= "<option value=".$v['id'].">".$v['title']."</option>";
		}
		$this->ajaxReturn($str);
	}	
   
    /**
     *	商品新增
     **/
    public function ProductAdd(){
        if(!IS_POST){
            if(!empty($_GET['id'])){
                $newsxiugl=M('goods')->find($_GET['id']);
            }
            $result=M('productcate')->where('pid =0')->select();
			$result2=M('productcate')->where('pid ='.$result[0]['id'])->select();
			$result3=M('productcate')->where('pid ='.$result2[0]['id'])->select();
			$this->assign('res',$result);
			$this->assign('res2',$result2);
			$this->assign('res3',$result3);
            $this->display();
        }else{	
                $fcate=I('post.fcate');
                $scate=I('post.scate');
                $tcate=I('post.tcate');
				$gname=I('post.gname');
				$yprice=I('post.yprice');
				$price=I('post.price');
				$keywords=I('post.keywords');
				$description=I('post.description');
				$description2=I('post.description2');
				$description3=I('post.description3');
				$yfmoney=I('post.yfmoney');
				$yunfei=I('post.yunfei');
				$jifen=I('post.jifen');
				$sort=I('post.sort');
				$num=I('post.num');//库存
				$guige=I('post.guige');//规格
				$is_you=I('post.is_you');//是否优惠
				if($is_you==0){
                    $you_num=0;
                    $you_bili=0;
				}else{
					$you_num=I('post.you_num');//优惠的个数
				    $you_bili=I('post.you_bili');//优惠的百分比
				}
				$imgurlglgo=I('post.imgurlglgo');
				$imgurlgl=I('post.imgurlgl');
				$is_norm=I('post.is_norm');
				// $is_index=I('post.is_index');
				// $is_hot=I('post.is_hot');
				//$text=I('post.text');
				$text2=I('post.text');
				$text=str_replace("\&quot;",'',$text2); 
				if(empty($fcate)){
					$this->error('请选择一级分类');
				}
				if(empty($scate)){
					$this->error('请选择二级分类');
				}
				if(empty($gname)){
					$this->error('请选择商品名称');
				}
				// if(empty($yprice)){
				// 	$this->error('请输入原价');
				// }
				// if(empty($price)){
				// 	$this->error('请输入现价');
				// }
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
				// if(empty($jifen)){
				// 	$this->error('请输入赠送积分');
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
				if(empty($is_norm)){
                    $this->error('请您选择是否开启规格');
                }
				// if(empty($text)){
    //                 $this->error('请您填写商品详情');
    //             }
				if($is_norm == 1){
					$normname=I('post.normname');
					$nson=I('post.nson');
					$normson=I('post.normson');
					$allnorm=I('post.allnorm');
					$nums=I('post.nums');
					$prices=I('post.prices');
					if(empty($normname)){
						$this->error('请选择商品规格名称');
					}
					if(empty($nson)){
						$this->error('参数异常');
					}
					if(empty($normson)){
						$this->error('参数异常');
					}
					if(empty($allnorm)){
						$this->error('参数异常');
					}
					if(empty($nums)){
						$this->error('参数异常');
					}
					if(empty($prices)){
						$this->error('参数异常');
					}
					//$pos = array_search(min($prices), $prices);
					$goods['fcate']= $fcate;
					$goods['scate']= $scate;
					//$goods['tcate']= $tcate;
					$goods['gname']= $gname;
					$goods['yprice']= $yprice;
					$goods['price']= $price;
					$goods['gname']= $gname;
					//$goods['score']= $score;
					$goods['is_norm']= $is_norm;
					// $goods['is_index']= $is_index;
					// $goods['is_hot']= $is_hot;
					$goods['modelnum']= $modelnum;
					$goods['keywords']= $keywords;
					$goods['description']= $description;
					$goods['description2']= $description2;
					$goods['description3']= $description3;
					$goods['yfmoney']= $yfmoney;
					$goods['yunfei']= $yunfei;
					$goods['jifen']= $jifen;
					$goods['sort']= $sort;
					$goods['imgurl']= $imgurlglgo[0];
					$goods['imgurl2']= implode('|',$imgurlgl);
					//$goods['price']= $prices[$pos];
					$goods['text']=$text;
					$goods['addtime']=time();
					$goods['type']=1;
					$m=M('goodsnormnm');
					$m->startTrans();//事务回滚开启
					$gres=M('goods')->add($goods);
					if(empty($gres)){
						$this->error('商品增添失败');
					}
					foreach($nson as $k => $v){
						$nn[$k]=explode('|',$v);
					}
					foreach($normname as $k => $v){
						//存入规格名
						$datanm[$k]['title']=$v;
						$datanm[$k]['gid']=$gres;
						$nres[$k]=$m->add($datanm[$k]);
						if(empty($nres[$k])){
							$m->rollback();
							$this->error('规格名增添失败');
						}
						//存入规格项
						foreach($nn as $key => $val){
							if($val[0] == $k){
								$datatm[$key]['gnid']=$nres[$k];
								$datatm[$key]['title']=$val[1];
								$datatm[$key]['gid']=$gres;
								$tres[$key]=M('goodsnormtm')->add($datatm[$key]);
								//生成规格项在数据表的id与名称对应的数组
								$luse[$tres[$key]]=$datatm[$key]['title'];
								if(empty($tres[$key])){
									$m->rollback();
									$this->error('规格项增添失败');
								}		
							}
						}
					}
					//规格项以及价格，库存写入数据表
					foreach($allnorm as $k => $v){
						$ares[$k]=explode('|',$v);
						foreach($ares[$k] as $key => $val){
							$alres=array_search($val,$luse);
							if($alres == false){
								$m->rollback();
								$this->error('规格项查找异常');
							}else{
								$datapn[$k]['nt'.$key]=$alres;
							}
						}
						$datapn[$k]['prices']=$prices[$k];	
						$datapn[$k]['nums']=$nums[$k];
						$datapn[$k]['gid']=$gres;
						$pres[$k]=M('goodsnormpn')->add($datapn[$k]);
						if(empty($pres[$k])){
							$m->rollback();
							$this->error('价格，库存增添失败');
						}	
					}
					$m->commit();//完成提交
					$this->success('添加成功',U('ProductList'));
				}else{
					$price=I('post.price');
					$nums=I('post.num');
					if(empty($price)){
						$this->error('请填写价格');
					}
					// if(empty($nums)){
					// 	$this->error('请填写库存');
					// }
					$goods['fcate']= $fcate;
					$goods['scate']= $scate;
					$goods['tcate']= $tcate;
					$goods['gname']= $gname;
					//$goods['ordernum']= $ordernum;
					//$goods['score']= $score;
					$goods['is_norm']= $is_norm;
					//$goods['is_index']= $is_index;
					//$goods['is_hot']= $is_hot;
					$goods['yprice']= $yprice;
					$goods['price']= $price;
					$goods['keywords']= $keywords;
					$goods['description']= $description;
					$goods['description2']= $description2;
					$goods['description3']= $description3;
					$goods['yfmoney']= $yfmoney;
					$goods['yunfei']= $yunfei;
					$goods['jifen']= $jifen;
					$goods['sort']= $sort;
					$goods['imgurl']= $imgurlglgo[0];
					$goods['imgurl2']= implode('|',$imgurlgl);
					$goods['price']= $price;
					$goods['nums']= $nums;
					$goods['guige']= $guige;
					$goods['is_you']= $is_you;
					$goods['you_num']= $you_num;
					$goods['you_bili']= $you_bili;
					$goods['text']=$text;
					$goods['addtime']=time();
					$goods['type']=1;
					$gres=M('goods')->add($goods);
					if(empty($gres)){
						$this->error('商品添加失败');
					}else{
						$this->success('添加成功',U('ProductList'));
					}
				}
        }
    }
    
    /**
     *	商品修改
     **/
    public function ProductEdit(){
        if(!IS_POST){
			$id=(int)I('id');
            if(!empty($id)){
                $addr=M('goods');
                $newsxiugl=$addr->find($id);
            }
			$result=M('productcate')->where('pid =0')->select();
			$result2=M('productcate')->where('pid ='.$newsxiugl['fcate'])->select();
			$result3=M('productcate')->where('pid ='.$newsxiugl['scate'])->select();
			$imgroll=explode('|',$newsxiugl['imgurl2']);
			$this->assign('res',$result);
			$this->assign('res2',$result2);
			$this->assign('res3',$result3);
			$this->assign('nm',$nm);
			$this->assign('pn',$pn);
			//dump($imgroll);
			$this->assign('imgroll',$imgroll);
            $this->assign('newsxiugl',$newsxiugl);
            $this->display();
        }else{
			    $fcate=I('post.fcate');
                $scate=I('post.scate');
                $tcate=I('post.tcate');
				$gname=I('post.gname');
                $yprice=I('post.yprice');
				$price=I('post.price');
				$keywords=I('post.keywords');
				$description=I('post.description');
				$description2=I('post.description2');
				$description3=I('post.description3');
				$yfmoney=I('post.yfmoney');
				$yunfei=I('post.yunfei');
				$jifen=I('post.jifen');
				$sort=I('post.sort');
				$num=I('post.num');//库存
				$guige=I('post.guige');//规格
				$is_you=I('post.is_you');//是否优惠
				$you_num=I('post.you_num');//优惠的个数
				$you_bili=I('post.you_bili');//优惠的百分比
				$imgurlglgo=I('post.imgurlglgo');
				//dump($imgurlglgo);die;
				$imgurlgl=I('post.imgurlgl');
				$text2=I('post.text');
				//$text2=$_POST['text'];
                $text=str_replace("\&quot;",'',$text2); 
				//dump($text);die;
				$id=I('post.id');
				if(empty($fcate)){
					$this->error('请选择一级分类');
				}
				if(empty($scate)){
					$this->error('请选择二级分类');
				}
				if(empty($tcate)){
					$this->error('请选择三级分类');
				}
				if(empty($gname)){
					$this->error('请选择商品名称');
				}
				// if(empty($keywords)){
				// 	$this->error('请选择商品关键字');
				// }
				// if(empty($description)){
				// 	$this->error('请选择商品描述');
				// }
				if(empty($id)){
					$this->error('缺少商品id');
				}
				// if(empty($text)){
    //                 $this->error('请您填写商品描述');
    //             }
				$price=I('post.price');
				$nums=I('post.nums');
				// if(empty($price)){
				// 	$this->error('请填写价格');
				// }
				// if(empty($nums)){
				// 	$this->error('请填写库存');
				// }
				    $goods['fcate']= $fcate;
					$goods['scate']= $scate;
					$goods['tcate']= $tcate;
					$goods['gname']= $gname;
					$goods['yprice']= $yprice;
					$goods['keywords']= $keywords;
					$goods['description']= $description;
					$goods['description2']= $description2;
					$goods['description3']= $description3;
					$goods['yfmoney']= $yfmoney;
					$goods['yunfei']= $yunfei;
					$goods['jifen']= $jifen;
					$goods['sort']= $sort;
					$goods['guige']= $guige;
					$goods['is_you']= $is_you;
					$goods['you_num']= $you_num;
					$goods['you_bili']= $you_bili;

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
						$goods['text']=$text;
						$goods['id']=$id;
						$goods['price']=$price;
						$goods['nums']=$nums;
						$gres=M('goods')->save($goods);
						if($gres !== false){
							$url = U('ProductList');
							$this->success('更新商品成功',$url);
						}else{
							$this->error('更新商品失败');
						}
					
				
		}	
    }
	
	//重置规格
	public function norms_alldel($id){
		if(empty($id)){
			$data['status']=0;
			$data['msg']='缺少商品id';
			return($data);
		}
		$is_norm=M('goods')->where('id ='.$id)->getField('is_norm');
		if($is_norm == 1){
			$m=M('goodsnormnm');
			$m->startTrans();
			$nm=$m->where('gid='.$id)->delete();
			$tm=M('goodsnormtm')->where('gid='.$id)->delete();
			$pn=M('goodsnormpn')->where('gid='.$id)->delete();
			if($nm && $tm && $pn){
				$m->commit();//成功提交
				$data['status']=1;
				$data['msg']='规格删除成功';
				return($data);
			}else{
				$m->rollback();//失败回滚
				$data['status']=0;
				$data['msg']='规格删除失败，请稍后操作';
				return($data);
			}
		}else{
			$res=M('goods')->where('id = '.$id)->setField('nums',0);
			if($res){
				$data['status']=1;
				$data['msg']='规格删除成功';
				return($data);
			}else{
				$data['status']=0;
				$data['msg']='规格修改失败';
				return($data);
			}
		}
		
		
	}
	
    /**
     *	删除商品
     **/
    public function delproduct(){
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
            $deladdr=$addr->where('id ='.$nid)->setField('is_up',0);
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

    //下架
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