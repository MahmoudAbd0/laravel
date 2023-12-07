<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UploadImage
{
    public function storeImageAndGetData($storage, $default)
    {
        $data = $this->validated();
        $data["image"] = $this->image ? $this->image->store($storage) : $default;
        return $data;
    }
}
