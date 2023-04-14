{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <br>
    <br>
    <br>
    <br>
    <br>
    <center>
        <form action='{{ url('/tenant') }}' method="post">
            @csrf
            <div>
                <label for="amt">Rent Amount </label>
                <input type="text" name="amt" id="amt">
            </div>
            <br>
            <div>
                <label for="amt">Tenants </label>
                <input type="text" name="tenants" id="tenants">
            </div>
            <br>
            <button type="submit">Submit</button>
        </form>
    </center>
</body>

</html> --}}
<?php

class Tenants
{
    function tenant($amt, $tenants)
    {
        // $amount=intval($_GET['amt']);
        // $tenants=intval($_GET['tenants']);

        $result = $amt / $tenants;
        // echo "<br> $amount"."  $users"."<br>";
        echo 'Rent amount :' . $amt . ' <br> Total tenants: ' . $tenants . '<br>';
        echo 'Amount Per person is : ' . $result . '<br><br>';
        return $result . '<br>';
    }

    function star($n)
    {
        echo '<br> Star pattern' . '<br>';

        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j <= $i; $j++) {
                echo '*';
            }
            echo '<br>';
        }
    }
}

$obj = new Tenants();
$obj->tenant(999, 5);
$obj->star(5);

function reversePyramid()
{
    echo"Reverse star pattern (Number)"."<br>";

    for ($i = 1; $i <= 5; $i++) {
        for ($j = 5; $j >= $i; $j--) {
            echo '*';
        }
        echo '<br>';
    }




}
// star(5);
reversePyramid();

function halfDimond($n)
{
    echo" <br> Half dimond pattern <br>";
    for ($i = 1; $i <= $n; $i++) {
        for ($j = 1; $j <= $i; $j++) {
            echo '*';
        }
        echo '<br>';
    }

    for ($i = 1; $i <=$n; $i++) {
        for ($j = $n-1; $j >= $i; $j--) {
            echo '*';
        }
        echo '<br>';
    }

}
halfDimond(5);

     function alternatePattern($n){
        echo"Alternate Star Patter <br>";

        for($i=0;$i<$n;$i++){
            for ($j=0; $j < 2*$n-1 ; $j++) {
                if($j%2==0){
                    echo"*";
                }
                else{
                    echo"-";
                }
            }
            echo "<br>";
        }
     }


// *-*-*
// *-*-*
// *-*-*

function mirrorStar(){

$n = 5;
echo"<br> Mirror Star Pattern <br>";

for($i = 0; $i < $n; $i++){
        for($j = 0; $j < $n-$i; $j++)

                echo "&nbsp&nbsp";
         for($j=0;$j<=$i;$j++)
            {
                echo("*");
            }

        echo("<br>");
    }

    echo" Mirror Star Pattern (Alphabets)"."<br>";
    $ch=65;
    for($i = 0; $i < $n; $i++){
        for($j = 0; $j < $n; $j++){
            if($j < $n-$i-1){
                echo "&nbsp&nbsp";
            } else {
                echo chr($ch);
            }
        }
        $ch++;
        echo("<br>");
    }

     echo" Mirror Star Pattern (Numbers)"."<br>";

     for($i = 0; $i<$n; $i++){
        for($j = 0; $j <$n-$i; $j++)

                echo "&nbsp&nbsp";
         for($j=1;$j<=$i;$j++)
            {
                echo("$j");
            }

        echo("<br>");
    }

}

function alphabetPatterns($n){
    echo("<br> Alphabet Patters <br>");

    $ch=65;
    for($i=0;$i<$n;$i++)
    {
        for($j=0;$j<=$i;$j++)
        {
            echo chr($ch);
            $ch++;
        }
        echo "<br>";

    }


   
}

 function hollow($n){
    echo"hollow <br>";
    for($i=0;$i<=$n;$i++){
        for($j=0;$j<=$n-$i;$j++)
        {
            echo "&nbsp";
        }
        for($j=0;$j<=$i;$j++)
        {
            echo "*";
        }
        echo "<br>";
    }
 }
 


alternatePattern(3);

mirrorStar();

alphabetPatterns(5);

hollow(5);

//     *
//    **
//   ***
//  ****
// *****




?>


