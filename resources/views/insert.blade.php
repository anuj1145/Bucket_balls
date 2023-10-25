<?php use App\Models\Ball_avails; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        input {
            margin: 5px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Insert form</title>
</head>

<body>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-sm-8 p-3 bg-dark text-white">
                <h2>Bucket Form</h2>
                <form action="{{route('save_bucket')}}" method="post">
                    @csrf
                    <input type="text" name="bucket" id="bucket" placeholder="Enter bucket name"><br>
                    <input type="text" name="volume" id="volume" placeholder="Enter volume (in inches)"><br><br>
                    <input type="submit" class="btn btn-primary" value="Save">
                </form>

                <hr>
                <h2>Ball Form</h2>
                <?php
                $cookie_value=@$bucket_name;
                $cookie_name="bucket";
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); //for 1 day
               if(isset($_COOKIE[$cookie_name])) { 
                //echo "You selected bucket: " . $_COOKIE[$cookie_name];
                 ?>
                <h2>Ball Form</h2>
                <form action="{{route('save_balls')}}" method="post">
                    @csrf
                    <input type="text" name="ball" id="ball" placeholder="Enter ball name"><br>
                    <input type="hidden" name="bucket" id="bucket" value="<?php echo $_COOKIE[$cookie_name];?>"><br>
                    <input type="text" name="volume" id="volume" placeholder="Enter volume (in inches)"><br><br>
                    <input type="submit" class="btn btn-primary" value="Save">
                </form>
                <?php 
            
            } 
                else{  ?>
                 <form action="{{route('save_balls')}}" method="post">
                    @csrf
                    <input type="text" name="ball" id="ball" placeholder="Enter ball name"><br>
                    <input type="hidden" name="bucket" id="bucket" value="A"><br>
                    <input type="text" name="volume" id="volume" placeholder="Enter volume (in inches)"><br><br>
                    <input type="submit" class="btn btn-primary" value="Save">
                </form>
                <?php }?>
                
            </div>
            <div class="col-sm-4 p-3 bg-success text-white">

            <h2>Bucket Suggestion</h2>
              
          <?php $data_ball=Ball_avails::all()->toArray(); //echo "<pre>";print_r($data_ball); ?>
     
        <?php //print_r($balls); ?>
                <form action="{{route('place_balls')}}" method="post">
                    @csrf
                    @foreach($data_ball as $balls)
                    <label for="ball">{{$balls['ball_name']}}</label>: <input type="hidden" name="ball_name[]" value="{{$balls['ball_name']}}"> <input type="text" name="quantity[]" value="{{$balls['quantity']}}"> <br>
                    @endforeach 
                    <br/><input type="submit" class="btn btn-primary" value="Place balls in bucket">
                </form>
            </div>
           
            
        </div>
       
        @foreach($data as $datum)
        <?php echo "Bucket " . $datum['bucket'].":"?>
       <?php 
       echo $datum['balls'];
       
       echo "<br />";?>
        @endforeach
   
    </div>
</body>

</html>
