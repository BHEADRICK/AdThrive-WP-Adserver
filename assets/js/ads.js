jQuery('.adthrive-ad').each(function(ix, item){

    var zone = jQuery(item).data('zone-id')

        jQuery.get(window.AdThrive_WP_Adserver.root + '/frontend/' + zone, function(resp){
        jQuery(item).html('<a target="_blank" href="' + resp.url + '" title="' + resp.title + '"><img src="' + resp.image + '" alt="' + resp.title + '" ></a>')
        })

});