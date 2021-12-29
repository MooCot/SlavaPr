// import iconClickHandler from './icon';
// import svg4everybody from 'svg4everybody';
import $ from 'jquery';

require('jquery-mask-plugin');

document.addEventListener("DOMContentLoaded", function() {

    // $(document).ready(function(){
    //     alert("asdasd");
    // });
    [].forEach.call( document.querySelectorAll('.rupiah'), function(input) {
        var keyCode;
        function mask(event) {
            event.keyCode && (keyCode = event.keyCode);
            var pos = this.selectionStart;
            if (pos < 3) event.preventDefault();
            var matrix = "+380-__-___-____",
                i = 0,
                def = matrix.replace(/\D/g, ""),
                val = this.value.replace(/\D/g, ""),
                new_value = matrix.replace(/[_\d]/g, function(a) {
                    return i < val.length ? val.charAt(i++) || def.charAt(i) : a
                });
            i = new_value.indexOf("_");
            if (i != -1) {
                i < 5 && (i = 3);
                new_value = new_value.slice(0, i)
            }
            var reg = matrix.substr(0, this.value.length).replace(/_+/g,
                function(a) {
                    return "\\d{1," + a.length + "}"
                }).replace(/[+()]/g, "\\$&");
            reg = new RegExp("^" + reg + "$");
            if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
            if (event.type == "blur" && this.value.length < 5)  this.value = ""
        }
    
        input.addEventListener("input", mask, false);
        input.addEventListener("focus", mask, false);
        input.addEventListener("blur", mask, false);
        input.addEventListener("keydown", mask, false)
    
      });

    $("#input-group__button-visible").click(function(e){
        if ($('#password-input').attr('type') == 'password'){
            $(this).addClass('view');
            $('#password-input').attr('type', 'text');
        } else {
            $(this).removeClass('view');
            $('#password-input').attr('type', 'password');
        }
        return false;
    });

    $("#form__input-password__button-visible").click(function(e){
        if ($('#input-password').attr('type') == 'password'){
            $(this).addClass('view');
            $('#input-password').attr('type', 'text');
        } else {
            $(this).removeClass('view');
            $('#input-password').attr('type', 'password');
        }
        return false;
    });

    $("#form__input-password-confirm__button-visible").click(function(e){
        if ($('#input-password-confirmation').attr('type') == 'password'){
            $(this).addClass('view');
            $('#input-password-confirmation').attr('type', 'text');
        } else {
            $(this).removeClass('view');
            $('#input-password-confirmation').attr('type', 'password');
        }
        return false;
    });

    // $('.rupiah').mask('+380 999-999-999', {reverse: false});

    $('#showform').click(function(){
        $('#alert-form').css('display','flex');
    });

    $('#closeform').click(function(){
        $('#alert-form').css('display','none');
    });

    $('#closeform2').click(function(){
        $('#alert-form').css('display','none');
    });

    $('#form-button').click(function(){
        var x = document.getElementById("myEmail").pattern;
        document.getElementById("demo").innerHTML = x;
    });
});




