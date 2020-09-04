<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\usina as usina;

class usinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    protected $usina;


    public function __construct(usina $usina)
    {
        $this->usina = $usina;
    
    }
    public function index()
    {
       $usina = $this->usina->getAll();
        return  $usina->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $usina = $request->only($this->usina->getFillable());
      $result  = $this->usina->createUsina($usina);

   
      if ($result['code'] == 201) {
        return json_encode($result['usina']);
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
        $result= $this->usina->getById($id);
     
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

        $usina = $request->only($this->usina->getFillable());
        $result  = $this->usina->updateUsina($usina,$id);
    
  
        if ($result['code'] == 201) {
         $result = $this->usina->getById($id);
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
      $usina = $this->usina->getById($id);
      
      if(isset($usina)){
       $resultUsina =  $this->usina->destroyUsina($id);
      }
     return response($resultUsina['msg'], $resultUsina['code'] );
    }

}