<?php


namespace App\Infrastructure\Transformer;


use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class ReviewOutputNameConverter implements NameConverterInterface
{

    public function normalize(string $propertyName)
    {
        if ( preg_match ( '/[A-Z]/', $propertyName ) === 0 ) { return $propertyName; }
        $pattern = '/([a-z])([A-Z])/';
        $r = strtolower ( preg_replace_callback ( $pattern, function ($a) {
            return $a[1] . '-' . strtolower ( $a[2] );
        }, $propertyName ) );
        return $r;
    }

    public function denormalize(string $propertyName)
    {
        // TODO: Implement denormalize() method.
    }

}