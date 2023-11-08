$(document).ready(function(){
    var name = $('#name').val();
    var birthdateText = $('#birthdate').val();
    if(birthdateText !== '')
    {
        // Parse the birthdate to a Date object
        var birthdateDate = new Date(birthdateText);

        // Get the current date
        var currentDate = new Date();

        // Calculate the age
        var age = currentDate.getFullYear() - birthdateDate.getFullYear();
        
        // Check if the birthdate for this year has occurred
        if (currentDate.getMonth() < birthdateDate.getMonth() || (currentDate.getMonth() === birthdateDate.getMonth() && currentDate.getDate() < birthdateDate.getDate())) {
            age--;
        }

        // Format the name as "Lastname, Firstname Age"
        var nameParts = name.split(' ');

        if(nameParts.length >= 3)
        {
            var firstName = nameParts[0];
            var firstName2 = nameParts[1];
            var lastName = nameParts.slice(2).join(' ');
            var formattedName = firstName + ' ' + firstName2 + ', ' + lastName + ' ' + age;
            console.log('true');
            $('#name').val(formattedName);
        }
        else
        {
            var firstName = nameParts[0];
            var lastName = nameParts.slice(1).join(' ');
            var formattedName = firstName + ', ' + lastName + ' ' + age;
            console.log('false');
            $('#name').val(formattedName);
        }
    }    
    else
    {

    }


    setTimeout(function() {
        $("#flashMessage").fadeOut(2000);
    });

});