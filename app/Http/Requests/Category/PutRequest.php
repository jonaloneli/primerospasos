<?php

namespace App\Http\Requests\Category;
use Illuminate\Foundation\Http\FormRequest;
class PutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //Lo ponemos en true.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {   
        //dd($this->route("post")->id);
        return [
            //
            "title" => "required|min:5|max:500",
            "slug" => "required|min:5|max:500|unique:categories,slug,".$this->route("category")->id,
        ];
    }
}
