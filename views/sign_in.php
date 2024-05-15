<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/images/logo.png">
    <link rel="stylesheet" href="./assets/css/sign_in.css">
    <title>Sign in</title>
</head>

<body>

    <!-- login -->
    <div class="login">
        <div class="logo">
            <div class="circle"></div>
            <img src="./assets/images/logo.png" alt="logo">
        </div>
        <div>
            <div class="head">
                <h1>Welcome back!</h1>
                <p>Happy to see you again!</p>
            </div>
            <form action="">
                <div>
                    <label for="label1">USERNAME OR EMAIL<span>*</span></label>
                    <input type="text" name="label1" id="label1">
                </div>
                <div>
                    <label for="label2">PASSWORD<span>*</span></label>
                    <input type="password" name="label2" id="label2">
                    <p><a href=''>Forgot your password?</a></p>
                </div>
                <input id="confirmLogin" type="submit" class="submit" value="Log In">
                <p>Don't have an account yet? <a id="reg">Register</a></p>
            </form>
        </div>
    </div>




    <!-- register -->
    <div class="register">
        <div class="head">
            <h1>Create an account</h1>
        </div>
        <form action="">
            <div>
                <label for="label3">EMAIL<span>*</span></label>
                <input required type="text" name="label3" id="label3">
            </div>
            <div>
                <label for="label4">DISPLAY NAME</label>
                <input type="text" name="label4" id="label4">
            </div>
            <div>
                <label for="label5">USERNAME<span>*</span></label>
                <input required type="text" name="label5" id="label5">
            </div>
            <div>
                <label for="label6">PASSWORD<span>*</span></label>
                <input required type="password" name="label6" id="label6">
            </div>
            <div>
                <label for="label6-1">REPEAT PASSWORD<span>*</span></label>
                <input required type="password" name="label6-1" id="label6-1">
            </div>
            <div>
                <label for="label7">DATE OF BIRTH<span>*</span></label>
                <div class="birth">
                    <select required name="month" id="month" id="label7">
                        <option value="" disabled selected>Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">Dicember</option>
                    </select>

                    <select required name="day" id="day">
                        <option value="" disabled selected>Day</option>
                    </select>

                    <select required name="day" id="year">
                        <option value="" disabled selected>Year</option>
                    </select>
                </div>
            </div>

            <div class="pandp">
                <input required type="checkbox" name="readed" id="label8">
                <label for="input8"></label>
                <p>I have read and agree to Cex's <a>Terms of Service </a>and <a>Privacy Policy</a>.</p>
            </div>

            <input id="confirmRegister" type="submit" class="submit" value="Register">
            <p>Already have an account? <a id="log">Log in</a></p>
        </form>
    </div>

</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="./assets/js/sign_in.js"></script>