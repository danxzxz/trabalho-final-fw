<?php
require_once("../model/Air_conditioner.php");
require_once("../dao/Air_conditionerDao.php");
class Air_conditionerControl {
    private $air_conditioner;
    private $acao;
    private $dao;
    public function __construct(){
       $this->air_conditioner=new Air_conditioner();
      $this->dao=new Air_conditionerDao();
      $this->acao=$_GET["a"];
      $this->verificaAcao(); 
    }
    function verificaAcao(){}
    function inserir(){}
    function excluir(){}
    function alterar(){}
    function buscarId(Air_conditioner $air_conditioner){}
    function buscaTodos(){}

}
new Air_conditionerControl();
?>