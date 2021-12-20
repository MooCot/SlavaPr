import iconClickHandler from './icon';
// import svg4everybody from 'svg4everybody';

document.addEventListener("DOMContentLoaded", () => {
    // let icons = document.getElementsByClassName('social__link');
    
    // for (let i = 0; i < icons.length; i++) {
    //     icons[i].addEventListener('click', iconClickHandler);
    // }
    // svg4everybody();
    // alert("Hi");


    $('body').on('click', '.input-group__img-visible', function(){
        if ($('#password-input').attr('type') == 'password'){
            $(this).addClass('view');
            $('#password-input').attr('type', 'text');
        } else {
            $(this).removeClass('view');
            $('#password-input').attr('type', 'password');
        }    
        return false;
    });

    $('#login-button').on('click', '#login-button', function(){
        var x = document.getElementById("myEmail").pattern;
        document.getElementById("demo").innerHTML = x;
    });

    // $(".form__button").click(function(){
    //     alert("I am here");
    // });
});


