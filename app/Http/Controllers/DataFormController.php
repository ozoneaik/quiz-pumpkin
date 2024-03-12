<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Products;
use Illuminate\Http\Request;


class DataFormController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index(Request $request)
    {

//        dd($request->all());
        $validated = $request->validate([
            'area_name' => 'required|unique:areas|max:255',
        ],[
            'area_name.unique' => 'พื้นที่นี้ มีอยู่ในฐานข้อมูลหรือบันทึกอยู่แล้ว'
        ]);

        $dataForm = [];
        $products = [];
        foreach ($request->all() as $key => $value) {
            // ตรวจสอบว่าชื่อ input field เริ่มต้นด้วย "p_name"
            if (strpos($key, 'p_name') === 0) {
                $products[] = $value;
            }
        }

        $dataForm['area'] = $request->area_name;
        $dataForm['products'] = $products;
        $dataForm['count'] = 1;
//        dd($dataForm);
        return view('check',compact('dataForm'));

    }

    public function checkcompare1(Request $request){
//        dd($request->all());
        $dataForm = [];
        $products = [];
        foreach ($request->all() as $key => $value) {
            // ตรวจสอบว่าชื่อ input field เริ่มต้นด้วย "p_name"
            if (strpos($key, 'p_name') === 0) {
                $index = substr($key, strlen('p_name')); // ดึงตำแหน่ง index จากชื่อ input field
                $products[$index-1]['p_name'] = $value;
            }
            if (strpos($key, 'p_compareProduct1_') === 0) {
                $index = substr($key, strlen('p_compareProduct1_')); // ดึงตำแหน่ง index จากชื่อ input field
                $products[$index-1]['p_compare1'] = $value;
            }
        }


        $dataForm['area'] = $request->area;
        $dataForm['products'] = $products;
        $dataForm['count'] = 2;
//        dd($dataForm);
        return view('check2',compact('dataForm'));

    }
    public function checkcompare2(Request $request){
//        dd($request->all());
        $dataForm = [];
        $products = [];
        $msg = '';
        foreach ($request->all() as $key => $value) {
            // ตรวจสอบว่าชื่อ input field เริ่มต้นด้วย "p_name"
            if (strpos($key, 'p_name') === 0) {
                $index = substr($key, strlen('p_name')); // ดึงตำแหน่ง index จากชื่อ input field
                $products[$index-1]['p_name'] = $value;
            }
            if (strpos($key, 'p_compareProduct1_') === 0) {
                $index = substr($key, strlen('p_compareProduct1_')); // ดึงตำแหน่ง index จากชื่อ input field
                $products[$index-1]['p_compare1'] = $value;
            }
            if (strpos($key, 'p_compareProduct2_') === 0) {
                $index = substr($key, strlen('p_compareProduct2_')); // ดึงตำแหน่ง index จากชื่อ input field
                $products[$index-1]['p_compare2'] = $value;
                $products[$index-1]['compare_success'] = null;
            }

        }

        foreach ($products as $index => $p){
            if ($p['p_compare1'] === $p['p_compare2']){
                $msg = $msg.$p['p_name'].',ตรวจนับสำเร็จแล้ว';
                $products[$index]['compare_success'] = $p['p_compare1'];
            }
        }


        $dataForm['area'] = $request->area;
        $dataForm['products'] = $products;
        $dataForm['count'] = 3;
//        dd($dataForm);
        return view('check3',compact('dataForm'))->with('compareSuccess',$msg);
    }
    public function checkcompare3(Request $request){
//        dd($request->all());
        $dataForm = [];
        $products = [];
        $msg = '';
        foreach ($request->all() as $key => $value) {
            // ตรวจสอบว่าชื่อ input field เริ่มต้นด้วย "p_name"
            if (strpos($key, 'p_name') === 0) {
                $index = substr($key, strlen('p_name')); // ดึงตำแหน่ง index จากชื่อ input field
                $products[$index-1]['p_name'] = $value;
            }
            if (strpos($key, 'p_compareProduct1_') === 0) {
                $index = substr($key, strlen('p_compareProduct1_')); // ดึงตำแหน่ง index จากชื่อ input field
                $products[$index-1]['p_compare1'] = $value;
            }
            if (strpos($key, 'p_compareProduct2_') === 0) {
                $index = substr($key, strlen('p_compareProduct2_')); // ดึงตำแหน่ง index จากชื่อ input field
                $products[$index-1]['p_compare2'] = $value;
            }
            if (strpos($key, 'p_compareProduct3_') === 0) {
                $index = substr($key, strlen('p_compareProduct3_')); // ดึงตำแหน่ง index จากชื่อ input field
                $products[$index-1]['p_compare3'] = $value;
            }
            if (strpos($key, 'p_compare_success') === 0) {
                $index = substr($key, strlen('p_compare_success')); // ดึงตำแหน่ง index จากชื่อ input field
                $products[$index-1]['p_compare_success'] = $value;
            }

        }

        foreach ($products as $index => $p){
            if (!$p['p_compare_success']){
                if ($p['p_compare1'] === $p['p_compare3']){
                    $products[$index]['p_compare_success'] = $p['p_compare1'];
                }elseif ($p['p_compare2'] === $p['p_compare3']){
                    $products[$index]['p_compare_success'] = $p['p_compare2'];
                }else{
                    $products[$index]['p_compare_success'] = $p['p_compare3'];
                }
            }

        }


        $dataForm['area'] = $request->area;
        $dataForm['products'] = $products;
//        dd($dataForm);
        return view('store',compact('dataForm'))->with('compareSuccess',$msg);
    }

    public function store(Request $request){
//        dd($request->all());
        $dataForm = [];
        $products = [];
        $msg = '';
        foreach ($request->all() as $key => $value) {
            // ตรวจสอบว่าชื่อ input field เริ่มต้นด้วย "p_name"
            if (strpos($key, 'p_name') === 0) {
                $index = substr($key, strlen('p_name')); // ดึงตำแหน่ง index จากชื่อ input field
                $products[$index-1]['p_name'] = $value;
            }
            if (strpos($key, 'p_compareProduct1_') === 0) {
                $index = substr($key, strlen('p_compareProduct1_')); // ดึงตำแหน่ง index จากชื่อ input field
                $products[$index-1]['p_compare1'] = $value;
            }
            if (strpos($key, 'p_compareProduct2_') === 0) {
                $index = substr($key, strlen('p_compareProduct2_')); // ดึงตำแหน่ง index จากชื่อ input field
                $products[$index-1]['p_compare2'] = $value;
            }
            if (strpos($key, 'p_compareProduct3_') === 0) {
                $index = substr($key, strlen('p_compareProduct3_')); // ดึงตำแหน่ง index จากชื่อ input field
                $products[$index-1]['p_compare3'] = $value;
            }
            if (strpos($key, 'p_countProduct') === 0) {
                $index = substr($key, strlen('p_countProduct')); // ดึงตำแหน่ง index จากชื่อ input field
                $products[$index-1]['p_count'] = $value;
            }
            if (strpos($key, 'p_compare_success') === 0) {
                $index = substr($key, strlen('p_compare_success')); // ดึงตำแหน่ง index จากชื่อ input field
                $products[$index-1]['p_compare_success'] = $value;
            }
        }

        $dataForm['area'] = $request->area;
        $dataForm['products'] = $products;



        $data = new Area();
        $data->area_name = $dataForm['area'];
        $data->area_code = $dataForm['area'];
        $data->save();
        foreach ($dataForm['products'] as $p){
            $product = new Products();
            $product->prod_name = $p['p_name'];
            $product->prod_code = $p['p_name'];
            $product->prod_count = $p['p_count'];
            $product->prod_compare1 = $p['p_compare1'];
            $product->prod_compare2 = $p['p_compare2'];
            $product->prod_compare3 = $p['p_compare3'];
            $product->compare_success = $p['p_compare_success'];
            $product->area_code = $dataForm['area'];
            $product->save();
        }
//        dd($data);
//
//        dd($dataForm);
        return redirect('home');
    }
}
