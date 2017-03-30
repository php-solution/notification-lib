<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PhpSolution\Notification\Context;
use PhpSolution\Notification\Notifier\NotifierInterface;
use PhpSolution\Notification\Rule\RuleInterface;
use PhpSolution\Notification\Type\TypeInterface;

class NotificationRule implements RuleInterface
{
    /**
     * @var null|string
     */
    private $message;

    /**
     * NotificationRule constructor.
     *
     * @param null|string $message
     */
    public function __construct(?string $message)
    {
        $this->message = $message;
    }

    /**
     * @return null|string
     */
    public function getText():? string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public static function getNotifierName(): string
    {
        return Notifier::getName();
    }
}

class NotificationType implements TypeInterface
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return self::class;
    }

    /**
     * @param Context|null $context
     *
     * @return Generator
     */
    public function buildRule(?Context $context = null): \Generator
    {
        yield new NotificationRule($context['message']);
    }
}

class Notifier implements NotifierInterface
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return self::class;
    }

    /**
     * @param RuleInterface|NotificationRule $rule
     */
    public function notifyRule(RuleInterface $rule): void
    {
        echo $rule->getText();
    }
}

use PhpSolution\Notification\Notifier\NotifierRegistry;
use PhpSolution\Notification\Type\TypeRegistry;
use PhpSolution\Notification\Extension\EventDispatcher\Extension as EventDispatcherExtension;
use PhpSolution\Notification\Extension\EventDispatcher\Events;
use PhpSolution\Notification\Extension\EventDispatcher\Event;
use PhpSolution\Notification\NotificationManager;


// Must be included on DI
$notifierRegistry = new NotifierRegistry();
$notifierRegistry->add(new Notifier());
$typeRegistry = new TypeRegistry();
$sfEventDispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();
$sfEventDispatcher->addListener(
    Events::PREPARE,
    function (Event $event) {
        $event->getContext()->offsetSet('message', 'Changed on extension listener message');
    }
);

$extension = new EventDispatcherExtension($sfEventDispatcher);
$notificationManager = new NotificationManager($typeRegistry, $notifierRegistry, $extension);

// See: "Changed on extension listener message"
$notificationManager->notifyType(
    new NotificationType(),
    new Context(['message' => 'Some message'])
);
