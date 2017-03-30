<?php
namespace PhpSolution\Notification\Extension\ContextConfigure;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Interface ConfiguratorInterface
 *
 * @package PhpSolution\Notification\Extension\ContextConfigure
 */
interface ConfiguratorInterface
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureContext(OptionsResolver $resolver);
}