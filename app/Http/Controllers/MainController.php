<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdPlayHistory;
use App\Models\AdUserClick;
use App\Models\CadAdvertisement;
use App\Models\CadAdvertismentCampaign;
use App\Models\CadUser;
use Auth;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->role_id == 1) {

            $totalUsers    = CadUser::count();
            $activeUsers   = CadUser::where([['is_active', 1], ['is_approved', 1]])->count();
            $inActiveUsers = CadUser::where('is_active', 0)->count();
            $pendingUsers  = CadUser::where('is_approved', 0)->count();

            $users                 = CadUser::getAllUserForAdv();
            $campaigns             = CadAdvertismentCampaign::getAll($user->id);
            $campaignIds           = $campaigns->pluck('id')->toArray();
            $clickedUsers          = AdUserClick::getClicksUser($campaignIds, true);
            $totalViews            = AdPlayHistory::count();
            $totalClicks           = AdUserClick::count();
            $totalCost             = $campaigns->sum('budget');
            $remainingBalance      = $totalCost - $totalViews;
            $totalBudget           = $campaigns->sum('budget');
            $totalExpense          = $totalViews;
            $percentageOfRevAndExp = $totalExpense * 100 / $totalBudget;

            $userChart = [
                [
                    'value' => $activeUsers * 100 / $totalUsers,
                    'label' => 'Active',
                ],
                [
                    'value' => $inActiveUsers * 100 / $totalUsers,
                    'label' => 'Inactive',
                ],
                [
                    'value' => $pendingUsers * 100 / $totalUsers,
                    'label' => 'Pending',
                ],
            ];

            $data = array(
                'userChartData'            => json_encode($userChart),
                'users'                    => $users,
                'campaigns'                => $campaigns,
                'clickedUsers'             => $clickedUsers,
                'totalUsers'               => number_format($users->count()),
                'totalCampaign'            => number_format($campaigns->count()),
                'totalViews'               => number_format($totalViews),
                'totalClicks'              => number_format($totalClicks),
                'totalBudget'              => number_format($totalBudget),
                'totalExpense'             => number_format($totalExpense),
                'percentageOfRevAndExp'    => round($percentageOfRevAndExp, 2),
                'percentageOfClickAndView' => round($totalClicks * 100 / $totalViews, 2),
            );

            return view('pages.admin_dashboard.dashboard', $data);

        } else {

            $campaigns        = CadAdvertismentCampaign::getAll($user->id);
            $campaignIds      = $campaigns->pluck('id')->toArray();
            $totalViews       = AdPlayHistory::getTotalUserViews($campaignIds);
            $totalClicks      = AdUserClick::getTotalUserClicks($campaignIds);
            $totalCost        = $campaigns->sum('budget');
            $remainingBalance = $totalCost - $totalViews;

            $data = array(
                'campaigns'        => $campaigns,
                'totalViews'       => number_format($totalViews),
                'totalClicks'      => number_format($totalClicks),
                'totalCost'        => number_format($totalCost),
                'remainingBalance' => number_format($remainingBalance),
            );

            return view('pages.user_dashboard.dashboard', $data);
        }
    }

    public function loadDashBoard(Request $request)
    {
        if ($request->campId == 'all_camps') {

            $user             = Auth::user();
            $campaigns        = CadAdvertismentCampaign::getAll($user->id);
            $campaignIds      = $campaigns->pluck('id')->toArray();
            $totalViews       = AdPlayHistory::getTotalUserViews($campaignIds);
            $totalClicks      = AdUserClick::getTotalUserClicks($campaignIds);
            $totalCost        = $campaigns->sum('budget');
            $remainingBalance = $totalCost - $totalViews;

        } else {

            $campaigns        = CadAdvertismentCampaign::find($request->campId);
            $totalViews       = AdPlayHistory::getTotalUserViews($campaigns->id);
            $totalClicks      = AdUserClick::getTotalUserClicks($campaigns->id);
            $totalCost        = $campaigns->budget;
            $remainingBalance = $totalCost - $totalViews;
        }

        $data = array(
            'campaigns'        => $campaigns,
            'totalViews'       => number_format($totalViews),
            'totalClicks'      => number_format($totalClicks),
            'totalCost'        => number_format($totalCost),
            'remainingBalance' => number_format($remainingBalance),
        );

        return view('pages.user_dashboard.dashboard_view', $data);
    }

    public function loadUserDashBoard(Request $request)
    {
        if ($request->userId != 1) {

            $campaigns        = CadAdvertismentCampaign::getAll($request->userId);
            $campaignIds      = $campaigns->pluck('id')->toArray();
            $totalViews       = AdPlayHistory::getTotalUserViews($campaignIds);
            $totalClicks      = AdUserClick::getTotalUserClicks($campaignIds);
            $totalCost        = $campaigns->sum('budget');
            $remainingBalance = $totalCost - $totalViews;

            $data = array(
                'campaigns'        => $campaigns,
                'totalViews'       => number_format($totalViews),
                'totalClicks'      => number_format($totalClicks),
                'totalCost'        => number_format($totalCost),
                'remainingBalance' => number_format($remainingBalance),
            );

            return view('pages.user_dashboard.dashboard_view', $data);

        } else {

            $users            = CadUser::getAllUserForAdv();
            $campaigns        = CadAdvertismentCampaign::getAll($request->userId);
            $campaignIds      = $campaigns->pluck('id')->toArray();
            $clickedUsers     = AdUserClick::getClicksUser($campaignIds);
            $totalViews       = AdPlayHistory::count();
            $totalClicks      = AdUserClick::count();
            $totalCost        = $campaigns->sum('budget');
            $remainingBalance = $totalCost - $totalViews;

            $data = array(
                'users'         => $users,
                'campaigns'     => $campaigns,
                'clickedUsers'  => $clickedUsers,
                'totalUsers'    => number_format($users->count()),
                'totalCampaign' => number_format($campaigns->count()),
                'totalViews'    => number_format($totalViews),
                'totalClicks'   => number_format($totalClicks),
            );

            return view('pages.admin_dashboard.dashboard_view', $data);
        }
    }

    public function loadAdClickUserTable(Request $request)
    {
        if ($request->campId == 'all_camps') {

            $user         = Auth::user();
            $campaigns    = CadAdvertismentCampaign::getAll($user->id);
            $campaignIds  = $campaigns->pluck('id')->toArray();
            $clickedUsers = AdUserClick::getClicksUser($campaignIds, true);

        } else {

            $campaigns    = CadAdvertismentCampaign::find($request->campId);
            $clickedUsers = AdUserClick::getClicksUser($campaigns->id, true);
        }

        $data = array(
            'clickedUsers' => $clickedUsers,
        );

        return view('pages.admin_dashboard.ad_click_user_table', $data);
    }

    public function getAnalystDataByAdvId(Request $request)
    {
        $advId  = $request->adv_lists;
        $userId = Auth::user()->role_id;

        $singleAnalysisData = CadAdvertisementAnalyse::getById($advId);

        // return $singleAnalysisData;

        // Defining empty array
        $dateImageClicksByDate = $countries = $cities = $states = $gender = [];

        // return $singleAnalysisData;
        foreach ($singleAnalysisData as $key => $item) {
            // return  $item->user->country->name;
            // echo "outside".$item->link_clicks;
            if ($item->link_clicks) {
                // echo "inside".$item->link_clicks;
                $formatedDate = $this->formatDate($item->created_at);
                if (!array_key_exists($formatedDate, $dateImageClicksByDate)) {
                    $dateImageClicksByDate[$formatedDate] = $item['link_clicks'];
                } else {
                    $dateImageClicksByDate[$formatedDate] = $dateImageClicksByDate[$formatedDate] += $item['link_clicks'];
                }
            }
            // return $item->user->country->name;
            $users = json_decode($item->user, true);
            foreach ($users as $key => $value) {
                // Setting Country wise data
                if ($key == 'country') {
                    if ($value != null) {
                        $countries = $this->createFilterArray($value['name'], $countries);
                    }
                }

                // Setting city wise data
                if ($key == 'city') {
                    if ($value != null) {
                        $cities = $this->createFilterArray($value['name'], $cities);
                    }
                }

                // Setting state wise data
                if ($key == 'state') {
                    if ($value != null) {
                        $states = $this->createFilterArray($value['name'], $states);
                    }
                }

                // Setting Gender wise data
                if ($key == 'gender') {
                    if ($value != null) {
                        $gender = $this->createFilterArray($value, $gender);
                    }
                }

                // echo $key;
                // echo "</br>";
            }
            // echo "<pre>";
            // print_r($users);
            // die;
        }
        // return $item->user;
        // die;

        $cadAdvertisementLists = CadAdvertisement::getAll($userId);
        // return $users;
        return view('pages.dashboard', [
            'cadAdvertisementLists' => $cadAdvertisementLists,
            'dateImageClicksByDate' => $dateImageClicksByDate,
            'countries'             => $countries,
            'states'                => $states,
            'cities'                => $cities,
            'gender'                => $gender,
        ]
        );
    }

    public function createFilterArray($value, $array)
    {
        if (!array_key_exists($value, $array)) {
            $array[$value] = 1;
        } else {
            $array[$value] = $array[$value] + 1;
        }
        return $array;
    }

    public function formatDate($date)
    {
        $dt           = new \DateTime($date);
        $formatedDate = $dt->format('Y-m-d');
        return $formatedDate;
    }
}
