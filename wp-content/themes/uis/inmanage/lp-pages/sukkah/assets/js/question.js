$(function(){ 
     $('#btnIntermediate').click(function(){
        $('#qu-steep01').removeClass('steeps_active');
        $('#qu-steep02').addClass('steeps_active');
    });
    $('#btnAdvanced').click(function () {
        $('#qu-steep01').removeClass('steeps_active');
        $('#qu-steep02').addClass('steeps_active');
    });

    $('#btnNoEnglish').click(function () {
        $('#qu-steep01').removeClass('steeps_active');
        $('#qu-steep04').addClass('steeps_active');
    });

    $('#qu-steep02>.button').click(function(){
        $('#qu-steep02').removeClass('steeps_active');
        $('#qu-steep03').addClass('steeps_active');
    });

    $('#qu-button_yes').click(function(){
        $('#qu-steep03').removeClass('steeps_active');
        $('#qu-steep05').addClass('steeps_active');
        setTimeout(function(){
            $('#Form').css('display', 'block');
            $('#Main').css('padding-top', '0');
            $('#LogoDiv').css('display', 'block');
            $('.qu-background').hide();
            $('.question-content').hide();
        },1000);
    });

    $('#qu-button_no').click(function(){
        $('#qu-steep03').removeClass('steeps_active');
        $('#qu-steep04').addClass('steeps_active');
    });

    $('#qu-steep04').click(function(){
        $('#qu-steep04').removeClass('steeps_active');
        $('#qu-steep01').addClass('steeps_active');
    });

    // $('#qu-steep05').click(function(){
    //     $('#qu-steep05').removeClass('steeps_active');
    //     $('#qu-steep01').addClass('steeps_active');
    // });
});

$(function () {
    $('#btnNoEnglish').click(function () {
        $('[name=Level_of_English__c]').val("No English");

    });
    $('#btnIntermediate').click(function () {
        $('[name=Level_of_English__c]').val("Intermediate");

    });

    $('#btnAdvanced').click(function () {
        $('[name=Level_of_English__c]').val("Advanced");

    });

    $('#btnYesQuestion2').click(function () {
        $('[name=Work_Experience_of_2_yrs__c]').val("Yes");

    });
    $('#btnNoQuestion2').click(function () {
        $('[name=Work_Experience_of_2_yrs__c]').val("No");

    });

    $('#qu-button_yes').click(function () {
        $('[name=Monthly_Income_over_1500__c]').val("Yes");

    });
    $('#qu-button_no').click(function () {
        $('[name=Monthly_Income_over_1500__c]').val("No");

    }); 

   

});

$(function(){
     $('#qu-steep01>.button').click(function(){
        $('#qu-steep01').removeClass('steeps_active');
        $('#qu-steep02').addClass('steeps_active');
    });


    $('#qu-steep02>.button').click(function(){
        $('#qu-steep02').removeClass('steeps_active');
        $('#qu-steep03').addClass('steeps_active');
    });

    $('#qu-steep03>.button').click(function(){
        $('#qu-steep03').removeClass('steeps_active');
        $('#qu-steep05').addClass('steeps_active');
        setTimeout(function(){
            $('#Form').css('display', 'block');
            $('#Main').css('padding-top', '0');
            $('#LogoDiv').css('display', 'block');
            $('.qu-background').hide();
            $('.question-content').hide();
        },1000);
    });

    $('#qu-steep04').click(function(){
        $('#qu-steep04').removeClass('steeps_active');
        $('#qu-steep01').addClass('steeps_active');
    });

    // $('#qu-steep05').click(function(){
    //     $('#qu-steep05').removeClass('steeps_active');
    //     $('#qu-steep01').addClass('steeps_active');
    // });
});

$(function () {
    $('#qu-steep03>.btnOptionA').click(function () {
        $('[name=Would_like_to_be_contacted_between__c]').val("Morning");

    });
    $('#qu-steep03>.btnOptionB').click(function () {
        $('[name=Would_like_to_be_contacted_between__c]').val("Noon");

    });

    $('#qu-steep03>.btnOptionC').click(function () {
        $('[name=Would_like_to_be_contacted_between__c]').val("Evening");

    });


    $('#qu-steep02>.btnOptionA').click(function () {
        $('[name=Average_Monthly_Income__c]').val("$1500-$2500");

    });
    $('#qu-steep02>.btnOptionB').click(function () {
        $('[name=Average_Monthly_Income__c]').val("$2500-$5000");

    });

    $('#qu-steep02>.btnOptionC').click(function () {
        $('[name=Average_Monthly_Income__c]').val("$5000 Or More");

    });

    $('#qu-steep01>.btnOptionA').click(function () {
        $('[name=Visa_needed_in__c]').val("Immediately");

    });
    $('#qu-steep01>.btnOptionB').click(function () {
        $('[name=Visa_needed_in__c]').val("6 months -1 Year");

    });

    $('#qu-steep01>.btnOptionC').click(function () {
        $('[name=Visa_needed_in__c]').val("1-2 Years");

    });
	


});