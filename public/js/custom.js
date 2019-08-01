$.noConflict(),jQuery(function($){ 
    $('.url-form').on('submit', event => {
        event.preventDefault();
        let form = $('.url-form'),
            responseDiv = $('#ajax-response');    

        $.ajax({
            type: "POST",
            url: '/create_url', 
            data: form.serialize(),
            success: response => {
                if('url' in response) {
                    responseDiv.html('<div style="display:flex;"><input id="shorturl" class="form-control" value="'+ response.url +'" readonly><button type="button" class="btn btn-dark clipboardBtn" data-clipboard-target="#shorturl">Copy</button></div>').fadeIn(250);
                    new ClipboardJS('.clipboardBtn');
                } else {
                    responseDiv.html('<h3 class="h3 font-weight-normal">'+ response.error_msg + '</h3>').fadeIn(250);
                }
            }
        });
    });
});
