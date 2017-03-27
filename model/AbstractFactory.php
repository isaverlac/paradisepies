<?php

/*
 * Material utilizado para as aulas práticas da disciplinas da Faculdade de
 * Computação da Universidade Federal de Mato Grosso do Sul (FACOM / UFMS).
 * Seu uso é permitido para fins apenas acadêmicos, todavia mantendo a
 * referência de autoria.
 *
 *
 * Classe abstrata que define o padrão para todas as fábricas.
 *
 * @author Jane Eleutério
 * @author Rodrigo Lopes - Acadêmico CC (Otimização do método queryRowsToListOfObjects)
 * @version 2.1 - 19/Dez/2016
 */
abstract class AbstractFactory {

    protected $db;

public function __construct() {
    $servername = "localhost";
    $username = "root";

    try {
            $this->db = new PDO("mysql:host=$servername;dbname=paradisepies", $username);
            // set the PDO error mode to exception
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if($this->db == null)
            {
                throw new Exception('Erro');
            }
        }
    catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * Persiste um objeto no banco. Executa um SQL "Insert into..."
     * @param Object $obj - Objeto a ser persistido.
     * @return boolean - se conseguiu salvar ou não.
     */
    abstract public function salvar($obj);

    /**
     * Lista os objetos persistidos no banco, ou seja, executa um
     * SQL "Select - From"
     * @return array -  Array de objetos da classe.
     */
    #abstract public function listar();

    /**
     * Busca objetos no banco de dados que atendem a um parâmetro.
     * Executa um SQL "Select - From - Where"
     * @param string $param - parâmetro a ser buscado.
     * @return  array -  Array de objetos da classe, ou null se não encontrar
     * objetos.
     */
    abstract public function buscar($param);

    /**
     * Faz o mapeamento Objeto-Relacional, transformando um resultado de
     * consulta (PDOStatement) em uma lista de Objetos recuperados.
     * @param PDOStatement $result - o resultado da consulta
     * @param String $nameObject - nome da Classe de objetos
     * @return  $list lista de objetos da classe $nameObject
     */
    protected function queryRowsToListOfObjects
            (PDOStatement $result, $nameObject) {
        $list = array();
        $result = $result->fetchAll(PDO::FETCH_NUM);
        foreach ($result as $row) {
            //unset($row[0]);
            $ref = new ReflectionClass($nameObject);
            $list[] = $ref->newInstanceArgs($row);
        }
        var_dump($ref);
        return $list;
    }

    protected function queryListToRow
            (PDOStatement $result)
    {
        $list = array();
        $result = $result->fetchAll(PDO::FETCH_NUM);
        foreach ($result as $row) {
            array_push($list, $row);
        }
        return $list;

    }

}

?>
