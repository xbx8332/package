<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 *
 */
class mysql_db
{
	var $link_id    = NULL; 

	var $settings   = array();

	var $queryCount = 0;
	var $queryTime  = '';
	var $queryLog   = array();

	var $max_cache_time = 30; // 最大的缓存时间，以秒为单位

	var $cache_data_dir = 'public/runtime/app/db_caches/';
	var $root_path      = '';

	var $error_message  = array();
	var $platform       = '';
	var $version        = '';
	var $dbhash         = '';
	var $starttime      = 0;
	var $timeline       = 0;
	var $timezone       = 0;
	var $sql='';
	var $link_list = array();  //分布查询链接池
	
	protected $PDOStatement = null;
	// 当前操作所属的模型名
	protected $model      = '_think_';
	// 当前SQL指令
	protected $queryStr   = '';
	protected $modelSql   = array();
	// 最后插入ID
	protected $lastInsID  = null;
	// 返回或者影响记录数
	protected $numRows    = 0;
	// 事务指令数
	protected $transTimes = 0;
	// 错误信息
	protected $error      = '';
	// 数据库连接ID 支持多个连接
	protected $linkID     = array();
	// 当前连接ID
	protected $_linkID    = null;
	// 数据库连接参数配置
	protected $config     = array(
			'type'              =>  '',     // 数据库类型
			'hostname'          =>  '127.0.0.1', // 服务器地址
			'database'          =>  '',          // 数据库名
			'username'          =>  '',      // 用户名
			'password'          =>  '',          // 密码
			'hostport'          =>  '',        // 端口
			'dsn'               =>  '', //
			'params'            =>  array(), // 数据库连接参数
			'charset'           =>  'utf8',      // 数据库编码默认采用utf8
			'prefix'            =>  '',    // 数据库表前缀
        'debug'             =>  false, // 数据库调试模式
        'deploy'            =>  0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
	        'rw_separate'       =>  false,       // 数据库读写是否分离 主从式有效
	        		'master_num'        =>  1, // 读写分离后 主服务器数量
        'slave_no'          =>  '', // 指定从服务器序号
        'db_like_fields'    =>  '',
    );
	
	// 数据库表达式
	protected $exp = array('eq'=>'=','neq'=>'<>','gt'=>'>','egt'=>'>=','lt'=>'<','elt'=>'<=','notlike'=>'NOT LIKE','like'=>'LIKE','in'=>'IN','notin'=>'NOT IN','not in'=>'NOT IN','between'=>'BETWEEN','not between'=>'NOT BETWEEN','notbetween'=>'NOT BETWEEN');
	// 查询表达式
	protected $selectSql  = 'SELECT%DISTINCT% %FIELD% FROM %TABLE%%FORCE%%JOIN%%WHERE%%GROUP%%HAVING%%ORDER%%LIMIT% %UNION%%LOCK%%COMMENT%';
	// 查询次数
	protected $queryTimes   =   0;
	// 执行次数
	protected $executeTimes =   0;
	// PDO连接参数
	protected $options = array(
			PDO::ATTR_CASE              =>  PDO::CASE_LOWER,
			PDO::ATTR_ERRMODE           =>  PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_ORACLE_NULLS      =>  PDO::NULL_NATURAL,
			PDO::ATTR_STRINGIFY_FETCHES =>  false,
	);
	protected $bind         =   array(); // 参数绑定

	
	function __construct($dbhost, $dbuser, $dbpw, $dbname = '', $charset = 'utf8', $pconnect = 0, $quiet = 0)
	{
		$this->mysql_db($dbhost, $dbuser, $dbpw, $dbname, $charset, $pconnect, $quiet);
	}
	function lastsql(){
		return $this->sql;
	}

	function mysql_db($dbhost, $dbuser, $dbpw, $dbname = '', $charset = 'utf8', $pconnect = 0, $quiet = 0)
	{
		if (defined('APP_ROOT_PATH') && !$this->root_path)
		{
			$this->root_path = APP_ROOT_PATH;
		}

		if ($quiet)
		{
			$this->connect($dbhost, $dbuser, $dbpw, $dbname, $charset, $pconnect, $quiet);
			foreach($GLOBALS['distribution_cfg']['DB_DISTRIBUTION'] as $k=>$cfg)
			{
				$this->connect_pid($k);
			}
		}
		else
		{
			$this->settings = array(
					'dbhost'   => $dbhost,
					'dbuser'   => $dbuser,
					'dbpw'     => $dbpw,
					'dbname'   => $dbname,
					'charset'  => $charset,
					'pconnect' => $pconnect
			);
		}
	}

	/**
	 * 连接指定的连接池
	 * @param unknown_type $pid
	 */
	function connect_pid($pid,$charset = 'utf8')
	{
		$dbhost = $GLOBALS['distribution_cfg']['DB_DISTRIBUTION'][$pid]['DB_HOST'];
		$dbport = $GLOBALS['distribution_cfg']['DB_DISTRIBUTION'][$pid]['DB_PORT'];
		$dbuser = $GLOBALS['distribution_cfg']['DB_DISTRIBUTION'][$pid]['DB_USER'];
		$dbpw = $GLOBALS['distribution_cfg']['DB_DISTRIBUTION'][$pid]['DB_PWD'];
		$dbname = $GLOBALS['distribution_cfg']['DB_DISTRIBUTION'][$pid]['DB_NAME'];
		$dbhost.=":".$dbport;
		 
		if (PHP_VERSION >= '4.2')
		{
			$this->link_list[$pid] = @mysql_connect($dbhost, $dbuser, $dbpw, true);
		}
		else
		{
			$this->link_list[$pid] = @mysql_connect($dbhost, $dbuser, $dbpw);
		}
		if($this->link_list[$pid])
		{
			$this->version = mysql_get_server_info($this->link_list[$pid]);
			/* 如果mysql 版本是 4.1+ 以上，需要对字符集进行初始化 */
			if ($this->version > '4.1')
			{
				if ($charset != 'latin1')
				{
					mysql_query("SET character_set_connection=$charset, character_set_results=$charset, character_set_client=binary", $this->link_list[$pid]);
				}
				if ($this->version > '5.0.1')
				{
					mysql_query("SET sql_mode=''", $this->link_list[$pid]);
				}
			}
			if ($dbname)
			{
				if (mysql_select_db($dbname, $this->link_list[$pid]) === false )
				{
					@mysql_close($this->link_list[$pid]);
					$this->link_list[$pid] = null;
				}
				else
				{
					return true;
				}
			}
			else
			{
				@mysql_close($this->link_list[$pid]);
				$this->link_list[$pid] = null;
				 
			}
		}
		 

		logger::write("db_distribution_init_err:".$pid,logger::ERR,logger::FILE,"db_distribution");
		return false;
		 
	}

