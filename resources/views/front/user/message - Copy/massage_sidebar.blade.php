<?php
 use App\Http\Controllers\Front\MessageController;
 ?>
<input type="hidden" id="sidebarUserCount" value="{{ count($convertion_user) }}">
<input type="hidden" id="totalMassage" value="{{ $totalMassage }}">
@foreach ($convertion_user as $key => $cuser)
 @if($cuser->receiver != Auth::guard('users')->user()->id)
<div class="chat_list" id="<?php if(@$massage_id == $cuser->message_id) { echo 'active'; } ?>">
	<a href="javascript:void(0);" onclick="getMassageUserChat(this,'{{ $cuser->message_id }}','{{ $cuser->receiver }}')">
		<div class="chat_people">
			<img src="{{ @imageBasePath($cuser->profile_image)}}" class="border-radius chatImg">
			<span class="ml-2  text-light">
				{{ @$cuser->first_name }}  {{ @$cuser->last_name }} 
				<?php echo MessageController::newMassage($cuser->message_id,$cuser->receiver); ?>
			</span>

		</div>
	</a>
</div>
@endif
@endforeach