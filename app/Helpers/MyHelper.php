<?php

use App\Models\Watchlist;
use App\Models\UsersUserRole;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Chat;
use App\Models\Plan;
use App\Models\UserTypePermission;
use App\Models\UserSubscription;
use App\Models\User;
use App\Helpers\UtilitiesFour;

use App\Models\Role;

use Illuminate\Support\Facades\Auth;

if (!function_exists('check_watch_list')) {
    function check_watch_list($type, $value)
    {
        $user = get_current_user_info();
        return Watchlist::where([
            'user_id' => $user->id,
            'type' => $type,
            'value_id' => $value
        ])
        ->first();
    }
}
    
function users_user_roles( ){
    return $users_user_roles = UsersUserRole::orderBy('role_name')->pluck('role_name','id');
}

function category( ){
    return $category = Category::pluck('category_name', 'id');
}

function plan_name($plan_id ){
	
	if(!empty($plan_id))
	{
      return $plan_name = Plan::where('id',@$plan_id)->first()->name;
	}
	else
	{
	  return '';	
	}
}

function category_byID( $id ){
    if(empty($id)){
        return 'Category';
    }
    $category = Category::select('category_name')->where('id', $id)->first();
    $category_name = (isset($category->category_name)) ? $category->category_name : 'Category' ;
    return $category_name;
}

function sub_category( ){
    return $category = SubCategory::pluck('sub_category', 'id');
}

function get_month($monthNum){
    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
    //return $monthName = $dateObj->format('M'); // March
	return $monthName = $dateObj->format('F');
	
}

function sub_category_byID( $id ){
    if(empty($id)){
        return 'No Sub Category';
    }
    $category = SubCategory::select('sub_category')->where('id', $id)->first();
    return $category->sub_category;
}

function sub_categoryByCategoryID($id = 1){
    $category = SubCategory::where('category_id', $id)->pluck('sub_category', 'id');
    return $category;
    return $category = SubCategory::pluck('sub_category', 'id');
}

function GetInnovatorRoles($id){
    if(!empty($id) ){
        $roles = Role::where('user_id' , $id)->get();
        if(!empty($roles) && count($roles))
        {
            $role_name = [];
            foreach ($roles as $key => $value) {
                if(isset($value->user_role_name) && !empty($value->user_role_name)){
                    foreach ($value->user_role_name as $k => $v) {
                        $role_name[]    = $v->role_name;
                    }
                }
            }
            return implode(', ', $role_name) ;
        }
        
    }
    return 'No Role';
}

function GetRoleType($id){
    if(!empty($id) ){
        $roles =    DB::table('user_subscriptions')
                    ->join('plans','plans.id', '=', 'user_subscriptions.plan_id')
                    ->select('plans.name')
                    ->where('user_subscriptions.user_id' , $id)->first();
        if(!empty($roles))
        {
            return $roles->name;
        }
        
    }
    return 'POP LITE';
}

function getSubscription($id){
    if(!empty($id) ){
        $subs = UserSubscription::where('user_id',$id)->orderBy('id','desc')->first();
        if(!empty($subs))
        {
            return $subs->stripe_subscription_id;
        }
        
    }
    return 'test';
}

function getUserDataBySlug()
{
	
	$myRequest = new \Illuminate\Http\Request();
	$current_url_new = URL::current();
	
	$link_array = explode('/', $current_url_new);
    $slug_page = end($link_array);
	
	$is_profile_page_flag =  UtilitiesFour::is_profile_page_flag($myRequest, $current_url_new);
	
	if(!empty($is_profile_page_flag))
	{
           $query = User::select('users.id','users.type_of_user','users.role');
			
			//$query->leftJoin('user_socia
		
			if (!empty($slug_page)) {
				$query->where('users.slug', $slug_page);	
			}
						
			//$query->groupBy('user_social_media.type');			
			$user = @$query->firstOrFail();
			
			return $user;
	}
    else
	{
		    return 0;
	}		
}

function have_permission($permission){
    
	$data_slug_user = getUserDataBySlug();
	
	$current_user = get_current_user_info();
    
	// for a currently logged in user
	if(!empty($data_slug_user) && !empty($current_user) && ($data_slug_user->id == $current_user->id))
	{
		return true;
	}
	else
	{
		if(isset($current_user->type_of_user) )
		{
			$UserTypePermission = UserTypePermission::where('user_type_id', '=', $current_user->type_of_user)->pluck('permission')->toArray();
			if(in_array($permission, $UserTypePermission)){
				return true;
			} else {
				return false;
			}
		}
		else {
			return false;
		}
	}
}

