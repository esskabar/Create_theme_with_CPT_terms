jQuery(document).ready(function ($) {
    $(document).on('change', 'select#country_list', function (e) {
        e.preventDefault();
        select_country = $(this).val();
        var data = {
            'action': 'country_filter',
            'country': select_country
        };
        $.post(ajaxurl, data, function(response) {
            $('.branchs-list').html(response);
        })
    });
})