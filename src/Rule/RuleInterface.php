<?php
namespace PhpSolution\Notification\Rule;

/**
 * Interface RuleInterface
 *
 * @package PhpSolution\Notification\Rule
 */
interface RuleInterface
{
    /**
     * @return string
     */
    public static function getNotifierName(): string;
}