<?php
namespace App\Pipe;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class JsonPipe extends AbstractExtension 
{
    public function getFilters() 
    {
        return [
            new TwigFilter('json_decode', [$this, 'jsonDecode']),
        ];
    }

    public function jsonDecode(Mixed $stdclass)
    {
        return json_decode( json_encode($stdclass), true);
    }
}