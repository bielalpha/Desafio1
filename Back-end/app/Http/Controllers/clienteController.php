<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\cliente as cliente;

class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    protected $cliente;


    public function __construct(cliente $cliente)
    {
        $this->cliente = $cliente;
    
    }

    public function indexView()
    {
        return view('category');
    }
    
    public function index()
    {
       $cliente =    $this->cliente->getAll();
        return  $cliente->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $cliente = $request->only($this->cliente->getFillable());
      $result  = $this->cliente->createCliente($cliente);

   
      if ($result['code'] == 201) {
        return json_encode($result['cliente']);
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
        $result= $this->cliente->getById($id);
     
        if($result['code'] == 201){
        return json_encode($result[0]);
      }else{
        return response('cliente não encontrada', 404);
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

        $cliente = $request->only($this->cliente->getFillable());
        $result  = $this->cliente->updateCliente($cliente,$id);
    
  
        if ($result['code'] == 201) {
         $result = $this->cliente->getById($id);
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
      $cliente = $this->cliente->getById($id);
      
      if(isset($cliente)){
       $resultCliente =  $this->cliente->destroyCliente($id);
      }
     return response($resultCliente['msg'], $resultCliente['code'] );
    }

}