<?php
namespace PhpSolution\Notification\Extension;

use PhpSolution\Notification\Context;
use PhpSolution\Notification\Type\TypeInterface;

/**
 * Class ExtensionProcessor
 *
 * @package PhpSolution\Notification\Extension
 */
class CompositeExtension implements ExtensionInterface
{
    /**
     * @var \SplObjectStorage|ExtensionInterface[]
     */
    private $extensions;

    /**
     * @param TypeInterface $type
     * @param Context|null  $context
     */
    public function prepareNotification(TypeInterface $type, ?Context $context): void
    {
        foreach ($this->getExtensions() as $extension) {
            $extension->prepareNotification($type, $context);
        }
    }

    /**
     * @param ExtensionInterface $extension
     */
    public function add(ExtensionInterface $extension): void
    {
        $this->getExtensions()->attach($extension);
    }

    /**
     * @return \SplObjectStorage|ExtensionInterface[]
     */
    private function getExtensions(): \SplObjectStorage
    {
        return $this->extensions instanceof \SplObjectStorage ? $this->extensions : $this->extensions = new \SplObjectStorage();
    }
}