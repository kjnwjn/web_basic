<style>
    .form-validation .error-message {
        color: red;
        margin-top: 12px;
        font-size: 12px;
    }
    .extraAction{
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 10px;
       
    }
    .btnHome,.btnRedirect{
        width: 130px;
        padding: 5px 1px;
        border: none;
        border-radius:5px;
    }
    .btnHome{
        background-color:#222d73;
         color: #fff;
    }
    .btnHome:hover{
        background-color: #20319f;
        cursor: pointer;
        
    }
    .btnRedirect{
        background-color: #67c5e1;
         color: #fff;
    }
    .btnRedirect:hover{
        background-color: #0dd6f4;
        cursor: pointer;

    }
    .home_link{
        color: #fff;
        text-decoration: none;
        padding: 5px 47px;
    }
</style>
<div class="main login-main" style="background-image: linear-gradient(45deg, #222D73 0%, #78ebfc 100%)">
    <form action="" method="POST" class="form" id="conFirmOtp-form">
        <h3 class="heading">Confirm OTP</h3>
        <p class="desc"></p>
        <div class="form-group form-validation">
            <label for="otpValue" class="form-label">You Otp code</label>
            <input id="otpValue" name="otpValue" placeholder="Type 6 characters" type="password" class="form-control" rules="required&min=6" />
            <span class="error-message"></span>
        </div>
        <button type="submit" id="btnSubmit" class="form-submit btn">Submit</button>
        <div class="extraAction">
            <button type="button" id="" class="btnHome"><a href="<?= getenv('BASE_URL')?>" class="home_link" >Home</a></button>
            <button type="button" id="" class="btnRedirect" ><a href="<?= getenv('BASE_URL')?>transactionHistory" class="home_link" >History</a></button>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="/main.js"> </script>
<script>
    url = 'http://localhost/api/service/confirm-OTP'
    
    if($('#conFirmOtp-form')){
        validation_submitform(url)
    }
</script>
