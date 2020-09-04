<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\navios as navios;

class naviosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    protected $navios;


    public function __construct(navios $navios)
    {
        $this->navios = $navios;
    
    }

    public function indexView()
    {
        return view('category');
    }
    
    public function index()
    {
       $navios =    $this->navios->getAll();
        return  $navios->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $navios = $request->only($this->navios->getFillable());
      $result  = $this->navios->createNavios($navios);

   
      if ($result['code'] == 201) {
        return json_encode($result['navios']);
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
        $result= $this->navios->getById($id);
     
        if($result['code'] == 201){
        return json_encode($result[0]);
      }else{
        return response('navios não encontrada', 404);
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

        $navios = $request->only($this->navios->getFillable());
        $result  = $this->navios->updateNavios($navios,$id);
    
  
        if ($result['code'] == 201) {
         $result = $this->navios->getById($id);
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
      $navios = $this->navios->getById($id);
      
      if(isset($navios)){
       $resultNavios =  $this->navios->destroyNavios($id);
      }
     return response($resultNavios['msg'], $resultNavios['code'] );
    }

}