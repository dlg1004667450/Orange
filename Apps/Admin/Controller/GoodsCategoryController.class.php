<?php

namespace Admin\Controller;

use Think\Controller;

/**
 * 商品分类管理
 *
 * @author NENER
 *        
 */
class GoodsCategoryController extends Controller {
	public function index() {
		$model = M ( 'goods_category' );
		// 查询条件
		$wherrArr = array (
				'Status' => array (
						'gt',
						- 1 
				) 
		);
		$allCount = $model->where ( $wherrArr )->count ();
		$Page = new \Think\Page ( $allCount, 10 );
		$showPage = $Page->show ();
		$list = $model->where ( $wherrArr )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list );
		$this->assign ( 'page', $showPage );
		$this->display ( 'index/category' );
	}
	public function del() {
		$id = I ( 'get.id' );
		if ($id) {
			$this->success("页面不存在",U('index'));
		} else {
			$this->success("页面不存在",U('index'));
		}
	}
}