<?php

namespace src\Models;

use Spatie\DataTransferObject\DataTransferObject;

class Favourite extends DataTransferObject
{
    public string $id;
    public string $created_at;
    public string $image_id;
    public string $sub_id;
}
