<?php
class licaiModel extends baseModel{

	public function __construct(){
		
		parent::__construct( $GLOBALS['db'] );
	}
// 

	public function all_select(){					//AES_ENCRYPT(ifnull(AES_DECRYPT(money_encrypt,'".AES_DECRYPT_KEY."'),0) 
		return  $GLOBALS['db']->getAll("select *,ifnull(AES_DECRYPT(real_name_encrypt,'".AES_DECRYPT_KEY."'),0) as name,AES_DECRYPT(email_encrypt,'".AES_DECRYPT_KEY."') as email,AES_DECRYPT(idno_encrypt,'".AES_DECRYPT_KEY."') as idno,AES_DECRYPT(money_encrypt,'".AES_DECRYPT_KEY."') as money,AES_DECRYPT(mobile_encrypt,'".AES_DECRYPT_KEY."') as mobile from ".DB_PREFIX."user where is_delete = 0");
		
	}
	
	 function adds($data){
		return  $GLOBALS['db']->autoExecute(DB_PREFIX."licai",$data,'INSERT','','SILENT');
	}
}