<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed file
 * @property mixed mobile_chk
 * @property mixed name
 * @property mixed sns
 * @property mixed tel
 */
class StoreImage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           /* 'name' => 'required|min:1|max:30',*/
            /*'email' => 'required|email|min:3|max:100|unique:images',*/
            /*'sns' => 'max:100',*/
            /*'tel' => 'required|min:4|max:25|unique:images',*/
           /* 'file' => 'required|image|mimes:jpeg,png,jpg,gif',*/
            /*'check1' => 'accepted'*/
        ];
    }
}
