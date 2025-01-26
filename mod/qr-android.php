<style>
#contenidocamara {
  transform: scaleX(-1);
  -moz-transform: scaleX(-1);
  -webkit-transform: scaleX(-1);
  -o-transform: scaleX(-1);
}
</style>


<select id="camerasList" class="border-primary form-control custom-input mb-4"></select>
<div id="contenidocamara">
<script src="/js/instascan.min.js"></script>
<video id="video" class="w-100">
</div>

<script>
    
  let scanner = null;

$(document).ready(function() {
    scanner = new Instascan.Scanner({ video: document.getElementById('video') });
    scanner.addListener('scan', function(content) {
        const currentPath = window.location.pathname + window.location.hash;
        if (currentPath.includes('invitados/datos')){
           

            $('#d_codigo').val(content); 
            var event = new KeyboardEvent('keypress', {
                key: 'Enter',
                code: 'Enter',
                keyCode: 13,
                which: 13,
                charCode: 13,
                bubbles: true,
                cancelable: true,
            });
            document.getElementById('d_codigo').dispatchEvent(event);

        }else{
            $('#r_cliente').val(content); 
            var event = new KeyboardEvent('keypress', {
                key: 'Enter',
                code: 'Enter',
                keyCode: 13,
                which: 13,
                charCode: 13,
                bubbles: true,
                cancelable: true,
            });
            document.getElementById('r_cliente').dispatchEvent(event);
        }

           



        });

    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            cameras.forEach(function(camera, index) {
                $('#camerasList').append($('<option>', {
                    value: index,
                    text: camera.name
                }));
            });

            $('#camerasList').change(function() {
                var selectedCameraIndex = $(this).val();
                scanner.start(cameras[selectedCameraIndex]);
            });
            scanner.start(cameras[0]);
             
        } else {
            console.error('No hay cámaras disponibles.');
        }
    }).catch(function(err) {
        console.error(err);
    });
});
</script>



