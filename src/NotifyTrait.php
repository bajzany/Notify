<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@alistra.cz
 */

namespace Bajzany\Notify;

/**
 * Trait NotifyTrait
 */
trait NotifyTrait
{

	/**
	 * @var INotifyControl @inject
	 */
	public $notifyControl;

	/**
	 * @var Notifications @inject
	 */
	public $notifications;

	/**
	 * @return \Bajzany\Notify\NotifyControl
	 */
	public function createComponentNotify()
	{
		return $this->notifyControl->create();
	}

	/**
	 * @param string $message
	 * @param string $title
	 * @param string $type
	 */
	public function addNotify(string $message, string $title = '', $type = Notification::TYPE_DEFAULT)
	{
		$notify = new Notification();
		$notify
			->setType($type)
			->setTitle($title)
			->setMessage($message);
		$this->notifications->addNotification($notify);
	}

}
