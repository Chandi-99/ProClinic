<?php

namespace App\Http\Controllers\Doctor;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Bill;
use App\Models\Doctor;
use App\Models\Visitings;
use Illuminate\Support\Facades\Auth;

class doctorViewEarningController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == 'patient') {
            return redirect('/home');
        } else if ($usertype == 'doctor') {

            $totalRevenue = 0;
            $totalAppointments = 0;
            $totalProfit = 0;
            $targetProfit = 100000;
            $numberofDaysRemain = 0;
            $profitPercentage = 1;
            $incomingAppoCount = 0;
            $finishedAppoCount = 0;
            $absentpatients = 0;
            $physicalCount = 0;
            $virtualCount = 0;
            $morningCount = 0;
            $afternoonCount = 0;
            $eveningCount = 0;
            $nightCount = 0;

            $doctor = Doctor::where('user_id', Auth::user()->id)->first();
            $doctorID = $doctor->id;

            $today = Carbon::now();
            $lastDayOfMonth = Carbon::now()->endOfMonth();
            $thismonth = $today->format('m');
            $thismonthName = $today->format('F');
            $allAppo = Appointment::all();

            foreach ($allAppo as $appo) {
                $stringDate = $appo->date;
                $date = Carbon::createFromFormat('Y-m-d', $stringDate);
                $month = $date->format('m');

                if ($appo->Visiting->Doctor->id == $doctorID) {
                    if ($thismonth == $month) {
                        $bills = Bill::where('appo_id', $appo->id)->first();
                        $totalRevenue += $bills->doctor_charges;
                        $totalAppointments++;

                        if ($appo->status == 'pending') {
                            $incomingAppoCount++;
                        } else if ($appo->status == 'finished') {
                            $finishedAppoCount++;
                        } else {
                            $absentpatients++;
                        }

                        if ($appo->Visiting->type == 'Physical') {
                            $physicalCount++;
                        } else if ($appo->Visiting->type == 'TeleMedicine') {
                            $virtualCount++;
                        }

                        if ($appo->Visiting->session == 'Morning') {
                            $morningCount++;
                        } else if ($appo->Visiting->session == 'Afternoon') {
                            $afternoonCount++;
                        } else if ($appo->Visiting->session == 'Evening') {
                            $eveningCount++;
                        } else {
                            $nightCount++;
                        }
                    }
                }
            }

            function highest($a, $b, $c, $d)
            {
                $max = $a;
                if ($b > $max) {
                    $max = $b;
                }
                if ($c > $max) {
                    $max = $c;
                }
                if ($d > $max) {
                    $max = $d;
                }

                if ($max == $a) {
                    return 'Morning';
                } else if ($max == $b) {
                    return 'Afternoon';
                } else if ($max == $c) {
                    return 'Evening';
                } else {
                    return 'Night';
                }
            }

            $sessionCount = Visitings::where('doctor_id', $doctorID)->distinct()->count();

            $session = highest($morningCount, $afternoonCount, $eveningCount, $nightCount);
            $lastDayOfMonth = Carbon::parse($lastDayOfMonth);
            $day = Carbon::parse($today);
            $numberofDaysRemain = $lastDayOfMonth->diffInDays($day);
            $profitPercentage = ($totalProfit / $targetProfit) * 100;

            return view('doctor.viewMyearning', [
                'totalRevenue' => $totalRevenue, 'targetProfit' => $targetProfit, 'totalAppointments' => $totalAppointments,
                'numberofDaysRemain' => $numberofDaysRemain, 'profitPercentage' => $profitPercentage,
                'doctor' => $doctor, 'monthly' => 'yes', 'thismonthName' => $thismonthName, 'sessionCount' => $sessionCount
            ]);
        } else if ($usertype == 'admin') {
            return redirect('/admin');
        } else {
            return redirect('/staff');
        }
    }

    public function overall()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == 'patient') {
            return redirect('/home');
        } else if ($usertype == 'doctor') {

            $totalRevenue = 0;
            $totalAppointments = 0;
            $totalProfit = 0;
            $targetProfit = 100000;
            $numberofDaysRemain = 0;
            $profitPercentage = 1;
            $incomingAppoCount = 0;
            $finishedAppoCount = 0;
            $absentpatients = 0;
            $physicalCount = 0;
            $virtualCount = 0;
            $morningCount = 0;
            $afternoonCount = 0;
            $eveningCount = 0;
            $nightCount = 0;

            $doctor = Doctor::where('user_id', Auth::user()->id)->first();
            $doctorID = $doctor->id;

            $today = Carbon::now();
            $lastDayOfMonth = Carbon::now()->endOfMonth();
            $thismonth = $today->format('m');
            $thismonthName = $today->format('F');
            $allAppo = Appointment::all();

            foreach ($allAppo as $appo) {
                $stringDate = $appo->date;
                $date = Carbon::createFromFormat('Y-m-d', $stringDate);
                $month = $date->format('m');

                if ($appo->Visiting->Doctor->id == $doctorID) {
                    $bills = Bill::where('appo_id', $appo->id)->first();
                    $totalRevenue += $bills->doctor_charges;
                    $totalAppointments++;

                    if ($appo->status == 'pending') {
                        $incomingAppoCount++;
                    } else if ($appo->status == 'finished') {
                        $finishedAppoCount++;
                    } else {
                        $absentpatients++;
                    }

                    if ($appo->Visiting->type == 'Physical') {
                        $physicalCount++;
                    } else if ($appo->Visiting->type == 'TeleMedicine') {
                        $virtualCount++;
                    }

                    if ($appo->Visiting->session == 'Morning') {
                        $morningCount++;
                    } else if ($appo->Visiting->session == 'Afternoon') {
                        $afternoonCount++;
                    } else if ($appo->Visiting->session == 'Evening') {
                        $eveningCount++;
                    } else {
                        $nightCount++;
                    }
                }
            }

            function highest($a, $b, $c, $d)
            {
                $max = $a;
                if ($b > $max) {
                    $max = $b;
                }
                if ($c > $max) {
                    $max = $c;
                }
                if ($d > $max) {
                    $max = $d;
                }

                if ($max == $a) {
                    return 'Morning';
                } else if ($max == $b) {
                    return 'Afternoon';
                } else if ($max == $c) {
                    return 'Evening';
                } else {
                    return 'Night';
                }
            }

            $sessionCount = Visitings::where('doctor_id', $doctorID)->distinct()->count();

            $lastDayOfMonth = Carbon::parse($lastDayOfMonth);
            $day = Carbon::parse($today);
            $numberofDaysRemain = $lastDayOfMonth->diffInDays($day);
            $profitPercentage = ($totalProfit / $targetProfit) * 100;

            return view('doctor.viewMyearning', [
                'totalRevenue' => $totalRevenue, 'targetProfit' => $targetProfit, 'totalAppointments' => $totalAppointments,
                'numberofDaysRemain' => $numberofDaysRemain, 'profitPercentage' => $profitPercentage,
                'doctor' => $doctor, 'monthly' => 'no', 'thismonthName' => $thismonthName, 'sessionCount' => $sessionCount
            ]);
        } else if ($usertype == 'admin') {
            return redirect('/admin');
        } else {
            return redirect('/staff');
        }
    }
}
