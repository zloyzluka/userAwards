<?php
class AwardsData {
	
	public static function setData($currentAwards, userAwards $newAwards) {

		$medals = $currentAwards['medals'];

		foreach ($medals as $medalName => $val) {
			if($newAwards->getMedal($medalName)) {
				foreach($val as $type => $count) {
					if($count > 0) {
						$newAwards->getMedal($medalName)->set($type, $count, true);
					}	
				}		
			}
		}

		$badges = $currentAwards['badge'];	
		foreach ($badges as $badgeName => $val) {
			if($val) {
				$newAwards->addBadge($badgeName, true);
			}
		}
		
		$badges = $currentAwards['progressBadge'];
		foreach ($badges as $badgeName => $val) {
			if($val && ($progressBadge = $newAwards->getProgressBadge($badgeName))) {
				$progressBadge->setScore($val, true);
			}
		}
		
		return $newAwards;
	} 

	public function getData(userAwards $currentAwards) {
		$ret = [];
		$medals = $currentAwards->getMedalsList();
		foreach ($medals as $medalName => $val) {
			if(is_a($val, 'Medal')) {
				foreach($val->ranks as $rank => $name) {
					$count = $val->{$name};
					if($count > 0) {
					$ret['medals'][$medalName][$name] = $val->{$name};	
					}	
				}		
			}
		}

		$badges = $currentAwards->getBadgesList();		
		foreach ($badges as $badgeName => $val) {
			if(is_a($val, 'Badge') && $val->earned) {
				$ret['badge'][$badgeName] = true;	
			}
		}
		
		$progressBadges = $currentAwards->getProgressBadgesList();
		foreach ($progressBadges as $badgeName => $val) {
			if(is_a($val, 'ProgressionBadge')) {
				$ret['progressBadge'][$badgeName] = $val->current_score;
			}
		}

		return $ret;
	}
}