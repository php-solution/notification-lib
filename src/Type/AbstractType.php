<?php
namespace PhpSolution\Notification\Type;

/**
 * Class BasicType
 *
 * @package PhpSolution\Notification\Type
 */
abstract class AbstractType implements TypeInterface
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return static::class;
    }
}