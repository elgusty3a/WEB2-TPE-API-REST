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
            $this->model->get($id);
            $this->view->response($product, 200);
        }else 
            $this->view->response("El producto con el id=$id no existe", 404);
   }
     public function pagination($params = null){
         $paginacion = $this->model->paginacion();
         return $this->view->response($paginacion, 200);
     }
     public function getAllComments($params = null){
        

     }
     public function sendComment($params = null){
         $comment = $this-> getData();
         if(empty($comment->titulo) || empty($comment->descripcion) || empty($comment->prioridad)){
             $this->view->response("Complete los datos", 400);
         }else{
             $id = $this->model->insert($comment->marca, $comment->medida, $comment->inidice_carga, $comment->indice_velocidad, $comment->precio, $comment->id_categoria);
             $comment = $this->model->get($id);
             $this->view->response($comment,  200);
         }
    }
    public function deleteComment($params = null){
        $id = $params[':ID'];
        $comment = $this->model->get($id);
        if($comment){
            $this->model->eraseItem($id);
            $this->view->response($comment, 200);
        }else 
            $this->view->response("El comentario con el id=$id no existe", 404);
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
}