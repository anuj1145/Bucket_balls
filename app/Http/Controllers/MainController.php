<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bucket;
use App\Models\Ball_avails;
use App\Models\Bucket_suggestion;

class MainController extends Controller
{
    public function index()
    {

        $data = Ball_avails::all();
        return view("insert", compact('data'));
    }

    public function save_bucket(Request $request)
    {
        $data = new Bucket;
        $data->bucket_name = $request->bucket;
        $data->volume = $request->volume;

        $data->save();
        //     if (isset($_POST['Submit'])) {
        //         setcookie("bucket", $_POST['bucket'], time() + (86400 * 30), "/");
        //    }

        //    if(isset($_COOKIE['bucket'])) {
        //     echo $_COOKIE['bucket'];
        // } 
        $bucket_name = $request->bucket;
        $data = Ball_avails::all();
        // return redirect(route('home'));

        //    $cookie_value=@$bucket_name;
        //    $cookie_name="bucket";
        //    if(!strcmp($_COOKIE[$cookie_name],$bucket_name)){
        //    setcookie($cookie_name, $cookie_value, time() - 3600);
        //    }
        //header("Refresh:0");

        return view('insert', compact('bucket_name', 'data'));


        //     if (isset($_POST['Submit'])) {
        //          $_SESSION['bucket'] = $_POST['bucket'];
        //     }
        //     $buck=$_SESSION['bucket'];
        // echo '<br>';
        // echo 'POST: '.$_POST['bucket'];
    }

