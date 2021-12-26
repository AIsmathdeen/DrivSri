<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div style="width:800px; height:600px; padding:20px; text-align:center; border: 10px solid #787878">
            <div style="width:750px; height:550px; padding:20px; text-align:center; border: 5px solid #787878">
                <span style="font-size:50px; font-weight:bold; text-align: center">Certificate of Merit</span>
                <br><br>
                <span style="font-size:25px; text-align: center"><i>Presented by Sri Lanka Motor Traffic Department</i></span>
                <br><br>
                <span style="font-size:25px; text-align: center;"><i>To &nbsp;&nbsp; </i></span>
                <span style="font-size:30px ; text-align: center"><b>{{$certificate_data['name']}} </b></span><br /><br />
                <span style="font-size:30px ; text-align: center"><i>on {{date('d-m-Y') }}</i></span><br /><br />
                <span style="font-size:25px"><i>for respecting driving rules and being example for others.</i></span> <br/><br/><br/>
                <span style="font-size:30px">Lisence NO:{{$certificate_data['license_number']}}</span> <br/><br/>
                <span style="font-size:25px; font-weight:bold"><i>Most Discipline Drivers</i></span>  <br/><br/>
                <br><br><br><br>
                <span style="font-size:14px; text-align: center;"><i>THis certificate is valid for 3 months from the issued date. </i></span>
            </div>
        </div>
    </div>

</body>

</html>