	function connect($dbhost, $dbuser, $dbpw, $dbname = '', $charset = 'utf8', $pconnect = 0, $quiet = 0 )
	{
		if ($pconnect)
		{
			if (!($this->link_id = @mysql_pconnect($dbhost, $dbuser, $dbpw)))
			{
				if (!$quiet)
				{
					$this->ErrorMsg("Can't pConnect MySQL Server($dbhost)!");
				}

				return false;
			}
		}
		else
		{
			if (PHP_VERSION >= '4.2')
			{
				$this->link_id = @mysql_connect($dbhost, $dbuser, $dbpw, true);
			}
			else
			{
				$this->link_id = @mysql_connect($dbhost, $dbuser, $dbpw);

				mt_srand((double)microtime() * 1000000); // 对 PHP 4.2 以下的版本进行随机数函数的初始化工作
			}
			if (!$this->link_id)
			{
				if (!$quiet)
				{
					$this->ErrorMsg("Can't Connect MySQL Server($dbhost)!");
				}

				return false;
			}
		}

		$this->dbhash  = md5($this->root_path . $dbhost . $dbuser . $dbpw . $dbname);
		$this->version = mysql_get_server_info($this->link_id);

		/* 如果mysql 版本是 4.1+ 以上，需要对字符集进行初始化 */
		if ($this->version > '4.1')
		{
			if ($charset != 'latin1')
			{
				mysql_query("SET character_set_connection=$charset, character_set_results=$charset, character_set_client=binary", $this->link_id);
			}
			if ($this->version > '5.0.1')
			{
				mysql_query("SET sql_mode=''", $this->link_id);
			}
		}

		$sqlcache_config_file = $this->root_path . $this->cache_data_dir . 'sqlcache_config_file_' . $this->dbhash . '.php';


		$this->starttime = time();

		if (!file_exists($sqlcache_config_file))
		{
			if ($dbhost != '.')
			{
				$result = mysql_query("SHOW VARIABLES LIKE 'basedir'", $this->link_id);
				$row    = mysql_fetch_assoc($result);
				if (!empty($row['Value']{1}) && $row['Value']{1} == ':' && !empty($row['Value']{2}) && $row['Value']{2} == "\\")
				{
					$this->platform = 'WINDOWS';
				}
				else
				{
					$this->platform = 'OTHER';
				}
			}
			else
			{
				$this->platform = 'WINDOWS';
			}

			if ($this->platform == 'OTHER' &&
					($dbhost != '.' && strtolower($dbhost) != 'localhost:3306' && $dbhost != '127.0.0.1:3306') ||
					(PHP_VERSION >= '5.1' && date_default_timezone_get() == 'UTC'))
			{
				$result = mysql_query("SELECT UNIX_TIMESTAMP() AS timeline, UNIX_TIMESTAMP('" . date('Y-m-d H:i:s', $this->starttime) . "') AS timezone", $this->link_id);
				$row    = mysql_fetch_assoc($result);

				if ($dbhost != '.' && strtolower($dbhost) != 'localhost:3306' && $dbhost != '127.0.0.1:3306')
				{
					$this->timeline = $this->starttime - $row['timeline'];
				}

				if (PHP_VERSION >= '5.1' && date_default_timezone_get() == 'UTC')
				{
					$this->timezone = $this->starttime - $row['timezone'];
				}
			}

			$content = '<' . "?php\r\n" .
					'$this->mysql_config_cache_file_time = ' . $this->starttime . ";\r\n" .
					'$this->timeline = ' . $this->timeline . ";\r\n" .
					'$this->timezone = ' . $this->timezone . ";\r\n" .
					'$this->platform = ' . "'" . $this->platform . "';\r\n?" . '>';

			@file_put_contents($sqlcache_config_file, $content);
		}
		@include($sqlcache_config_file);


		/* 选择数据库 */
		if ($dbname)
		{
			if (mysql_select_db($dbname, $this->link_id) === false )
			{
				if (!$quiet)
				{
					$this->ErrorMsg("Can't select MySQL database($dbname)!");
				}

				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;
		}
	}

	function select_database($dbname)
	{
		return mysql_select_db($dbname, $this->link_id);
	}


	function query($sql,$type="SILENT",$pid=-1)
	{
		if(!SHOW_DEBUG)$type="SILENT";

		$query_link = null;
		if($pid>=0)
		{
			if ($this->link_list[$pid] === NULL)
			{
				$this->connect_pid($pid);
			}
			$query_link = $this->link_list[$pid];
		}

		if($query_link === NULL)
		{
			if ($this->link_id === NULL)
			{
				$this->connect($this->settings['dbhost'], $this->settings['dbuser'], $this->settings['dbpw'], $this->settings['dbname'], $this->settings['charset'], $this->settings['pconnect']);
				$this->settings = array();
			}
			$query_link = $this->link_id;
		}


		if ($this->queryCount++ <= 99)
		{
			$this->queryLog[] = $sql;
		}

		/* 当当前的时间大于类初始化时间的时候，自动执行 ping 这个自动重新连接操作 */
		if (PHP_VERSION >= '4.3' && time() > $this->starttime + 1)
		{
			mysql_ping($query_link);
		}

		if (PHP_VERSION >= '5.0.0')
		{
			$begin_query_time = microtime(true);
		}
		else
		{
			$begin_query_time = microtime();
		}

		if (!($query = mysql_query($sql, $query_link)) && $type != 'SILENT')
		{
			$this->error_message[]['message'] = 'MySQL Query Error';
			if($pid)
				$this->error_message[]['message'] = 'MySQL Query Error:'.$pid;
			$this->error_message[]['sql'] = $sql;
			$this->error_message[]['error'] = mysql_error($query_link);
			$this->error_message[]['errno'] = mysql_errno($query_link);

			$this->ErrorMsg();

			return false;
		}
		if (PHP_VERSION >= '5.0.0')
		{
			$query_time = microtime(true) - $begin_query_time;
		}
		else
		{
			list($now_usec, $now_sec)     = explode(' ', microtime());
			list($start_usec, $start_sec) = explode(' ', $begin_query_time);
			$query_time = ($now_sec - $start_sec) + ($now_usec - $start_usec);
		}
		$this->queryTime+=$query_time;

		if (SHOW_LOG)
		{
			$str = $sql;
			logger::write($str,logger::DEBUG,logger::FILE,"db");
		}
		//echo $sql."<br/><br/>======================================<br/><br/>";
		return $query;
	}

	function affected_rows()
	{
		return mysql_affected_rows($this->link_id);
	}

	function error()
	{
		return mysql_error($this->link_id);
	}

	function errno()
	{
		return mysql_errno($this->link_id);
	}



	function insert_id()
	{
		return mysql_insert_id($this->link_id);
	}


	function close()
	{
		return mysql_close($this->link_id);
	}

	function ErrorMsg($message = '', $sql = '')
	{
		if ($message)
		{
			echo "<b>error info</b>: $message\n\n<br /><br />";
		}
		else
		{
		echo "<b>MySQL server error report:";
		}

        exit;
    }

	/**
	* 检测查询语句中的表是否支持查询缓存
	* @param unknown_type $sql true:即时查询 false:缓存查询
	*/
	function is_immediate($sql,$is_immediate)
	{
		if(!$is_immediate)
		{
			if(in_array(APP_INDEX, $GLOBALS['distribution_cfg']['DB_CACHE_APP'])&&$GLOBALS['distribution_cfg']['CACHE_TYPE']!="File")
			{
				return false;
			}
	    	else
	    	{
	    		return true;
	    	}
    	}
    	else
    	{
    		if(in_array(APP_INDEX, $GLOBALS['distribution_cfg']['DB_CACHE_APP'])&&$GLOBALS['distribution_cfg']['CACHE_TYPE']!="File")
    		{
	    		preg_match_all("/".DB_PREFIX."([\S]+)/", $sql,$matches);
	    		if($matches)
	    		{
	    			foreach($matches[1] as $k=>$table)
	    			{
	    				if(in_array($table, $GLOBALS['distribution_cfg']['DB_CACHE_TABLES']))
	    				{
	    					return false;
    					}
    				}
    			}
    		}
    	}
    	return true;
	}


   function getReadDbPid($sql)
   {
   		$c = count($GLOBALS['distribution_cfg']['DB_DISTRIBUTION']);	    		 
    	if($c==0||!$GLOBALS['distribution_cfg']['ALLOW_DB_DISTRIBUTE'])
    		return -1;
	    else
    	{
    		preg_match_all("/".DB_PREFIX."([\S]+)/", $sql,$matches);
    		if($matches)
    		{
    			foreach($matches[1] as $k=>$table)
    			{
    				if(!in_array($table, $GLOBALS['distribution_cfg']['DB_CACHE_TABLES']))
    				{
    						return -1;
    				}
    			}
    		}

    		//通过sql散列
    		$pid = hash_table($sql,$c);
    		return $pid;
    	}
    }

    				/**
    				*
    				* @param unknown_type $sql
    				* @param unknown_type $is_immediate 是否为立即查 询，默认为true,则再按缓存配置读取, false时直接按指定方式
    				* @return unknown|Ambigous <>|string|boolean
    				*/
    				function getOne($sql,$is_immediate = true)
    				{
    					$immediate = $this->is_immediate($sql,$is_immediate);
    					$res = false;
    					if(!IS_DEBUG&&!$immediate)
    					{
    					$GLOBALS['cache']->set_dir(APP_ROOT_PATH.$this->cache_data_dir);
    					$res = $GLOBALS['cache']->get($sql);
    					}
    					if($res!==false)
    					{
    						return $res;
    					}
    					 

    					$res = $this->query($sql,"",$this->getReadDbPid($sql));
    					if ($res !== false)
    						{
    						$row = mysql_fetch_row($res);

    						if ($row !== false)
    							{
    								if(!IS_DEBUG&&!$immediate)
    								{

    									$GLOBALS['cache']->set_dir(APP_ROOT_PATH.$this->cache_data_dir);
    									$GLOBALS['cache']->set($sql,$row[0],$this->max_cache_time);

    								}
    								return $row[0];
    						}
    						else
    						{
    						if(!IS_DEBUG&&!$immediate)
    						{

    						$GLOBALS['cache']->set_dir(APP_ROOT_PATH.$this->cache_data_dir);
    						$GLOBALS['cache']->set($sql,'',$this->max_cache_time);

    						}
    						return '';
    						}
    						}
    						else
    						{
    						if(!IS_DEBUG&&!$immediate)
    						{

        			$GLOBALS['cache']->set_dir(APP_ROOT_PATH.$this->cache_data_dir);
        			$GLOBALS['cache']->set($sql,'',$this->max_cache_time);
     
        			}
        			return false;
        			}
        			}

        			function getAll($sql,$is_immediate=true)
        			{
        			$immediate = $this->is_immediate($sql,$is_immediate);

        			$res = false;
        			if(!IS_DEBUG&&!$immediate)
        			{

        			$GLOBALS['cache']->set_dir(APP_ROOT_PATH.$this->cache_data_dir);
        			$res = $GLOBALS['cache']->get($sql);
        			 
        			}
        			if($res!==false)
        			{
        			return $res;
        			}
        			 
        			$res = $this->query($sql,"",$this->getReadDbPid($sql));
        			if ($res !== false)
        			{
        			$arr = array();
        			while ($row = mysql_fetch_assoc($res))
        			{
        			$arr[] = $row;
        			}

        			if(!IS_DEBUG&&!$immediate)
        			{

        			$GLOBALS['cache']->set_dir(APP_ROOT_PATH.$this->cache_data_dir);
        			$GLOBALS['cache']->set($sql,$arr,$this->max_cache_time);

        			}
        			return $arr;
        			}
        				else
        				{
        					if(!IS_DEBUG&&!$immediate)
        					{

        					$GLOBALS['cache']->set_dir(APP_ROOT_PATH.$this->cache_data_dir);
        					$GLOBALS['cache']->set($sql,'',$this->max_cache_time);

        				}
            return false;
        			}
        			}


        			function getRow($sql,$is_immediate=true)
        			{
        			$immediate = $this->is_immediate($sql,$is_immediate);
        			$res = false;
        			if(!IS_DEBUG&&!$immediate)
        			{

        			$GLOBALS['cache']->set_dir(APP_ROOT_PATH.$this->cache_data_dir);
        				$res = $GLOBALS['cache']->get($sql);

            }
            if($res!==false)
            {
            return $res;
            }
             
            $res = $this->query($sql,"",$this->getReadDbPid($sql));
            	if ($res !== false)
            	{
            	$res = mysql_fetch_assoc($res);
            	if(!IS_DEBUG&&!$immediate)
            	{
            	 
            	$GLOBALS['cache']->set_dir(APP_ROOT_PATH.$this->cache_data_dir);
            	if($res)
            		$GLOBALS['cache']->set($sql,$res,$this->max_cache_time);
            	else
            		$GLOBALS['cache']->set($sql,'',$this->max_cache_time);

            	}
            			return $res;
            	}
            	else
            	{
            		if(!IS_DEBUG&&!$immediate)
            		{
            		$GLOBALS['cache']->set_dir(APP_ROOT_PATH.$this->cache_data_dir);
            		$GLOBALS['cache']->set($sql,'',$this->max_cache_time);
        			}
        			return false;
    					}
    					}

    					/**
    					* 针对数据的查询缓存返回的当前时间戳，用于查询
    					* @param unknown_type $time
    					*/
    					function getCacheTime($time)
    					{
    						return intval($time/$this->max_cache_time)*$this->max_cache_time;
    					}

    					function getCol($sql)
    					{
    					$res = $this->query($sql);
    					if ($res !== false)
    					{
    						$arr = array();
    						while ($row = mysql_fetch_row($res))
    						{
    						$arr[] = $row[0];
    			}
    			return $arr;
    			}
        else
        {
        return false;
    			}
    			}

    			function autoExecute($table, $field_values, $mode = 'INSERT', $where = '', $querymode = '')
            	{
            	$field_names = $this->getCol('DESC ' . $table);

            	$sql = '';
            	if ($mode == 'INSERT')
            	{
            		$fields = $values = array();
            		foreach ($field_names AS $value)
            		{
            		if (@array_key_exists($value, $field_values) == true)
            		{
            		$fields[] = $value;
            		$field_values[$value] = stripslashes($field_values[$value]);
            				$values[] = "'" . addslashes($field_values[$value]) . "'";
            		}
            		}

            		if (!empty($fields))
            		{
            			$sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $fields) . ') VALUES (' . implode(', ', $values) . ')';
            			}
            		}
            		else
            				{
            				$sets = array();
            				foreach ($field_names AS $value)
            				{
                if (array_key_exists($value, $field_values) == true)
                {
                $field_values[$value] = stripslashes($field_values[$value]);
                		$sets[] = $value . " = '" . addslashes($field_values[$value]) . "'";
            	}
            	}

            		if (!empty($sets))
            		{
                $sql = 'UPDATE ' . $table . ' SET ' . implode(', ', $sets) . ' WHERE ' . $where;
            }
        }
		$this->sql = $sql;
        if ($sql)
        {
            return $this->query($sql, $querymode);
        }
        else
        {
            return false;
        }
    }
    /**
     * 查找记录
     * @access public
     * @param array $options 表达式
     * @return mixed
     */
    public function select($options=array()) {
    	
    	$this->model  =   $options['model'];
    	$this->parseBind(!empty($options['bind'])?$options['bind']:array());
    	$sql    = $this->buildSelectSql($options);
    	$result   = $this->getAll($sql);
    	
    	return $result;
    }
    public function find($options=array()) {
    	 
    	$this->model  =   $options['model'];
    	$this->parseBind(!empty($options['bind'])?$options['bind']:array());
    	$sql    = $this->buildSelectSql($options);
    	$result   = $this->getRow($sql);
    	 
    	return $result;
    }
    /**
     * 参数绑定
     * @access protected
     * @param string $name 绑定参数名
     * @param mixed $value 绑定值
     * @return void
     */
    protected function bindParam($name,$value){
    	$this->bind[':'.$name]  =   $value;
    }
    /**
     * 生成查询SQL
     * @access public
     * @param array $options 表达式
     * @return string
     */
    public function buildSelectSql($options=array()) {
    	if(isset($options['page'])) {
    		// 根据页数计算limit
    		list($page,$listRows)   =   $options['page'];
    		$page    =  $page>0 ? $page : 1;
    		$listRows=  $listRows>0 ? $listRows : (is_numeric($options['limit'])?$options['limit']:20);
    		$offset  =  $listRows*($page-1);
    		$options['limit'] =  $offset.','.$listRows;
    	}
    	$sql  =   $this->parseSql($this->selectSql,$options);
    	return $sql;
    }
    /**
     * 替换SQL语句中表达式
     * @access public
     * @param array $options 表达式
     * @return string
     */
    public function parseSql($sql,$options=array()){
    	$sql   = str_replace(
    			array('%TABLE%','%DISTINCT%','%FIELD%','%JOIN%','%WHERE%','%GROUP%','%HAVING%','%ORDER%','%LIMIT%','%UNION%','%LOCK%','%COMMENT%','%FORCE%'),
    			array(
    					$this->parseTable($options['table']),
    					$this->parseDistinct(isset($options['distinct'])?$options['distinct']:false),
    					$this->parseField(!empty($options['field'])?$options['field']:'*'),
    					$this->parseJoin(!empty($options['join'])?$options['join']:''),
    					$this->parseWhere(!empty($options['where'])?$options['where']:''),
    					$this->parseGroup(!empty($options['group'])?$options['group']:''),
    					$this->parseHaving(!empty($options['having'])?$options['having']:''),
    					$this->parseOrder(!empty($options['order'])?$options['order']:''),
    					$this->parseLimit(!empty($options['limit'])?$options['limit']:''),
    					$this->parseUnion(!empty($options['union'])?$options['union']:''),
    					$this->parseLock(isset($options['lock'])?$options['lock']:false),
    					$this->parseComment(!empty($options['comment'])?$options['comment']:''),
    					$this->parseForce(!empty($options['force'])?$options['force']:'')
    			),$sql);
    	return $sql;
    }
    
