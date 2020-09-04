<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class navios extends Model
{
    protected $table = 'navios';
    
    protected $fillable = ['nome','IMO'];

    public function getAll()
    {
        $navios = $this->all();

        return $navios;
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

    public function createNavios ($navios) {
   
        $resultado=$this->create($navios);

        if(isset($resultado)){
            return  [ 'navios' =>$resultado, ['Navio criada com sucesso.'], 'code' => 201];  
        
      }else
           return [['Erro, Navio não pode ser criada.'], 'code' => 500];  
       
    }

    public function updateNavios($navios, $id) {
   
        $result = $this->find($id);


        if(isset($result)){
        $resultado= $result->update($navios);
       
        }

        if(isset($resultado)){
            return  [ 'navios' =>$resultado, ['Navio alterada com sucesso.'], 'code' => 201];  
      }else
           return [['Erro, Navio não pode ser criada.'], 'code' => 500];  
       
    }

    public function destroyNavios($id){
        $navios = $this->find($id); 

            if(isset($navios)){
                $navios->delete();
              return  ['msg' =>'Navio deletada com sucesso.', 'code' => 201];
            }
            ;             
    return  ['msg' =>'Navio não encontrada.', 'code' => 404];             

    }
}
