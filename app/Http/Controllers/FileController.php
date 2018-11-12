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
	
	public function edit($id)
    {
        $data = ModelFile::where('id',$id)->first();
		return view('fileedit',compact('data'));
    }
	
	public function update(Request $request, $id)
    {
        $data = ModelFile::findOrFail($id);
		$data->nama = $request->name;
		if(empty($request->file('file'))){
			$data->file=$data->file;
		}
		else{
			unlink('uploads/file/'.$data->file);
			$uploadedFile = $request->file('file');
			$nama = date('Ydhmis').".".$uploadedFile->getClientOriginalExtension();
			$uploadedFile->move('uploads/file',$nama);
			$data->file = $nama;
		}
		$data->save();
		return redirect()->route('file.index')->with('alert-success','Berhasil Menambahkan Data!');
    }
	public function show($id)
    {
        //
    }
	
	public function destroy($id)
    {
        $data = ModelFile::findOrFail($id);
        if($data->delete()){
			unlink('uploads/file/'.$data->file);
		}
		return redirect()->route('file.index')->with('alert-success','Data berhasi dihapus!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
}
