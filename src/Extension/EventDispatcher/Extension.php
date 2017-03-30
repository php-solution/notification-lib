<?php
namespace PhpSolution\Notification\Extension\EventDispatcher;

use PhpSolution\Notification\Context;
use PhpSolution\Notification\Extension\ExtensionInterface;
use PhpSolution\Notification\Type\TypeInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Class Extension
 *
 * @package PhpSolution\Notification\Extension\EventDispatcher
 */
class Extension implements ExtensionInterface
{
    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    /**
     * Extension constructor.
     *
     * @param EventDispatcher $eventDispatcher
     */
    public function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param TypeInterface $type
     * @param Context|null  $context
     */
    public function prepareNotification(TypeInterface $type, Context $context = null): void
    {
        $this->eventDispatcher->dispatch(Events::PREPARE, new Event($type, $context));
    }
}