$(document).ready(function () {
    $('.delete').click(function () {
        let _this = $(this)
        let member_id = $(this).attr('data-id')
        let cc_pg_name = $(this).attr('data-value')
        $.ajax({
            type: 'post',
            url: '/delPgMember',
            data: {
                member_id,
                cc_pg_name
            },
            success: function (r) {
                _this.parents('tr').remove()
            }

        })
    })
    $('.refreshBtn').click(function(e){
        e.preventDefault()
        $.ajax({
            type: 'post',
            url: '/refreshAddresses',
            data: {},
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    text: 'Adressen refresht',
                  })
            }

        })
    })
    $('.recoverBtn').click(function(e){
        e.preventDefault()
        $.ajax({
            type: 'post',
            url: '/recoverAddresses',
            data: {},
            success: function (r) {
                Swal.fire({
                    icon: 'success',
                    text: 'Adressen recover',
                  })
            }

        })
    })
})
