<?php
class loginModel extends baseModel{

	public function __construct(){
		
		parent::__construct( $GLOBALS['db'] );
	}
// 	function find(){
// 		$GLOBALS['db']->getRow();
// 		return ($this->map['where']['id']+$this->map['where']['com']);
// 	}
	
// 	function where($map){
		
// 		$this->map['where']=$map;
// 		return $this;
// 	}
}