function unrerad_message(){
    
    $user_id    = Auth::guard('users')->user()->id;
    $count      = 0;
    $messages   = Chat::where('IsRead',0)
                ->where(
                    function ($query) use ($user_id)
                    { $query->where('sender', '=', $user_id)
                        ->orWhere('receiver', '=', $user_id);
                    })
                ->get();

        if(!empty($messages))
            {
                foreach ($messages as $key => $value) {
                    if($value->receiver == $user_id){
                        $count = $count + 1;
                    }
                }
            }
    return $count;

}

function pr( $data, $die = false ){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    if( $die ) die;
}

function GetYoutubeAPI($url='')
{
	
    if(strpos($url, '?v=')>0)
	{	
       $video = explode('?v=', $url); 
	}
	
	if(strpos($url, 'youtu.be/')>0)
	{	
       $video = explode('youtu.be/', $url); 
	}
	
     //pr($video,1);

    if(isset($video['1']) && !empty($video['1'])){
        $vID = $video['1'];
        //$apikey = env('YOUTUBE_KEY_NEW'); // change this
        $apikey = 'AIzaSyDzAD0RBG_sRf5UduwOHzhwE4V49mCfHnw';
		
		$thumbnail_base = 'https://i.ytimg.com/vi/';

        $get_URL = $url =  'https://www.googleapis.com/youtube/v3/videos?id='.trim($vID).'&key='.trim($apikey).'&part=contentDetails&part=snippet';
        // pr($get_URL);
        // $get_URL = str_replace('&amp;','&', $get_URL);
        // pr($get_URL);



        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        //   echo "<pre>"; print_r($ch); die;
        curl_close($ch);


        // $options = array(
        //     "http"=>array(
        //         "header"=>"User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.102011-10-16 20:23:10\r\n" // i.e. An iPad
        //     )
        // );

        // $context = stream_context_create($options);
        // $json = file_get_contents($get_URL, false, $context);
        // var_dump($json);

        // $json = file_get_contents($get_URL);
        $data = json_decode($json, true);
        // pr($json,1);

        if (isset($data['items']) && !empty($data['items'])) {
            foreach ($data['items'] as $vidTime) {
                $vTime      = $vidTime['contentDetails']['duration'];
                $title      = $vidTime['snippet']['title'];
                $description= $vidTime['snippet']['description'];

                $vinfo['thumbnail']['default']       = $vidTime['snippet']['thumbnails']['default']['url'];
                $vinfo['thumbnail']['medium']        = $vidTime['snippet']['thumbnails']['medium']['url'];
                $vinfo['thumbnail']['high']          = $vidTime['snippet']['thumbnails']['high']['url'];

                if(isset($vidTime['snippet']['thumbnails']['standard']['url'])){
                    $vinfo['thumbnail']['standard']      = $vidTime['snippet']['thumbnails']['standard']['url'];
                } else {
                    $vinfo['thumbnail']['standard']      = $vidTime['snippet']['thumbnails']['default']['url'];
                }
                if(isset($vidTime['snippet']['thumbnails']['maxres']['url'])){
                    $vinfo['thumbnail']['maxres']      = $vidTime['snippet']['thumbnails']['maxres']['url'];
                } else {
                    $vinfo['thumbnail']['maxres']      = $vidTime['snippet']['thumbnails']['default']['url'];
                }


                if(isset($vidTime['snippet']['thumbnails']['maxres']['url'])) {
                    $vinfo['thumbnail']['thumb']      = $vidTime['snippet']['thumbnails']['maxres']['url'];
                } else if(isset($vidTime['snippet']['thumbnails']['high']['url'])) {
                    $vinfo['thumbnail']['thumb']      = $vidTime['snippet']['thumbnails']['high']['url'];
                } else if(isset($vidTime['snippet']['thumbnails']['standard']['url'])) {
                    $vinfo['thumbnail']['thumb']      = $vidTime['snippet']['thumbnails']['standard']['url'];
                } else if(isset($vidTime['snippet']['thumbnails']['medium']['url'])) {
                    $vinfo['thumbnail']['thumb']      = $vidTime['snippet']['thumbnails']['medium']['url'];
                } else {
                    $vinfo['thumbnail']['thumb']      = $vidTime['snippet']['thumbnails']['default']['url'];
                }
            }
        }
        else{
            return ;
        }
        $interval = new DateInterval($vTime);
        $time = '';
        if(!empty($interval->h)){
            $time .= $interval->h.':';
        } 
        if(!empty($interval->i)){
            $time .= $interval->i.':';
        } else {
            $time .= '00:';
        }
        if(!empty($interval->s)){
            $time .= $interval->s;
        } else {
            $time .= '00';
        }

        $vinfo['duration']      = $time;
        $vinfo['title']         = $title;
        $vinfo['description']   = $description;

        // $vinfo['thumbnail']['default']       = $thumbnail_base . $vID . '/default.jpg';
        // $vinfo['thumbnail']['mqDefault']     = $thumbnail_base . $vID . '/mqdefault.jpg';
        // $vinfo['thumbnail']['hqDefault']     = $thumbnail_base . $vID . '/hqdefault.jpg';
        // $vinfo['thumbnail']['sdDefault']     = $thumbnail_base . $vID . '/sddefault.jpg';
        // echo $vinfo['thumbnail']['maxresDefault'] = $thumbnail_base . $vID . '/maxresdefault.jpg';

        return $vinfo;
    }
}

