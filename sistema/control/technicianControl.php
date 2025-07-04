<?php
require_once("../model/Technician.php");
require_once("../dao/TechnicianDao.php");
class TechnicianControl {
    private $technician;
    private $acao;
    private $dao;
    public function __construct(){
       $this->technician=new Technician();
      $this->dao=new TechnicianDao();
      $this->acao=$_GET["a"];
      $this->verificaAcao(); 
    }
    function verificaAcao(){}
    function inserir(){}
    function excluir(){}
    function alterar(){}
    function buscarId(Technician $technician){}
    function buscaTodos(){}

}
new TechnicianControl();
?>