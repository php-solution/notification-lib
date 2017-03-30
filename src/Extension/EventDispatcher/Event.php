<?php
namespace PhpSolution\Notification\Extension\EventDispatcher;

use PhpSolution\Notification\Context;
use PhpSolution\Notification\Type\TypeInterface;
use Symfony\Component\EventDispatcher\Event as AbstractEvent;

/**
 * Class Event
 *
 * @package PhpSolution\Notification\Extension\EventDispatcher
 */
class Event extends AbstractEvent
{
    /**
     * @var TypeInterface
     */
    private $type;
    /**
     * @var Context|null
     */
    private $context;

    /**
     * Event constructor.
     *
     * @param TypeInterface $type
     * @param Context|null  $context
     */
    public function __construct(TypeInterface $type, ?Context $context)
    {
        $this->type = $type;
        $this->context = $context;
    }

    /**
     * @return TypeInterface
     */
    public function getType(): TypeInterface
    {
        return $this->type;
    }

    /**
     * @return Context|null
     */
    public function getContext():? Context
    {
        return $this->context;
    }
}