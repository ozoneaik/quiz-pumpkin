@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">เช็คสินค้ารอบที่ {{$dataForm['count']}}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('checkcompare1.form')}}" method="post">
                                    @method('post')
                                    @csrf

                                    <h6>พื้นที่ : {{$dataForm['area']}}</h6>
                                    <hr>
                                    @php $i = 1 @endphp
                                    <h6>จำนวนสินค้าทั้งหมด : {{count($dataForm['products'])}} รายการ</h6>
                                    @foreach($dataForm['products'] as $p_name)

                                        <input type="hidden" name="area" value="{{$dataForm['area']}}">
                                        <input type="hidden" name="p_name{{$i}}" value="{{$p_name}}">

                                        <div class="form-group">
                                            <label for="p_compare{{$i}}">{{$p_name}}</label>
                                            <input type="number" name="p_compareProduct1_{{$i}}" id="p_compare{{$i}}" class="form-control">
                                        </div>







                                        @php $i++ @endphp
                                    @endforeach
                                    <div class="row mt-3">
                                        <div class="col-md-12 text-end">
                                            <button type="submit" class="btn btn-primary btn-sm">ถัดไป</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
