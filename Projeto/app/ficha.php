<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ficha extends Model
{
    protected $table = 'ficha';
    
    protected $fillable = ['mes','ano','numero da ordem de venda','quantidade orçada','porto_destino_id','porto_embarque_id','usina_id','Cliente_id'];

    public function getAll()
    {
        $ficha = $this->all();

        return $ficha;
    }

    public function getById($id){
 
      $data =  $this->find($id);

        if(isset($data)){
            $resultado=[$data,'code'=>201];
            return $resultado;
        }else{
            return $resultado=(["navio não encontrada",'code'=>404]);
        }
    }

    public function createFicha ($ficha) {
   
        $resultado=$this->create($ficha);

        if(isset($resultado)){
            return  [ 'ficha' =>$resultado, ['Navio criada com sucesso.'], 'code' => 201];  
        
      }else
           return [['Erro, Navio não pode ser criada.'], 'code' => 500];  
       
    }

    public function updateFicha($ficha, $id) {
   
        $result = $this->find($id);


        if(isset($result)){
        $resultado= $result->update($ficha);
       
        }

        if(isset($resultado)){
            return  [ 'ficha' =>$resultado, ['Navio alterada com sucesso.'], 'code' => 201];  
      }else
           return [['Erro, Navio não pode ser criada.'], 'code' => 500];  
       
    }

    public function destroyFicha($id){
        $ficha = $this->find($id); 

            if(isset($ficha)){
                $ficha->delete();
              return  ['msg' =>'Navio deletada com sucesso.', 'code' => 201];
            }
            ;             
    return  ['msg' =>'Navio não encontrada.', 'code' => 404];             

    }
}
