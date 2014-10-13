<?php

namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller {
	public function index() {
		
		redirect( U('good/index'));
		// $news=M('News')->select();
		$this->assign ( 'model', M ( 'News' )->select () )->display ( 'index' );
	}
}