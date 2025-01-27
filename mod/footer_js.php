  <script src="/lib/apexcharts/apexcharts.min.js"></script>
  <script src="/lib/chart.js/chart.umd.js"></script>
  <script src="/lib/echarts/echarts.min.js"></script>
  <script src="/lib/quill/quill.js"></script>
  <script src="/lib/simple-datatables/simple-datatables.js"></script>
  <script src="/lib/tinymce/tinymce.min.js"></script>
  <script src="/lib/php-email-form/validate.js"></script>
  <script src="/js/main.js"></script>
  <script src="/js/all.js"></script>
  <script src="/js/alert.js"></script>
  
<script>
    (function() {
        const noop = () => {}; 
        console.log = noop;
        console.warn = noop;
        console.error = noop;
        console.info = noop;
        console.debug = noop;
        console.network = noop;
    
        if (window.console && console.error) {
            const originalConsoleError = console.error;
            const originalConsoleWarn = console.warn;
            
            console.error = function(message) {
                originalConsoleError.call(console, message);
            };
            console.warn = function(message) {
                originalConsoleWarn.call(console, message);
            };
        }
        
        window.alert = noop;
        window.confirm = noop;
        window.prompt = noop;
      
    })();
</script>

  </body>
  </html>