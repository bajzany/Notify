<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@alistra.cz
 */

namespace Bajzany\Notify;

use Chomenko\AppWebLoader\AppWebLoader;
use Nette\Application\Application;
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
	 * @param AppWebLoader $appWebLoader
	 * @param Session $session
	 * @param array $options
	 */
	public function __construct(AppWebLoader $appWebLoader, Session $session, $options = [])
	{
		$this->webloader = $appWebLoader;
		$this->options = $options;
		$this->session = $session->getSection('notify');
	}

	/**
	 * @param Application $application
	 * @throws \Chomenko\AppWebLoader\Exceptions\AppWebLoaderException
	 * @throws \ReflectionException
	 */
	public function initialSets(Application $application)
	{
		$collection = $this->webloader->createCollection("notificationJs");
		$collection->addScript(__DIR__ . "/template/notify.js");

		$collection = $this->webloader->createCollection("notificationCss");
		$collection->addStyles(__DIR__ . "/template/notify.css");
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
