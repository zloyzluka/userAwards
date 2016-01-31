<?php
namespace P;

if(!defined('P')) die('Nowai...');

class userAwards {

	private $medals = [
		'highestrated'  => true,
		'b_influencer'  => true,
		'popular_story' => true,
		'karma'		    => true,
	];

	private $progressBadges = [
		'influencer' => true,
		'comments'   => true,
		'voiter'     => true,
		'karma'      => true,
	];

	private $badges = [
		'first_story' 	   		  => true,
		'complete_profile'        => true,
		'share_story_on_facebook' => true,
		'recruit_friend'          => true,
		'addict'                  => true,
		'storyboard_king'         => true,
		'storyboard_overloard'    => true,
	];

	public function getProgressBadgesList() {
		$ret = [];
		foreach ($this->progressBadges as $badgeName => $badge) {
			if($badge) {
				$ret[$badgeName] = $this->getProgressBadge($badgeName);
			}
		}
		return $ret;	
	}

	public function getProgressBadge($badgeName) {
		if(isset($this->progressBadges[$badgeName]) && $this->progressBadges[$badgeName]) {
			if (!is_a($this->progressBadges[$badgeName], 'ProgressionBadge')) {
				$className = $this->generateClassName($badgeName). "ProgressionBadge";
				$this->progressBadges[$badgeName] = new $className();
			}
			return $this->progressBadges[$badgeName];
		}
		return false;
	}

	public function addBadge($badgeName) {
		if(isset($this->badges[$badgeName]) && $this->badges[$badgeName]) {
			$badge = $this->getBadge($badgeName)->addBadge();
			return true;
		}
		return false;
	}

	public function getBadgesList() {
		$ret = [];
		foreach ($this->badges as $badgeName => $badge) {
			if($badge) {
				$ret[$badgeName] = $this->getBadge($badgeName);
			}
		}
		return $ret;		
	}

	public function getBadge($badgeName) {
		if(isset($this->badges[$badgeName]) && $this->badges[$badgeName]) {
			if(!is_a($this->badges[$badgeName], 'Badge')) {
				$className = $this->generateClassName($badgeName). "Badge";
				$this->badges[$badgeName] = new $className();
			}
			return $this->badges[$badgeName];
		}
		return false;
	}

	public function getKarmaEarn() {
		if(!is_a($this->karmaEarn, 'P\ProgressionBadge')) {
			
			$className = $this->generateClassName('karma_earn');
			$this->karmaEarn = new $className();
		}
		return $this->karmaEarn;	
	}

	public function getMedalsList() {
		$ret = [];
		foreach ($this->medals as $medalName => $medal) {
			if($medal) {
				$ret[$medalName] = $this->getMedal($medalName);
			}
		}
		return $ret;
	}

	public function getMedal($medalName) {
		if(isset($this->medals[$medalName]) && $this->medals[$medalName]) {
			if(!is_a($this->medals[$medalName], 'Medal')) {
				$className = $this->generateClassName($medalName). "Medal";
				$this->medals[$medalName] = new $className();
			}
			return $this->medals[$medalName];
		}
		return false;
	}

	public function getTotal() {
		$total = 0;
		foreach ($this->medals as $medal) {
			if(is_a($medal, 'Medal')) {
				$total += $medal->total;
			}
		}

		foreach ($this->progressBadges as $badge) {
			if(is_a($badge, 'ProgressionBadge')) {
				$total += $badge->current_rank;
			}
		}

		foreach ($this->badges as $badge) {
			if(is_a($badge, 'Badge') && $badge->earned) {
				$total += 1;
			}
		}
		return $total;	
	}

	public function generateClassName($badgeName) {
		$aux = str_replace('_', ' ', $badgeName);
		$aux = ucwords($aux);
		$className = str_replace(' ', '', $aux);
		return $className;
	}
}