    public function save_balls(Request $request)
    {
        //$data=new Ball_avails;
        $data_ball = new Bucket_suggestion;
        // echo "<pre>";print_r($data_ball::all()->toArray());
        $ball = $request->ball;
        $data_bucket = Bucket::where("bucket_name", $request->bucket)->get()->toArray();
        //$avail_vol=$data_bucket[0]['volume'];
        $data = Ball_avails::where("ball_name", $request->ball)->get()->toArray();
        //$use_vol=$data[0]['quantity']*$data[0]['volume'];

        if ($data) {
            $no_of_balls = $data[0]['quantity'];
        } else {
            $no_of_balls = 0;
        }
        // echo $avail_vol.$use_vol;die;
        //if($avail_vol>=$use_vol){

        //$no_of_balls = $request->volume;
        if ($ball == 'Red') {

            $data_bucket = Bucket::where("bucket_name", $request->bucket)->get()->toArray();
            $avail_vol = $data_bucket[0]['volume'];
            $data = Ball_avails::where("ball_name", $request->ball)->get()->toArray();
            $use_vol = $data[0]['quantity'] * $data[0]['volume'];
            if ($avail_vol >= $use_vol) {
                $data = Bucket_suggestion::select($ball)->get()->toArray();
                $data_red = $data[0]['Red'];
                //echo $data_red;die;
                //echo $data_red.$no_of_balls;die;
                if ($data_red != $no_of_balls) {
                    while ($data_red >= $no_of_balls) {
                        $data = new Ball_avails;
                        $data = Ball_avails::where("ball_name", $request->ball)->get()->toArray();
                        if ($data) {
                            $quan = $data[0]['quantity'];
                            $input = array(
                                'quantity' => $quan + 1,
                                'ball_name' => $request->ball,
                                'volume' => $request->volume,
                                'bucket' => $request->bucket
                            );
                            Ball_avails::whereball_name($request->ball)->update($input);
                        } else {
                            $data = new Ball_avails;
                            $data->ball_name = $request->ball;
                            $data->volume = $request->volume;
                            $data->quantity = 1;
                            $data->bucket = $request->bucket;

                            $data->save();
                        }
                        return redirect(route('home'));
                    }
                } else {
                    echo "No sufficient ball in the shop";
                }
            } else {
                echo "Bucket size exceed";
            }
        } else if ($ball == 'Blue') {
            $data_bucket = Bucket::where("bucket_name", $request->bucket)->get()->toArray();
            $avail_vol = $data_bucket[0]['volume'];
            $data = Ball_avails::where("ball_name", $request->ball)->get()->toArray();
            $use_vol = $data[0]['quantity'] * $data[0]['volume'];
            if ($avail_vol >= $use_vol) {
                $data = Bucket_suggestion::select($ball)->get()->toArray();
                $data_blue = $data[0]['Blue'];
                // echo $data_red;
                if ($data_blue != $no_of_balls) {
                    while ($data_blue >= $no_of_balls) {
                        $data = new Ball_avails;
                        $data = Ball_avails::where("ball_name", $request->ball)->get()->toArray();
                        if ($data) {
                            $quan = $data[0]['quantity'];
                            $input = array(
                                'quantity' => $quan + 1,
                                'ball_name' => $request->ball,
                                'volume' => $request->volume,
                                'bucket' => $request->bucket
                            );
                            Ball_avails::whereball_name($request->ball)->update($input);
                        } else {
                            $data = new Ball_avails;
                            $data->ball_name = $request->ball;
                            $data->volume = $request->volume;
                            $data->quantity = 1;
                            $data->bucket = $request->bucket;

                            $data->save();
                        }
                        return redirect(route('home'));
                    }
                } else {
                    echo "No sufficient ball in the shop";
                }
            } else {
                echo "Bucket size exceed";
            }
        } else if ($ball == 'Pink') {
            $data_bucket = Bucket::where("bucket_name", $request->bucket)->get()->toArray();
            $avail_vol = $data_bucket[0]['volume'];
            $data = Ball_avails::where("ball_name", $request->ball)->get()->toArray();
            $use_vol = $data[0]['quantity'] * $data[0]['volume'];
            if ($avail_vol >= $use_vol) {
                $data = Bucket_suggestion::select($ball)->get()->toArray();
                $data_pink = $data[0]['Pink'];
                // echo $data_red;
                if ($data_pink != $no_of_balls) {
                    while ($data_pink >= $no_of_balls) {
                        $data = new Ball_avails;
                        $data = Ball_avails::where("ball_name", $request->ball)->get()->toArray();
                        if ($data) {
                            $quan = $data[0]['quantity'];
                            $input = array(
                                'quantity' => $quan + 1,
                                'ball_name' => $request->ball,
                                'volume' => $request->volume
                            );
                            Ball_avails::whereball_name($request->ball)->update($input);
                        } else {
                            $data = new Ball_avails;
                            $data->ball_name = $request->ball;
                            $data->volume = $request->volume;
                            $data->quantity = 1;
                            $data->bucket = 'A';

                            $data->save();
                        }
                        return redirect(route('home'));
                    }
                } else {
                    echo "No sufficient ball in the shop";
                }
            } else {
                echo "Bucket size exceed";
            }
        } else if ($ball == 'Green') {
            $data_bucket = Bucket::where("bucket_name", $request->bucket)->get()->toArray();
            $avail_vol = $data_bucket[0]['volume'];
            $data = Ball_avails::where("ball_name", $request->ball)->get()->toArray();
            $use_vol = $data[0]['quantity'] * $data[0]['volume'];
            if ($avail_vol >= $use_vol) {
                $data = Bucket_suggestion::select($ball)->get()->toArray();
                $data_green = $data[0]['Green'];
                // echo $data_red;
                if ($data_green != $no_of_balls) {
                    while ($data_green >= $no_of_balls) {
                        $data = new Ball_avails;
                        $data = Ball_avails::where("ball_name", $request->ball)->get()->toArray();
                        if ($data) {
                            $quan = $data[0]['quantity'];
                            $input = array(
                                'quantity' => $quan + 1,
                                'ball_name' => $request->ball,
                                'volume' => $request->volume,
                                'bucket' => $request->bucket
                            );
                            Ball_avails::whereball_name($request->ball)->update($input);
                        } else {
                            $data = new Ball_avails;
                            $data->ball_name = $request->ball;
                            $data->volume = $request->volume;
                            $data->quantity = 1;
                            $data->bucket = $request->bucket;

                            $data->save();
                        }
                        return redirect(route('home'));
                    }
                } else {
                    echo "No sufficient ball in the shop";
                }
            } else {
                echo "Bucket size exceed";
            }
        } else if ($ball == 'Orange') {
            $data_bucket = Bucket::where("bucket_name", $request->bucket)->get()->toArray();
            $avail_vol = $data_bucket[0]['volume'];
            $data = Ball_avails::where("ball_name", $request->ball)->get()->toArray();
            $use_vol = $data[0]['quantity'] * $data[0]['volume'];
            if ($avail_vol >= $use_vol) {
                $data = Bucket_suggestion::select($ball)->get()->toArray();
                $data_orange = $data[0]['Orange'];
                // echo $data_red;
                if ($data_orange != $no_of_balls) {
                    while ($data_orange >= $no_of_balls) {
                        $data = new Ball_avails;
                        $data = Ball_avails::where("ball_name", $request->ball)->get()->toArray();
                        if ($data) {
                            $quan = $data[0]['quantity'];
                            $input = array(
                                'quantity' => $quan + 1,
                                'ball_name' => $request->ball,
                                'volume' => $request->volume,
                                'bucket' => $request->bucket
                            );
                            Ball_avails::whereball_name($request->ball)->update($input);
                        } else {
                            $data = new Ball_avails;
                            $data->ball_name = $request->ball;
                            $data->volume = $request->volume;
                            $data->quantity = 1;
                            $data->bucket = $request->bucket;

                            $data->save();
                        }
                        return redirect(route('home'));
                    }
                } else {
                    echo "No sufficient ball in the shop";
                }
            } else {
                echo "Bucket size exceed";
            }
        }



        // $data->ball_name=$request->ball;
        // $data->volume=$request->volume;

        // $data->save();
        // return redirect(route('home'));

    }

