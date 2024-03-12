@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row mb-3">
                <div class="col-12 text-end">
                    <a href="{{route('create')}}" class="btn btn-sm btn-primary">รับข้อมูล</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">ข้อมูล พื้นที่ และ จำนวนสินค้า</div>

                <div class="card-body">
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('You are logged in!') }}--}}

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="text-center">
                                    <th rowspan="2">พื้นที่</th>
                                    <th rowspan="2">รายการสินค้า</th>
                                    <th colspan="3">เปรียบเทียบจำนวนสินค้า</th>
                                    <th rowspan="2">ตรวจนำสำเร็จแล้ว</th>
                                </tr>
                                <tr class="text-center">
                                    <th>รอบที่ 1</th>
                                    <th>รอบที่ 2</th>
                                    <th>รอบที่ 3</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $previousAreaCode = null;
                                @endphp
                                @foreach($products as $p)
                                    <tr>
                                        @if ($previousAreaCode !== $p->area_code)
                                            <td rowspan="{{ $products->where('area_code', $p->area_code)->count() }}">{{ $p->area_code }}</td>
                                        @endif
                                        <td>{{ $p->prod_name }}</td>
                                        <td>{{ $p->prod_compare1 }}</td>
                                        <td>{{ $p->prod_compare2 }}</td>
                                        <td>{{ $p->prod_compare3 }}</td>
                                        <td>{{ $p->compare_success }}</td>
                                    </tr>
                                    @php
                                        $previousAreaCode = $p->area_code;
                                    @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection
