<?php
        $mem=new Memcache;
	$host="localhost";
	$port=11211;
	$mem->connect($host,$port);
	
	$items=$mem->getExtendedStats("items");

        $items=$items["$host:$port"]['items'];
	
	print_r($items);

	foreach($items as $value){
		foreach($value as $item){
			$number=$item["number"];

			$arr=$mem->getExtendedStats("cachedump",$number,0);

			print_r($arr);
		
			$line=$arr["$host:$port"];

			

			if( is_array($line) && count($line)>0){
		       
				foreach($line as $key=>$value){
			       
					echo $key.'=>';
				
					print_r($mem->get($key));
				
					echo "<br>";
            			 }
			}
		}
    	}

