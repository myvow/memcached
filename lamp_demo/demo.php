<?php 
$mem	= new Memcache;
$mem->connect('localhost', 11211);

#添加多个服务器
#$mem->addServer('www.lamp.com', 11211);
#$mem->addServer('192.168.1.100', 11211);

//测试数据
$mem->add('goods_name', 'hello world', MEMCACHE_COMPRESSED, 3600);
#echo('---------'.MEMCACHE_COMPRESSED.'<br><br>');

#添加
$mem->add('goods_name', 'hello aaabb world', MEMCACHE_COMPRESSED, 3600);

#读取
$str	= $mem->get('goods_name');
echo($str.'<br>');

#替换
$mem->set('goods_name', 'nihao aaa china', MEMCACHE_COMPRESSED, 3600);
echo($str.'<br>');

#删除
$mem->delete('goods_name');
$str	= $mem->get('goods_name');
echo($str.'<br>');

#删除所有
$mem->flush();

#添加数组
$mem->add('myArr', array('aaa', 'bbb', 'ccc', 'ddd'), MEMCACHE_COMPRESSED, 3600);
$arr	= $mem->get('myArr');
print_r($arr.'<br>');

#添加对象
class Person
{
	var $name	= 'wofeel';
	var $age	= '23';
}
$mem->add('myobj', new Person);
var_dump($mem->get('myobj'));
echo('<br>');

#读取Memcache系统信息
$version	= $mem->getVersion();
echo($version.'<br>');

echo('<pre>');
print_r($mem->getStats());
echo('</pre>');


$mem->close();
?>