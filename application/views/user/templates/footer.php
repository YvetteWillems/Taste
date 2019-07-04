            <!-- mobile footer -->
            <div class="d-sm-none footer-large block-height-4">
                <div id="mobile-extra-menu" class="col-sm-12">
                    <!-- tasteboard / info / add of delete button -->
                </div>
            </div>
             <!-- desktop footer -->
            <div class="d-none d-md-block footer-large block-height-4">
                <p class="fs14">syntra eindproject - yvette willems</p>
                <!-- <div class="col-md-12"> -->
                    <!-- p tag geeft padding -->
                    <!-- <p class="fs16">yvette willems for syntra eindproject - foodpairing update - matching aroma's</p> -->
                <!-- </div> -->
            </div>
        <!-- close container -->
        </div>
    <!-- close block-all -->
    </div>  
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script>
            showUserMenu = () => {
                // Mobile version:
                // 1: Change visibility menu:
                var userMenu = document.getElementById('mobile-user-menu'); 
                if(userMenu.style.display == "block"){
                    userMenu.style.display = "none";
                } else {
                    userMenu.style.display = "block";
                }
                // Desktop version:
                // 1: Change visibility menu:
                // 2: Set other divs visibility to none:
                var userMenuLarge = document.getElementById('user-menu-large'); 
                if(userMenuLarge.style.display == "block"){
                    userMenuLarge.style.display = "none";
                } else {
                    userMenuLarge.style.display = "block";
                }
            }
	    </script>
    </body>
</html>