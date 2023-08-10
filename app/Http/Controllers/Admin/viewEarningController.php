<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Bill;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Prescription;
use App\Models\Prescription_Medicine;
use App\Models\Visitings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class viewEarningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == 'patient') {
            return view('patient.home');
        } else if ($usertype == 'admin') {

            $totalRevenue = 0;
            $totalExpenses = 0;
            $totalAppointments = 0;
            $totalDoctorCharges = 0;
            $avergaeRevenue = 1;
            $totalProfit = 0;
            $targetProfit = 100000;
            $numberofDaysRemain = 0;
            $profitPercentage = 1;

            $HDDName = '';
            $HHDAppoCount = 0;
            $HDDEarn = 0;

            $CPP = 1;

            $mostUsedMedicine = '';
            $mediUnitPrice = 0;
            $mediSoldCount = 0;

            $finishedAppoCount = 0;
            $incomingAppoCount = 0;
            $absentpatients = 0;


            $physicalCount = 0;
            $virtualCount = 0;
            $ratio = 1;


            $session = '';
            $morningCount = 0;
            $afternoonCount = 0;
            $eveningCount = 0;
            $nightCount = 0;
            $sessionAppo = 0;
            $sessionVisitings = '';

            $today = Carbon::now();
            $lastDayOfMonth = Carbon::now()->endOfMonth();
            $thismonth = $today->format('m');
            $thismonthName = $today->format('F');
            $allAppo = Appointment::all();

            foreach ($allAppo as $appo) {
                $stringDate = $appo->date;
                $date = Carbon::createFromFormat('Y-m-d', $stringDate);
                $month = $date->format('m');

                if ($thismonth == $month) {
                    $bills = Bill::where('appo_id', $appo->id)->first();
                    $totalRevenue += $bills->total;
                    $totalAppointments++;
                    $totalDoctorCharges += $bills->doctor_charges;
                    $totalExpenses += $bills->medicine_charges;

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
            function highest($a, $b, $c, $d){
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

            $session = highest($morningCount, $afternoonCount, $eveningCount, $nightCount);
            $sessionVisitings = Visitings::where('session', $session)->count();
            $currentMonth = Carbon::now()->format('Y-m');

            $modeVisit = DB::table('appointments')
                ->select('visiting_id', DB::raw('COUNT(*) as appointment_count'))
                ->whereRaw("DATE_FORMAT(date, '%Y-%m') = '$currentMonth'")
                ->groupBy('visiting_id')
                ->orderByDesc('appointment_count')
                ->first();

            $modeVisitNew = Visitings::where('id', $modeVisit->visiting_id)->first();
            $modeDoctor = $modeVisitNew->Doctor;

            foreach ($allAppo as $appo) {
                $stringDate = $appo->date;
                $date = Carbon::createFromFormat('Y-m-d', $stringDate);
                $month = $date->format('m');

                if ($thismonth == $month) {
                    if ($appo->Visiting->doctor_id = $modeDoctor->id) {
                        if ($appo->Visiting->type == 'Physical') {
                            $HDDEarn += $modeDoctor->normal_rate;
                            $HHDAppoCount++;
                        } else {
                            $HDDEarn += $modeDoctor->echanneling_rate;
                            $HHDAppoCount++;
                        }
                    }

                    if ($appo->Visiting->session == $session) {
                        $sessionAppo++;
                    }
                }
            }

            $mostUsedMedicine = DB::table('prescription__medicines')
                ->join('prescriptions', 'prescription__medicines.prescription_id', '=', 'prescriptions.id')
                ->join('medicines', 'prescription__medicines.medi_id', '=', 'medicines.id')
                ->join('Appointments', 'prescriptions.appo_id', '=', 'appointments.id')
                ->select('prescription__medicines.medi_id', 'medicines.medi_name', DB::raw('SUM(prescription__medicines.quantity) as total_quantity'))
                ->whereRaw("DATE_FORMAT(appointments.date, '%Y-%m') = '$currentMonth'")
                ->groupBy('prescription__medicines.medi_id', 'medicines.medi_name')
                ->orderBy('total_quantity', 'desc')
                ->first();

            $medicine = Medicine::where('medi_name', $mostUsedMedicine->medi_name)->first();
            $medi_name = $medicine->medi_name;
            $mediUnitPrice = $medicine->unit_price;
            $mediID = $medicine->id;

            foreach ($allAppo as $appo) {
                $stringDate = $appo->date;
                $date = Carbon::createFromFormat('Y-m-d', $stringDate);
                $month = $date->format('m');

                if ($thismonth == $month) {
                    $prescription = Prescription::where('appo_id', $appo->id)->first();
                    $medicines = Prescription_Medicine::where('prescription_id', $prescription->id)->get();

                    foreach ($medicines as $medi) {
                        if ($medi->medi_id == $mediID) {
                            $mediSoldCount += $medi->quantity;
                        }
                    }
                }
            }

            $avergaeRevenue = $totalRevenue / $totalAppointments;
            $totalProfit = $totalRevenue - $totalExpenses;
            $lastDayOfMonth = Carbon::parse($lastDayOfMonth);
            $day = Carbon::parse($today);
            $numberofDaysRemain = $lastDayOfMonth->diffInDays($day);
            $profitPercentage = ($totalProfit / $targetProfit) * 100;
            $HDDName = $modeDoctor->fname . ' ' . $modeDoctor->lname;
            $CPP = $totalExpenses / $totalAppointments;
            if ($virtualCount > 0)
                $ratio = $physicalCount / $virtualCount;
            else
                $ratio = 'N/A';

            return view('admin.earningview', [
                'totalRevenue' => $totalRevenue, 'totalExpenses' => $totalExpenses, 'totalAppointments' => $totalAppointments,
                'totalDoctorCharges' => $totalDoctorCharges, 'avergaeRevenue' => $avergaeRevenue, 'totalProfit' => $totalProfit, 'targetProfit' => $targetProfit,
                'numberofDaysRemain' => $numberofDaysRemain, 'profitPercentage' => $profitPercentage, 'HDDName' => $HDDName, 'HHDAppoCount' => $HHDAppoCount,
                'HDDEarn' => $HDDEarn, 'CPP' => $CPP, 'mostUsedMedicine' => $medi_name, 'mediUnitPrice' => $mediUnitPrice, 'mediSoldCount' => $mediSoldCount,
                'finishedAppoCount' => $finishedAppoCount, 'incomingAppoCount' => $incomingAppoCount, 'absentpatients' => $absentpatients, 'ratio' => $ratio,
                'session' => $session, 'sessionAppo' => $sessionAppo, 'sessionVisitings' => $sessionVisitings, 'thismonthName' => $thismonthName, 'monthly' => 'yes',
                'physicalCount' => $physicalCount, 'virtualCount' => $virtualCount
            ]);
        } else if ($usertype == 'doctor') {
            return view('doctor.doctordashboard');
        } else {
            return view('staff.staffdashboard');
        }
    }

    public function overall()
    {
        $totalRevenue = 0;
        $totalExpenses = 0;
        $totalAppointments = 0;
        $totalDoctorCharges = 0;
        $avergaeRevenue = 1;
        $totalProfit = 0;
        $targetProfit = 100000;
        $AnnualtargetProfit = 1200000;
        $numberofDaysRemain = 0;
        $profitPercentage = 1;

        $HDDName = '';
        $HHDAppoCount = 0;
        $HDDEarn = 0;

        $CPP = 1;

        $mostUsedMedicine = '';
        $mediUnitPrice = 0;
        $mediSoldCount = 0;

        $finishedAppoCount = 0;
        $incomingAppoCount = 0;
        $absentpatients = 0;

        $physicalCount = 0;
        $virtualCount = 0;
        $ratio = 1;

        $session = '';
        $morningCount = 0;
        $afternoonCount = 0;
        $eveningCount = 0;
        $nightCount = 0;
        $sessionAppo = 0;
        $sessionVisitings = '';

        $today = Carbon::now();
        $lastDayOfMonth = Carbon::now()->endOfMonth();
        $thismonth = $today->format('m');
        $thismonthName = $today->format('F');
        $allAppo = Appointment::all();

        foreach ($allAppo as $appo) {
            $stringDate = $appo->date;
            $date = Carbon::createFromFormat('Y-m-d', $stringDate);
            $month = $date->format('m');

            $bills = Bill::where('appo_id', $appo->id)->first();
            $totalRevenue += $bills->total;
            $totalAppointments++;
            $totalDoctorCharges += $bills->doctor_charges;
            $totalExpenses += $bills->medicine_charges;

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

        $session = highest($morningCount, $afternoonCount, $eveningCount, $nightCount);
        $sessionVisitings = Visitings::where('session', $session)->count();
        $currentMonth = Carbon::now()->format('Y-m');

        $modeVisit = DB::table('appointments')
            ->select('visiting_id', DB::raw('COUNT(*) as appointment_count'))
            ->groupBy('visiting_id')
            ->orderByDesc('appointment_count')
            ->first();

        $modeVisitNew = Visitings::where('id', $modeVisit->visiting_id)->first();
        $modeDoctor = $modeVisitNew->Doctor;

        foreach ($allAppo as $appo) {
            $stringDate = $appo->date;
            $date = Carbon::createFromFormat('Y-m-d', $stringDate);
            $month = $date->format('m');
            if ($appo->Visiting->doctor_id = $modeDoctor->id) {
                if ($appo->Visiting->type == 'Physical') {
                    $HDDEarn += $modeDoctor->normal_rate;
                    $HHDAppoCount++;
                } else {
                    $HDDEarn += $modeDoctor->echanneling_rate;
                    $HHDAppoCount++;
                }
            }

            if ($appo->Visiting->session == $session) {
                $sessionAppo++;
            }
        }

        $mostUsedMedicine = DB::table('prescription__medicines')
            ->join('prescriptions', 'prescription__medicines.prescription_id', '=', 'prescriptions.id')
            ->join('medicines', 'prescription__medicines.medi_id', '=', 'medicines.id')
            ->join('Appointments', 'prescriptions.appo_id', '=', 'appointments.id')
            ->select('prescription__medicines.medi_id', 'medicines.medi_name', DB::raw('SUM(prescription__medicines.quantity) as total_quantity'))
            ->groupBy('prescription__medicines.medi_id', 'medicines.medi_name')
            ->orderBy('total_quantity', 'desc')
            ->first();

        $medicine = Medicine::where('medi_name', $mostUsedMedicine->medi_name)->first();
        $medi_name = $medicine->medi_name;
        $mediUnitPrice = $medicine->unit_price;
        $mediID = $medicine->id;

        foreach ($allAppo as $appo) {
            $stringDate = $appo->date;
            $date = Carbon::createFromFormat('Y-m-d', $stringDate);
            $month = $date->format('m');
            $prescription = Prescription::where('appo_id', $appo->id)->first();
            $medicines = Prescription_Medicine::where('prescription_id', $prescription->id)->get();

            foreach ($medicines as $medi) {
                if ($medi->medi_id == $mediID) {
                    $mediSoldCount += $medi->quantity;
                }
            }
        }

        $avergaeRevenue = $totalRevenue / $totalAppointments;
        $totalProfit = $totalRevenue - $totalExpenses;
        $lastDayOfMonth = Carbon::parse($lastDayOfMonth);
        $day = Carbon::parse($today);
        $numberofDaysRemain = $lastDayOfMonth->diffInDays($day);
        $profitPercentage = ($totalProfit / $targetProfit) * 100;
        $HDDName = $modeDoctor->fname . ' ' . $modeDoctor->lname;
        $CPP = $totalExpenses / $totalAppointments;
        if ($virtualCount > 0)
            $ratio = $physicalCount / $virtualCount;
        else
            $ratio = 'N/A';

        return view('admin.earningview', [
            'totalRevenue' => $totalRevenue, 'totalExpenses' => $totalExpenses, 'totalAppointments' => $totalAppointments,
            'totalDoctorCharges' => $totalDoctorCharges, 'avergaeRevenue' => $avergaeRevenue, 'totalProfit' => $totalProfit, 'targetProfit' => $AnnualtargetProfit,
            'numberofDaysRemain' => $numberofDaysRemain, 'profitPercentage' => $profitPercentage, 'HDDName' => $HDDName, 'HHDAppoCount' => $HHDAppoCount,
            'HDDEarn' => $HDDEarn, 'CPP' => $CPP, 'mostUsedMedicine' => $medi_name, 'mediUnitPrice' => $mediUnitPrice, 'mediSoldCount' => $mediSoldCount,
            'finishedAppoCount' => $finishedAppoCount, 'incomingAppoCount' => $incomingAppoCount, 'absentpatients' => $absentpatients, 'ratio' => $ratio,
            'session' => $session, 'sessionAppo' => $sessionAppo, 'sessionVisitings' => $sessionVisitings, 'thismonthName' => $thismonthName, 'monthly' => 'no',
            'physicalCount' => $physicalCount, 'virtualCount' => $virtualCount
        ]);
    }
}
