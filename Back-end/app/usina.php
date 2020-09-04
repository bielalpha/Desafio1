<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usina extends Model
{
    protected $table = 'usina';
    
    protected $fillable = ['nome'];

    public function getAll()
    {
        $usina = $this->all();

        return $usina;
    }

    public function getById($id){
 
      $data =  $this->find($id);

        if(isset($data)){
            $resultado=[$data,'code'=>201];
            return $resultado;
        }else{
            return $resultado=(["Usina não encontrada",'code'=>404]);
        }
    }

    public function createUsina ($usina) {
   
        $resultado=$this->create($usina);

        if(isset($resultado)){
            return  [ 'usina' =>$resultado, ['Usina criada com sucesso.'], 'code' => 201];  
        
      }else
           return [['Erro, Usina não pode ser criada.'], 'code' => 500];  
       
    }

    public function updateUsina($usina, $id) {
   
        $result = $this->find($id);


        if(isset($result)){
        $resultado= $result->update($usina);
       
        }

        if(isset($resultado)){
            return  [ 'usina' =>$resultado, ['Usina alterada com sucesso.'], 'code' => 201];  
      }else
           return [['Erro, Usina não pode ser criada.'], 'code' => 500];  
       
    }

    public function destroyUsina($id){
        $usina = $this->find($id); 

            if(isset($usina)){
                $usina->delete();
              return  ['msg' =>'Usina deletada com sucesso.', 'code' => 201];
            }
            ;             
    return  ['msg' =>'Usina não encontrada.', 'code' => 404];             

    }
}
