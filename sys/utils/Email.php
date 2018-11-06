<?php
/**
 * ============================================================================
 * 神牛工作室
 *
 * 联系QQ:85534837
 * ============================================================================
 *
 */
/**
 * 邮件类
 *
 * 邮件操作类，目前只支持smtp服务的邮件发送
 *
 *
 * @package    library* www.33hao.com 专业团队 提供售后服务
 */
final class Email{
	/**
	 * 邮件服务器
	 */
	private $email_server;
	/**
	 * 端口
	 */
	private $email_port = 25;
	/**
	 * 账号
	 */
	private $email_user;
	/**
	 * 密码
	 */
	private $email_password;
	/**
	 * 发送邮箱
	 */
	private $email_from;
	/**
	 * 间隔符
	 */
	private $email_delimiter = "\n";
	/**
	 * 站点名称
	 */
	private $site_name;

	public function get($key){
		if (!empty($this->$key)){
			return $this->$key;
		}else {
			return false;
		}
	}

	public function set($key, $value){
		if (!isset($this->$key)){
			$this->$key = $value;
			return true;
		}else {
			return false;
		}
	}

	/**
	 * 发送邮件
	 *
	 * @param string $email_to 发送对象邮箱地址
	 * @param string $subject 邮件标题
	 * @param string $message 邮件内容
	 * @param string $from 页头来源内容
	 * @return bool 布尔形式的返回结果
	 */
	public function send($email_to, $subject, $message, $from = ''){
		if(empty($email_to)) return false;
		$message =$this->html($subject, $message);
		$this->setServer(C('email_host'), C('email_addr'), C('email_pass'),C('email_port'), true);
		$this->setFrom(C('email_addr')); //设置发件人
		
		$this->setReceiver($email_to); //设置收件人，多个收件人，调用多次
		$this->setMail($subject, $message); //设置邮件主题、内容
		return $this->sendMail(); //发送

		
	}

	public function send_sys_email($email_to, $subject, $message){

		$result = $this->send($email_to, $subject, $message);
		return $result;
	}

	/**
	 * 内容:邮件主体
	 *
	 * @param string $subject 邮件标题
	 * @param string $message 邮件内容
	 * @return string 字符串形式的返回结果
	 */
	private function html($subject, $message){
		$message = preg_replace("/href\=\"(?!http\:\/\/)(.+?)\"/i", 'href="'.SHOP_SITE_URL.'\\1"', $message);
		$tmp .= "<html><head>";
		$tmp .= '<meta http-equiv="Content-Type" content="text/html; charset='.CHARSET.'">';
		$tmp .= "<title>". $subject ."</title>";
		$tmp .= "</head><body>".$message."</body></html>";
		$message = $tmp;
		unset($tmp);
		return $message;
	}

	/**
	 * 发送对象邮件地址
	 *
	 * @param string $email_to 发送地址
	 * @return string 字符串形式的返回结果
	 */
	private function to($email_to){
		$email_to = preg_match('/^(.+?) \<(.+?)\>$/',$email_to, $mats) ? ($this->email_user ? '=?'.CHARSET.'?B?'.base64_encode($mats[1])."?= <$mats[2]>" : $mats[2]) : $email_to;
		return $email_to;
	}

	/**
	 * 内容:邮件标题
	 *
	 * @param string $subject 邮件标题
	 * @return string 字符串形式的返回结果
	 */
	private function subject($subject){
		$subject = '=?'.CHARSET.'?B?'.base64_encode(preg_replace("/[\r|\n]/", '', '['.$this->site_name.'] '.$subject)).'?=';
		return $subject;
	}

	/**
	 * 内容:邮件主体内容
	 *
	 * @param string $message 邮件主体内容
	 * @return string 字符串形式的返回结果
	 */
	private function message($message){
		$message = chunk_split(base64_encode(str_replace("\n", "\r\n", str_replace("\r", "\n", str_replace("\r\n", "\n", str_replace("\n\r", "\r", $message))))));
		return $message;
	}

