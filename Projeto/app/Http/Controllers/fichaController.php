<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\ficha as ficha;

class fichaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    protected $ficha;


    public function __construct(ficha $ficha)
    {
        $this->ficha = $ficha;
    
    }

    public function indexView()
    {
        return view('category');
    }
    
    public function index()
    {
       $ficha =    $this->ficha->getAll();
        return  $ficha->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $ficha = $request->only($this->ficha->getFillable());
      $result  = $this->ficha->createFicha($ficha);

   
      if ($result['code'] == 201) {
        return json_encode($result['ficha']);
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
        $result= $this->ficha->getById($id);
     
        if($result['code'] == 201){
        return json_encode($result[0]);
      }else{
        return response('ficha não encontrada', 404);
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

        $ficha = $request->only($this->ficha->getFillable());
        $result  = $this->ficha->updateFicha($ficha,$id);
    
  
        if ($result['code'] == 201) {
         $result = $this->ficha->getById($id);
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
      $ficha = $this->ficha->getById($id);
      
      if(isset($ficha)){
       $resultFicha =  $this->ficha->destroyFicha($id);
      }
     return response($resultFicha['msg'], $resultFicha['code'] );
    }

}