    /**
     * 字段名分析
     * @access protected
     * @param string $key
     * @return string
     */
    protected function parseKey(&$key) {
    	return $key;
    }

    /**
     * 设置锁机制
     * @access protected
     * @return string
     */
    protected function parseLock($lock=false) {
    	return $lock?   ' FOR UPDATE '  :   '';
    } 
//     /**
//      * set分析
//      * @access protected
//      * @param array $data
//      * @return string
//      */
//     protected function parseSet($data) {
//         foreach ($data as $key=>$val){
//             if(is_array($val) && 'exp' == $val[0]){
//                 $set[]  =   $this->parseKey($key).'='.$val[1];
//             }elseif(is_null($val)){
//                 $set[]  =   $this->parseKey($key).'=NULL';
//             }elseif(is_scalar($val)) {// 过滤非标量数据
//                 if(0===strpos($val,':') && in_array($val,array_keys($this->bind)) ){
//                     $set[]  =   $this->parseKey($key).'='.$this->escapeString($val);
//                 }else{
//                     $name   =   count($this->bind);
//                     $set[]  =   $this->parseKey($key).'=:'.$name;
//                     $this->bindParam($name,$val);
//                 }
//             }
//         }
//         return ' SET '.implode(',',$set);
//     }
//     /**
//      * 字段名分析
//      * @access protected
//      * @param string $key
//      * @return string
//      */
//     protected function parseKey(&$key) {
//     	return $key;
//     }
    /**
     * value分析
     * @access protected
     * @param mixed $value
     * @return string
     */
    protected function parseValue($value) {
    	if(is_string($value)) {
    		$value =  strpos($value,':') === 0 && in_array($value,array_keys($this->bind))? $this->escapeString($value) : '\''.$this->escapeString($value).'\'';
    	}elseif(isset($value[0]) && is_string($value[0]) && strtolower($value[0]) == 'exp'){
    		$value =  $this->escapeString($value[1]);
    	}elseif(is_array($value)) {
    		$value =  array_map(array($this, 'parseValue'),$value);
    	}elseif(is_bool($value)){
    		$value =  $value ? '1' : '0';
    	}elseif(is_null($value)){
    		$value =  'null';
    	}
    	return $value;
    }
    
