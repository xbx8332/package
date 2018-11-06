<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 *
 */
class redis_db{
	public static $redis = '';
	function __construct($redishost, $post='6379', $pwd='' )
	{
		if(redis_db::$redis==''){
			
			redis_db::$redis = new Redis();
	  		redis_db::$redis->connect($redishost, $post);
	  		redis_db::$redis->auth($pwd);
		}
		redis_db::$redis->SELECT(0);
	}
	
	
}
 