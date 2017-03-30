<?php
namespace PhpSolution\Notification\Notifier;

/**
 * Class NotifierRegistry
 *
 * @package PhpSolution\Notification\Notifier
 */
class NotifierRegistry
{
    /**
     * @var \ArrayObject|NotifierInterface[]
     */
    protected $notifierList;

    /**
     * @param string $name
     *
     * @return NotifierInterface
     */
    public function getByName(string $name): NotifierInterface
    {
        $list = $this->getList();
        if (!$list->offsetExists($name)) {
            throw new \InvalidArgumentException(sprintf('Undefined notification notifier with name: "%s"', $name));
        }

        return $list->offsetGet($name);
    }

    /**
     * @param NotifierInterface $notifier
     */
    public function add(NotifierInterface $notifier): void
    {
        $this->getList()->offsetSet($notifier::getName(), $notifier);
    }

    /**
     * @return \ArrayObject
     */
    protected function getList(): \ArrayObject
    {
        return $this->notifierList instanceof \ArrayObject ? $this->notifierList : $this->notifierList = new \ArrayObject();
    }
}