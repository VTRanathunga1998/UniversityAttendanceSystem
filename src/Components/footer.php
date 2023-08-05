
<script>
    $(document).ready(function(){
    // check if the "showModal" parameter is present in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const showModal = urlParams.get('showModal');
    if (showModal === 'true' && status==='unsuccess') {
        // show the modal popup
        $('#unsuccess').modal('show');

        
        window.history.replaceState({}, document.title, window.location.pathname);
        
        // hide the modal popup after 1 seconds
        setTimeout(function(){
        $('#unsuccess').modal('hide');
        }, 1000);
    }
    });
</script>

<script>
    $(document).ready(function(){
    // check if the "showModal" parameter is present in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const showModal = urlParams.get('showModal');
    if (showModal === 'true' && status==='sessionView') {
        // show the modal popup
        $('#sessionView').modal('show');
    }
    });
</script>

<!-- <script>
    $(document).ready(function(){
    // check if the "showModal" parameter is present in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const showModal = urlParams.get('showModal');
    if (showModal === 'true' && status==='createSession') {
        // show the modal popup
        $('#addSession').modal('show');
    }
    });
</script>  -->

</body>

</html>

