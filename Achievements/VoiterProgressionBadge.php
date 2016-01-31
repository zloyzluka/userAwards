<?php 

class VoiterProgressionBadge extends ProgressionBadge {
	
	protected $title = 'Top voter';
	protected $description = 'suggestions voted on';

	protected $progress_list = [
		'0' => 0,
		'1' => 1,
		'2' => 75,
		'3' => 250,
		'4' => 1000,
		'5' => 2500,
	];

	protected $ico = 'voter';
}