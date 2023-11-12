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

    public function getAllComments($params = null){
        

    }
    public function sendComment($params = null){
        $comment = $this-> getData();
        if(empty($comment->titulo) || empty($comment->comentario) || empty($comment->prioridad)){
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

}
?>