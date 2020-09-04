<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class porto_destino extends Model
{
    protected $table = 'portodestino';
    
    protected $fillable = ['nome','pais'];

    public function getAll()
    {
        $porto_destino = $this->all();

        return $porto_destino;
    }

    public function getById($id){
 
      $data =  $this->find($id);

        if(isset($data)){
            $resultado=[$data,'code'=>201];
            return $resultado;
        }else{
            return $resultado=(["Porto de destino não encontrada",'code'=>404]);
        }
    }

    public function createPorto_destino ($Porto_destino) {
   
        $resultado=$this->create($Porto_destino);

        if(isset($resultado)){
            return  [ 'porto_destino' =>$resultado, ['Porto de destino criada com sucesso.'], 'code' => 201];  
        
      }else
           return [['Erro, Porto de destino não pode ser criada.'], 'code' => 500];  
       
    }

    public function updatePorto_destino($porto_destino, $id) {
   
        $result = $this->find($id);


        if(isset($result)){
        $resultado= $result->update($porto_destino);
       
        }

        if(isset($resultado)){
            return  [ 'porto_destino' =>$resultado, ['Porto de destino alterada com sucesso.'], 'code' => 201];  
      }else
           return [['Erro, Porto de destino não pode ser criada.'], 'code' => 500];  
       
    }

    public function destroyPorto_destino($id){
        $porto_destino = $this->find($id); 

            if(isset($porto_destino)){
                $porto_destino->delete();
              return  ['msg' =>'Porto de destino deletada com sucesso.', 'code' => 201];
            }
            ;             
    return  ['msg' =>'Porto de destino não encontrada.', 'code' => 404];             

    }
}
