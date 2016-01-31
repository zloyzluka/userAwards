<?php
namespace P;

if(!defined('P')) die('Nowai...');

abstract class Medal {

	public $ranks = [
		'1' => 'gold',
		'2' => 'silver',
		'3' => 'bronze'
	];
	public $gold = 0;
	public $silver = 0;
	public $bronze = 0;

	public $total = 0;

	public $title = 'MEDAL TITLE';
	public $ico = 'icon name/url';
	protected $notification_template = 'Congratulations! You`ve won a %s "%s" trophy!';

	public function add($rank) {
		$this->{$this->ranks[$rank]}++;
		$this->total++;
		//sendNotification(['message'=> $this->getNotificationMessage($rank)]);
		return true;
	}

	private function getNotificationMessage($rank) {
		return sprintf($this->notification_template, $rank, $this->title);
	}
}