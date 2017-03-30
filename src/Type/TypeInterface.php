<?php
namespace PhpSolution\Notification\Type;

use PhpSolution\Notification\Context;
use PhpSolution\Notification\Rule\RuleInterface;

/**
 * Interface TypeInterface
 *
 * @package PhpSolution\Notification\Type
 */
interface TypeInterface
{
    /**
     * @return string
     */
    public static function getName(): string;

    /**
     * Must yield RuleInterface
     *
     * @param Context|null $context
     *
     * @return \Generator|RuleInterface|RuleInterface[]
     */
    public function buildRule(?Context $context): \Generator;
}