<?php
return array(
	//'閰嶇疆椤�'=>'閰嶇疆鍊�'
		'DB_TYPE'               =>  'mysql',     // 鏁版嵁搴撶被鍨�
		'DB_HOST'               =>  'localhost', // 鏈嶅姟鍣ㄥ湴鍧�
		'DB_NAME'               =>  'shop',          // 鏁版嵁搴撳悕
		'DB_USER'               =>  'root',      // 鐢ㄦ埛鍚�
		'DB_PWD'                =>  '',          // 瀵嗙爜
				//'DB_USER'               =>  'zhoumeng',      // 鐢ㄦ埛鍚�
		//'DB_PWD'                =>  '8520',          // 瀵嗙爜
		/* 妯″潡鐩稿叧閰嶇疆 */
		'DEFAULT_MODULE'     => 'Home',
		'MODULE_DENY_LIST'   => array('Common'),
		'MODULE_ALLOW_LIST'  => array('Home','Admin'),
);
