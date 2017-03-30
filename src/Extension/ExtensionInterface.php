<?php
namespace PhpSolution\Notification\Extension;

use PhpSolution\Notification\Context;
use PhpSolution\Notification\Type\TypeInterface;

/**
 * Interface ExtensionInterface
 *
 * @package PhpSolution\Notification\Extension
 */
interface ExtensionInterface
{
    /**
     * @param TypeInterface $type
     * @param Context|null  $context
     */
    public function prepareNotification(TypeInterface $type, ?Context $context): void;
}