    /**
     * SQL指令安全过滤
     * @access public
     * @param string $str  SQL字符串
     * @return string
     */
    public function escapeString($str) {
    	return addslashes($str);
    }
    
    /**
     * field分析
     * @access protected
     * @param mixed $fields
     * @return string
     */
    protected function parseField($fields) {
    	if(is_string($fields) && '' !== $fields) {
    		$fields    = explode(',',$fields);
    	}
    	if(is_array($fields)) {
    		// 完善数组方式传字段名的支持
    		// 支持 'field1'=>'field2' 这样的字段别名定义
    		$array   =  array();
    		foreach ($fields as $key=>$field){
    			if(!is_numeric($key))
    				$array[] =  $this->parseKey($key).' AS '.$this->parseKey($field);
    			else
    				$array[] =  $this->parseKey($field);
    		}
    		$fieldsStr = implode(',', $array);
    	}else{
    		$fieldsStr = '*';
    	}
    	//TODO 如果是查询全部字段，并且是join的方式，那么就把要查的表加个别名，以免字段被覆盖
    	return $fieldsStr;
    }
    
    /**
     * table分析
     * @access protected
     * @param mixed $table
     * @return string
     */
    protected function parseTable($tables) {
    	if(is_array($tables)) {// 支持别名定义
    		$array   =  array();
    		foreach ($tables as $table=>$alias){
    			if(!is_numeric($table))
    				$array[] =  $this->parseKey($table).' '.$this->parseKey($alias);
    			else
    				$array[] =  $this->parseKey($alias);
    		}
    		$tables  =  $array;
    	}elseif(is_string($tables)){
    		$tables  =  explode(',',$tables);
    		array_walk($tables, array(&$this, 'parseKey'));
    	}
    	return implode(',',$tables);
    }
    
