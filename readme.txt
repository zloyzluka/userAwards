User awards is protected property of user object, which has methods getAwards() and saveAwards().
getAwards get data form DB (in my case it was Redis) and create instance of UserAwadrs uses AwardsData::setData(), saveAwards get string via AwardsData::setData() and put it in DB. 
example 

	public function getAwards($force = false) {
		if(empty($this->_awards) || !($this->_awards instanceof UserAwards)) {
			$awardsKey = 'user:'.$this->id.':awards';
			$awards = $redis->get($awardsKey);
			if($awards && !$force) {
				$userAwards = new UserAwards();
				$this->_awards = AwardsMigrations::setData(unserialize($awards), $userAwards);
			} else { 
				$this->_awards = new UserAwards();
				$this->saveAwards();	
			}
		}
		return $this->_awards;
	}

	public function saveAwards(){
		if($this->_awards instanceof UserAwards) {
			$ctrl = ctrl();
			$awardsKey = 'user:'.$this->id.':awards';
			$awards = $ctrl->redis->set($awardsKey, serialize(AwardsMigrations::getData($this->_awards)));
			return true;
		}
		return false;	
	}

adding award to user

	$userAwards = $user->getAwards();
	$userAwards->getProgressBadge('voiter')->inc();
	$userAwards->getMedal($medal_name)->add($rank);
	$user->saveAwards();