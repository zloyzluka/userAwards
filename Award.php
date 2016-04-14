<?php 
abstract class Award {

	public function __get($name) {
		return $this->{$name};
	}
	
	protected function getNotificationMessage() {
		return sprintf($this->notification_template, $this->title, $this->current_rank);
	}

	protected function sendNotification($notification) {
		return false; // here should be notifications handler  
	}
}