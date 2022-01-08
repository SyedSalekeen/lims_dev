$(document).ready(function(){
    $('.garage').on('change',function(){
    //   $("#garage").val(1);
    if ($(this).is(':checked')) {
        $(this).attr('value', 1);
    } else {
        $(this).attr('value', 0);
    }
    });

    // article discount
    $(document).on("change keyup blur", "#aDiscount", function() {
        var main = $('#aBalance').val();
        var disc = $('#aDiscount').val();
        var dec = (disc / 100).toFixed(2); //its convert 10 into 0.10
        var mult = main * dec; // gives the value for subtract from main value
        // var discont = main - mult;
        $('#result').val(mult);
    });

    // article tax
    $(document).on("change keyup blur", "#atax", function() {
        var main = $('#aBalance').val();
        var disc = $('#atax').val();
        var dec = (disc / 100).toFixed(3); //its convert 10 into 0.10
        var mult = main * dec; // gives the value for subtract from main value
        // var discont = main - mult;
        $('#taxresult').val(mult);
    });

    // plus amount buying price && tax
    $(document).on("change keyup blur","#atax",function() {
        var main = parseFloat($('#aBalance').val());
        var tax = parseFloat($('#taxresult').val());
        // console.log(tax);
        var plus = main + tax;
        $('#taxbuying').val(plus);
    });

    // dropify js

        // Basic
        $('.dropify').dropify();
        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });
        // Used events
        var drEvent = $('#input-file-events').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });
        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })

});

