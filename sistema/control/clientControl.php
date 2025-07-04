<?php
require_once("../model/Client.php");
require_once("../dao/ClientDao.php");
class ClientControl {
    private $client;
    private $acao;
    private $dao;
    public function __construct(){
       $this->client=new Client();
      $this->dao=new ClientDao();
      $this->acao=$_GET["a"];
      $this->verificaAcao(); 
    }
    function verificaAcao(){}
    function inserir(){}
    function excluir(){}
    function alterar(){}
    function buscarId(Client $client){}
    function buscaTodos(){}

}
new ClientControl();
?>