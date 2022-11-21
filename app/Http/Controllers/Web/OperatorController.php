<?php

namespace App\Http\Controllers\Web;

use App\Day;

use App\Way;
use App\News;
use App\Role;
use App\Town;
use App\User;
use DateTime;
use App\Admin;

use App\State;
use App\Doctor;
use App\Booking;
use App\Contact;
use App\Package;

use App\Patient;
use App\Voucher;
use App\Employee;
use App\Location;
use Carbon\Carbon;
use App\Department;
use App\DoctorInfo;
use App\DoctorTime;
use App\Appointment;
use App\WayPlanning;
use App\Announcement;
use App\Advertisement;
use App\Traits\ZoomJWT;
use App\PackageKg_Price;

use App\WayPlanSchedule;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OperatorController extends Controller
{
	public function __construct()
	{

		$this->routeList = [
			"U Zaw Win",
			"Daw Zin Win Oo",
			"Daw Zin Zin Win",
			"Daw Win Win Zaw",
			"U Sai Kaung Chit",
			"Daw Khin Myat Min",
			"U Sein Aung Lwin",
			"Daw Khin Myit Sein",
			"Daw Yamone Oo",
			"Daw Yamone Phoo",
			"Daw Zun Phoo Phoo",
			"Daw Aye Nyein Thu",
			"Daw Aye Nyein May",
			"Daw Thet Htar Swe",
			"U Pyae Phyo Win",
			"U Win Pyae Phyo",
			"U Wunna Kyaw",
			"U Aung Htoo Kyaw",
			"U Kyaw Lin Aung",
			"U Aung Lin Kyaw",
		];
	}

	use ZoomJWT;

	const MEETING_TYPE_INSTANT = 1;
	const MEETING_TYPE_SCHEDULE = 2;
	const MEETING_TYPE_RECURRING = 3;
	const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

	// protected function AdminDashboard(Request $request)
	// {

	// 	$now = new DateTime('Asia/Yangon');

	// 	$toady_date = $now->format('Y-m-d');

	// 	$department_lists = Department::all();

	// 	$user = $request->session()->get('user');
	// 	if(session()->get('user')->isOwner(1) || session()->get('user')->hasRole('EmployeeC')){
	// 		$bookings = Appointment::where('date', $toady_date)->get();
	// 	}
	// 	elseif(session()->get('user')->isOwner(0) && session()->get('user')->hasRole('DoctorC')){
	// 		$doctor = Doctor::where('user_id',$user->id)->first();
	// 		$bookings = Appointment::where('date', $toady_date)->where('doctor_id',$doctor->id)->get();
	// 	}

	// 	$announcements = Announcement::all();

	// 	$advertisements = Advertisement::all();

	// 	$count_booking = count($bookings);

	// 	$doctors = Doctor::all();

	// 	$patients = Patient::all();

	// 	$count_doc = count($doctors);

	// 	$count_patient = count($patients);

	// 	$count_dept = count($department_lists);

	// 	if(session()->get('user')->hasRole('EmployeeC') || session()->get('user')->hasRole('DoctorC')){
    //         $voucher_lists =Voucher::where('type', 1)->where('clinicvoucher_status',1)->orderBy('id','desc')->get();

    //     }
    //     else{
    //         $voucher_lists =Voucher::where('type', 1)->orderBy('id','desc')->get();

    //     }

	// 	$total_sales  = 0;

    //     foreach ($voucher_lists as $voucher_list){

    //         $total_sales += $voucher_list->total_price;

    //     }
    //     $date = new DateTime('Asia/Yangon');

    //     $current_date = strtotime($date->format('Y-m-d'));

    //     $weekly = date('Y-m-d', strtotime('-1week', $current_date));
    //     // $to = date('Y-m-d', strtotime('+1day', $current_date));
    //     $to = $date->format('Y-m-d');


    //     if(session()->get('user')->hasRole('EmployeeC') || session()->get('user')->hasRole('DoctorC')){

    //         $weekly_data = Voucher::where('type', 1)->where('clinicvoucher_status',1)->whereBetween('voucher_date',[$weekly,$to])->get();

    //     }
    //     else{
    //         $weekly_data = Voucher::where('type', 1)->whereBetween('voucher_date', [$weekly,$to])->get();

    //     }
    //     $weekly_sales = 0;

    //     foreach($weekly_data as $weekly){

    //         $weekly_sales += $weekly->total_price;
    //     }

    //     $current_month = $date->format('m');
    //     $current_month_year = $date->format('Y');
    //     $today_date = $date->format('Y-m-d');
    //     if(session()->get('user')->hasRole('EmployeeC') || session()->get('user')->hasRole('DoctorC')){
    //         $daily = Voucher::where('type', 1)->where('clinicvoucher_status',1)->whereDate('created_at', $today_date)->get();
    //     }
    //     else{
    //         $daily = Voucher::where('type', 1)->where('created_at', $today_date)->get();

    //     }

    //     $daily_sales = 0;

    //     foreach($daily as $day){

    //         $daily_sales += $day->total_price;
    //     }
    //     if(session()->get('user')->hasRole('EmployeeC') || session()->get('user')->hasRole('DoctorC')){

    //         $monthly = Voucher::where('type', 1)->where('clinicvoucher_status',1)->whereMonth('created_at',$current_month)->whereYear('created_at',$current_month_year)->get();

    //     }
    //     else{
    //         $monthly = Voucher::where('type', 1)->whereMonth('created_at',$current_month)->get();

    //     }
    //     $monthly_sales = 0;

    //     foreach ($monthly as $month){

    //         $monthly_sales += $month->total_price;
    //     }

	// 	return view('Admin.dashboard', compact('department_lists', 'count_doc', 'count_patient', 'count_dept', 'doctors', 'count_booking', 'announcements', 'advertisements','total_sales','daily_sales','monthly_sales','weekly_sales'));
	// }

	protected function employee_list(Request $request){
        $roles = Role::all();
        $users = User::all();


        $ro_us4 = DB::table('role_user')->where('role_id',4)->count();
        $ro_us = DB::table('role_user')->where('role_id',5)->count();
        // dd($users);
		return view('Admin.employee_list',compact('roles','users','ro_us4','ro_us'));

	}

    protected function store_employee(Request $request){

        // dd($request->all());
        $name = $request->name;
        $email = $request->email;
        $pass = Hash::make($request->password);
        $phone = $request->phone;


        // dd($ro_us5);


        // dd($ro_us4,$ro_us);
        // if($ro_us >= 3 ){
        //     alert()->error('no more create!');
        // }


       $user =  User::create([
            'name' => $name,
            'email' => $email,
            'password' => $pass,
            'phone' => $phone
        ]);

        $user->assignRole($request->role);
        alert()->success('Sucessfully Employee Created!!');

			return redirect()->back();

	}

    protected function delete_employee($id){

            // dd($id);

        $del = DB::table('role_user')->where('user_id',$id)->delete();
		// dd($del);
        User::find($id)->delete();

        return redirect()->back();
    }

	protected function delete_news($id){

		// dd($id);

	// $del = DB::table('news')->where('id',$id)->delete();
	News::find($id)->delete();

	return redirect()->back();
}

protected function delete_contact($id){

	// dd($id);

// $del = DB::table('news')->where('id',$id)->delete();
Contact::find($id)->delete();

return redirect()->back();
}

  protected function update_employee(Request $request){
         dd($request->all());
}

protected function update_news(Request $request){
	// dd($request->all());
	
}

protected function find_news_update(Request $request){
	// dd($request->old_id);
	$update = News::find($request->old_id);
	return response()->json($update);
}

protected function store_update_news(Request $request){
	// dd($request->image == null);
      
	if($request->hasFile('img'))
         {
        $file = $request->file('img');
        $originalname = $file->getClientOriginalName();
        $filename =$originalname;
        $file->move('public/images', $filename);
          }

	$title = $request->title;
	$description = $request->des;
	$update_news = News::find($request->news_id);
	// dd($update_contact);
	$update_news->title = $title;
    if($request->hasFile('img'))
         {
	$update_news->image = $filename;
		 }
	$update_news->description = $description;
	$update_news->save();
	alert()->success('Updated News Successfully!!!');
	return redirect()->back();
}


protected function find_contact_update(Request $request){
	// dd($request->old_id);
	$update = Contact::find($request->old_id);
	return response()->json($update);
}


protected function store_update_contact(Request $request){
	// dd($request->location);
	$location = $request->location;
	$address = $request->address;
	$phone = $request->phno;
	$update_contact = Contact::find($request->contact_id);
	// dd($update_contact);
	$update_contact->location = $location;
	$update_contact->address = $address;
	$update_contact->phone_number = $phone;
	$update_contact->save();
	alert()->success('Updated Contact Successfully!!!');
	return redirect()->back();
}


    protected function manager_dashboard(Request $request){

		$waylist = WayPlanSchedule::all();
        return view('manager_dashboard',compact('waylist'));

    }

    protected function township(Request $request){
		$charges_list = Package::all();
        return view('Admin.township',compact('charges_list'));
    }

    protected function schedule(Request $request){

		// $wayplanid = WayPlanSchedule::create([
		// 	'parcel_quantity' => 0
		// ]);

		$location = Location::all();
        return view('Admin.schedule',compact('location'));
    }

	protected function change_barchart_week(Request $request)
	{
		$week = $request->receive_week;
		$weekStartDate = Carbon::parse($request->receive_week)->startOfWeek()->format('Y-m-d');
		$weekEndDate = Carbon::parse($request->receive_week)->endOfWeek()->format('Y-m-d');

		$two_day = Carbon::parse($weekStartDate)->addDays(1)->format('Y-m-d');
		$three_day = Carbon::parse($two_day)->addDays(1)->format('Y-m-d');
		$four_day = Carbon::parse($three_day)->addDays(1)->format('Y-m-d');
		$five_day = Carbon::parse($four_day)->addDays(1)->format('Y-m-d');
		$six_day = Carbon::parse($five_day)->addDays(1)->format('Y-m-d');
		$seven_day = Carbon::parse($six_day)->addDays(1)->format('Y-m-d');

// dd($weekStartDate."---".$two_day."---".$three_day."---".$four_day."---".$five_day."---".$six_day."---".$seven_day);
		// dd($weekStartDate."---".$weekEndDate);
		$first_status = WayPlanSchedule::where('receive_date',$weekStartDate)->get();
		$sec_status = WayPlanSchedule::where('receive_date',$two_day)->get();
		$third_status = WayPlanSchedule::where('receive_date',$three_day)->get();
		$fourth_status = WayPlanSchedule::where('receive_date',$four_day)->get();
		$fifth_status = WayPlanSchedule::where('receive_date',$five_day)->get();
		$six_status = WayPlanSchedule::where('receive_date',$six_day)->get();
		$seven_status = WayPlanSchedule::where('receive_date',$seven_day)->get();
		$f_done_count = [];
		$f_pend_count = [];
		$f_reject_count = [];
		$sec_done_count = [];
		$sec_pend_count = [];
		$sec_reject_count = [];
		$th_done_count = [];
		$th_pend_count = [];
		$th_reject_count = [];
		$fou_done_count = [];
		$fou_pend_count = [];
		$fou_reject_count = [];
		$fiv_done_count = [];
		$fiv_pend_count = [];
		$fiv_reject_count = [];
		$sixth_done_count = [];
		$sixth_pend_count = [];
		$sixth_reject_count = [];
		$last_done_count = [];
		$last_pend_count = [];
		$last_reject_count = [];
		//first Day
		foreach($first_status as $first_count)
		{
			if($first_count->customer_status == 2 && $first_count->reject_status == 0)
			{
				array_push($f_done_count,$first_count);
			}
			elseif($first_count->customer_status != 2 && $first_count->reject_status == 0)
			{
				array_push($f_pend_count,$first_count);
			}
			elseif($first_count->reject_status == 1)
			{
				array_push($f_reject_count,$first_count);
			}
		}
		//Second Day
		foreach($sec_status as $second_count)
		{
			if($second_count->customer_status == 2 && $second_count->reject_status == 0)
			{
				array_push($sec_done_count,$second_count);
			}
			elseif($second_count->customer_status != 2 && $second_count->reject_status == 0)
			{
				array_push($sec_pend_count,$second_count);
			}
			else if($second_count->reject_status == 1)
			{
				array_push($sec_reject_count,$second_count);
			}
		}
		//Third Day
		foreach($third_status as $third_count)
		{
			if($third_count->customer_status == 2 && $third_count->reject_status == 0)
			{
				array_push($th_done_count,$third_count);
			}
			elseif($third_count->customer_status != 2 && $third_count->reject_status == 0) 
			{
				array_push($th_pend_count,$third_count);
			}
			elseif($third_count->reject_status == 1)
			{
				array_push($th_reject_count,$third_count);
			}
		}
		//four Day
		foreach($fourth_status as $four_count)
		{
			if($four_count->customer_status == 2 && $four_count->reject_status == 0)
			{
				array_push($fou_done_count,$four_count);
			}
			elseif($four_count->customer_status != 2 && $four_count->reject_status == 0) 
			{
				array_push($fou_pend_count,$four_count);
			}
			elseif($four_count->reject_status == 1)
			{
				array_push($fou_reject_count,$four_count);
			}
		}
		//five Day
		foreach($fifth_status as $five_count)
		{
			if($five_count->customer_status == 2 && $five_count->reject_status == 0)
			{
				array_push($fiv_done_count,$five_count);
			}
			elseif($five_count->customer_status != 2 && $five_count->reject_status == 0) 
			{
				array_push($fiv_pend_count,$five_count);
			}
			elseif($five_count->reject_status == 1)
			{
				array_push($fiv_reject_count,$five_count);
			}
		}
		//six Day
		foreach($six_status as $sixth_count)
		{
			if($sixth_count->customer_status == 2 && $sixth_count->reject_status == 0)
			{
				array_push($sixth_done_count,$sixth_count);
			}
			elseif($sixth_count->customer_status != 2 && $sixth_count->reject_status == 0) 
			{
				array_push($sixth_pend_count,$sixth_count);
			}
			elseif($sixth_count->reject_status == 1)
			{
				array_push($sixth_reject_count,$sixth_count);
			}
		}
		//last Day
		foreach($seven_status as $last_count)
		{
			if($last_count->customer_status == 2 && $last_count->reject_status == 0)
			{
				array_push($last_done_count,$last_count);
			}
			elseif($last_count->customer_status != 2 && $last_count->reject_status == 0)
			{
				array_push($last_pend_count,$last_count);
			}
			elseif($last_count->reject_status == 1)
			{
				array_push($last_reject_count,$last_count);
			}
		}
		return response()->json([
			'first_done' =>count($f_done_count) ,
		'first_pend' => count($f_pend_count ),
		'first_reject' =>count($f_reject_count ),
		'sec_done' =>count($sec_done_count ),
		'sec_pend' => count($sec_pend_count ),
		'sec_reject' => count($sec_reject_count ),
		'th_done' => count($th_done_count ),
		'th_pend' => count($th_pend_count ),
		'th_reject' => count($th_reject_count ),
		'four_done' => count($fou_done_count ),
		'four_pend' => count($fou_pend_count ),
		'four_reject' => count($fou_reject_count ),
		'five_done' => count($fiv_done_count ),
		'five_pend' => count($fiv_pend_count ),
		'five_reject' => count($fiv_reject_count ),
		'six_done' => count($sixth_done_count ),
		'six_pend' => count($sixth_pend_count ),
		'six_reject' =>count($sixth_reject_count ),
		'last_done' => count($last_done_count ),
		'last_pend' => count($last_pend_count ),
		'last_reject' => count($last_reject_count ),
			
		]);

	}
	protected function change_barchart(Request $request)
	{
		
		$date =$request->receive_month;
		
        
        $firstdate = Carbon::parse($date)->firstOfMonth()->format('Y-m-d');
		
        $first_week = Carbon::parse($firstdate)->addDays(6)->format('Y-m-d');
		$second_week = Carbon::parse($first_week)->addDays(6)->format('Y-m-d');
		$third_week = Carbon::parse($second_week)->addDays(6)->format('Y-m-d');
		$last_week = Carbon::parse($third_week)->endOfMonth()->format('Y-m-d');
		// dd($last_week);
		$first_week_status = WayPlanSchedule::whereBetween('receive_date', [$firstdate, $first_week])->where('receive_status',1)->get();
		$second_week_status = WayPlanSchedule::whereBetween('receive_date', [$first_week, $second_week])->where('receive_status',1)->get();
		$third_week_status = WayPlanSchedule::whereBetween('receive_date', [$second_week, $third_week])->where('receive_status',1)->get();
		$last_week_status = WayPlanSchedule::whereBetween('receive_date', [$third_week, $last_week])->where('receive_status',1)->get();
		$f_done_count = [];
		$f_pend_count = [];
		$f_reject_count = [];
		$sec_done_count = [];
		$sec_pend_count = [];
		$sec_reject_count = [];
		$th_done_count = [];
		$th_pend_count = [];
		$th_reject_count = [];
		$last_done_count = [];
		$last_pend_count = [];
		$last_reject_count = [];
		//first Week
		foreach($first_week_status as $first_count)
		{
			if($first_count->customer_status == 2 && $first_count->reject_status == 0)
			{
				array_push($f_done_count,$first_count);
			}
			elseif($first_count->customer_status != 2 && $first_count->reject_status == 0)
			{
				array_push($f_pend_count,$first_count);
			}
			elseif($first_count->reject_status == 1)
			{
				array_push($f_reject_count,$first_count);
			}
		}
		//Second Week
		foreach($second_week_status as $second_count)
		{
			if($second_count->customer_status == 2 && $second_count->reject_status == 0)
			{
				array_push($sec_done_count,$second_count);
			}
			elseif($second_count->customer_status != 2 && $second_count->reject_status == 0)
			{
				array_push($sec_pend_count,$second_count);
			}
			else if($second_count->reject_status == 1)
			{
				array_push($sec_reject_count,$second_count);
			}
		}
		//Third Week
		foreach($third_week_status as $third_count)
		{
			if($third_count->customer_status == 2 && $third_count->reject_status == 0)
			{
				array_push($th_done_count,$third_count);
			}
			elseif($third_count->customer_status != 2 && $third_count->reject_status == 0) 
			{
				array_push($th_pend_count,$third_count);
			}
			elseif($third_count->reject_status == 1)
			{
				array_push($th_reject_count,$third_count);
			}
		}
		//last Week
		foreach($last_week_status as $last_count)
		{
			if($last_count->customer_status == 2 && $last_count->reject_status == 0)
			{
				array_push($last_done_count,$last_count);
			}
			elseif($last_count->customer_status != 2 && $last_count->reject_status == 0)
			{
				array_push($last_pend_count,$last_count);
			}
			elseif($last_count->reject_status == 1)
			{
				array_push($last_reject_count,$last_count);
			}
		}
		
		// dd($firstdate."--->".$first_week."-->".$second_week."-->".$third_week);
		return response()->json([
			"f_done" => count($f_done_count),
			"f_pend" => count($f_pend_count),
			"f_reject" => count($f_reject_count),
			"sec_done" => count($sec_done_count),
			"sec_pend" => count($sec_pend_count),
			"sec_reject" =>count($sec_reject_count),
			"th_done" => count($th_done_count),
			"th_pend" => count($th_pend_count),
			"th_reject" =>count($th_reject_count),
			"last_done" => count($last_done_count),
			"last_pend" =>count($last_pend_count),
			"last_reject" =>count($last_reject_count),
		]);
		
	}

	protected function change_revenue_monthly(Request $request)
	{
		$date = $request->receive_revenue_month;
		$firstdate = Carbon::parse($date)->firstOfMonth()->format('Y-m-d');
		
        $first_week = Carbon::parse($firstdate)->addDays(6)->format('Y-m-d');
		$second_week = Carbon::parse($first_week)->addDays(6)->format('Y-m-d');
		$third_week = Carbon::parse($second_week)->addDays(6)->format('Y-m-d');
		$last_week = Carbon::parse($third_week)->endOfMonth()->format('Y-m-d');
		// dd($last_week);
		$first_week_revenue = WayPlanSchedule::whereBetween('receive_date', [$firstdate, $first_week])->where('receive_status',1)->where('way_status',1)->get();
		$second_week_revenue = WayPlanSchedule::whereBetween('receive_date', [$first_week, $second_week])->where('receive_status',1)->where('way_status',1)->get();
		$third_week_revenue = WayPlanSchedule::whereBetween('receive_date', [$second_week, $third_week])->where('receive_status',1)->where('way_status',1)->get();
		$last_week_revenue = WayPlanSchedule::whereBetween('receive_date', [$third_week, $last_week])->where('receive_status',1)->where('way_status',1)->get();

		$first_done = [];
		$second_done = [];
		$third_done = [];
		$last_done = [];

		foreach($first_week_revenue as $fwr)
		{
			array_push($first_done,$fwr->total_charges);
		
		}
		foreach($second_week_revenue as $swr)
		{
			array_push($second_done,$swr->total_charges);
		
		}
		foreach($third_week_revenue as $twr)
		{
			array_push($third_done,$twr->total_charges);
		
		}
		foreach($last_week_revenue as $lwr)
		{
			array_push($last_done,$lwr->total_charges);
		
		}
		$first_total = array_sum($first_done);
		$second_total = array_sum($second_done);
		$third_total = array_sum($third_done);
		$last_total = array_sum($last_done);
		// dd($first_total);
		return response()->json([
			"first" =>$first_total,
			"second" =>$second_total,
			"third" =>$third_total ,
			"last" => $last_total,
		]);
	}

	protected function show_updateCharges($id)
	{
		// dd($id);
		$location  = Location::all();
		$package = Package::find($id);
		$charges = PackageKg_Price::where('package_id',$id)->get();
		$last_charges = PackageKg_Price::where('package_id',$id)->orderBy('id', 'desc')->first();
		$last_count = $last_charges->id;
		// dd("hell");
		return view('Admin.show_update_charges',compact('last_count','location','package','charges'));
	}

	protected function store_updateCharges(Request $request)
	{
		// dd($request->all());

			$from = Location::find($request->from_city);
			$to = Location::find($request->to_city);
			$update_package = Package::find($request->package_id);
			$update_package->package_name =$request->name;
			$update_package->from_city_id = $request->from_city;
			$update_package->to_city_id = $request->to_city;
			$update_package->from_city_name = $from->name;
			$update_package->to_city_name = $to->name;
			$update_package->save();

			for($i=0;$i<count($request->min);$i++)
			{
				if($request->currency[$i] == 1)
				{
					$per_kg = "MMK";
				}
				elseif($request->currency[$i] == 2)
				{
					$per_kg = "BAHT";
				}
				elseif($request->currency[$i] == 3)
				{
					$per_kg = "USD";
				}

				$kg_price = PackageKg_Price::where('id',$request->charges_id[$i])->first();
				// dd($kg_price);
				if($kg_price != null)
				{
					// dd("in");
					$kg_price->package_id = $request->package_id;
					$kg_price->min_kg = $request->min[$i];
					$kg_price->max_kg = $request->max[$i];
					$kg_price->per_kg_price = $request->per_kg_charges[$i];
					$kg_price->currency = $per_kg;
					$kg_price->save();
				}
				elseif($kg_price == null)
				{
					// dd("out");
						$package_kg_prices = PackageKg_Price::create([
						'package_id'=> $request->package_id,
						'min_kg'     =>$request->min[$i],
						'max_kg'     =>$request->max[$i],
						'per_kg_price' => $request->per_kg_charges[$i],
						'currency' => $per_kg,
						]);
				}

			}
			alert()->success("Successfully Updated Charges General Information!");
            return back();

	}
	protected function find_point_result(Request $request)
	{
		// dd($request->weight);
		$package = Package::where('from_city_id',$request->receive_point)->where('to_city_id',$request->drop_point)->first();
		// dd($package->id);
		$kg_price = PackageKg_Price::where('package_id',$package->id)->where('min_kg','<=',$request->weight)->where('max_kg','>',$request->weight)->first();
		// dd($kg_price);
		if($kg_price == null)
		{
			return response()->json(1);
		}
		else
		{
			return response()->json($kg_price);
		}
		// dd($kg_price);


	}
	protected function store_wayplan_now(Request $request)
	{

		// dd($request->all());
		$ldate = new DateTime('today');
		$date = $ldate->format('Y-m-d');
		// dd($date);
		$validator = Validator::make($request->all(), [

			"perKg" => "required",
			"chargess" => "required",
			"customer_name" => "required",
			"token" => "required",

			"tracking_id" => "required",

			"customer_phone" => "required",
			"cust_addr" => "required",
			"remark" => "required",
			"receive_point" => "required",
			"qty" => "required",
			"receive_date" => "required",
			"weight" => "required",
			"wg_type" => "required",
			"drop_point" => "required",
			"charge" => "required",
			"drop_date" => "required",
			"est_charge" => "required",

		]);
		if ($validator->fails()) {

			alert()->error('Please Fill All Fields!');
			return redirect()->back();
		}
		$store_wayplan = WayPlanSchedule::create([
			'customer_name'=> $request->customer_name,
			'customer_phone'=> $request->customer_phone,
			'receive_point'=> $request->receive_point,
			'receive_date'=> $request->receive_date,
			'dropoff_point'=> $request->drop_point,
			'dropoff_date'=> $request->drop_date,
			'remark'=> $request->remark,
			'parcel_quantity'=> $request->qty,
			'total_weight'=> $request->weight,
			'per_kg_charges'=> $request->perKg,
			'package_id'=> $request->packageID,
			'total_charges'=> $request->chargess,
			'customer_address' => $request->cust_addr,
			'myawady_date' => $date,
			'customer_date' => $date,
			'token' => $request->token,
			'remark' => $request->wh_remark,
			'tracking_no' => $request->tracking_id,
		]);
		$store_wayplan = WayPlanSchedule::find($request->wayid);

		// dd($request->tracking_id);

		// $store_wayplan->customer_name =$request->customer_name;
		// $store_wayplan->customer_phone =$request->customer_phone;
		// $store_wayplan->receive_point =$request->receive_point;
		// $store_wayplan->receive_date = $request->receive_date;
		// $store_wayplan->dropoff_point =$request->drop_point;
		// $store_wayplan->dropoff_date = $request->drop_date;
		// $store_wayplan->remark =$request->remark;

		// $store_wayplan->tracking_no =$request->tracking_id;

		// $store_wayplan->parcel_quantity =$request->qty;
		// $store_wayplan->total_weight =$request->weight;
		// $store_wayplan->per_kg_charges =$request->perKg;
		// $store_wayplan->package_id = $request->packageID;
		// $store_wayplan->total_charges = $request->chargess;
		// $store_wayplan->customer_address = $request->cust_addr;
		// $store_wayplan->myawady_date = $date;
		// $store_wayplan->customer_date = $date;
		// $store_wayplan->token =  $request->token;
		// $store_wayplan->save();
		// dd($request->all());
		alert()->success("Successfully Stored WayPlan Schedule!");
		return back();

	}
	protected function show_wayplan_list()
	{
		$wayplan = WayPlanSchedule::all();
		$location = Location::all();

		$package = Package::all();
		$ways = WayPlanSchedule::where('reject_status',0)->get();
		return view('Admin.wayplan_list',compact('package','wayplan','location','ways'));

	}

	protected function news_list(Request $request){
		$news = News::all();
		return view('Admin.news_list',compact('news'));
	}
	protected function contact_list(Request $request){
		$location = Location::all();
		$contacts = Contact::all();
		return view('Admin.contact_list',compact('location','contacts'));
	}
	protected function generate_token(Request $request)
	{
		// dd($request->wayplan_id);
		$wayplanid = WayPlanSchedule::create([
			'parcel_quantity' => 0
		]);
		$date = Carbon::now();

        $monthName = $date->format('F');
		$three_str = substr($monthName,0,3);
		$token = "T".$three_str.sprintf('%04s',$wayplanid->id);
		$wayplanid->delete();
		return response()->json([
			'wayplan_id' => $wayplanid->id,
			'token' => $token]);
		// dd($token);

	}
	protected function change_way_status($id)
	{
		// dd($id);
		$wayplan = WayPlanSchedule::find($id);
		$re_point = Location::find($wayplan->receive_point);
		$drop_point = Location::find($wayplan->dropoff_point);
		return view('Admin.change_status',compact('wayplan','re_point','drop_point'));
	}

	protected function addway(Request $request){
		// dd($request->all());
		
		// dd($request->way_id);
		$wayplan = WayPlanning::create([
			"way_plan_schedule_id" => $request->way_id,
			"wayplan_no" => $request->way_no,
			"rider_name" => $request->rider,
			"route_name" => $request->route,
			"date" => $request->date,
			"start_time" => $request->start_time,
			"end_time" => $request->end_time,
			"way_id" => $request->hide_id,
		]);
		$way = WayPlanSchedule::find($request->way_id);
		$way->wayplanning_flag =1;
		$way->way_planning_id = $request->hide_id;
		$way->save();
		$wayplan_order = DB::table('wayplanning_order')->insert([
			"way_planning_id" => $wayplan->id,
			"way_plan_schedule_id"   =>$way->id,
			// "remark"   => $request->remark,
		]);
		$wayplann = WayPlanSchedule::where('wayplanning_flag',1)
								->where('way_planning_id',$request->hide_id)
								->with('receivelocation')->get();

		$way_plan_list = WayPlanSchedule::where('receive_point',$request->from_id)
		->where('dropoff_point',$request->to_id)
		->where('myawady_status',1)
		->where('wayplanning_flag',0)
		->with('receivelocation')
		->get();
	
		return response()->json([
		    "wayplanlist" => $way_plan_list,
			"wayplan" => $wayplann,
		]);
		
	}

	protected function addedway(Request $request){
		// dd($request->all());

		$wayplan = WayPlanSchedule::where('wayplanning_flag',1)
									->where('way_planning_id',$request->hide_id)->with('receivelocation')->get();
		// dd(count($wayplan));
		// dd($time_Unique);
		return response()->json([
			"wayplan" => $wayplan,
		]);
		
	}

	protected function store_change_status(Request $request)
	{
		// dd($request->all());
		if($request->custh_status == 2)
		{
			$way_status = 1;
		}
		else
		{
			$way_status = 0;
		}
		$store_way_status = WayPlanSchedule::find($request->wayplan_id);
		$store_way_status->receive_status = $request->receiveh_status;
		$store_way_status->receive_date = $request->receiveh_date;
		$store_way_status->dropoff_status = $request->dropoffh_status;
		$store_way_status->dropoff_date = $request->dropoffh_date;
		$store_way_status->myawady_date = $request->myah_date;
		$store_way_status->myawady_status = $request->myah_status;
		$store_way_status->customer_date = $request->custh_date;
		$store_way_status->customer_status = $request->custh_status;
		$store_way_status->way_status = $way_status;
		$store_way_status->dropoff_remark = $request->dremark;
		$store_way_status->customer_remark = $request->cremark;
		$store_way_status->remark = $request->wh_remark;
		$store_way_status->save();
		alert()->success("Successfully changes All Status !!");
		return back();
	}
	protected function search_phoneno_ajax(Request $request)
	{
		if($request->phone == null)
		{
			$phone_data = null;
		}
		else
		{
		$phone_data = WayPlanSchedule::where('customer_phone', 'LIKE','%'.$request->phone)->get();
		}
		// dd($phone_data);
		return response()->json($phone_data);
	}
	protected function searching_ajax_result(Request $request)
	{
		// dd($request->all());
			if($request->type == 1)
			{
				$search_data = WayPlanSchedule::where('customer_phone',$request->search_key)->with('receivelocation')->with('dropofflocation')->get();
				// dd($search_data);
			}
			else if($request->type == 2)
			{
				$search_data = WayPlanSchedule::where('token',$request->search_key)->with('receivelocation')->with('dropofflocation')->get();
			}
			else if($request->type == 3)
			{
				if($request->date_type == 1)
				{
					$search_data = WayPlanSchedule::where('receive_date',$request->search_key)->with('receivelocation')->with('dropofflocation')->get();
				}
				elseif($request->date_type == 2)
				{

				}
				elseif($request->date_type == 3)
				{
					$search_data = WayPlanSchedule::where('myawady_date',$request->search_key)->with('receivelocation')->with('dropofflocation')->get();
				}
				elseif($request->date_type == 4)
				{
					$search_data = WayPlanSchedule::where('dropoff_date',$request->search_key)->with('receivelocation')->with('dropofflocation')->get();
				}
			}
			// dd($search_data);
			return response()->json($search_data);
	}

	protected function advance_search_ajax(Request $request)
	{
		// dd($request->all());
		
		if($request->from != null && $request->to != null && $request->receive_date == null && $request->advance_stauts == 0){
			// dd('success');
			$way_plan_list = WayPlanSchedule::where('receive_point',$request->from)
						->where('dropoff_point',$request->to)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		if($request->from == null && $request->to == null && $request->receive_date != null && $request->advance_stauts == 0){
			// dd('success');
			$way_plan_list = WayPlanSchedule::where('receive_date',$request->receive_date)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		//test
		if($request->from == null && $request->to == null && $request->receive_date == null && $request->advance_status == 1)
		{
		 $way_plan_list = WayPlanSchedule::where('customer_status',2)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
						
		}
		if($request->from == null && $request->to == null && $request->receive_date == null && $request->advance_status == 2)
		{
			$way_plan_list = WayPlanSchedule::where('customer_status','<>',2)
			->with('receivelocation')
			->with('dropofflocation')
			->get();
			
		}
		if($request->from == null && $request->to == null && $request->receive_date == null && $request->advance_status == 3)
		{
			$way_plan_list = WayPlanSchedule::where('reject_status',1)
			->with('receivelocation')
			->with('dropofflocation')
			->get();
			
		}
		if($request->from == null && $request->to == null && $request->receive_date == null && $request->advance_status == 4)
		{
			$way_plan_list = WayPlanSchedule::where('customer_status',3)
			->with('receivelocation')
			->with('dropofflocation')
			->get();
			
		}
		if($request->from == null && $request->to == null && $request->receive_date == null && $request->advance_status == 5)
		{
			
			$way_plan_list = WayPlanSchedule::where('customer_status',4)
			->with('receivelocation')
			->with('dropofflocation')
			->get();
			
		}
		//end test
		if($request->from != null && $request->to != null && $request->receive_date != null && $request->advance_stauts == 0){
			
			$way_plan_list = WayPlanSchedule::where('receive_point',$request->from)
						->where('dropoff_point',$request->to)
						->where('receive_date',$request->receive_date)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		//two
		if($request->from != null && $request->to != null && $request->receive_date == null && $request->advance_status == 1){
			// dd("good luck");
        	$way_plan_list = WayPlanSchedule::where('receive_point',$request->from)
				->where('dropoff_point',$request->to)
				->where('customer_status',2)
				->with('receivelocation')
				->with('dropofflocation')
				->get();
		  }
		if($request->from != null && $request->to != null && $request->receive_date == null && $request->advance_stauts == 2){
			// dd('success');
				$way_plan_list = WayPlanSchedule::where('receive_point',$request->from)
						->where('dropoff_point',$request->to)
						->where('customer_status','<>',2)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		if($request->from != null && $request->to != null && $request->receive_date == null && $request->advance_stauts == 3){
			// dd('success');
				$way_plan_list = WayPlanSchedule::where('receive_point',$request->from)
						->where('dropoff_point',$request->to)
						->where('reject_status',1)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		if($request->from != null && $request->to != null && $request->receive_date == null && $request->advance_status == 4){
			dd('success');
				$way_plan_list = WayPlanSchedule::where('receive_point',$request->from)
						->where('dropoff_point',$request->to)
						->where('customer_status',3)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		if($request->from != null && $request->to != null && $request->receive_date == null && $request->advance_status == 5){
			// dd('success');
				$way_plan_list = WayPlanSchedule::where('receive_point',$request->from)
						->where('dropoff_point',$request->to)
						->where('customer_status',4)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		if($request->from == null && $request->to == null && $request->receive_date != null && $request->advance_status == 1){
			// dd('success');
			$way_plan_list = WayPlanSchedule::where('receive_date',$request->receive_date)
						->where('customer_status',2)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		if($request->from == null && $request->to == null && $request->receive_date != null && $request->advance_status == 2){
			// dd('success');
				$way_plan_list = WayPlanSchedule::where('receive_date',$request->receive_date)
						->where('customer_status','<>',2)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		if($request->from == null && $request->to == null && $request->receive_date != null && $request->advance_status == 3){
			// dd('success');
				$way_plan_list = WayPlanSchedule::where('receive_date',$request->receive_date)
						->where('reject_status',1)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		if($request->from == null && $request->to == null && $request->receive_date != null && $request->advance_status == 4){
			// dd('success');
				$way_plan_list = WayPlanSchedule::where('receive_date',$request->receive_date)
						->where('customer_status',3)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		if($request->from == null && $request->to == null && $request->receive_date != null && $request->advance_status == 5){
			// dd('success');
				$way_plan_list = WayPlanSchedule::where('receive_date',$request->receive_date)
						->where('customer_status',4)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		//end two
		if($request->from != null && $request->to != null && $request->receive_date != null && $request->advance_status == 1){
			// dd('success');
			$way_plan_list = WayPlanSchedule::where('receive_point',$request->from)
						->where('dropoff_point',$request->to)
						->where('receive_date',$request->receive_date)
						->where('customer_status',2)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		if($request->from != null && $request->to != null && $request->receive_date != null && $request->advance_status == 2){
			// dd('success');
				$way_plan_list = WayPlanSchedule::where('receive_point',$request->from)
						->where('dropoff_point',$request->to)
						->where('receive_date',$request->receive_date)
						->where('customer_status','<>',2)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		if($request->from != null && $request->to != null && $request->receive_date != null && $request->advance_status == 3){
			// dd('success');
				$way_plan_list = WayPlanSchedule::where('receive_point',$request->from)
						->where('dropoff_point',$request->to)
						->where('receive_date',$request->receive_date)
						->where('reject_status',1)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		if($request->from != null && $request->to != null && $request->receive_date != null && $request->advance_status == 4){
			// dd('success');
				$way_plan_list = WayPlanSchedule::where('receive_point',$request->from)
						->where('dropoff_point',$request->to)
						->where('receive_date',$request->receive_date)
						->where('customer_status',3)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		if($request->from != null && $request->to != null && $request->receive_date != null && $request->advance_status == 5){
			// dd('success');
				$way_plan_list = WayPlanSchedule::where('receive_point',$request->from)
						->where('dropoff_point',$request->to)
						->where('receive_date',$request->receive_date)
						->where('customer_status',4)
						->with('receivelocation')
						->with('dropofflocation')
						->get();
		}
		
	
		return response()->json($way_plan_list);
	}

//rider
	protected function search_rider_way(Request $request){
			$rider_id =  session()->get('user')->id;
		$wayplanning = Way::where('date',$request->date)
								->where('rider_name',$rider_id)->get(); 
		// dd($wayplanning[0]->way_plannings);
		$complete = [];
		foreach($wayplanning[0]->way_plannings as $w){
            $com = DB::table('wayplanning_order')->where('way_plan_schedule_id',$w->way_plan_schedule_id)->first();
			array_push($complete,$com);
		}
		$schedule = WayPlanSchedule::where('wayplanning_flag',1)->with('receivelocation')->get();
		return response()->json([
			"wayplanning" => $wayplanning,
			"schedule" => $schedule,
			"complete" => $complete,
		]);
	}
	protected function complete_way(Request $request){
		// dd($request->all());
		if($request->hasFile('photo'))
         {
        $file = $request->file('photo');
        $originalname = $file->getClientOriginalName();
        $filename =$originalname;
        $file->move('public/images', $filename);
		 }
        // dd($photo);
		$folderPath = public_path('public/images');
      
        $image_parts = explode(";base64,", $request->signed);
            
        $image_type_aux = explode("image/", $image_parts[0]);
          
        $image_type = $image_type_aux[1];
          
        $image_base64 = base64_decode($image_parts[1]);

        $signature = uniqid() . '.'.$image_type;
        //   dd($signature);
        $file = $folderPath . $signature;

        file_put_contents($file, $image_base64);

		$complete = DB::table('wayplanning_order')->where('way_plan_schedule_id',$request->way_id)->update(['arrive_date' => $request->arr_date,'arrive_time' => $request->arr_time,'receive_photo' => $filename,'signature' => $signature]);
		// dd($complete);
	   alert()->success("Successfully Registered Complete WayPlan Schedule!");
	   return redirect()->route('rider_way');
}
//end rider

//remark
    protected function save_remark(Request $request){
		// dd($request->all());
		$wayplanning = DB::table('wayplanning_order')
						->where('way_plan_schedule_id',$request->id)
						->first();
		// dd($wayplanning->way_planning_id);
		$wayplan = WayPlanning::find($wayplanning->way_planning_id);
		// dd($wayplan->remark);
		$wayplan->remark = $request->remark;
		$wayplan->save();
		// dd($wayplan->remark);ဉ
		return response()->json(["wayplan" => $wayplan,]);
	}
//endremark

	protected function changes_reject_way(Request $request)
	{
		// dd($request->all());
		// $reject_way = WayPlanSchedule::find();
		// $reject_way->reject_status = 1;
        $validator = Validator::make($request->all(), [
            "reject_date" => "required",
            "reject_remark" => "required",

        ]);

        if ($validator->fails()) {

            alert()->error('Please Fill All Fields!');
            return redirect()->back();
        }
        $change_reject  = WayPlanSchedule::find($request->wayID);
        $change_reject->reject_status = 1;
        $change_reject->reject_date = $request->reject_date;
        $change_reject->reject_remark = $request->reject_remark;
        $change_reject->save();
        return back();

	}
    protected function show_reject_way(Request $request)
	{
		// dd($request->all());
		// $reject_way = WayPlanSchedule::find();
		// $reject_way->reject_status = 1;
        $location = Location::all();
        $reject_way = WayPlanSchedule::where('reject_status',1)->with('receivelocation')->with('dropofflocation')->get();
        return view('Admin.reject_way_list',compact('reject_way','location'));


		$ldate = new DateTime('today');
		$date = $ldate->format('Y-m-d');
		// dd($date);
		// $validator = Validator::make($request->all(), [

		// 	"perKg" => "required",
		// 	"chargess" => "required",
		// 	"customer_name" => "required",
		// 	"token" => "required",
		// 	"customer_phone" => "required",
		// 	"cust_addr" => "required",
		// 	"remark" => "required",
		// 	"receive_point" => "required",
		// 	"qty" => "required",
		// 	"receive_date" => "required",
		// 	"weight" => "required",
		// 	"wg_type" => "required",
		// 	"drop_point" => "required",
		// 	"charge" => "required",
		// 	"drop_date" => "required",
		// 	"est_charge" => "required",

		// ]);
		// if ($validator->fails()) {

		// 	alert()->error('Please Fill All Fields!');
		// 	return redirect()->back();
		// }
		$store_wayplan = WayPlanSchedule::create([
			'customer_name'=> $request->customer_name,
			'customer_phone'=> $request->customer_phone,
			'receive_point'=> $request->receive_point,
			'receive_date'=> $request->receive_date,
			'dropoff_point'=> $request->drop_point,
			'dropoff_date'=> $request->drop_date,
			'remark'=> $request->remark,
			'parcel_quantity'=> $request->qty,
			'total_weight'=> $request->weight,
			'per_kg_charges'=> $request->perKg,
			'package_id'=> $request->packageID,
			'total_charges'=> $request->chargess,
			'customer_address' => $request->cust_addr,
			'myawady_date' => $date,
			'customer_date' => $date,
			'token' => $request->token,

		]);
		// dd($request->all());
		alert()->success("Successfully Stored WayPlan Schedule!");
		return back();

	}
	protected function wayplanlist()
	{
		return view('Admin.wayplanlist');

	}
	protected function wayplanning_search_ajax(Request $request){
		    //   dd($request->all());
			$way_plan_list = WayPlanSchedule::where('receive_point',$request->from)
						->where('dropoff_point',$request->to)
						->where('myawady_status',1)
						->where('wayplanning_flag',0)
						->with('receivelocation')
						->get();
			$time = WayPlanning::where('way_id',$request->hide_id)->orderBy('id', 'desc')->first();
			// $wayplan = WayPlanSchedule::where('wayplanning_flag',1)
			// 					->where('wayplan_id',$id)->get();
			// dd($time);
		   return response()->json([
			'time' =>$time,
			'way_plan_list' => $way_plan_list,
			// 'added_wayplan' => $wayplan,
		]);
	}
    protected function store_package(Request $request){
        // dd($request->all());
		$from = Location::find($request->from_city);
		$to = Location::find($request->to_city);

         $packages =   Package::create([
            'package_name' => $request->name,
            'from_city_id' => $request->from_city,
            'to_city_id' => $request->to_city,
            'from_city_name' => $from->name,
            'to_city_name' => $to->name,
        ]);
		for($i=0;$i<count($request->min);$i++)
		{
			if($request->currency[$i] == 1)
			{
				$per_kg = "MMK";
			}
			elseif($request->currency[$i] == 2)
			{
				$per_kg = "BAHT";
			}
			elseif($request->currency[$i] == 3)
			{
				$per_kg = "USD";
			}
			$package_kg_prices = PackageKg_Price::create([
            'package_id'=> $packages->id,
            'min_kg'     =>$request->min[$i],
            'max_kg'     =>$request->max[$i],
            'per_kg_price' => $request->per_kg_charges[$i],
            'currency' => $per_kg,
        	]);
		}

		// dd("no");
    alert()->success('Successfully Stored Charges Information!');

    return redirect()->route('township');
    }

    protected function charges(Request $request){
        $location = Location::all();
        return view('Admin.charges',compact('location'));
    }

	protected function store_news(Request $request){
		// dd($request->img);
		// $validator = Validator::make($request->all(), [
		// 	'title' => 'required',
		// 	'description' => 'required',
		// 	'image' => 'required|file'
		// ]);

		// if ($validator->fails()) {

		// 	alert()->error('Something Wrong');

		// 	return redirect()->back();
		// }
		if($request->hasFile('img'))
         {
        $file = $request->file('img');
        $originalname = $file->getClientOriginalName();
        $filename =$originalname;
        $file->move('public/images', $filename);
          }
		$title = $request->title;
		// $img = $request->img;
		$des = $request->des;

		News::create([
			'title' => $title,
			'image' => $filename,
			'description'  => $des
		]);

		alert()->success('Successfully Stored in News');

		return back();
	}

	protected function store_contact(Request $request){
		// dd($request->all());
		// $validator = Validator::make($request->all(), [
		// 	'location' => 'required',
		// 	'address' => 'required',
		// 	'phone_number' => 'required'
		// ]);

		// if ($validator->fails()) {

		// 	alert()->error('Something Wrong');

		// 	return redirect()->back();
		// }
		
		$location = $request->locat;
		// $img = $request->img;
		$address = $request->address;
		$phone = $request->phno;

		Contact::create([
			'location' => $location,
			'address' => $address,
			'phone_number'  => $phone
		]);

		alert()->success('Successfully Stored in Contacts');

		return back();
	}

	protected function getBookingListUi()
	{

		$doctors = Doctor::all();

		$departments = Department::all();

		$now = new DateTime;

		$today = $now->format('Y-m-d');

		$booking_lists = Booking::where('booking_date', $today)->with('doctor')->get();

		$booking_count = count($booking_lists);

		return view('Admin.booking_list', compact('doctors', 'departments','booking_lists','booking_count'));
	}

	protected function ajaxDoctorBookingList(Request $request)
	{

		$request_date = $request->check_date;

		$status = $request->status;

		$doctor = Doctor::where('id', $request->doctor_id)->with('department')->first();


		if ($status == 6) {

			$booking_lists = Booking::where('booking_date', $request_date)->where("doctor_id", $request->doctor_id)->get();
		} else {

			$booking_lists = Booking::where('booking_date', $request_date)->where("doctor_id", $request->doctor_id)->where("status", $status)->get();
		}

		$booking_count = count($booking_lists);

		return response()->json([
			'doctor' => $doctor,
			'booking_lists' => $booking_lists,
			'booking_count' => $booking_count,
			'status' => $status,
		]);
	}

	protected function AjaxTokenCheckIn(Request $request)
	{

		$token_number = $request->token_number;

		$booking = Booking::where('token_number', $token_number)->first();

		$booking_list = Booking::where('doctor_id', $booking->doctor_id)->where('booking_date', $booking->booking_date)->get();

		return response()->json([
			'booking' => $booking,
			'booking_lists' => $booking_list,
		]);
	}

	protected function AdminProfile(Request $request)
	{

		$user_id = getUserId($request);

		$user = $request->session()->get('user');

		$user_email = $user->email;

		$admin = Admin::where('user_id', $user_id)->first();

		return view('Admin.profile', compact('admin', 'user_email'));
	}

	protected function counterProfile(Request $request,$counter_id)
	{

		$admin = Employee::with('user')->findOrfail($counter_id);
		$user_email= $admin->user->email;
		return view('Admin.profile', compact('admin','user_email'));
	}
	protected function counterProfileEdit(Request $request,$counter_id)
	{

		$admin = Employee::with('user')->findOrfail($counter_id);
		$user_email= $admin->user->email;
		return view('Admin.editprofile', compact('admin','user_email'));
	}
	protected function counterProfileEditSave(Request $request)
	{
		$validator = Validator::make($request->all(), [
			"employee_id" => "required",
			"name" => "required",
			"code" => "required",
			"phone" => "required",
			"dob" => "required",
			"email" => "required",
		]);
		if($request->password){
			$validator = Validator::make($request->all(), [
				"employee_id" => "required",
				"name" => "required",
				"code" => "required",
				"phone" => "required",
				"dob" => "required",
				"email" => "required",
				"password"=> "required|min:6"
			]);
		}

		if ($validator->fails()) {

			alert()->error('Please Fill All Fields!');
			return redirect()->back();
		}
		$employee = Employee::findOrfail($request->employee_id);

		$employeeupdate=$employee->update([
			"name" => $request->name,
			"employee_code" => $request->code,
			"phone" => $request->phone,
			"dob" => $request->dob
		]);
		$employee->user->update([
			'email'=> $request->email
		]);
		if($request->password){
			$employee->user->update([
				'password'=> Hash::make($request->password)
			]);
		}
		alert()->success('Successfully Changed!');

		return back();
	}

	public function createCounter(Request $request)
	{
		return view('Admin.createcounter');
	}
	public function createCounterSave(Request $request)
	{
			$validator = Validator::make($request->all(), [
				"name" => "required",
				"phone" => "required",
				"dob" => "required",
				"email" => "required",
				"password"=> "required|min:6"
			]);

		if ($validator->fails()) {

			alert()->error('Please Fill All Fields!');
			return redirect()->back();
		}
		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'phone' => $request->phone,
			'password' => Hash::make($request->password)
		]);
		$user->assignRole(4);

        if ($request->hasfile('image')) {

			$image = $request->file('image');

			$name = $image->getClientOriginalName();

			$photo_path =  time()."-".$name;

			$image->move(public_path() . '/image/admin/', $photo_path);

			$path = '/image/admin/'. $photo_path;

		}
		else{
			$path = '/image/admin/user.jpg';

		}
		$employee_code =  "EMP_" . sprintf("%03s", $user->id);


		$employee=Employee::create([
			"name" => $request->name,
			"employee_code" => $request->code,
			"phone" => $request->phone,
			"dob" => $request->dob,
			"user_id"=> $user->id,
			"photo" => $path,
			"position_id" =>1,
			"employee_code" => $employee_code
		]);

		alert()->success('Successfully Added!');

		return redirect()->route('doctor_list');
	}
	protected function AdminChangePassUI(Request $request)
	{

		return view('Admin.change_pw');
	}

	protected function AdminChangePass(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'current_pw' => 'required',
			'new_pw' => 'required|confirmed|min:6'
		]);

		if ($validator->fails()) {

			alert()->error('Something Wrong!');
			return redirect()->back();
		}

		$user = $request->session()->get('user');

		$current_pw = $request->current_pw;

		if (!\Hash::check($current_pw, $user->password)) {

			alert()->info("Wrong Current Password!");

			return redirect()->back();
		}

		$has_new_pw = \Hash::make($request->new_pw);

		$user->password = $has_new_pw;

		$user->save();

		alert()->success('Successfully Changed!');

		return redirect()->route('admin_dashboard');
	}

	protected function DepartmentList()
	{

		$department_lists = Department::all();

		return view('Admin/Department/department_list', compact('department_lists'));
	}

//Way Planning
	protected function store_way(Request $request){
		// dd($request->all());
		$validator = Validator::make($request->all(), [
			'way_no' => 'required',
			'date' => 'required',
		]);

		if ($validator->fails()) {

			alert()->error('Something Wrong');

			return redirect()->back();
		}
		else{
		    Way::create([
				'way_no' => $request->way_no,
				'date' => $request->date,
				'rider_name' => $request->rider_name,
				'start_time' => $request->start_time,
				'end_time' => $request->end_time,
			]);
			alert()->success('Successfully Way Stored!');
			return redirect()->back();
		}
	}

	//To update with Modal Box
	protected function CreateDepartment()
	{

		return view('Admin/Department/create_department');
	}

	protected function StoreDepartment(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'description' => 'required',
			'image' => 'required|file'
		]);

		if ($validator->fails()) {

			alert()->error('Something Wrong');

			return redirect()->back();
		}

		if ($request->hasfile('image')) {

			$image = $request->file('image');
			$name = $image->getClientOriginalName();
			$image->move(public_path() . '/image/Department_Image/', $name);
			$image = $name;
		}
		$department = Department::create([
			'name' => $request->name,
			'description' => $request->description,
			'photo_path' => $image,
			'status' => $request->status,
		]);

		$department_id = $department->id;

		$department_code = "DEPT" . sprintf("%04s", $department_id);

		$department->department_code = $department_code;

		$department->save();

		alert()->success('Successfully Added!');

		return redirect()->route('department_list');
	}

	protected function EditDepartment($department, Request $request)
	{

		$department = Department::where('id', $department)->first();

		return view('Admin/Department/edit_department', compact('department'));
	}

	protected function UpdateDepartment($department, Request $request)
	{

		$department = Department::where('id', $department)->first();

		if ($request->dept_status == "on") {

			$department->status = 1;
		} else {

			$department->status = 2;
		}

		$department->name = $request->name;

		$department->description = $request->description;

		$department->save();

		alert()->success('ပြင်ဆင်တာ​အောင်မြင်ပါသည်');

		return redirect()->route('department_list');
	}

	//For Phone Booking From Reception
	protected function GetToken()
	{

		$doctors = Doctor::all();

		return view('Admin.get_token', compact('doctors'));
	}

	//For Phone Booking from Reception
	protected function SearchDoctors(Request $request)
	{

		$now = new DateTime;

		$today = $now->format('Y-m-d');

		$validator = Validator::make($request->all(), [
			'doctor_id' => 'required',
		]);

		if ($validator->fails()) {

			return response()->json(array("errors" => $validator->getMessageBag()), 422);
		}

		$doctor = Doctor::find(request('doctor_id'));

		$days = $doctor->day;

		$doc_range = explode("-", $doctor->doc_info->booking_range);

		$range = 7 *  $doc_range[0];

		$today_string = strtotime($today);

		$available_date = array();

		$final_date = array();

		$start_time_array = array();

		$end_time_array = array();

		for ($i = 0; $i <= $range; $i++) {

			array_push($available_date, date('d-m-Y,l', strtotime("+$i day", $today_string)));
		}

		foreach ($available_date as $ava_date) {

			foreach ($days as $day) {

				if ($day->name == date('l', strtotime($ava_date))) {

					$start_time = date('h:i A', strtotime($day->pivot->start_time));

					$end_time = date('h:i A', strtotime($day->pivot->end_time));

					$object = collect([$ava_date, $start_time, $end_time]);

					array_push($final_date, $object);
				}
			}
		}

		return response()->json($final_date);
	}

	protected function StoreBookingToken(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'booking_date' => 'required',
			'name' => 'required',
			'age' => 'required',
			'phone' => 'required',
			'address' => 'required',
			'bookings' => 'required',
		]);

		if ($validator->fails()) {

			alert()->error('Something Wrong');

			return redirect()->back();
		}
		$person_list = $this->routeList;

		$date = explode(',', $request->booking_date);

		$check_date = date('Y-m-d', strtotime($date[0]));

		$date_save = date('md', strtotime($date[0]));

		$doctor = Doctor::find(request('doctor'));

		$reserved_token = $doctor->doc_info->reserved_token;

		$check_booking = Booking::where('doctor_id', request('doctor'))
			->whereDate('booking_date', $check_date)
			->get();



			if($request->bookings== "manualBooking"){
				$zoom_id= null;
				$zoom_psw= null;
				$start_url= null;
				$join_url= null;
				$booking_status=0;
			}
			else {

				$path = 'users/me/meetings';
				$response = $this->zoomPost($path, [
					'topic' => "online",
					'type' => self::MEETING_TYPE_SCHEDULE,
					'start_time' => $this->toZoomTimeFormat($check_date),
					'duration' => 30,
					'agenda' => "Data",
					'settings' => [
						'host_video' => false,
						'participant_video' => false,
						'waiting_room' => true,
					]
				]);

				$zoom = json_decode($response->body(), true);
				Log::channel('custom')->info($zoom);
				$zoom_id= $zoom['id'];
				$zoom_psw= $zoom['password'];
				$start_url= $zoom['start_url'];
				$join_url= $zoom['join_url'];
				$booking_status=1;

			}

		if (count($check_booking) == 0) {

			for ($i = 1; $i <= $reserved_token; $i++) {

				$random = array_rand($person_list);

				$name = $person_list[$random];

				$book_token = Booking::create([
					'name' => $name,
					'age' => 33,
					'phone' => " 09250206903",
					'address' => "Tarmwe Yangon",
					'booking_date' => $check_date,
					'status' => 1,
					'submit_by' => 0,
					'user_id' => 1,
					'doctor_id' => request('doctor'),
					'floor_id' => 1,
					'booking_status' => 2, //manual booking-0 online-1 reserved-2
				]);

				$token_number = "TKN-" . sprintf("%03s", $i);

				$book_token->token_number = $token_number;

				$book_token->save();
			}

			$check_booking_real = Booking::where('doctor_id', request('doctor'))->whereDate('booking_date', $check_date)->get();

			$booking_array = $check_booking_real->toArray();

			$last_token_booking_arry = array_column($booking_array, 'token_number');

			$last_token = end($last_token_booking_arry);

			$last_token_number = explode('-', $last_token);

			$token = $last_token_number[1] + 1;

			$real_token_number = "TKN-" . sprintf("%03s", $token);

			$real_book_token = Booking::create([
				'token_number' =>  $real_token_number,
				'name' => $request->name,
				'age' => $request->age,
				'phone' => $request->phone,
				'address' => $request->address,
				'booking_date' => $check_date,
				'status' => 1,
				'submit_by' => 0,
				'user_id' => 1,
				'doctor_id' => request('doctor'),
				'floor_id' => 1,
				'booking_status' => $booking_status,
				'zoom_id' => $zoom_id,
				'zoom_psw' => $zoom_psw,
				'start_url' => $start_url,
				'join_url' => $join_url,
			]);

			// alert()->success('Token Number', $real_token_number)->persistent('Close');

			// return redirect()->back();
		} else {

			$booking_array = $check_booking->toArray();

			$last_token_booking_arry = array_column($booking_array, 'token_number');

			$last_token = end($last_token_booking_arry);

			$last_token_number = explode('-', $last_token);

			$token = $last_token_number[1] + 1;

			$real_token_number = "TKN-" . sprintf("%03s", $token);

			$real_book_token = Booking::create([
				'token_number' =>  $real_token_number,
				'name' => $request->name,
				'age' => $request->age,
				'phone' => $request->phone,
				'address' => $request->address,
				'booking_date' => $check_date,
				'status' => 1,
				'user_id' => 1,
				'doctor_id' => request('doctor'),
				'floor_id' => 1,
				'booking_status' => $booking_status,
				'zoom_id' => $zoom_id,
				'zoom_psw' => $zoom_psw,
				'start_url' => $start_url,
				'join_url' => $join_url,
			]);

		}
		$doctor= Doctor::findOrfail(request('doctor'));
		$doctorService= $doctor->services->sum('charges');
		$amount1  =$doctor->online_early_payment/1700; //1.76
		$amount2=round($amount1, 2);

		$amount3 = $amount2* 100;
		$amount =sprintf("%012s", $amount3);
			// dd($doctorService->sum('charges'));
			// alert()->success('Token Number', $real_token_number)->persistent('Close');
		return view('payments.payment4',compact('doctorService','real_book_token','doctor','amount'));

	}

	protected function editBookingRecord(Request $request)
	{

		try {

			$booking = Booking::findOrFail($request->booking_id);
		} catch (\Exception $e) {

			alert()->error("Booking Not Found!")->persistent("Close!");

			return response()->json([
				'status' => "failed",
			]);
		}

		$booking->name = $request->name;

		$booking->age = $request->age;

		$booking->phone = $request->phone;

		$withdateOrnodate= $request->withdateOrnodate;

		if ($booking->save()) {

			return response()->json([$booking->save(),$withdateOrnodate]);;
		} else {

			alert()->error("Database Error!")->persistent("Close!");

			return redirect()->back();
		}
	}

	protected function adminconfirmbooking(Request $request)
	{

		try {

			$booking = Booking::findOrFail($request->booking_id);
		} catch (\Exception $e) {

			alert()->error("Booking Not Found!")->persistent("Close!");

			return response()->json([
				'status' => "failed",
			]);;
		}

		$booking->status = 1;

		if ($booking->save()) {

			return response()->json($booking->save());;
		} else {

			alert()->error("Database Error!")->persistent("Close!");

			return redirect()->back();
		}
	}

	protected function admincheckinbooking(Request $request)
	{

		try {

			$booking = Booking::findOrFail($request->booking_id);
		} catch (\Exception $e) {

			alert()->error("Booking Not Found!")->persistent("Close!");

			return response()->json([
				'status' => "failed",
			]);;
		}

		$booking->status = 4;

		if ($booking->save()) {

			return response()->json($booking->save());;
		} else {

			alert()->error("Database Error!")->persistent("Close!");

			return redirect()->back();
		}
	}
	protected function admincanclebooking(Request $request)
	{

		try {

			$booking = Booking::findOrFail($request->booking_id);
		} catch (\Exception $e) {

			alert()->error("Booking Not Found!")->persistent("Close!");

			return response()->json([
				'status' => "failed",
			]);;
		}

		$booking->status = 2;

		if ($booking->save()) {

			return response()->json($booking->save());;
		} else {

			alert()->error("Database Error!")->persistent("Close!");

			return redirect()->back();
		}
	}


	protected function admindonebooking(Request $request)
	{

		try {
			$booking = Booking::findOrFail($request->booking_id);
		} catch (\Exception $e) {

			alert()->error("Booking Not Found!")->persistent("Close!");

			return response()->json([
				'status' => "failed",
			]);;
		}
		if ($booking->description ==null || $booking->diagnosis == null || $booking->remark_booking_date==null) {

			return response()->json([
				$booking->doctor->services,
				0,
			]);
		}
		$booking->status = 5;
		if ($booking->save()) {

			return response()->json([
				$booking->doctor->services,
				1,
			]);
		} else {

			alert()->error("Database Error!")->persistent("Close!");

			return redirect()->back();
		}
	}

	protected function checkedallconfirm(Request $request)
	{

		try {

			$checked_ids = $request->checked_id;
		} catch (\Exception $e) {

			alert()->error("Something worng!")->persistent("Close!");

			return response()->json([
				'status' => "failed",
			]);;
		}
		$checked_id_objs = (object) $checked_ids;

		foreach ($checked_id_objs as $checked_id_obj) {

			$bookingcomfirm = Booking::findOrFail($checked_id_obj);
			$bookingcomfirm->status = 1;
			$bookingcomfirm->save();
		}
		return response()->json(1);
		// $booking->status = 1;

		// if($booking->save()){

		// 	return response()->json($booking->save());;

		// }else{

		//     alert()->error("Database Error!")->persistent("Close!");

		//      return redirect()->back();
		// }
	}

	//For mobile app
	protected function announcementStore(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'title' => 'required',
			'description' => 'required',
			'short_description' => 'required',
			'photo' => 'required',
		]);

		if ($validator->fails()) {

			alert()->error('Something Wrong');

			return redirect()->back();
		}

		$booking_range = request('range');

		$weekormonth = request('weekormonth');

		if ($request->hasfile('photo')) {

			$image = $request->file('photo');

			$name = $image->getClientOriginalName();

			$image_name =  time() . "-" . $name;

			$image->move(public_path() . '/image/ann/', $image_name);

			$image = $image_name;
		}

		$now = new DateTime('Asia/Yangon');

		$today = $now->format('Y-m-d');

		$today_string = strtotime($today);

		if ($weekormonth == "month") {

			$expire_date = strtotime("+$booking_range months", $today_string);
		} else {

			$expire_date = strtotime("+$booking_range week", $today_string);
		}

		$announcement = Announcement::create([
			'title' => request('title'),
			'description' => request('description'),
			'short_description' => request('short_description'),
			'photo_path' => $image_name,
			'slide_status' => 0,
			'expired_at' => date('Y-m-d', $expire_date),
		]);

		alert()->success('Successfully Added!')->autoclose(2000);

		return redirect()->back();
	}

	protected function advertiesmentStore(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'title' => 'required',
			'short_description' => 'required',
			'description' => 'required',
			'short_description' => 'required',
			'photo' => 'required',
			'start_date' => 'required'
		]);

		if ($validator->fails()) {

			alert()->error('Something Wrong');

			return redirect()->back();
		}

		$booking_range = request('range');

		$weekormonth = request('weekormonth');

		if ($request->hasfile('photo')) {

			$image = $request->file('photo');

			$name = $image->getClientOriginalName();

			$image_name =  time() . "-" . $name;

			$image->move(public_path() . '/image/adv/', $image_name);

			$image = $image_name;
		}

		$today = Carbon::parse($request->start_date);
		// $now = $request->start_date;
		// dd($now);
		// $today = $now->format('Y-m-d');
		$req_date = $today->format('Y-m-d');
		$today_string = strtotime($today);

		if ($weekormonth == "month") {

			$expire_date = strtotime("+$booking_range months", $today_string);
		} else {

			$expire_date = strtotime("+$booking_range week", $today_string);
		}

		$advertisement = Advertisement::create([
			'title' => request('title'),
			'description' => request('description'),
			'short_description' => request('short_description'),
			'photo_path' => $image_name,
			'expired_at' => date('Y-m-d', $expire_date),
			'start_date' =>  $req_date
		]);

		alert()->success('Successfully Added!')->autoclose(2000);

		return redirect()->back();
	}

	public function advertiesmentIndex()
	{
		$advertisements = Advertisement::all();
		return view('Admin.Advertisment.advertisment', compact('advertisements'));
	}
	public function announcementIndex()
	{
		$announcements = Announcement::all();
		return view('Admin.Advertisment.announcement', compact('announcements'));
	}

	protected function getStateList()
	{

		$state_lists = State::all();

		return view('Admin.state_list', compact('state_lists'));
	}

	protected function storeTown(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'code' => 'required',
			'name' => 'required',
			'state_id' => 'required',
			'allowdelivery'=> 'required',
		]);
		if($request->allowdelivery == 1){
			$validator = Validator::make($request->all(), [
				'code' => 'required',
				'name' => 'required',
				'state_id' => 'required',
				'allowdelivery'=> 'required',
				'charges' => 'required'
			]);
		}
		if ($validator->fails()) {

			alert()->error('Something Wrong!');

			return redirect()->back();
		}

		try {

			$town = Town::create([
				'town_code' => $request->code,
				'town_name' => $request->name,
				'state_id' => $request->state_id,
				'status' => $request->allowdelivery,
				'delivery_charges'=> $request->charges,
			]);

		} catch (\Exception $e) {

			alert()->error('Something Wrong!');

			return redirect()->back();
		}

		alert()->success('Successfully Added');

		return redirect()->back();
	}

	protected function ajaxSearchTown(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'state_id' => 'required',
		]);

		if ($validator->fails()) {

			return response()->json(array("errors" => $validator->getMessageBag()), 422);
		}

		$town_lists = Town::where('state_id', $request->state_id)->get();

		return response()->json($town_lists);
	}

	protected function editTown(Request $request)
	{

		try {

			$town = Town::findOrFail($request->town_id);
		} catch (\Exception $e) {

			alert()->error("Town Not Found!")->persistent("Close!");

			return redirect()->back();
		}


		$town->town_code = $request->code;
		$town->town_name = $request->name;
		$town->status = $request->allowdelivery;
		$town->delivery_charges = $request->editcharges;

		$town->save();

		alert()->success('Successfully Updated!');

		return redirect()->back();
	}

	public function show_admin()
	{
		return view('Admin.dashboard');
	}
    
    public function delete_reject_way($id)
	{
		// dd($id);
		$soft_delete = WayPlanSchedule::destroy($id);//add date time format in deleted at column
		// $trash = WayPlanSchedule::onlyTrashed()->get();//get data from deleted at
		// dd($trash);
		return back();
	}
	public function wayplanning(){
		$rider = DB::table('role_user')->where('role_id',6)->get();
	
		$riders = [];
		foreach($rider as $rid){
			$ride = User::where('id',$rid->user_id)->first();
			// dd($ride->name);
			array_push($riders,$ride);
		}
		$ways_list = Way::all();
		return view('Admin.wayplanning',compact('riders','ways_list'));
	}
	public function add_wayplan($id){
		$wayplan_id = $id;
		$package = Package::all();
		$location = Location::all();
		$wayplan = WayPlanSchedule::where('wayplanning_flag',1)
								->where('way_planning_id',$id)->get();
		$wayplanning = [];
		foreach($wayplan as $w){
			$plan = WayPlanning::where('way_plan_schedule_id',$w->id)->first();
			array_push($wayplanning,$plan);
		}
		$way = Way::find($id);
		$time_Unique = $way->way_plannings->unique(['start_time']);
		return view('Admin.addwayplan',compact('package','way','wayplan_id','wayplan','location','wayplanning','time_Unique'));
	}
	public function show_added_wayplan($id){
		// dd($id);
		$wayplan_id = $id;
		$location = Location::all();
		$wayplan = WayPlanSchedule::where('wayplanning_flag',1)
		->where('way_planning_id',$id)
		->get();
       // dd($wayplan);
	   $wayplanning = [];
		foreach($wayplan as $w){
			$plan = WayPlanning::where('way_plan_schedule_id',$w->id)->first();
			array_push($wayplanning,$plan);
		}
		$way = Way::find($id);
		// dd($wayplanning);
		
		$time_Unique = $way->way_plannings->unique(['start_time']);
		// dd($time_Unique);
		return view('Admin.addedwaylist',compact('wayplan','location','wayplan_id','wayplanning','time_Unique'));
	}
	public function more_add_wayplan(Request $request,$id){
		// dd($request->all());
		// dd($id);
		$route = $request->rout_name;
		$city =  explode(" ", $route);
		$from = $city[0];
		$to = $city[2];
		if($from == 'BKK'){
			$from_city_id = 1;
		}else{
			$from_city_id = 4;
		}
		if($to == 'YGN'){
			$to_city_id = 2;
		}else{
			$to_city_id = 3;
		}
		$start_time = $request->start_time;
		$end_time = $request->end_time;
		$wayplan_id = $id;
		$package = Package::all();
		$location = Location::all();
		$wayplan = WayPlanSchedule::where('wayplanning_flag',1)
								->where('way_planning_id',$id)->get();
		$wayplanning = [];
		foreach($wayplan as $w){
			$plan = WayPlanning::where('way_plan_schedule_id',$w->id)->first();
			array_push($wayplanning,$plan);
		}
		$way = Way::find($id);
		// dd($wayplanning);
		
		$time_Unique = $way->way_plannings->unique(['start_time']);
		return view('Admin.moreaddwayplan',compact('package','way','wayplan','wayplan_id','location','wayplanning','time_Unique','route','from_city_id','to_city_id','start_time','end_time'));
	}
	
	public function rider_way(){
		return view('Admin.rider_way');
	}
	// public function back_rider_way($date){
	// 	$waydate = $date;
	// 	return view('Admin.back_rider_way',compact('waydate'));
	// }
	public function complete_page($id){
		$way_id =  $id;
		// dd($way_id);
		$way_date = WayPlanning::where('way_plan_schedule_id',$way_id)->first();
		$date = $way_date->date;
		return view('Admin.complete_page',compact('way_id','date'));
	}
}
