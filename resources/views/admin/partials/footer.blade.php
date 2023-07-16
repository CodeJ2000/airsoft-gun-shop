<div id="footer-sec">
    &copy; 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
</div>
    <!-- /. FOOTER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="{{ url('admin-assets/js/jquery-1.10.2.js') }}"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="{{ url('admin-assets/js/bootstrap.js') }}"></script>
<!-- METISMENU SCRIPTS -->
<script src="{{ url('admin-assets/js/jquery.metisMenu.js') }}"></script>
   <!-- CUSTOM SCRIPTS -->
<script src="{{ url('admin-assets/js/custom.js') }}"></script>
<script src="{{ url('admin-assets/js/bootstrap-fileupload.js') }}"></script>

<script>
    $(document).ready(function(){
        const $successMessage = $('#success-message');

        if($successMessage.length){
            setTimeout(() => {
                $successMessage.fadeOut();
            }, 3000);
        }
    });        
</script>

</body>
</html>
