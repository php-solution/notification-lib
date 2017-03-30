<?php
namespace PhpSolution\Notification;

use PhpSolution\Notification\Extension\ExtensionInterface;
use PhpSolution\Notification\Notifier\NotifierRegistry;
use PhpSolution\Notification\Type\TypeInterface;
use PhpSolution\Notification\Type\TypeRegistry;

/**
 * Class NotificationManager
 *
 * @package PhpSolution\Notification
 */
class NotificationManager
{
    /**
     * @var TypeRegistry
     */
    protected $typeRegistry;
    /**
     * @var NotifierRegistry
     */
    protected $notifierRegistry;
    /**
     * @var ExtensionInterface
     */
    protected $extension;

    /**
     * NotificationManager constructor.
     *
     * @param TypeRegistry            $typeRegistry
     * @param NotifierRegistry        $notifierRegistry
     * @param ExtensionInterface|null $extension
     */
    public function __construct(TypeRegistry $typeRegistry, NotifierRegistry $notifierRegistry, ExtensionInterface $extension = null)
    {
        $this->typeRegistry = $typeRegistry;
        $this->notifierRegistry = $notifierRegistry;
        $this->extension = $extension;
    }

    /**
     * @param string       $name
     * @param Context|null $context
     */
    public function notify(string $name, Context $context = null): void
    {
        $type = $this->typeRegistry->getByName($name);
        $this->notifyType($type, $context);
    }

    /**
     * @param TypeInterface $type
     * @param Context|null  $context
     */
    public function notifyType(TypeInterface $type, Context $context = null): void
    {
        if ($this->extension instanceof ExtensionInterface) {
            $this->extension->prepareNotification($type, $context);
        }

        foreach ($type->buildRule($context) as $rule) {
            $notifierName = $rule::getNotifierName();
            $notifier = $this->notifierRegistry->getByName($notifierName);
            $notifier->notifyRule($rule);
        }
    }
}