<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\ClassEnroll;
use App\Models\Enroll;
use App\Models\Log;
use App\Models\SchoolYear;
use App\Models\Section;
use App\Models\Session;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index() {
        $enrolees = Enroll::where('status', 'Pending')
            ->where('school_year_id', SchoolYear::currentYearAttr()->id ?? '')
            ->orderBy('created_at')
            ->get();
        $enroleesCount = $enrolees->count();
        $enrolled = Enroll::where('status', 'Approved')
            ->where('school_year_id', SchoolYear::currentYearAttr()->id ?? '')
            ->get();
        $countGLvl = [];
        for ($x = 1; $x <= 6; $x++) {
            $countGLvl[] = Enroll::where('status', 'Approved')
                ->where('school_year_id', SchoolYear::currentYearAttr()->id ?? '')
                ->where('level_id', $x ?? '')
                ->get()->count();
        }

        $enrolleds = $enrolled->count();
        $totalUsers = User::get()->count();
        $admins = User::where('role', 1)->get()->count();
        $normalusers = User::where('role', 2)->get()->count();
        $teachers = Teacher::get()->count();
        $subjects = Subject::get()->count();
        $sections = Section::get()->count();
        $classes = Session::get()->count();

        $adminsBarWidth = ($admins / $totalUsers) * 100;
        return view('pages.admins.index', compact('admins', 'normalusers', 'adminsBarWidth', 'enrolees', 'enroleesCount', 'enrolled', 'enrolleds', 'teachers', 'subjects', 'sections', 'classes', 'countGLvl'));
    }

    public function showUsers() {
        $users = User::orderByRaw('lastName,firstName')->get();
        return view('pages.admins.users', compact('users'));
    }

    public function viewUser(User $user) {
        return view('pages.admins.users-detail-view', compact('user'));
    }    

    public function storeUser(Request $request) {
        
        $request->validate([
            'firstName'             => 'required|string',
            'lastName'              => 'required|string',
            'middleName'            => 'required|string',
            'email'                 => 'required|email|unique:users',
            'username'              => 'required|string|unique:users',
            'contactNo'             => 'required|numeric|regex:/(09)[0-9]{9}/',
            'password'              => 'required|string|min:8|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required|string|min:8',
        ]);

        $token = Str::random(24);

        $user = User::create([
            'firstName'         => $request->firstName,
            'lastName'          => $request->lastName,
            'middleName'        => $request->middleName,
            'email'             => $request->email,
            'contactNo'         => $request->contactNo,
            'username'          => $request->username,
            'password'          => bcrypt($request->password),
            'role'              => $request->role,
            'remember_token'    => $token,
        ]);
        event(new UserLog("Created new user with ID#$user->id."));  
        return redirect()->route('admin.users')->with('Message', 'User has been successfully created.');
        
    }


    public function updateUser(Request $request) {

        $request->validate([
            'id'                    => 'required|numeric',
            'firstName'             => 'required|string',
            'lastName'              => 'required|string',
            'middleName'            => 'required|string',
            'email'                 => 'required|email|unique:users,email,'.$request->id,
            'username'              => 'required|string|unique:users,username,'.$request->id,
            'contactNo'             => 'required|numeric|regex:/(09)[0-9]{9}/',
            'role'                  => 'required|numeric',
        ]);
        $user = User::find($request->id);

        if(empty($request->get('password'))) $user->update($request->except('password'));
        else {
            $request->merge([
                'password' => bcrypt($request->password),
            ]);
            $user->update($request->all());
        }
        
        event(new UserLog("Updated user with ID#$user->id"));   
    
        return redirect()->route('admin.users')->with('Message', "User [ID #$request->id] has been successfully updated.");
    }

    public function deleteUser(Request $request) {
        $user = User::find($request->id);
        $id = $request->id;
        $user->delete();
        event(new UserLog("Delete user with ID#$id."));  
        return redirect()->route('admin.users')->with('Message', "User [ID #$id] has been successfully deleted.");
    }

    public function showStudents() {
        $students = Student::orderByRaw('lastName,firstName')->get();
        return view('pages.admins.students', compact('students'));
    }

    public function viewstudent(Student $student) {
        return view('pages.admins.students-detail-view', compact('student'));
    } 

    public function createStudent() {
        return view('pages.admins.student-create');
    }

    public function storeStudent(Request $request) {
        $request->validate([
            'user_id'               => 'required|numeric',
            'profile_pic'           => 'required|mimes:jpeg,png,jpg|max:8192',
            'firstName'             => 'required|string|max:40',
            'lastName'              => 'required|string|max:40',
            'middleName'            => 'required|string|max:40',
            'gender'                => 'required|string|max:10',
            'birthDate'             => 'required|date',
            'birthPlace'            => 'required|string',
            'nationality'           => 'required|string|max:30',
            'religion'              => 'required|string|max:30',
            'civilStatus'           => 'required|string|max:30',
            'fatherName'            => 'required|string|max:120',
            'fatherOccup'           => 'required|string|max:120',
            'fatherContact'         => 'numeric|regex:/(09)[0-9]{9}/|nullable',
            'motherName'            => 'required|string|max:30',
            'motherOccup'           => 'required|string|max:30',
            'motherContact'         => 'numeric|regex:/(09)[0-9]{9}/|nullable',
            'guardianName'          => 'nullable',
            'guardianContact'       => 'numeric|regex:/(09)[0-9]{9}/|nullable',
            'barangay'              => 'required|string|max:191',
            'town'                  => 'required|string|max:191',
            'province'              => 'required|string|max:191',
            'elemSchool'            => 'required|string|max:191',
            'elemSchlAddr'          => 'required|string|max:191',
            'elemYrAttnd'           => 'required|string|max:191',
            'secondarySchool'       => 'string|max:191|nullable',
            'secondarySchlAddr'     => 'string|max:191|nullable',
            'secondaryYrAttnd'      => 'string|max:191|nullable',
        ], [
            'profile_pic.max' => 'Image should be less than 8mb.',
        ]);

        if(!empty($request->profile_pic)) {
            $user = User::find($request->user_id);
            $imageName = time() . $request->lastName.'.'.$request->profile_pic->extension(); 
    
            $user->profile_pic = $imageName;
            $user->save();
    
            $request->profile_pic->move(public_path('images'), $imageName);
        }
        
        $student = Student::create([
            'user_id'           => $request->user_id,
            'firstName'         => $request->firstName,
            'lastName'          => $request->lastName,
            'middleName'        => $request->middleName,
            'gender'        => $request->gender,
            'birthDate'        => $request->birthDate,
            'birthPlace'        => $request->birthPlace,
            'nationality'        => $request->nationality,
            'religion'        => $request->religion,
            'civilStatus'        => $request->civilStatus, 
            'fatherName'        => $request->fatherName,
            'fatherOccup'        => $request->fatherOccup,
            'fatherContact'        => $request->fatherContact,
            'motherName'        => $request->motherName,
            'motherOccup'        => $request->motherOccup,
            'motherContact'        => $request->motherContact,
            'guardianName'        => $request->guardianName,
            'guardianContact'        => $request->guardianContact,
            'barangay'        => $request->barangay,
            'town'        => $request->town,
            'province'        => $request->province,
            'grade_LVL'        => $request->grade_LVL,
            'elemSchool'        => $request->elemSchool,
            'elemSchlAddr'        => $request->elemSchlAddr,
            'elemYrAttnd'        => $request->elemYrAttnd,
            'secondarySchool'        => $request->secondarySchool,
            'secondarySchlAddr'        => $request->secondarySchlAddr,
            'secondaryYrAttnd'        => $request->secondaryYrAttnd,
        ]);

        event(new UserLog("Created new student with ID#$student->id."));  
        return redirect()->route('admin.students')->with('Message', 'Student has been successfully created.');
    }


    public function editStudent(Student $student) {
        return view('pages.admins.student-edit', compact('student'));
    }

    public function updateStudent(Student $student, Request $request) {
        $request->validate([
            'profile_pic'           => 'mimes:jpeg,png,jpg',
            'firstName'             => 'required|string|max:40',
            'lastName'              => 'required|string|max:40',
            'middleName'            => 'required|string|max:40',
            'gender'                => 'required|string|max:10',
            'birthDate'             => 'required|date',
            'birthPlace'            => 'required|string',
            'nationality'           => 'required|string|max:30',
            'religion'              => 'required|string|max:30',
            'civilStatus'           => 'required|string|max:30',
            'fatherName'            => 'required|string|max:120',
            'fatherOccup'           => 'required|string|max:120',
            'fatherContact'         => 'numeric|regex:/(09)[0-9]{9}/|nullable',
            'motherName'            => 'required|string|max:30',
            'motherOccup'           => 'required|string|max:30',
            'motherContact'         => 'numeric|regex:/(09)[0-9]{9}/|nullable',
            'guardianName'          => 'nullable',
            'guardianContact'       => 'numeric|regex:/(09)[0-9]{9}/|nullable',
            'barangay'              => 'required|string|max:191',
            'town'                  => 'required|string|max:191',
            'province'              => 'required|string|max:191',
            'elemSchool'            => 'required|string|max:191',
            'elemSchlAddr'          => 'required|string|max:191',
            'elemYrAttnd'           => 'required|string|max:191',
            'secondarySchool'       => 'string|max:191|nullable',
            'secondarySchlAddr'     => 'string|max:191|nullable',
            'secondaryYrAttnd'      => 'string|max:191|nullable',
        ]);

        if(!empty($request->profile_pic)) {
            $user = User::find($student->user->id);
            $imageName = time() . $request->lastName.'.'.$request->profile_pic->extension(); 
    
            $user->profile_pic = $imageName;
            $user->save();
    
            $request->profile_pic->move(public_path('images'), $imageName);
        }
        
        $student->update($request->all());

        event(new UserLog("Updated student with ID#$student->id."));  

        return redirect()->route('admin.students')->with('Message', "Student [ID #$student->id] has been successfully updated.");
    }


    public function deleteStudent(Request $request) {
        $student = Student::find($request->id);
        $id = $request->id;
        $student->delete();
        event(new UserLog("Deleted student with ID#$id."));  
        return redirect()->route('admin.students')->with('Message', "Student [ID #$id] has been successfully deleted.");
    }


    public function showTeachers() {
        $teachers = Teacher::orderByRaw('lastName,firstName')->get();
        return view('pages.admins.teachers', compact('teachers'));
    }

    public function storeTeacher(Request $request) {
        $request->validate([
            'firstName'             => 'required|string',
            'lastName'              => 'required|string',
            'subj_teaching'         => 'string',
            'contactNo'             => 'numeric|regex:/(09)[0-9]{9}/|nullable',
        ]);


        $teacher = Teacher::create([
            'firstName'         => $request->firstName,
            'lastName'          => $request->lastName,
            'subj_teaching'     => $request->subj_teaching,
            'contactNo'         => $request->contactNo,
        ]);

        event(new UserLog("Created new teacher with ID#$teacher->id."));  
        return redirect()->route('admin.teachers')->with('Message', 'Teacher has been successfully created.');
        
    }


    public function updateTeacher(Request $request) {
        $request->validate([
            'id'                    => 'required|numeric',
            'firstName'             => 'required|string',
            'lastName'              => 'required|string',
            'subj_teaching'         => 'string',
            'contactNo'             => 'numeric|regex:/(09)[0-9]{9}/',
        ]);
        $teacher = Teacher::find($request->id);

        $teacher->update($request->all());
        event(new UserLog("Updated teacher with ID#$teacher->id.")); 
        return redirect()->route('admin.teachers')->with('Message', "Teacher [ID #$request->id] has been successfully updated.");
    }


    public function deleteTeacher(Request $request) {
        $teacher = Teacher::find($request->id);
        $id = $request->id;
        $teacher->delete();
        event(new UserLog("Deleted teacher with ID#$id.")); 
        return redirect()->route('admin.teachers')->with('Message', "Teacher [ID #$id] has been successfully deleted.");
    }


    public function showSubjects() {
        $subjects = Subject::orderBy('subjectName')->get();
        return view('pages.admins.subjects', compact('subjects'));
    }

    public function storeSubject(Request $request) {
        $request->validate([
            'subjectName'             => 'required|string',
            'subjectDescription'      => 'required|string',
        ]);

        $subject = Subject::create([
            'subjectName'         => $request->subjectName,
            'subjectDescription'  => $request->subjectDescription,
        ]);
        event(new UserLog("Created new subject with ID#$subject->id.")); 
        return redirect()->route('admin.subjects')->with('Message', "Subject ($subject->subjectName) has been successfully created.");
    }


    public function updateSubject(Request $request) {
        $request->validate([
            'id'                      => 'required|numeric',
            'subjectName'             => 'required|string',
            'subjectDescription'      => 'required|string',
        ]);

        $subject = Subject::find($request->id);

        $subject->update($request->all());
        event(new UserLog("Updated subject with ID#$subject->id.")); 
        return redirect()->route('admin.subjects')->with('Message', "Subject [ID #$request->id] has been successfully updated.");
    }

    public function deleteSubject(Request $request) {
        $subject = Subject::find($request->id);
        $id = $request->id;
        $subject->delete();
        event(new UserLog("Deleted subject with ID#$id.")); 
        return redirect()->route('admin.subjects')->with('Message', "Subject [ID #$id] has been successfully deleted.");
    }

    public function showSections() {
        $sections = Section::get();
        return view('pages.admins.sections', compact('sections'));
    }

    public function storeSection(Request $request) {
        $request->validate([
            'name'          => 'required|string',
            'room'          => 'required|string',
            'teacher_id'    => 'required|numeric',
            'level_id'      => 'required|numeric',
        ]);

        $section = Section::create([
            'name'          => $request->name,
            'room'          => $request->room,
            'teacher_id'    => $request->teacher_id,
            'level_id'      => $request->level_id
        ]);
        event(new UserLog("Created new section with ID#$section->id."));
        return redirect()->route('admin.sections')->with('Message', "Section ($section->name) has been successfully created.");
    }


    public function updateSection(Request $request) {
        $request->validate([
            'id'            => 'required|numeric',
            'name'          => 'required|string',
            'room'          => 'required|string',
            'teacher_id'    => 'required|numeric',
            'level_id'      => 'required|numeric',
        ]);

        $section = Section::find($request->id);

        $section->update($request->all());
        event(new UserLog("Updated section with ID#$section->id."));
        return redirect()->route('admin.sections')->with('Message', "Section ($section->name) has been successfully updated.");
    }

    public function deleteSection(Request $request) {
        $section = Section::find($request->id);
        $name = $section->name;
        $section->delete();
        event(new UserLog("Deleted section with ID#$section->id."));
        return redirect()->route('admin.sections')->with('Message', "Section ($name) has been successfully deleted.");
    }

    public function showClasses() {
        $classes = Session::get();
        return view('pages.admins.classes', compact('classes'));
    }

    public function storeClass(Request $request) {
        $request->validate([
            'teacher_id'    => 'required|numeric',
            'subject_id'    => 'required|numeric',
            'schedule'      => 'required|string',
            'start_time'    => 'required|string',
            'end_time'      => 'required|string',
           
        ]);

        $class = Session::create([
            'teacher_id'    => $request->teacher_id,
            'subject_id'    => $request->subject_id,
            'schedDay'      => $request->schedule,
            'schedTimeStart'=> $request->start_time,
            'schedTimeEnd'  => $request->end_time,
        ]);
        event(new UserLog("Created new class with ID#$class->id."));
        return redirect()->route('admin.classes')->with('Message', "Class has been successfully created.");
    }

    public function updateClass(Request $request) {
        $request->validate([
            'id'            => 'required|numeric',
            'teacher_id'    => 'required|numeric',
            'subject_id'    => 'required|numeric',
            'schedDay'      => 'required|string',
            'schedTimeStart'=> 'required|string',
            'schedTimeEnd'  => 'required|string',
        ]);

        $class = Session::find($request->id);

        $class->update($request->all());
        event(new UserLog("Updated class with ID#$class->id."));
        return redirect()->route('admin.classes')->with('Message', "Class [ID #$request->id] has been successfully updated.");
    }

    public function deleteClass(Request $request) {
        $class = Session::find($request->id);
        $id = $request->id;
        $class->delete();
        event(new UserLog("Deleted class with ID#$id."));
        return redirect()->route('admin.classes')->with('Message', "Section [ID #$id] has been successfully deleted.");
    }

    public function showSchoolYear() {
        $schoolyears = SchoolYear::get();
        return view('pages.admins.schoolyear', compact('schoolyears'));
    }

    public function storeSchoolYear(Request $request) {
        $request->validate([
            'schoolYr_started'      => 'required|numeric|min:2000|max:2100',
            'schoolYr_ended'        => 'required|numeric|min:2000|max:2100|gt:schoolYr_started'
        ]);

        $schoolyear = SchoolYear::create([
            'schoolYr_started'    => $request->schoolYr_started,
            'schoolYr_ended'      => $request->schoolYr_ended,
            'status'              => 'inactive'
        ]);
        event(new UserLog("Created school year with ID#$schoolyear->id."));
        return redirect()->route('admin.schoolyear')->with('Message', "School Year has been successfully created.");
    }

    public function updateSchoolYear(Request $request) {
        $request->validate([
            'id'    => 'required|numeric',
        ]);

        $schoolyear = SchoolYear::find($request->id);

        $schoolyear->status = 'active';
        $schoolyear->save();
        SchoolYear::where('id', '!=', $request->id)->update(['status' => 'inactive']);;
        event(new UserLog("Updated schoolyear with ID#$schoolyear->id."));
        return redirect()->route('admin.schoolyear')->with('Message', "$schoolyear->schoolYr_started - $schoolyear->schoolYr_ended has been set as current school year.");
    }

    public function deleteSchoolYear(Request $request) {
        $schoolyear = SchoolYear::find($request->id);
        $sy_temp = $schoolyear->schoolYr_started . ' - ' . $schoolyear->schoolYr_ended;
        $schoolyear->delete();
        event(new UserLog("Deleted schoolyear with $sy_temp."));
        return redirect()->route('admin.schoolyear')->with('Message', "School Year $sy_temp has been successfully deleted.");
    }

    public function showEnrolees() {
        $enrolees = Enroll::where('status', 'Pending')
            ->where('school_year_id', SchoolYear::currentYearAttr()->id ?? '')
            ->orderBy('created_at')
            ->get();

        return view('pages.admins.enrolees', compact('enrolees'));
    }

    public function viewEnrolee(Enroll $enrolee) {
        return view('pages.admins.view-enrolee', compact('enrolee'));
    }

    public function setApprovedEnrolee(Enroll $enrolee) {
        $classes = Session::all();
        return view('pages.admins.approved-enrolee', compact('enrolee', 'classes'));
    }

    public function storeEnrollStudent(Request $request, Enroll $enrolee) {
        $request->validate([
            'section_id'      => 'required|numeric',
            'subjects'        => 'required',
            'subjects.*'      => 'required|numeric'
        ]);

        $enrolee->section_id = $request->section_id;
        $enrolee->status = 'Approved';
        $subjects = $request->subjects;
        foreach($subjects as $subject) {
            ClassEnroll::create([
                'enroll_id'     => $enrolee->id,
                'session_id'    => $subject
            ]);
        }

        
        $enrolee->save();
        event(new UserLog("Approved enrolee with ID#$enrolee->id."));
        $user = $enrolee->student()->first()->user()->first();
        Mail::send('mail.approve-mail', ['user'=>$user], function($mail) use ($user){
            $mail->to($user->email);
            $mail->subject('Approved Enrollment');
            $mail->from('salusenrollmentsystem@gmail.com', 'Salus Enrollment System');
        }); 
        
        return redirect()->route('admin.enrolees')->with('Message', "Student has been enrolled.");
    }

    public function showLogs() {
        $logs = Log::orderBy('created_at', 'DESC')->get();
        
        return view('pages.admins.logs', compact('logs'));
    }

    public function showEnrolledStudents() {
        $enrolledStudents = Enroll::where('status', 'Approved')
        ->where('school_year_id', SchoolYear::currentYearAttr()->id ?? '')
        ->orderBy('level_id')
        ->get();

        return view('pages.admins.enrolled', compact('enrolledStudents'));
    }

    public function viewEnrolledStudent(Enroll $enrolledStudent) {
        return view('pages.admins.enrolled-view', compact('enrolledStudent'));
    }

    public function rejectEnrolee(Request $request) {
        $request->validate([
            'enrolee_id'      => 'required|numeric',
        ]);
       
        $enrolee = Enroll::find($request->enrolee_id);
        
        $enrolee->status = 'Rejected';
      
        $enrolee->save();
        event(new UserLog("Rejected enrolee with ID#$enrolee->id."));
        return redirect()->route('admin.enrolees')->with('Message', "Enrolee has been rejected.");
    }
}

