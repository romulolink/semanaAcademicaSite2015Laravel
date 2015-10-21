<?php
namespace App;
use SammyK\LaravelFacebookSdk\SyncableGraphNodeTrait;

class UserImproved extends User {
	use SyncableGraphNodeTrait;
	
	
	protected $hidden = ['access_token'];

	protected static $graph_node_field_aliases = [
			'id' => 'facebook_user_id',
	];
}