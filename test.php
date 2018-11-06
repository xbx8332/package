<?php
//定义一个顶级异常处理器
function my_exception($e){
	
	echo "我是顶级异常处理".$e->getMessage();
}
//修改默认的顶级异常处理函数（器）；
set_exception_handler("my_exception");


function  a1($val){
	if ($val>100){
		throw new Exception("val>100");

	}
}
function a2($val){
	if ($val=="hello"){
		throw new Exception("不要输入hello");
	}
}
try {
	a2("hello");
    a1(800);
}catch (Exception $e){
	//获取.
	//echo $e->getMesage（）；
	//可以继续抛出，这是将会启动php默认的异常处理器来处理
	//你也可以自己定义一个顶级异常处理器.
//echo	$e->getFile().'getFile';
//echo	$e->getLine().'getLine';
//echo	$e->getCode().'getCode';
//echo	$e->getPrevious().'getPrevious';
//echo	$e->__toString().'__toString';
var_dump(	$e->getTrace());

	throw $e;
}

try {
	
} catch (Exception $e) {
}
