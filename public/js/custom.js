$('.url-form').on('submit', function(event){
	event.preventDefault();
	var form = $('.url-form');
	$.ajax({
        type: "POST",
        url: '/create_url', 
        data: form.serialize(),
        success: function(data) {
            if(data !== 'Invalid URL'){
            	$('.ajax-response').html('<h3 class="h3 mb-3 font-weight-normal">Your ShortURL is: </h3><div style="display:flex;"><input id="shorturl" class="form-control clipboardInput" readonly value="'+ data +'"><button class="btn btn-dark clipboardBtn" data-clipboard-text="'+ data +'">Copy</button></div>').show(350);
            	new ClipboardJS('.clipboardBtn');
            }
            else {
				$('.ajax-response').html('<h3 class="h3 font-weight-normal">'+ data + '</h3>').show(350);
            }
        }
    });
});