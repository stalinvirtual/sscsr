function Validate(){
    //debugger;
    var username = $('#username').val();
    var password = $('#password').val();
    if(username == '' || username == undefined)
       {
        $('#err_msg').text('Enter Username');
        return false;
       }else if(password == '' || password == undefined)
       {
         $('#err_msg').text('Enter Password');
         return false;
       }
       else{
        var key = CryptoJS.enc.Hex.parse("0123456789abcdef0123456789abcdef");
        var iv = CryptoJS.enc.Hex.parse("abcdef9876543210abcdef9876543210");
        var pass=document.getElementById('password').value;
        var hash = CryptoJS.AES.encrypt(pass, key, {iv:iv});
        document.getElementById('password').value=hash;
    
        var user_nm=document.getElementById('username').value;
        var user_hash = CryptoJS.AES.encrypt(user_nm, key, {iv:iv});
        document.getElementById('username').value=user_hash;
        $("#username").attr('type', 'password');
         return true;
  
  
       }
  }