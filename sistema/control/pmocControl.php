<?php
require_once("../model/Pmoc.php");
require_once("../dao/PmocDao.php");
class PmocControl {
    private $pmoc;
    private $acao;
    private $dao;
    public function __construct(){
       $this->pmoc=new Pmoc();
      $this->dao=new PmocDao();
      $this->acao=$_GET["a"];
      $this->verificaAcao(); 
    }
    function verificaAcao(){}
    function inserir(){}
    function excluir(){}
    function alterar(){}
    function buscarId(Pmoc $pmoc){}
    function buscaTodos(){}

}
new PmocControl();
?>