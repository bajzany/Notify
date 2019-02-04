<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@alistra.cz
 */

namespace Bajzany\Notify\DI;

use Bajzany\Notify\INotifyControl;
use Bajzany\Notify\Notifications;
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
	}

	public function beforeCompile()
	{
		$builder = $this->getContainerBuilder();
		$application = $builder->getDefinitionByType(Application::class);
		$notifications = $builder->getDefinitionByType(Notifications::class);
		$application->addSetup('?->initialSets(?)', [$notifications, $application]);
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
