<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Course;
use App\Models\User;
use App\Notifications\NotificarCreador;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function store(StoreUser $request)
    {
        $validatedData = $request->validated();
        foreach (User::all() as $check) {
            if ($check->email == strtolower($validatedData["email"])) {
                $message_email = 'Email no disponible';
                if (app()->getLocale() == "en") {
                    $message_email = 'Email not available';
                } else if (app()->getLocale() == "eu") {
                    $message_email = 'Posta elektronikoa ez dago erabilgarri';
                }
                return back()->withErrors(['message_email' => $message_email]);
            } else if ($check->dni == strtoupper($validatedData["dni"])) {
                $message_dni = 'DNI no disponible';
                if (app()->getLocale() == "en") {
                    $message_dni = 'ID not available';
                } else if (app()->getLocale() == "eu") {
                    $message_dni = 'NAN-a ez dago erabilgarri';
                }
                return back()->withErrors(['message_dni' => $message_dni]);
            }
        }
        $user = User::create([
            'name' => $validatedData["name"],
            'surnames' => $validatedData["surnames"],
            'email' => strtolower($validatedData["email"]),
            'password' => $validatedData["password1"],
            'dni' => strtoupper($validatedData["dni"]),
            'role_id' => 1,
        ]);
        auth()->login($user);
        event(new Registered($user));
        return redirect()->to(route('verification.notice'));
    }

    public function myprofile()
    {
        return view("profile");
    }

    public function modify(Request $request, $lang, $id)
    {
        if (isset($request->admin_action) && $request->admin_action != "modify_user") {
            $action = $request->admin_action;
            if ($action == "ban_user") {
                foreach (Course::where('teacher_id', $request->id)->get() as $course) {
                    $course->delete();
                }
                User::find($request->id)->delete();
            } else if ($action == "restore_user") {
                foreach (Course::onlyTrashed()->where('teacher_id', $request->id)->get() as $course) {
                    $course->restore();
                }
                User::onlyTrashed()->where('id', $request->id)->restore();
            } else { // 'delete_user'
                foreach (Course::onlyTrashed()->where('teacher_id', $request->id)->get() as $course) {
                    $course->forceDelete();
                }
                User::onlyTrashed()->where('id', $request->id)->forceDelete();
            }
            return redirect()->to(route('admin', $lang));
        }
        $user_modify = User::find($id);
        if ($request->get("name") != null) {
            $user_modify->name = $request->get("name");
        }
        if ($request->get("surnames") != null) {
            $user_modify->surnames = $request->get("surnames");
        }
        if ($request->get("email") != null) {
            $user_modify->email = strtolower($request->get("email"));
        }

        $user_modify->save();

        if (auth()->user()->role_id == 3 && $request->panel) {
            return redirect()->to(route('admin', $lang));
        }
        return redirect()->to(route('profile', $lang));
    }

    public function password(Request $request)
    {
        $password = $request->get('password1');

        if (auth()->attempt(['email' => auth()->user()->email, "password" => $password]) == true) {
            $user_modify = User::find(auth()->user()->id);
            $new_password = $request->get('password2');
            $user_modify->password = $new_password;
            $user_modify->save();
            auth()->logout();

            return redirect()->to(route('login', app()->getLocale()));
        }
        $message = 'La contraseña no es correcta';
        if (app()->getLocale() == "en") {
            $message = 'Password is not correct';
        } else if (app()->getLocale() == "en") {
            $message = 'Pasahitza ez da zuzena';
        }
        return back()->withErrors(['message' => $message]);
    }

    public function upgrade(Request $request)
    {
        $user = User::findOrFail($request->user);
        $image_path = storage_path('app/' . $user->cv);
        unlink($image_path);

        if ($request->btn == "accept") {
            DB::table('users')
                ->where('id', $request->user)
                ->update(['role_id' => 2, 'cv' => null]);
            $user->notify(new NotificarCreador());
        } else {
            DB::table('users')
                ->where('id', $request->user)
                ->update(['cv' => null]);
        }
        return redirect()->to(route('admin', app()->getLocale()));
    }

    public function delete($lang, $id)
    {
        $user_delete = User::find($id);
        $user_delete->delete();
        return redirect()->to(route('login', app()->getLocale()));
    }

    public function admin()
    {
        if (Gate::allows('access-admin')) {
            $cvs = User::select("*")
                ->whereNotNull('cv')
                ->where('role_id', 1)
                ->get();
            $num_users = count(User::all());
            $num_courses = count(Course::all());
            $courses = Course::all();
            $best_score = 0;
            $best_course = "";
            foreach ($courses as $course) {
                $value = $course->ratings()->average('rating');
                $number = $course->ratings()->count();
                $score = ($value + 1) ** 3 * (sqrt($number) / ($number + 0.01)) * $number;
                $score += mt_rand() / mt_getrandmax(); // Componente aleatorio
                if ($score > $best_score) {
                    $best_score = $score;
                    $best_course = Course::find($course->id);
                }
            }
            $tag_names = DB::table('categories')->select('name')->get()->toArray();
            $tag_colors = DB::table('categories')->select('color')->get()->toArray();
            $tag_number = array();
            for ($i = 0; $i < count(Category::all()); $i++) {
                array_push($tag_number, 0);
            }

            $count = -1;
            foreach ($courses as $course) {
                $count = -1;
                foreach (Category::all() as $category_name) {
                    $count++;
                    foreach ($course->categories as $category) {
                        if ($category_name->name == Category::find($category->id)->name) {
                            $tag_number[$count] += 1;
                        }
                    }
                }
            }

            return view('admin', ['cvs' => $cvs, 'all_users' => User::all(), 'banned_users' => User::onlyTrashed()->get(), 'courses' => Course::all(), 'num_users' => $num_users, 'num_courses' => $num_courses, 'best_course' => $best_course, 'messages' => Contact::all(), 'tag_names' => $tag_names, 'tag_colors' => $tag_colors, 'tag_number' => $tag_number]);
        }
        abort(404);
    }
}
