<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PhpSolution\Notification\Context;
use PhpSolution\Notification\Notifier\NotifierInterface;
use PhpSolution\Notification\Rule\RuleInterface;
use PhpSolution\Notification\Type\TypeInterface;
use PhpSolution\Notification\Extension\ContextConfigure\ConfiguratorInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use PhpSolution\Notification\Notifier\NotifierRegistry;
use PhpSolution\Notification\Type\TypeRegistry;
use PhpSolution\Notification\Extension\CompositeExtension;
use PhpSolution\Notification\Extension\ContextConfigure\Extension as ContextConfigureExtension;
use PhpSolution\Notification\NotificationManager;

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

class NotificationType implements TypeInterface, ConfiguratorInterface
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return self::class;
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     */
    public function configureContext(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired('message')
            ->setAllowedTypes('message', ['string', 'null']);
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

// Must be included on DI
$notifierRegistry = new NotifierRegistry();
$notifierRegistry->add(new Notifier());
$typeRegistry = new TypeRegistry();
$extension = new CompositeExtension();
$extension->add(new ContextConfigureExtension());
$notificationManager = new NotificationManager($typeRegistry, $notifierRegistry, $extension);

// See: "Some message"
$notificationManager->notifyType(
    new NotificationType(),
    new Context(['message' => 'Some message'])
);

// See: "Fatal error: Uncaught Symfony\Component\OptionsResolver\Exception\InvalidOptionsException"
try {
    $notificationManager->notifyType(
        new NotificationType(),
        new Context(['message' => new \stdClass()])
    );
} catch (\Exception $e) {
    echo $e->getMessage();
}