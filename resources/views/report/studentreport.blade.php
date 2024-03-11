<h1>Student Marks Report</h1>

@foreach($reports as $report)
    <h2>Class: {{ $report['class']->class_name }} - Exam Type: {{ $report['examType']->name }}</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Marks</th>
                <!-- Add more headers based on your data -->
            </tr>
        </thead>
        <tbody>
            @foreach($report['marks'] as $mark)
                <tr>
                    <td>{{ $report['student']->id }}</td>
                    <td>{{ $report['student']->s_name }}</td>
                    <td>{{ $mark->mark }}</td>
                    <!-- Add more columns based on your data -->
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
@endforeach



//Controller


use App\Models\Student;
use App\Models\Mark;
use App\Models\ExamType;

public function studentMarksReport($classId, $examTypeId)
{
    // Retrieve the specific class
    $class = YourClassModel::find($classId);

    // Retrieve all students for the given class
    $students = Student::where('s_classid', $classId)->get();

    // Retrieve the specific exam type
    $examType = ExamType::find($examTypeId);

    // Initialize an array to store the reports
    $reports = [];

    // Loop through each student
    foreach ($students as $student) {
        // Retrieve marks for the student, class, and exam type
        $marks = Mark::where([
            'class_id' => $classId,
            'staff_id' => $student->s_feesid, // Assuming staff_id is related to student's ID
            'examtype_id' => $examTypeId,
        ])->get();

        // Add the student and marks to the reports array
        $reports[] = [
            'class' => $class,
            'student' => $student,
            'marks' => $marks,
            'examType' => $examType,
        ];
    }

    return view('student.marks_report', ['reports' => $reports]);
}