    // public function place_ball(Request $request)
    // {
    //     $data=Ball_avails::where("ball_name", $request->ball)->get()->toArray();

    //     foreach ($data as $key => $value){
    //         //echo '<b>Key</b> '.$key .': <b>Value</b> '. $value['volume'];
    //         }
    //     $insert_vol=$value['volume']*$request->quantity;
    //     print_r($insert_vol);
    //     $data_bucket=Ball_avails::where("ball_name", $request->ball)->get()->toArray();
    //     //echo "<pre>";print_r($data_bucket);
    //     //echo $insert_vol;
    //     $data_bucket= Bucket::first()->toArray();
    //     foreach($data_bucket as $value_b){
    //         // print_r($value_b['quantity']);
    //         // $insert_vol=$value['volume']*$request->quantity;

    //         //echo "<pre>";print_r($data_bucket);
    //         $avail_vol=$value['volume'];
    //     echo $insert_vol. $avail_vol;
    //     if($insert_vol <= $avail_vol)
    //     {
    //         // $data=Ball_avails::where("ball_name", $request->ball)->get()->toArray();
    //         // print_r($data);die;
    //        //echo "hiii";
    //         //$data=new Ball_avails;
    //         // print_r($data_bucket::all());
    //         $input=array('quantity'=>$request->quantity,
    //         'ball_name'=>$request->ball_name);
    //         Ball_avails::whereball_name($request->ball_name)->update($input);
    //          //$data->save();
    //          //return redirect(route('home'));
    //     }
    //     else{
    //         echo "size exceed";
    //     }
    // }
    //     $data_bucket=new Bucket;
    //    // print_r($data_bucket::all());
    //    print_r($data_bucket::all()->toArray());
    // //    $request->session()->put('bucket_name', $_POST['bucket']);
    // //    $value = $request->session()->get('key');
    //     // $data->ball_name=$request->ball;
    //     // $data->bucket=$value;
    //     // $data->quantity=$request->quantity;

    //     // $data->save();
    //     //return redirect(route('home'));

    // }

    public function place_ball(Request $request)
    {
        // $input=array('quantity'=>$request->quantity,
        //              'ball_name'=>$request->ball_name);
        // Ball_avails::whereball_name($request->ball_name)->update($input);
        $data = new Bucket_suggestion;
        $data->bucket_name = 'A';
        $data->red_ball = $request->red_ball;
        $data->blue_ball = $request->blue_ball;
        $data->green_ball = $request->green_ball;
        $data->orange_ball = $request->orange_ball;
        $data->pink_ball = $request->pink_ball;

        $data->save();
        return redirect(route('home'));
    }
}
