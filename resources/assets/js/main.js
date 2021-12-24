// import iconClickHandler from './icon';
// import svg4everybody from 'svg4everybody';
import $ from 'jquery';

document.addEventListener("DOMContentLoaded", function() {

    // $(document).ready(function(){
    //     alert("asdasd");
    // });


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


    // $('#form__input__button-visible').click(function(){
    //     if ($('#input-password').attr('type') == 'password'){
    //         $(this).addClass('view');
    //         $('#input-password').attr('type', 'text');
    //     } else {
    //         $(this).removeClass('view');
    //         $('#input-password').attr('type', 'password');
    //     }
    //     return false;
    // });

    $('#form-button').click(function(){
        var x = document.getElementById("myEmail").pattern;
        document.getElementById("demo").innerHTML = x;
    });
});


