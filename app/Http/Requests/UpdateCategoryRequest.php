<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'max:2048',
        ];
    }

    public function storeImageAndGetData()
    {
        $data = $this->validated();
        $data["image"] = $oldImagePath = $this->category->image;

        if ($this->hasFile('image')) {
            $data["image"]  = $this->image->store('public/category');
            if ($oldImagePath !== "public/category/default.png" && !empty($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
        }

        return $data;
    }
}
