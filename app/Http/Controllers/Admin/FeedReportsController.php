<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FeedsReportSave;
use App\Models\Feed;
use App\Models\NewsFeeds;

class FeedReportsController extends Controller
{
    public function getIndex()
    {
        return view('admin.feeds_reports.index');
    }

    public function getList()
    {
        $settings = FeedsReportSave::leftJoin('users', 'users.id', '=', 'feeds_report_save.user_id')->leftJoin('users as user_feed', 'user_feed.id', '=', 'feeds_report_save.feed_user')->leftJoin('feeds', 'feeds.id', '=', 'feeds_report_save.feed_id')->leftJoin('feeds_news', 'feeds_news.id', '=', 'feeds_report_save.news_feed_id')->leftJoin('feeds_report_label', 'feeds_report_label.id', '=', 'feeds_report_save.reason')->select('feeds_report_save.id as feedReportId','feeds_report_save.description','feeds_report_save.type','feeds_report_save.status','feeds.id as feed_id','feeds.title as feed_title','feeds_news.id as news_feed_id','feeds_news.title as news_feed_title','users.first_name','users.last_name','feeds_report_label.label','user_feed.first_name as uf_f_name','user_feed.last_name as uf_l_name','user_feed.email as uf_email')->get();
        // pr($settings->toArray()); die;
        return \DataTables::of($settings)
        
            ->editColumn('report_user_name', function ($query) {
                return ucwords($query->first_name.' '.$query->last_name);
            })
            ->editColumn('report_against_user_name', function ($query) {
                $name = ucwords($query->uf_f_name.' '.$query->uf_l_name);
                return $name;
            })
            ->editColumn('feed_type', function ($query) {
                if($query->type == 1){
                    $type = 'Home-Feeds';
                }elseif($query->type == 2){
                    $type = 'News-Feeds';
                }else{
                    $type = '';
                }
                return $type;
            })
            ->editColumn('title', function ($query) {
                if($query->type == 1){
                    return $title = $query->feed_title;
                }else{
                    return $title = $query->news_feed_title;
                }             
            })
            ->editColumn('url', function ($query) {
                if($query->status == null){
                    if($query->type == 1){
                        return url('/feed/'.$query->feed_id);
                    }else{
                        return url('/news_feed/'.$query->news_feed_id);
                    }        
                }else{
                    return '';
                }
            })
            ->editColumn('status', function ($query) {
                return ucfirst($query->status);
            })
        ->make();
    }

    public function getReportView(Request $request){
        $data['report_view'] = FeedsReportSave::where('id',$request->id)->first();

        $view = view('admin.feeds_reports.report_view',$data)->render();
        echo json_encode(['status'=>1,'view'=>$view]);
    }

    public function deleteReportFeed(Request $request){
        $report_id = FeedsReportSave::where('id',$request->id)->first();
        
        Feed::where('id',$report_id->feed_id)->delete();
        NewsFeeds::where('id',$report_id->news_feed_id)->delete();

        FeedsReportSave::where('id',$request->id)->update(['status'=>'deleted']);

        echo json_encode(['status'=>1,'msg'=>'Feed deleted successfully']);
    }
    
}
