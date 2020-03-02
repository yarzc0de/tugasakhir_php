<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\APIModel;

class APIController extends Controller
{
    public function create(Request $request) {
    	if(empty($request->nama) OR empty($request->no_hp) OR empty($request->alamat) OR empty($request->hobi) OR empty($request->foto)) {
    		return response()->json(array("success" => false, "message" => "Field cannot be blank"));
    	} else {
    		$add = new APIModel();
    		$add->nama 	 = $request->nama;
    		$add->no_hp  = $request->no_hp;
    		$add->alamat = $request->alamat;
    		$add->hobi   = $request->hobi;
    		$add->foto   = $request->foto;
    		if($add->save()) {
    			return response()->json(array("success" => true, "message" => "User has been added.", "user_pk" => $add->id));
    		} else {
    			return response()->json(array("success" => false, "message" => "Something went wrong."));
    		}
    	}
    }

    public function delete(Request $request) {
    	if(empty($request->id)) {
       		return response()->json(array("success" => false, "message" => "Field cannot be blank")); 		
    	} else {
    		$find = APIModel::find($request->id);
    		if($find) {
    			if($find->delete()) {
    				return response()->json(array("success" => true, "message" => "User has been deleted."));
    			} else {
    				return response()->json(array("success" => false, "message" => "Something went wrong."));
    			}
    		} else {
    			return response()->json(array("success" => false, "message" => "ID not found"));    			
    		}
    	}
    }

    public function edit(Request $request) {
    	if(empty($request->id)) {
        	return response()->json(array("success" => false, "message" => "Field cannot be blank"));   		
    	} else {
    		$find = APIModel::find($request->id);
    		if($find) {
   				if(!empty($request->nama)) {
   					$find->nama = $request->nama;
   				} else if(!empty($request->no_hp)) {
   					$find->no_hp = $request->no_hp;
   				} else if(!empty($request->alamat)) {
   					$find->alamat = $request->alamat;
   				} else if(!empty($request->hobi)) {
   					$find->hobi = @$request->hobi;
   				} else if(!empty($request->foto)) {
   					$find->foto = $request->foto;
   				}
   				if($find->save()) {
     				return response()->json(array("success" => true, "message" => "User has been updated."));  					
   				} else {
    				return response()->json(array("success" => false, "message" => "Something went wrong."));   					
   				}
    		} else {
    			return response()->json(array("success" => false, "message" => "ID not found"));    			
    		}
    	}
    }

    public function detail(Request $request) {
   		if(empty($request->id)) {
   		   	return response()->json(array("success" => false, "message" => "Field cannot be blank"));	   			
   		} else {
   			$read = APIModel::find($request->id);
   			if($read) {
   				return response()->json(array("success" => true, "data" => array("nama" => $read->nama, "no_hp" => $read->no_hp, "alamat" => $read->alamat, "hobi" => $read->hobi, "foto" => $read->foto)));
   			} else {
   	    		return response()->json(array("success" => false, "message" => "ID not found"));  								
   			}
   		}
   	}
}
