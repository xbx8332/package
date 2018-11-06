<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 *
 */
class auto_cache{
	
	//自动组装缓存的key
	protected function build_key($name,$param=array())
	{
		$name = strtoupper($name);
		foreach($param as $sub_key)
		{
			$name.="_".strtoupper($sub_key);
		}
		return $name;
	}	
}

?>