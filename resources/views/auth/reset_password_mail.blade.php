<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 40px;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .card {
      background: white;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 400px;
      width: 100%;
    }

    .card h2 {
      margin-bottom: 20px;
      color: #333;
    }

    .card a {
      display: inline-block;
      background: #007bff;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      margin-top: 15px;
      transition: background 0.3s ease;
    }

    .card a:hover {
      background: #0056b3;
    }

    .like-btn {
      margin-top: 25px;
      background: #e0e0e0;
      border: none;
      border-radius: 6px;
      padding: 10px 20px;
      cursor: pointer;
      font-size: 16px;
      transition: background 0.3s ease;
    }

    .like-btn.liked {
      background: #ff4d4d;
      color: white;
    }
  </style>
</head>

<body>
  <div class="card">
    <h2>Password Reset</h2>
    <p>Hi! You can reset your password using the link below:</p>
    <a class="btn btn-primary" href="{{ route('create_new_password',$data['id']) }}">Reset Password</a>

    </div>


</body>

</html>
