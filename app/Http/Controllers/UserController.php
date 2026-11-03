<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Question;
use App\Models\Recent;
use App\Models\Topic;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function view_que()
    {
        $lang = Language::where('status', 0)->get();
        return view('user.que', compact('lang'));
    }
    public function view1_que()
    {
        $lang = Language::where('status', 0)->get();
        return view('user.que1', compact('lang'));
    }
    public function show_que(Request $request)
    {

        if ($request->id != NULL) {
            $res = Recent::find($request->id);
            $que = explode(",", $res->questions);
        }


        $lang_id = Language::select('id')->where('status', 0)->get();
        // dd($lang_id);
        $topic_id = Topic::select('id')->where('status', 0)->get();
        $data = Question::whereIn('language', $lang_id)->whereIn('topic', $topic_id)->where('status', 0)->with('connect2')->get();
        $all_data = Question::whereIn('language', $lang_id)->whereIn('topic', $topic_id)->with('connect2')->get();
        if ($request->id != NULL) {
            return ['all_data' => $all_data, 'data' => $data, 'que' => $que];
        } else {
            return ['all_data' => $all_data, 'data' => $data];
        }
    }
    public function add_que()
    {
        $lang = Language::where('status', 0)->get();


        // $topic = Topic::all();
        return view('user.add_que', compact('lang'));
    }
    public function get_topic(Request $request)
    {
        $id = $request->id;
        // return $id;
        $data = Topic::where('language', $id)->get();

        // Session::put('data', $data);

        // foreach($data as $info)
        // {
        //     $topic[] = $info->topic;
        // }
        return $data;
    }
    public function store_que(Request $request)
    {
        $user_id = Auth::user()->id;
        $request->validate([
            'language' => 'required',
            'topic' => 'required',
            'question' => 'required',
            'marks' => 'required',
        ], [
            'language.required' => 'Select Language',
            'topic.required' => 'Select Topic',
            'question.required' => 'Enter Question',
            'marks.required' => 'Enter Marks',
        ]);

        Question::create([
            'user_id' => $user_id,
            'language' => $request->language,
            'topic' => $request->topic,
            'question' => $request->question,
            'marks' => $request->marks,
        ]);
        return redirect()->route('view.que');
    }
    public function srch_que(Request $request)
    {

        if ($request->id != NULL) {
            $res = Recent::find($request->id);
            $que = explode(",", $res->questions);
        }
        $lang_id = Language::select('id')->where('status', 0)->get();
        // dd($lang_id);
        $topic_id = Topic::select('id')->where('status', 0)->get();
        $srch = $request->srch;
        $data = Question::whereIn('language', $lang_id)->whereIn('topic', $topic_id)->where('status', 0)->where("language", "like", "%$srch%")->with('connect2')->get();
        $all_data = Question::whereIn('language', $lang_id)->whereIn('topic', $topic_id)->where("language", "like", "%$srch%")->with('connect2')->get();

        $topic = Topic::where('language', $srch)->where('status', 0)->get();

        if ($request->id != NULL) {

            return ['all_data' => $all_data, 'topic' => $topic, 'data' => $data, 'que' => $que];
        } else {
            return ['all_data' => $all_data, 'topic' => $topic, 'data' => $data];
        }
    }
    public function srch1_que(Request $request)
    {

        if ($request->id != NULL) {
            $res = Recent::find($request->id);
            $que = explode(",", $res->questions);
        }
        $srch = $request->srch;
        $top = $request->top;
        $data = Question::where('status', 0)->where("language", "like", "$srch")->where("topic", "like", "$top")->with('connect2')->get();
        $all_data = Question::where("language", "like", "$srch")->where("topic", "like", "$top")->with('connect2')->get();


        if ($request->id != NULL) {
            return ['all_data' => $all_data, 'data' => $data, 'que' => $que];
        } else {
            return ['all_data' => $all_data, 'data' => $data];
        }
    }
    public function delete_que(Request $request)
    {
        $id = Question::find($request->id);
        // Question::where('id', $id)->delete();
        $id->status = 1;
        $id->save();
        return true;
    }
    public function act_que(Request $request)
    {
        $act_id = Question::find($request->id);
        $act_id->status = 0;
        $act_id->save();
        return true;
    }
    public function edit_que(Request $request)
    {
        $id = $request->id;
        // return $id;
        $data = Question::with('connect:id,language', 'connect1:id,topic')->where('id', $id)->first();
        return $data;
    }
    public function update_que(Request $request)
    {
        $id = $request->id;
        // return $id;
        $data = array(
            // 'language' => $request->language,
            // 'topic' => $request->topic,
            'question' => $request->question,
            'marks' => $request->marks,
        );

        Question::where('id', $id)->update($data);
        return true;
    }
    public function get_que(Request $request)
    {
        $user = Recent::find($request->user);

        $request->session()->put('user', $user);

        // dd($user);
        $id = $request->id;
        if ($id == null) {
            return 0;
        }
        // dump($id);
        $questions = Question::whereIn('id', $id)->orderBy('marks', 'asc')->get();
        $store = $request->session()->put('questions', $questions);
        return 1;
    }

    public function get_marks(Request $request)
    {
        // $id=[];
        //  $user = Recent::find($request->user);
        // dd($user);
        $sms = 'ok';
        $request->session()->put('sms', $sms);
        $id = $request->id;

        if ($id == null) {
            return 0;
        }

        $get_marks = Question::whereIn('id', $id)->get();


        $sum = 0;

        foreach ($get_marks as $get_mark) {
            $sum += $get_mark->marks;
            // dump($sum);
        }
        $request->session()->put('sum', $sum);
        return $sum;
    }
    public function final_que()
    {
        // $res = Recent::find($id);
        // dd($res);
        $user = session()->get('user');
        if ($user) {
            $type = $user->type;
            $date = $user->date;
            $sum = $user->marks;
            if (session()->get('sms')) {
                $sum = session()->get('sum');
            }
        } else {
            $type = '';
            $date = '';
            $sum = session()->get('sum');
        }
        // dd($type);

        $questions = session()->get('questions');

        // dd($sum);

        return view('user.final_que', compact('questions', 'sum', 'type', 'date'));
    }
    public function get_type(Request $request)
    {
        $lang = Language::where('status', 0)->get();
        $type = Type::all();
        return ['lang' => $lang, 'type' => $type];
    }
    public function chng_type(Request $request)
    {
        $id = $request->id;
        $data = Language::whereIn('id', $id)->get();
        $type_id = $request->type_id;
        $type = Type::where('id', $type_id)->first();
        return ['data' => $data, 'type' => $type];
        // return $type;
    }
    public function create_pdf(Request $request)
    {

        $user = session()->get('user');
        // dd($user);


        $name = $request->sub;
        $id = implode(",", $request->questions);
        $all = Recent::where('type', $request->type)->where('date', $request->date)->where('questions', $id)->get();
        $cnt = count($all);

        if ($user) {
            if($request->date == $user->date && $request->type == $user->type)
            {
                Recent::find($user->id)->update([
                    'user_id' => Auth::user()->id,
                    'date' => $request->date,
                    'type' => $request->type,
                    'marks' => $request->marks,
                    'questions' => $id,
                ]);

                if (!$name) {
    
                    ini_set('max_execution_time', 60000);
                    // $questions = $request->session()->get('questions');
                    // dump($questions);
                    $sum = $request->session()->get('sum');
                    // dd(print_r($questions));
                    $questions = Question::whereIn('id', $request->questions)->get();
                    // dd($questions);
    
                    $data = [
                        'questions' => $questions,
                        'type' => $request->type,
                        'date' => $request->date,
                        'sum' => $request->marks,
                        // 'type' => $request->type,
                    ];
                    // dd($data);
    
                    $pdf = PDF::loadView('user.create_pdf', $data);
    
                    return  $pdf->download($request->type . '.pdf');
                }
                
            }
            else
            {
                $data = Recent::create([
                    'user_id' => Auth::user()->id,
                    'date' => $request->date,
                    'type' => $request->type,
                    'marks' => $request->marks,
                    'questions' => $id,
                ]);
    
                if (!$name) {
    
                    ini_set('max_execution_time', 60000);
                    // $questions = $request->session()->get('questions');
                    // dump($questions);
                    $sum = $request->session()->get('sum');
                    // dd(print_r($questions));
                    $questions = Question::whereIn('id', $request->questions)->get();
                    // dd($questions);
    
                    $data = [
                        'questions' => $questions,
                        'type' => $request->type,
                        'date' => $request->date,
                        'sum' => $request->marks,
                        // 'type' => $request->type,
                    ];
                    // dd($data);
    
                    $pdf = PDF::loadView('user.create_pdf', $data);
    
                    return  $pdf->download($request->type . '.pdf');
                }
            }
        }

        else
        {
            if ($cnt == 0) {
                $data = Recent::create([
                    'user_id' => Auth::user()->id,
                    'date' => $request->date,
                    'type' => $request->type,
                    'marks' => $request->marks,
                    'questions' => $id,
                ]);
    
                if (!$name) {
    
                    ini_set('max_execution_time', 60000);
                    // $questions = $request->session()->get('questions');
                    // dump($questions);
                    $sum = $request->session()->get('sum');
                    // dd(print_r($questions));
                    $questions = Question::whereIn('id', $request->questions)->get();
                    // dd($questions);
    
                    $data = [
                        'questions' => $questions,
                        'type' => $request->type,
                        'date' => $request->date,
                        'sum' => $request->marks,
                        // 'type' => $request->type,
                    ];
                    // dd($data);
    
                    $pdf = PDF::loadView('user.create_pdf', $data);
    
                    return  $pdf->download($request->type . '.pdf');
                }
            } else {
                if (!$name) {
    
                    ini_set('max_execution_time', 60000);
                    // $questions = $request->session()->get('questions');
                    // dump($questions);
                    $sum = $request->session()->get('sum');
                    // dd(print_r($questions));
                    $questions = Question::whereIn('id', $request->questions)->get();
                    // dd($questions);
    
                    $data = [
                        'questions' => $questions,
                        'type' => $request->type,
                        'date' => $request->date,
                        'sum' => $request->marks,
                        // 'type' => $request->type,
                    ];
                    // dd($data);
    
                    $pdf = PDF::loadView('user.create_pdf', $data);
    
                    return  $pdf->download($request->type . '.pdf');
                }
            }
        }

        return redirect()->route('recent.paper');
    }
}
