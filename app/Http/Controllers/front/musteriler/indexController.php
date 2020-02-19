<?php

namespace App\Http\Controllers\front\musteriler;

use App\Helper\fileUpload;
use App\Http\Controllers\Controller;
use App\Musteriler;
use foo\bar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{
    public function index(){
        return view('front.musteriler.index');
    }

    public function create(){
        return view('front.musteriler.create');
    }

    public function store(Request $request){
        $all = $request->except('_token');
        $all['photo'] = fileUpload::newUpload(rand(1,90000), 'musteriler', $request->file('photo'),0);

        $create = Musteriler::create($all);
        if ($create){
            return redirect()->back()->with('status', 'Müşteri başarıyla eklendi.');
        }else{
            return redirect()->back()->with('status', 'Müşteri eklenemedi');
        }
    }

    public function edit($id){
        $c = Musteriler::where('id',$id)->count();
        if ($c !=0){
            $data = Musteriler::where('id',$id)->get();
            return view('front.musteriler.edit', ['data'=>$data]);
        }else{
            return redirect('/');
        }
    }

    public function update(Request $request){
        $id = $request->route('id');
        $c = Musteriler::where('id',$id)->count();
        if ($c !=0){
            $all = $request->except('_token');
            $data = Musteriler::where('id',$id)->get();
            $all['photo'] = fileUpload::changeUpload(rand(1,9000), "musteriler", $request->file('photo'), 0, $data, "photo");
            $update = Musteriler::where('id',$id)->update($all);

            if ($update){
                return redirect()->back()->with('status', 'Müşteri düzenlendi');
            }else{
                return redirect()->back()->with('status', 'Müşteri düzenlenemedi');
            }
        }else{
            return redirect('/');
        }
    }

    public function delete($id){
        $c = Musteriler::where('id',$id)->count();
        if ($c !=0){
            $data = Musteriler::where('id',$id)->get();
           fileUpload::directoryDelete($data[0]['photo']);
           Musteriler::where('id', $id)->delete();

           return redirect()->back();
        }else{
            return redirect('/');
        }
    }

    public function data(Request $request)
    {
        $table = Musteriler::query();
        $data = DataTables::of($table)
            ->addColumn('edit',function ($table){
                return '<a href="'.route('musteriler.edit',['id'=>$table->id]).'">Düzenle</a>';
            })
            ->addColumn('delete',function ($table){
                return '<a href="'.route('musteriler.delete',['id'=>$table->id]).'">Sil</a>';
            })
            ->addColumn('musteriTipi',function ($table){
                if ($table->musteriTipi == 0){return "Bireysel"; }else {return "Kurumsal";}
            })
            ->addColumn('publicname',function ($table){
                return Musteriler::getPublicName($table->id);
            })
            ->rawColumns(['edit','delete'])
            ->make(true);
        return $data;
    }
}
