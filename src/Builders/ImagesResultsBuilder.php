<?php

namespace src\Builders;

use Spatie\DataTransferObject\DataTransferObjectError;
use src\Exceptions\ApiBuilderException;
use src\Models\Image;

class ImagesResultsBuilder
{
    private ?array $response;

    public function __construct(?array $response)
    {
        $this->response = $response;
    }
    public function build(): array
    {
        $result = [];
        if (is_null($this->response)) {
            return $result;
        }

        try {
            foreach ($this->response as $image) {
                $result[] = new Image($image);
            }
        } catch (DataTransferObjectError $e) {
            throw new ApiBuilderException('Wrong Api Response');
        }
        return $result;
    }
}
