<?php
namespace PhpSolution\Notification\Notifier;

use PhpSolution\Notification\Rule\RuleInterface;

/**
 * Interface NotifierInterface
 *
 * @package PhpSolution\Notification\Notifier
 */
interface NotifierInterface
{
    /**
     * @return string
     */
    public static function getName(): string;

    /**
     * @param RuleInterface $rule
     */
    public function notifyRule(RuleInterface $rule): void;
}