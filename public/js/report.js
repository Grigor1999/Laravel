$(document).ready(function(){
    $('.updateBtn').click(function(){

        let ID = $(this).attr('data-id')
        $.ajax({
            type: 'post',
            url: '/updateHistory',
            data: { ID },
            success: function (r) {
                if(r){
                    Swal.fire({
                        icon: 'success',
                        text: `Adresse ${ID} auf NEU gesetzt.`,
                    })
                }
            }
            
        })
    })
})