if (!function_exists('get_reset_password_link')) {
    function get_reset_password_link($user_id)
    {
        return url('/reset-password') . '/' . encrypt($user_id);
    }
}


if (!function_exists('get_current_user_info')) {
    function get_current_user_info()
    {
        return \Illuminate\Support\Facades\Auth::guard('users')->user();
    }
}

if (!function_exists('array_from_post')) {
    function arrayFromPost($request, $fieldArr = [])
    {
        $output = new \stdClass;
        if (count($fieldArr)) {
            foreach ($fieldArr as $value) {
                $output->$value = $request->input($value);
            }
        }
        return $output;
    }
}

if (!function_exists('transLang')) {
    function transLang($template = '')
    {
        $output = '';
        if (!empty($template)) {
            $output = trans("messages.{$template}");
        }
        return $output;
    }
}

if (!function_exists('adminTransLang')) {
    function adminTransLang($template = '', $locale = 'ar')
    {
        $output = '';
        if (!empty($template)) {
            if (\Auth::guard('admin')->check()) {
                $user = \Auth::guard('admin')->user();
                !$user->locale || $locale = $user->locale;
            }

            \App::setLocale($locale);
            $output = trans((count(explode('.', $template)) > 1 ? $template : "messages.{$template}"));
        }
        return $output;
    }
}

// Start FCM fns
if (!function_exists('deleteFCMToken')) {
    function deleteFCMToken($device_id = false, $table = 'user_fcm_tokens')
    {
        if ($device_id) {
            return \DB::table($table)->where('device_id', $device_id)->delete();
        }
        return false;
    }
}

if (!function_exists('getUserFCMToken')) {
    function getUserFCMToken($user_id = false, $device_id = false)
    {
        $output = new \stdClass;
        if ($user_id && $device_id) {
            $output = \App\Models\UserFcmToken::where('user_id', '=', $user_id)
                ->where('device_id', '=', $device_id)
                ->first();
        }
        return $output;
    }
}

