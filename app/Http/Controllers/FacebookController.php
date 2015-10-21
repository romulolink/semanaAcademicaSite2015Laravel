<?php

namespace App\Http\Controllers;

class FacebookController {
	public function getUserInfo(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
		try {
			$response = $fb->get('/me?fields=id,name,email');
		} catch (Facebook\Exceptions\FacebookSDKException $e) {
			dd($e->getMessage());
		}

		// Convert the response to a `Facebook/GraphNodes/GraphUser` collection
		$facebook_user = $response->getGraphUser();

		
		// Create the user if it does not exist or update the existing entry.
		// This will only work if you've added the SyncableGraphNodeTrait to your User model.
		$user = App\User::createOrUpdateGraphNode($facebook_user);

		// Log the user into Laravel
		Auth::login($user);
	}
}