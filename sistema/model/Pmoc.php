<?php
class Pmoc {
	private $id;
	private $name;
	private $creation_date;
	private $service_address;
	private $id_technician;
	private $id_client;

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
	function getCreation_date(){
		return $this->creation_date;
	}
	function setCreation_date($creation_date){
		$this->creation_date=$creation_date;
	}
	function getService_address(){
		return $this->service_address;
	}
	function setService_address($service_address){
		$this->service_address=$service_address;
	}
	function getId_technician(){
		return $this->id_technician;
	}
	function setId_technician($id_technician){
		$this->id_technician=$id_technician;
	}
	function getId_client(){
		return $this->id_client;
	}
	function setId_client($id_client){
		$this->id_client=$id_client;
	}

}
?>