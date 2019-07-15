<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 22.12.2018
 */

namespace Bajzany\Notify;

use Nette\Application\UI\Control;
use NettPack\Stage\Annotations as NP;

/**
 * @NP\NettPack(snippetSagas={
 *     @NP\SnippetSaga(saga="SAGA_NOTIFICATION_REQUEST_STARTED", snippet="snippet--notify")
 * })
 */
class NotifyControl extends Control
{

	/**
	 * @var Notifications @inject
	 */
	public $notifications;

	public function render()
	{
		$this->template->options = $this->getNotifications()->getOptions();
		$this->template->notifications = $notifications = $this->getNotifications()->getNotifications();
		$this->template->setFile(__DIR__ . '/template/notify.latte');
		$this->template->render();
		$this->notifications->resetNotifications();
	}

	/**
	 * @return Notifications
	 */
	public function getNotifications(): Notifications
	{
		return $this->notifications;
	}

}
