
<div id="contenidocamara">
              <script src="/js/qrCode.min.js"></script>
 <a onclick="beept()" id="beept"></a>
     <a id="btn-scan-qr" href="#"> </a>
        <canvas hidden="" id="qr-canvas" class="img-fluid"></canvas>
</div>
  

        
        
        
 <script>
      function simularEnter() {
    var inputCodigo = document.getElementById("r_cliente");
    var eventoEnter = new KeyboardEvent('keypress', {
        key: 'Enter',
        code: 'Enter',
        keyCode: 13,
        which: 13,
        charCode: 13,
        bubbles: true,
        cancelable: true,
    });
    
    inputCodigo.dispatchEvent(eventoEnter);
}
 </script>
  <script>
   function beept() {
    var audio = new Audio('/audio/beep.mp3');
    audio.play();
   };
  </script>
      

       <script>
const video = document.createElement("video");
const canvasElement = document.getElementById("qr-canvas");
const canvas = canvasElement.getContext("2d");
const btnScanQR = document.getElementById("btn-scan-qr");
let scanning = true;

const encenderCamara = async () => {
  try {
    const devices = await navigator.mediaDevices.enumerateDevices();
    const videoDevices = devices.filter(device => device.kind === 'videoinput');
    const lastVideoDevice = videoDevices[videoDevices.length - 1];

    const stream = await navigator.mediaDevices.getUserMedia({
      video: {
        facingMode: 'environment' 
      }
    });

    btnScanQR.hidden = true;
    canvasElement.hidden = false;
    video.setAttribute("playsinline", true); 
    video.srcObject = stream;
    video.play();
    tick();
    scan();
  } catch (error) {
    console.error('Error al obtener el stream de video:', error);
  }
};


function tick() {
  canvasElement.height = video.videoHeight;
  canvasElement.width = video.videoWidth;
  canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
  requestAnimationFrame(tick);
}

function scan() {
  if (scanning) {
    try {
      qrcode.decode();
    } catch (e) {
      setTimeout(scan, 500);
    }
  }
}


const cerrarCamara = () => {
  video.srcObject.getTracks().forEach((track) => {
    track.stop();
       qr_movil();
  });
  btnScanQR.hidden = false;
};

qrcode.callback = (respuesta) => {
  if (respuesta) {

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
           
          document.getElementById("r_cliente").value = respuesta;
          simularEnter();

        }

beept();
cerrarCamara();
    setTimeout(encenderCamara, 1500);
    setTimeout(qr_movil, 2000);
  }
};

window.addEventListener('load', (e) => {
  encenderCamara();
});

       </script>
     


