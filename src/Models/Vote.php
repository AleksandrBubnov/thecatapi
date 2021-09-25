<?php

namespace src\Models;

use Spatie\DataTransferObject\DataTransferObject;

class Vote extends DataTransferObject
{
    public string $id;
    public int $value;
    public string $country_code;
    public string $created_at;
    public string $image_id;
    public string $sub_id;
}
