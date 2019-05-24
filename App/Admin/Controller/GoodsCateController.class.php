<?php
namespace Admin\Controller;
use Think\Controller;
class GoodscateController extends BaseController {

    /**
	*	产品管理
	**/
    public function ProductList(){
        //参数获取
        $search['end'] = I('get.end');
        $search['start'] = I('get.start');
        $search['title'] = I('get.title');
        $search['brand'] = I('get.bgl');
        if(!empty($search['title'])){
            $map['title'] = array('like', '%' . $search['title'] . '%');
        }
        if(!empty($search['brand'])){
            $map['brand'] = $search['brand'];
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
        $map['is_nc'] = 2;
        $count=M('goods')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('goods')->where($map)->order('addtime desc','xiutime desc')->limit($Page->firstRow.','.$Page->listRows)->
        select();
        //商品类型
        foreach($list as $k=>$v){
            $typegl=M('goodstype')->field('type')->find($list[$k]['type']);
            $list[$k]['type'] =$typegl['type'] ;
            if($list[$k]['brand'] == 1){
                $list[$k]['brand'] ='喜梦宝' ;
            }else{
                $list[$k]['brand'] ='英伦印象' ;
            }
        }
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
        $this->display("Product/ProductList");
    }
    /**
     *	新品管理
     **/
    public function ProductListnew(){
        //参数获取
//        $search['cate'] = I('get.cate');
        $search['end'] = I('get.end');
        $search['start'] = I('get.start');
        $search['title'] = I('get.title');
        $search['brand'] = I('get.bgl');
        if(!empty($search['title'])){
            $map['title'] = array('like', '%' . $search['title'] . '%');
        }
        if(!empty($search['brand'])){
            $map['brand'] = $search['brand'];
        }
        if(!empty($search['title'])){
            $map['title'] = array('like', '%' . $search['title'] . '%');
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
        $map['is_nc'] = 1;
        $count=M('goods')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('goods')->where($map)->order('addtime desc','xiutime desc')->limit($Page->firstRow.','.$Page->listRows)->
        select();
        //商品类型
        foreach($list as $k=>$v){
            $typegl=M('goodstype')->field('type')->find($list[$k]['type']);
            $typegl2=M('goodstaoxi')->field('type')->find($list[$k]['taoxi']);
            $list[$k]['type'] =$typegl['type'] ;
            $list[$k]['taotype'] =$typegl2['type'] ;
            if($list[$k]['brand'] == 1){
                $list[$k]['brand'] ='喜梦宝' ;
            }else{
                $list[$k]['brand'] ='英伦印象' ;
            }
        }
//        dump($list);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
//        dump($list);
        $this->display("Product/ProductListnew");
    }
    /**
     *	促销管理
     **/
    public function ProductListcu(){
        //参数获取
//        $search['cate'] = I('get.cate');
        $search['end'] = I('get.end');
        $search['start'] = I('get.start');
        $search['title'] = I('get.title');
        $search['brand'] = I('get.bgl');
        if(!empty($search['title'])){
            $map['title'] = array('like', '%' . $search['title'] . '%');
        }
        if(!empty($search['brand'])){
            $map['brand'] = $search['brand'];
        }
        if(!empty($search['title'])){
            $map['title'] = array('like', '%' . $search['title'] . '%');
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
        $map['is_nc'] = 3;
        $count=M('goods')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('goods')->where($map)->order('addtime desc','xiutime desc')->limit($Page->firstRow.','.$Page->listRows)->
        select();
        foreach($list as $k=>$v){
            $typegl=M('goodstype')->field('type')->find($list[$k]['type']);
            $typegl2=M('goodstaoxi')->field('type')->find($list[$k]['taoxi']);
            $list[$k]['type'] =$typegl['type'] ;
            $list[$k]['taotype'] =$typegl2['type'] ;
            if($list[$k]['brand'] == 1){
                $list[$k]['brand'] ='喜梦宝' ;
            }else{
                $list[$k]['brand'] ='英伦印象' ;
            }
        }
//        dump($list);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
//        dump($list);
        $this->display("Product/ProductListcu");
    }


    /**
     *	商品新增
     **/
    public function ProductAdd(){
        if(!IS_POST){
            if(!empty($_GET['id'])){
                $newsxiugl=M('goods')->find($_GET['id']);
            }
            //默认获取喜梦宝分类名称
            $result=M('goodstype')->where('brand = 1')->select();
            $gldata['msg']='';
            foreach($result as $v){
                $gldata['msg'] .= "<option value='{$v['id']}'>{$v['type']}</option>";
            }
            //获取颜色
            $glcolor=M('color')->select();
            $this->assign('glcolor',$glcolor);
            $this->assign('gldatamsg',$gldata['msg']);
            $this->assign('newsxiugl',$newsxiugl);
            $this->display("Product/ProductAdd");
        }else{
                if(empty($_POST['type'])){
                    $this->error('请选择新增商品栏目');
                }
               $incou=count($_POST['level']);
                if($incou<1){
                    $this->error('最少添加一个规格的商品');
                }
                if(empty($_POST['imgurlglgo'])){
                    $this->error('请您上传商品图');
                }
                if(empty($_POST['imgurlgl'])){
                    $this->error('请您上传商品细节图');
                }
                $glgoods['brand']=$_POST['brand'];
                $glgoods['type']=$_POST['type'];
                $glgoods['is_nc']=2;//2为普通商品
//                $glgoods['is_new']=$_POST['is_new'];//促销预留
                $glgoods['is_boy']=$_POST['is_boy'];
                $glgoods['gname']=$_POST['gname'];
                $glgoods['style']=$_POST['style'];
                $glgoods['rooty']=$_POST['rooty'];
                $glgoods['ordernum']=$_POST['ordernum'];
                $glgoods['modelnum']=$_POST['modelnum'];
                $glgoods['keywords']=$_POST['keywords'];
                $glgoods['description']=$_POST['description'];
//                $glgoods['imgurl'] = 'bbbbb';
//                $glgoods['imgurl2'] = 'aaaaa';
                $glgoods['imgurl'] = implode($_POST['imgurlglgo']);
                $glgoods['imgurl2'] = implode('|',$_POST['imgurlgl']);
                foreach($_POST['colordglf'] as $k=>$v){
                    $map[$k]='('.$v.')';
                }
                $a=$_POST['price'];
                $pos = array_search(min($a), $a);
//                dump($a[$pos]);exit;
                $glgoods['price']= $a[$pos];
                $glgoods['color'] = implode(',',$map);
                $glgoods['is_up']=1;
                $glgoods['text']=$_POST['text'];
                $glgoods['purp']=$_POST['purp'][0].'|'.$_POST['purp'][1].'|'.$_POST['purp'][2].'|'.$_POST['purp'][3];
                $glgoods['addtime']=time();
                $glgoods['addman']=$_SESSION['adminid'];
//                dump($glgoods['color']);
//                dump($glgoods);exit;colordglf
                if(empty($glgoods['gname'])){
                    $this->error('商品标题不能为空');
                }
                if(empty($glgoods['keywords'])){
                    $this->error('商品关键词不能为空');
                }
                if(empty($glgoods['description'])){
                    $this->error('商品摘要不能为空');
                }
                if(empty($glgoods['text'])){
                    $this->error('商品介绍不能为空');
                }
                if(strlen($glgoods['gname']) < 15 || strlen($glgoods['gname']) >75 ){
                    $this->error('商品标题在5到25个字符之间');
                }
                if(strlen($glgoods['keywords']) < 15 || strlen($glgoods['keywords']) >75 ){
                    $this->error('商品关键词在5到25个字符之间');
                }
                if(strlen($glgoods['description']) < 30 || strlen($glgoods['description']) >600 ){
                    $this->error('商品摘要在10到200个字符之间');
                }
//                dump($glgoods);exit;
                $ord = M("goods");
                $ord->startTrans();
                $resule=$ord->add($glgoods);
                        for($i=0;$i<$incou;$i++){
                            $infogo[$i]['gid'] = $resule;
                            $infogo[$i]['title'] = $_POST['level'][$i];
                            $resulet = M('goodsnorm')->add($infogo[$i]);
                            $infogoto[$i]['gid']=$resule;
                            $infogoto[$i]['ggid']=$resulet;
                            $infogoto[$i]['color']=$_POST['colordglf'][$i];
                            $infogoto[$i]['num']=$_POST['num'][$i];
                            $infogoto[$i]['price']=$_POST['price'][$i];
                            $resulett=M('goodscolor')->add($infogoto[$i]);
                         }
                if($resule && $resulet && $resulett){
                    $ord->commit();
                    $this->success('新增商品成功',U('Product/productList'));exit;
                }else{
                    $ord->rollback();
                    $this->error('新增商品失败');
                }
        }
    }
    /**
     *	新品新增
     **/
    public function ProductAddnew(){
        if(!IS_POST){
//            dump($_GET['id']);
            if(!empty($_GET['id'])){
                $newsxiugl=M('goods')->find($_GET['id']);
            }
            //默认获取喜梦宝分类名称
            $result=M('goodstype')->where('brand = 1')->select();
            $gldata['msg']='';
            foreach($result as $v){
                $gldata['msg'] .= "<option value='{$v['id']}'>{$v['type']}</option>";
            }
            //获取颜色
            $glcolor=M('color')->select();
            $gltaoxi=M('goodstaoxi')->field('type,id')->select();
            $this->assign('gltaoxi',$gltaoxi);
            $this->assign('glcolor',$glcolor);
            $this->assign('gldatamsg',$gldata['msg']);
            $this->assign('newsxiugl',$newsxiugl);
            $this->display("Product/ProductAddnew");
        }else{
                if(empty($_POST['type'])){
                    $this->error('请选择新增商品栏目');
                }
//               $incou=1;
                $incou=count($_POST['level']);
                if($incou<1){
                    $this->error('最少添加一个规格的商品');
                }
//                dump($_POST);
                if(empty($_POST['imgurlglgo'])){
                    $this->error('请您上传商品图');
                }
                if(empty($_POST['imgurlgl'])){
                    $this->error('请您上传商品细节图');
                }
                $a=$_POST['price'];
                $pos = array_search(min($a), $a);
                $glgoods['price']= $a[$pos];
                $glgoods['brand']=$_POST['brand'];
                $glgoods['type']=$_POST['type'];
                $glgoods['is_nc']=1;//
                $glgoods['taoxi']=$_POST['taoxi'];//
//                $glgoods['is_new']=$_POST['is_new'];//促销预留
                $glgoods['is_boy']=$_POST['is_boy'];
                $glgoods['gname']=$_POST['gname'];
                $glgoods['style']=$_POST['style'];
                $glgoods['rooty']=$_POST['rooty'];
                $glgoods['ordernum']=$_POST['ordernum'];
                $glgoods['modelnum']=$_POST['modelnum'];
                $glgoods['keywords']=$_POST['keywords'];
                $glgoods['description']=$_POST['description'];
//                $glgoods['imgurl'] = 'bbbbb';
//                $glgoods['imgurl2'] = 'aaaaa';
                $glgoods['imgurl'] = implode($_POST['imgurlglgo']);
                $glgoods['imgurl2'] = implode('|',$_POST['imgurlgl']);
                foreach($_POST['colordglf'] as $k=>$v){
                    $map[$k]='('.$v.')';
                }
                $glgoods['color'] = implode(',',$map);
                $glgoods['is_up']=1;
                $glgoods['text']=$_POST['text'];
                $glgoods['purp']=$_POST['purp'][0].'|'.$_POST['purp'][1].'|'.$_POST['purp'][2].'|'.$_POST['purp'][3];
                $glgoods['addtime']=time();
                $glgoods['addman']=$_SESSION['adminid'];
//                dump($glgoods['color']);
//                dump($glgoods);exit;colordglf
                if(empty($glgoods['gname'])){
                    $this->error('商品标题不能为空');
                }
                if(empty($glgoods['keywords'])){
                    $this->error('商品关键词不能为空');
                }
                if(empty($glgoods['description'])){
                    $this->error('商品摘要不能为空');
                }
                if(empty($glgoods['text'])){
                    $this->error('商品介绍不能为空');
                }
                if(strlen($glgoods['gname']) < 15 || strlen($glgoods['gname']) >75 ){
                    $this->error('商品标题在5到25个字符之间');
                }
                if(strlen($glgoods['keywords']) < 15 || strlen($glgoods['keywords']) >75 ){
                    $this->error('商品关键词在5到25个字符之间');
                }
                if(strlen($glgoods['description']) < 30 || strlen($glgoods['description']) >600 ){
                    $this->error('商品摘要在10到200个字符之间');
                }
//                dump($glgoods);exit;
                $ord = M("goods");
                $ord->startTrans();
                $resule=$ord->add($glgoods);
                for($i=0;$i<$incou;$i++){
                    $infogo[$i]['gid'] = $resule;
                    $infogo[$i]['title'] = $_POST['level'][$i];
                    $resulet = M('goodsnorm')->add($infogo[$i]);
                    $infogoto[$i]['gid']=$resule;
                    $infogoto[$i]['ggid']=$resulet;
                    $infogoto[$i]['color']=$_POST['colordglf'][$i];
                    $infogoto[$i]['num']=$_POST['num'][$i];
                    $infogoto[$i]['price']=$_POST['price'][$i];
                    $resulett=M('goodscolor')->add($infogoto[$i]);
                }

//                dump($resulett);exit;
                if($resule && $resulet && $resulett){
                    $ord->commit();
                    $this->success('新增新品成功',U('Product/productListnew'));exit;
                }else{
                    $ord->rollback();
                    $this->error('新增新品失败');
                }
        }
    }
    /**
     *	促销商品新增
     **/
    public function ProductAddcu(){
        if(!IS_POST){
//            dump($_GET['id']);
            if(!empty($_GET['id'])){
                $newsxiugl=M('goods')->find($_GET['id']);
                //获取颜色
            }
            //默认获取喜梦宝分类名称
            $result=M('goodstype')->where('brand = 1')->select();
            $gldata['msg']='';
            foreach($result as $v){
                $gldata['msg'] .= "<option value='{$v['id']}'>{$v['type']}</option>";
            }
            //获取颜色
            $glcolor=M('color')->select();
            $this->assign('glcolor',$glcolor);
            $this->assign('gldatamsg',$gldata['msg']);
            $this->assign('newsxiugl',$newsxiugl);
            $this->display("Product/ProductAddcu");
        }else{
//            dump($_POST);exit;
            if(empty($_POST['type'])){
                $this->error('请选择新增商品栏目');
            }
//               $incou=1;
            $incou=count($_POST['level']);
            if($incou<1){
                $this->error('最少添加一个规格的商品');
            }
//                dump($_POST);
            if(empty($_POST['imgurlglgo'])){
                $this->error('请您上传商品图');
            }
            if(empty($_POST['imgurlgl'])){
                $this->error('请您上传商品细节图');
            }
//                if(!$info['imgurl2']) {// 上传错误提示错误信息
//                    $this->error('请上传商品列表图片');
//                }
            $glgoods['brand']=$_POST['brand'];
            $glgoods['type']=$_POST['type'];
            $glgoods['is_nc']=3;//2为普通商品
//                $glgoods['is_new']=$_POST['is_new'];//促销预留
            $glgoods['is_boy']=$_POST['is_boy'];
            $glgoods['gname']=$_POST['gname'];
            $glgoods['ordernum']=$_POST['ordernum'];
            $glgoods['modelnum']=$_POST['modelnum'];
            $glgoods['style']=$_POST['style'];
            $glgoods['rooty']=$_POST['rooty'];
            $glgoods['keywords']=$_POST['keywords'];
            $glgoods['description']=$_POST['description'];
            $a=$_POST['price'];
            $pos = array_search(min($a), $a);
            $glgoods['price']= $a[$pos];
//                $glgoods['imgurl'] = 'bbbbb';
//                $glgoods['imgurl2'] = 'aaaaa';
            $glgoods['imgurl'] = implode($_POST['imgurlglgo']);
            $glgoods['imgurl2'] = implode('|',$_POST['imgurlgl']);
            foreach($_POST['colordglf'] as $k=>$v){
                $map[$k]='('.$v.')';
            }
            $glgoods['color'] = implode(',',$map);
            $glgoods['is_up']=1;
            $glgoods['text']=$_POST['text'];
            $glgoods['purp']=$_POST['purp'][0].'|'.$_POST['purp'][1].'|'.$_POST['purp'][2].'|'.$_POST['purp'][3];
            $glgoods['addtime']=time();
            $glgoods['addman']=$_SESSION['adminid'];
//                dump($glgoods['color']);
//                dump($glgoods);exit;colordglf
            if(empty($glgoods['gname'])){
                $this->error('商品标题不能为空');
            }
            if(empty($glgoods['keywords'])){
                $this->error('商品关键词不能为空');
            }
            if(empty($glgoods['description'])){
                $this->error('商品摘要不能为空');
            }
            if(empty($glgoods['text'])){
                $this->error('商品介绍不能为空');
            }
            if(strlen($glgoods['gname']) < 15 || strlen($glgoods['gname']) >75 ){
                $this->error('商品标题在5到25个字符之间');
            }
            if(strlen($glgoods['keywords']) < 15 || strlen($glgoods['keywords']) >75 ){
                $this->error('商品关键词在5到25个字符之间');
            }
            if(strlen($glgoods['description']) < 30 || strlen($glgoods['description']) >600 ){
                $this->error('商品摘要在10到200个字符之间');
            }
//                dump($glgoods);exit;
            $ord = M("goods");
            $ord->startTrans();
            $resule=$ord->add($glgoods);
            for($i=0;$i<$incou;$i++){
                $infogo[$i]['gid'] = $resule;
                $infogo[$i]['title'] = $_POST['level'][$i];
                $resulet = M('goodsnorm')->add($infogo[$i]);
                $infogoto[$i]['gid']=$resule;
                $infogoto[$i]['ggid']=$resulet;
                $infogoto[$i]['color']=$_POST['colordglf'][$i];
                $infogoto[$i]['num']=$_POST['num'][$i];
                $infogoto[$i]['price']=$_POST['price'][$i];
                $resulett=M('goodscolor')->add($infogoto[$i]);
            }

//                dump($resulett);exit;
            if($resule && $resulet && $resulett){
                $ord->commit();
                $this->success('新增商品成功',U('Product/productListcu'));exit;
            }else{
                $ord->rollback();
                $this->error('新增商品失败');
            }
        }
    }
    /**
     *	商品新增
     **/
    public function ProductEdit(){
        if(!IS_POST){
//            dump($_GET['id']);
            if(!empty($_GET['id'])){
                $addr=M('goods');
                $newsxiugl=$addr->find($_GET['id']);
                $brandgl=M('goodstype')->field('brand,type')->find($newsxiugl['type']);
                $newsxiugl['brand']=$brandgl['brand'];
                $newsxiugl['typename']=$brandgl['type'];
                $newsxiugl['typegl']='';
                $newsxiugl['typegl'] .= "<option value='{$newsxiugl['type']}'>{$newsxiugl['typename']}</option>";
                $newsxiugl['purp']=explode('|',$newsxiugl['purp']);
            }
            //获取颜色
            $glcolor=M('color')->select();
            //获取规格信息
            $xmbgoods=M('goodscolor')->where('gid = '.$_GET['id'])->select();
            foreach($xmbgoods as $k=>$v){
                $glnorm=M('goodsnorm')->where('gid = '.$_GET['id'].' AND id = '.$xmbgoods[$k]['ggid'])->find();
                $glcolorgl=M('color')->where(' id = '.$xmbgoods[$k]['color'])->find();
                $xmbgoods[$k]['gginfo']=$glnorm['title'];
                $xmbgoods[$k]['ggid']=$glnorm['id'];
                $xmbgoods[$k]['color']=$glcolorgl['color'];
                $xmbgoods[$k]['ccid']=$glcolorgl['id'];
            }
            $this->assign('xmbgoods',$xmbgoods);
            $this->assign('glcolor',$glcolor);
            $this->assign('newsxiugl',$newsxiugl);
            $this->display("Product/ProductEdit");
        }else{
//            dump($_POST);exit;
            if(!empty($_POST['newid'])){
                if(empty($_POST['type'])){
                    $this->error('请选择新增商品栏目');
                }
//               $incou=1;
                $incou=count($_POST['level']);
                if($incou<1){
                    $this->error('最少添加一个规格的商品');
                }
//                dump($_POST);
                if(!empty($_POST['imgurlglgo'])){
                    $glgoods['imgurl'] = implode($_POST['imgurlglgo']);
//                    $this->error('请您上传商品图');
                }
                if(!empty($_POST['imgurlgl'])){
                    $glgoods['imgurl2'] = implode('|',$_POST['imgurlgl']);
//                    $this->error('请您上传商品细节图');
                }
//                if(!$info['imgurl2']) {// 上传错误提示错误信息
//                    $this->error('请上传商品列表图片');
//                }
                $a=$_POST['price'];
                $pos = array_search(min($a), $a);
                $glgoods['price']= $a[$pos];
                $glgoods['brand']=$_POST['brand'];
                $glgoods['type']=$_POST['type'];
                $glgoods['is_nc']=2;//2为普通商品
//                $glgoods['is_new']=$_POST['is_new'];//促销预留
                $glgoods['is_boy']=$_POST['is_boy'];
                $glgoods['gname']=$_POST['gname'];
                $glgoods['ordernum']=$_POST['ordernum'];
                $glgoods['modelnum']=$_POST['modelnum'];
                $glgoods['style']=$_POST['style'];
                $glgoods['rooty']=$_POST['rooty'];
                $glgoods['keywords']=$_POST['keywords'];
                $glgoods['description']=$_POST['description'];
                $a=$_POST['price'];
                $pos = array_search(min($a), $a);
                $glgoods['price']= $a[$pos];
//                $glgoods['imgurl'] = 'bbbbb';
//                $glgoods['imgurl2'] = 'aaaaa';
                foreach($_POST['colordglf'] as $k=>$v){
                    $map[$k]='('.$v.')';
                }
                $glgoods['color'] = implode(',',$map);
//                $glgoods['is_up']=1;
                $glgoods['text']=$_POST['text'];
                $glgoods['purp']=$_POST['purp'][0].'|'.$_POST['purp'][1].'|'.$_POST['purp'][2].'|'.$_POST['purp'][3];
                if(empty($glgoods['gname'])){
                    $this->error('商品标题不能为空');
                }
                if(empty($glgoods['keywords'])){
                    $this->error('商品关键词不能为空');
                }
                if(empty($glgoods['description'])){
                    $this->error('商品摘要不能为空');
                }
                if(empty($glgoods['text'])){
                    $this->error('商品介绍不能为空');
                }
                if(strlen($glgoods['gname']) < 15 || strlen($glgoods['gname']) >75 ){
                    $this->error('商品标题在5到25个字符之间');
                }
                if(strlen($glgoods['keywords']) < 15 || strlen($glgoods['keywords']) >75 ){
                    $this->error('商品关键词在5到25个字符之间');
                }
                if(strlen($glgoods['description']) < 30 || strlen($glgoods['description']) >600 ){
                    $this->error('商品摘要在10到200个字符之间');
                }
//                dump($glgoods);exit;
                $ord = M("goods");
                $ord->startTrans();
                $resule=$ord->where('id ='.$_POST['newid'])->save($glgoods);
                $incou2=count($_POST['ggid']);
                if(($incou-$incou2)>0){
                    for($i=0;$i<$incou;$i++){
//                        $infogo[$i]['gid'] = $resule;
                        if($i>$incou-1){
                            $infogo[$i]['title'] = $_POST['level'][$i];
                            $resulet = M('goodsnorm')->where('id = '.$_POST['ggid'][$i])->save($infogo[$i]);
                            $infogoto[$i]['color']=$_POST['colordglf'][$i];
                            $infogoto[$i]['num']=$_POST['num'][$i];
                            $infogoto[$i]['price']=$_POST['price'][$i];
                            $resulett=M('goodscolor')->where('id = '.$_POST['cid'][$i])->save($infogoto[$i]);
                        }else{
                            $infogo[$i]['gid'] = $_POST['newid'];
                            $infogo[$i]['title'] = $_POST['level'][$i];
                            $resulet = M('goodsnorm')->add($infogo[$i]);
                            $infogoto[$i]['gid']=$_POST['newid'];
                            $infogoto[$i]['ggid']=$resulet;
//                            $infogoto[$i]['root']=$_POST['root'][$i];
                            $infogoto[$i]['color']=$_POST['colordglf'][$i];
                            //                        $infogo[$i]['flymoney']=$_POST['flymoney'][$i];
                            //                        $infogo[$i]['point']=$_POST['point'][$i];
                            $infogoto[$i]['num']=$_POST['num'][$i];
                            $infogoto[$i]['price']=$_POST['price'][$i];
                            $resulett=M('goodscolor')->add($infogoto[$i]);
                        }

                    }
                }else{
                    for($i=0;$i<$incou2;$i++){
//                        $infogo[$i]['gid'] = $resule;
                        $infogo[$i]['title'] = $_POST['level'][$i];
                        $resulet = M('goodsnorm')->where('id = '.$_POST['ggid'][$i])->save($infogo[$i]);
                        $infogoto[$i]['color']=$_POST['colordglf'][$i];
                        $infogoto[$i]['num']=$_POST['num'][$i];
                        $infogoto[$i]['price']=$_POST['price'][$i];
                        $resulett=M('goodscolor')->where('id = '.$_POST['cid'][$i])->save($infogoto[$i]);
                    }
                }
                if(($resule!==false) && ($resulet!==false) && ($resulett!==false)){
//                if($resule && $resulet && $resulett){
                    $ord->commit();
                    $this->success('修改商品成功',U('Product/productList'));exit;
                }else{
                    $ord->rollback();
                    $this->error('修改商品失败');
                }
            }
        }
    }
    /**
    /**
     *	促销商品修改
     **/
    public function ProductEditcu(){
        if(!IS_POST){
//            dump($_GET['id']);
            if(!empty($_GET['id'])){
                $addr=M('goods');
                $newsxiugl=$addr->find($_GET['id']);
                $brandgl=M('goodstype')->field('brand,type')->find($newsxiugl['type']);
                $newsxiugl['brand']=$brandgl['brand'];
                $newsxiugl['typename']=$brandgl['type'];
                $newsxiugl['typegl']='';
                $newsxiugl['typegl'] .= "<option value='{$newsxiugl['type']}'>{$newsxiugl['typename']}</option>";
                $newsxiugl['purp']=explode('|',$newsxiugl['purp']);
            }
            //获取颜色
            $glcolor=M('color')->select();
            //获取规格信息
            $xmbgoods=M('goodscolor')->where('gid = '.$_GET['id'])->select();
            foreach($xmbgoods as $k=>$v){
                $glnorm=M('goodsnorm')->where('gid = '.$_GET['id'].' AND id = '.$xmbgoods[$k]['ggid'])->find();
                $glcolorgl=M('color')->where(' id = '.$xmbgoods[$k]['color'])->find();
                $xmbgoods[$k]['gginfo']=$glnorm['title'];
                $xmbgoods[$k]['ggid']=$glnorm['id'];
                $xmbgoods[$k]['color']=$glcolorgl['color'];
                $xmbgoods[$k]['ccid']=$glcolorgl['id'];
            }
//            dump($xmbgoods);
            $this->assign('xmbgoods',$xmbgoods);
            $this->assign('glcolor',$glcolor);
            $this->assign('newsxiugl',$newsxiugl);
            $this->display("Product/ProductEditcu");
        }else{
//            dump($_POST);exit;
            if(!empty($_POST['newid'])){
                if(empty($_POST['type'])){
                    $this->error('请选择新增商品栏目');
                }
//               $incou=1;
                $incou=count($_POST['level']);
                if($incou<1){
                    $this->error('最少添加一个规格的商品');
                }
//                dump($_POST);
                if(!empty($_POST['imgurlglgo'])){
                    $glgoods['imgurl'] = implode($_POST['imgurlglgo']);
//                    $this->error('请您上传商品图');
                }
                if(!empty($_POST['imgurlgl'])){
                    $glgoods['imgurl2'] = implode('|',$_POST['imgurlgl']);
//                    $this->error('请您上传商品细节图');
                }
//                if(!$info['imgurl2']) {// 上传错误提示错误信息
//                    $this->error('请上传商品列表图片');
//                }
                $glgoods['brand']=$_POST['brand'];
                $glgoods['type']=$_POST['type'];
                $glgoods['is_nc']=3;//2为普通商品
//                $glgoods['is_new']=$_POST['is_new'];//促销预留
                $glgoods['is_boy']=$_POST['is_boy'];
                $glgoods['gname']=$_POST['gname'];
                $glgoods['ordernum']=$_POST['ordernum'];
                $glgoods['modelnum']=$_POST['modelnum'];
                $glgoods['style']=$_POST['style'];
                $glgoods['rooty']=$_POST['rooty'];
                $glgoods['keywords']=$_POST['keywords'];
                $glgoods['description']=$_POST['description'];
                $a=$_POST['price'];
                $pos = array_search(min($a), $a);
                $glgoods['price']= $a[$pos];
                foreach($_POST['colordglf'] as $k=>$v){
                    $map[$k]='('.$v.')';
                }
                $glgoods['color'] = implode(',',$map);
//                $glgoods['is_up']=1;
                $glgoods['text']=$_POST['text'];
                $glgoods['purp']=$_POST['purp'][0].'|'.$_POST['purp'][1].'|'.$_POST['purp'][2].'|'.$_POST['purp'][3];
                if(empty($glgoods['gname'])){
                    $this->error('商品标题不能为空');
                }
                if(empty($glgoods['keywords'])){
                    $this->error('商品关键词不能为空');
                }
                if(empty($glgoods['description'])){
                    $this->error('商品摘要不能为空');
                }
                if(empty($glgoods['text'])){
                    $this->error('商品介绍不能为空');
                }
                if(strlen($glgoods['gname']) < 15 || strlen($glgoods['gname']) >75 ){
                    $this->error('商品标题在5到25个字符之间');
                }
                if(strlen($glgoods['keywords']) < 15 || strlen($glgoods['keywords']) >75 ){
                    $this->error('商品关键词在5到25个字符之间');
                }
                if(strlen($glgoods['description']) < 30 || strlen($glgoods['description']) >600 ){
                    $this->error('商品摘要在10到200个字符之间');
                }
//                dump($glgoods);exit;
                $ord = M("goods");
                $ord->startTrans();
                $resule=$ord->where('id ='.$_POST['newid'])->save($glgoods);
                $incou2=count($_POST['ggid']);
                if(($incou-$incou2)>0){
                    for($i=0;$i<$incou;$i++){
//                        $infogo[$i]['gid'] = $resule;
                        if($i>$incou-1){
                            $infogo[$i]['title'] = $_POST['level'][$i];
                            $resulet = M('goodsnorm')->where('id = '.$_POST['ggid'][$i])->save($infogo[$i]);
                            $infogoto[$i]['color']=$_POST['colordglf'][$i];
                            $infogoto[$i]['num']=$_POST['num'][$i];
                            $infogoto[$i]['price']=$_POST['price'][$i];
                            $resulett=M('goodscolor')->where('id = '.$_POST['cid'][$i])->save($infogoto[$i]);
                        }else{
                            $infogo[$i]['gid'] = $_POST['newid'];
                            $infogo[$i]['title'] = $_POST['level'][$i];
                            $resulet = M('goodsnorm')->add($infogo[$i]);
                            $infogoto[$i]['gid']=$_POST['newid'];
                            $infogoto[$i]['ggid']=$resulet;
//                            $infogoto[$i]['root']=$_POST['root'][$i];
                            $infogoto[$i]['color']=$_POST['colordglf'][$i];
                            $infogoto[$i]['num']=$_POST['num'][$i];
                            $infogoto[$i]['price']=$_POST['price'][$i];
                            $resulett=M('goodscolor')->add($infogoto[$i]);
                        }

                    }
                }else{
                    for($i=0;$i<$incou2;$i++){
//                        $infogo[$i]['gid'] = $resule;
                        $infogo[$i]['title'] = $_POST['level'][$i];
                        $resulet = M('goodsnorm')->where('id = '.$_POST['ggid'][$i])->save($infogo[$i]);
                        $infogoto[$i]['color']=$_POST['colordglf'][$i];
                        $infogoto[$i]['num']=$_POST['num'][$i];
                        $infogoto[$i]['price']=$_POST['price'][$i];
                        $resulett=M('goodscolor')->where('id = '.$_POST['cid'][$i])->save($infogoto[$i]);
                    }
                }
                if(($resule!==false) && ($resulet!==false) && ($resulett!==false)){
//                if($resule && $resulet && $resulett){
                    $ord->commit();
                    $this->success('修改商品成功',U('Product/productListcu'));exit;
                }else{
                    $ord->rollback();
                    $this->error('修改商品失败');
                }
            }
        }
    }
    /**
     *	商品新增
     **/
    public function ProductEditnew(){
        if(!IS_POST){
//            dump($_GET['id']);
            if(!empty($_GET['id'])){
                $addr=M('goods');
                $newsxiugl=$addr->find($_GET['id']);
                $brandgl=M('goodstype')->field('brand,type')->find($newsxiugl['type']);
                $newsxiugl['brand']=$brandgl['brand'];
                $newsxiugl['typename']=$brandgl['type'];
                $newsxiugl['typegl']='';
                $newsxiugl['typegl'] .= "<option value='{$newsxiugl['type']}'>{$newsxiugl['typename']}</option>";
                $newsxiugl['purp']=explode('|',$newsxiugl['purp']);
            }
            //获取颜色
            $glcolor=M('color')->select();
            //获取规格信息
            $xmbgoods=M('goodscolor')->where('gid = '.$_GET['id'])->select();
            foreach($xmbgoods as $k=>$v){
                $glnorm=M('goodsnorm')->where('gid = '.$_GET['id'].' AND id = '.$xmbgoods[$k]['ggid'])->find();
                $glcolorgl=M('color')->where(' id = '.$xmbgoods[$k]['color'])->find();
                $xmbgoods[$k]['gginfo']=$glnorm['title'];
                $xmbgoods[$k]['ggid']=$glnorm['id'];
                $xmbgoods[$k]['color']=$glcolorgl['color'];
                $xmbgoods[$k]['ccid']=$glcolorgl['id'];
            }
//            dump($xmbgoods);

            $gltaoxi=M('goodstaoxi')->field('type,id')->select();
            $this->assign('gltaoxi',$gltaoxi);
            $this->assign('xmbgoods',$xmbgoods);
            $this->assign('glcolor',$glcolor);
            $this->assign('newsxiugl',$newsxiugl);
            $this->display("Product/ProductEditnew");
        }else{
//            dump($_POST);exit;
            if(!empty($_POST['newid'])){
                if(empty($_POST['type'])){
                    $this->error('请选择新增商品栏目');
                }
//               $incou=1;
                $incou=count($_POST['level']);
                if($incou<1){
                    $this->error('最少添加一个规格的商品');
                }
//                dump($_POST);
                if(!empty($_POST['imgurlglgo'])){
                    $glgoods['imgurl'] = implode($_POST['imgurlglgo']);
//                    $this->error('请您上传商品图');
                }
                if(!empty($_POST['imgurlgl'])){
                    $glgoods['imgurl2'] = implode('|',$_POST['imgurlgl']);
//                    $this->error('请您上传商品细节图');
                }
//                if(!$info['imgurl2']) {// 上传错误提示错误信息
//                    $this->error('请上传商品列表图片');
//                }
                $glgoods['brand']=$_POST['brand'];
                $glgoods['type']=$_POST['type'];
                $glgoods['is_nc']=1;//2为普通商品
//                $glgoods['is_new']=$_POST['is_new'];//促销预留
                $glgoods['is_boy']=$_POST['is_boy'];
                $glgoods['gname']=$_POST['gname'];
                $glgoods['ordernum']=$_POST['ordernum'];
                $glgoods['modelnum']=$_POST['modelnum'];
                $glgoods['style']=$_POST['style'];
                $glgoods['rooty']=$_POST['rooty'];
                $glgoods['keywords']=$_POST['keywords'];
                $glgoods['description']=$_POST['description'];
                $a=$_POST['price'];
                $pos = array_search(min($a), $a);
                $glgoods['price']= $a[$pos];
//                $glgoods['imgurl'] = 'bbbbb';
//                $glgoods['imgurl2'] = 'aaaaa';
                foreach($_POST['colordglf'] as $k=>$v){
                    $map[$k]='('.$v.')';
                }
                $glgoods['color'] = implode(',',$map);
//                $glgoods['is_up']=1;
                $glgoods['taoxi']=$_POST['taoxi'];//
                $glgoods['text']=$_POST['text'];
                $glgoods['purp']=$_POST['purp'][0].'|'.$_POST['purp'][1].'|'.$_POST['purp'][2].'|'.$_POST['purp'][3];
//                $glgoods['addtime']=time();
//                $glgoods['addman']=$_SESSION['adminid'];
//                dump($glgoods['color']);
//                dump($glgoods);exit;colordglf
                if(empty($glgoods['gname'])){
                    $this->error('商品标题不能为空');
                }
                if(empty($glgoods['keywords'])){
                    $this->error('商品关键词不能为空');
                }
                if(empty($glgoods['description'])){
                    $this->error('商品摘要不能为空');
                }
                if(empty($glgoods['text'])){
                    $this->error('商品介绍不能为空');
                }
                if(strlen($glgoods['gname']) < 15 || strlen($glgoods['gname']) >75 ){
                    $this->error('商品标题在5到25个字符之间');
                }
                if(strlen($glgoods['keywords']) < 15 || strlen($glgoods['keywords']) >75 ){
                    $this->error('商品关键词在5到25个字符之间');
                }
                if(strlen($glgoods['description']) < 30 || strlen($glgoods['description']) >600 ){
                    $this->error('商品摘要在10到200个字符之间');
                }
//                dump($glgoods);exit;
                $ord = M("goods");
                $ord->startTrans();
                $resule=$ord->where('id ='.$_POST['newid'])->save($glgoods);
                $incou2=count($_POST['ggid']);
                if(($incou-$incou2)>0){
                    for($i=0;$i<$incou;$i++){
//                        $infogo[$i]['gid'] = $resule;
                        if($i>$incou-1){
                            $infogo[$i]['title'] = $_POST['level'][$i];
                            $resulet = M('goodsnorm')->where('id = '.$_POST['ggid'][$i])->save($infogo[$i]);
//                        $infogoto[$i]['gid']=$resule;
//                        $infogoto[$i]['ggid']=$resulet;
//                            $infogoto[$i]['root']=$_POST['root'][$i];
                            $infogoto[$i]['color']=$_POST['colordglf'][$i];
                            //                        $infogo[$i]['flymoney']=$_POST['flymoney'][$i];
                            //                        $infogo[$i]['point']=$_POST['point'][$i];
                            $infogoto[$i]['num']=$_POST['num'][$i];
                            $infogoto[$i]['price']=$_POST['price'][$i];
//                            $infogoto[$i]['style']=$_POST['style'][$i];
                            //                        dump($infogo[$i]);exit;
                            //                    $_POST['imgurl'] = '/Public/uploads'.$info['imgurl']['savepath'].$info['imgurl']['savename'];
//                            $infogoto[$i]['imgurl']='/Public/uploads'.$info[$i]['savepath'].$info[$i]['savename'];;
                            $resulett=M('goodscolor')->where('id = '.$_POST['cid'][$i])->save($infogoto[$i]);
                        }else{
                            $infogo[$i]['gid'] = $_POST['newid'];
                            $infogo[$i]['title'] = $_POST['level'][$i];
                            $resulet = M('goodsnorm')->add($infogo[$i]);
                            $infogoto[$i]['gid']=$_POST['newid'];
                            $infogoto[$i]['ggid']=$resulet;
//                            $infogoto[$i]['root']=$_POST['root'][$i];
                            $infogoto[$i]['color']=$_POST['colordglf'][$i];
                            //                        $infogo[$i]['flymoney']=$_POST['flymoney'][$i];
                            //                        $infogo[$i]['point']=$_POST['point'][$i];
                            $infogoto[$i]['num']=$_POST['num'][$i];
                            $infogoto[$i]['price']=$_POST['price'][$i];
//                            $infogoto[$i]['style']=$_POST['style'][$i];
                            //                        dump($infogo[$i]);exit;
                            //                    $_POST['imgurl'] = '/Public/uploads'.$info['imgurl']['savepath'].$info['imgurl']['savename'];
//                            $infogoto[$i]['imgurl']='/Public/uploads'.$info[$i]['savepath'].$info[$i]['savename'];;
                            $resulett=M('goodscolor')->add($infogoto[$i]);
                        }

                    }
                }else{
                    for($i=0;$i<$incou2;$i++){
//                        $infogo[$i]['gid'] = $resule;
                        $infogo[$i]['title'] = $_POST['level'][$i];
                        $resulet = M('goodsnorm')->where('id = '.$_POST['ggid'][$i])->save($infogo[$i]);
                        $infogoto[$i]['color']=$_POST['colordglf'][$i];
                        $infogoto[$i]['num']=$_POST['num'][$i];
                        $infogoto[$i]['price']=$_POST['price'][$i];
                        $resulett=M('goodscolor')->where('id = '.$_POST['cid'][$i])->save($infogoto[$i]);
                    }
                }
                if(($resule!==false) && ($resulet!==false) && ($resulett!==false)){
//                if($resule && $resulet && $resulett){
                    $ord->commit();
                    $this->success('修改商品成功',U('Product/productListnew'));exit;
                }else{
                    $ord->rollback();
                    $this->error('修改商品失败');
                }
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
            $deladdr=$addr->where('id ='.$nid)->delete();
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
//        dump($list);
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
            $deladdr=$addr->where('id ='.$nid)->setField('is_up',-1);
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
//        dump($list);
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
            $data['msg']="该商品不存在b";
            $this->ajaxReturn($data);
        }
//        dump($list);
    }

    /**
     *	资讯列表
     **/
    public function ccateList(){
        //参数获取
        $search['brand'] = I('get.brand');
//        $search['end'] = I('get.end');
//        $search['start'] = I('get.start');
        $search['title'] = I('get.title');
//        dump($search);
        if(!empty($search['title'])){
            $map['type'] = array('like', '%' . $search['title'] . '%');
        }
        if(!empty($search['brand'])){
            $map['brand'] = $search['brand'];
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
        $count=M('goodstype')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('goodstype')->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->
        select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
//        dump($list);
        $this->display("product/ccateList");
    }
    /**
     *	资讯添加
     **/
    public function ccateAdd(){
        if(!IS_POST){
//            dump($_GET['id']);
            if(!empty($_GET['id'])){
                $newsxiugl=M('goodstype')->find($_GET['id']);
//                dump($newsxiugl);
            }
            $this->assign('newsxiugl',$newsxiugl);
            $this->display("product/ccateAdd");
        }else{
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize  = 3145728 ;// 设置附件上传大小
            $upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->savePath =  '/goods/';// 设置附件上传目录
            $upload->rootPath = './Public/uploads/'; // 设置附件上传根目录
            $info =  $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }
            if(!$info['imgurlm']) {// 上传错误提示错误信息
                $this->error('请上传手机版图片');
            }
            $_POST['imgurl'] = '/Public/uploads'.$info['imgurl']['savepath'].$info['imgurl']['savename'];
            $_POST['imgurlm'] = '/Public/uploads'.$info['imgurlm']['savepath'].$info['imgurlm']['savename'];
//            dump($_POST['newid']);exit;
            $_POST['addtime']=time();
            $_POST['addman']=$_SESSION['adminid'];
            if(empty($_POST['type'])){
                $this->error('商品分类标题不能为空');
            }
            if(strlen($_POST['type']) < 2 || strlen($_POST['type']) >30 ){
                $this->error('商品分类标题在2到10a个字符之间'.strlen($_POST['type']));
            }
            $resule=M('goodstype')->add($_POST);
            if($resule){
                $this->success('新增商品分类成功',U('product/ccateList'));exit;
            }else{
                $this->error('新增商品分类失败');
            }
        }
    }

    /**
     *	资讯添加
     **/
    public function ccateEdit(){
        if(!IS_POST){
//            dump($_GET['id']);
            if(!empty($_GET['id'])){
                $newsxiugl=M('goodstype')->find($_GET['id']);
//                dump($newsxiugl);
            }
            $this->assign('newsxiugl',$newsxiugl);
            $this->display("product/ccateAdd");
        }else{
//            dump($_POST['newid']);exit;

            if(!empty($_POST['newid'])){
                if(!$_FILES['imgurl']['error'] ==4){
                    $upload = new \Think\Upload();// 实例化上传类
                    $upload->maxSize  = 3145728 ;// 设置附件上传大小
                    $upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                    $upload->savePath =  '/goods/';// 设置附件上传目录
                    $upload->rootPath = './Public/uploads/'; // 设置附件上传根目录
                    $info =  $upload->upload();
                    if(!$info) {// 上传错误提示错误信息
                        $this->error($upload->getError());
                    }
                    $_POST['imgurl'] = '/Public/uploads'.$info['imgurl']['savepath'].$info['imgurl']['savename'];
                }
                if(!$_FILES['imgurlm']['error'] ==4){
                    $upload = new \Think\Upload();// 实例化上传类
                    $upload->maxSize  = 3145728 ;// 设置附件上传大小
                    $upload->exts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                    $upload->savePath =  '/goods/';// 设置附件上传目录
                    $upload->rootPath = './Public/uploads/'; // 设置附件上传根目录
                    $info =  $upload->upload();
                    if(!$info) {// 上传错误提示错误信息
                        $this->error($upload->getError());
                    }
                    $_POST['imgurlm'] = '/Public/uploads'.$info['imgurlm']['savepath'].$info['imgurlm']['savename'];
                }
                if(empty($_POST['type'])){
                    $this->error('商品分类标题不能为空');
                }
                if(strlen($_POST['type']) < 2 || strlen($_POST['type']) >30 ){
                    $this->error('商品分类标题在2到10个字符之间');
                }
                $resule=M('goodstype')->where('id ='.$_POST['newid'])->save($_POST);
                if(!$resule==false){
                    $this->success('修改商品分类成功',U('product/ccateList'));exit;
                }else{
                    $this->error('修改商品分类失败');
                }
            }else{
                $this->error('找不到商品分类信息');
            }
        }
    }

    /**
     *	删除商品分类
     **/
    public function delcate(){
        $nid=$_POST['id'];
        if(empty($nid)){
            $data['code']=0;
            $data['msg']="请选择要移除的商品分类";
            $this->ajaxReturn($data);
        }
        if(!is_numeric($nid)){
            $data['code']=0;
            $data['msg']="参数错误，请稍后再试";
            $this->ajaxReturn($data);
        }
        $addr=M('goodstype');
        $result=$addr->where('id ='.$nid)->find();
        $isshuju=M('goods')->where('type = '.$nid)->select();
        if(!$isshuju==false){
            $data['code']=0;
            $data['msg']="该商品分类下有数据，请删除数据后再试";
            $this->ajaxReturn($data);
        }
//        exit;
        if($result){
            $deladdr=$addr->where('id ='.$nid)->delete();
            if($deladdr){
                $data['code']=1;
                $data['msg']="删除商品分类信息成功";
                $this->ajaxReturn($data);
            }else{
                $data['code']=0;
                $data['msg']="删除商品分类信息失败";
                $this->ajaxReturn($data);
            }
        }else{
            $data['code']=0;
            $data['msg']="要删除的商品分类信息不存在";
            $this->ajaxReturn($data);
        }
//        dump($list);
    }


    /**
     *	资讯列表
     **/
    public function taoxiList(){
        //参数获取
        $search['brand'] = I('get.brand');
//        $search['end'] = I('get.end');
//        $search['start'] = I('get.start');
        $search['title'] = I('get.title');
//        dump($search);
        if(!empty($search['title'])){
            $map['type'] = array('like', '%' . $search['title'] . '%');
        }
        if(!empty($search['brand'])){
            $map['brand'] = $search['brand'];
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
        $count=M('goodstaoxi')->where($map)->count();
        $Page = new \Think\Page($count,10);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = M('goodstaoxi')->where($map)->order('id')->limit($Page->firstRow.','.$Page->listRows)->
        select();
        //套系类型
        foreach($list as $k=>$v){
            $tgl=M('goodstao')->field('type')->find($list[$k]['brand']);
            $list[$k]['brand'] =$tgl['type'] ;
        }
//        dump($list);
        $typegl=M('goodstao')->field('type,id')->select();
        $this->assign('typegl',$typegl);
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);// 赋值分页输出
//        dump($list);
        $this->display("product/taoxiList");
    }
    /**
     *	资讯添加
     **/
    public function taoxiAdd(){
        if(!IS_POST){
//            dump($_GET['id']);
            if(!empty($_GET['id'])){
                $newsxiugl=M('goodstaoxi')->find($_GET['id']);
//                dump($newsxiugl);
            }
            $typegl=M('goodstao')->field('type,id')->select();
            $this->assign('typegl',$typegl);
            $this->assign('newsxiugl',$newsxiugl);
            $this->display("product/TaoxiAdd");
        }else{

            $_POST['imgurl'] = implode($_POST['imgurlglgo']);
            $_POST['imgurlct'] = implode($_POST['imgurlgl']);
            $_POST['imgurl2'] = implode($_POST['imgurlglgo2']);
//            dump($_POST['newid']);exit;
            $_POST['addtime']=time();
            $_POST['addman']=$_SESSION['adminid'];
            if(empty($_POST['type'])){
                $this->error('套系标题不能为空');
            }
            if(strlen($_POST['type']) < 2 || strlen($_POST['type']) >30 ){
                $this->error('套系标题在2到10个字符之间'.strlen($_POST['type']));
            }
            $resule=M('goodstaoxi')->add($_POST);
            if($resule){
                $this->success('新增套系分类成功',U('product/taoxiList'));exit;
            }else{
                $this->error('新增套系分类失败');
            }
        }
    }

    /**
     *	资讯添加
     **/
    public function taoxiEdit(){
        if(!IS_POST){
//            dump($_GET['id']);
            if(!empty($_GET['id'])){
                $newsxiugl=M('goodstaoxi')->find($_GET['id']);
                //类型
                $typegl=M('goodstao')->field('type,id')->select();
                $this->assign('typegl',$typegl);
//                dump($newsxiugl);
            }
            $this->assign('newsxiugl',$newsxiugl);
            $this->display("product/taoxiAdd");
        }else{
//            dump($_POST);exit;
            if(!empty($_POST['imgurlglgo'])){
                $_POST['imgurl'] = implode($_POST['imgurlglgo']);
            }
            if(!empty($_POST['imgurlglgo2'])){
                $_POST['imgurl2'] = implode($_POST['imgurlglgo2']);
            }
            if(!empty($_POST['imgurlgl'])){
                $_POST['imgurlct'] = implode($_POST['imgurlgl']);
            }
                if(empty($_POST['type'])){
                    $this->error('套系标题不能为空');
                }
                if(strlen($_POST['type']) < 2 || strlen($_POST['type']) >30 ){
                    $this->error('套系标题在2到10个字符之间');
                }
//                dump($_POST);
                $resule=M('goodstaoxi')->where('id ='.$_POST['newid'])->save($_POST);
//            echo M('goodstaoxi')->getLastSql();
//            dump($resule);
                if($resule!==false){
                    $this->success('修改套系成功',U('product/taoxiList'));exit;
                }else{
                    $this->error('修改套系失败');
                }
            }
        }


    /**
     *	删除商品分类
     **/
    public function deltaoxi(){
        $nid=$_POST['id'];
        if(empty($nid)){
            $data['code']=0;
            $data['msg']="请选择要移除的商品分类";
            $this->ajaxReturn($data);
        }
        if(!is_numeric($nid)){
            $data['code']=0;
            $data['msg']="参数错误，请稍后再试";
            $this->ajaxReturn($data);
        }
        $addr=M('goodstaoxi');
        $result=$addr->where('id ='.$nid)->find();
        $isshuju=M('goods')->where('type = '.$nid)->select();
        if(!$isshuju==false){
            $data['code']=0;
            $data['msg']="该套系下有数据，请删除数据后再试";
            $this->ajaxReturn($data);
        }else{
            $data['code']=0;
            $data['msg']="该套系下有数据，请删除数据后再试";
            $this->ajaxReturn($data);
        }
//        exit;
        if($result){
            $deladdr=$addr->where('id ='.$nid)->delete();
            if($deladdr){
                $data['code']=1;
                $data['msg']="删除套系信息成功";
                $this->ajaxReturn($data);
            }else{
                $data['code']=0;
                $data['msg']="删除套系信息失败";
                $this->ajaxReturn($data);
            }
        }else{
            $data['code']=0;
            $data['msg']="要删除的套系信息不存在";
            $this->ajaxReturn($data);
        }
//        dump($list);
    }
    /**
     *	联动处理
     **/
    public function cate1(){
        $nid=$_POST['id'];
        if(empty($nid)){
            $data['code']=0;
            $data['msg']="参数错误";
            $this->ajaxReturn($data);
        }
        if(!is_numeric($nid)){
            $data['code']=0;
            $data['msg']="参数错误，请稍后再试";
            $this->ajaxReturn($data);
        }
        $addr=M('goodstype');
        $result=$addr->where('brand ='.$nid)->select();
//        exit;
        if($result){
            $data['code']=1;
            $data['msg']='';
            foreach($result as $v){
                $data['msg'] .= "<option value='{$v['id']}'>{$v['type']}</option>";
            }
            $this->ajaxReturn($data);
        }else{
            $data['code']=0;
            $data['msg']="该品牌下暂无分类信息";
            $this->ajaxReturn($data);
        }
//        dump($list);
    }


    /**
     *	删除分类规格信息
     **/
    public function delggcid(){
        $ggid=$_POST['ggid'];
        $cid=$_POST['cid'];
        if(empty($ggid)||empty($cid)){
            $data['code']=0;
            $data['msg']="参数错误";
            $this->ajaxReturn($data);
        }
        if(!is_numeric($ggid)||!is_numeric($cid)){
            $data['code']=0;
            $data['msg']="参数错误，请稍后再试";
            $this->ajaxReturn($data);
        }
        $ord = M("goodsnorm");
        $ord->startTrans();
        $result2=$ord->delete($ggid);
        $result=M('goodscolor')->delete($cid);
        if($result2&&$result){
            $ord->commit();
            $data['code']=1;
            $data['msg']="删除规格信息成功";
            $this->ajaxReturn($data);
        }else{
            $ord->rollback();
            $data['code']=0;
            $data['msg']="删除规格信息失败，请您稍后再试";
            $this->ajaxReturn($data);
        }
    }

}