    /**
     * where分析
     * @access protected
     * @param mixed $where
     * @return string
     */
    protected function parseWhere($where) {
    	$whereStr = '';
    	if(is_string($where)) {
    		// 直接使用字符串条件
    		$whereStr = $where;
    	}else{ // 使用数组表达式
    		$operate  = isset($where['_logic'])?strtoupper($where['_logic']):'';
    		if(in_array($operate,array('AND','OR','XOR'))){
    			// 定义逻辑运算规则 例如 OR XOR AND NOT
    			$operate    =   ' '.$operate.' ';
    			unset($where['_logic']);
    		}else{
    			// 默认进行 AND 运算
    			$operate    =   ' AND ';
    		}
    		foreach ($where as $key=>$val){
    			if(is_numeric($key)){
    				$key  = '_complex';
    			}
    			if(0===strpos($key,'_')) {
    				// 解析特殊条件表达式
    				$whereStr   .= $this->parseThinkWhere($key,$val);
    			}else{
    				// 查询字段的安全过滤
    				// if(!preg_match('/^[A-Z_\|\&\-.a-z0-9\(\)\,]+$/',trim($key))){
    				//     E(L('_EXPRESS_ERROR_').':'.$key);
    				// }
    				// 多条件支持
    				$multi  = is_array($val) &&  isset($val['_multi']);
    				$key    = trim($key);
    				if(strpos($key,'|')) { // 支持 name|title|nickname 方式定义查询字段
    					$array =  explode('|',$key);
    					$str   =  array();
    					foreach ($array as $m=>$k){
    						$v =  $multi?$val[$m]:$val;
    						$str[]   = $this->parseWhereItem($this->parseKey($k),$v);
    					}
    					$whereStr .= '( '.implode(' OR ',$str).' )';
    				}elseif(strpos($key,'&')){
    					$array =  explode('&',$key);
    					$str   =  array();
    					foreach ($array as $m=>$k){
    						$v =  $multi?$val[$m]:$val;
    						$str[]   = '('.$this->parseWhereItem($this->parseKey($k),$v).')';
    					}
    					$whereStr .= '( '.implode(' AND ',$str).' )';
    				}else{
    					$whereStr .= $this->parseWhereItem($this->parseKey($key),$val);
    				}
    			}
    			$whereStr .= $operate;
    		}
    		$whereStr = substr($whereStr,0,-strlen($operate));
    	}
    	return empty($whereStr)?'':' WHERE '.$whereStr;
    }
    
