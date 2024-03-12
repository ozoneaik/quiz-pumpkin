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
                                <form action="{{route('checkcompare3.form')}}" method="post">
                                    @method('post')
                                    @csrf

                                    <h6>พื้นที่ : {{$dataForm['area']}}</h6>
                                    <hr>
                                    @php $i = 1 @endphp
                                    <h6>จำนวนสินค้าทั้งหมด : {{count($dataForm['products'])}} รายการ</h6>
                                    @foreach($dataForm['products'] as $p)

                                        <input type="hidden" name="area" value="{{$dataForm['area']}}">
                                        <input type="hidden" name="p_name{{$i}}" value="{{$p['p_name']}}">
                                        <input type="hidden" name="p_compareProduct1_{{$i}}" value="{{$p['p_compare1']}}">
                                        <input type="hidden" name="p_compareProduct2_{{$i}}" value="{{$p['p_compare2']}}">
                                        <input type="hidden" name="p_compare_success{{$i}}" value="{{$p['compare_success']}}">


                                        @if($p['compare_success'])
                                            <div class="alert alert-success alert-block mt-3">
                                                <strong>{{$p['p_name']}} ตรวจนับสำเร็จแล้ว</strong>
                                            </div>
                                        @endif
                                        <div class="form-group @if($p['compare_success']) text-success @endif">
                                            <label for="p_compare{{$i}}">{{$p['p_name']}} (จำนวนที่เช็คในรอบแรก = {{$p['p_compare1']}},รอบสอง = {{$p['p_compare2']}} )</label>
                                            <input type="@if($p['compare_success']) number @else hidden @endif"  name="p_compareProduct3_{{$i}}" id="p_compare{{$i}}" class="form-control " @if($p['compare_success']) readonly @endif>
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
