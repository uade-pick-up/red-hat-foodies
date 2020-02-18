<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

class LanguageController extends Controller
{
   	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.language.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.language.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'local' => 'required',
            'name' => 'required'
        ]);


        
        $input = $request->all();

        $all_def = Language::where('def','=',1)->get();

        if (isset($request->def)) {

            foreach ($all_def as $value) {
                $remove_def =  Language::where('id','=',$value->id)->update(['def' => 0]);
            }

             $input['def'] = 1;

        }else{
            if($all_def->count()<1)
            {
                return back()->with('delete','Atleast one language need to set default !');
            }

            $input['def'] = 0;
        }

        Language::create($input);
        // return back()->with('success', 'Language has been added');

        Session::flash('success','Language has been added');
        return redirect('languages');
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
        $language = Language::findOrFail($id);
        return view('admin.language.edit', compact('language'));
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
        $language = Language::findOrFail($id);

        $all_def = Language::where('def','=',1)->get();

        $request->validate([
            'local' => 'required',
            'name' => 'required'
        ]);

        $input = $request->all();

        if (isset($request->def)) {

            

            foreach ($all_def as $value) {
                $remove_def =  Language::where('id','=',$value->id)->update(['def' => 0]);
            }

             $input['def'] = 1;

        }else{

            if($all_def->count()<1)
            {
                return back()->with('delete','Atleast one language need to set default !');
            }

            $input['def'] = 0;
        }


        $language->update($input);
        return redirect('languages')->with('success', 'Language has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        if($language->def ==1){
             return back()->with('delete', 'Default Language cannot be deleted');
            
        }else{

             $language->delete();
            return back()->with('delete', 'Language has been deleted');
        }
        
        
    }
}
