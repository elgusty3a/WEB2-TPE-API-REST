<?php
require_once './Model/tyresModel.php';
require_once './api/view/APIView.php';

class tyresApiController{
    private $model;
    private $view;
    private $data;

    public function __construct(){
        $this->model = new tyresModel();
        $this->view = new APIView();

        //lee el body del request
        $this->data = file_get_contents("php://input");
    }
    private function getData(){
        return json_decode($this->data);
    }

    public function getAllProducts($params = null){
        $products = $this->model->getListProducts();
        return $this->view->response($products, 200);
    }
    public function getProduct($params = null){
        $id = $params[':ID'];
        $product = $this->model->get($id);
        if($product){
            // $this->model->get($id);
            $this->view->response($product, 200);
        }else 
            $this->view->response("El producto con el id=$id no existe", 404);
   }
     public function pagination($params = null){
         $paginacion = $this->model->paginacion();
         return $this->view->response($paginacion, 200);
     }
     
    //  public function getSearch($params = null){
    //      $id = $params[':ID'];
    //      $search = $this->model->get($id);
    //      if($search){
    //          $this->model->buscar($id);
    //          $this->view->response($search, 200);
    //      }else 
    //          $this->view->response("La busqueda con el id=$id no existe", 400);
    // }


     //? De aqui en adelante se trabaja con la tabla comentarios

    public function getAllComments($params = null){
        $comments = $this->model->getComments();
        return $this->view->response($comments, 200);
    }
    public function getComment($params = null){
        $id = $params[':ID'];
        $comment = $this->model->getComment($id);
        if($comment){
            // $this->model->get($id);
            $this->view->response($comment, 200);
        }else 
            $this->view->response("El comment con el id=$id no existe", 404);
   }
    public function getAllCommentsByProduct($params = null){
        $id = $params[':ID'];
        $product = $this->model->getCommentsByProduct($id);
        if($product){
            // $this->model->get($id);
            $this->view->response($product, 200);
        }else 
            $this->view->response("El producto con el id=$id no existe o no tiene comentarios", 404);
   }
    public function sendComment($params = null){
        $comment = $this->getData();
        $id = ($comment[0]->id_producto);
        // var_dump($id);die;
        // $id = $comment->id_producto;
        $existProduct = $this->model->get($id);
        if($existProduct){
            $sendOk = $this->model->insertComment($comment[0]->id_producto, $comment[0]->autor, $comment[0]->titulo, $comment[0]->comentario, $comment[0]->valoracion);
            if ($sendOk) {
                $this->view->response("Se insertó correctamente", 200);
            } else {
                $this->view->response("Hubo un error", 500);
            }
        }else{
            $this->view->response("Hubo un error, el producto no existe", 500);
        }
        // if(empty($comment->titulo) || empty($comment->comentario) || empty($comment->id_producto)){
        //     $this->view->response("Complete los datos", 400);
        // }else{
        //     $id = $this->model->insertComment($comment->marca, $comment->medida, $comment->inidice_carga, $comment->indice_velocidad, $comment->precio, $comment->id_categoria);
        //     $comment = $this->model->get($id);
        //     $this->view->response($comment,  200);
        // }
   }
//    public function deleteComment($params = null){
//        $id = $params[':ID'];
//        $comment = $this->model->get($id);
//        if($comment){
//            $this->model->eraseItem($id);
//            $this->view->response($comment, 200);
//        }else 
//            $this->view->response("El comentario con el id=$id no existe", 404);
//    }

function deleteComment($params)
    {   
        if (!isset($params[':ID'])) {
            $this->view->response("No existe el comentario", 404);
            die();
        }
        $id = $params[':ID'];
        $comment = $this->model->getComment($id);
        if ($comment) {
            $this->model->deleteComment($comment[0]->id);
            $this->view->response("El comentario se elimino con exito", 200);
        } else {
            $this->view->response("No existe el comentario", 404);
        }
    }




}