<?php
header("Content-type: text/html; charset=utf-8");

$mem	= new Memcache;
$mem->connect('localhost', 11211);

#使用memcache获取数据
/*
 * 注意：
 * 1. 同一个项目安装两次，key要有前缀
 * 2. 用sql语句做下标，可以保持一致性
 * 3. 键值可以用md5算法得到hash值保持一致(缺点不好手动去获取值)
 */
$sql		= "select goods_id, goods_sn, goods_name, goods_number, keywords from ecs_goods limit 20";
$keys		= md5($sql);
$data		= $mem->get($keys);

if(empty($data))
{
	#连接mysqlaccept
	$mysqli		= new mysqli('localhost', 'root', 'root', 'ecshop');

	$result		= $mysqli->query($sql);
	
	$data		= array();
	while($row = $result->Fetch_assoc())
	{	
		#$row['keywords']		= iconv('GBK', 'UTF-8', $row['keywords']);

		$data[]		= $row;
	}
	$result->free();
	$mysqli->close();
	
	#写入memcache缓存
	$mem->set($keys, $data, MEMCACHE_COMPRESSED, 3600);
	
	echo($sql);
}

#
echo('<pre>');
print_r($data);
echo('</pre>');

#close
$mem->close();
?>