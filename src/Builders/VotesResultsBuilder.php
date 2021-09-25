<?php

namespace src\Builders;

use Spatie\DataTransferObject\DataTransferObjectError;
use src\Exceptions\ApiBuilderException;
use src\Models\Vote;

class VotesResultsBuilder
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
            foreach ($this->response as $obj) {
                $result[] = new Vote($obj);
            }
        } catch (DataTransferObjectError $e) {
            throw new ApiBuilderException('Wrong Api Response');
        }
        return $result;
    }
}
