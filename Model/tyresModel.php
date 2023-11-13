<?php

require_once('./config.php');
class tyresModel{

  private $db;
  private $view;

    public function __construct()
    {
      $this->getDBConnection();
    }


    private function getDBConnection()
    {
        global $dbconect;
        $host = $dbconect['host'];
        $db = $dbconect['db'];
        $charset = $dbconect['charset'];
        $user = $dbconect['user'];
        $pass = $dbconect['password'];

        $dbString = "mysql:host=$host;dbname=$db;charset=$charset";

        try {
            $this->db = new PDO($dbString, $user, $pass);
        } catch(PDOException $e) {
          $this->view->errorDBConect();
          die;
    }
}


  /**
   *? Obtiene la lista de productos de la DB
   */
  function getListProducts($params = null){
    $db = $this->db;
    $sql= "SELECT * FROM productos p INNER JOIN categorias c ON p.id_categoria = c.id";
    if(isset($params[0])){
      $sql .=' ORDER BY p.'. $params[0];
			if(isset($params[1])){
        $sql .=' '.$params[1];
			}
    }
    if(isset($params[2])){
      $sql .=' LIMIT '. $params[2];
			if(isset($params[3])){
        $sql .=' OFFSET '.$params[3];
			}
    }
    $query = $db->prepare($sql);
    $query->execute();
    $products = $query->fetchAll(PDO::FETCH_OBJ);
    return $products;
  }
  /**
   *? Filtra la lista de productos por categoria
   */
  function filterBy($filter){
    $db = $this->db;
    $query = $db->prepare('SELECT * FROM productos p INNER JOIN categorias c WHERE c.categoria = ? AND (p.id_categoria = c.id)');
    $query->execute([$filter]);
    $products = $query->fetchAll(PDO::FETCH_OBJ);
    return $products;
  }


  function get($id){
    $db = $this->db;
    $query = $db->prepare('SELECT * FROM productos WHERE id_producto = ?');
    $query->execute([$id]);
    $product = $query->fetchAll(PDO::FETCH_OBJ);
    return $product;
  }


  //? De aqui en adelante se trabaja con la tabla comentarios

  function getComments(){
    $db = $this->db;
    $query = $db->prepare('SELECT * FROM comentarios c INNER JOIN productos p ON c.id_producto = p.id_producto');
    $query->execute();
    $comments = $query->fetchAll(PDO::FETCH_OBJ);
    return $comments;
  }
  function getComment($id){
    $db = $this->db;
    $query = $db->prepare('SELECT * FROM comentarios WHERE id = ?');
    $query->execute([$id]);
    $comment = $query->fetch(PDO::FETCH_OBJ);
    return $comment;
  }
  function getCommentsByProduct($id){
    $db = $this->db;
    $query = $db->prepare('SELECT * FROM comentarios c INNER JOIN productos p ON c.id_producto = p.id_producto WHERE c.id_producto = ?');
    $query->execute([$id]);
    $comments = $query->fetchAll(PDO::FETCH_OBJ);
    return $comments;
  }

  function insertComment($id_producto, $autor, $titulo, $comentario, $valoracion)
    {
      $db = $this->db;
      $sql =  "INSERT INTO comentarios (id_producto,autor,titulo,comentario,valoracion) VALUES (?,?,?,?,?)";
      $query = $db->prepare($sql);
      $query->execute([$id_producto, $autor, $titulo, $comentario, $valoracion]);
      return $query;
    }

  function deleteComment($id){
    $db = $this->db;
    $sql = "DELETE FROM comentarios WHERE id = ?";
    $query = $db->prepare($sql);
    $query->execute([$id]);
    // return $query->rowCount();
  }
  function updateComment($id_producto, $autor, $titulo, $comentario, $valoracion,$fecha,$id){
    $db = $this->db;
    $sql = "UPDATE comentarios SET id_producto=?, autor=?, titulo=?, comentario=?, valoracion=?,fecha=? WHERE id=?";
    $query = $db->prepare($sql);
    $query->execute([$id_producto, $autor, $titulo, $comentario, $valoracion,$fecha,$id]);
    $comment = $query->fetch(PDO::FETCH_OBJ);
    return $comment;
  }

  // function paginacion(){

  // }


  //crear function paginacion y buscar

}