if (!function_exists('updateFCMToken')) {
    function updateFCMToken($dataArr = null, $id = false)
    {
        $userFcmToken = new \stdClass;
        if ($dataArr == null) {
            return [
                'status' => 0,
                'msg' => transLang('invalid_data_processed'),
                'errors' => ['error' => [transLang('invalid_data_processed')]]
            ];
        }

        if ($id) {
            $userFcmToken = \App\Models\UserFcmToken::find($id);
            if ($userFcmToken != null) {
                $userFcmToken->user_id = $dataArr->user_id;
                $userFcmToken->locale = $dataArr->locale;
                $userFcmToken->fcm_id = $dataArr->fcm_id;
                $userFcmToken->device_id = $dataArr->device_id;
                $userFcmToken->device_type = $dataArr->device_type;
                $userFcmToken->sound_key = $dataArr->sound_key ? $dataArr->sound_key : 'default';
                $userFcmToken->vibrate = $dataArr->vibrate !== 0 ? $dataArr->vibrate : '1';
                $userFcmToken->app_sound = $dataArr->app_sound !== 0 ? $dataArr->app_sound : '1';
                $userFcmToken->save();
            } else {
                $userFcmToken = new \App\Models\UserFcmToken();
                $userFcmToken->user_id = $dataArr->user_id;
                $userFcmToken->locale = $dataArr->locale;
                $userFcmToken->fcm_id = $dataArr->fcm_id;
                $userFcmToken->device_id = $dataArr->device_id;
                $userFcmToken->device_type = $dataArr->device_type;
                $userFcmToken->sound_key = $dataArr->sound_key ? $dataArr->sound_key : 'default';
                $userFcmToken->vibrate = $dataArr->vibrate !== 0 ? $dataArr->vibrate : '1';
                $userFcmToken->app_sound = $dataArr->app_sound !== 0 ? $dataArr->app_sound : '1';
                $userFcmToken->save();
            }
        } else {
            $response = \App\Models\UserFcmToken::where('device_id', '=', $dataArr->device_id)->first();
            if ($response != null) {
                $userFcmToken = \App\Models\UserFcmToken::find($response->id);
                if ($userFcmToken != null) {
                    $userFcmToken->user_id = $dataArr->user_id;
                    $userFcmToken->locale = $dataArr->locale;
                    $userFcmToken->fcm_id = $dataArr->fcm_id;
                    $userFcmToken->device_id = $dataArr->device_id;
                    $userFcmToken->device_type = $dataArr->device_type;
                    $userFcmToken->sound_key = $dataArr->sound_key ? $dataArr->sound_key : 'default';
                    $userFcmToken->vibrate = $dataArr->vibrate !== 0 ? $dataArr->vibrate : '1';
                    $userFcmToken->app_sound = $dataArr->app_sound !== 0 ? $dataArr->app_sound : '1';
                    $userFcmToken->save();
                }
            } else {
                $userFcmToken = new \App\Models\UserFcmToken();
                $userFcmToken->user_id = $dataArr->user_id;
                $userFcmToken->locale = $dataArr->locale;
                $userFcmToken->fcm_id = $dataArr->fcm_id;
                $userFcmToken->device_id = $dataArr->device_id;
                $userFcmToken->device_type = $dataArr->device_type;
                $userFcmToken->sound_key = $dataArr->sound_key ? $dataArr->sound_key : 'default';
                $userFcmToken->vibrate = $dataArr->vibrate !== 0 ? $dataArr->vibrate : '1';
                $userFcmToken->app_sound = $dataArr->app_sound !== 0 ? $dataArr->app_sound : '1';
                $userFcmToken->save();
            }
        }

        return [
            'status' => 1,
            'data' => $userFcmToken
        ];
    }
}
// End FCM fns

if (!function_exists('sendPushNotification')) {
    function sendPushNotification($fcm_id = [], $dataArr = [])
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $api_key = config('cms.fcm_legacy_key');

        $notification = [
            'title' => isset($dataArr['title']) ? $dataArr['title'] : '',
            'body' => $dataArr['body'],
            'notification_type' => $dataArr['notification_type'],
            'notification_to' => $dataArr['notification_to'],
        ];

        $arrayToSend = [
            'registration_ids' => is_array($fcm_id) ? $fcm_id : [$fcm_id],
            'priority' => "high",
            'notification' => $notification,
            'data' => $notification,
        ];

        $headers = [
            'Content-Type:application/json',
            'Authorization:key=' . $api_key,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayToSend));

        $result = curl_exec($ch);
        if ($result === false) {
            $result = curl_error($ch);
        }
        curl_close($ch);

        return $result;
    }
}

if (!function_exists('generateOtp')) {
    function generateOtp()
    {
        return 1234;
        return rand(1000, 9999);
    }
}

if (!function_exists('sendOtpToUser')) {
    function sendOtpToUser($user_id = false)
    {
        $user = \App\Models\User::find($user_id);
        if ($user != null) {
            $otp = generateOtp();
            $user->otp = $otp;
            $user->otp_generated_at = date('Y-m-d H:i:s');
            $user->save();

            // sendOtp($user->mobile, $user->otp);
            return $user->otp;
        }
        return false;
    }
}

if (!function_exists('sendOtp')) {
    function sendOtp($mobile = false, $otp = false)
    {
        $ar_message = "يرجى استخدام {$otp} المدعي العام كمكتب المدعي العام للتحقق من رقم هاتفك النقال.";
        $url = 'http://www.kingsms.ws/api/sendsms.php?username=services&password=abcdef';
        $url .= '&message=' . urlencode($ar_message);
        $url .= '&numbers=' . urlencode($mobile);
        $url .= '&sender=S-Booking';
        $url .= '&unicode=e';
        $url .= '&return=xml';
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        if ($result === false) {
            throw new Exception(curl_error($ch), curl_errno($ch));
        }
        curl_close($ch);
        return json_decode(json_encode(simplexml_load_string($result)));
    }
}

