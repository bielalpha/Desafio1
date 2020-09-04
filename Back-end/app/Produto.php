<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    
    protected $fillable = ['id', 'description', 'unity','price', 'reference','categoria_id'];

    public function categoria()
    {
        return $this->belongsTo('App\Categoria', 'categoria_id');
    }
    

    public function getAll()
    {
        $produtos = $this->with('categoria')->get();
        return $produtos;
    }

    public function getById($id){
 
      $data =  $this->find($id);

      if(isset($data)){
        $data=$this->find($id)->load('categoria');
      }
        if(isset($data)){
            $resultado=['produto' =>$data,'code'=>201];
            return $resultado;
        }else{
            return $resultado=(["Produto nao encontrada",'code'=>404]);
        }
    }

    public function createProduto ($produto) {
           
        $resultado=$this->create($produto);

        if(isset($resultado)){
            return  [ 'produto' =>$resultado, ['Produto criado com sucesso.'], 'code' => 201];  
        
      }else
           return [['Erro, Produto não pode ser criada.'], 'code' => 500];  
       
    }

    public function updateProduto($produto, $id) {
   
        $result = $this->find($id);

        if(isset($result)){
        $resultado= $result->update($produto);
        }

        if(isset($resultado)){
            return  [ 'produto' =>$resultado, ['Produto alterada com sucesso.'], 'code' => 201];  
      }else
           return [['Erro, Produto não pode ser criada.'], 'code' => 500];  
       
    }

    public function destroyProduto($id){
        $produto = $this->find($id); 

            if(isset($produto)){
                $produto->categoria()->dissociate();
                $produto->save();  
                $produto->delete();
              return  ['msg' =>'Produto deletado com sucesso.', 'code' => 201];
            }
            ;             
    return  ['msg' =>'Produto não encontrada.', 'code' => 404];             

    }
}
