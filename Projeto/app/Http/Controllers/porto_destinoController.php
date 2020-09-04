<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\porto_destino as porto_destino;

class porto_destinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    protected $porto_destino;


    public function __construct(porto_destino $porto_destino)
    {
        $this->porto_destino = $porto_destino;
    
    }
    public function index()
    {
       $porto_destino = $this->porto_destino->getAll();
        return  $porto_destino->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $porto_destino = $request->only($this->porto_destino->getFillable());
      $result  = $this->porto_destino->createPorto_destino($porto_destino);

   
      if ($result['code'] == 201) {
        return json_encode($result['porto_destino']);
    }
       return json_encode($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $result= $this->porto_destino->getById($id);
     
        if($result['code'] == 201){
        return json_encode($result[0]);
      }else{
        return response('Porto de destino não encontrada', 404);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $porto_destino = $request->only($this->porto_destino->getFillable());
        $result  = $this->porto_destino->updatePorto_destino($porto_destino,$id);
    
  
        if ($result['code'] == 201) {
         $result = $this->porto_destino->getById($id);
         return json_encode($result[0]);
      
      }
         return json_encode($result);

     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $porto_destino = $this->porto_destino->getById($id);
      
      if(isset($porto_destino)){
       $resultPorto_destino =  $this->porto_destino->destroyPorto_destino($id);
      }
     return response($resultPorto_destino['msg'], $resultPorto_destino['code'] );
    }

}