<?php
class Air_conditioner {
	private $id;
	private $brand;
	private $btus;
	private $description;
	private $location;
	private $id_pmoc;

	function getId(){
		return $this->id;
	}
	function setId($id){
		$this->id=$id;
	}
	function getBrand(){
		return $this->brand;
	}
	function setBrand($brand){
		$this->brand=$brand;
	}
	function getBtus(){
		return $this->btus;
	}
	function setBtus($btus){
		$this->btus=$btus;
	}
	function getDescription(){
		return $this->description;
	}
	function setDescription($description){
		$this->description=$description;
	}
	function getLocation(){
		return $this->location;
	}
	function setLocation($location){
		$this->location=$location;
	}
	function getId_pmoc(){
		return $this->id_pmoc;
	}
	function setId_pmoc($id_pmoc){
		$this->id_pmoc=$id_pmoc;
	}

}
?>