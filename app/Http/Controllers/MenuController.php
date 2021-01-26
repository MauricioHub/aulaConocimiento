<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Menu;


class MenuController extends Controller {
	
	public function __construct()
    {
        $this->middleware('auth'); 
    }
	
	public function index() { 
		$items = Menu::all();
     	return view('menu.index')->with('items', $items);
    }


	public function showSonsById($id){
	 	$data = Menu::where('menu.id_padre','=',$id)
	 				->get();			
 	    return view('menu')->with('menul', $data);
	} 

	// public function showFathers(){
	// 	$menuList = Menu::whereNull('id_padre')
	// 				->get();
 //     	return view('Menu.index')->with('menuList', $menuList);
	// }

	// public function showSonsById($id){
	// 	$data = Menu::where('menu.id_padre','=',$id)
	// 				->get();
 //     	return view('menu.sons')->with('data', $data);
	// }
	
	// public function create(){
	// 	return view::make('menu.create');
	// }

	// public function store(Request $request){
 //        try {
 //        	$menu = new Menu();
 //        	$menu->id_padre 	=$request->id_padre;
 //        	$menu->id_curso		=$request->id_curso;
 //        	$menu->titulo		=$request->titulo;
 //        	$menu->esHoja 		=$request->esHoja;
 //        	$menu->activo 		=$request->activo;
 //        	$menu->save();

 //        	return redirect()->route('menu.index');
 //        }
 //        catch(Exception $e){
 //        	return "Fatal error - ".$e->getMessage();
 //        }
	// }	

	// // public function show($id){
	// // 	$menu = Menu::findOrFail($id);
	// // 	return view('menu.edit', compact('menu'));
	// // }

	// public function edit($id){
	// 	$menu = Menu::findOrFail($id);
	// 	return view('menu.edit', compact('menu'));
	// }

	// public function update(Request $request,$id){
	// 	$menu = Menu::findOrFail($id);
	// 	$menu->id_padre 	=$request->id_padre;
 //    	$menu->id_curso		=$request->id_curso;
 //    	$menu->titulo		=$request->titulo;
 //    	$menu->esHoja 		=$request->esHoja;
 //    	$menu->activo 		=$request->activo;
 //    	$menu->save();
 //    	return redirect()->route('menu.index');
	// }

	// // public function inactive($id){
	// // 	$menu = Menu::findOrFail($id);
	// // 	$menu->activo 		=$request->0;
	// // 	return redirect()->route('menu.index');
	// // }

	// public function destroy($id){
	// 	try{
	// 		$menu = Menu::findOrFail($id);
	// 		$menu->delete();
	// 		return redirect()->route('menu.index');
	// 	}
	// 	catch(Exception $e){
	// 		return "Fatal error - ".$e->getMessage();
	// 	}
	// }

}