if (!function_exists('getLocales')) {
    function getLocales($send_array = true)
    {
        return ['en', 'ar'];
    }
}

if (!function_exists('processUserResponseData')) {
    function processUserResponseData($user_id = false, $device_id = false, $user = null)
    {
        $output = new \stdClass;
        if ($user_id || $user) {
            $user = $user == null ? \App\Models\User::find($user_id) : $user;

            if ($user != null) {
                $fcmData = new \stdClass();
                if ($device_id) {
                    $fcmData = getUserFCMToken($user->id, $device_id);
                }

                unset($user->password, $user->otp, $user->otp_generated_at, $user->is_deleted);

                $user->fcmData = $fcmData;

                $output = $user;
            }
        }
        return $output;
    }
}

if (!function_exists('successMessage')) {
    function successMessage($template, $dataArr = null, $httpCode = 200)
    {
        $output = new \stdClass;
        $output->message = $template;
        if ($dataArr != null) {
            $output->data = $dataArr;
        }
        return response()->json($output, $httpCode);
    }
}

if (!function_exists('errorMessage')) {
    function errorMessage($template = '', $string = false)
    {
        $validator = \Validator::make([], []); // Empty data and rules fields
        $validator->errors()->add('error', $string == true ? $template : transLang($template));
        throw new \Illuminate\Validation\ValidationException($validator);
    }
}

if (!function_exists('errorMessage_new')) {
    function errorMessage_new($error_msg = '', $string = false)
    {
		$message_new = ['msg' => $error_msg];
		return response()->json($message_new, 422);
    }
}

if (!function_exists('generateFilename')) {
    function generateFilename()
    {
        return str_replace([' ', ':', '-'], '', \Carbon\Carbon::now()->toDateTimeString()) . generateRandomString(10, 'lower_case,upper_case,numbers');
    }
}

if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 6, $characters = 'upper_case,numbers')
    {
        // $length - the length of the generated password
        // $count - number of passwords to be generated
        // $characters - types of characters to be used in the password

        // define variables used within the function
        $symbols = array();
        $passwords = array();
        $used_symbols = '';
        $pass = '';

        // an array of different character types
        $symbols['lower_case'] = 'abcdefghijklmnopqrstuvwxyz';
        $symbols['upper_case'] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $symbols['numbers'] = '1234567890';
        $symbols['special_symbols'] = '!?~@#-_+<>[]{}';

        $characters = explode(',', $characters); // get characters types to be used for the password
        foreach ($characters as $key => $value) {
            $used_symbols .= $symbols[$value]; // build a string with all characters
        }
        $symbols_length = strlen($used_symbols) - 1; //strlen starts from 0 so to get number of characters deduct 1

        for ($p = 0; $p < 1; ++$p) {
            $pass = '';
            for ($i = 0; $i < $length; ++$i) {
                $n = rand(0, $symbols_length); // get a random character from the string with all characters
                $pass .= $used_symbols[$n]; // add the character to the password string
            }
            $passwords = $pass;
        }

        return $passwords; // return the generated password
    }
}

if (!function_exists('getTimeDiff')) {
    function getTimeDiff($input = '')
    {
        return $input ? \Carbon::createFromTimeStamp(strtotime($input))->diffForHumans() : '';
    }
}

if (!function_exists('formatDateTime')) {
    function formatDateTime($input = '', $to_format = 'Y-m-d H:i:s', $from_format = 'Y-m-d H:i:s')
    {
        return $input ? \Carbon::createFromFormat($from_format, $input)->format($to_format) : '';
    }
}

if (!function_exists('calculateUserRating')) {
    function calculateUserRating($table = false, $user_id = false, $total_voters = false)
    {
        if (!$table || !$user_id) {
            return 0;
        }

        $voters = $rating = 0;
        $response = \DB::table($table)->select(\DB::raw('COUNT(*) AS total, SUM(rating) AS rating'))
            ->where('user_id', $user_id)
            ->first();
        if ($response != null) {
            $voters = $response->total;
            $rating = ($response->rating) ? round($response->rating / $response->total, 1) : 0;
        }

        if ($total_voters == true) {
            return (object) ['voters' => $voters, 'rating' => $rating];
        }

        return $rating;
    }
}

