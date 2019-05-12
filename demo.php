<?php
$memObj = new Memcache;

$rs = $memObj->connect('127.0.0.1', '11211');
if(!$rs){
	die('连接memcache失败');
}

#打开一个到服务器的持久化连接
//todo: 这里建立的连接是持久化的,不会在脚本执行结束后 或者 Memcache::close()被调用后关闭;
//$rs = $memObj->pconnect('127.0.0.1', '11211');


//多台服务器
//$memobj->addServer('192.168.1.102', '11211');
//$memobj->addServer('192.168.1.103', '11211');






//get
$result = $memObj->get('username');
echo('<pre>');
var_dump($result);
exit;


//==============================================
//add string
$result = $memObj->add('username', 'this is demo username', MEMCACHE_COMPRESSED, 3600);
if(!$result){
	die('添加失败');
}

//add array
$member = array('username'=>'张三', 'age'=>19, 'sex'=>'男');
$result = $memObj->add('member', $member, MEMCACHE_COMPRESSED, 3600);
if(!$result){
	die('添加失败');
}

//add object
class Person {
	var $username = '李四';
	var $age = 23;
	var $sex = '女';

	public function getName(){
		return $this->username;
	}
}
$result = $memObj->add('person', new Person, MEMCACHE_COMPRESSED, 3600);
if(!$result){
	die('添加失败');
}


//==============================================
//replace
$result = $memObj->replace('username', 'my is vow', MEMCACHE_COMPRESSED, 3600);
if(!$result){
	die('replace更新失败');
}


//==============================================
//set
$result = $memObj->set('username', 'my is vow', MEMCACHE_COMPRESSED, 3600);
if(!$result){
	die('set修改失败');
}

//==============================================
//del删除
$result = $memObj->delete('username');
if(!$result){
	die('del删除失败');
}


//==============================================
//获取服务器版本信息
$result = $memObj->getVersion();
echo('<pre>');
var_dump($result);
exit;
//==============================================


$memObj->close();
?>