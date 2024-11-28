(function($){
    $(document).ready(function(){

        window.xhr = false;

        function ajax_product_export(option){

            if (window.xhr) {
                window.xhr.abort();
            }

            //Init
            $('#analytics-error').empty();

            //Datas
            let product_id = option.val();

            //ArayData
            var form_data = new FormData();
            form_data.append('product_id', product_id);

            //Send data
            form_data.append('action', 'utfb_export_product_analytics');

            //AJAX
            window.xhr = $.ajax({
                url: ajaxurl,
                method: 'POST',
                contentType: false,
                processData: false,
                data: form_data,
                success: function (response) {
                    if (response.success) {
                        // The URL of the generated CSV file
                        var fileUrl = response.data.file_url;

                        // Create a temporary link to trigger the download
                        var link = document.createElement('a');
                        link.href = fileUrl;
                        link.download = response.data.title_cvs+'.csv'; // The name of the file
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    }
                    $('#analytics-error').html(response.data.message);
                },
                error: function (data) {
                }

            });
        }

        //Events
        $('body #utbf-analytics-product' ).off('change').on('change', function() {
            ajax_product_export($(this));
        });

    });
}(jQuery));