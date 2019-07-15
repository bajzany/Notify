<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 */

namespace Bajzany\Notify;

use Kdyby\Events\Subscriber;
use Nette\Application\Application;
use Nette\Application\UI\Presenter;

class Listener implements Subscriber
{

	/**
	 * @var Notifications
	 */
	private $notifications;

	public function __construct(Notifications $notifications)
	{
		$this->notifications = $notifications;
	}

	/**
	 * @return array|string[]
	 */
	public function getSubscribedEvents()
	{
		if (php_sapi_name() == "cli") {
			return [];
		}
		return [
			Application::class . '::onPresenter' => "onPresenter",
		];
	}

	/**
	 * @param Application $application
	 * @param Presenter $presenter
	 */
	public function onPresenter(Application $application, Presenter $presenter): void
	{
		if (property_exists($presenter, 'onAfterRender')) {
			$presenter->onAfterRender[] = function () use ($presenter) {
				if ($presenter->isAjax()) {
					if (!empty($this->notifications->getNotifications())) {
						$presenter->redrawControl('notify');
					}
				}
			};
		}
	}

}
