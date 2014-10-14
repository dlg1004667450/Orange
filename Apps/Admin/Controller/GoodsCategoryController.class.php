<?php

namespace Admin\Controller;

use Think\Controller;

/**
 * 后台商品分类管理
 *
 * @author NENER
 *        
 */
class GoodsCategoryController extends Controller {
	/**
	 * 首页
	 */
	public function index() {
		$model = M ( 'goods_category' );
		// 查询条件
		$wherrArr = array (
				'Status' => array (
						'gt',
						- 1 
				) 
		);
		//总数
		$allCount = $model->where ( $wherrArr )->count ();
		//分页
		$Page = new \Think\Page ( $allCount, 10 );
		$showPage = $Page->show ();
		//分页查询
		$list = $model->where ( $wherrArr )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list );
		$this->assign ( 'page', $showPage );
		$this->display ( 'index/category' );
	}
	/**
	 * 删除
	 */
	public function del() {
		$id = I ( 'get.Id' );
		if ($id) {
			$whereArr = array (
					'Id' => $id 
			);
			if (M ( 'goods_category' )->where ( $whereArr )->delete ()) {
				$this->success ( "操作成功", U ( 'index' ) );
			} else {
				$this->error ( "删除失败", U ( 'index' ) );
			}
		} else {
			$this->error ( "页面不存在", U ( 'index' ) );
		}
	}
	/**
	 * 修改
	 */
	public function modif() {
		$id = I ( 'get.Id' );
		if ($id) {
			$whereArr = array (
					'Id' => $id 
			);
			$model=M ( 'goods_category' )->where ( $whereArr )->find ();
			if ($model) {
				$whereArrKeyword=array(
					'CaregoryId'=>$id
				);
				$list=M('goods_category_keyword')->where($whereArrKeyword)->select();
				
				$this->assign ( 'list', $list );
				$this->display ( 'index/category' );
			} else {
				$this->error ( "删除失败", U ( 'index' ) );
			}
		} else {
			$this->error ( "删除失败", U ( 'index' ) );
		}
	}
}