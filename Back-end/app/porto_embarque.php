<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class porto_embarque extends Model
{
    protected $table = 'portoembarque';
    
    protected $fillable = ['nome','pais'];

    public function getAll()
    {
        $porto_embarque = $this->all();

        return $porto_embarque;
    }

    public function getById($id){
 
      $data =  $this->find($id);

        if(isset($data)){
            $resultado=[$data,'code'=>201];
            return $resultado;
        }else{
            return $resultado=(["Porto de embarque não encontrada",'code'=>404]);
        }
    }

    public function createPorto_embarque ($Porto_embarque) {
   
        $resultado=$this->create($Porto_embarque);

        if(isset($resultado)){
            return  [ 'porto_embarque' =>$resultado, ['Porto de embarque criada com sucesso.'], 'code' => 201];  
        
      }else
           return [['Erro, Porto de embarque não pode ser criada.'], 'code' => 500];  
       
    }

    public function updatePorto_embarque($porto_embarque, $id) {
   
        $result = $this->find($id);


        if(isset($result)){
        $resultado= $result->update($porto_embarque);
       
        }

        if(isset($resultado)){
            return  [ 'porto_embarque' =>$resultado, ['Porto de embarque alterada com sucesso.'], 'code' => 201];  
      }else
           return [['Erro, Porto de embarque não pode ser criada.'], 'code' => 500];  
       
    }

    public function destroyPorto_embarque($id){
        $porto_embarque = $this->find($id); 

            if(isset($porto_embarque)){
                $porto_embarque->delete();
              return  ['msg' =>'Porto de embarque deletada com sucesso.', 'code' => 201];
            }
            ;             
    return  ['msg' =>'Porto de embarque não encontrada.', 'code' => 404];             

    }
}
