<?php

namespace src\Models;

use Spatie\DataTransferObject\DataTransferObject;

class Category extends DataTransferObject
{
    public int $id;
    public string $name;
}
