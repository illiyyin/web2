<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelFile;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data = ModelFile::all();
        return view ('file', compact('data'));
    }
	public function create()
    {
        
    }
	 public function store(Request $request)
    {
		$data = new ModelFile();
		$data->nama = $request->input('name');
		$file = $request->file('file');
		$ext = $file->getClientOriginalExtension();
		$newName = rand(100000,200000).".".$ext;
		$file->move('uploads/file',$newName);
		$data->file = $newName;
		$data->save();
		return redirect()->route('file.index')->with('alert-success','Berhasil Menambahkan Data!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
}
