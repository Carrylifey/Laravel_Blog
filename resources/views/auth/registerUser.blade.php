<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regsitration Form Website</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url('https://i.postimg.cc/054d9xdf/img.jpg');
    background-size: cover;
    background-position: center;
}

.wrapper{
    width: 750px;
    background: rgba(255, 255, 255, .1);
    border: 2px solid rgba(255, 255, 255, .2);
    box-shadow: 0 0 10px rgba(0, 0, 0, .2);
    backdrop-filter: blur(50px);
    border-radius: 10px;
    color: #fff;
    padding: 40px 35px 55px;
    margin: 0 10px;
}

.wrapper h1{
    font-size: 36px;
    text-align: center;
    margin-bottom: 20px;
}

.wrapper .input-box{
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.input-box .input-field{
    position: relative;
    width: 48%;
    height: 50px;
    margin: 13px 0;
}

.input-box .input-field input{
    width: 100%; 
    height: 100%;
    background: transparent;
    border: 2px solid rgba(255, 255, 255, .2);
    outline: none;
    font-size: 16px;
    color: #fff;
    border-radius: 10px;
    padding: 15px 15px 15px 40px;
}

.input-box .input-field input::placeholder{
    color: #fff;
}

.input-box .input-field ion-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 20px;
}

.wrapper label{
    display: inline-block;
    font-size: 14.5px;
    margin: 10px 0 23px;
}

.wrapper p{
    display: flex;
    font-size: 16px;
    margin: 30px 0 23px;
    align-items: center;
    justify-content: center;
    letter-spacing: 1px;
}

.wrapper a{
  text-decoration: none;
  color: #fff;
}

.wrapper a:hover{
  text-decoration: underline;
}


.wrapper label input{
    accent-color: #fff;
    margin-right: 10px;
}

.wrapper .btn{
    width: 100%;
    height: 45px;
    background: #fff;
    border: none;
    outline: none;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, .1);
    cursor: pointer;
    font-size: 16px;
    color: #333;
    font-weight: 600;
}

@media(max-width: 576px){
    .input-box .input-field{
        width: 100%;
        margin: 10px 0;
    }
}
</style>
<body>
    <div class="wrapper">
        <form action="">
            <h1>Registration</h1>

            <div class="input-box">
                <div class="input-field">
                    <input type="text" placeholder="Full Name" required>
                    <ion-icon name="person"></ion-icon>
                </div>
                <div class="input-field">
                    <input type="text" placeholder="Username" required>
                    <ion-icon name="person"></ion-icon>
                </div>
            </div>

            <div class="input-box">
                <div class="input-field">
                    <input type="email" placeholder="Email" required>
                    <ion-icon name="mail"></ion-icon>
                </div>
                <div class="input-field">
                    <input type="number" placeholder="Phone Number" required>
                    <ion-icon name="call"></ion-icon>
                </div>
            </div>

            <div class="input-box">
                <div class="input-field">
                    <input type="password" placeholder="Password" required>
                    <ion-icon name="lock"></ion-icon>
                </div>
                <div class="input-field">
                    <input type="password" placeholder="Confirm Password" required>
                    <ion-icon name="lock"></ion-icon>
                </div>
            </div>
            <label><input type="checkbox">I hereby declare that the above information provided is true and correct</label>

            <button type="submit" class="btn">Register</button>
          
        </form>
    </div>

    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
</body>
</html>