if (!function_exists('filterMobileNo')) {
    function filterMobileNo($mobile = null, $dial_code = null)
    {
        if (!$mobile || !$dial_code) {
            return '';
        }

        $mobile = str_replace('+', '', $mobile);
        if (substr($mobile, 0, strlen($dial_code)) === $dial_code) {
            $mobile = substr($mobile, strlen($dial_code));
        } elseif (substr($mobile, 0, 1) == "0") {
            $mobile = substr($mobile, 1);
        }

        return $mobile;
    }
}

if (!function_exists('checkFileExistOnS3')) {
    function checkFileExistOnS3($file_path = null)
    {
        return true;

        $s3 = \Storage::disk('s3');
        return $s3->exists($file_path);
    }
}

if (!function_exists('generateThumbnail')) {
    function generateThumbnail($file = null, $file_path = 'themeParksThumbImagePath', $frame = 10)
    {
        try {
            $randomString = random_int(0, PHP_INT_MAX) . strtotime(now());
            $thumbnail = "{$randomString}.png";
            $thumbnail_path = imagePath($thumbnail, $file_path);

            $extC = pathinfo($file, PATHINFO_EXTENSION);
            if ($extC == 'mov') {
                exec("ffmpeg -i {$file} -c:v libx264 -c:a aac -strict experimental {$thumbnail_path}");
            } else {
                exec("ffmpeg -i {$file} -vcodec h264 -acodec aac -strict -2 {$thumbnail_path}");
            }
            exec("ffmpeg  -i {$file} -deinterlace -an -ss 2 -f mjpeg -t 1 -r 1 -y -s 400x300 {$thumbnail_path} 2>&1");

            return $thumbnail;
        } catch (\Exception $e) {
            return '';
        }
    }
}

if (!function_exists('uploadFile')) {
    function uploadFile($filename = false, $type = 'image', $cdn = false)
    {
        $randomString = random_int(0, PHP_INT_MAX) . strtotime(now());

        if ($cdn == true) {
            $s3 = \Storage::disk('s3');
        }

        if (\Input::hasFile($filename)) {
            $mediaFile = \Input::file($filename);
            $filename = $randomString . '.' . $mediaFile->getClientOriginalExtension();
            if ($type == 'image') {
                if ($cdn == true) {
                    $imagePath = imagePath($filename);
                    $response = $s3->put($imagePath, file_get_contents($mediaFile), 'public');
                } else {
                    $file_path = \MyHelpers::imagePath();
                    $response = $mediaFile->move($file_path, $filename);
                }
                if ($response) {
                    return $filename;
                }
            }

            if ($type == 'video') {
                if ($cdn == true) {
                    $videoPath = videoPath($filename);
                    $response = $s3->put($videoPath, file_get_contents($mediaFile), 'public');
                } else {
                    $videoPath = \MyHelpers::videoPath();
                    $response = $mediaFile->move($videoPath, $filename);
                }
                if ($response) {
                    return $filename;
                }
            }
        }

        if ($type == 'thumbnail') {
            $videoFilePath = cdn_link(videoPath($filename));
            $thumbnail_image = $randomString . '.jpg';
            $imagePath = imagePath($thumbnail_image);
            $extC = pathinfo($videoFilePath, PATHINFO_EXTENSION);
            if ($extC == 'mov') {
                exec("ffmpeg -i {$videoFilePath} -c:v libx264 -c:a aac -strict experimental {$imagePath}");
            } else {
                exec("ffmpeg -i {$videoFilePath} -vcodec h264 -acodec aac -strict -2 {$imagePath}");
            }
            exec("ffmpeg  -i {$videoFilePath} -deinterlace -an -ss 2 -f mjpeg -t 1 -r 1 -y -s 400x300 {$imagePath} 2>&1");
            if ($cdn == true) {
                $mediaFile = public_path($imagePath);
                $response = $s3->put($imagePath, file_get_contents($mediaFile), 'public');
            } else {
                $response = true;
            }
            if ($response) {
                if ($cdn == true) {
                    unlink($mediaFile);
                }
                return $thumbnail_image;
            }
        }
        return false;
    }
}

if (!function_exists('getTokenUser')) {
    function getTokenUser($request, $force_login = false)
    {
        $tokenUser = null;
        if ($headerAuth = $request->header('Authorization')) {
            if (!$tokenUser = \JWTAuth::parseToken()->authenticate()) {
                errorMessage('user_not_logged_in');
            }
        }
        if ($tokenUser == null && $force_login) {
            errorMessage('user_not_logged_in');
        }
        return $tokenUser;
    }
}
