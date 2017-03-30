<?php
namespace PhpSolution\Notification\Extension\ContextConfigure;

use PhpSolution\Notification\Context;
use PhpSolution\Notification\Extension\ExtensionInterface;
use PhpSolution\Notification\Type\TypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class Extension
 *
 * @package PhpSolution\Notification\Extension\ContextConfigure
 */
class Extension implements ExtensionInterface
{
    /**
     * @param TypeInterface $type
     * @param Context|null  $context
     */
    public function prepareNotification(TypeInterface $type, ?Context $context): void
    {
        if ($context instanceof Context && $type instanceof ConfiguratorInterface) {
            $contextResolver = new OptionsResolver();
            $type->configureContext($contextResolver);
            $resolvedContext = $contextResolver->resolve($context->getArrayCopy());
            $context->exchangeArray($resolvedContext);
        }
    }
}