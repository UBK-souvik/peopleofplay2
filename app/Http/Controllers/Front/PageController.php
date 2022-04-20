<?php

namespace App\Http\Controllers\Front;

use Session;
use App\Models\Question;
use App\Models\QuizApplication;
use App\Models\Blog;
use App\Models\Dictionary;
use App\Models\News;
use App\Models\Poll;
use App\Models\User;
use App\Models\Event;
use App\Models\Product;
use App\Models\Watchlist;
use App\Helpers\Utilities;
use App\Helpers\UtilitiesFour;
use App\Models\MainListPage;
use App\Models\MainListParagraph;
use App\Models\NewsCategory;
use App\Models\ClassifiedCategory;
use App\Models\Classified;
use App\Models\ClassifiedApplication;
use Illuminate\Http\Request;
use App\Models\EventAwardNominee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PollAnswer;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizQuestionApplication;
use Illuminate\Support\Facades\Hash;

class PageController extends ModuleController
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    { 
        parent::__construct();
    }

     public function getClassifiedSingleDetail($slug)
    {	
    	$current_user = get_current_user_info();

    	$classified = Classified::where('slug',$slug)->with(['user'])->first();
    	$classified_related = Classified::where('category_id',$classified->category_id)->where('id', '!=',$classified->id)->take(4)->get();
    	$classified_application = ClassifiedApplication::where(['applicant_user_id'=>@$current_user->id,'classified_id'=>$classified->id])->first();
    	$classified_application_apply = '';
    	if(!empty($classified_application)) {
    		$classified_application_apply = 1;
    	}
    	
        return view('front.pages.view_classified_detail',compact('classified','classified_related','classified_application_apply'));
    }

    public function getInventor($username)
    {

        $user = User::where('username', $username)
            ->with([
                'inventorContactInfo',
                'galleries',
                'socialMedia',
                'inventorAwards'
            ])
            ->firstOrFail();
        return view('front.pages.inventor', compact('user'));
    }

    public function getPeople($slug)
    {
		echo $this->getPageContentData(1, $slug, 0);
    }
	
	public function getCompany($slug)
    {
        // return redirect($slug);
		// echo "<pre>"; print_r(Auth::guard('users')->user()->toArray()); die;
		echo $this->getPageContentData(4, $slug, 0);
    }

    public function getCompany_test(Request $request,$slug)
    {
        // if($slug == 'admin'){
        //     return redirect('admin/dashboard');
        // }
        echo $this->getPageContentData(1, $slug, 0);
    }

    public function getEvent($slug)
    {
        echo $this->getPageContentData(3, $slug, 0);
        /*$event = Event::where('slug', $slug)
            ->firstOrFail();

        return view('front.pages.event', compact('event')); */
    }

    public function test_social(){
        pr(config('cms.social_media'));
        pr(config('cms.social_media_icon_new'));
        pr(config('cms.social_media_icon'));
    }
	
	public function getBrand($slug)
    {
		$user_id = 0;
        $gallery_type = 1;

        $current_user = get_current_user_info();

			if (!empty($current_user->id)) {
				$user_id = $current_user->id;
			}

        echo $this->getPageContentData(5, $slug, $user_id);

    }
	
	// for a quiz detail page
	public function getSlugQuizDetail($slug)
    {
		$q_d = Question::where('status', 1);
		$q_d->with(['user']);
		if(!empty($slug)){
			$q_user = $slug;
			$q_d->whereHas('user', function($q) use ($q_user){
				$q->where('users.slug', $q_user);
			});
		}
		$q_d->inRandomOrder();
		$q_d->limit(10);
		$question_detail = $q_d->get();


		// echo "<pre>"; print_r($question_detail->toArray()); die;
		
		if(empty($question_detail[0]->id))
		 {
			return redirect('coming-soon');	 
		 }
			 
        return view('front.pages.quiz_detail', compact('question_detail'));

    }
	
	public function getQuizDetail(Request $request)
    {
		// echo "<pre>request - "; print_r($request->all()); die;
		/*$question_detail =DB::table('questions')
                ->join('users','users.id', '=', 'questions.user_id')
                ->where('questions.status', 1)
				->select('questions.*','users.email','users.profile_image')
                ->inRandomOrder()
				->limit(10)
				->get();*/
			
		// $question_detail = Question::where('status', 1)
		// ->with(['user'])
		// ->inRandomOrder()
		// ->limit(10)
		// ->get();

		$q_d = Question::where('status', 1);
		$q_d->with(['user']);
		if(!empty($request->user)){
			$q_user = $request->user;
			$q_d->whereHas('user', function($q) use ($q_user){
				$q->where('users.slug', $q_user);
			});
		}
		$q_d->inRandomOrder();
		$q_d->limit(10);
		$question_detail = $q_d->get();


		// echo "<pre>"; print_r($question_detail->toArray()); die;
		
		if(empty($question_detail[0]->id))
		 {
			return redirect('coming-soon');	 
		 }
			 
        return view('front.pages.quiz_detail', compact('question_detail'));

    }
