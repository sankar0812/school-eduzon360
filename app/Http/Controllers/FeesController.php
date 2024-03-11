<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\fee_structure;
use App\Models\FeesCollection;
use App\Models\StudentFeesRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FeesController extends Controller
{
    public function feesform()
    {
        $feeStructures = fee_structure::join('class_sections', 'class_sections.id', '=', 'fee_structures.class_id')->select('fee_structures.*', 'class_sections.c_class')->get();
        return view('fee.fees', compact('feeStructures'));
    }

    public function create()
    {
        return view('fee_structure.create');
    }

    public function store(Request $request)
    {
        $month = date('m');

        $currentDate = now();
        $nextYe = $currentDate->format('Y');
        $nextYear = $currentDate->addYear()->format('y');

        if ($month >= "06") {
            $fyear = $nextYe . '-' . $nextYear;
        } else {
            $fyear = ($nextYe - 1)  . '-' . ($nextYear - 1);
        }

        $request->validate([
            'class_id' => 'required',
            'annual_fee' => 'required|numeric',
            'exam_fees' => 'required|numeric',
        ]);

      $fees =  fee_structure::where('class_id',$request->class_id)
        ->where('academic_year' ,$fyear )
        ->get();
        if($fees){
            $authid = Auth::user()->id;

            if ($authid == 1) {
                return redirect()->route('adminfee-structure.index')->with('failed', 'Fee Structure already created');
            } elseif ($authid == 5) {
                return redirect()->route('accountantfee-structure.index')->with('failed', 'Fee Structure already created');
            }
        }else{
        fee_structure::create([
            'class_id' => $request->input('class_id'),
            'annual_fee' => $request->input('annual_fee'),
            'exam_fees' => $request->input('exam_fees'),
            'academic_year' => $fyear,
        ]);
    }
    
        fee_structure::create([
            'class_id' => $request->input('class_id'),
            'annual_fee' => $request->input('annual_fee'),
            'exam_fees' => $request->input('exam_fees'),
            'academic_year' => $fyear,
        ]);

        $authid = Auth::user()->id;

        if ($authid == 1) {
            return redirect()->route('adminfee-structure.index')->with('success', 'Fee Structure created successfully');
        } elseif ($authid == 5) {
            return redirect()->route('accountantfee-structure.index')->with('success', 'Fee Structure created successfully');
        }
    }

    public function show(fee_structure $fee_structure)
    {
        return view('fee_structure.show', compact('fee_structure'));
    }

    public function edit($id)
    {
        $feeStructure = fee_structure::find($id);
        return view('fee_structure.edit', compact('feeStructure'));
    }

    public function update(Request $request, $id)
    {
        $month = date('m');

        $currentDate = now();
        $nextYe = $currentDate->format('Y');
        $nextYear = $currentDate->addYear()->format('y');

        if ($month >= "06") {
            $fyear = $nextYe . '-' . $nextYear;
        } else {
            $fyear = ($nextYe - 1)  . '-' . ($nextYear - 1);
        }
        $request->validate([
            // 'class_id' => 'required',
            'annual_fee' => 'required|numeric',
            'exam_fees' => 'required|numeric',
        ]);

        $fee_structure = fee_structure::find($id);

        if ($fee_structure) {
            $fee_structure->update([
                // 'class_id' => $request->input('class_id'),
                'annual_fee' => $request->input('annual_fee'),
                'exam_fees' => $request->input('exam_fees'),
                // 'academic_year' => $fyear,
            ]);

            $authid = Auth::user()->id;

            if ($authid == 1) {
                return redirect()->route('adminfee-structure.index')->with('success', 'Fee Structure Updated successfully');
            } elseif ($authid == 5) {
                return redirect()->route('accountantfee-structure.index')->with('success', 'Fee Structure Updated successfully');
            }
        }
    }

    public function destroy($id)
    {
        $fee_structure = fee_structure::find($id);
        $fee_structure->delete();

        $authid = Auth::user()->id;

        if ($authid == 1) {
            return redirect()->route('adminfee-structure.index')->with('success', 'Fee Structure deleted successfully');
        } elseif ($authid == 5) {
            return redirect()->route('accountantfee-structure.index')->with('success', 'Fee Structure deleted successfully');
        }
    }


    public function feescollection(Request $request)
    {

        $month = date('m');
        $currentDate = now();
        $nextYe = $currentDate->format('Y');
        $nextYear = $currentDate->addYear()->format('y');
    
        if ($month >= "06") {
            $fyear = $nextYe . '-' . $nextYear;
        } else {
            $fyear = ($nextYe - 1) . '-' . ($nextYear - 1);
        }
    
        $request->validate([
            'class_id' => 'required',
            'student_id' => 'required',
            'amount' => 'required|numeric',
            'paid_date' => 'required|date_format:d-m-Y',
            // 'academic_date' => 'required', // Add validation rules for other fields
            'payment' => 'required',
        ]);
    
        $paid_date = Carbon::createFromFormat('d-m-Y', $request->input('paid_date'))->format('Y-m-d');
        $student_id = $request->input('student_id');
    
        // Retrieve all records for the student ID, ordered by balance in ascending order
        $fees_records = DB::table('student_fees_records')
            ->select(
                'student_id',
                'total_fees',
                'academic_year',
                'balance',
                'total_fees_paid'
            )
            ->where('student_id', $student_id)
            ->where('balance', '!=', 0.00)
            ->orderBy('balance')  // Order by balance in ascending order
            ->get();
    
        // Iterate over each record
        foreach ($fees_records as $fees_record) {
            // Update logic for each record
            $feeStructures = DB::table('fees')
                ->select(
                    'fees.id',
                    'fees.total as total_fees',
                    'fees.academic_year',
                    'fees.student_id'
                )
                ->where('fees.student_id', $student_id)
                ->where('fees.academic_year', $fyear)
                ->where('fees.status', '1')
                ->first();
    
            $feesCollection = new FeesCollection();
            $feesCollection->fees_id = $feeStructures->id;
            $feesCollection->student_id = $student_id;
            $feesCollection->amount = $request->input('amount');
            $feesCollection->paid_date = $paid_date;
            $feesCollection->academic_date = $request->input('academic_date');
            $feesCollection->payment_method = $request->input('payment');
    
            // Save the model to the database
            $feesCollection->save();
    
            $total_fees = $feeStructures->total_fees;
            $academic_year = $feeStructures->academic_year;
    
            // Deduct the payment amount from the existing balance
            $balance_fee_record = max(0, $fees_record->balance - $request->input('amount'));
    
            $total_fees_paid = $fees_record->total_fees_paid + $request->input('amount');
    
            // Update the student_fees_records table
            $feesRecord = StudentFeesRecord::where('student_id', $student_id)
                ->where('balance', $fees_record->balance)  // Additional condition to match balance
                ->orderBy('created_at') // You may need to adjust this based on your data structure
                ->first();
    
            if ($feesRecord) {
             
                $feesRecord->student_id = $student_id;
             
                $feesRecord->balance = $balance_fee_record;
                $feesRecord->total_fees_paid = $total_fees_paid;
                $feesRecord->save();
            } else {
                // Create a new record if none exists
                $feesRecord = new StudentFeesRecord();
                $feesRecord->student_id = $student_id;
                $feesRecord->total_fees = $total_fees;
                $feesRecord->academic_year = $academic_year;
                $feesRecord->balance = $balance_fee_record;
                $feesRecord->total_fees_paid = $total_fees_paid;
                $feesRecord->save();
            }
            return redirect()->back();
            // Continue processing for the next records
        }
                
        //     } else {
        //         return redirect()->back()->with('failed', 'All fees are Paid');
        //     }
        // }


    }

    public function paidfees()
    {
        $class = DB::table('student_fees_records')
            ->join('students', 'students.id', '=', 'student_fees_records.student_id')
            ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
            ->select('class_sections.id', 'class_sections.c_class')
            ->groupBy('class_sections.id', 'class_sections.c_class')
            ->get();
            
        return view('fee.paidfeesdetails', compact('class'));
    }
    public function paidfeesfilter(Request $request)
    {

        $month = date('m');
        $currentDate = now();
        $nextYe = $currentDate->format('Y');
        $nextYear = $currentDate->addYear()->format('y');

        if ($month >= "06") {
            $fyear = $nextYe . '-' . $nextYear;
        } else {
            $fyear = ($nextYe - 1)  . '-' . ($nextYear - 1);
        }

        $classId = $request->class; // Replace with the desired class ID


        $feesRecords = DB::table('student_fees_records')
            ->select(
                'students.s_name',
                'students.id as s_id',
                'class_sections.c_class',
                'student_fees_records.total_fees',
                'student_fees_records.academic_year',
                'student_fees_records.balance',
                'student_fees_records.total_fees_paid',
                'student_fees_records.student_id'
            )
            ->join('students', 'students.id', '=', 'student_fees_records.student_id')
            ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
            ->where('class_sections.id', $classId)
            ->where('student_fees_records.academic_year', $fyear)
            ->groupBy(
                'students.s_name',
                'students.id',
                'class_sections.c_class',
                'student_fees_records.total_fees',
                'student_fees_records.academic_year',
                'student_fees_records.balance',
                'student_fees_records.total_fees_paid',
                'student_fees_records.student_id'
            )
            ->get();


            $previousYearRecords = []; // Initialize an array to store records for multiple students

            foreach ($feesRecords as $feesRecord) {
                $a = $feesRecord->student_id;
            
                $recordsForCurrentStudent = DB::table('student_fees_records')
                    ->select(
                        'students.s_name',
                        'students.id',
                        'class_sections.c_class',
                        'student_fees_records.total_fees',
                        'student_fees_records.academic_year',
                        'student_fees_records.balance',
                        'student_fees_records.total_fees_paid',
                        'student_fees_records.student_id'
                    )
                    ->join('students', 'students.id', '=', 'student_fees_records.student_id')
                    ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
                    ->where('students.id', $a)
                    ->where('class_sections.id', $classId)
                    ->where('student_fees_records.academic_year', '<>', $fyear) // Exclude current year
                    ->groupBy(
                        'students.s_name',
                        'students.id',
                        'class_sections.c_class',
                        'student_fees_records.total_fees',
                        'student_fees_records.academic_year',
                        'student_fees_records.balance',
                        'student_fees_records.total_fees_paid',
                        'student_fees_records.student_id'
                    )
                    ->get();
            
                // Append the records for the current student to the array
                $previousYearRecords[$a] = $recordsForCurrentStudent;
            }
            
            // Print the entire array containing records for multiple students
            // dd($previousYearRecords);
        // Merge the collections into one

        // $combinedRecords = $feesRecords;

        // Pass $combinedRecords to the view

        // dd($combinedRecords);
        if (!$feesRecords) {

            return redirect()->route('error');
        }

        $class = DB::table('student_fees_records')
            ->join('students', 'students.id', '=', 'student_fees_records.student_id')
            ->join('class_sections', 'class_sections.id', '=', 'students.s_classid')
            ->select('class_sections.id', 'class_sections.c_class')
            ->groupBy('class_sections.id', 'class_sections.c_class')
            ->get();

        return view('fee.paidfeesfilterdetails', compact('feesRecords', 'previousYearRecords', 'class'));
    }

    public function StudentFeeBalance(Request $request)
    {
        $classId = $request->class_id;
        $a = $request->student_id;
    
        $data['StudentFeeBalance'] = DB::table('students')
            ->select(
                'students.s_name',
                'students.id',
                'class_sections.c_class',
                'student_fees_records.total_fees',
                'student_fees_records.academic_year',
                'student_fees_records.balance',
                DB::raw('SUM(student_fees_records.balance) as total_balance'),
                'student_fees_records.total_fees_paid'
            )
            ->leftJoin('student_fees_records', function ($join) {
                $join->on('students.id', '=', 'student_fees_records.student_id');
            })
            ->leftJoin('class_sections', 'class_sections.id', '=', 'students.s_classid')
            ->where('students.id', $a)
            ->where('student_fees_records.balance','!=' ,'0')
            // ->where('class_sections.id', $classId)
            ->orderBy('student_fees_records.academic_year', 'DESC')
            ->groupBy(
                'students.s_name',
                'students.id',
                'class_sections.c_class',
                'student_fees_records.balance',
                'student_fees_records.total_fees',
                'student_fees_records.academic_year',
                'student_fees_records.total_fees_paid'
            )
            ->limit(2)
            ->get();
    
        // Iterate over the result to fetch separate fee collections for each student
        foreach ($data['StudentFeeBalance'] as &$record) {
            $feesCollections = DB::table('fees_collections')
                ->select(
                    'fees_collections.id',
                    'fees_collections.paid_date',
                    'fees_collections.amount'
                )
                ->where('fees_collections.student_id', $record->id)
                ->where('fees_collections.academic_date', $record->academic_year)
                ->orderBy('fees_collections.paid_date','DESC')
                ->limit(5)
                ->get();
    
            // Convert the feesCollections result to an array
            $record->fees_collections = $feesCollections->toArray();
        }
    
        // Now, $data contains the student information with a nested array of fees collections for each student
    
        return response()->json($data);
    }
    
}
