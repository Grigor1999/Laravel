$(document).ready(function(){
    
    $('.filterSelect').change(function(){
        $(this).parents('form').submit()
    })
    $('.save').click(function(){
        let status = $("select[name='statusManage']").val()
        let meeting_user = $("select[name='meeting_user']").val()
        let meeting_timestamp = $("input[name='meeting_timestamp']").val()
        let ID = $(this).attr('data-id')
        let remarks = $("textarea[name='remarks']").val()
        $.ajax({
            type: 'post',
            url: '/updateImmoData',
            data: {
                status,
                meeting_user,
                meeting_timestamp,
                remarks,
                ID
            },
            success: function (r) {
                if(r=='success'){
                    Swal.fire({
                        icon: 'success',
                        text: 'success',
                      })
                }
                else{
                    Swal.fire({
                        icon: 'warning',
                        text: r.error,
                      })
                }

            }

        })
    })

})