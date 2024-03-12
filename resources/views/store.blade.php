@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ใส่จำนวนสินค้า</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('store.form')}}" method="post">
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
                                        <input type="hidden" name="p_compareProduct3_{{$i}}" value="{{$p['p_compare3']}}">
                                        <input type="hidden" name="p_compare_success{{$i}}" value="{{$p['p_compare_success']}}">


                                        @if($p['p_compare_success'])
                                            <div class="alert alert-success alert-block mt-3">
                                                <strong>{{$p['p_name']}} ตรวจนับสำเร็จแล้ว</strong>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="p_countProduct{{$i}}">{{$p['p_name']}} (จำนวนที่เช็คในรอบแรก = {{$p['p_compare1']}},รอบสอง = {{$p['p_compare2']}},รอบสาม = {{$p['p_compare3']}})</label>
                                            <input type="number" name="p_countProduct{{$i}}" id="p_countProduct{{$i}}" class="form-control" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid city.
                                            </div>
                                        </div>






                                        @php $i++ @endphp
                                    @endforeach
                                    <div class="row mt-3">
                                        <div class="col-md-12 text-end">
                                            <button type="submit" class="btn btn-primary btn-sm">บันทึก</button>
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
