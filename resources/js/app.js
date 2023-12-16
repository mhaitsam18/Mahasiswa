import './bootstrap';

require('./bootstrap');
require('./lightbox');

import 'jquery';
import 'colorbox';

$(document).ready(function(){
    // Inisialisasi Colorbox untuk gambar
    $('.img-thumbnail').colorbox({
        rel: 'gallery',
        maxWidth: '90%',
        maxHeight: '90%',
    });

    // Menangani penutupan Colorbox ketika area di luar gambar diklik
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.cboxPhoto').length && !$(e.target).closest('.cboxContent').length) {
            $.colorbox.close();
        }
    });
});
