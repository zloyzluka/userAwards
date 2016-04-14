<?php 
abstract class Badge extends Award{
	
	protected $title = 'Title';
	protected $description = 'Here some description';
	protected $earned = false;
	protected $ico = 'icon name/url';
	protected $notification_template = 'Congratulations! You`ve unlocked the "%s" badge!';

	public function addBadge($migration = false) {
		if(!$this->earned) {
			$this->earned = true;
			if(!$migration) {
				$this->sendNotification(['message'=> $this->getNotificationMessage()]);
			}
		}
		return true;
	}
}