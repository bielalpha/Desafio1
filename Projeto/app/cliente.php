<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    protected $table = 'cliente';
    
    protected $fillable = ['nome'];

    public function getAll()
    {
        $clientes = $this->all();

        return $clientes;
    }

    public function getById($id){
 
      $data =  $this->find($id);

        if(isset($data)){
            $resultado=[$data,'code'=>201];
            return $resultado;
        }else{
            return $resultado=(["Cliente não encontrada",'code'=>404]);
        }
    }

    public function createCliente ($cliente) {
   
        $resultado=$this->create($cliente);

        if(isset($resultado)){
            return  [ 'cliente' =>$resultado, ['Cliente criada com sucesso.'], 'code' => 201];  
        
      }else
           return [['Erro, Cliente não pode ser criada.'], 'code' => 500];  
       
    }

    public function updateCliente($cliente, $id) {
   
        $result = $this->find($id);


        if(isset($result)){
        $resultado= $result->update($cliente);
       
        }

        if(isset($resultado)){
            return  [ 'cliente' =>$resultado, ['Cliente alterada com sucesso.'], 'code' => 201];  
      }else
           return [['Erro, Cliente não pode ser criada.'], 'code' => 500];  
       
    }

    public function destroyCliente($id){
        $cliente = $this->find($id); 

            if(isset($cliente)){
                $cliente->delete();
              return  ['msg' =>'Cliente deletada com sucesso.', 'code' => 201];
            }
            ;             
    return  ['msg' =>'Cliente não encontrada.', 'code' => 404];             

    }
}
