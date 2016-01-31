<?php 

class KarmaProgressionBadge extends ProgressionBadge {

	protected $title = 'Karma';
	protected $description = 'total karma';

	protected $progress_list = [
		'0' => 0,
		'1' => 10,
		'2' => 75,
		'3' => 200,
		'4' => 500,
		'5' => 1000,
	];
	protected $ico = 'karma';
}