<?php
/**
 * Author: Radek Zíka
 * Email: radek.zika@dipcom.cz
 * Created: 22.12.2018
 */

namespace Bajzany\Notify;

interface INotifyControl
{

	/**
	 * @return NotifyControl
	 */
	public function create() : NotifyControl;

}