    // where子单元分析
    protected function parseWhereItem($key,$val) {
    	$whereStr = '';
    	if(is_array($val)) {
    		if(is_string($val[0])) {
    			$exp	=	strtolower($val[0]);
    			if(preg_match('/^(eq|neq|gt|egt|lt|elt)$/',$exp)) { // 比较运算
    				$whereStr .= $key.' '.$this->exp[$exp].' '.$this->parseValue($val[1]);
    			}elseif(preg_match('/^(notlike|like)$/',$exp)){// 模糊查找
    				if(is_array($val[1])) {
    					$likeLogic  =   isset($val[2])?strtoupper($val[2]):'OR';
    					if(in_array($likeLogic,array('AND','OR','XOR'))){
    						$like       =   array();
    						foreach ($val[1] as $item){
    							$like[] = $key.' '.$this->exp[$exp].' '.$this->parseValue($item);
    						}
    						$whereStr .= '('.implode(' '.$likeLogic.' ',$like).')';
    					}
    				}else{
    					$whereStr .= $key.' '.$this->exp[$exp].' '.$this->parseValue($val[1]);
    				}
    			}elseif('bind' == $exp ){ // 使用表达式
    				$whereStr .= $key.' = :'.$val[1];
    			}elseif('exp' == $exp ){ // 使用表达式
    				$whereStr .= $key.' '.$val[1];
    			}elseif(preg_match('/^(notin|not in|in)$/',$exp)){ // IN 运算
    				if(isset($val[2]) && 'exp'==$val[2]) {
    					$whereStr .= $key.' '.$this->exp[$exp].' '.$val[1];
    				}else{
    					if(is_string($val[1])) {
    						$val[1] =  explode(',',$val[1]);
    					}
    					$zone      =   implode(',',$this->parseValue($val[1]));
    					$whereStr .= $key.' '.$this->exp[$exp].' ('.$zone.')';
    				}
    			}elseif(preg_match('/^(notbetween|not between|between)$/',$exp)){ // BETWEEN运算
    				$data = is_string($val[1])? explode(',',$val[1]):$val[1];
    				$whereStr .=  $key.' '.$this->exp[$exp].' '.$this->parseValue($data[0]).' AND '.$this->parseValue($data[1]);
    			}else{
    				E(L('_EXPRESS_ERROR_').':'.$val[0]);
    			}
    		}else {
    			$count = count($val);
    			$rule  = isset($val[$count-1]) ? (is_array($val[$count-1]) ? strtoupper($val[$count-1][0]) : strtoupper($val[$count-1]) ) : '' ;
    			if(in_array($rule,array('AND','OR','XOR'))) {
    				$count  = $count -1;
    			}else{
    				$rule   = 'AND';
    			}
    			for($i=0;$i<$count;$i++) {
    				$data = is_array($val[$i])?$val[$i][1]:$val[$i];
    				if('exp'==strtolower($val[$i][0])) {
    					$whereStr .= $key.' '.$data.' '.$rule.' ';
    				}else{
    					$whereStr .= $this->parseWhereItem($key,$val[$i]).' '.$rule.' ';
    				}
    			}
    			$whereStr = '( '.substr($whereStr,0,-4).' )';
    		}
    	}else {
    		//对字符串类型字段采用模糊匹配
    		$likeFields   =   $this->config['db_like_fields'];
    		if($likeFields && preg_match('/^('.$likeFields.')$/i',$key)) {
    			$whereStr .= $key.' LIKE '.$this->parseValue('%'.$val.'%');
    		}else {
    			$whereStr .= $key.' = '.$this->parseValue($val);
    		}
    	}
    	return $whereStr;
    }
    
