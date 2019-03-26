<footer class="bg--dark footer-4">

<div class="footer__lower">
<div class="container">
<div class="row">
<div class="col-sm-6">
<a href="#top" class="inner-link top-link col-md-offset-12">
<i class="ion-chevron-up"></i>
</a>
<p class="mt-15">
<img alt="image" src="img/LOGOAIDC.png" height="28px" class="mr-15">
<span class="type--fine-print">&copy;
<span class="update-year">2019</span> - All Rights Reserved
</span>&nbsp;
</p>
</div>
<div class="col-sm-6">
<div id="mc_embed_signup">
<form id="subscribe">
<div id="mc_embed_signup_scroll">
<div class="row">
<div class="col-md-8" style="padding-top: 14px;">
<input type="email" name="subscriptionEmail" class="email ips form-control" id="mce-EMAIL" placeholder="Email Address" required>
</div>
<div class="col-md-3">
<div class="clear">
<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="btn btn-md btn-black-border custom--ip btn-block">
<input type="reset" id="resetSubscription" style="display:none;">
</div>
</div>
</div>

<div class="negative--" aria-hidden="true"><input type="hidden" name="b_974bb058d36f770bbfd2258c1_c1e2c7274d" tabindex="-1" value=""></div>
</div>
</form>
<small class="text-muted pull-right promise">We'll send weekly updates. We too hate spam.</small>
</div>
</div>
<div class="hidden"><a href="https://www.fabstudio.co/">By Fabstudio</a></div>
</div>
</div>

</div>
</footer>

<div id="fb-root"></div>
<script type="text/javascript" data-cfasync="false">
(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.6&appId=1494927560761708";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript" data-cfasync="false" src="js/jquery.min.js"></script>
<script type="text/javascript" data-cfasync="false" src="bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" data-cfasync="false" src="js/modernizer.js"></script>
<script type="text/javascript" data-cfasync="false" src="js/isMobile.js"></script>
<script type="text/javascript" data-cfasync="false" src="js/slick.js"></script>
<script type="text/javascript" data-cfasync="false" src="js/stellar.js"></script>
<script type="text/javascript" data-cfasync="false" src="js/imagesLoaded.js"></script>
<script type="text/javascript" data-cfasync="false" src="js/lightgallery.js"></script>
<script type="text/javascript" data-cfasync="false" src="js/masonry.js"></script>
<script type="text/javascript" data-cfasync="false" src="js/spectagram.js"></script>
<script type="text/javascript" data-cfasync="false" src="js/wow.js"></script>
<script type="text/javascript" data-cfasync="false" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" data-cfasync="false" src="js/YTPlayer.js"></script>
<script type="text/javascript" data-cfasync="false" src="js/main.js"></script>
<script type="text/javascript" data-cfasync="false" src="css/owl.js"></script>
<script type="text/javascript" data-cfasync="false" src="platform-api.sharethis.com/js/sharethis.js#property=58a6e6b23a2ee70012969e98&product=inline-share-buttons"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript" data-cfasync="false">

    $('.omg-slideshow').slick({
        infinite: true,
        lazyLoad:'ondemand',
        slidesToShow: 6,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 6,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },{
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('.mega-slideshow').slick({
        infinite: true,
        lazyLoad:'ondemand',
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },{
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

</script>
<script type="text/javascript" data-cfasync="false">

    $(document).ready(function(){

$(document).on('click','#opensearch',function(){
        $(".other").addClass("hidden");
        $(".search-wrapper").removeClass("hidden");
    });
    $(document).on('click','#closesearch',function(){
        $(".other").removeClass("hidden");
        $(".search-wrapper").addClass("hidden");
    });
    
    $("#subscribe").submit(function(event){
        event.preventDefault();
        var email=$("input[name=subscriptionEmail]").val();
        $.ajax({
            url: 'subscribeWebsite.php',
            type: 'POST',
            data: {email},
        })
        .done(function() {
            toastr.success('You are subscribed successfully', 'Success!');
            $("#resetSubscription").trigger("click");
        })
        .fail(function() {
            toastr.error('You are already subscribed', 'Error!');
        });        
    });

    });

</script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-128390340-1" type="60827d8619fd5abdc9204a2f-text/javascript"></script>
<script type="60827d8619fd5abdc9204a2f-text/javascript">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-128390340-1');
</script>
<script src="ajax.cloudflare.com/cdn-cgi/scripts/a2bd7673/cloudflare-static/rocket-loader.min.js" data-cf-settings="60827d8619fd5abdc9204a2f-|49" defer=""></script></body>

<!-- Mirrored from www.allindiandjsclub.in/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Mar 2019 16:34:55 GMT -->
</html>