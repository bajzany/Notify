## Notify

Nette notification for message

Required:
- php: ^7.2
- [nette/di](https://packagist.org/packages/nette/di)
- [nette/application](https://packagist.org/packages/nette/application)
- [nette/bootstrap](https://packagist.org/packages/nette/bootstrap)
- [latte/latte](https://packagist.org/packages/latte/latte)
- [nette/utils](https://packagist.org/packages/nette/utils)
- [chomenko/app-webloader](https://packagist.org/packages/chomenko/app-webloader)

![Paginator](src/Doc/image1.PNG?raw=true)


#### Instalation

- Composer instalation

		composer require bajzany/notify dev-master


- Register into Nette Application

		extensions:
    		Notify: Bajzany\Notify\DI\NotifyExtension
    		

- How to Use:

	- In presenter notifyTrait;
	
			use NotifyTrait;
			
	- Adding to notifications collections
		
			$this->addNotify('Second notification', 'NotifyControl', Notification::TYPE_PURPLE);
			
	- Template (.latte) in your base Latte
	
			{control notify}
