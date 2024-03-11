<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Student;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsLoginMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the request has the necessary credentials for student login
        if ($this->isValidStudentCredentials($request)) {
            // Proceed to the next middleware or route handler
            return $next($request);
        }

        // Return a JSON response with a 401 Unauthorized status
        return redirect()->route('login')->with('error', 'Invalid student credentials');    }

    private function isValidStudentCredentials(Request $request)
    {
        // Implement your logic to validate student credentials
        // For example, you can check if the request contains valid credentials (name, phone, dob)

        $name = $request->input('name');
        $phone = $request->input('phone');
        $dob = $request->input('dob');

        // Validate the credentials (Replace this with your actual validation logic)
        // Example: Check if the student exists in the database
        $isValidCredentials = Student::where(['s_name' => $name, 's_phone' => $phone, 's_dob' => $dob])->exists();

        return $isValidCredentials;
    }
}