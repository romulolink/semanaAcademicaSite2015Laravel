<?php
use SammyK\LaravelFacebookSdk\SyncableGraphNodeTrait;

class Event extends Eloquent
{
	use SyncableGraphNodeTrait;

	protected static $graph_node_fillable_fields = ['id', 'name', 'start_time'];
}