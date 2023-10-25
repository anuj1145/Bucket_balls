<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bucket;
use App\Models\Ball_avails;
use App\Models\Bucket_suggest;

class MainController extends Controller
{
    public function index()
    {

        $data = Bucket_suggest::all();
        return view("insert", compact('data'));
    }

    public function save_bucket(Request $request)
    {
        $input_bucket = $request->bucket;
        $data_buckets = Bucket::where("bucket_name", $input_bucket)->get()->toArray();

        if ($data_buckets) {
            $available_buckets = $data_buckets[0]['bucket_name'];
            $available_buckets = explode(",", $available_buckets);
            if (in_array($input_bucket, $available_buckets)) {
                echo "This bucket is already exist";
            }
        } else {
            $data = new Bucket;
            $data->bucket_name = $request->bucket;
            $data->volume = $request->volume;

            $data->save();
            Bucket_suggest::truncate();
            $bucket_name = $request->bucket;
            $data = Ball_avails::all();
            return view('insert', compact('bucket_name', 'data'));
        }
    }

    public function save_balls(Request $request)
    {
        $input_ball = $request->ball;
        $data_ball = Ball_avails::where("ball_name", $input_ball)->get()->toArray();

        if ($data_ball) {
            $balls_in_bucket = $data_ball[0]['ball_name'];
            $balls_in_bucket = explode(",", $balls_in_bucket);
            if (in_array($input_ball, $balls_in_bucket)) {
                echo "This ball is already exist";
            }
        } else {
            $data = new Ball_avails;
            $data->ball_name = $request->ball;
            $data->volume = $request->volume;
            $data->save();
            Bucket_suggest::truncate();   //empting all buckets
            return redirect(route('home'));
        }
    }

    public function place_ball(Request $request)
    {
        //print_r($request->ball_name);die;

        $ball_array = $request->ball_name;
        $ball_number = $request->quantity;

        $data_bucket = Bucket::get()->toArray();
        echo "<pre>";

        $bucket_array_len = count($data_bucket);
        //Bucket_suggest::truncate();   //empting the bucket

        for ($b = 0; $b < $bucket_array_len; $b++) {
            $bucket_vol = $data_bucket[$b]['volume'];
            $bucket = array();
            $tot_ball_vol = 0;
            for ($i = 0; $i < count($ball_array); $i++)   //ball loop
            {
                $data_ball = Ball_avails::where("ball_name", $ball_array[$i])->get()->toArray();
                // echo "<pre>";print_r($data_ball[0]);
                $ball_volume[$i] = $data_ball[0]['volume'];
                $ball_vol[$i] = $ball_volume[$i] * $ball_number[$i];
                if ($ball_vol[$i] <= $bucket_vol) {
                    //unset($bucket);
                    $tot_ball_vol = $tot_ball_vol + $ball_vol[$i];
                    array_push($bucket, $ball_number[$i] . " " . $ball_array[$i]);

                    $bucket_vol = $bucket_vol - $ball_volume[$i];
                    // if ($bucket_vol < $bucket_vol)
                    //    // break;
                } else {

                    echo "<b style='color:red;'>Caution!! Bucket size exceeded!!</b><br/>";
                    print_r('<b>' . $data_ball[0]['ball_name'] . '</b>');
                    echo " ball can not be inserted!";
                }
            }
            $bucket_name = $data_bucket[$b]['bucket_name'];
            Bucket_suggest::truncate();   //empting the bucket
            $data = new Bucket_suggest();
            $data->bucket = $bucket_name;
            $data->balls = json_encode($bucket);
            $data->save();
            echo "<hr>";
            echo "<p style='color:green;'>Congrats, Insertion has been done in bucket " . $bucket_name . " successfully!!</p>";
            break;
        } //end of ball loop
    }  //end of bucket loop
}
