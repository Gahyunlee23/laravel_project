<?php

namespace App\Http\Requests\Hotel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreHotel extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>['required','string'],
            'title_en'=>['required','string'],
            'price'=>['required','integer','min:0'],
            'discount_rate'=>['required','integer','min:0','max:100'],
            'sale_price'=>['required','integer','min:0'],
            'refund_amount'=>['required','integer','min:0'],
            'explanation'=>['required','string','max:2000'],
            'sub_explanation'=>['required','string','max:2000'],
            'facilities'=>['required','string'],
            'amenities'=>['required','string'],
           /* 'check_point_image1'=>['image','mimes:jpeg,png,jpg,gif,webp'],
            'check_point_image2'=>['image','mimes:jpeg,png,jpg,gif,webp'],
            'check_point_image3'=>['image','mimes:jpeg,png,jpg,gif,webp'],
            'check_point_title1'=>['required','string','max:50'],
            'check_point_title2'=>['required','string','max:50'],
            'check_point_title3'=>['required','string','max:50'],
            'check_point_explanation1'=>['required','string','max:2000'],
            'check_point_explanation2'=>['required','string','max:2000'],
            'check_point_explanation3'=>['required','string','max:2000'],*/
            /*'file0.*' => ['required','image','mimes:jpeg,png,jpg,gif'],*/
            /* 'name' => 'required|min:1|max:30',*/
            /*'email' => 'required|email|min:3|max:100|unique:images',*/
            /*'sns' => 'max:100',*/
            /*'tel' => 'required|min:4|max:25|unique:images',*/
            /* 'file' => 'required|image|mimes:jpeg,png,jpg,gif',*/
            /*'check1' => 'accepted'*/
        ];
    }

    public function messages()
    {
        return [
            'title_en.required' => '`영 명칭`(은)는 필수 값 입니다.',
            'refund_amount.required' => '`취소환불금액`(은)는 필수 값 입니다.',
            'explanation.required' => '`설명`(은)는 필수 값 입니다.',
            'facilities.required' => '`시설`(은)는 필수 값 입니다.',
            'amenities.required' => '`도구`(은)는 필수 값 입니다.',
            /*'check_point_title1.required' => '`체크포인트 명칭1`(은)는 필수 값 입니다.',
            'check_point_title2.required' => '`체크포인트 명칭2`(은)는 필수 값 입니다.',
            'check_point_title3.required' => '`체크포인트 명칭3`(은)는 필수 값 입니다.',
            'check_point_explanation1.required' => '`체크포인트 설명1`(은)는 필수 값 입니다.',
            'check_point_explanation2.required' => '`체크포인트 설명2`(은)는 필수 값 입니다.',
            'check_point_explanation3.required' => '`체크포인트 설명3`(은)는 필수 값 입니다.',*/
            /*'file0.required' => '`이미지 파일`(은)는 필수 값 입니다.',*/
        ];
    }
}
