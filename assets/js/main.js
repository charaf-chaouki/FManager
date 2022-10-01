$(document).ready(function(){
    $('body').on('dblclick', '.open-forder', function(){
        let selectedEl = $(this);
        let link = $(this).attr('link');
        let isDir = $(this).hasClass('is-dir');

        $.ajax({
            url: "ajax/get_files.php",
            type: "post",
            dataType: 'json',
            data: {dir: link},
            success: function(data){
                $('#tbody').html(data['data']);

                if(isDir)
                {
                    $(selectedEl).closest('li').append(data['subDir']);
                }
            }
        })

        $(this).closest('li').find('.arrow').removeClass('fa-caret-right').addClass('fa-caret-down');
        $(this).closest('li').find('.arrow').removeClass('dir-close').addClass('dir-open');
    });
    
    $('body').on('click', '.abs-arrow', function(){
        $('.arrow').removeClass('fa-caret-down').addClass('fa-caret-right');
        $('.arrow').removeClass('dir-open').addClass('dir-close');
        $('.sub-forders').remove();
    });

    $('body').on('click', '.open-forder', function(){
        $(this).closest('tr').addClass('active');
    });

    $('body').on('click', '.arrow', function(){

        if($(this).hasClass('dir-close'))
        {
            $(this).removeClass('fa-caret-right').addClass('fa-caret-down');
            $(this).removeClass('dir-close').addClass('dir-open');
            $(this).closest('.open-forder').trigger('dblclick');
        }
        else if($(this).hasClass('dir-open'))
        {

            $(this).removeClass('fa-caret-down').addClass('fa-caret-right');
            $(this).removeClass('dir-open').addClass('dir-close');
            $(this).closest('li').find('.sub-forders').remove();
        }
    });
});

