<?php 
class InfluencerProgressionBadge extends ProgressionBadge {

	protected $title = 'Influencer';
	protected $description = 'suggestions posted';

	protected $progress_list = [
		'0' => 0,
		'1' => 1,
		'2' => 10,
		'3' => 100,
		'4' => 250,
		'5' => 500,
	];

	protected $ico = 'influencer';
}