	/**
	 * 内容:邮件页头
	 *
	 * @param string $from 邮件页头来源
	 * @return array $rs_row 返回数组形式的查询结果
	 */
	private function header($from=''){
		if ($from == ''){
			$from = '=?'.CHARSET.'?B?'.base64_encode($this->site_name)."?= <".$this->email_from.">" ;
		}else {
			$from = preg_match('/^(.+?) \<(.+?)\>$/',$from, $mats) ? '=?'.CHARSET.'?B?'.base64_encode($mats[1])."?= <$mats[2]>" : $from;
		}
		$header = "From: $from{$this->email_delimiter}";
		$header .= "X-Priority: 3{$this->email_delimiter}";
		$header .= "X-Mailer: 33hao {$this->email_delimiter}";
		$header .= "MIME-Version: 1.0{$this->email_delimiter}";
		$header .= "Content-type: text/html; ";
		$header .= "charset=".CHARSET."{$this->email_delimiter}";
		$header .= "Content-Transfer-Encoding: base64{$this->email_delimiter}";
		$header .= 'Message-ID: <'.gmdate('YmdHs').'.'.substr(md5($message.microtime()), 0, 6).rand(100000, 999999).'@'.$_SERVER['HTTP_HOST'].">{$this->email_delimiter}";
		return $header;
	}

