<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Partner Details PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .container { width: 100%; }
        .header { text-align: center; margin-bottom: 20px; }
        .details { margin-top: 10px; }
        .details strong { display: inline-block; width: 200px; }
        img { max-width: 120px; border-radius: 10px; border: 1px solid #ccc; margin-top: 5px; }
        .section { margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Partner With Us - Details</h2>
    </div>

    <div class="details">
        <div class="section"><strong>Dharamshala ID:</strong> {{ $data->dharamshala_id }}</div>
        <div class="section"><strong>Name:</strong> {{ $data->name }}</div>
        <div class="section"><strong>Dharamshala Name:</strong> {{ $data->dharamshala_name }}</div>
        <div class="section"><strong>Phone Number:</strong> {{ $data->phone_number }}</div>
        <div class="section"><strong>Email:</strong> {{ $data->email }}</div>
        <div class="section"><strong>Address:</strong> {{ $data->address }}</div>
        <div class="section"><strong>Dharamshala Address:</strong> {{ $data->dharamshala_address }}</div>
        <div class="section"><strong>Authorize Aadhar:</strong> {{ $data->auth_aadhar }}</div>

        <div class="section">
            <strong>Authorize Signature:</strong><br>
            <img src="http://127.0.0.1:8000/{{$data->auth_sign}}" alt="Signature">
        </div>

        <div class="section">
            <strong>Authorize Photo:</strong><br>
            <img src="http://127.0.0.1:8000/{{$data->auth_img}}" alt="Photo">
        </div>
    </div>
</body>
</html>
