<?php 
class CommentsProgressionBadge extends ProgressionBadge {

	protected $title = 'Feedback champ';
	protected $description = 'comments posted';

	protected $progress_list = [
		'0' => 0,
		'1' => 1,
		'2' => 25,
		'3' => 100,
		'4' => 500,
		'5' => 1000,
	];

	protected $ico = 'feedback';
}