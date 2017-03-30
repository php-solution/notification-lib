<?php
namespace PhpSolution\Notification\Notifier;

/**
 * Class AbstractNotifier
 *
 * @package PhpSolution\Notification\Notifier
 */
abstract class AbstractNotifier implements NotifierInterface
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return static::class;
    }
}