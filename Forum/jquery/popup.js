$(document).on("pagecreate", "#page1", function () {

    $(document).on('click', '#openPopup', function() {
        $('#inlinecontent').simpledialog2({
            mode: "blank",
            headerText: "Select Item(s)",
            headerClose: false,
            blankContent: true,
            themeDialog: 'a',
            width: '75%',
            zindex: 1000
        });
    });
    
    $(document).on('click', '#dialogSubmit', function() {
        var numChecked = $('#cBoxes').find('[type=checkbox]:checked').length;
        if (numChecked > 0){
            $(document).trigger('simpledialog', {'method':'close'});
        } else {
          $('<div>').simpledialog2({
            mode: 'blank',
            headerText: 'Thank you for your report.',
            headerClose: true,
            transition: 'flip',
            themeDialog: 'b',
            zindex: 2000,
            blankContent : 
              "<div style='padding: 15px;'><p>An administrator will review your request and take appropriate action. We apologise for any inconvenience this may cause.</p>"+
              // NOTE: the use of rel="close" causes this button to close the dialog.
              "<a rel='close' data-role='button' href='#'>OK</a></div>"
          });        
        }
    });
    
});