	/**
	 * 错误信息记录
	 *
	 * @param string $msg 错误信息
	 * @return bool 布尔形式的返回结果
	 */
	private function resultLog($msg){
		if (DeBug === true){
			$fp = fopen('txt.txt','a+');
			fwrite($fp,$msg);
			fclose($fp);
			return true;
		}else {
			return true;
		}
	}
	/**
	 * @var string 邮件传输代理用户名
	 * @access protected
	 */
	protected $_userName;
	/**
	 * @var string 邮件传输代理密码
	 * @access protected
	 */
	protected $_password;
	/**
	 * @var string 邮件传输代理服务器地址
	 * @access protected
	 */
	protected $_sendServer;
	/**
	 * @var int 邮件传输代理服务器端口
	 * @access protected
	 */
	protected $_port;
	/**
	 * @var string 发件人
	 * @access protected
	 */
	protected $_from;
	/**
	 * @var array 收件人
	 * @access protected
	 */
	protected $_to = array();
	/**
	 * @var array 抄送
	 * @access protected
	*/
	protected $_cc = array();
	/**
	 * @var array 秘密抄送
	 * @access protected
	*/
	protected $_bcc = array();
	/**
	 * @var string 主题
	 * @access protected
	*/
	protected $_subject;
	/**
	 * @var string 邮件正文
	 * @access protected
	 */
	protected $_body;
	/**
	 * @var array 附件
	 * @access protected
	 */
	protected $_attachment = array();
	/**
	 * @var reource socket资源
	 * @access protected
	*/
	protected $_socket;
	/**
	 * @var reource 是否是安全连接
	 * @access protected
	 */
	protected $_isSecurity;
	/**
	 * @var string 错误信息
	 * @access protected
	 */
	protected $_errorMessage;
	/**
	 * 设置邮件传输代理，如果是可以匿名发送有邮件的服务器，只需传递代理服务器地址就行
	 * @access public
	 * @param string $server 代理服务器的ip或者域名
	 * @param string $username 认证账号
	 * @param string $password 认证密码
	 * @param int $port 代理服务器的端口，smtp默认25号端口
	 * @param boolean $isSecurity 到服务器的连接是否为安全连接，默认false
	 * @return boolean
	 */
	public function setServer($server, $username="", $password="", $port=25, $isSecurity=false) {
		$this->_sendServer = $server;
		$this->_port = $port;
		$this->_isSecurity = $isSecurity;
		$this->_userName = empty($username) ? "" : base64_encode($username);
		$this->_password = empty($password) ? "" : base64_encode($password);
		return true;
	}
	/**
	 * 设置发件人
	 * @access public
	 * @param string $from 发件人地址
	 * @return boolean
	 */
	public function setFrom($from) {
		$this->_from = $from;
		return true;
	}
	/**
	 * 设置收件人，多个收件人，调用多次.
	 * @access public
	 * @param string $to 收件人地址
	 * @return boolean
	 */
	public function setReceiver($to) {
		$this->_to[] = $to;
		return true;
	}
	/**
	 * 设置抄送，多个抄送，调用多次.
	 * @access public
	 * @param string $cc 抄送地址
	 * @return boolean
	 */
	public function setCc($cc) {
		$this->_cc[] = $cc;
		return true;
	}
	/**
	 * 设置秘密抄送，多个秘密抄送，调用多次
	 * @access public
	 * @param string $bcc 秘密抄送地址
	 * @return boolean
	 */
	public function setBcc($bcc) {
		$this->_bcc[] = $bcc;
		return true;
	}
	/**
	 * 设置邮件附件，多个附件，调用多次
	 * @access public
	 * @param string $file 文件地址
	 * @return boolean
	 */
	public function addAttachment($file) {
		if(!file_exists($file)) {
			$this->_errorMessage = "file " . $file . " does not exist.";
			return false;
		}
		$this->_attachment[] = $file;
		return true;
	}
	/**
	 * 设置邮件信息
	 * @access public
	 * @param string $body 邮件主题
	 * @param string $subject 邮件主体内容，可以是纯文本，也可是是HTML文本
	 * @return boolean
	 */
	public function setMail($subject, $body) {
		$this->_subject = base64_encode($subject);
		$this->_body = base64_encode($body);
		return true;
	}
	/**
	 * 发送邮件
	 * @access public
	 * @return boolean
	 */
	public function sendMail() {
		$command = $this->getCommand();
		$this->_isSecurity ? $this->socketSecurity() : $this->socket();
		foreach ($command as $value) {
			$result = $this->_isSecurity ? $this->sendCommandSecurity($value[0], $value[1]) : $this->sendCommand($value[0], $value[1]);
			if($result) {
				continue;
			}
			else{
				return false;
			}
		}
		//其实这里也没必要关闭，smtp命令：QUIT发出之后，服务器就关闭了连接，本地的socket资源会自动释放
		$this->_isSecurity ? $this->closeSecutity() : $this->close();
		return true;
	}
	/**
	 * 返回错误信息
	 * @return string
	 */
	public function error(){
		if(!isset($this->_errorMessage)) {
			$this->_errorMessage = "";
		}
		return $this->_errorMessage;
	}
	/**
	 * 返回mail命令
	 * @access protected
	 * @return array
	 */
	protected function getCommand() {
		$separator = "----=_Part_" . md5($this->_from . time()) . uniqid(); //分隔符
		$command = array(
				array("HELO sendmail\r\n", 250)
		);
		if(!empty($this->_userName)){
			$command[] = array("AUTH LOGIN\r\n", 334);
			$command[] = array($this->_userName . "\r\n", 334);
			$command[] = array($this->_password . "\r\n", 235);
		}
		//设置发件人
		$command[] = array("MAIL FROM: <" . $this->_from . ">\r\n", 250);
		$header = "FROM: <" . $this->_from . ">\r\n";
		//设置收件人
		if(!empty($this->_to)) {
			$count = count($this->_to);
			if($count == 1){
				$command[] = array("RCPT TO: <" . $this->_to[0] . ">\r\n", 250);
				$header .= "TO: <" . $this->_to[0] .">\r\n";
			}
			else{
				for($i=0; $i<$count; $i++){
					$command[] = array("RCPT TO: <" . $this->_to[$i] . ">\r\n", 250);
					if($i == 0){
						$header .= "TO: <" . $this->_to[$i] .">";
					}
					elseif($i + 1 == $count){
						$header .= ",<" . $this->_to[$i] .">\r\n";
					}
					else{
						$header .= ",<" . $this->_to[$i] .">";
					}
				}
			}
		}
		//设置抄送
		if(!empty($this->_cc)) {
			$count = count($this->_cc);
			if($count == 1){
				$command[] = array("RCPT TO: <" . $this->_cc[0] . ">\r\n", 250);
				$header .= "CC: <" . $this->_cc[0] .">\r\n";
			}
			else{
				for($i=0; $i<$count; $i++){
					$command[] = array("RCPT TO: <" . $this->_cc[$i] . ">\r\n", 250);
					if($i == 0){
						$header .= "CC: <" . $this->_cc[$i] .">";
					}
					elseif($i + 1 == $count){
						$header .= ",<" . $this->_cc[$i] .">\r\n";
					}
					else{
						$header .= ",<" . $this->_cc[$i] .">";
					}
				}
			}
		}
		//设置秘密抄送
		if(!empty($this->_bcc)) {
			$count = count($this->_bcc);
			if($count == 1) {
				$command[] = array("RCPT TO: <" . $this->_bcc[0] . ">\r\n", 250);
				$header .= "BCC: <" . $this->_bcc[0] .">\r\n";
			}
			else{
				for($i=0; $i<$count; $i++){
					$command[] = array("RCPT TO: <" . $this->_bcc[$i] . ">\r\n", 250);
					if($i == 0){
						$header .= "BCC: <" . $this->_bcc[$i] .">";
					}
					elseif($i + 1 == $count){
						$header .= ",<" . $this->_bcc[$i] .">\r\n";
					}
					else{
						$header .= ",<" . $this->_bcc[$i] .">";
					}
				}
			}
		}
		//主题
		$header .= "Subject: =?UTF-8?B?" . $this->_subject ."?=\r\n";
		if(isset($this->_attachment)) {
			//含有附件的邮件头需要声明成这个
			$header .= "Content-Type: multipart/mixed;\r\n";
		}
		elseif(false){
			//邮件体含有图片资源的,且包含的图片在邮件内部时声明成这个，如果是引用的远程图片，就不需要了
			$header .= "Content-Type: multipart/related;\r\n";
		}
		else{
			//html或者纯文本的邮件声明成这个
			$header .= "Content-Type: multipart/alternative;\r\n";
		}
		//邮件头分隔符
		$header .= "\t" . 'boundary="' . $separator . '"';
		$header .= "\r\nMIME-Version: 1.0\r\n";
		//这里开始是邮件的body部分，body部分分成几段发送
		$header .= "\r\n--" . $separator . "\r\n";
		$header .= "Content-Type:text/html; charset=utf-8\r\n";
		$header .= "Content-Transfer-Encoding: base64\r\n\r\n";
		$header .= $this->_body . "\r\n";
		$header .= "--" . $separator . "\r\n";
		//加入附件
		if(!empty($this->_attachment)){
			$count = count($this->_attachment);
			for($i=0; $i<$count; $i++){
				$header .= "\r\n--" . $separator . "\r\n";
				$header .= "Content-Type: " . $this->getMIMEType($this->_attachment[$i]) . '; name="=?UTF-8?B?' . base64_encode( basename($this->_attachment[$i]) ) . '?="' . "\r\n";
				$header .= "Content-Transfer-Encoding: base64\r\n";
				$header .= 'Content-Disposition: attachment; filename="=?UTF-8?B?' . base64_encode( basename($this->_attachment[$i]) ) . '?="' . "\r\n";
				$header .= "\r\n";
				$header .= $this->readFile($this->_attachment[$i]);
				$header .= "\r\n--" . $separator . "\r\n";
			}
		}
		//结束邮件数据发送
		$header .= "\r\n.\r\n";
	
		$command[] = array("DATA\r\n", 354);
		$command[] = array($header, 250);
		$command[] = array("QUIT\r\n", 221);
		return $command;
	}
	/**
	 * 发送命令
	 * @access protected
	 * @param string $command 发送到服务器的smtp命令
	 * @param int $code 期望服务器返回的响应吗
	 * @return boolean
	 */
	protected function sendCommand($command, $code) {
		//echo 'Send command:' . $command . ',expected code:' . $code . '<br />';
		//发送命令给服务器
		try{
			if(socket_write($this->_socket, $command, strlen($command))){
				//当邮件内容分多次发送时，没有$code，服务器没有返回
				if(empty($code))  {
					return true;
				}
				//读取服务器返回
				$data = trim(socket_read($this->_socket, 1024));
				//echo 'response:' . $data . '<br /><br />';
				if($data) {
					$pattern = "/^".$code."+?/";
					if(preg_match($pattern, $data)) {
						return true;
					}
					else{
						$this->_errorMessage = "Error:" . $data . "|**| command:";
						return false;
					}
				}
				else{
					$this->_errorMessage = "Error:" . socket_strerror(socket_last_error());
					return false;
				}
			}
			else{
				$this->_errorMessage = "Error:" . socket_strerror(socket_last_error());
				return false;
			}
		}catch(Exception $e) {
			$this->_errorMessage = "Error:" . $e->getMessage();
		}
	}
	/**
	 * 安全连接发送命令
	 * @access protected
	 * @param string $command 发送到服务器的smtp命令
	 * @param int $code 期望服务器返回的响应吗
	 * @return boolean
	 */
	protected function sendCommandSecurity($command, $code) {
	//	echo 'Send command:' . $command . ',expected code:' . $code . '<br />';
		try {
			if(fwrite($this->_socket, $command)){
				//当邮件内容分多次发送时，没有$code，服务器没有返回
				if(empty($code))  {
					return true;
				}
				//读取服务器返回
				$data = trim(fread($this->_socket, 1024));
			//	echo 'response:' . $data . '<br /><br />';
				if($data) {
					$pattern = "/^".$code."+?/";
					if(preg_match($pattern, $data)) {
						return true;
					}
					else{
						$this->_errorMessage = "Error:" . $data . "|**| command:";
						return false;
					}
				}
				else{
					return false;
				}
			}
			else{
				$this->_errorMessage = "Error: " . $command . " send failed";
				return false;
			}
		}catch(Exception $e) {
			$this->_errorMessage = "Error:" . $e->getMessage();
		}
	}
	/**
	 * 读取附件文件内容，返回base64编码后的文件内容
	 * @access protected
	 * @param string $file 文件
	 * @return mixed
	 */
	protected function readFile($file) {
		if(file_exists($file)) {
			$file_obj = file_get_contents($file);
			return base64_encode($file_obj);
		}
		else {
			$this->_errorMessage = "file " . $file . " dose not exist";
			return false;
		}
	}
	/**
	 * 获取附件MIME类型
	 * @access protected
	 * @param string $file 文件
	 * @return mixed
	 */
	protected function getMIMEType($file) {
		if(file_exists($file)) {
			$mime = mime_content_type($file);
			/*if(! preg_match("/gif|jpg|png|jpeg/", $mime)){
			 $mime = "application/octet-stream";
			}*/
			return $mime;
		}
		else {
			return false;
		}
	}
	/**
	 * 建立到服务器的网络连接
	 * @access protected
	 * @return boolean
	 */
	protected function socket() {
		//创建socket资源
		$this->_socket = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));
		if(!$this->_socket) {
			$this->_errorMessage = socket_strerror(socket_last_error());
			return false;
		}
		socket_set_block($this->_socket);//设置阻塞模式
		//连接服务器
		if(!socket_connect($this->_socket, $this->_sendServer, $this->_port)) {
			$this->_errorMessage = socket_strerror(socket_last_error());
			return false;
		}
		$str = socket_read($this->_socket, 1024);
		if(!preg_match("/220+?/", $str)){
			$this->_errorMessage = $str;
			return false;
		}
		return true;
	}
	/**
	 * 建立到服务器的SSL网络连接
	 * @access protected
	 * @return boolean
	 */
	protected function socketSecurity() {
		$remoteAddr = $this->_sendServer . ":" . $this->_port;
		$this->_socket = stream_socket_client($remoteAddr, $errno, $errstr, 30);
		if(!$this->_socket){
			$this->_errorMessage = $errstr;
			return false;
		}
		//设置加密连接，默认是ssl，如果需要tls连接，可以查看php手册stream_socket_enable_crypto函数的解释
		stream_socket_enable_crypto($this->_socket, true, STREAM_CRYPTO_METHOD_SSLv23_CLIENT);
		stream_set_blocking($this->_socket, 1); //设置阻塞模式
		$str = fread($this->_socket, 1024);
		if(!preg_match("/220+?/", $str)){
			$this->_errorMessage = $str;
			return false;
		}
		return true;
	}
	/**
	 * 关闭socket
	 * @access protected
	 * @return boolean
	 */
	protected function close() {
		if(isset($this->_socket) && is_object($this->_socket)) {
			$this->_socket->close();
			return true;
		}
		$this->_errorMessage = "No resource can to be close";
		return false;
	}
	/**
	 * 关闭安全socket
	 * @access protected
	 * @return boolean
	 */
	protected function closeSecutity() {
		if(isset($this->_socket) && is_object($this->_socket)) {
			stream_socket_shutdown($this->_socket, STREAM_SHUT_WR);
			return true;
		}
		$this->_errorMessage = "No resource can to be close";
		return false;
	}
}
