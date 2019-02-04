<?php

/**
 * Author: Radek Zíka
 * Email: radek.zika@alistra.cz
 */

namespace Bajzany\Notify;

class Notification
{

	const TYPE_DEFAULT = 'default';
	const TYPE_PRIMARY = 'primary';
	const TYPE_SUCCESS = 'success';
	const TYPE_DANGER = 'danger';
	const TYPE_WARNING = 'warning';
	const TYPE_INFO = 'info';
	const TYPE_LIGHT = 'light';
	const TYPE_PURPLE = 'purple';

	/**
	 * @var string
	 */
	private $title;

	/**
	 * @var string
	 */
	private $message;

	/**
	 * @var string
	 */
	private $type;

	public function __construct()
	{
		$this->type = self::TYPE_DEFAULT;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 * @return $this
	 */
	public function setTitle(string $title)
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getMessage(): string
	{
		return $this->message;
	}

	/**
	 * @param string $message
	 * @return $this
	 */
	public function setMessage(string $message)
	{
		$this->message = $message;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @param string $type
	 * @return $this
	 */
	public function setType(string $type)
	{
		$this->type = $type;
		return $this;
	}

}
