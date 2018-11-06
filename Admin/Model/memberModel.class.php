<?php
class memberModel extends baseModel{

	public function __construct(){
		
		parent::__construct( $GLOBALS['db'] );
	}
// 

	public function all_select($limit,$where=''){					//AES_ENCRYPT(ifnull(AES_DECRYPT(money_encrypt,'".AES_DECRYPT_KEY."'),0) 
		//pp("select *,ifnull(AES_DECRYPT(real_name_encrypt,'".AES_DECRYPT_KEY."'),0) as name,AES_DECRYPT(idno_encrypt,'".AES_DECRYPT_KEY."') as idno,AES_DECRYPT(money_encrypt,'".AES_DECRYPT_KEY."') as money from ".DB_PREFIX."user where is_delete = 0 limit ".$limit);die;
		return  $GLOBALS['db']->getAll("select *,ifnull(AES_DECRYPT(real_name_encrypt,'".AES_DECRYPT_KEY."'),0) as name,AES_DECRYPT(idno_encrypt,'".AES_DECRYPT_KEY."') as idno,AES_DECRYPT(money_encrypt,'".AES_DECRYPT_KEY."') as money from ".DB_PREFIX."user where is_delete = 0 ".$where." limit ".$limit);
		
	}
	
	public function get_count($where=''){
		return  $GLOBALS['db']->getOne("select count(*) from ".DB_PREFIX."user where is_delete = 0 ".$where);
	}
}