/**quiz***/
    public function getQuiz()
    {
		
		$quiz_data = Quiz::where('status', 1)->get();
		
		if(empty($quiz_data[0]->id))
		 {
			return redirect('coming-soon');	 
		 }
			 
        return view('front.pages.quiz.index', compact('quiz_data'));

    }

    public function getQuizQuestion($id)
    {
		$question_detail = QuizQuestion::where('status', 1)->where('quiz_id', $id)
		->with(['user'])
		->inRandomOrder()
		->limit(10)
		->get();
		// echo "<pre>"; print_r($question_detail); die;
		
		if(empty($question_detail[0]->id))
		 {
			return redirect('coming-soon');	 
		 }
		$quiz_data = Quiz::where('id',$id)->first();	
        return view('front.pages.quiz.quiz_question', compact('question_detail','quiz_data'));

    }

    
    function postQuizQuestion(Request $request)
    {
    	 $rules = [
            'questions_id' => 'required',       
            'quiz_id' => 'required'
		 ];
	
		 $niceNames = [
				'questions_id' => 'Question',
                'quiz_id' => 'Quiz',   				
		 ];	

       $this->validate($request, $rules, [], $niceNames);

        try {

            DB::beginTransaction();

            $current_user = @get_current_user_info();
            $data = $request->only(QuizQuestionApplication::$fillable_shadow);
            
			if(!empty($current_user->id))
			{
			  $data['applicant_user_id'] = $current_user->id;
			}
			else
			{
			  $data['applicant_user_id'] = 0;	
			}
			
			$data['quiz_id'] = $request->quiz_id;
			$data['ques_id'] = $request->questions_id;
			
			if($request->which_is_lie == $request->question_id)
			{
			   $data['is_lie'] = 1;	
			}
			else
			{
			   $data['is_lie'] = 0;	
			}
			
			$data['status'] = 1;
			
            QuizQuestionApplication::updateOrCreate(['id' => 0], $data);

            DB::commit();
			//Session::flash('blog_data_saved_flag', 1);
            return successMessage('Quiz saved');
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }
/**quiz***/
	
	public function postQuizApplication(Request $request)
    {
		 $rules = [
            // 'question_id' => 'required',       
            'quiz_id' => 'required'
		 ];
	
		 $niceNames = [
				// 'question_id' => 'Question',
                'quiz_id' => 'Quiz',   				
		 ];	

       $this->validate($request, $rules, [], $niceNames);

        try {

            DB::beginTransaction();

            $current_user = @get_current_user_info();
            $data = $request->only(QuizApplication::$fillable_shadow);
            
			if(!empty($current_user->id))
			{
			  $data['applicant_user_id'] = $current_user->id;
			}
			else
			{
			  $data['applicant_user_id'] = 0;	
			}
			
			$data['quiz_id'] = $request->quiz_id;
			$data['ques_id'] = $request->question_id;
			
			if($request->which_is_lie == $request->question_id)
			{
			   $data['is_lie'] = 1;	
			}
			else
			{
			   $data['is_lie'] = 0;	
			}
			
			$data['status'] = 1;
			
            QuizApplication::updateOrCreate(['id' => 0], $data);

            DB::commit();
			//Session::flash('blog_data_saved_flag', 1);
            return successMessage('Quiz saved');
        } catch (\Exception $e) {
            DB::rollback();
            return errorMessage($e->getMessage(), true);
        }
    }
	
	// for a word detail page
	public function getWordDetail($slug)
    {
		$dictionary_detail = Dictionary::where('status', 1)
            ->where('slug', @$slug)
            ->get();
			
		$str_current_day =	date('Y-m-d');
			
		$int_dictionary_detail_id =  @$dictionary_detail[0]->id;

        $str_current_time = strtotime($str_current_day);
		
		$str_last_three_day_time =  strtotime(date('Y-m-d',(strtotime ( '-3 day' , strtotime ( $str_current_day) ) )));

			
		$dictionary_list = Dictionary::selectRaw('*, UNIX_TIMESTAMP(date_to_be_published) AS timeu')
		    ->where('status', 1)
            ->where('date_to_be_published', '<>', '')
			->whereNotNull('date_to_be_published')
			->having('timeu', '<=', $str_current_time)
			->having('timeu', '>=', $str_last_three_day_time)
			->where('id', '<>', $int_dictionary_detail_id)
            ->limit(3)
			->groupBy('id')
			->orderby('id', 'desc')
            ->get();
			
      // print_r($dictionary_list);exit;
        $arr_dictionary_data = UtilitiesFour::getDictionaryFieldsData($dictionary_detail);  			
			
        return view('front.pages.view_dictionary_detail', compact('dictionary_detail', 'dictionary_list', 'arr_dictionary_data'));

    }
	
	// for a random word and word of day
	public function getWordofDay($is_random_number)
    {

		$str_current_date = date('Y-m-d');
		
		// for random word
		if(empty($is_random_number))
		{
			//echo 1534534;
		   
		   $dictionary_detail = Dictionary::where('status', 1)
            ->inRandomOrder()
			->limit(10)
			->get();

			
            if(!empty($dictionary_detail[0]->slug))
			 {
				return redirect('pop-dictionary/'.$dictionary_detail[0]->slug);	 
			 }
			 else
			 {
			   return redirect('coming-soon'); 	 
			 }
			

		}		
		// for current word of day
		else
		{
		  

            $dictionary_detail = Dictionary::get_dictionary_word_of_day();		   
			
			$dictionary_last_detail = Dictionary::where('status', 1)
            ->where('date_to_be_published', '<>',  '')
			->orderBy('id', 'desc')
			->get();
			
			
			
			//echo '<pre>slug: ' . @$dictionary_last_detail[0]->slug;
			//print_r($dictionary_last_detail);
			//echo '</pre>';

			// echo "<pre>"; print_r($dictionary_last_detail); die;
         
			 if(!empty($dictionary_detail[0]->slug))
			 {
				$str_dictionary_detail_slug = @$dictionary_detail[0]->slug;
			 }
			 else
			 {
				$str_dictionary_detail_slug = @$dictionary_last_detail[0]->slug; 
				
			 }		
			 
			 if(!empty($str_dictionary_detail_slug))
			 {
			   return redirect('pop-dictionary/'.$str_dictionary_detail_slug);	 
			 }
             else
			 {
			   return redirect('coming-soon'); 	 
			 }
              			 
			
		}
         		 

    }

    public function getProduct($slug)
    {
        $user_id = 0;
        $gallery_type = 1;

        $current_user = get_current_user_info();

			if (!empty($current_user->id)) {
				$user_id = $current_user->id;
			}

        echo $this->getPageContentData(2, $slug, $user_id);

        /*return view('front.pages.product', compact(
            'product',
			'user_id',
			'user_product_data',
			'user_event_data',
			'category_list',
			'person_list',
			'award_list',
			'company_list',
			'str_modal_form_div_id',
			'arr_destinations_list',
			'arr_destinations_list_keys',
			'gallery_type',
            'gallery_known_for_data',
            'gallery_video_data',
			'cnt_gallery_image_data',
			'cnt_gallery_video_data',
            'chk_device',
            'folder_path',
            'gallery_data',
            'gallery_videos_link',
            'gallery_known_for_link',
            'gallery_images_link',
            'blogs_link',
            'blogs_list',
            'collaborator_photos_path',
            'collaborator_role_array',
            'awards'
        )); */
    }

    public function getDropMenu($type)
    { 
        $available_type = config('cms.drop_down_type');
        if (!in_array($type, $available_type)) {
            abort(404);
        }

        $main_list_page = MainListPage::where('status', 1)
            ->where('type', array_flip($available_type)[$type])
            ->orderBy('display_order', 'asc')
            ->get();
			
		$main_list_paragraph = MainListParagraph::where('status', 1)
            ->where('type', array_flip($available_type)[$type])
            ->first();	
			
		//echo '<pre>';
        //print_r($main_list_page);
        //echo '</pre>';		
//exit;

        // $main_list_page = $main_list_page->toArray();
        // pr($main_list_page,1);
        return view('front.pages.main_list', compact('main_list_page', 'type', 'main_list_paragraph'));
    }


    public function postPollsSubmit(Request $request)
    {

        $request->validate([
            'poll_id' => 'required|exists:polls,id',
            'option_id' => 'required|exists:poll_options,id'
        ]);

        try {
            $poll = Poll::findOrFail($request->poll_id);
            $answer = new PollAnswer();
            if (\Auth::guard('users')->user()) {
                $user = get_current_user_info();
                $answer->user_id = $user->id;
            }
            $answer->ip = $request->ip();
            $answer->poll_id = $poll->id;
            $answer->question = $poll->question;
            $answer->option_id = $request->option_id;
            $answer->type = $poll->type;
            $answer->save();

            Session::put('poll_message', 1);
            return redirect()->back()->with('success', 'Poll Submitted Successfully');
        } catch (\Exception $e) {
            Session::put('poll_message', 'poll submitted failed' );   
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
	
	public function getComingSoonPage()
    {
        return view('front.pages.coming_soon');
    }
	
	public function getClassifiedList()
    {
		$all_classified_categories = ClassifiedCategory::get_all_classified_categories();
		
		$all_classified_list = Classified::get_all_classified_list(0);
        
		$current_user = get_current_user_info();
		
		$all_classified_application = '';
		
		if(!empty(@$current_user->id))
		{
		  $user_id = @$current_user->id;
		  $all_classified_application =  ClassifiedApplication::get_classified_application(@$user_id);
		}
		//echo '<pre>';
		//print_r($all_classified_list);
		//echo '</pre>';
		//exit;
		
        return view('front.pages.view_classifieds', compact('all_classified_categories', 'all_classified_list', 'all_classified_application'));
    }
	
	public function getClassifiedDetail($type_id)
    {
		$current_user = get_current_user_info();
		$all_classified_categories = ClassifiedCategory::get_all_classified_categories();
		
		$all_classified_list = Classified::get_all_classified_list($type_id);
		
		$all_classified_application = '';
		
		if(!empty(@$current_user->id))
		{
		  $user_id = @$current_user->id;		
		  $all_classified_application =  ClassifiedApplication::get_classified_application($user_id);
		}
		
        return view('front.pages.view_classifieds', compact('type_id', 'all_classified_categories', 'all_classified_list', 'all_classified_application'));
    }
}
