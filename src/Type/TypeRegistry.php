<?php
namespace PhpSolution\Notification\Type;

/**
 * Class TypeRegistry
 *
 * @package PhpSolution\Notification\Type
 */
class TypeRegistry
{
    /**
     * @var \ArrayObject|TypeInterface[]
     */
    protected $typeList;

    /**
     * @param string $name
     *
     * @return TypeInterface
     */
    public function getByName(string $name): TypeInterface
    {
        $list = $this->getList();
        if (!$list->offsetExists($name)) {
            throw new \InvalidArgumentException(sprintf('Undefined notification type with name: "%s"', $name));
        }

        return $list->offsetGet($name);
    }

    /**
     * @param TypeInterface $type
     *
     * @return TypeRegistry
     */
    public function add(TypeInterface $type): TypeRegistry
    {
        $this->getList()->offsetSet($type::getName(), $type);

        return $this;
    }

    /**
     * @return \ArrayObject
     */
    protected function getList(): \ArrayObject
    {
        return $this->typeList instanceof \ArrayObject ? $this->typeList : $this->typeList = new \ArrayObject();
    }
}