<?php
class publicModel extends baseModel{
	
	public function __construct(){
		parent::__construct( $GLOBALS['db'] );
	}
	
}