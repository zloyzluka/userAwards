<?php
abstract class Medal extends Award{

	protected $ranks = [
		'1' => 'gold',
		'2' => 'silver',
		'3' => 'bronze'
	];
	protected $gold = 0;
	protected $silver = 0;
	protected $bronze = 0;

	protected $total = 0;

	protected $title = 'MEDAL TITLE';
	protected $ico = 'icon name/url';
	protected $notification_template = 'Congratulations! You`ve won a %s "%s" trophy!';

	public function addMedal($rank) {
		$this->set($rank);
		return true;
	}

	public function set($rank, $count = 1, $migration = false) {
		$this->{$this->ranks[$rank]}+= $count;
		$this->total+=$count;
		if(!$migration){
			$this->sendNotification(['message'=> $this->getNotificationMessage($rank)]);
		}
		return true;
	}

}