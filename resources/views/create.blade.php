@extends('layouts.app')
@section('content')
    <div class="container ">
            <div class="row justify-content-center">

                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">รับข้อมูล</div>
                            <div class="card-body">
                                <form action="{{route('create.form')}}" method="post">
                                    @method('post')
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label for="area">ชื่อพื้นที่</label>
                                        <input id="area" type="text" name="area_name" class="form-control">
                                    </div>
                                    <hr>
                                    <h6>สินค้า</h6>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <input id="p_name1" type="text" name="p_name1" class="form-control">
                                            </div>
                                            <div class="" id="addProduct">
                                                {{-- here --}}
                                            </div>
                                        </div>
                                        <div class="col-md-12 text">
                                            <button id="btnAddProduct" class="btn btn-sm btn-primary">+เพิ่มสินค้า</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-end">
                                            <button class="btn btn-sm btn-primary" type="submit">ถัดไป</button>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>


            </div>
    </div>

    <script src="{{asset('/js/sweetalert.js')}}"></script>
    <script src="{{asset('/js/jquery.js')}}" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            let p_number = 2
            $('#btnAddProduct').click((e)=>{
                event.preventDefault()
                const formDataHtml = `<div class="form-group mb-3">
                                            <input id="p_name${p_number}" type="text" name="p_name${p_number}" class="form-control">
                                      </div>`;
                p_number++
                $('#addProduct').append(formDataHtml);
            })
        })

        @if ($errors->any())
            swal.fire({
            icon : 'error',
            html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
            confirmButton: true,
        })
        @endif
    </script>
@endsection