    /**
     * 特殊条件分析
     * @access protected
     * @param string $key
     * @param mixed $val
     * @return string
     */
    protected function parseThinkWhere($key,$val) {
    	$whereStr   = '';
    	switch($key) {
    		case '_string':
    			// 字符串模式查询条件
    			$whereStr = $val;
    			break;
    		case '_complex':
    			// 复合查询条件
    			$whereStr = substr($this->parseWhere($val),6);
    			break;
    		case '_query':
    			// 字符串模式查询条件
    			parse_str($val,$where);
    			if(isset($where['_logic'])) {
    				$op   =  ' '.strtoupper($where['_logic']).' ';
    				unset($where['_logic']);
    			}else{
    				$op   =  ' AND ';
    			}
    			$array   =  array();
    			foreach ($where as $field=>$data)
    				$array[] = $this->parseKey($field).' = '.$this->parseValue($data);
    			$whereStr   = implode($op,$array);
    			break;
    	}
    	return '( '.$whereStr.' )';
    }
    
    /**
     * limit分析
     * @access protected
     * @param mixed $lmit
     * @return string
     */
    protected function parseLimit($limit) {
    	return !empty($limit)?   ' LIMIT '.$limit.' ':'';
    }
    
    /**
     * join分析
     * @access protected
     * @param mixed $join
     * @return string
     */
    protected function parseJoin($join) {
    	$joinStr = '';
    	if(!empty($join)) {
    		$joinStr    =   ' '.implode(' ',$join).' ';
    	}
    	return $joinStr;
    }
    
    /**
     * order分析
     * @access protected
     * @param mixed $order
     * @return string
     */
    protected function parseOrder($order) {
    	if(is_array($order)) {
    		$array   =  array();
    		foreach ($order as $key=>$val){
    			if(is_numeric($key)) {
    				$array[] =  $this->parseKey($val);
    			}else{
    				$array[] =  $this->parseKey($key).' '.$val;
    			}
    		}
    		$order   =  implode(',',$array);
    	}
    	return !empty($order)?  ' ORDER BY '.$order:'';
    }
    
    /**
     * group分析
     * @access protected
     * @param mixed $group
     * @return string
     */
    protected function parseGroup($group) {
    	return !empty($group)? ' GROUP BY '.$group:'';
    }
    
    /**
     * having分析
     * @access protected
     * @param string $having
     * @return string
     */
    protected function parseHaving($having) {
    	return  !empty($having)?   ' HAVING '.$having:'';
    }
    
    /**
     * comment分析
     * @access protected
     * @param string $comment
     * @return string
     */
    protected function parseComment($comment) {
    	return  !empty($comment)?   ' /* '.$comment.' */':'';
    }
    
    /**
     * distinct分析
     * @access protected
     * @param mixed $distinct
     * @return string
     */
    protected function parseDistinct($distinct) {
    	return !empty($distinct)?   ' DISTINCT ' :'';
    }
    
    /**
     * union分析
     * @access protected
     * @param mixed $union
     * @return string
     */
    protected function parseUnion($union) {
    	if(empty($union)) return '';
    	if(isset($union['_all'])) {
    		$str  =   'UNION ALL ';
    		unset($union['_all']);
    	}else{
    		$str  =   'UNION ';
    	}
    	foreach ($union as $u){
    		$sql[] = $str.(is_array($u)?$this->buildSelectSql($u):$u);
    	}
    	return implode(' ',$sql);
    }
    
    /**
     * 参数绑定分析
     * @access protected
     * @param array $bind
     * @return array
     */
    protected function parseBind($bind){
    	$this->bind   =   array_merge($this->bind,$bind);
    }
    
    /**
     * index分析，可在操作链中指定需要强制使用的索引
     * @access protected
     * @param mixed $index
     * @return string
     */
    protected function parseForce($index) {
    	if(empty($index)) return '';
    	if(is_array($index)) $index = join(",", $index);
    	return sprintf(" FORCE INDEX ( %s ) ", $index);
    }
    
    /**
     * ON DUPLICATE KEY UPDATE 分析
     * @access protected
     * @param mixed $duplicate
     * @return string
     */
    protected function parseDuplicate($duplicate){
    	return '';
    }
    
    public function update($data,$options) {
    	
    	$this->model  =   $options['model'];
    	$this->parseBind(!empty($options['bind'])?$options['bind']:array());
    	$table  =   $options['table'];
    	$sql   = 'UPDATE ' . $table . $this->parseSet($data);
    	
    	if(strpos($table,',')){// 多表更新支持JOIN操作
    		$sql .= $this->parseJoin(!empty($options['join'])?$options['join']:'');
    	}
    	$sql .= $this->parseWhere(!empty($options['where'])?$options['where']:'');
    	if(!strpos($table,',')){
    		//  单表更新支持order和lmit
    		$sql   .=  $this->parseOrder(!empty($options['order'])?$options['order']:'')
    		.$this->parseLimit(!empty($options['limit'])?$options['limit']:'');
    	}
    
    	$sql .=   $this->parseComment(!empty($options['comment'])?$options['comment']:'');
    	$this->queryStr=$sql;
    	$this->sql=$sql;
    	return $this->query($sql,'');
    }
    protected function parseSet($data) {
    	
    	foreach ($data as $key=>$val){
    		if(is_array($val) && 'exp' == $val[0]){
    			$set[]  =   $this->parseKey($key).'='.$val[1];
    		}elseif(is_null($val)){
    			$set[]  =   $this->parseKey($key).'=NULL';
    		}elseif(is_scalar($val)) {// 过滤非标量数据
    			if(0===strpos($val,':') && in_array($val,array_keys($this->bind)) ){
    				$set[]  =   $this->parseKey($key).'='.$this->escapeString($val);
    			}else{
    				$name   =   count($this->bind);
    				$set[]  =   $this->parseKey($key).'="'.$val.'"';
    				$this->bindParam($name,$val);
    			}
    		}
    	}
    	//pp($set);die;
    	return ' SET '.implode(',',$set);
    }
    
    	/**
    	 * 插入记录
    	 * @access public
    	 * @param mixed $data 数据
    	 * @param array $options 参数表达式
    	 * @param boolean $replace 是否replace
    	 * @return false | integer
    	 */
    	public function insert($data,$options=array(),$replace=false) {
    		$values  =  $fields    = array();
    		$this->model  =   $options['model'];
    		$this->parseBind(!empty($options['bind'])?$options['bind']:array());
    		foreach ($data as $key=>$val){
    			if(is_array($val) && 'exp' == $val[0]){
    				$fields[]   =  $this->parseKey($key);
    				$values[]   =  $val[1];
    			}elseif(is_null($val)){
    				$fields[]   =   $this->parseKey($key);
    				$values[]   =   'NULL';
    			}elseif(is_scalar($val)) { // 过滤非标量数据
    				$fields[]   =   $this->parseKey($key);
    				if(0===strpos($val,':') && in_array($val,array_keys($this->bind))){
    					$values[]   =   $this->parseValue($val);
    				}else{
    					$name       =   count($this->bind);
    					
    					$values[]   = "'".$val."'";
    					$this->bindParam($name,$val);
    				}
    			}
    		}
    		// 兼容数字传入方式
    		$replace= (is_numeric($replace) && $replace>0)?true:$replace;
    		$sql    = (true===$replace?'REPLACE':'INSERT').' INTO '.$options['table'].' ('.implode(',', $fields).') VALUES ('.implode(',', $values).')'.$this->parseDuplicate($replace);
    		$sql    .= $this->parseComment(!empty($options['comment'])?$options['comment']:'');
    		return $this->query($sql,'');
    	}
    	public function getFields($tableName) {
    		//$this->initConnect(true);
    		list($tableName) = explode(' ', $tableName);
    		
    		$sql='select COLUMN_NAME from information_schema.COLUMNS where table_name = "'.$tableName.'"'; 
    		$result = $this->getAll($sql);
    		
    		$info   =   array();
    		
    		if($result){
    			foreach($result as $key => $val){
    				$info[]=$val['COLUMN_NAME'];
    			}
    		}
    		
    		//获取主键
//     		$sql='select b.rdb$field_name as field_name from rdb$relation_constraints a join rdb$index_segments b on a.rdb$index_name=b.rdb$index_name where a.rdb$constraint_type=\'PRIMARY KEY\' and a.rdb$relation_name=UPPER(\''.$tableName.'\')';
//     		$rs_temp = $this->query($sql);
//     		foreach($rs_temp as $row) {
//     			$info[trim($row['field_name'])]['primary']= true;
//     		}
    		return $info;
    	}
    	/**
    	 * 初始化数据库连接
    	 * @access protected
    	 * @param boolean $master 主服务器
    	 * @return void
    	 */
    	protected function initConnect($master=true) {
    		if(!empty($this->config['deploy']))
    			// 采用分布式数据库
    			$this->_linkID = $this->multiConnect($master);
    		else
    			// 默认单数据库
    			if ( !$this->_linkID ) $this->_linkID = $this->connect();
    	}
    	public function delete($options=array()) {
    		$this->model  =   $options['model'];
    		$this->parseBind(!empty($options['bind'])?$options['bind']:array());
    		$table  =   $this->parseTable($options['table']);
    		$sql    =   'DELETE FROM '.$table;
    		if(strpos($table,',')){// 多表删除支持USING和JOIN操作
    			if(!empty($options['using'])){
    				$sql .= ' USING '.$this->parseTable($options['using']).' ';
    			}
    			$sql .= $this->parseJoin(!empty($options['join'])?$options['join']:'');
    		}
    		$sql .= $this->parseWhere(!empty($options['where'])?$options['where']:'');
    		if(!strpos($table,',')){
    			// 单表删除支持order和limit
    			$sql .= $this->parseOrder(!empty($options['order'])?$options['order']:'')
    			.$this->parseLimit(!empty($options['limit'])?$options['limit']:'');
    		}
    		$sql .=   $this->parseComment(!empty($options['comment'])?$options['comment']:'');
    		
    		return $this->query($sql);
    	}
    
    	/**
    	 * 获取最近一次查询的sql语句
    	 * @param string $model  模型名
    	 * @access public
    	 * @return string
    	 */
    	public function getLastSql($model='') {
    		return $model?$this->modelSql[$model]:$this->queryStr;
    	}
    
}

?>