<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\porto_embarque as porto_embarque;

class porto_embarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    protected $porto_embarque;


    public function __construct(porto_embarque $porto_embarque)
    {
        $this->porto_embarque = $porto_embarque;
    
    }
    public function index()
    {
       $porto_embarque = $this->porto_embarque->getAll();
        return  $porto_embarque->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $porto_embarque = $request->only($this->porto_embarque->getFillable());
      $result  = $this->porto_embarque->createPorto_embarque($porto_embarque);

   
      if ($result['code'] == 201) {
        return json_encode($result['porto_embarque']);
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
        $result= $this->porto_embarque->getById($id);
     
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

        $porto_embarque = $request->only($this->porto_embarque->getFillable());
        $result  = $this->porto_embarque->updatePorto_embarque($porto_embarque,$id);
    
  
        if ($result['code'] == 201) {
         $result = $this->porto_embarque->getById($id);
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
      $porto_embarque = $this->porto_embarque->getById($id);
      
      if(isset($porto_embarque)){
       $resultPorto_embarque =  $this->porto_embarque->destroyPorto_embarque($id);
      }
     return response($resultPorto_embarque['msg'], $resultPorto_embarque['code'] );
    }

}