<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@alistra.cz
 */

namespace Bajzany\Notify\DI;

use Bajzany\Notify\INotifyControl;
use Bajzany\Notify\Listener;
use Bajzany\Notify\Notifications;
use Kdyby\Events\DI\EventsExtension;
use Nette\Application\Application;
use Nette\Configurator;
use Nette\DI\Compiler;
use Nette\DI\CompilerExtension;

class NotifyExtension extends CompilerExtension
{

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('Notification'))
			->setFactory(Notifications::class, ['options' => $this->config])
			->setInject(TRUE);

		$builder->addDefinition($this->prefix('Notify'))
			->setImplement(INotifyControl::class)
			->setInject(TRUE);

		$builder->addDefinition($this->prefix("application.listener"))
			->setFactory(Listener::class)
			->addTag(EventsExtension::TAG_SUBSCRIBER);
	}

	/**
	 * @param Configurator $configurator
	 */
	public static function register(Configurator $configurator)
	{
		$configurator->onCompile[] = function ($config, Compiler $compiler) {
			$compiler->addExtension('Notify', new NotifyExtension());
		};
	}

}
