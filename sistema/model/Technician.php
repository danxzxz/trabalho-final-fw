<?php
class Technician {
	private $id;
	private $cpf_cnpj;
	private $name;
	private $address;
	private $phone;
	private $crea;
	private $email;
	private $password;

	function getId(){
		return $this->id;
	}
	function setId($id){
		$this->id=$id;
	}
	function getCpf_cnpj(){
		return $this->cpf_cnpj;
	}
	function setCpf_cnpj($cpf_cnpj){
		$this->cpf_cnpj=$cpf_cnpj;
	}
	function getName(){
		return $this->name;
	}
	function setName($name){
		$this->name=$name;
	}
	function getAddress(){
		return $this->address;
	}
	function setAddress($address){
		$this->address=$address;
	}
	function getPhone(){
		return $this->phone;
	}
	function setPhone($phone){
		$this->phone=$phone;
	}
	function getCrea(){
		return $this->crea;
	}
	function setCrea($crea){
		$this->crea=$crea;
	}
	function getEmail(){
		return $this->email;
	}
	function setEmail($email){
		$this->email=$email;
	}
	function getPassword(){
		return $this->password;
	}
	function setPassword($password){
		$this->password=$password;
	}

}
?>