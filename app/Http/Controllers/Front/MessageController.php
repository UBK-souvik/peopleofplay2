<?php

namespace App\Http\Controllers\Front;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesTwo;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Message;
use App\Models\Chat;

class MessageController extends ModuleController
{
	
	protected $_collaboratorPhotosFolder;
	/**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
	}

    public function index(Request $request ,$id='')
    {
        if(!empty($id)) {
          $uid = $id;  
        } else {
         $uid = (isset($request->uid) && !empty($request->uid)) ? $request->uid : '' ;
        }
      $user     = Auth::guard('users')->user();
        $user_id  = Auth::guard('users')->user()->id;
        // pre($user_id);
        // pre($uid);
        $messages   = Message::where(
                        function ($query) use ($user_id)
                        { $query->where('sender', '=', $user_id)
                            ->orWhere('receiver', '=', $user_id);
                        })
                    ->orderby('updated_at', 'desc')
              ->get();
        // pr($messages->toArray(),1);
        // pre($messages);

        $message_id = Message::where(
                        function ($query) use ($user_id,$uid)
                        { $query->where('sender', '=', $user_id)
                            ->Where('receiver', '=', $uid);
                        })
                ->orWhere(
                          function ($query) use ($user_id,$uid)
                          { $query->where('sender', '=', $uid)
                              ->Where('receiver', '=', $user_id);
                          })->first();
        // pre($message_id,1);

        if($uid && empty($message_id)) {
          $chats = array();
        } else {
          $retVal = (isset($messages[0]['id'])) ? $messages[0]['id'] : 0 ;
          $message_id = isset($message_id->id) ? $message_id->id : $retVal;
          // pre($message_id,1);

          $chats = Chat::where('message_id',$message_id)->get();
        }
        // if(count($chats) > 0)
        // {
        //     $unread_messages   = Chat::where('IsRead',0)
        //         ->where(
        //             function ($query) use ($user_id)
        //             { $query->where('sender', '=', $user_id)
        //                 ->orWhere('receiver', '=', $user_id);
        //             })
        //         ->get();

        //     if(!empty($unread_messages))
        //     {
        //         foreach ($unread_messages as $key => $value) {
        //             if($value->sender != $user_id){
        //                 $update_msg = Chat::find($value->id);
        //                 $update_msg->IsRead = 1;
        //                 $update_msg->save();
        //             }
        //         }
        //     }
        // }
        return view('front.user.message.index',compact('messages','message_id','chats','uid'));
    }

    public function SendMessage(Request $request)
    {	
    	$base_url = url('/');
        $user_current_user_info = User::find(get_current_user_info()->id);				
        $arr_menu_list = UtilitiesTwo::getMenuLinks($base_url, $user_current_user_info);				
        $str_profile_user_message = $arr_menu_list['profile_user_message'];
    	$postData = $request->all();
      
    	if($postData['receiver'] && $postData['sender'])
    	{
           
      
          $sender1 =  $postData['sender'];
          $receiver1 =  $postData['receiver'];
             $messageCheck = Message::where(
                        function ($query) use ($sender1,$receiver1 )
                        { $query->where('sender', '=', $sender1)
                            ->Where('receiver', '=', $receiver1);
                        })
                ->orWhere(
                          function ($query) use ($sender1,$receiver1)
                          { $query->where('sender', '=', $sender1)
                              ->Where('receiver', '=',$receiver1);
                          })->first();
                // echo "<pre>messageCheck - "; print_r($messageCheck); die;
                if(!empty($messageCheck)) {
                  $data = array(
                      'sender'  => $postData['sender'],
                      'receiver'  => $postData['receiver'],
                      'updated_at'  => date('Y-m-d H:i:s'),
                    );
                    // echo "<pre>data - "; print_r($data); die;
                 $message = Message::where(
                        function ($query) use ($sender1,$receiver1 )
                        { $query->where('sender', '=', $sender1)
                            ->Where('receiver', '=', $receiver1);
                        })
                ->orWhere(
                          function ($query) use ($sender1,$receiver1)
                          { $query->where('sender', '=', $sender1)
                              ->Where('receiver', '=',$receiver1);
                          })->update($data);
                   $message_id = $messageCheck->id;
                } else {

                  $where = ['id' => $postData['message_id']];
                    $data = array(
                      'sender'  => $postData['sender'],
                      'receiver'  => $postData['receiver'],
                      'updated_at'  => date('Y-m-d H:i:s'),
                    );
                   $message = Message::updateOrCreate($where,$data);
                   $message_id = $message->id;
                }

                

         
                // echo '<pre>message_id - '; print_r($message_id); die;
           // DB::table('message_new')->where(['sender'=> $postData['sender'],'receiver'])
               
	        $chat = new Chat();
	        $chat->message_id	= $message_id;
          $chat->user_id    = $postData['receiver'];
	        $chat->sender 		= $postData['sender'];
	        $chat->receiver 	= $postData['receiver'];
	        $chat->message 		= $postData['message'];
	        $chat->save();	


					// $obj_receiver_user = User::find($chat->receiver);
     //      $str_user_name = Utilities::getUserName($obj_receiver_user);						
     //      $str_sender_user_name = Utilities::getUserName($user_current_user_info);						
     //      $arr_data['email'] = @$obj_receiver_user->email;            
     //      $arr_data['name']  = @$str_user_name;						
     //      $arr_data['sender_name']  = @$str_sender_user_name;			
     //      $arr_data['message_data']  = @$chat->message;			
     //      $arr_data['message_link']  = @$str_profile_user_message;       
     //      $this->send_mail_by_phpmailer(trim($arr_data['email']), 'New Message', 'mail.invoice.new_message', $arr_data);

              $chats = Chat::leftJoin('users as ruser', 'ruser.id', '=', 'chats.receiver')->leftJoin('users as suser', 'suser.id', '=', 'chats.sender')->select('chats.*','ruser.first_name as rfname','ruser.last_name as rlname','ruser.profile_image as reciever_profile','suser.first_name as sfname','suser.last_name as slname','suser.profile_image as sender_profile')->where(['message_id'=>$message_id])->orderBy('chats.id','asc')->get();
              $sender_id  = Auth::guard('users')->user()->id;
              
            // return view('front.user.message.massage_box',compact('chats','sender_id'));
	          $view = view('front.user.message.massage_box',compact('chats','sender_id'))->render();
            return response()->json(['view' => $view, 'refresh_view' =>true]);
	        // toastr()->success('Message sent successfully!');
	        // return Redirect('user/message?uid='.$postData['receiver']);
	        // return Redirect('messenger?uid='.$id.'&tid='.$postData['tenant_id']);
	    }
	    //return Redirect('user/message');
    }

    public function ReadMessage(Request $request)
    {
        // echo '<pre>request - '; print_r($request->all()); die;

        $postData = $request->all();
        $user_id    = Auth::guard('users')->user()->id;

        $unread_messages   = Chat::where('IsRead',0)->where('message_id',$postData['message_id'])->get();
        if(count($unread_messages) > 0)
        {
            if(!empty($unread_messages))
            {
                foreach ($unread_messages as $key => $value) {
                    if($value->sender != $user_id){
                        $update_msg = Chat::find($value->id);
                        $update_msg->IsRead = 1;
                        $update_msg->save();
                    }
                }

            }
        }
        // return successMessage('Event created');
        return response()->json(['status'=>1]);
    }


    public function getMassageBox($id='',Request $request)
    {
      
      $user_id  = Auth::guard('users')->user()->id;
      if($id){
        $conversion = Message::where(
        function ($query) use ($user_id,$id)
        { $query->where('sender', '=', $user_id)
            ->Where('receiver', '=', $id);
        })
        ->orWhere(
          function ($query) use ($user_id,$id)
          { $query->where('sender', '=', $id)
              ->Where('receiver', '=', $user_id);
          })->first();
        
        if(!$conversion){
          $conv = new Message(); 
              $conv->sender = $user_id;
              $conv->receiver = $id;
              $conv->save();
        }
      }
      

       
        $recipientIdsNew = $senderIdsnew = array(); 
        $recipientIds = Message::select('receiver')->where('sender', $user_id)->get()->pluck('receiver');
        $senderIds = Message::select('sender')->where('receiver', $user_id)->get()->pluck('sender');
         foreach ($senderIds as $key => $value1) {
          $senderIdsnew[] =  $value1;
         }
         foreach ($recipientIds as $key2 => $value2) {
          $recipientIdsNew[] =  $value2;
         }
        $userIds = array_unique(array_merge($recipientIdsNew,$senderIdsnew));
       // echo '<pre>';print_r($userIds);die;
        $massage_users = User::whereIn('id', $userIds)->orderBy('id','desc')->get(['id','first_name','last_name','profile_image']);

        

        $total_massage = 0;
          foreach ($massage_users as $key => $row1) {
            $massage_id = $this->converstionChatsMsgId($row1->id);
            $total_massage_new = Chat::where('message_id',$massage_id)->count();
            $total_massage = $total_massage + $total_massage_new;
          }
       $totalMassage =  $total_massage;
      //Shubham Code//
       // $id = $request->uid;
        
      //Shubham Code//
      // $newUser ='';
      // if(!empty($id)) {
       // $newUser = User::where('id',$id)->first(['id','first_name','last_name','profile_image']);
      // }
    
      return view('front.user.message.index',compact('massage_users','totalMassage'));
    }


    public function postConvertionUser(Request $request)
    {
        $sender_id  = Auth::guard('users')->user()->id;
        $chats = Chat::leftJoin('users as ruser', 'ruser.id', '=', 'chats.receiver')->leftJoin('users as suser', 'suser.id', '=', 'chats.sender')->select('chats.*','ruser.first_name as rfname','ruser.last_name as rlname','ruser.profile_image as reciever_profile','suser.first_name as sfname','suser.last_name as slname','suser.profile_image as sender_profile')->where(['chats.message_id'=>$request->message_id])->orderBy('chats.id','asc')->get();

        // echo '<pre>chats - '; print_r($chats->toArray()); die;
        $view = '';
        $refresh_view = false;
        $totalMessage = $request->total_massage;
        if(count($chats) > $request->total_massage) {
          $refresh_view = true;
          $view = view('front.user.message.massage_box',compact('chats','sender_id'))->render();
          $totalMessage = $chats;  
        }elseif($request->is_click == 1){
          $refresh_view = true;
          $view = view('front.user.message.massage_box',compact('chats','sender_id'))->render();
          $totalMessage = $request->total_massage;
        }
        // echo $view; die;
         return response()->json(['view' => $view, 'refresh_view' => $refresh_view,'totalMessage'=>$totalMessage]);
    }

    public function messageSidebar(Request $request)
    {
        $massage_id = $request->mgs_id;
        $sender_id  = Auth::guard('users')->user()->id;
        $recipientIdsNew = $senderIdsnew = array(); 
        $recipientIds = Message::select('receiver')->where('sender', $sender_id)->get()->pluck('receiver');
        $senderIds = Message::select('sender')->where('receiver', $sender_id)->get()->pluck('sender');
         foreach ($senderIds as $key => $value1) {
          $senderIdsnew[] =  $value1;
         }
         foreach ($recipientIds as $key2 => $value2) {
          $recipientIdsNew[] =  $value2;
         }
        $userIds = array_unique(array_merge($recipientIdsNew,$senderIdsnew));
        $massage_users = User::whereIn('id', $userIds)->orderby('id', 'desc')->get(['id','first_name','last_name','profile_image']);

        $total_massage = 0;
        foreach ($massage_users as $key => $row1) {
           $msg_id = $this->converstionChatsMsgId($row1->id);
           $total_massage_new = Chat::where('message_id',$msg_id)->count();
           $total_massage = $total_massage + $total_massage_new;
        }
       $totalMassage =  $total_massage;
      //  echo '<pre>massage_users - '; print_r($massage_users->toArray()); die;
        $view = '';
        $sidebar = 'no';
        if($request->no_of_users > count($massage_users) || $request->total_massage < $totalMassage){
          $sidebar = "yes";
          $view =  view('front.user.message.massage_sidebar',compact('massage_users','massage_id','totalMassage'))->render();
        } 
        return response()->json(['view' => $view, 'sidebar' => $sidebar,'totalMassage'=>$totalMassage]);
    }
    

    public static function newMassage($massage_id='',$receiver_id)
    {
         $sender_id  = Auth::guard('users')->user()->id;
         $newMsg = Chat::join('users', 'users.id', '=', 'chats.receiver')->select('chats.*')->where(['message_id'=>$massage_id,'IsRead'=>0,'receiver'=>$sender_id])->count();
         if($newMsg >99) {
            return '<small class="badge badge-danger"> 99 +</small>';;  
         } elseif($newMsg >0 && $newMsg < 100) {
            return '<small class="badge badge-danger"> '.$newMsg.'</small>';
         }else {
            return '';
         }
    }

  public static function converstionChatsMsgId($user_id)
    {
        // echo "dsd"; die;
      $uid  = Auth::guard('users')->user()->id;
     // echo $receiver_id."==".  $user_id; die;
       $data = Message::where(
                        function ($query) use ($user_id,$uid)
                        { $query->where('sender', '=', $user_id)
                            ->Where('receiver', '=', $uid);
                        })
                ->orWhere(
                          function ($query) use ($user_id,$uid)
                          { $query->where('sender', '=', $uid)
                              ->Where('receiver', '=', $user_id);
                          })->first();




      // $data=  Message::orWhere('sender',$user_id)->orWhere('receiver',$user_id)->first(); 
       // echo "<pre>"; print_r($data); die;
      return $data->id;
    }

}
