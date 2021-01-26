$(document).ready(function () {
    $('.statusBtn').click(function () {
        if($(this).attr('data-value')=="noAnsw"){
            $('#textRemarks').html($('#textRemarks').html() + $(this).html())
        }
        $("input[name='status']").val($(this).val())
    })

    $('.saveForm').click(function(){
        if(!$('#textRemarks').val()){
            $('#textRemarks').addClass('is-invalid')
        }
        else{
            $('.homePageContainer').submit()
        }
    })
    $('#textRemarks').change(function(e){
        if($('#textRemarks').val()){
            $('#textRemarks').removeClass('is-invalid')
        }
    })
})

function checkWiedervorlageValue(e) {
    if ($("input[name='next']").val().length <= 1) {
        var alert_str = 'Bitte Datum und Uhrzeit der Wiedervorlage vor dem Speichern eingeben.';
        Swal.fire({
            icon: 'warning',
            text: alert_str,
          })
    }
    else{
        $("input[name='status']").val(e)
    }
}
    function checkShootingValues(e) {
		var val_ok = true;
		var alert_str = 'Bitte die folgenden Angaben zum Treffpunkt vor dem Speichern des Shootings eintragen:';
		
		if ($("input[name='meeting_street']").val().length <= 1) {
			val_ok = false;
			alert_str += '\r\n  - Strasse';
		}
			
		if ($("input[name='meeting_zip']").val().length <= 1) {
			val_ok = false;
			alert_str += '\r\n  - PLZ';
		}
			
		if ($("input[name='meeting_city']").val().length <= 1) {
			val_ok = false;
			alert_str += '\r\n  - Ort';
		}
		
		if ($("input[name='meeting_timestamp']").val().length <= 1) {
			val_ok = false;
			alert_str += '\r\n  - Datum / Uhrzeit';
		}	
		
		if (!val_ok){
            Swal.fire({
                icon: 'warning',
                text: alert_str,
              })
        }
        else{
            $("input[name='status']").val(e)
        }
}

