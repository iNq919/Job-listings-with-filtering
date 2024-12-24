jQuery(function ($) {
    function filterJobOffers(page = 1) {
        var selectedTechnologies = [];
        var selectedLocations = [];

        $('input.filter-checkbox[data-taxonomy="technologia"]:checked').each(function () {
            selectedTechnologies.push($(this).val());
        });
        $('input.filter-checkbox[data-taxonomy="lokalizacja"]:checked').each(function () {
            selectedLocations.push($(this).val());
        });

        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'load_filtered_job_offers',
                filters: {
                    technologia: selectedTechnologies,
                    lokalizacja: selectedLocations
                },
                paged: page
            },
            success: function (response) {
                $('#job-listings-content').html(response);

                var pagination = $('#job-listings-content .page-numbers');
                if (pagination.length > 0) {
                    pagination.wrapAll('<div class="pagination-container"></div>');
                }

                if ($('#job-listings-content').is(':empty')) {
                    $('#no-offers-message').show();
                } else {
                    $('#no-offers-message').hide();
                }
            }
        });
    }

    $(document).on('click', '.js-toggle-filter', function () {
        var $optionsContainer = $(this).next('.options-container');

        if ($optionsContainer.hasClass('open')) {
            $optionsContainer.removeClass('open').slideUp(300);
        } else {
            $optionsContainer.addClass('open').slideDown(300);
        }
    });

    $('.filters .options-container').each(function (index) {
        if (index === 0) {
            $(this).addClass('open').show();
        }
    });

    $(document).on('change', 'input.filter-checkbox', function () {
        filterJobOffers(1);
    });

    $('#clear-filters').click(function () {
        $('input.filter-checkbox').prop('checked', false);
        filterJobOffers(1);
    });

    $(document).on('click', '.page-numbers', function (e) {
        e.preventDefault();
        var page = $(this).text();
        filterJobOffers(page); 
    });

    filterJobOffers(1);
});
