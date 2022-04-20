<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSubscription;
use DB;

class ExpiringCustomersController extends Controller
{
    public function getIndex()
    {
        return view('admin.expiring_customers.index');
    }

    public function getList()
    {
        $today    = date('Y-m-d H:i:s');
        $nextMonth = date('Y-m-d H:i:s', strtotime($today . " +1 month"));
        $prevYear = date('Y-m-d H:i:s', strtotime($today . " -1 year"));
        // echo $prevYear; die;
        DB::enableQueryLog();
        $settings = UserSubscription::where('ends_at','<=',$nextMonth)->where('user_subscriptions.plan_id','!=',1)->leftJoin('users', 'users.id', '=', 'user_subscriptions.user_id')->select('user_subscriptions.*','users.first_name','users.last_name','users.email','users.created_at as user_created_date')->orderBy('user_subscriptions.ends_at','ASC')->get();
        // dd(DB::getQueryLog()); die;
        // $settings = UserSubscription::orderBy('user_subscriptions.id','DESC')->get();

        // echo '<pre>settings - '; print_r($settings->toArray()); die;
        return \DataTables::of($settings)
            ->addIndexColumn()
            ->editColumn('userNames', function ($query) {
                return ucwords($query->first_name.' '.$query->last_name);
            })
            ->editColumn('user_created_date', function ($query) {
                $user_created_date = date('d M, Y',strtotime($query->user_created_date));
                return $user_created_date;
            })
            ->editColumn('status', function ($query) {
                $endDate = date('Y-m-d',strtotime($query->ends_at));
                $date1=date_create(date('Y-m-d'));
                $date2=date_create($endDate);
                $diff=date_diff($date1,$date2);
                if($diff->format("%R%a") < 0){
                    $differece = 'Expired';
                }else{
                    $differece = $diff->format("%a days remaining");
                }
                return $differece;
            })
        ->make();
    }

    public function getReportView(Request $request){
        $data['report_view'] = \App\Models\FeedsReportSave::where('id',$request->id)->first();

        $view = view('admin.feeds_reports.report_view',$data)->render();
        echo json_encode(['status'=>1,'view'=>$view]);
    }
    
}
