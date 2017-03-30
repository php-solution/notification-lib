<?php
namespace PhpSolution\Notification;

/**
 * Class NotificationManagerAwareTrait
 *
 * @package PhpSolution\Notification
 */
trait NotificationManagerAwareTrait
{
    /**
     * @var NotificationManager
     */
    protected $notificationManager;

    /**
     * @param NotificationManager $notificationManager
     */
    final public function setNotificationManager(NotificationManager $notificationManager): void
    {
        $this->notificationManager = $notificationManager;
    }

    /**
     * @return NotificationManager
     */
    final protected function getNotificationManager(): NotificationManager
    {
        return $this->notificationManager;
    }
}