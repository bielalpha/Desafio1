<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';
    
    protected $fillable = ['id','description'];

    public function Produto()
    {
        return $this->HasMany('App\Produto', 'address_id');
    }

    public function getAll()
    {
        $categorias = $this->all();

        return $categorias;
    }

    public function getById($id){
 
      $data =  $this->find($id);

        if(isset($data)){
            $resultado=[$data,'code'=>201];
            return $resultado;
        }else{
            return $resultado=(["Categoria não encontrada",'code'=>404]);
        }
    }

    public function createCategoria ($categoria) {
   
        $resultado=$this->create($categoria);

        if(isset($resultado)){
            return  [ 'categoria' =>$resultado, ['Categoria criada com sucesso.'], 'code' => 201];  
        
      }else
           return [['Erro, Categoria não pode ser criada.'], 'code' => 500];  
       
    }

    public function updateCategoria($categoria, $id) {
   
        $result = $this->find($id);


        if(isset($result)){
        $resultado= $result->update($categoria);
       
        }

        if(isset($resultado)){
            return  [ 'categoria' =>$resultado, ['Categoria alterada com sucesso.'], 'code' => 201];  
      }else
           return [['Erro, Categoria não pode ser criada.'], 'code' => 500];  
       
    }

    public function destroyCategoria($id){
        $categoria = $this->find($id); 

            if(isset($categoria)){
                $categoria->delete();
              return  ['msg' =>'Categoria deletada com sucesso.', 'code' => 201];
            }
            ;             
    return  ['msg' =>'Categoria não encontrada.', 'code' => 404];             

    }
}
