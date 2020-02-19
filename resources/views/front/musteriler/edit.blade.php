@extends('layouts.app')
@section('content')
    <!-- Page Title Area -->
    <div class="row page-title clearfix">
        <div class="page-title-left">
            <h6 class="page-title-heading mr-0 mr-r-5">Müşteri Düzenle</h6>
        </div>
        <!-- /.page-title-left -->
        <div class="page-title-right d-none d-sm-inline-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Panel</a>
                </li>
                <li class="breadcrumb-item active">Müşteriler</li>
            </ol>
            <div class="d-none d-md-inline-flex justify-center align-items-center"><a href="javascript: void(0);" class="btn btn-color-scheme btn-sm fs-11 fw-400 mr-l-40 pd-lr-10 mr-l-0-rtl mr-r-40-rtl hidden-xs hidden-sm ripple" target="_blank">{{\App\Musteriler::getPublicName($data[0]['id'])}}</a>
            </div>
        </div>
        <!-- /.page-title-right -->
    </div>

    @if(session('status'))
        <div class="row" style="margin-top: 10px;">
            <div class="col-md-12">
                <div class="alert alert-success">{{session('status')}}</div>
            </div>
        </div>
    @endif
    <div class="widget-list">
        <div class="row">
            <div class="col-md-12 widget-holder">
                <div class="widget-bg">
                    <div class="widget-body clearfix">
                        <form action="{{route('musteriler.update', ['id'=> $data[0]['id']])}}" method="post" enctype="multipart/form-data">
                            @csrf

                            @if($data[0]['photo'] != "")
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <img src="{{asset($data[0]['photo'])}}" class="img-thumbnail" style="width: 250px" alt="">
                                    </div>
                                </div>
                                @endif
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label" >Müşteri Resmi</label>
                                    <input class="form-control" name="photo" type="file">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label" >Müşteri Tipi</label>
                                    <div>
                                        <input type="radio" class="changeCustomerType" name="musteriTipi" @if($data[0]['musteriTipi']==0)checked @endif value="0"> Bireysel
                                    </div>
                                    <div>
                                        <input type="radio" class="changeCustomerType" name="musteriTipi" @if($data[0]['musteriTipi']==1)checked @endif value="1"> Krumsal
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row firmaArea" @if($data[0]['musteriTipi']==0)style="display: none" @endif >
                                <div class="col-md-4">
                                    <label class="col-form-label" for="l0">Firma Adı</label>
                                    <input class="form-control" name="firmaAdi" value="{{$data[0]['firmaAdi']}}" type="text">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="l0">Vergi Dairesi</label>
                                    <input class="form-control" name="vergiDairesi" value="{{$data[0]['vergiDairesi']}}" type="text">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="l0">Vergi Numarası</label>
                                    <input class="form-control" name="vergiNumarasi" value="{{$data[0]['vergiNumarasi']}}" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label" for="l0">Adı</label>
                                    <input class="form-control" name="ad" value="{{$data[0]['ad']}}" type="text">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label" for="l0">Soyadı</label>
                                    <input class="form-control" name="soyad" value="{{$data[0]['soyad']}}" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label" for="l0">Doğum Tarihi</label>
                                    <input class="form-control" name="dogumTarihi" value="{{$data[0]['dogumTarihi']}}" type="date">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label" for="l0">TC</label>
                                    <input class="form-control" name="tc" value="{{$data[0]['tc']}}" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="col-form-label" for="l0">Adres</label>
                                    <input class="form-control" name="adres"  value="{{$data[0]['adres']}}"type="text">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="l0">Telefon</label>
                                    <input class="form-control" name="telefon" value="{{$data[0]['telefon']}}" type="tel">
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label" for="l0">Email</label>
                                    <input class="form-control" name="email" value="{{$data[0]['email']}}" type="email">
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="form-group row">
                                    <div class="col-md-12 ml-md-auto btn-list">
                                        <button class="btn btn-primary btn-rounded" type="submit">Düzenle</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.widget-body -->
                </div>
                <!-- /.widget-bg -->
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $('.changeCustomerType').click(function () {
            var value = $(this).val();
            if (value == 1){
                $('.firmaArea').show(500);
            }else {
                $('.firmaArea').hide(300);
            }
        });
    </script>
@endsection
