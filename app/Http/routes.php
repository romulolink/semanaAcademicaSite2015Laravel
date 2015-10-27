<?php



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
Route::get('/', function (SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
    
    
    $token = Session::get('fb_user_access_token');
    $fb->setDefaultAccessToken($token);
    
    try {
        // Requires the "read_stream" permission
        $response = $fb->get('/me/feed?fields=id,message&limit=5');
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    
    // Returns a `Facebook\FacebookResponse` object
    $responseUser = $fb->get('/me?fields=id,name,email');
    
    // Page 1
    $feedEdge = $response->getGraphEdge();
    
    
    // Get the base class GraphNode from the response
    $graphNode = $responseUser->getGraphNode();
    
    // Get the response typed as a GraphUser
    $user = $responseUser->getGraphUser();
    
    
    $nome = $graphNode->getField('name'); // From GraphUser
    

    // Page 2 (next 5 results)
    $nextFeed = $fb->next($feedEdge);
    
    return view('welcome',[
            'name' => $nome,
            'feeds' => $feedEdge
            
    ]);
}); */

Route::get('palestras/', 'API\PalestraController@mostrar');


Route::get('palestra/{id}', 'API\PalestraController@index');


Route::get('/', function() {
        return View::make('index'); // app/views/index.php
    });


// Restfull
Route::resource('palestraAPI', 'API\PalestraController');

Route::get('palestra/{id}/islikedbyme', 'API\PalestraController@isLikedByMe');
Route::post('palestra/like', 'API\PalestraController@like');



// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'App\Http\Controllers\FacebookController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');



// Generate a login URL
Route::get('/facebook/login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
{
    // Send an array of permissions to request
    $login_url = $fb->getLoginUrl(['email','publish_actions', 'user_posts']);

    // Obviously you'd do this in blade :)
   // echo '<a href="' . $login_url . '">Login with Facebook</a>';


    return view('login',[
    		'login_url' =>$login_url,

    		
    ]);


});

// Endpoint that is redirected to after an authentication attempt
Route::get('/facebook/callback', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
{
    // Obtain an access token.
    try {
        $token = $fb->getAccessTokenFromRedirect();
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        dd($e->getMessage());
    }

    // Access token will be null if the user denied the request
    // or if someone just hit this URL outside of the OAuth flow.
    if (! $token) {
        // Get the redirect helper
        $helper = $fb->getRedirectLoginHelper();

        if (! $helper->getError()) {
            abort(403, 'Unauthorized action.');
        }

        // User denied the request
        dd(
            $helper->getError(),
            $helper->getErrorCode(),
            $helper->getErrorReason(),
            $helper->getErrorDescription()
        );
    }

    if (! $token->isLongLived()) {
        // OAuth 2.0 client handler
        $oauth_client = $fb->getOAuth2Client();

        // Extend the access token.
        try {
            $token = $oauth_client->getLongLivedAccessToken($token);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
    }

    $fb->setDefaultAccessToken($token);

    // Save for later
    Session::put('fb_user_access_token', (string) $token);

    // Get basic info on the user from Facebook.
    try {
        $response = $fb->get('/me?fields=id,name,email');
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        dd($e->getMessage());
    }

    // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
    $facebook_user = $response->getGraphUser();

    // Create the user if it does not exist or update the existing entry.
    // This will only work if you've added the SyncableGraphNodeTrait to your User model.
    $user = App\UserImproved::createOrUpdateGraphNode($facebook_user);

    // Log the user into Laravel
    Auth::login($user);

    return redirect('/')->with('message', 'Logado com sucesso usando o Facebook');
});




Route::get('facebook/session', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb){
	
	$token = Session::get('facebook_access_token');
	$fb->setDefaultAccessToken($token);
	
	if (! $token) {
	
		return redirect('/')->with('message', 'Token obtido com sucesso!');
	
	}
		
});


