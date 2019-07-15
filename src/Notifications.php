<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@alistra.cz
 */

namespace Bajzany\Notify;

use Nette\Http\Session;

class Notifications
{

	/**
	 * @var Notification[]
	 */
	private $notifications = [];

	/**
	 * @var array
	 */
	private $options;

	/**
	 * @var \Nette\Http\SessionSection
	 */
	private $session;

	/**
	 * @param Session $session
	 * @param array $options
	 */
	public function __construct(Session $session, $options = [])
	{
		$this->options = $options;
		$this->session = $session->getSection('notify');
	}

	/**
	 * @return Notification[]
	 */
	public function getNotifications(): array
	{
		return isset($this->session->notifications) ? $this->session->notifications : [];
	}

	/**
	 * @param Notification $notifications
	 */
	public function addNotification(Notification $notifications)
	{
		$this->notifications[] = $notifications;
		$this->session->notifications = $this->notifications;
	}

	/**
	 * @return array
	 */
	public function getOptions(): array
	{
		return $this->options;
	}

	public function resetNotifications()
	{
		$this->session->notifications = [];
	}

}
