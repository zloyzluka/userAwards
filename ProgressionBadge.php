<?php
namespace P;

if(!defined('P')) die('Nowai...');

abstract class ProgressionBadge {

	protected $title;
	protected $description;

	protected $progress_list = [
		'0' => 0,
		'1' => 1,
		'2' => 10,
		'3' => 50,
		'4' => 250,
		'5' => 1000,
	];
	
	protected $current_rank;
	protected $current_score;
	protected $current_rank_score;
	protected $next_rank_score;
	protected $ico = 'icon name/url';
	protected $notification_template = 'Congratulations! You`ve upgraded your "%s" to level %s!';

	public function __construct() {
		$this->current_rank = 0;
		$this->current_score = 0;
		$this->current_rank_score = 0;
		$this->next_rank_score = $this->progress_list[$this->current_rank + 1];
	}

	public function inc() {
		$this->current_score ++;
		if(!$this->isMaxRank() && $this->current_score >= $this->next_rank_score) {
			$this->current_rank ++;
			$this->updateRank();
		}
		return true;
	}

	public function setScore($newScore, $migration = false) {
		$this->current_score = $newScore;
		foreach($this->progress_list as $rank => $score){
			if($this->current_score >= $score) {
				continue;
			} else {
				$this->current_rank = $rank - 1;
				$this->updateRank($migration);
				break;
			}
		}
		return true;
	}

	protected function isMaxRank() {
		return !(isset($this->progress_list[$this->current_rank + 1]) && !empty($this->progress_list[$this->current_rank + 1])); 
	}

	private function updateRank($migration = false) {
		$this->current_rank_score = $this->progress_list[$this->current_rank];
		if(!$this->isMaxRank()) {
			$this->next_rank_score = $this->progress_list[$this->current_rank + 1];
			if (!$migration) {
				//sendNotification(['message'=> $this->getNotificationMessage()]);
			}
		}
	}

	private function getNotificationMessage() {
		return sprintf($this->notification_template, $this->title, $this->current_rank);
	}

	public function __get($name) {
		return $this->{$name};
	}
	
}