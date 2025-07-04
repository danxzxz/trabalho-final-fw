<?php
class Livros {
	private $id;
	private $nome;
	private $autor;
	private $ano;
	private $genero;
	private $classificacao;
	private $sinopse;
	private $link;
	private $data_cadastro;

	function getId(){
		return $this->id;
	}
	function setId($id){
		$this->id=$id;
	}
	function getNome(){
		return $this->nome;
	}
	function setNome($nome){
		$this->nome=$nome;
	}
	function getAutor(){
		return $this->autor;
	}
	function setAutor($autor){
		$this->autor=$autor;
	}
	function getAno(){
		return $this->ano;
	}
	function setAno($ano){
		$this->ano=$ano;
	}
	function getGenero(){
		return $this->genero;
	}
	function setGenero($genero){
		$this->genero=$genero;
	}
	function getClassificacao(){
		return $this->classificacao;
	}
	function setClassificacao($classificacao){
		$this->classificacao=$classificacao;
	}
	function getSinopse(){
		return $this->sinopse;
	}
	function setSinopse($sinopse){
		$this->sinopse=$sinopse;
	}
	function getLink(){
		return $this->link;
	}
	function setLink($link){
		$this->link=$link;
	}
	function getData_cadastro(){
		return $this->data_cadastro;
	}
	function setData_cadastro($data_cadastro){
		$this->data_cadastro=$data_cadastro;
	}

}
?>