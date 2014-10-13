<?php

namespace Admin\Controller;

use Think\Controller;
use Think\Model;
use Org\Util\String;

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
		// 总数
		$allCount = $model->where ( $wherrArr )->count ();
		// 分页
		$Page = new \Think\Page ( $allCount, 10 );
		$showPage = $Page->show ();
		// 分页查询
		$list = $model->where ( $wherrArr )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		$this->assign ( 'list', $list );
		$this->assign ( 'page', $showPage );
		$this->display ( 'index/category' );
	}
	/**
	 * 删除
	 */
	public function del() {
		$id = ( int ) I ( 'get.Id' );
		if ($id) {
			$whereArr = array (
					'Id' => $id 
			);
			$dal = M ();
			$dal->startTrans (); // 开始事务
			$model = M ( 'goods_category' );
			$model->Status = - 1;
			$r1 = $model->where ( $whereArr )->save (); // 操作1
			$whereArrKw = array (
					'CategoryId' => $id 
			);
			// 操作2
			$r2 = $dal->execute ( "update goods_category_keyword set Status=-1 where CategoryId=" . $id );
			if ($r1 && $r2) { // 成功
				$dal->commit (); // 提交事务
				$this->success ( "操作成功", U ( 'index' ) );
			} else {
				$dal->rollback (); // 否则回滚
				$this->error ( "操作失败", U ( 'index' ) );
			}
		} else {
			$this->error ( "页面不存在", U ( 'index' ) );
		}
	}
	/**
	 * 查询要修改的数据
	 */
	public function update() {
		$id = ( int ) I ( 'get.Id' );
		if ($id) {
			$whereArr = array (
					'Id' => $id 
			);
			$model = M ( 'goods_category' )->where ( $whereArr )->find ();
			if ($model) {
				$whereArrKeyword = array (
						'CategoryId' => $id 
				);
				$this->assign ( 'model', $model );
				$this->assign ( 'modif', 'update' )->display ( 'index/modifcategory' );
			} else {
				$this->error ( "操作失败", U ( 'index' ) );
			}
		} else {
			$this->error ( "操作失败", U ( 'index' ) );
		}
	}
	/**
	 * 保存
	 * 包含更新 ，添加
	 */
	public function save() {
		if (! IS_POST) {
			$this->error ( "页面不存在" );
		}
		$model = M ( 'goods_category' );
		$model->Title = I('Title');
		$model->Presentation = I('Presentation');
		$whereArr = array (
				'Id' => ( int ) I ( "post.Id" ) 
		);
		$res= $model->where ( $whereArr )->save (); 
		$this->success('操作成功',U('index'));
	}
}