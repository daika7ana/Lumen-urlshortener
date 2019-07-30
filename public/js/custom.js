$.noConflict(),jQuery(function($){ 
    $('.url-form').on('submit', event => {
        event.preventDefault();
        let form = $('.url-form'),
            responseDiv = $('#ajax-response');    

        $.ajax({
            type: "POST",
            url: '/create_url', 
            data: form.serialize(),
            success: data => {
                if('Invalid URL' !== data) {
                    responseDiv.html('<div style="display:flex;"><input id="shorturl" class="form-control" value="'+ data +'" readonly><button class="btn btn-dark clipboardBtn" data-clipboard-target="#shorturl">Copy</button></div>').fadeIn(250);
                    new ClipboardJS('.clipboardBtn');
                } else {
                    responseDiv.html('<h3 class="h3 font-weight-normal">'+ data + '</h3>').fadeIn(250);
                }
            }
        });
    });
});
