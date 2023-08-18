<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;
use Cake\Controller\Component\FlashComponent;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Datasource\ConnectionManager;


class ControlController extends AppController{

	public function index(){

    $conection = ConnectionManager::get('default');

    $Documento = $conection->execute("SELECT textopdf.id AS TEXTOID,
                 textopdf.texto AS TEXTO, tipos.tipo AS TIPO FROM tipos 
                 INNER JOIN textopdf on textopdf.id_tipo = tipos.id");

    $this->set(compact('Documento'));
    $this->set('_serialize',['Documento']);
  }

  public function add(){

      $conection = ConnectionManager::get('default');

      $Tipo = $conection->execute("SELECT * FROM tipos");

      if ($this->request->is('post')) {
   
                $sql = "INSERT INTO textopdf
                        (texto,id_tipo)
                        VALUES 
                        ('{$this->request['data']['textopdf']}','{$this->request['data']['tipos']}')";
                $conection->execute($sql);
           
                
            $this->Flash->success(__('Documento adicionado com sucesso !'));
            return $this->redirect(['action' => 'index']);
      }

      $this->set(compact('Tipo'));
      $this->set('_serialize',['Tipo']);
  }

  public function gerarpdf($id){

    $conection = ConnectionManager::get('default');

    $PDF = $conection->execute("SELECT textopdf.id AS TEXTOID,
           textopdf.texto AS TEXTO, tipos.tipo AS TIPO FROM tipos 
           INNER JOIN textopdf on textopdf.id_tipo = tipos.id");

    $this->set(compact('id','PDF'));
    $this->set('_serialize',['id','PDF']);
    $this->viewBuilder()->layout('ajax');
    $this->response->type('pdf');
  }

  ///////////////////////////////
  /////// AREA DE TIPOS /////////
  ///////////////////////////////
  public function indextipos(){

    $conection = ConnectionManager::get('default');

    $Tipos = $conection->execute("SELECT * FROM tipos");

    $this->set(compact('Tipos'));
    $this->set('_serialize',['Tipos']);
  }

  public function addtipos(){

      $connection = ConnectionManager::get('default');

      if ($this->request->is('post')) {
   
          $sql = "INSERT INTO tipos(tipo)
                  VALUES ('{$this->request['data']['tipos']}')";
          $connection->execute($sql);
                
          $this->Flash->success(__('Tipo adicionado com sucesso !'));
          return $this->redirect(['action' => 'indextipos']);
      }
  } 

}
?>