<?php 

namespace P;

if(!defined('P')) die('Nowai...');

abstract class Badge {
	
	protected $title = 'Title';
	protected $description = 'Here some description';
	protected $earned = false;
	protected $ico = 'icon name/url';
	protected $notification_template = 'Congratulations! You`ve unlocked the "%s" badge!';

	public function __get($name) {
		return $this->{$name};
	}

	public function addBadge($migration = false) {
		if(!$this->earned) {
			$this->earned = true;
			if(!$migration) {
				//sendNotification(['message'=> $this->getNotificationMessage()]);
			}
		}
		return true;
	}

	public function getNotificationMessage() {
		return sprintf($this->notification_template, $this->title);
	}

}