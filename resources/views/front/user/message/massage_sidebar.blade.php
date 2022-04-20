<?php
use App\Http\Controllers\Front\MessageController;
?>
<input type="hidden" id="sidebarUserCount" value="{{ count($massage_users) }}">
<input type="hidden" id="totalMassage" value="{{ $totalMassage }}">
@foreach ($massage_users as $key => $cuser)
<?php $usermassage_id = MessageController::converstionChatsMsgId($cuser->id); ?>
<li class="chat_list" id="<?php if(@$massage_id == $usermassage_id) { echo 'active'; } ?>" >
	<a href="javascript:void(0);" class="d-block" onclick="getMassageUserChat(this,'{{ $usermassage_id }}','{{ $cuser->id }}',1)" id="{{ $cuser->id }}_{{ $usermassage_id }}">
		<div class="esChatWithUser">
			<div class="esTableFilters esChatUserActive">
				<div class="esTableLeft esMsgUser">
					<div class="esUsrMImg newImage">
						<img src="{{ @imageBasePath(@$cuser->profile_image)}}" class="img-fluid esImage" alt="Image">
					</div>
				</div>
				<div class="esTableRight">
					<span class="esUsName">{{ @$cuser->first_name }}  {{ @$cuser->last_name }}</span>
					<?php echo MessageController::newMassage($usermassage_id,$cuser->id); ?>
				</div>
			</div>
		</div>
	</a>
</li>
@endforeach