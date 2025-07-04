<?php
class Client {
	private $id;
	private $name;
	private $phone;

	function getId(){
		return $this->id;
	}
	function setId($id){
		$this->id=$id;
	}
	function getName(){
		return $this->name;
	}
	function setName($name){
		$this->name=$name;
	}
	function getPhone(){
		return $this->phone;
	}
	function setPhone($phone){
		$this->phone=$phone;
	}

}
?>