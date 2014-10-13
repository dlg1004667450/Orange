<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsCategoryController extends Controller {
	
	public  function  index(){
		$model= M('goods_category'); 
		$count      = $model->where('status=0')->count();
		$Page       = new \Think\Page($count,2);
		$show       = $Page->show();
		$list = $model->where('status=0')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display('index/index'); 
	}
	public  function  addGoods(){
	
	}

}