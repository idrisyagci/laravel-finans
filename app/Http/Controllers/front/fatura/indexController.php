<?php

namespace App\Http\Controllers\front\fatura;

use App\Http\Controllers\Controller;
use App\Fatura;
use App\Musteriler;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class indexController extends Controller
{
    public function index(){
        return view('front.fatura.index');
    }

    public function create($type){
        if ($type==0){
            return view('front.fatura.gelir.create');
        }else{
            return view('front.fatura.gider.create');
        }

    }

    public function data(Request $request)
    {
        $table = Fatura::query();
        $data = DataTables::of($table)
            ->addColumn('edit',function ($table){
                return '<a href="'.route('fatura.edit',['id'=>$table->id]).'">Düzenle</a>';
            })
            ->addColumn('delete',function ($table){
                return '<a href="'.route('fatura.delete',['id'=>$table->id]).'">Sil</a>';
            })
            ->addColumn('musteri',function ($table){
                return Musteriler::getPublicName($table->musteriId);
            })
            ->addColumn('faturaTipi',function ($table){
                if ($table->faturaTipi == 0){return "Gelir"; }else {return "Gider";}
            })
            ->rawColumns(['edit','delete'])
            ->make(true);
        return $data;
    }
}
