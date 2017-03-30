<?php
namespace PhpSolution\Notification\Rule;

/**
 * Class BasicRuleInterface
 *
 * @package PhpSolution\Notification\Rule
 */
interface MessageRuleInterface extends RuleInterface
{
    /**
     * @return mixed
     */
    public function getRecipientList();

    /**
     * @return mixed
     */
    public function getSender();

    /**
     * @return null|string
     */
    public function getMessage():? string;

    /**
     * @return null|string
     */
    public function getTitle():? string;
}